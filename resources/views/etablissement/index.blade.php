@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Liste des etablissement') }}</h1>

    <div class="row justify-content-center">

    <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Liste des etablissements') }}</div>

                    <div class="card-body">
                        <a href="{{ route('etablissement.create') }}" class="btn btn-primary mb-3">{{ __('Ajouter une etablissement') }}</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Titre') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($etablissements as $etablissement)
                                    <tr>
                                        <td>{{ $etablissement->nom }}</td>
                                        
                                        <td>
                                            
                                            <a href="{{ route('etablissement.edit', $etablissement) }}" class="btn btn-warning">{{ __('Modifier') }}</a>
                                            <form action="{{ route('etablissement.edit', $etablissement) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Supprimer') }}</button>
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

@endsection
