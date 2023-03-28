<?php

namespace App\Http\Controllers;

use App\Models\candidat;
use App\Models\paiements;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = candidat::count();
        $totalMontant = DB::table('paiements')->sum('montant');
        $payments = paiements::count();
        $votants = paiements::distinct('votant_numero')->count('votant_numero');



        $widget = [
            'users' => $users,
            'totalMontant' => $totalMontant,
            'payments' => $payments,
            'votants' => $votants,
            //...
        ];

        return view('home', compact('widget'));
    }
}
