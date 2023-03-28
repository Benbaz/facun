<?php

namespace App\Http\Controllers;


use App\Models\CandidatExament;
use App\Models\Payment;
use App\Models\CandidatConcours;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CandidatExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('candidat_exament');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'anne_entree' => 'required|string|max:255',
            'centre_examen' => 'required|string|max:255',
        ]);

        // Save the data to the database
        $candidat = new CandidatConcours();
        $candidat->nom = $validatedData['nom'];
        $candidat->prenom = $validatedData['prenom'];
        $candidat->telephone = $validatedData['telephone'];
        $candidat->date_naissance = $validatedData['date_naissance'];
        $candidat->lieu_naissance = $validatedData['lieu_naissance'];
        $candidat->anne_entree = $validatedData['anne_entree'];
        $candidat->centre_examen = $validatedData['centre_examen'];
        $candidat->numero_candidat = uniqid();
        $candidat->save();

        return view('candidat_payment', ['candidat' => $candidat]);
    }

    function ticket(Request $request){
        $ticket_number = $request->input('id_transaction');
        
        try {
            $candidatConcours = CandidatConcours::where('numero_candidat', $ticket_number)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            session()->flash('success', 'You are logged in!');
            // return back()->withErrors(['message' => 'CandidatConcours not found']);
            return redirect()->back()->with('error', 'Ce numero de candidature n\'existe pas');
        }

        $payment = $candidatConcours->payment;
        
        // Access the fields from both tables as needed, e.g.:
        $qr_code = [
            'nom' => $candidatConcours->nom,
            'prenom' => $candidatConcours->prenom,
            'transactionId' => $payment->transaction_id,
            'numeroCandidature' => $candidatConcours->numero_candidat,
        ];
        $text = implode(',', $qr_code);
    
        $data = [
            'candidat' => $candidatConcours,
            'momoTransactionId' => $payment->transaction_id,
            'transactionAmount' => $payment->amount,
            'ticketNumber' => $candidatConcours->numero_candidat,
            'transactionDate' => now()->format('Y-m-d H:i:s'),
            'qrCode' => $text
        ];
        // Return the ticket view with the data
        return view('ticket_egcim', $data);
        
        // ...
    }
    
    
    

    function returnTrueAfter35Seconds() {
        sleep(5);
        return true;
    }
    

    public function submit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nom' => '',
            'prenom' => '',
            'telephone' => '',
            'fiche' => '',
            'acte' => '',
            'diplome' => '',
            'photos' => '',
            'certificat' => '',
            'address_envelope' => '',
            'numero_mobile_money' => '',
        ]);

        // Create a new CandidatExamen instance and save it to the database
        $candidatExamen = new CandidatExament();
        $candidatExamen->nom = $validatedData['nom'];
        $candidatExamen->prenom = $validatedData['prenom'];
        $candidatExamen->telephone = $validatedData['telephone'];
        $candidatExamen->fiche = $validatedData['fiche']->store('candidat_examen_documents');
        $candidatExamen->acte = $validatedData['acte']->store('candidat_examen_documents');
        $candidatExamen->diplome = $validatedData['diplome']->store('candidat_examen_documents');
        $candidatExamen->photos = $validatedData['photos']->store('candidat_examen_documents');
        $candidatExamen->certificat = $validatedData['certificat']->store('candidat_examen_documents');
        $candidatExamen->address_envelope = $validatedData['address_envelope']->store('candidat_examen_documents');
        $candidatExamen->numero_mobile_money = $validatedData['numero_mobile_money'];

        // Create a new Payment instance and save it to the database

    }



    static function generateQRCode($data, $size = 150)
    {
        // Generate QR code matrix
        $matrix = [];
        $size = max(1, min(500, $size)); // limit size to 1-500 pixels
        for ($y = 0; $y < $size; $y++) {
            $row = [];
            for ($x = 0; $x < $size; $x++) {
                $row[] = 0;
            }
            $matrix[] = $row;
        }

        // Set up basic pattern
        for ($i = 0; $i < $size - 8; $i++) {
            $matrix[6][$i + 1] = ($i % 2 == 0) ? 1 : 0;
            $matrix[$i + 1][6] = ($i % 2 == 0) ? 1 : 0;
        }

        // Encode data and add to QR code
        $data = str_split($data);
        $bits = [];
        foreach ($data as $char) {
            $binary = str_pad(decbin(ord($char)), 8, "0", STR_PAD_LEFT);
            $bits[] = $binary;
        }
        $data = implode("", $bits);
        $data_len = strlen($data);
        $pos = 0;
        $direction = 1; // 1 = right, -1 = left
        for ($y = $size - 1; $y >= 0; $y -= 2) {
            if ($y == 6) {
                $y--;
            }
            for ($x = 0; $x < $size; $x++) {
                if ($matrix[$y][$x] == 0 && $pos < $data_len) {
                    $matrix[$y][$x] = intval($data[$pos]);
                    $pos++;
                }
                if ($matrix[$y - $direction][$x] == 0 && $pos < $data_len) {
                    $matrix[$y - $direction][$x] = intval($data[$pos]);
                    $pos++;
                }
            }
            $direction *= -1;
        }

        // Render QR code as PNG image
        $img = imagecreatetruecolor($size, $size);
        $bg = imagecolorallocate($img, 255, 255, 255); // white background
        $fg = imagecolorallocate($img, 0, 0, 0); // black foreground
        imagefill($img, 0, 0, $bg);
        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                if ($matrix[$y][$x] == 1) {
                    imagesetpixel($img, $x, $y, $fg);
                }
            }
        }
        ob_start();
        imagepng($img);
        $image_data = ob_get_contents();
        ob_end_clean();
        imagedestroy($img);
        $qr_code = 'data:image/png;base64,' . base64_encode($image_data);
        return $qr_code;
    }


    function checkPhoneNumber($phone_number)
    {
        // Remove any spaces or other non-digit characters from the phone number
        $phone_number = preg_replace('/\D/', '', $phone_number);

        // Determine whether the phone number belongs to Orange or MTN
        if (preg_match('/^6(5|6|7)/', $phone_number)) {
            return 'MTN Cameroon';
        } elseif (preg_match('/^6(9|8|4)/', $phone_number)) {
            return 'Orange Cameroon';
        } else {
            return 'Unknown network';
        }

        // $phone_number = $request->get('paiement');
        // $network = checkPhoneNumber($phone_number);
        // if ($network == 'MTN Cameroon') {
        //     // handle payment using Orange Money

        // } else {
        //     // handle unknown network error
        // }
    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CandidatExamen  $candidatExamen
     * @return \Illuminate\Http\Response
     */
    public function show(CandidatExament $candidatExamen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CandidatExamen  $candidatExamen
     * @return \Illuminate\Http\Response
     */
    public function edit(CandidatExament $candidatExamen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CandidatExamen  $candidatExamen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CandidatExament $candidatExamen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CandidatExamen  $candidatExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy(CandidatExament $candidatExamen)
    {
        //
    }
}
