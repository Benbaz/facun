<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title>Ticket</title>
    <style>
        /* Styles for the ticket container */
        .ticket-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50%;
            width: 100%;
            margin: 50px auto;
            background-color: #fff;
            border: 2px solid #1b499b;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }

        /* Styles for the left section of the ticket */
        .ticket-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 50%;
            border-right: 2px solid #1b499b;
            padding: 20px;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        /* Styles for the right section of the ticket */
        .ticket-right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 50%;
            padding: 20px;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }

        /* Styles for the ticket header */
        .ticket-header {
            margin: 0;
            font-size: 24px;
            color: #1b499b;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Logo image */
        .ticket-header img {
            height: 50px;
            margin-right: 10px;
        }

        /* Styles for the ticket code */
        .ticket-code {
            margin: 10px 0;
            font-size: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div class="ticket-left">
            <p>Date: <b>{{ date('d/m/Y H:i:s') }} </b></p>
            <p>Amount: <b>{{ $transactionAmount }} XAF</b></p>
            <p>Candidate: <b>{{ $candidat->nom }} {{ $candidat->prenom }}</b></p>
            <p>frais Concours: <b> {{ $candidat->anne_entree }}</b></p>
            <p>Etablissement: <b>EGCIM Université de Ngaoundéré</b></p>
            <p>Transaction ID: {{ $momoTransactionId }}</p>
        </div>
        <div class="ticket-right">
            <h2 class="ticket-header">
                <img src="https://www.concours-egcim.cm/assets/concours/images/EGCIM-logo.png" alt="Logo">
                Frais de Concours EGCIM Par MOMO
            </h2><p><b>Reçus de L'EGCIM!</b></p>
            <p>Numero Candidat: <b>{{ $ticketNumber }}</b></p>
            <div class="card-body">
                {!! QrCode::size(100)->generate($qrCode) !!}
            </div>
        </div>
    </div>

    <div class="ticket-container">
        <div class="ticket-left">
            <p>Date: <b>{{ date('d/m/Y H:i:s') }} </b></p>
            <p>Amount: <b>{{ $transactionAmount }} XAF</b></p>
            <p>Candidate: <b>{{ $candidat->nom }} {{ $candidat->prenom }}</b></p>
            <p>Frais Concours: <b> {{ $candidat->anne_entree }}</b></p>
            <p>Etablissement: <b>EGCIM Université de Ngaoundéré</b></p>
            <p>Transaction ID: {{ $momoTransactionId }}</p>
        </div>
        <div class="ticket-right">
            <h2 class="ticket-header">
                <img src="https://www.concours-egcim.cm/assets/concours/images/EGCIM-logo.png" alt="Logo">
                Frais de Concours EGCIM Par MOMO
            </h2>
            <p><b>Reçus du Candidat</b></p>
            <p>Numero Candidat: <b>{{ $ticketNumber }}</b></p>
            <div class="card-body">
                {!! QrCode::size(100)->generate($qrCode) !!}
            </div>
        </div>
    </div>

    <button class="btn btn-primary" onclick="printTicket()">Print Ticket</button>

    <script>
        function printTicket() {
            window.print();
        }
    </script>
</body>

</html>