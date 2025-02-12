<?php
require'fpdf.php';
class PDF extends FPDF{
        
    function Header()
    {
        $this->Image('../imagenes/logo-unefa.png', 10, 8, 15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, 'REPUBLICA BOLIVARIANA DE VENEZUELA', 0, 1, 'C');
        $this->Cell(0, 5, 'MINISTERIO DEL PODER POPULAR PARA LA DEFENSA', 0, 1, 'C');
        $this->Cell(0, 5, 'UNIVERSIDAD NACIONAL EXPERIMENTAL DE LAS FUERZAS ARMADAS', 0, 1, 'C');
        $this->Cell(0, 5, 'NUCLEO NUEVA ESPARTA', 0, 1, 'C');
        $this->Cell(0, 5, 'BIBLIOTECA LUIS BELTRAN PRIETO FIGUEROA', 0, 1, 'C');

    }
    function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10,'Juan Griego, Estado Nueva Esparta. Fecha:'.date('d-m-Y'), 0, 0, 'C');
            $this->Ln(5);
            $this->Cell(0, 10, 'Pagina '.$this->PageNo(), 0, 0, 'C');

        }
}
