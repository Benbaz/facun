@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-warning text-center">Concours d'entrée en EGCIM</div>
        <div class="card-body">
          <form method="POST" action="{{ route('candidatExamentController.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="nom">Nom:</label>
              <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom:</label>
              <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
              <label for="telephone">Téléphone:</label>
              <input type="phone" class="form-control" id="telephone" name="telephone" required>
            </div>
            <div class="form-group">
              <label for="fiche">Fiche individuelle:</label>
              <input type="file" class="form-control-file" id="fiche" name="fiche" required>
              <small class="form-text text-muted">Télécharger la fiche individuelle dûment remplie à partir du site web: www.concours-egcim.cm et la timbrer à 1000 FCFA.</small>
            </div>
            <div class="form-group">
              <label for="acte">Acte de naissance:</label>
              <input type="file" class="form-control-file" id="acte" name="acte" required>
              <small class="form-text text-muted">Joindre une photocopie certifiée conforme de l'acte de naissance datant de moins de trois (03) mois.</small>
            </div>
            <div class="form-group">
              <label for="diplome">Diplôme:</label>
              <input type="file" class="form-control-file" id="diplome" name="diplome" required>
              <small class="form-text text-muted">Joindre une photocopie certifiée conforme du diplôme ouvrant droit au concours.</small>
            </div>
            <div class="form-group">
              <label for="certificat">Certificat médical / :</label>
              <input type="file" class="form-control-file" id="certificat" name="certificat" required>
              <small class="form-text text-muted">Joindre un certificat médical délivré par un médecin fonctionnaire datant de moins de trois (03) mois.</small>
            </div>
            <div class="form-group">
              <label for="address_envelope">Enveloppe timbrée / </label>
              <input type="file" class="form-control-file" id="address_envelope" name="address_envelope" placeholder="Adresse du candidat">
              <small class="form-text text-muted">Joindre une enveloppe de grand format timbrée à 1500 FCFA et portant au recto l\’adresse du candidat.</small>
            </div>

            <div class="form-group">
              <label for="numero_mobile_money">Payer via votre numero Mobile Money / Pay Via Mobile Money:</label>
              <div class="input-group">
                <span class="input-group-addon" id="payment-icon"></span>
                <input type="phone" class="form-control" name="numero_mobile_money" id="numero_mobile_money" required>
              </div>
              <small class="form-text text-muted">Frais de dossier 20000 Francs, coût de la transaction: 1000 F, Total: 21000 Franc CFA</small>
              
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const mobileMoneyInput = document.getElementById('numero_mobile_money');
  mobileMoneyInput.addEventListener('keyup', displayMobileMoneyIcon);

  function displayMobileMoneyIcon() {
    const phoneNumber = this.value;
    const orangePattern = /^(6|7)[5-9]\d{7}$/;
    const mtnPattern = /^(6|7)[0-4]\d{7}$/;

    const mobileMoneyIcon = document.getElementById('mobile-money-icon');
    if (orangePattern.test(phoneNumber)) {
      mobileMoneyIcon.innerHTML = '<i class="fab fa-orange"></i>';
    } else if (mtnPattern.test(phoneNumber)) {
      mobileMoneyIcon.innerHTML = '<i class="fab fa-mtn"></i>';
    } else {
      mobileMoneyIcon.innerHTML = '';
    }
  }
</script>
@endsection