
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
                    <li class="nav-item">
                        <a class="nav-link" href="prikazy.php">Príkazy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistika.php">Štatistika</a>
                    </li>
                </ul>

                <div class="row col-12">
                    <div class="col-lg-3 col-md-5 col-xl-5 col-5"></div>
                    <a class="nav-link active btn btn-dark col-xs-2" href="index.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link btn btn-dark col-xs-2" href="indexEn.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Slovenská verzia</h1>
        <hr class="my-4">

        <p>Popis Rest API:  </p>
        <p>Rest API umožňuje získavať dáta z CAS (Octave) do nami vytvoreného klientského prostredia pre každý model a samotné výsledky Octave príkazov.
        V každom z jednotlivých prostredí front-end umožňuje dynamicky zadať parameter, na základe ktorého nám Octave vráti údaje výpočtu, podľa ktorého vykresľujeme grafy a animácie.
        K API pristupujeme pomocou AJAX requestov, ktorého súčasťou sú: typ metódy, url, headers, v ktorom si posielame API kľúč, ktorý umožňuje prístup k API. Bez zadania API kľúča na stránke
            nieje možné používať API.
        </p>

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
                <th scope="row">Štruktúra API</th>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Štatistika</th>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
            </tr>
            <tr>
                <th scope="row">Logy</th>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Príkazy</th>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Kyvadlo</th>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Gulička</th>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Tlmič</th>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
            </tr>
            <tr>
                <th scope="row">Lietadlo</th>
                <td><input type="checkbox" checked disabled class="ml-5"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>


    <a href="testingTCPDF.php" class="btn btn-outline-primary">Generuj PDF logov</a>
    <a href="generatePDFPopis.php" class="btn btn-outline-primary">Generuj PDF popisu </a>
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