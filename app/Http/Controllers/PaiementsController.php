<?php

namespace App\Http\Controllers;

use App\Models\CandidatConcours;
use App\Models\Payment;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;
use Illuminate\Http\Request;

class PaiementsController extends Controller
{
    //

    public function index()
    {
        return view('candidat_payment', compact('numero_candidat'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'numero_mobile_money' => 'required|string|max:255',
        ]);
        $candidatId = $request->input('candidat_id');
        $candidat = CandidatConcours::findOrFail($candidatId);

        try {

            $numero_momo = '46733123453';
            $sumAPayer = 21000;

            $collection = new Collection();

            // Initiate the MOMO transaction
            $momoTransactionId = $collection->requestToPay('transactionId', $numero_momo, $sumAPayer);
            
            // Check if the transaction was successful
            $transactionStatus = $collection->getTransactionStatus($momoTransactionId);
                // Convert the transaction status to a string
                $transactionStatusString = json_encode($transactionStatus);
                $statusTrans = json_decode($transactionStatusString);

                // Log the transaction status
                info('Transaction status: ' . $transactionStatusString);

                if ($statusTrans->status === 'SUCCESS') {

                } elseif ($statusTrans->status === 'PENDING') {
                    // $showModal = true;
                    // return redirect()->back()->with('showModal', $showModal);
        

                    if ($this->returnTrueAfter35Seconds()) {
                        $transactionStatus = $collection->getTransactionStatus($momoTransactionId);
                        // Convert the transaction status to a string
                        $transactionStatusString = json_encode($transactionStatus);
                        $statusTrans = json_decode($transactionStatusString);

                        // Log the transaction status
                        info('Transaction status: ' . $transactionStatusString);

                        // $qr_code = QrCode::size(300)->generate($momoTransactionId);
                        if ($statusTrans->status === 'SUCCESS') {

                            
                            $payment = new Payment();
                            $payment->candidat_concours_id = $candidat->id;
                            $payment->amount = $sumAPayer;
                            $payment->transaction_id = $momoTransactionId;
                            $payment->status = $statusTrans->status;
                            $payment->numero_mobile_money = $validatedData['numero_mobile_money'];
                            $payment->save();

                            $qr_code = [
                                'nom' => $candidat->nom,
                                'prenom' => $candidat->prenom,
                                'transactionId' => $momoTransactionId,
                                'numeroCandidature' => $candidat->numero_candidat,
                            ];
                            $text = implode(',', $qr_code);
                            // Add the QR code to the data array
                            $data = [
                                'candidat' => $candidat,
                                'momoTransactionId' => $momoTransactionId,
                                'transactionAmount' => 20000,
                                'ticketNumber' => $candidat->numero_candidat,
                                'transactionDate' => now()->format('Y-m-d H:i:s'),
                                'qrCode' => $text
                            ];
                            // Return the ticket view with the data
                            return view('ticket_egcim', $data);

                        } elseif ($statusTrans->status === 'PENDING' ){
                            
                            $payment = new Payment();
                            $payment->candidat_concours_id = $candidat->id;
                            $payment->amount = $sumAPayer;
                            $payment->transaction_id = $momoTransactionId;
                            $payment->status = $statusTrans->status;
                            $payment->numero_mobile_money = $validatedData['numero_mobile_money'];
                            $payment->save();

                            $qr_code = [
                                'nom' => $candidat->nom,
                                'prenom' => $candidat->prenom,
                                'transactionId' => $momoTransactionId,
                                'numeroCandidature' => $candidat->numero_candidat,
                            ];
                            $text = implode(',', $qr_code);
                            // Add the QR code to the data array
                            $data = [
                                'candidat' => $candidat,
                                'momoTransactionId' => $momoTransactionId,
                                'transactionAmount' => 20000,
                                'ticketNumber' => $candidat->numero_candidat,
                                'transactionDate' => now()->format('Y-m-d H:i:s'),
                                'qrCode' => $text
                            ];
                            // Return the ticket view with the data
                            return view('ticket_egcim', $data);
                        }
                    }

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

    }

    function ticket(Request $request){
        $ticket_number = $request->input('id_transaction');
    
        $payment = Payment::where('ticket_number', $ticket_number)->firstOrFail();
    
        $candidat_concours = $payment->candidatConcours;
    
        // Access the fields from both tables as needed, e.g.:
        $qr_code = [
            'nom' => $candidat_concours,
            'prenom' => $payment->transaction_id,
            'transactionId' => $payment->amount,
            'numeroCandidature' => $payment->ticket_number,
        ];
        $text = implode(',', $qr_code);

        $data = [
            'candidat' => $candidat_concours,
            'momoTransactionId' => $payment->transaction_id,
            'transactionAmount' => $payment->amount,
            'ticketNumber' => $payment->ticket_number,
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
    
}
