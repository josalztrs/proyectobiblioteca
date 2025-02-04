<?php
include 'plantilla.php';
require '../php/connection.php';

$query = "SELECT 
    otrosmateriales.*, 
    materia.id AS materia_id, 
    materia.nombremateria AS nombremateria, 
    personas.carrera
FROM 
    otrosmateriales
INNER JOIN 
    materia ON otrosmateriales.area_conoc = materia.id
LEFT JOIN 
    personas ON personas.nombre = otrosmateriales.autor;";
$resultado = $conn->query($query);


$pdf = new PDF('L', 'mm', 'a4');

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 10, 'LISTADO DE LIBROS REGISTRADOS EN EL SISTEMA', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);

$pdf->SetFillColor(27, 40, 69);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', 1);
$pdf->Cell(70, 10, 'Titulo', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Autor', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Tutor', 1, 0, 'C', 1);
$pdf->Cell(10, 10, iconv('UTF-8','ISO-8859-1','Año'), 1, 0, 'C', 1);
$pdf->Cell(40,10, 'Area de Conocimiento',1,0,'C',1);
$pdf->Cell(50, 10, 'Tipo de Documento', 1, 0, 'C', 1);
$pdf->Cell(25, 10, 'Metodologia', 1, 0, 'C', 1);

$pdf->SetFont('Arial', '', 8);

while ($row = $resultado->fetch_assoc()){
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(255,255,255);
    $pdf->Ln();
    $pdf->Cell(10, 10, $row["id"], 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(70, 10, iconv('UTF-8', 'ISO-8859-1', $row['titulo']), 1, 0, 'C', 1);  
    $pdf->SetFont('Arial', '', 8); 
    $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $row['autor']), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1', $row['tutor']), 1, 0, 'C', 1);
    $pdf->Cell(10, 10, iconv('UTF-8', 'ISO-8859-1', $row['semestr_exp']), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', $row['nombremateria']), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', $row['tipo_metodologia']), 1, 0, 'C', 1);
    $pdf->Cell(25, 10, iconv('UTF-8', 'ISO-8859-1', $row['tipo']), 1, 0, 'C', 1);    
}
$pdf->Output('I', 'ListadoLibros.pdf');
?>