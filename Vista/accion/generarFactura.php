<?php
include_once "../../configuracion.php";

$datos = data_submitted();
// Creación del objeto de la clase heredada
$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);

// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"Ecomania");
$pdf->SetFont('Arial','B',10);
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Ecomania");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"Saavedra 72");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"299-5882989");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"unatiendaeco@gmail.com");

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(75);
$pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(75);
$pdf->Cell(5, $textypos, $datos['nombreCliente']." ".$datos['apellidoCliente']);
$pdf->setY(40);$pdf->setX(75);
$pdf->Cell(5, $textypos, $datos['direccionCliente']);
$pdf->setY(45);$pdf->setX(75);
$pdf->Cell(5, $textypos, $datos['telefonoCliente']);
$pdf->setY(50);$pdf->setX(75);
$pdf->Cell(5, $textypos, $datos['mailCliente']);

// Agregamos los datos de la factura
$pdf->SetFont('Arial', 'B', 10);    
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos,"FACTURA #".$datos['nroFactura']);
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Fecha: ".$datos['fechaFactura']);
$pdf->setY(40);$pdf->setX(135);
// $pdf->Cell(5,$textypos,"Vencimiento: -");
$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("Item", "Descripcion", "Cant.", "Precio", "Total");
//// Array de Productos
$products = array();
for($i=0;$i<count($datos['itemProducto']);$i++){
    $producto = array($datos['itemProducto'][$i], $datos['descProducto'][$i], $datos['cantidad'][$i], $datos['precio'][$i], 0);
    array_push($products, $producto);
}
    // Column widths
    $w = array(20, 95, 20, 25, 25);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
    $pdf->Ln();
    // Data
    $total = 0;
    foreach($products as $row)
    {
        $pdf->Cell($w[0],6,$row[0],1);
        $pdf->Cell($w[1],6,$row[1],1);
        $pdf->Cell($w[2],6,number_format($row[2]),'1',0,'R');
        $pdf->Cell($w[3],6,"$ ".number_format($row[3],2,".",","),'1',0,'R');
        $pdf->Cell($w[4],6,"$ ".number_format($row[3]*$row[2],2,".",","),'1',0,'R');

        $pdf->Ln();
        $total+=$row[3]*$row[2];

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 60 + (count($products)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
	array("Subtotal",$total),
	array("Descuento", 0),
	array("Impuesto", 0),
	array("Total", $total),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','B',10);    

$pdf->setY($yposdinamic);
$pdf->setX(10);
// $pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic+10);
$pdf->setX(10);
// $pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
$pdf->setY($yposdinamic+20);
$pdf->setX(10);


$pdf->output();

?>