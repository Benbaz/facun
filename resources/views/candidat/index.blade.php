@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Liste des Candidats') }}</h1>

<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Liste des Candidats') }}</div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Âge</th>
                                <th>Sexe</th>
                                <th>Établissement</th>
                                <th>Élection</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidats as $candidat)
                            <tr>
                                <td><img src="{{ asset($candidat->photo_path) }}" alt="{{ $candidat->nom }}"></td>
                                <td>{{ $candidat->nom }}</td>
                                <td>{{ $candidat->prenom }}</td>
                                <td>{{ $candidat->age }}</td>
                                <td>{{ $candidat->sexe }}</td>
                                <td>{{ $candidat->etablissement->nom }}</td>
                                <td>{{ $candidat->election->nom }}</td>
                                <td>
                                    <form action="#" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection