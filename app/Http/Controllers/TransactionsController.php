<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionsController extends Controller
{
    //

    public function index()
    {
        return view('transactions.index');
    }

    public function store(Request $request){

        $file = $request->file('excel_file');
        $data = Excel::load($file, function($reader) {
            $reader->ignoreEmpty();
            $reader->skipRows(1);
        })->get();

        foreach($data as $row) {
            $transaction = new Transactions();
            $transaction->external_transaction_id = $row->external_transaction_id;
            $transaction->date = $row->date;
            $transaction->initiated_by = $row->initiated_by;
            $transaction->on_behalf_of = $row->on_behalf_of;
            $transaction->approved_by = $row->approved_by;
            $transaction->original_amount = $row->original_amount;
            $transaction->currency = $row->currency;
            $transaction->amount = $row->amount;
        

            $transaction->save();
        }

        return redirect()->back()->with('success', 'Candidat enregistré avec succès.');
    }

    public function create()
    {
        # code...

        return view('transactions.create');
    }
}
