<?php

namespace App\Http\Controllers;

use App\Models\elections;
use Illuminate\Http\Request;

class ElectionsController extends Controller
{
    //

    public function index()
    {
        $elections = elections::all();
        return view('election.index', compact('elections'));
    }

    public function create()
    {
        return view('election.create');
    }

    public function edit($id)
    {
        $election = elections::findOrFail($id);
        return view('election.edit', compact('election'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:miss,master',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Create a new election instance with the validated data
        $election = new elections([
            'nom' => $validatedData['title'],
            'type' => $validatedData['type'],
            'date_debut' => $validatedData['start_date'],
            'date_fin' => $validatedData['end_date'],
        ]);

        // Save the election to the database
        $election->save();

        // Redirect the user to the election index page
        return redirect()->route('election.index');
    }
}
