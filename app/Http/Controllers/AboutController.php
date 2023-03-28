<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{

    public function index()
    {
        $valeur = DB::table('settings')->first();
    
        return view('about', compact('valeur'));
    }


    public function update(Request $request)
    {
        DB::table('settings')->where('id', 1)->update(['valeur' => $request->input('valeur_voix')]);

        return redirect()->back()->with('success', 'La valeur a été mise à jour.');
    }



   
}
