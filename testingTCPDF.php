<?php
require_once ("tcpdfgenerator/tcpdf.php");

$pdf = new TCPDF('p','mm','A4');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf-> AddPage();
//$pdf->Cell(190,10,"this is a cell",0,1,'C');
$pdf->WriteHTMLCell(100,0,'70','',"<h1 class='centered'> Popis REST API  </h1>",0,1);
//$pdf->Cell(190,10,"this is a cell",0,1,'C');
$pdf->Cell(20,10,"",0,0);
$pdf->Write(50,0,'','',"<h2> Adding another Content</h2>",2,1);
//$pdf->Cell(20);
$pdf->Output();
echo "hello";


//$pdf->AddPage();


// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true);


// create some HTML content
//$html = '<h1>HTML Example</h1>';
//pdf->