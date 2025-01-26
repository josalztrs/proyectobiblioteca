<?php
include 'plantilla.php';
require '../connection.php';

$query = "SELECT * FROM personas";
$resultado = $conn->query($query);

$pdf = new PDF('L', 'mm', 'a4');

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetFillColor(27, 40, 69);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Cedula', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Telefono', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Correo', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Tipo', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Cargo', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Carrera', 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'Direccion', 1, 0, 'C', 1);

$pdf->SetFont('Arial', '', 8);

while ($row = $resultado->fetch_assoc()){
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(288,288,288);
    $pdf->Ln();
    $pdf->Cell(20, 10, $row["id"], 1, 0, 'C', 1);
    $pdf->Cell(40, 10, $row['nombre'], 1, 0, 'C', 1);   
    $pdf->Cell(20, 10, $row['cedula'], 1, 0, 'C', 1);
    $pdf->Cell(20, 10, $row['telefono'], 1, 0, 'C', 1);
    $pdf->Cell(40, 10, $row['correo'], 1, 0, 'C', 1);
    $pdf->Cell(20, 10, $row['tipo'], 1, 0, 'C', 1);
    $pdf->Cell(40, 10, $row['cargo'], 1, 0, 'C', 1);    
    $pdf->Cell(20, 10, $row['carrera'], 1, 0, 'C', 1);
    $pdf->Cell(55, 10, $row['direccion'], 1, 0, 'C', 1);

}
$pdf->Output('I', 'Prueba.pdf');
?>