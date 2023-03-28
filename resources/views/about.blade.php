@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('paramètres') }}</h1>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow mb-4">

            <form action="{{ route('about.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="valeur_voix">valeur d'une voix en Franc CFA</label>
                    <input type="text" class="form-control" id="valeur_voix" name="valeur_voix" placeholder="la nouvelle valeur d'une voix en Franc CFA" value="{{ $valeur->valeur }}">
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>

        </div>


    </div>

</div>

@endsection