<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
    <style>
        .ticket {
            width: 300px;
            background-color: #fff;
            border: 2px solid #f9a825;
            padding: 20px;
            font-size: 16px;
            font-family: Arial, sans-serif;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }

        .ticket h2 {
            margin-top: 0;
            font-size: 24px;
            color: #f9a825;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .ticket p {
            margin: 10px 0;
        }

        .ticket .code {
            font-size: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h2>Ticket</h2>
        <p>{{ $candidat->nom }} Vous remercie de votre soutient!</p>
        <p>Date: {{ date('d/m/Y H:i:s') }}</p>
        <p>Amount: {{ $transactionAmount }} XAF</p>
        <p>Candidate: {{ $candidat->nom }}</p>
        <p>Election: Miss & Master</p>
        <p>Etablissement: Université de Ngaoundéré</p>
        <p>Transaction ID: {{ $momoTransactionId }}</p>
        <p class="code">
        <div class="col-md-12">
            <p>&copy; {{ date('Y') }} Design and create by OOREDOO. All rights reserved.</p>
        </div>
        </p>
    </div>

    <button class="btn btn-primary" onclick="printTicket()">Print Ticket</button>
    

    <script>
        function printTicket() {
            window.print();
        }
    </script>

</body>

</html>