<?php
require('C:/xampp/htdocs/Proyectos/fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        
        $this->Image('C:/xampp/htdocs/Proyectos/python.png', 10, 10, 30);

        
        $this->Image('C:/xampp/htdocs/Proyectos/logo.png', 150, 10, 30);
        
        
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 40, 'Factura', 0, 1, 'C');
        
        
        $this->Line(10, 50, 200, 50);
    }

    function Footer() {
        
        $this->SetY(-30);
        
        $this->SetFont('Arial', 'I', 8);
        
        $this->SetTextColor(169, 169, 169);
        $this->Cell(0, 10, utf8_decode('Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una Modalidad de Facturación'), 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('en Línea'), 0, 0, 'C');
    }
}


$pdf = new PDF();
$pdf->AddPage();


$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('Código de Factura: ' . $id_transaccion ), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Código CUF: ' . $cuf ), 0, 1);
$pdf->Cell(0, 10, utf8_decode('NIT: ' . $nit ), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Dirección: Av América 1500'), 0, 1);
$pdf->Cell(0, 10, 'Nombre: ' . $nombre . ' ' . $apellido, 0, 1);
$pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1);


$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, utf8_decode('Descripción'), 1);
$pdf->Cell(50, 10, 'Precio Total', 1, 1);

$monto = $_POST['totalprice'];
echo $monto;
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, 10, 'Compra perfumes', 1);
$pdf->Cell(50, 10, $monto, 1, 1);




$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, 'Total', 1);
$pdf->Cell(50, 10, '$' . number_format($monto,2), 1, 1);



$nombreArchivoFactura = 'factura.pdf'; 
$pdf->Output($nombreArchivoFactura, 'F');

include 'enviar_email.php';

