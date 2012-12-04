<?php
session_start();
require('fpdf.php');
$tweet10 = $_POST['tweets'];

class PDF extends FPDF {


function Header() {
    $this->SetFont('Times','',12);
    $this->SetY(0.25);
    $this->Cell(0, .25, "rtTimelineApp ".$this->PageNo(), 'T', 2, "R");
    //reset Y
    $this->SetY(1);
}



}

//class instantiation
$pdf=new PDF("P","in","Letter");

$pdf->SetMargins(1,1,1);

$pdf->AddPage();
$pdf->SetFont('Times','',10);


$pdf->SetFillColor(240, 100, 100);
$pdf->SetFont('Times','BU',12);

//Cell(float w[,float h[,string txt[,mixed border[,
//int ln[,string align[,boolean fill[,mixed link]]]]]]])
$pdf->Cell(0, .25, "Your Tweets ! Go to Page 2", 1, 2, "C", 1);

$pdf->SetFont('Times','',10);
//MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
$pdf->MultiCell(0, 0.5, $lipsum1, 'LR', "L");
$pdf->MultiCell(0, 0.25, $lipsum2, 1, "R");
$pdf->MultiCell(0, 0.15, $lipsum3, 'B', "J");

$pdf->AddPage();
$pdf->Write(0.5, $tweet10);
$pdf ->Output();


?>
