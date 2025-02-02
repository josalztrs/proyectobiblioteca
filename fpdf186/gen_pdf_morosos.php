<?php
include 'plantilla.php';
require '../php/connection.php';

$query =    "SELECT DISTINCT * FROM prestamos p
            INNER JOIN personas per ON p.cedula = per.cedula
            INNER JOIN libros lib ON p.cota = lib.cota
            WHERE p.estado = 'EN PRESTAMO'";
$resultado = $conn->query($query);


$pdf = new PDF('L', 'mm', 'a4');

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 10, 'LISTADO DE PERSONAS MOROSAS', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);

$pdf->SetFillColor(27, 40, 69);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Cota', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'C.I', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Fecha del Prestamo', 1, 0, 'C', 1);
$pdf->Cell(40,10, 'Fecha de Entrega',1,0,'C',1);
$pdf->Cell(40,10, 'Telefono',1,0,'C',1);
$pdf->Cell(55,10, 'Correo',1,0,'C',1);

$pdf->SetFont('Arial', '', 8);

while ($row = $resultado->fetch_assoc()){
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(255,255,255);
    $pdf->Ln();
    $pdf->Cell(10, 10, $row["id"], 1, 0, 'C', 1);
    $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $row['cota']), 1, 0, 'C', 1);   
    $pdf->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', $row['cedula']), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $row['nombre']), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $row['fecha_prestamo']), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $row['fecha_entrega']), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $row['telefono']), 1, 0, 'C', 1);
    $pdf->Cell(55, 10, iconv('UTF-8', 'ISO-8859-1', $row['correo']), 1, 0, 'C', 1);
    

}
$pdf->Output('I', 'ListadoLibros.pdf');
?>