<?php
include 'plantilla.php';
require '../php/connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula-buscar'] ?? '';
    $query = "SELECT p.*, COUNT(pr.cedula) AS total_ent
              FROM personas p
              LEFT JOIN prestamos pr ON p.cedula = pr.cedula
              WHERE p.cedula = ?
              GROUP BY p.cedula;";

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("MySQL prepare error: " . $conn->error);
    }

    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $resultado = $stmt->get_result();
}
$pdf = new PDF('L', 'mm', 'a4');

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 10, 'EXPEDIENTE DE PERSONA', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);

$pdf->SetFillColor(27, 40, 69);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Cedula', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Telefono', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Correo', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Tipo', 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'Cantidad Libros Prestados', 1, 0, 'C', 1);

$pdf->SetFont('Arial', '', 8);

while ($row = $resultado->fetch_assoc()){
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFillColor(288,288,288);
    $pdf->Ln();
    $pdf->Cell(10, 10, $row["id"], 1, 0, 'C', 1);
    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', $row['nombre']), 1, 0, 'C', 1);   
    $pdf->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', $row['cedula']), 1, 0, 'C', 1);
    $pdf->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', $row['telefono']), 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', $row['correo']), 1, 0, 'C', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(20, 10, iconv('UTF-8', 'ISO-8859-1', $row['tipo']), 1, 0, 'C', 1);
    $pdf->Cell(55, 10, iconv('UTF-8', 'ISO-8859-1', $row['total_ent']), 1, 0, 'C', 1);

}
$pdf->Output('I', 'ListadoPersonas.pdf');
?>