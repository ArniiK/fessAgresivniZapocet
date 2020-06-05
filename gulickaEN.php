<?php

include 'inc/mysql_config.php';

if (isset($_GET['prikaz'])) {
    $sql = "UPDATE statistika SET pristupy = pristupy + 1 WHERE id=2";
    $mysqli->query($sql);
}

?>

<!doctype html>
<html lang="en">
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
            <a class="navbar-brand" href="indexEn.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mr-3" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="kyvadloEN.php">Pendulum</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="gulickaEN.php">Ball</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tlmicEN.php">Suspension</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lietadloEN.php">Plane</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="prikazyEN.php">Commands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistikaEN.php">Statistics</a>
                    </li>
                </ul>

                <div class="row col-12 ml-4">
                    <a class="nav-link offset-4 btn btn-dark col-xs-2" href="gulicka.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link active btn btn-dark col-xs-2" href="gulickaEN.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">

        <h1 class="display-5">Gulička na tyči</h1>
        <hr>
        <form action="gulickaEN.php" method="get">
            <div class="form-group form-row">
                <div class="col-md-4">
                    <label for="prikaz"><h3>Insert value</h3></label>
                    <input type="text" class="form-control form-control-lg" name="prikaz" id="prikaz" placeholder="R">
                    <small id="emailHelp" class="form-text text-muted">Insert R here</small>
                </div>
                <div class="col-md-5 mt-5 ml-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Chart</label>
                    </div>
                    <div class="form-check form-check-inline ml-5">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Animation</label>
                    </div>
                </div>
                <div class="col-1 mt-5">
                    <button type="submit" class="btn btn-outline-primary">Send</button>
                </div>
            </div>
        </form>


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