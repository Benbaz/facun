@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div class="container">
  <div class="row justify-content-center">

    <div class="col-md-8">
      <img src="https://www.concours-egcim.cm/assets/concours/images/EGCIM-logo.png" alt="EGCIM Logo" style="width: 200px; height: auto; margin-bottom: 30px;">
      <h3>Rechercher et imprimer votre ticket</h3>
      <form method="POST" action="{{ route('candidatExamentController.ticket') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
          <div class="col-md-6 form-group">
            <label for="id_transaction" class="font-weight-bold text-uppercase">Transaction Id:</label>
            <div class="input-group">
              <input type="text" class="form-control" id="id_transaction" name="id_transaction" required>
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Ticket</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <div class="card shadow">
        <div class="card-header bg-warning text-center font-weight-bold text-uppercase">
          S'iniscrire au Concours d'entrée en EGCIM
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('candidatExamentController.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
              <div class="col-md-6 form-group">

                <label for="nom" class="font-weight-bold text-uppercase">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="prenom" class="font-weight-bold text-uppercase">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
              </div>
            </div>

            <div class="form-group">
              <label for="telephone" class="font-weight-bold text-uppercase">Téléphone:</label>
              <input type="phone" class="form-control" id="telephone" name="telephone" required>
            </div>

            <div class="form-row">
              <div class="col-md-6 form-group">

                <label for="date_naissance" class="font-weight-bold text-uppercase">Date de naisssance:</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
              </div>

              <div class="col-md-6 form-group">
                <label for="lieu_naissance" class="font-weight-bold text-uppercase">Lieu de naisssance:</label>
                <input type="input" class="form-control" id="lieu_naissance" name="lieu_naissance" required>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="anne_entree" class="font-weight-bold text-uppercase">Année d'entrée*</label>
                <select name="anne_entree" id="anne_entree" class="form-control" required onchange="getEntree();">
                  <option value="" disabled selected>Année d'entrée</option>
                  <option value="Premiere Annee">Première Année</option>
                  <option value="Troisieme Annee">Troisième Année</option>
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label for="centre_examen" class="font-weight-bold text-uppercase">Centre d'Examen choisie*</label>
                <select name="centre_examen" id="centre_examen" class="form-control" required>
                  <option value="" disabled selected>Centre</option>
                  <option value="Douala">Douala</option>
                  <option value="Yaoundé">Yaoundé</option>
                  <option value="Maroua">Maroua</option>
                  <option value="Bafoussam">Bafoussam</option>
                  <option value="Ngaoundere">Ngaoundere</option>
                </select>
              </div>
            </div>


            <button type="submit" class="btn btn-primary">Suivant</button>
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
        <p>Valider en acceptant la requete de retrait de 21000F. Tapez *126# (suivez la procedure jusqu'a la fin).</p>
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