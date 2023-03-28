<?php

namespace App\Http\Controllers;

use App\Models\candidat;
use App\Models\Etablissement;
use App\Models\elections;
use App\Http\Controllers\CandidatController;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    //
    public function index()
{
    $type = 'Miss';
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
}


   
}
