<?php

include 'inc/mysql_config.php';


if (isset($_GET['prikaz'])) {
    $sql = "UPDATE statistika SET pristupy = pristupy + 1 WHERE id=5";
    $mysqli->query($sql);
}



?>

<!doctype html>
<html lang="sk">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <title>Záverečný projekt</title>
</head>
<body>
<nav>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Domov</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mr-3" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="kyvadlo.php">Kyvadlo <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gulicka.php">Gulička</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tlmic.php">Tlmič</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lietadlo.php">Lietadlo</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="prikazy.php">Príkazy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistika.php">Štatistika</a>
                    </li>
                </ul>

                <div class="row col-12">
                    <a class="nav-link offset-5 active btn btn- dark col-xs-2" href="prikazy.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link btn btn-dark col-xs-2" href="prikazyEN.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">

        <h1 class="display-5">Príkazy</h1>
        <hr>
        <form action="prikazy.php" method="get">
            <div class="form-group form-row">
                <div class="col-md-10">
                    <label for="prikaz"><h2>Zadaj príkaz</h2></label>
                    <input type="text" class="form-control form-control-lg" name="prikaz" id="prikaz" placeholder="Príkaz" required>
                    <small id="emailHelp" class="form-text text-muted">Sem môžete zadávať príkazy pre kompiláciu</small>
                </div>
                <div class="col-1 mt-5">
                    <button type="submit" class="btn btn-outline-primary">Skompilovať</button>
                </div>
            </div>
        </form>
        <div class="form-group">
            <label for="output"><h3>Výsledok</h3></label>
            <hr>
            <textarea class="form-control" id="output" name="output" rows="2" disabled></textarea>
        </div>


    </div>

</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</body>
</html>