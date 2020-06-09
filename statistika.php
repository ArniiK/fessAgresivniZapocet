<?php
include 'inc/mysql_config.php';

$sql = "SELECT * FROM statistika";
$result = $mysqli->query($sql);
$msg = "";
while ($obj = $result->fetch_object()) {
    $msg .= $obj->meno . " - " . $obj->pristupy . "\n";
}

if(isset($_POST['email']))
    $headers = "From: finalzadanie@example.com" . "\r\n" .
    "CC: " . $_POST['email'];
    mail($_POST['email'],"Štatistika",  $msg, $headers);
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
                    <li class="nav-item">
                        <a class="nav-link" href="prikazy.php">Príkazy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="statistika.php">Štatistika</a>
                    </li>
                </ul>

                <div class="row col-12">
                    <a class="nav-link offset-5 active btn btn-dark col-xs-2" href="statistika.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link btn btn-dark col-xs-2" href="statistikaEN.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">

        <h1 class="display-5">Štatistika</h1>
        <hr>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Stránka</th>
                <th scope="col">Počet návštev</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM statistika";
            $result = $mysqli->query($sql);
            while ($obj = $result->fetch_object()){
                echo "<tr>";
                echo "<td>$obj->meno</td>";
                echo "<td>$obj->pristupy</td>";
                echo "</tr>";
            }

            ?>
            </tbody>
        </table>
        <hr>

            <form action="statistika.php" method="post">
                <div class="form-group form-row">
                    <div class="col-md-10">
                        <label for="prikaz"><h2>Odoslanie</h2></label>
                        <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="E-mail" required>
                        <small id="emailHelp" class="form-text text-muted">Sem môžete zadat emailovú adresu kam poslať údaje</small>
                    </div>
                    <div class="col-1 mt-5">
                        <button type="submit" class="btn btn-outline-primary">Odoslať</button>
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