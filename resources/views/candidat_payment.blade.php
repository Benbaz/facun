@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
<div class="container">
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($message = Session::get('message'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@endif
  <div class="row justify-content-center">

    <div class="col-md-8">
    
      <div class="card shadow">
        <div class="card-header bg-warning text-center font-weight-bold text-uppercase">
          Faire le paiemnet des frais de concours d'entrée en EGCIM
        </div>
        <div class="card-body">
          <p>Nom: <b>{{$candidat->nom}}</b></p>
          <p>Prenom: <b>{{$candidat->prenom}}</b> </p>
          <p>Numero de votre candidature: <b>{{$candidat->numero_candidat}}</b> </p>
          <p>Filmez ou copier votre numero de candidature quelque part, en cas d'echec du paiement vous allez l'utiliser pour reessayer le paiement plus tard</b> </p>
          <form method="POST" action="{{ route('PaiementsController.store') }}">
            @csrf
            <input type="hidden" name="candidat_id" value="{{ $candidat->id }}">
            <input type="hidden" name="_numero_candidat" value="{{ $candidat->numero_candidat }}" readonly>

            <div class="form-group">
              <label for="numero_mobile_money" class="font-weight-bold text-uppercase">Entrez votre numero Mobile Money / Pay Via Mobile Money:</label>
              <div class="input-group">
                <span class="input-group-addon" id="payment-icon"></span>
                <input type="phone" class="form-control" name="numero_mobile_money" id="numero_mobile_money" required>
              </div>
              <small class="form-text text-muted">Frais de dossier 20000 Francs, coût de la transaction: 1000 F, Total: 21000 Franc CFA</small>

            </div>

            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#momo-modal">Effectuer le paiement</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="momo-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Transaction MOMO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Valider  en acceptant la requete de retrait de 21000F. Tapez *126# (suivez la procedure jusqu'a la fin).
          </p>
      </div>
    </div>
  </div>
</div>

@if(session()->has('showModal'))
<script>
  $(document).ready(function() {
    $('#momo-modal').modal('show');
  });
</script>
@endif

@endsection