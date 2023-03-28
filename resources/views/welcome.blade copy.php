<!DOCTYPE html>
<html>
<head>
    <title>Votez pour votre candidat préféré !</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            padding-top: 5rem;
        }
        .card {
            border: none;
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
        }
        .card-footer {
            background-color: #fff;
        }
        .card-footer a {
            color: #fff;
        }
        .card-footer a:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-center my-5">Votez pour votre candidat préféré !</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">Candidats</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($candidats as $candidat)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $candidat->photo) }}" class="card-img-top" alt="{{ $candidat->nom }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $candidat->nom }} ({{ $candidat->etablissement->nom }})</h5>
                                            <p class="card-text">{{ $candidat->description }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="font-weight-bold">{{ $candidat->score }} votes</span>
                                                <a href="{{ route('vote', $candidat->id) }}" class="btn btn-primary">Voter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
