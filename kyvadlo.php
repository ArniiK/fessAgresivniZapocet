<?php
if (isset($_GET['R'])) {
    session_start();
    $positions = [];
    $angles = [];

    $positions = $_SESSION['pos'];
    $angles = $_SESSION['ang'];
}
else{
    $positions = [];
    $angles = [];
    $_SESSION['pos'] = [];
    $_SESSION['ang'] = [];
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <?php

    if (isset($_GET['R'])) {
        echo "<script>
        $.ajax({
                    type: 'GET',
                    url: 'http://147.175.121.210:8038/skuska/restApi.php/kyvadlo?action=getDataKyvadlo&r=" . $_GET['R'] . "',
                    success: function (msg) {
                        $(\"#output1\").html(msg);
                    }
                });           
</script>";

    }

    ?>

    <title>Záverečný projekt</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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
                    <li class="nav-item active">
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
                </ul>

                <div class="row col-12">
                    <a class="nav-link offset-6 active btn btn-dark col-xs-2" href="kyvadlo.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link btn btn-dark col-xs-2" href="kyvadloEN.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">

        <h1 class="display-5">Gulička na tyči</h1>
        <hr>
        <form action="kyvadlo.php" method="get">
            <div class="form-group form-row">
                <div class="col-md-4">
                    <label for="prikaz"><h3>Zadajte príkaz</h3></label>
                    <input type="number" step="0.01" class="form-control form-control-lg" name="R" id="R" placeholder="R" required>
                    <small id="emailHelp" class="form-text text-muted">Sem zadajte vstupé R</small>
                </div>
                <div class="col-md-5 mt-5 ml-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Graf</label>
                    </div>
                    <div class="form-check form-check-inline ml-5">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Animácia</label>
                    </div>
                </div>
                <div class="col-1 mt-5">
                    <button type="submit" class="btn btn-outline-primary">Skompilovať</button>
                </div>
            </div>
        </form>
        <div class="col-12" id="graphDiv" style="width:1000px;height:600px;">

        </div>

    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
<script>
    var positions = <?=json_encode($positions)?>;
    var angles = <?=json_encode($angles)?>;

    var ypole = [];
    for(var j=0;j<=200;j++){
        ypole[j] = j;
    }
    var  trace1 = {
        x: [],
        y: [],
        type: 'scatter',
        name: 'poloha kyvadla',
        line: {
            shape: 'spline',
            smoothing: 1.3,
            color: 'rgb(255, 98, 157)'
        }
    };

    var  trace2 = {
        x: [],
        y: [],
        type: 'scatter',
        name: 'uhol kyvadlovej tyče',
        line: {
            shape: 'spline',
            smoothing: 1.3,
            color: 'rgb(98, 157, 255)'
        }
    };


    var data = [ trace1,trace2];

    var layout = {
        title:'Kyvadlo',
        xaxis: {
            title: 'Čas',
            range: [0,200]
        },
        yaxis: {
            title: 'R',
            range: [<?=json_encode( "-0.4,0.4")?>]
        },
        legend:{
            xanchor:"center",
            yanchor:"top",
            y:-0.3, // play with it
            x:0.5   // play with it
        }
    };

    Plotly.newPlot(graphDiv, data, layout);

    var cnt = 0;
    var iterator = 1;
    var interval = setInterval(function() {

        var update = {
            x: [[iterator], [iterator]],
            y: [[positions[iterator]], [angles[iterator]]]
        };


        Plotly.extendTraces('graphDiv', update, [0,1]);
        cnt++;
        iterator++;

        if(cnt === 200) clearInterval(interval);
    }, 10);


</script>>
</body>
</html>