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
            $transaction->status = $row->status;
            $transaction->type = $row->type;
            $transaction->to_message = $row->to_message;
            $transaction->from = $row->from;
            $transaction->from_name = $row->from_name;
            $transaction->from_handler_name = $row->from_handler_name;
            $transaction->to = $row->to;
            $transaction->to_name = $row->to_name;
            $transaction->to_handler_name = $row->to_handler_name;
            $transaction->initiated_by = $row->initiated_by;
            $transaction->on_behalf_of = $row->on_behalf_of;
            $transaction->approved_by = $row->approved_by;
            $transaction->original_amount = $row->original_amount;
            $transaction->currency = $row->currency;
            $transaction->amount = $row->amount;
            $transaction->external_amount = $row->external_amount;
            $transaction->external_currency = $row->external_currency;
            $transaction->external_fx_rate = $row->external_fx_rate;
            $transaction->external_service_provider = $row->external_service_provider;
            $transaction->fee = $row->fee;
            $transaction->fee_currency = $row->fee_currency;
            $transaction->discount = $row->discount;
            $transaction->discount_currency = $row->discount_currency;
            $transaction->promotion = $row->promotion;
            $transaction->promotion_currency = $row->promotion_currency;
            $transaction->coupon = $row->coupon;
            $transaction->coupon_currency = $row->coupon_currency;
            $transaction->balance = $row->balance;

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
