<?php

$servername = "localhost";
$username = "xsulhanekm";
$password = "indian_pucovala";

$mysqli = new mysqli($servername,$username,$password,"skuskovaDB");
$mysqli->set_charset("utf8");
if($mysqli -> connect_errno){
    echo "Nepodarilo sa pripojit ku databaze " . $mysqli->connect_error;
    exit();
}
?>

