<?php

namespace App\Http\Controllers;

use App\Models\etablissement;
use Illuminate\Http\Request;

class EtablissementController extends Controller
{
    //

    public function index()
    {
        $etablissements = etablissement::all();
        return view('etablissement.index', compact('etablissements'));
    }

    public function create()
    {
        return view('etablissement.create');
    }

    public function edit($id)
    {
        $etablissement = etablissement::findOrFail($id);
        return view('etablissement.edit', compact('etablissement'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Create a new etablissement instance with the validated data
        $etablissement = new etablissement([
            'nom' => $validatedData['title'],

        ]);

        // Save the election to the database
        $etablissement->save();

        // Redirect the user to the election index page
        return redirect()->route('etablissement.index');
    }
}
