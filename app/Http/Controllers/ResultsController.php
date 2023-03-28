<?php

namespace App\Http\Controllers;

use App\Models\candidat;
use App\Models\Etablissement;
use App\Models\elections;
use App\Http\Controllers\CandidatController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultsController extends Controller
{
    //
    public function index()
{
    // Récupérer toutes les élections terminées
    $electionResults = elections::where('date_fin', '<', Carbon::now())->get();
    
    // Récupérer les 5 candidats avec le score le plus élevé
    $candidats = DB::table('candidats')
    ->join('etablissements', 'candidats.etablissement_id', '=', 'etablissements.id')
    ->join('elections', 'candidats.election_id', '=', 'elections.id')
    ->join('votes', 'candidats.id', '=', 'votes.candidat_id')
    ->select(DB::raw('candidats.nom, candidats.prenom, candidats.photo, etablissements.nom as etablissement, SUM(votes.score) as score, (SUM(votes.score) / (SELECT SUM(votes.score) FROM votes WHERE election_id = candidats.election_id)) * 100 as pourcentage'))
    ->where('tel', '=', 'Miss')
    ->where('elections.date_fin', '<', Carbon::now())
    ->groupBy('candidats.id', 'candidats.nom', 'candidats.prenom', 'candidats.photo', 'etablissements.nom', 'candidats.election_id')
    ->orderBy('score', 'desc')
    ->take(5)
    ->get();
    // Calculer le pourcentage de votes pour chaque candidat
    $totalScore = $candidats->sum('score');
    foreach ($candidats as $candidate) {
        $candidate->pourcentage = ($candidate->score / $totalScore) * 100;
    }

    $candidatsMaster = DB::table('candidats')
    ->join('etablissements', 'candidats.etablissement_id', '=', 'etablissements.id')
    ->join('elections', 'candidats.election_id', '=', 'elections.id')
    ->join('votes', 'candidats.id', '=', 'votes.candidat_id')
    ->select(DB::raw('candidats.nom, candidats.prenom, candidats.photo, etablissements.nom as etablissement, SUM(votes.score) as score, (SUM(votes.score) / (SELECT SUM(votes.score) FROM votes WHERE election_id = candidats.election_id)) * 100 as pourcentage'))
    ->where('tel', '=', 'Master')
    ->where('elections.date_fin', '<', Carbon::now())
    ->groupBy('candidats.id', 'candidats.nom', 'candidats.prenom', 'candidats.photo', 'etablissements.nom', 'candidats.election_id')
    ->orderBy('score', 'desc')
    ->take(5)
    ->get();
    // Calculer le pourcentage de votes pour chaque candidat
    $totalScore = $candidatsMaster->sum('score');
    foreach ($candidatsMaster as $candidate) {
        $candidate->pourcentage = ($candidate->score / $totalScore) * 100;
    }
    
    return view('results', ['electionResults' => $electionResults, 'candidates' => $candidats, 'candidatesMaster' => $candidatsMaster]);
}

   
}
