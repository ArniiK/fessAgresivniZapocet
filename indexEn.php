<?php

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
                    <li class="nav-item">
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
                    <a class="nav-link offset-4 btn btn-dark col-xs-2" href="index.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link active btn btn-dark col-xs-2" href="indexEn.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">English version!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">

        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <hr>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Peter Kopúň</th>
                <th scope="col">Marek Kravčišin</th>
                <th scope="col">Arne Michalov</th>
                <th scope="col">Marek Šulhánek</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Front-end</th>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
            </tr>
            <tr>
                <th scope="row">PDF</th>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">E-mail</th>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Api-key</th>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Git-hub</th>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">API structure</th>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Statistics</th>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
            </tr>
            <tr>
                <th scope="row">Logs</th>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Commands</th>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th scope="row">Pendulum</th>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Ball</th>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Suspension</th>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
            </tr>
            <tr>
                <th scope="row">Plane</th>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

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