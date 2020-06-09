<?php
include 'inc/mysql_config.php';

if (isset($_GET['R'])) {
    $sql = "UPDATE statistika SET pristupy = pristupy + 1 WHERE id=1";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.0.0-beta.12/fabric.min.js"> </script>
    <?php
    if (isset($_GET['R'])) {

    echo "<script>

        $.ajax({
            type: 'GET',
            url: 'http://147.175.121.210:8038/final/restApi.php/kyvadlo?action=getDataLietadlo&r=" . $_GET['R'] . "&last=" .$_GET['last'] . "&lastR=" .$_GET['lastR'] . "',
            success: function (msg) {
                console.log(msg);
                handle(msg);
            }
        });

        function handle(msg) {
            lastPos = [];
            lastRs = [];
            var arr = msg.split(\" \");       
            //arr.pop();
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
            }else if (arr[i]==\"endOfLastP\"){
                pom=3;
                continue;
            }
        
            if(pom==0){
                positions.push(arr[i]);
            }else if(pom==1){
                angles.push(arr[i]);
            }else if (pom==2){
                lastPos.push(arr[i]);
                }
            else {
                lastRs.push(arr[i]);
                }
            }
            
            
            
        $(document).ready(function() {
            var  trace1 = {
                x: [],
                y: [],
                type: 'scatter',
                name: 'Náklon lietadla',
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
                name: 'Náklon zadnej klapky',
                line: {
                    shape: 'spline',
                    smoothing: 1.3,
                    color: 'rgb(98, 157, 255)'
                }
            };


            var data = [ trace1,trace2];

            var layout = {
                title:'Náklon lietadla',
                xaxis: {
                    title: 'Čas',
                    range: [0,200]
                },
                yaxis: {
                    title: 'Uhol v rad'
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
            }

            document.getElementById(\"last\").value = lastPositions;    
            document.getElementById(\"lastR\").value = lastRs[0];  
            
            
                           
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
                     
            

            var pi = Math.PI;
            var lastDeg =  lastRs[1] * (180/pi);
            var currDeg = lastRs[0] * (180/pi);           
            var currFlapDeg = angles[200] * (180/pi);
            console.log(angles);
            console.log(currFlapDeg);
            var jetURL = 'icons/jet.png';
            var flapURL= 'icons/flap.png';
            
            var canvas = new fabric.Canvas('theCanvas',{
                    width: 1050,
                    height: 400
                });
           
            var jetImg = new Image();
            var flapImg = new Image();         
            jetImg.onload = function () {    
                var jet = new fabric.Image(jetImg, {
                    left: 200, 
                    top: 200,
                    scaleX: .50,
                    scaleY: .50,
                    originX: 'center',
                    originY: 'center' 
                });
               
                var flap = new fabric.Image(flapImg, {
                    left: 20, 
                    top: 170,
                    scaleX: .50,
                    scaleY: .50, 
                    originX: 'center',
                    originY: 'center' 
                });
                
                var group = new fabric.Group([ jet, flap ], {
                    angle: lastDeg,
                    originX: 'center',
                    originY: 'center' 
                });
                canvas.add(group);
         
                group.animate('angle', currDeg, {
                    duration: 2000,
                    onChange: canvas.renderAll.bind(canvas)
                } );  
              
                flap.animate('angle', currFlapDeg*10, {
                    duration: 2000,
                    onChange: canvas.renderAll.bind(canvas)
                } ) ;
                
              };
            jetImg.src = jetURL;
            flapImg.src = flapURL;
        } //konec handle             

    </script>";

    }

    else{
        echo "<script>
        $(document).ready(function(){
                    $(\"#graphDiv\").hide();
                    $(\"#graphLabel\").hide();
                    $(\"#animation\").hide();
                
            });
        </script>";
    }

    ?>
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
                        <a class="nav-link active" href="lietadlo.php">Lietadlo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="prikazy.php">Príkazy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistika.php">Štatistika</a>
                    </li>
                </ul>

                <div class="row col-12">
                    <a class="nav-link offset-5 active btn btn-dark col-xs-2" href="lietadlo.php"><i id="slovakiaIcon"></i></a>
                    <a class="nav-link btn btn-dark col-xs-2" href="lietadloEN.php"><i id="ukIcon"></i></a>
                </div>

            </div>
        </nav>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">

        <h1 class="display-5">Náklon lietadla</h1>
        <hr>
        <form action="lietadlo.php" method="get">
            <div class="form-group form-row">
                <div class="col-md-4">
                    <label for="prikaz"><h3>Zadajte príkaz</h3></label>
                    <input type="number" step="0.01" class="form-control form-control-lg" name="R" id="R" placeholder="R" required>
                    <small id="emailHelp" class="form-text text-muted">Sem zadajte vstupé R</small>
                </div>
                <div class="col-md-5 mt-5 ml-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" checked <?php echo isset($_GET['R']) ?  "" : "disabled";?>>
                        <label class="form-check-label" for="inlineCheckbox1">Graf</label>
                    </div>
                    <div class="form-check form-check-inline ml-5">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" checked <?php echo isset($_GET['R']) ?  "" : "disabled";?>>
                        <label class="form-check-label" for="inlineCheckbox2">Animácia</label>
                    </div>
                    <input type="hidden" id="last" name="last" value="0">
                    <input type="hidden" id="lastR" name="lastR" value="0">
                </div>
                <div class="col-1 mt-5">
                    <button type="submit" id='run' class="btn btn-outline-primary">Skompilovať</button>
                </div>
            </div>
        </form>

        <label for="graphDiv" id="graphLabel"><h3>Výsledok</h3></label>
        <br>
        <div class="col-12" id="graphDiv" style="width: 100%;height:500px"></div>



        <div id="animation" class="fabric-canvas-wrapper">
            <hr>
            <label for="animation"><h3>Animácia</h3></label><br>
            <canvas id="theCanvas"></canvas>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
        $("#inlineCheckbox1").click(function(){
            $("#graphDiv").toggle();
            $("#graphLabel").toggle();
        });
        $("#inlineCheckbox2").click(function(){
            $("#animation").toggle();
        });
    });
</script>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
</body>
</html>