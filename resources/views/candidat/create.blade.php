@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Ajouter une election') }}</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Enregistrer Candidat</h4>
                </div>
                <form method="POST" action="{{ route('candidat.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="card bg-light mb-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-mobile-alt fa-3x"></i>
                                        <p class="text-muted mt-2">Ajouter une vidéo (30s max)</p>
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" id="video" name="video">
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-light mb-3">
                                    <div class="card-body text-center">
                                        <p class="text-muted mb-2">Ajouter une photo de profil</p>
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" id="photo" name="photo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <p class="text-black">Entrez vos informations pour devenir candidat:</p>
                                        <div class="form-group">
                                            <label for="nom">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom">
                                        </div>
                                        <div class="form-group">
                                            <label for="prenom">Prénom</label>
                                            <input type="text" class="form-control" id="prenom" name="prenom">
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Type</label>
                                            <div class="col-md-6">
                                                <select id="tel" class="form-control @error('tel') is-invalid @enderror" name="tel" required>
                                                    <!-- <option value="">-- Select Type --</option> -->
                                                    <option value="miss" @if(old('type')=='miss' ) selected @endif>Miss</option>
                                                    <option value="master" @if(old('type')=='master' ) selected @endif>Master</option>
                                                </select>

                                                @error('type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="etablissement">Etablissement</label>
                                            <select class="form-control" id="etablissement" name="etablissement">
                                                @foreach ($etablissements as $etablissement)
                                                <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="election">Election</label>
                                            <select class="form-control" id="election" name="election">
                                                @foreach ($elections as $election)
                                                <option value="{{ $election->id }}">{{ $election->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-block">Enregistrer Candidat</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection