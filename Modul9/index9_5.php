<?php

// Hente ut fpdf og fpdi
require_once ('fpdf/fpdf.php');
require_once ('fpdi/src/autoload.php');

// Lage nytt objekt for å bruke metodene
$pdf = new \setasign\Fpdi\Fpdi();

// Legg til en side i PDF-en
$pdf->addPage();

// Bruke fakturamal som kilde
$pdf->setSourceFile("Innlevering9_fakturamal.pdf");

//Hente ut 1 side fra malen
$fs = $pdf->importPage(1);

// Bruke malen
$pdf->useTemplate($fs);

// Bestemme font og størrelse. Times new roman størrelse 12.
$pdf->SetFont("Times", "", 12);

// Legge til bilde
$pdf->Image("uia-logo.png", 100, 40, 20);

//Bestemme hvor Y starter
$pdf->setY(45);

// Bestemme hvor navn på fakturamottaker skal stå. Samme på resten. Ikke noe veldig hokus pokus.
$pdf->setX(13);
$pdf->cell(100, 5, "Stu Dent", 0, 1, "L");

$pdf->setX(13);
$pdf->cell(100, 5, "Lundveien 30, Kristiansand", 0, 1, "L");

$pdf->setY(65);
$pdf->setX(95);
$pdf->cell(100, 5, "Universitet i Agder", 0, 1, "L");

$pdf->setY(88);
$pdf->setX(13);
$pdf->cell(90, 5, "Studering", 0, 0, "L");
$pdf->cell(90, 5, "50kr", 0, 1, "R");

$pdf->setY(107);
$pdf->setX(13);
$pdf->cell(90, 5, "", 0, 0, "L");
$pdf->cell(90, 5, "62,5kr", 0, 1, "R");

$pdf->setY(102);
$pdf->setX(13);
$pdf->cell(90, 5, "", 0, 0, "L");
$pdf->cell(90, 5, "12,5kr", 0, 1, "R");

$pdf->setY(187);
$pdf->cell(105, 5, "62,5kr", 0, 1, "R");

// PDF-filen som blir lagd heter Faktura.pdf
$pdf->output("Faktura.pdf", "I");
?>