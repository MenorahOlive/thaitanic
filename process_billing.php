<?php
require('./assets/fpdf.php');
require("config.php");


$fetch_orders = mysqli_query($conn, "SELECT * FROM `totalorder` where id = ".$_POST['orderID']." ");
$orders = mysqli_fetch_assoc($fetch_orders);

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('pic.jpg',10,6,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(30,10,'Thai-Tanic Reciept',0,0,'C');
	// Line break
	$this->Ln(30);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Thank You','C');
}
}

// Instanciation of inherited class
$order =$orders['total_product'];
$ordersSplit = explode(",",$order);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',20);
$pdf->Cell(0,10,'Your Order: ',0,1);
$pdf->SetFont('Arial','B',15);
foreach($ordersSplit as $item){
    $pdf->Cell(40,10,$item);
	$pdf->Ln(10);
}

	$pdf->Cell(30);
	$pdf->Cell(40,10,'Total Cost:');
	$pdf->Cell(50);
	$pdf->Cell(40,10,"Ksh. ".$orders['total_price']);

    $sql = "UPDATE totalorder
    SET order_status = 2
    WHERE id = ".$_POST['orderID'];

    mysqli_query($conn,$sql);
    mysqli_close($conn);

$pdf->Output();
?>
