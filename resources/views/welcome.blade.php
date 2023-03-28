<!DOCTYPE html>
<html lang="en">

<head>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Miss &amp; Master Ngaoundéré</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    /* body {
            background-image: url('https://i.ibb.co/ZGrnkSc/beauty-pageant.jpg');
            background-size: cover;
            background-position: center;
        } */

    /* .card {
      margin-bottom: 20px;
      border: none;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.2);
      transition: box-shadow 0.3s ease-in-out;
      border-radius: 5px;
    }

    .card:hover {
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
    } */

    .card .card-img-top {
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      height: 200px;
      object-fit: cover;
    }

    .card .card-body {
      padding: 15px;
    }

    .card .card-title {
      font-size: 1.2rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .card .card-text {
      font-size: 0.9rem;
      color: #6c757d;
      margin-bottom: 10px;
    }

    .card .card-footer {
      background-color: white;
      border-top: none;
      padding: 15px;
    }

    .card .btn-primary {
      background-color: #f5c200;
      border-color: #f5c200;
    }

    .card .btn-primary:hover {
      background-color: #f0b400;
      border-color: #f0b400;
    }

    /* .candidat-body {
      width: 100%;
    } */

    /* .row.candidats {
      display: flex;
      flex-wrap: wrap;
      margin-left: -15px;
      margin-right: -15px;
    }

    .col-md-4.candidat {
      padding: 0 15px;
      margin-bottom: 30px;
      max-width: 33.3333%;
      flex-basis: 33.3333%;
    } */

    #head {
      position: absolute;
      height: 100px;
    }

    #head::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      /* background-image: url("img/background.png"); */
      background-size: cover;
      background-position: center center;
      /* filter: blur(3px); */
      z-index: -1;

    }

    #videoContainer {
      position: relative;
      padding-bottom: 10%;
      /* 16:9 aspect ratio */
      position: relative;
    }

    #videoContainer iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    #ban {
      position: absolute;
      top: 0;
      left: 0;
      width: 90%;
      height: 10%;
    }


    #videoContainer video {
      max-width: 100%;
      height: auto;
    }

    .card-img-container {
      position: relative;
      overflow: hidden;
      height: 200px;
      border-radius: 10px;
    }

    .card-img-top {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: all 0.3s ease;
    }

    .card:hover .card-img-top {
      transform: scale(1.1);
      filter: brightness(0.7);
    }

    .banner {
      height: 60%;
      /* background-image: url('background.jpg'); */
      background-size: cover;
      background-position: center;
      color: #fff;
      padding-top: 30px;
      width: 100%;
      align-items: center;
      position: relative;
    }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Add the Bootstrap JavaScript library for additional functionality -->
  
</head>

<body id="candidat_body">

  <script>
    $(document).ready(function() {
      // Listen for changes in the form fields
      $('#nom_filter, #etablissement_filter, #election_filter, #type_filter').on('change', function() {
        // Get the form data
        var formData = {
          nom: $('#nom_filter').val(),
          etablissement_id: $('#etablissement_filter').val(),
          election_id: $('#election_filter').val(),
          type: $('#type_filter').val()
        };

        // Send an AJAX request to the server to get the updated list of candidates
        $.ajax({
          type: 'GET',
          url: '{{ route('candidat.filter') }}',
          data: formData,
          success: function(response) {
            // Replace the existing list of candidates with the updated list
            $('#candidat_body').html(response);
            // location.reload();
          },
          error: function() {
            alert('Une erreur est survenue');
          }
        });
      });
    });

  </script>

  <!-- header -->
  <header class="bg-warning">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">FACUN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('results') }}">Resultats</a>
            </li>
            <li class="nav-item">
              <!-- <a class="nav-link" href="{{ route('candidat_exament') }}">Judges</a> -->
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li> -->
          </ul>
        </div>
      </nav>
    </div>
  </header>



  <!-- header -->
  

  <div class="container mt-4">

  <!-- <div class="container mt-8" id="head">
    <div class="row">
      <div class="col-md-8 offset-md-2 text-center">
        <h1 class="text-white font-weight-bold mb-4">Miss &amp; Master Université de Ngaoundéré</h1>
      </div>

      <img src="{{ asset('img/background.png') }}" />
    </div>
  </div> -->
  <div class="row">
      
  <div class="banner">
		<img src="{{ asset('img/background.png') }}" alt="Banner Image" class="img-fluid">
	</div> 
  </div>
  <!-- <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /> -->
  <br />
  @if(session('error'))
   <div class="alert alert-danger">
      {{ session('error') }}
   </div>
@endif
    <p>
    <h3 class="text-center text-black font-weight-bold mb-4">Liste des candidats en compétition</h3>
  </p>
    <form action="" class="form-inline mb-4 d-flex justify-content-center align-items-center">
      @csrf
      <div class="form-group mr-2">
        <label for="etablissement_filter" class="mr-2"><i class="fas fa-university"></i> Établissement</label>
        <select class="form-control" id="etablissement_filter">
          @foreach ($etablissements as $etablissement)
          <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group mr-2">
        <label for="election_filter" class="mr-2"><i class="fas fa-flag"></i> Élection</label>
        <select class="form-control" id="election_filter">
          @foreach ($elections as $election)
          <option value="{{ $election->id }}">{{ $election->nom }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group mr-2">
        <label for="type_filter" class="mr-2"><i class="fas fa-graduation-cap"></i> Type</label>
        <select class="form-control" id="type_filter">
          <option value="{{$type}}">{{$type}}</option>
          @if($type == 'Master')
          <option value="Miss">Miss</option>
          @endif
          @if($type == 'Miss')
          <option value="Master">Master</option>
          @endif
        </select>
      </div>
    </form>

    <div class="row justify-content-center" id="candidat">
      @foreach($candidats as $candidat)
      <div class="col-md-4 col-sm-6 col-lg-3 mb-4 candidat">
        <div class="card h-100 border-0 shadow-sm">
          <div class="card-img-container">
            <a href="#" data-toggle="modal" data-target="#imageModal" data-candidat-nom="{{ $candidat->nom }}" data-image-src="{{ asset('candidat/photos/' . $candidat->photo) }}">
              <img src="{{ asset('candidat/photos/' . $candidat->photo) }}" class="card-img-top" alt="{{ $candidat->nom }}">
            </a>
          </div>
          <div class="card-body d-flex flex-column justify-content-between">
            <h5 class="card-title text-center mt-3">{{ $candidat->nom." ".$candidat->prenom }}</h5>
            <p class="card-text text-center">{{ $candidat->etablissement->nom }}</p>
            <p class="card-text text-center font-weight-bold">Score: <b>{{ $candidat->votes_count > 0 ? $candidat->votes_count.' votes' : 'aucun vote' }} </b></p>
            <p class="card-text text-center font-weight-bold">Type: {{ $candidat->tel }}</p>
            <div class="text-center mb-3">
              @if ($candidat->election && $candidat->election->date_fin < today()) <button class="btn btn-light btn-lg font-weight-bold disabled">Voter</button>
                @else
                <a href="#" class="btn btn-warning font-weight-bold mr-2" data-toggle="modal" data-target="#voterModal" data-candidatid="{{ $candidat->id }}" data-candidatnom="{{ $candidat->nom }}">Voter</a>
                @endif
                <!-- <a href="#" class="btn btn-info font-weight-bold" data-toggle="modal" data-target="#videoCandidatModal" data-candidatid="{{ $candidat->id }}">Voir la vidéo</a> -->
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- <div class="text-center">
      <button class="btn btn-primary btn-lg" onclick="window.print()">Imprimer</button>
    </div> -->
  </div>




  <!-- display the candidat picture in a modal -->

  <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img src="" class="img-fluid mx-auto d-block" alt="">
        </div>
      </div>
    </div>
  </div>

  <!-- interface de vote -->

  <div class="modal fade" id="voterModal" tabindex="-1" role="dialog" aria-labelledby="voterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title" id="voterModalLabel">Voter pour / Vote for: <span id="candidatNom"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('voter', ['id' => '__candidat_id__']) }}" method="post" id="voterForm">
          @csrf
          <div class="modal-body">
            <p>Une voix côute {{$voteValue->valeur}} FCFA, donc un transaction de 1000 FCFA équivaut <b>{{1000/$voteValue->valeur}} voix.</b> / A vote costs XAF {{$voteValue->valeur}}, so a transaction of XAF 1000 is equivalent to <b>{{1000/$voteValue->valeur}} votes. </b></p>
            <p>Faites une transaction au numéro <b>677777777</b> du montant correspondant au nombre de voix pour votre candidat / Make a transaction to the number <b>677777777</b> for the amount corresponding to the number of votes for your candidate. </p>
            <p>Une fois la transaction effectuée, copiez la <b>Transaction Id</b> que vous avez reçu dans le sms de confirmation et coller dans la case ci-dessous. / Once the transaction is completed, copy the <b>Transaction Id</b> that you received in the confirmation sms and paste in the box below.</p>
            <div class="form-group">
              <label for="numero_momo">Entrer la transaction Id / Enter the Transaction Id</label>
              <input type="text" class="form-control" id="numero_momo" name="numero_momo" required>
            </div>
            <p class="text-danger">NB: <b>Toute transaction de moins de {{$voteValue->valeur}} FCFA sera ignorée et non remboursable. / Any transaction under XAF {{$voteValue->valeur}} will be ignored and non-refundable.</b>.</p>
            <div class="form-group bg-error">
              <!-- <label for="nombre_voix">Nombre de voix que vous lui donnez</label> -->
              <input type="hidden" class="form-control" id="nombre_voix" name="nombre_voix" value="1" min="1" onchange="updateTotal()">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Voter</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function updateTotal() {
      var voteValue = {{$voteValue->valeur}};
      var nombreVoix = document.getElementById("nombre_voix").value;
      var total = voteValue * nombreVoix;
      document.getElementById("total").innerHTML = total;
    }
  </script>



  <!-- vu pour afficher la video du candiat-->
  @if(isset($candidat))
  <div class="modal fade" id="videoCandidatModal" tabindex="-1" role="dialog" aria-labelledby="videoCandidatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="videoCandidatModalLabel">Vidéo de <span id="candidatNom"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="videoContainer"></div>
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- Your HTML code -->
  @if(session('showModal'))
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
          <p>Valider votre vote en acceptant Tapanp *126# (suivez la procedure jusqu'a la fin).
            Après la validation vous verrez 200 points ajouter au score de votre candidat préféré!!!</p>
        </div>
      </div>
    </div>
  </div>
  @endif
  <!-- Your HTML code -->
  <!-- jQuery (required) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap CSS (required) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">

  <!-- Bootstrap JavaScript (required) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

  @if(isset($candidat))
  <script>
    //pour la video
    $('#videoCandidatModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var candidatId = button.data('candidatid');
      var modal = $(this);
      modal.find('#candidatNom').text(button.closest('.card').find('.card-title').text());
      modal.find('#videoContainer').html('<video src="' + '{{ asset('
        candidat / videos / ' . $candidat->video) }}' + '" controls></video>');
    });

    $('#videoCandidatModal').on('hidden.bs.modal', function() {
      var video = $('#videoContainer').find('video')[0];
      video.pause();
    });
  </script>
  @endif
  <script>
    // display candidate picture 
    $(function() {
      $('#imageModal').on('show.bs.modal', function(event) {
        var trigger = $(event.relatedTarget);
        var title = trigger.data('candidat-nom');
        var imageSrc = trigger.data('image-src');
        var modal = $(this);
        modal.find('.modal-title').text(title);
        modal.find('img').attr('src', imageSrc);
      });
    });
    // voterModal
    // $('#voterModal').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget);
    //     var candidatId = button.data('candidatid');
    //     var candidatNom = button.data('candidatnom');
    //     var modal = $(this);
    //     modal.find('#candidatNom').text(candidatNom);
    //     modal.find('#voterForm').attr('action', '{{ route("voter", ":id") }}'.replace(':id', candidatId));
    // });
    $('#voterModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var candidatId = button.data('candidatid');
      var candidatNom = button.data('candidatnom');
      var modal = $(this);
      modal.find('#candidatNom').text(candidatNom);
      modal.find('#voterForm').attr('action', '{{ route("voter", ":id") }}'.replace(':id', candidatId));
      modal.find('#voterForm').attr('action', function(i, val) {
        return val.replace('__candidat_id__', candidatId);
      });
    });

    // $(document).ready(function() {
    //   // Check if the flag is set to display the modal
    //   @if(session('showModal'))
    //   $('#momo-modal').modal('show');
    //   // Start the countdown timer
    //   var countDown = 30;
    //   var timer = setInterval(function() {
    //     countDown--;
    //     if (countDown == 0) {
    //       clearInterval(timer);
    //       // Close the modal view after the timer is up
    //       $('#momo-modal').modal('hide');

    //       // Call the retry method of CandidatController
    //       $.ajax({
    //         type: 'GET',
    //         url: '{{ route('candidat.retry') }}',
    //         data: {
    //           // Add any data you want to pass to the retry method
    //         },
    //         success: function(response) {
    //           // Handle the response from the server
    //         },
    //         error: function(xhr) {
    //           // Handle any errors that occur during the AJAX request
    //         }
    //       });
    //     }
    //   }, 1000);
    //   @endif
    // });
  </script>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>&copy; {{ date('Y') }} Design and create by OOREDOO. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
</body>

</html>