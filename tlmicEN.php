<?php

include 'inc/mysql_config.php';

if (isset($_GET['prikaz'])) {
    $sql = "UPDATE statistika SET pristupy = pristupy + 1 WHERE id=3";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.0.0-beta.12/fabric.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <?php

    if (isset($_GET['R'])) {
        echo "<script>

        $.ajax({
                    type: 'GET',
                    url: 'http://147.175.121.210:8067/skuskoveZadanie/restApi.php/tlmic?action=getDataTlmic&r=" . $_GET['R'] . "&last=" .$_GET['last'] . "',
                    success: function (msg) {
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
                        name: 'Wheel positon',
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
                        name: 'Body positon',
                        line: {
                            shape: 'spline',
                            smoothing: 1.3,
                            color: 'rgb(98, 157, 255)'
                        }
                    };
                
                    
                    var data = [ trace1,trace2];
                
                    var layout = {
                        title:'Car suspension',
                        xaxis: {
                            title: 'Time',
                            range: [0,500]
                        },
                        yaxis: {
                            title: 'R',
                            
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
            
                        if(cnt === 500) clearInterval(interval);
                    }, 10);
                    
                    var lastPositions = \"\";
                    for (var i=0;i<lastPos.length;i++) {
                        lastPositions = lastPositions + lastPos[i] + ':';
                        console.log(lastPos[i]);
                    }
                    
                    
                    document.getElementById(\"last\").value = lastPositions;
                     console.log('Last after: ' + document.getElementById(\"last\"));
                    
                    
                });
                     
                     function resizeCanvas() {
                        const outerCanvasContainer = $('.fabric-canvas-wrapper')[0];
    
                        const ratio = canvas.getWidth() / canvas.getHeight();
                        const containerWidth   = outerCanvasContainer.clientWidth;
                        const containerHeight  = outerCanvasContainer.clientHeight;

                        const scale = containerWidth / canvas.getWidth();
                        const zoom  = canvas.getZoom() * scale;
                        canvas.setDimensions({width: containerWidth, height: containerWidth / ratio});
                        canvas.setViewportTransform([zoom, 0, 0, zoom, 0, 0]);
                    }

                $(window).resize(resizeCanvas);
                     
                var autoURL = 'icons/auto.png';
                var kolesaURL = 'icons/kolesa.png';
                var canvas = new fabric.Canvas('theCanvas',{
                    width: 1050,
                    height: 400
                });

                var autoImg = new Image();
                var kolesaImg = new Image();
                kolesaImg.src = kolesaURL;
                autoImg.src = autoURL;
                
                autoImg.onload = function (img) {    
                var auto = new fabric.Image(autoImg, {
                        left: 100,
                        top: 10,
                        scaleX: .50,
                        scaleY: .50
                });
                canvas.add(auto);
                };
                
                kolesaImg.onload = function(img){
                var kolesa = new fabric.Image(kolesaImg,{
                        left: 100,
                        top: 10,
                        scaleX: .50,
                        scaleY: .50
                });  
                canvas.add(kolesa);
                console.log(positions);
                
                for(var i=0;i<positions.length;i++){
                    
                    kolesa.animate('top', + (100*positions[i]),{
                        duration: 1000,
                        onChange: canvas.renderAll.bind(canvas)
                });
                        
                }
                
                };  
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
                    <li class="nav-item active">
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
                    <a class="nav-link offset-4 btn btn-dark col-xs-2" href="tlmic.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link active btn btn-dark col-xs-2" href="tlmicEN.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">

        <h1 class="display-5">Car suspension</h1>
        <hr>
        <form action="tlmicEN.php" method="get">
            <div class="form-group form-row">
                <div class="col-md-4">
                    <label for="prikaz"><h3>Insert R</h3></label>
                    <input type="number" step="0.01" class="form-control form-control-lg" name="R" id="R" placeholder="R" required>
                    <small id="emailHelp" class="form-text text-muted">Place R value here</small>
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
        <div id="graphDiv"></div>

        <hr>
        <label for="animation"><h3>Animation</h3></label><br>
        <div id="animation" class="fabric-canvas-wrapper">
            <canvas id="theCanvas"></canvas>
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