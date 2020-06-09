<?php

require_once("tcpdfgenerator/tcpdf.php");
include 'inc/mysql_config.php';


$pdf = new TCPDF('p', 'mm', 'A4');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();
//$pdf->Cell(190,10,"this is a cell",0,1,'C');
//$pdf->WriteHTMLCell(100,0,'70','',"<h1 class='centered'> Popis REST API  </h1>",0,1);
$pdf->WriteHTMLCell(150, 0, '30', '', "        <p>Rest API umožňuje získavať dáta z CAS (Octave) do nami vytvoreného klientského prostredia pre každý model a samotné výsledky Octave príkazov.
        V každom z jednotlivých prostredí front-end umožňuje dynamicky zadať parameter, na základe ktorého nám Octave vráti údaje výpočtu, podľa ktorého vykresľujeme grafy a animácie.
        K API pristupujeme pomocou AJAX requestov, ktorého súčasťou sú: typ metódy, url, headers, v ktorom si posielame API kľúč, ktorý umožňuje prístup k API. Bez zadania API kľúča na stránke
            nieje možné používať API.
        </p>", 0, 1);
//$pdf->Write(30, "DATUM                                                    " . "TYP                               " . "Prikaz                        " . "INFO", '', '', "", 2, 1);
//$pdf->Cell(190,10,"this is a cell",0,1,'C');
//$pdf->Cell(20,10,"",0,0);
//$pdf->Write(50,0,'','',"<h2> Adding another Content</h2>",2,1);
//$sql = "Select * from log";
//
//$result = $mysqli->query($sql);
//while ($row = $result->fetch_assoc()) {
//
//    $datum = $row["datum"];
//    $typ = $row["typ"];
//    $command = $row["command"];
//    $info = $row["info"];
////    $pdf -> Cell(20,10,$datum . $typ . $command,0,0);
//    $pdf->Write(10, "DATUM:  " . $datum . "                TYP:  " . $typ . "                 Prikaz: " . $command . "                INFO:  " . $info, '', '', "", 2, 1);
//
//}
//$pdf->Cell(20);
ob_end_clean();
$pdf->Output();

?>
