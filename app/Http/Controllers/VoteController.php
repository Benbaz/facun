<?php

namespace App\Http\Controllers;

use App\Models\candidat;
use App\Models\vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    //

    public function create(candidat $candidat)
    {
        return view('vote.create', compact('candidat'));
    }

    public function store(Request $request, Candidat $candidat)
    {
        $request->validate([
            'votant' => 'required',
            'montant' => 'required|integer|min:200',
        ]);

        $score = $request->input('montant');

        // On crée un nouveau vote
        $vote = new vote();
        $vote->candidat_id = $candidat->id;
        $vote->votant = $request->input('votant');
        $vote->score = $score;
        $vote->save();

        // On met à jour le score du candidat
        $candidat->score += $score;
        $candidat->save();

        return redirect()->route('resultats.index')
            ->with('success', 'Votre vote a été enregistré avec succès!');
    }
}
