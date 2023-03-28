@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Liste des elections') }}</h1>

    <div class="row justify-content-center">

    <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Liste des élections') }}</div>

                    <div class="card-body">
                        <a href="{{ route('election.create') }}" class="btn btn-primary mb-3">{{ __('Ajouter une élection') }}</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Titre') }}</th>
                                    <th scope="col">{{ __('Type') }}</th>
                                    <th scope="col">{{ __('Date debut') }}</th>
                                    <th scope="col">{{ __('Date Fin') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($elections as $election)
                                    <tr>
                                        <td>{{ $election->nom }}</td>
                                        <td>{{ $election->type }}</td>
                                        <td>{{ $election->date_debut }}</td>
                                        <td>{{ $election->date_fin }}</td>
                                        <td>
                                            
                                            <a href="{{ route('election.edit', $election) }}" class="btn btn-warning">{{ __('Modifier') }}</a>
                                            <form action="{{ route('election.edit', $election) }}" method="post" class="d-inline">
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
