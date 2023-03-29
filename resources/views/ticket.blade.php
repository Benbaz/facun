<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Ticket</title>
    <style>
        .ticket {
            width: 500px;
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
        .ticket img {
            text-align: center;
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
        <center>
        <img src="{{ asset('candidat/photos/' . $candidat->photo) }}" alt="Photo de {{ $candidat->nom }} {{ $candidat->prenom }}" width="100" height="100">
        </center>
        <p><b>{{ $candidat->nom }} {{ $candidat->prenom }}</b> Vous remercie de votre soutient!</p>
        <p>Date: {{ date('d/m/Y H:i:s') }}</p>
        <p>Candidat: {{ $candidat->nom }} {{ $candidat->prenom }}</p>
        <p>Evènement: FACUN élection Miss & Master de l'université de Ngaoundéré</p>
        <p><b>Jeux universitaire organisé par l'université de Ngaoundéré </b></p>
        <!-- <p>Transaction ID: {{ $momoTransactionId }}</p> -->
        <p class="code">
        <div class="col-md-12">
            <p>&copy; {{ date('Y') }} create by OOREDOO. All rights reserved.</p>
        </div>
        </p>
    </div>

    <button class="btn btn-primary" onclick="printTicket()">Print Ticket</button>
    <br /> <br />
    <a href="{{ url('/') }}" class="btn btn-warning font-weight-bold mr-2" >Retour a l'accuille / Back to home</a>

    <script>
        function printTicket() {
            window.print();
        }
    </script>

</body>

</html>