@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<h1 class="h3 mb-4 text-gray-800">{{ __('Liste des Candidats au concours') }}</h1>

<div class="row justify-content-center">

    <div class="content container-fluid">
        <div class="container">
            <h1>Candidats</h1>
            <form action="{{ route('candidat_concours.filtre') }}" method="GET">
                <div class="form-group">
                    <label for="anne_entree">Année d'entrée:</label>
                    <input type="text" name="anne_entree" id="anne_entree" value="{{ request('anne_entree') }}">
                </div>
                <div class="form-group">
                    <label for="centre_examen">Centre d'examen:</label>
                    <input type="text" name="centre_examen" id="centre_examen" value="{{ request('centre_examen') }}">
                </div>
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </form>
            <div class="mb-3 mt-3">
                <a href="{{ route('candidat_concours.export.excel') }}" class="btn btn-success">Exporter en Excel</a>
                <a href="{{ route('candidat_concours.export.pdf') }}" class="btn btn-danger">Exporter en PDF</a>
            </div>
            <div class="table-responsive datatable-custom">
                <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}}">
                    <thead class="thead-light thead-50 text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Date de naissance</th>
                            <th>Lieu de naissance</th>
                            <th>Année d'entrée</th>
                            <th>Centre d'examen</th>
                            <th>Numéro mobile money</th>
                            <th>Statut de paiement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidats as $candidat)
                        <tr>
                            <td>{{ $candidat->id }}</td>
                            <td>{{ $candidat->nom }}</td>
                            <td>{{ $candidat->prenom }}</td>
                            <td>{{ $candidat->telephone }}</td>
                            <td>{{ $candidat->date_naissance }}</td>
                            <td>{{ $candidat->lieu_naissance }}</td>
                            <td>{{ $candidat->anne_entree }}</td>
                            <td>{{ $candidat->centre_examen }}</td>
                            <td>{{ $candidat->payment->numero_mobile_money }}</td>
                            <td>
                                <span class="badge text-success fz-12 px-0">
                                    {{ $candidat->payment->status }}
                                </span>
                            </td>
                            <td>action</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#candidat-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        });
    });
</script>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#candidat-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("candidat_concours.filtre") }}',
                data: function(d) {
                    d.anne_entree = $('#anne_entree').val();
                    d.centre_examen = $('#centre_examen').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nom',
                    name: 'nom'
                },
                {
                    data: 'prenom',
                    name: 'prenom'
                },
                {
                    data: 'telephone',
                    name: 'telephone'
                },
                {
                    data: 'date_naissance',
                    name: 'date_naissance'
                },
                {
                    data: 'lieu_naissance',
                    name: 'lieu_naissance'
                },
                {
                    data: 'anne_entree',
                    name: 'anne_entree'
                },
                {
                    data: 'centre_examen',
                    name: 'centre_examen'
                },
                {
                    data: 'numero_mobile_money',
                    name: 'numero_mobile_money'
                },
                {
                    data: 'payment_status',
                    name: 'payment.status'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        $('#anne_entree, #centre_examen').keyup(function() {
            table.draw();
        });
    });
</script>

@endsection