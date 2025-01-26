<?php

require('./fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        require '../connection.php';
        
        $consulta_info = $conn->query("SELECT * FROM personas"); // Traemos datos de la empresa desde BD
        $dato_info = $consulta_info->fetch_object();
        $this->SetFont('Arial', 'B', 19); // Tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(45); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); // Color
        // Creamos una celda o fila
        $this->Cell(0, 10, 'UNIVERSIDAD NACIONAL EXPERIMENTAL DE LAS FUERZAS ARMADAS', 0, 1, 'C', 0); // AnchoCelda, AltoCelda, titulo, borde(1-0), saltoLinea(1-0), posicion(L-C-R), ColorFondo(1-0)
        $this->Ln(3); // Salto de línea
        $this->SetTextColor(103); // Color

        /* TITULO DE LA TABLA */
        // Color
        $this->SetTextColor(0, 0, 0);
        $this->Cell(50); // Mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, ("REGISTRO DE PERSONAS"), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        // Color
        $this->SetFillColor(228, 100, 0); // ColorFondo
        $this->SetTextColor(255, 255, 255); // ColorTexto
        $this->SetDrawColor(163, 163, 163); // ColorBorde
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(18, 10, ('N°'), 1, 0, 'C', 1);
        $this->Cell(20, 10, ('NÚMERO'), 1, 0, 'C', 1);
        $this->Cell(30, 10, ('TIPO'), 1, 0, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Output('I', 'Prueba.pdf');