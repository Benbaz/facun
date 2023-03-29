<?php

namespace App\Http\Controllers;

use App\Models\candidat;
use App\Models\elections;
use App\Models\etablissement;
use App\Models\paiements;
use App\Models\Settings;
use App\Models\vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CandidatsController extends Controller
{
    //

    public function index()
    {

        $candidats = Candidat::with(['etablissement', 'election'])->get();
        return view('candidat.index', compact('candidats'));
    }

    public function filter(Request $request)
    {
        // On récupère les paramètres de filtre de la requête
        // $nom = $request->input('nom');
        $etablissement_id = $request->input('etablissement_id');
        $election_id = $request->input('election_id');
        $type = $request->input('type');

        // $candidats = Candidat::with(['etablissement', 'election'])
        //     ->join('votes', 'candidats.id', '=', 'votes.candidat_id')
        //     ->leftJoin('elections', 'candidats.election_id', '=', 'elections.id')
        //     ->when(!empty($nom), function ($query) use ($nom) {
        //         $query->where(function ($query) use ($nom) {
        //             $query->where('nom', 'LIKE', "%$nom%")
        //                   ->orWhere('prenom', 'LIKE', "%$nom%");
        //         });
        //     })
        //     ->when($etablissement_id, function ($query, $etablissement_id) {
        //         $query->where('candidats.etablissement_id', $etablissement_id);
        //     })
        //     ->when($election_id, function ($query, $election_id) {
        //         $query->where('candidats.election_id', $election_id)
        //               ->where('votes.election_id', $election_id);
        //     })
        //     ->when($type, function ($query, $type) {
        //         $query->where('elections.type', $type);
        //     })
        //     ->orderBy('votes.score', 'DESC')
        //     ->get(['candidats.*', 'votes.score']);

        $candidats = Candidat::with(['etablissement', 'election' => function($query) {
            $query->select(['id', 'date_fin']);
        }])
        ->withCount(['votes' => function($query) {
            $query->select(DB::raw('SUM(score)'));
        }])
        ->where('tel', $type)
        ->orderByDesc('votes_count')
        ->get();
    
        $etablissements = Etablissement::all();
        $elections = Elections::all();
        $voteValue = Settings::findOrFail(1);
    
        return view('welcome', compact('candidats', 'etablissements', 'elections', 'voteValue', 'type'));

        // $etablissements = etablissement::all();
        // $elections = elections::all();
                 
        // return view('welcome', compact('candidats', 'etablissements', 'elections'));
    }

    
    public function create()
    {
        $etablissements = etablissement::all();
        $elections = elections::all();
                 
        return view('candidat.create', compact('etablissements', 'elections'));
        
    }

    public function video($id)
    {
        $candidat = candidat::findOrFail($id);
        return view('video', compact('candidat'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'tel' => 'required',
        'etablissement' => 'required',
        'election' => 'required',
        'video' => 'required|mimes:jpeg,jpg,png|max:5000',
        // 'video' => 'required|mimes:mp4|max:30000',
        'photo' => 'required|mimes:jpeg,jpg,png|max:5000',
    ]);

    // Store the video file
    // $photoPath = $request->file('photo')->storePublicly('candidat/photos', 'public');
    // $photoUrl = asset('storage/' . $photoPath);
//     $photoPath = Storage::putFile('candidat/photos', $request->file('photo'));
//     $photoPath = $request->file->move(public_path('uploads'), $fileName);

// // Get the URL for the stored file
// $photoUrl = asset(str_replace('public', 'storage', $photoPath));

//     $videoPath = $request->file('video')->store('candidat/videos', 'public');
//     $videoUrl = asset('storage/' . $videoPath);

    $candidat = new candidat();
    $candidat->nom = $validatedData['nom'];
    $candidat->prenom = $validatedData['prenom'];
    $candidat->tel = $validatedData['tel'];
    $candidat->etablissement_id = $validatedData['etablissement'];
    $candidat->election_id = $validatedData['election'];
    // $candidat->photo = $photoPath;
    // $candidat->video = $videoUrl;

    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $filename = $candidat->id . '_' . time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('/candidat/videos'), $filename);
        $candidat->video = $filename;
    }

    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $filename = $candidat->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/candidat/photos'), $filename);
        $candidat->photo = $filename;
    }
    
    $candidat->save();

    return redirect()->route('candidat.create')->with('success', 'Candidat enregistré avec succès.');
}

// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'nom' => 'nullable',
//         'prenom' => 'nullable',
//         'tel' => 'nullable',
//         'etablissement' => 'nullable',
//         'election' => 'nullable',
//         'video' => 'nullable|mimes:mp4|max:30000',
//         'photo' => 'nullable|mimes:jpeg,png,jpg|max:2048',
//     ]);

//     // $candidat = Candidat::create($data);
//     $candidat = new candidat();
//     $candidat->nom = $validatedData['nom'];
//     $candidat->prenom = $validatedData['prenom'];
//     $candidat->tel = $validatedData['tel'];
//     $candidat->etablissement_id = $validatedData['etablissement'];
//     $candidat->election_id = $validatedData['election'];

//     if ($request->hasFile('video')) {
//         $video = $request->file('video');
//         $filename = $candidat->id . '_' . time() . '.' . $video->getClientOriginalExtension();
//         $video->move(public_path('/candia=videos'), $filename);
//         $candidat->video = $filename;
//     }

//     if ($request->hasFile('photo')) {
//         $photo = $request->file('photo');
//         $filename = $candidat->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
//         $photo->move(public_path('photos'), $filename);
//         $candidat->photo = $filename;
//     }

//     if($candidat->save()){
//         return redirect()->route('candidat.index');
//     } else{
//         return redirect()->route('candidat.index');
//     }

    
// }




    public function voter(Request $request, $id)
    {
        // Get the number MOMO from the request
        $transactionId = $request->input('numero_momo');
        $exists = DB::table('paiements')
              ->where('votant_numero', $transactionId)
              ->exists();

if (!$exists) {
    $nombre_voix = $request->input('nombre_voix');
        $numero_momo = '46733123453';

        // Get the ID of the candidat to vote for
        $candidat_id = $id;

        // Get the candidat
        $candidat = Candidat::findOrFail($candidat_id);

        $voteValue = Settings::findOrFail(1);

        $scoreDonner = $nombre_voix;
        // $scoreDonner = $nombre_voix * $voteValue->valeur;
        
        try {
            $collection = new Collection();

            // Initiate the MOMO transaction
            $momoTransactionId = $collection->requestToPay('transactionId', $numero_momo, 100);

            // Check if the transaction was successful
            $transactionStatus = $collection->getTransactionStatus($momoTransactionId);
            // Convert the transaction status to a string
            $transactionStatusString = json_encode($transactionStatus);
            $transactionStatus = json_decode($transactionStatusString);

            // Log the transaction status
            info('Transaction status: ' . $transactionStatusString);
            if ($transactionStatus->status === 'SUCCESS') {
                // Save the vote information in the votes table
                $vote = new Vote();
                $vote->candidat_id = $candidat->id;
                $vote->election_id = $candidat->election_id;
                $vote->votant_numero = $numero_momo;
                $vote->score = $scoreDonner;
                $vote->save();

                // Save the payment information in the payments table
                $paiement = new paiements();
                $paiement->votant_numero = $transactionId;
                $paiement->montant = $scoreDonner;
                $paiement->status = $transactionStatus;
                $paiement->save();

                // TODO: process the voter action (e.g. update the candidat's votes count)

                // Redirect back to the previous page
                return redirect()->back()->with('success', 'Transaction successful');
            } elseif($transactionStatus->status === 'PENDING') {
        
                $vote = new Vote();
                $vote->candidat_id = $candidat->id;
                $vote->election_id = $candidat->election_id;
                $vote->votant_numero = $numero_momo;
                $vote->score = $scoreDonner;
                $vote->save();

                // Save the payment information in the payments table
                $paiement = new paiements();
                $paiement->votant_numero = $transactionId;
                $paiement->montant = $scoreDonner;
                $paiement->status = $transactionStatus->status;
                $paiement->save();
                // Set a flag to indicate that the modal should be displayed
                $showModal = true;

                $data = [
                    'candidat' => $candidat,
                    'momoTransactionId' => $momoTransactionId,
                    'transactionAmount' => $scoreDonner, // Change this to the actual transaction amount
                    'transactionDate' => now()->format('Y-m-d H:i:s')
                ];
            
                // Return the ticket view with the data
                return view('ticket', $data);

                // Redirect back to the previous page with the flag
                // return redirect()->back()->with('showModal', $showModal);

            }elseif($transactionStatus['status'] === 'FAILED') {

                // Redirect back to the previous page
                return redirect()->back()->with('success', 'Transaction successful');
            }elseif($transactionStatus['status'] == 'REJECTED') {
        
                // Save the payment information in the payments table

                // Redirect back to the previous page
                return redirect()->back()->with('success', 'Transaction successful');
            }elseif($transactionStatus['status'] === 'TIMEOUT') {
        

                // TODO: process the voter action (e.g. update the candidat's votes count)

                // Redirect back to the previous page
                return redirect()->back()->with('success', 'Transaction successful');
            } else {
                // Transaction failed, redirect back with error message
                return redirect()->back()->with('error', 'Transaction failed');
                
            }
        } catch (CollectionRequestException $e) {
            do {
                printf(
                    "\n\r%s:%d %s (%d) [%s]\n\r",
                    $e->getFile(),
                    $e->getLine(),
                    $e->getMessage(),
                    $e->getCode(),
                    get_class($e)
                );
            } while ($e = $e->getPrevious());
            
            // Redirect back with error message
            return redirect()->back()->with('error', 'Transaction failed');
        }
} else {
    return redirect()->back()->with('error', 'La Transaction Id copié exsite déja/ The Transaction ID already exists');
}
        
    }

    public function retry(){
        $numero_momo = '46733123453';

        // Get the ID of the candidat to vote for
        // $candidat_id = $request->input('candidat_id');
        $candidat_id = 1;

        // Get the candidat
        $candidat = Candidat::findOrFail($candidat_id);

        try {
            $collection = new Collection();

            // Initiate the MOMO transaction
            $momoTransactionId = $collection->requestToPay('transactionId', $numero_momo, 100);

            // Check if the transaction was successful
            $transactionStatus = $collection->getTransactionStatus($momoTransactionId);
            // Convert the transaction status to a string
            $transactionStatusString = json_encode($transactionStatus);
            $transactionStatus = json_decode($transactionStatusString);

            // Log the transaction status
            info('Transaction status: ' . $transactionStatusString);
            if ($transactionStatus->status === 'SUCCESS') {
                
                $data = [
                    'candidat' => $candidat,
                    'momoTransactionId' => $momoTransactionId,
                    'transactionAmount' => 100, // Change this to the actual transaction amount
                    'transactionDate' => now()->format('Y-m-d H:i:s')
                ];
            
                // Return the ticket view with the data
                return view('ticket', $data);
                // Redirect back to the previous page
                // return redirect()->view('ticket', $data);
            }else {
                $data = [
                    'candidat' => $candidat,
                    'momoTransactionId' => $momoTransactionId,
                    'transactionAmount' => 100, // Change this to the actual transaction amount
                    'transactionDate' => now()->format('Y-m-d H:i:s')
                ];
            
                // Return the ticket view with the data
                return view('ticket', $data);

                // return redirect()->view('ticket', $data);
            }
        } catch (CollectionRequestException $e) {
            do {
                printf(
                    "\n\r%s:%d %s (%d) [%s]\n\r",
                    $e->getFile(),
                    $e->getLine(),
                    $e->getMessage(),
                    $e->getCode(),
                    get_class($e)
                );
            } while ($e = $e->getPrevious());
            
            // Redirect back with error message
            return redirect()->back()->with('error', 'Transaction failed');
        }
    }

    


}
