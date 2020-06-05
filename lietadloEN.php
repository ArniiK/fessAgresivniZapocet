<?php

include 'inc/mysql_config.php';

if (isset($_GET['R'])) {
    $sql = "UPDATE statistika SET pristupy = pristupy + 1 WHERE id=4";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <?php

    if (isset($_GET['R'])) {

        echo "<script>

        $.ajax({
                    type: 'GET',
                    url: 'http://147.175.121.210:8038/final/restApi.php/kyvadlo?action=getDataLietadlo&r=" . $_GET['R'] . "&last=" .$_GET['last'] . "',
                    success: function (msg) {
                        console.log(msg);
                        handle(msg);                  
                    }
                });    
                        
           function handle(msg) {
                lastPos = [];    
                var arr = msg.split(\" \");       
                arr.pop();
                positions = [];
                angles = [];
                var pom=0;
                for(var i=0;i<arr.length;i++){
                    if(arr[i]==\"endOfPos\"){
                        pom=1;
                        continue;
                    }else if(arr[i]==\"endOfAng\"){
                        pom=2;
                        continue;
                    }
                    if(pom==0){
                        positions.push(arr[i]);
                    }else if(pom==1){
                        angles.push(arr[i]);
                    }else{
                        lastPos.push(arr[i]);
                    }
                } 
                
                $(document).ready(function() {
                    var  trace1 = {
                        x: [],
                        y: [],
                        type: 'scatter',
                        name: 'Tilt of plane',
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
                        name: 'Tilt of rear flap',
                        line: {
                            shape: 'spline',
                            smoothing: 1.3,
                            color: 'rgb(98, 157, 255)'
                        }
                    };
                
                    
                    var data = [ trace1,trace2];
                
                    var layout = {
                        title:'Tilting a plane',
                        xaxis: {
                            title: 'Time',
                            range: [0,200]
                        },
                        yaxis: {
                            title: 'Degree in rad'
                        },
                        legend:{
                            xanchor:\"center\",
                            yanchor:\"top\",
                            y:-0.3, // play with it
                            x:0.5   // play with it
                        }   
                    };
                    var config = {responsive: true};
                
                    
                    
                    Plotly.newPlot(graphDiv, data, layout,config);
                    
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
                    
                    var lastPositions = \"\";
                    for (var i=0;i<lastPos.length;i++) {
                        lastPositions = lastPositions + lastPos[i] + ':';
                        console.log(lastPos[i]);
                    }
                                       
                    document.getElementById(\"last\").value = lastPositions;                   
                });
                            
            } //konec handle             
                        
</script>";

    }

    ?>
    <title>Final project</title>
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
                    <li class="nav-item active">
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
                    <a class="nav-link offset-4 btn btn-dark col-xs-2" href="lietadlo.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link active btn btn-dark col-xs-2" href="lietadloEN.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">

        <h1 class="display-5">Tilt of plane</h1>
        <hr>
        <form action="lietadloEN.php" method="get">
            <div class="form-group form-row">
                <div class="col-md-4">
                    <label for="prikaz"><h3>Insert value</h3></label>
                    <input type="number" step="0.01" class="form-control form-control-lg" name="R" id="R" placeholder="R">
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
                    <input type="hidden" id="last" name="last" value="0">
                </div>
                <div class="col-1 mt-5">
                    <button type="submit" class="btn btn-outline-primary">Send</button>
                </div>
            </div>
        </form>

            <label for="graphDiv"><h3>Result</h3></label>
            <br>
            <div class="col-12" id="graphDiv" style="width: 100%;height:500px">
        </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</body>
</html>