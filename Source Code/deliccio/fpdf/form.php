<?php
include ("../dbconnection.php");
require('../fpdf/fpdf.php');

	class PDF extends FPDF
	{
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,''.$this->PageNo(),0,0,'C');
		}
		

	}

if (!isset($_REQUEST["pid"]))
{
	header("Location : ../index.php");
}

else
{
	$pid = $_REQUEST["pid"];
	$sql = "SELECT * FROM purchase p 
	INNER JOIN purchase_item pi ON p.purchase_id = pi.purchase_id 
	INNER JOIN member mem ON p.member_id = mem.member_id 
	INNER JOIN menu m ON pi.menu_id = m.menu_id 
	WHERE pi.purchase_id = $pid ";
	$result = mysqli_query($conn, $sql);
	
	if($result)
	{
		$row = mysqli_fetch_assoc($result);
		
		$pdf=new PDF('P','mm','A4');
		$pdf->SetFont("Arial","B",14);
		$pdf->AddPage();
		$pdf->Ln();
		$pdf->Cell(70,70,$pdf->Image("../images/logo2.png",10,10,50,50));;
		$pdf->Ln();
		$pdf->Cell(130,5,'LUNAR CAFE',0,0);
		$pdf->Cell(59,5,'INVOICE',0,1);

		$pdf->SetFont("Arial",'',12);
		$pdf->Cell(130,5, 'Address : BBU 4, Taman Bukit Beruang' ,0,0);
		$pdf->Cell(59,5,'',0,1);

		$pdf->Cell(130,5,'State : ' . $row['purchase_delivery_state'],0,0);
		$pdf->Cell(25,5,'Date :',0,0);
		$pdf->Cell(34,5, $row['purchase_date'] ,0,1);


		$pdf->Cell(130,5,'Handphone: +6012-9231301' ,0,0);
		$pdf->Cell(25,5,'Invoice # :',0,0);
		$pdf->Cell(34,5, $row['purchase_id'] ,0,1);

		$pdf->Cell(25,5,'E-mail: lunarcafe123@gmail.com',0,0);

		$pdf->Cell(189,10,'',0,1);
		
		$pdf->SetFont("Arial","",30);
		$pdf->Cell(10,20,'-----------------------------------------------------',0,1);
	
		$pdf->SetFont("Arial",'',12);
		$pdf->Cell(100,5,'Bill to',0,1);

		//add dummy cell at beginning of each line for indentation
		$pdf->Cell(10,5,'',0,0);
		$pdf->Cell(90,5, 'Customer ID : ' . $row['member_id'] ,0,1);
		
		$pdf->Cell(10,5,'',0,0);
		$pdf->Cell(90,5, 'Customer Name : ' . $row['member_name'] ,0,1);
		
		$pdf->Cell(10,5,'',0,0);
		$pdf->Cell(90,5, $row['member_contact'] ,0,1);

		$pdf->Cell(10,5,'',0,0);
		$pdf->Cell(90,5, $row['purchase_delivery_address'] ,0,1);

		$pdf->Cell(10,5,'',0,0);
		$pdf->Cell(90,5, $row['member_contact'] ,0,1);

		//invoice contents
		$pdf->SetFont('Arial','B',12);

		$pdf->Cell(10,5,'No.',1,0);
		$pdf->Cell(120,5,'Description',1,0);
		$pdf->Cell(10,5,'Qty',1,0);
		$pdf->Cell(25,5,'Unit Price',1,0);
		$pdf->Cell(34,5,'Amount',1,1);//end of line

		$pdf->SetFont('Arial','',12);

		//Numbers are right-aligned so we give 'R' after new line parameter
		
		$i=0;
		
		$sql3 = "SELECT * FROM purchase_item pi INNER JOIN menu m ON pi.menu_id = m.menu_id WHERE pi.purchase_id = $pid";
		$result3 = mysqli_query($conn, $sql3);
		$gtotal = 0;
		while($row3 = mysqli_fetch_assoc($result3))
		{
			$pdf->Cell(10,5, $i+1 ,1,0);
			$pdf->Cell(120,5, $row3['menu_name'] . " - " . $row3['purchase_item_details'],1,0);
			$pdf->Cell(10,5, $row3['purchase_item_quantity'] ,1,0);
			$pdf->Cell(25,5, number_format((float)$row3['menu_price'], 2, '.', '') ,1,0);
			$pdf->Cell(34,5, number_format((float)$row3['purchase_item_total'], 2, '.', '') ,1,1,'R');//end of line
			$gtotal += $row3['purchase_item_total'];
			$i++;
		}

		//summary


		$pdf->Cell(130,5,'',0,0);
		$pdf->Cell(25,5,'Subtotal',1,0);
		$pdf->Cell(10,5,'RM',1,0);
		$pdf->Cell(34,5, number_format((float)$gtotal, 2, '.', '') ,1,1,'R');//end of line

		$sql4 = "SELECT * FROM purchase p INNER JOIN gst g ON p.gst_id = g.gst_id WHERE p.purchase_id = $pid";
		$result4 = mysqli_query($conn, $sql4);
		$row4 = mysqli_fetch_assoc($result4);
		$pdf->Cell(130,5,'',0,0);
		$gst = $gtotal * $row4['gst_value']/100;
		$pdf->Cell(25,5,'GST ' . $row4['gst_value'] . '%',1,0);
		$pdf->Cell(10,5, 'RM',1,0);
		$pdf->Cell(34,5, number_format((float)$gst, 2, '.', ''),1,1,'R');//end of line

		$pdf->Cell(130,5,'',0,0);
		$pdf->Cell(25,5,'Total Due',1,0);
		$td = $gtotal + $gst;
		$pdf->Cell(10,5,'RM ',1,0);
		$pdf->Cell(34,5, number_format((float)$td, 2, '.', '') ,1,1,'R');//end of line
		
		$pdf->SetFont("Arial","",30);

		$pdf->Cell(10,20,'-----------------------------------------------------',0,1);

		$pdf->Cell(142,5,'Receipt Total',0,0);
		
		$sql2 = "SELECT * FROM purchase p INNER JOIN member m ON p.member_id = m.member_id WHERE p.purchase_id = $pid";
		$result2 = mysqli_query($conn, $sql2);
		$total = 0;
		while($row2 = mysqli_fetch_assoc($result2))
		{
			$total += $row2['purchase_amount'];
		}
		$pdf->Cell(34,5, 'RM ' .  number_format((float)$td, 2, '.', '') ,0,1);

		$pdf->Cell(10,20,'-----------------------------------------------------',0,1);

		$pdf->output();
	}
	
	unset ($_SESSION['time']);
	unset ($_SESSION['memid']);
}
?>