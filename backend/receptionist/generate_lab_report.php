<?php
include('assets/inc/config.php');

require('../fpdf/fpdf.php');


// class PDF extends FPDF {
//     // Table header
//     function HeaderTable($header, $widths,$cellHeight) {
//         // Set font
//         $this->SetFont('Arial', 'B', 12);
//         // Header
//         for($i = 0; $i < count($header); $i++) {
//             $this->Cell($widths[$i], $cellHeight, $header[$i], 1, 0, 'C');
//         }
//         $this->Ln();
//     }

  
//     function ContentTable($data, $widths,$cellHeight) {
//         // Set font
//         $this->SetFont('Arial', '', 12);
//         // Data
//         foreach($data as $row) {
//             // Start a new row
//             $this->Cell(0, 10, '', 0, 1); // Move to the next row
//             // Output each column separately
//             for($i = 0; $i < count($row); $i++) {
//                 // Save the current position
//                 $xPos = $this->GetX();
//                 $yPos = $this->GetY();
//                 // Output the content with automatic line breaks
//                 $this->MultiCell($widths[$i], $cellHeight, $row[$i], 1);
//                 // Reset the position for the next column
//                 $this->SetXY($xPos + $widths[$i] ,$yPos);
//             }
//         }
//     }
// }

// // Create a PDF instance
// $pdf = new PDF();
// $pdf->AddPage();

// // Table data
// $header = array('Name', 'City', 'Country');
// $data = array(
//     array('John Doe', 'New York', 'UohnsonRobert JohnsonRobert JohnsonRobert JohnsonRobert JohnsoSA'),
//     array('Jane Smith', 'LohnsonRobert JohnsonRobert JohnsonRobert JohnsonRobert Johnsoondon', 'UK'),
//     array('Robert JohnsonRobert JohnsonRobert JohnsonRobert JohnsonRobert JohnsonRobert Johnson', 'PaohnsonRobert JohnsonRobert JohnsonRobert JohnsonRobert JohnsoohnsonRobert JohnsonRobert JohnsonRobert JohnsonRobert Johnsoris', 'France')
// );
// // Set column widths
// $widths = array(60, 60, 60);
// $cellHeight=10;
// // Generate table
// $pdf->HeaderTable($header, $widths,$cellHeight);
// $pdf->ContentTable($data, $widths,$cellHeight);


$pdf = new FPDF('p' ,'mm','A4');

$pdf->AddPage();

$lab_id=$_GET['lab_id'];
$lab_number=$_GET['lab_number'];
$ret="SELECT  * FROM his_laboratory WHERE lab_id = ?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$lab_id);
$stmt->execute() ;
$res=$stmt->get_result();
$row = $res->fetch_assoc();
$pdf->SetFont('Arial','B',16);		

$pdf->Cell(71,10,'',0,0);
$pdf->Cell(59,5,'Lab Report',0,0);
$pdf->Cell(50,10,'',0,1);

$pdf->SetFont('Arial','',10);		
$pdf->Cell(71,10,'',0,0);
$pdf->Cell(59,5,'',0,0);
$pdf->Cell(50,10,'',0,1);

$pdf->SetFont('Arial','',12);		
$pdf->Cell(20,5,'Lab ID : ',0,0);
$pdf->Cell(95,5,$row['lab_number'],0,0);
$pdf->Cell(25,5,'Patient Id :',0,0);
$pdf->Cell(34,5,$row['lab_pat_number'],0,1);

$pdf->SetFont('Arial','',12);		
$pdf->Cell(35,5,'Patient Name :',0,0);
$pdf->Cell(95,5,$row['lab_pat_name'],0,0);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(34,5,'',0,1);

$pdf->SetFont('Arial','',12);		
$pdf->Cell(35,5,'Lab Test Date :',0,0);
$pdf->Cell(95,5,$row['lab_date_rec'],0,0);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(34,5,'',0,1);

$pdf->SetFont('Arial','',10);		
$pdf->Cell(71,10,'',0,0);
$pdf->Cell(59,5,'',0,0);
$pdf->Cell(50,10,'',0,1);

$pdf->SetFont('Arial','B',10);	
$pdf->Cell(70,6,'Test',1,0,'C');
$pdf->Cell(40,6,'Result',1,0,'C');
$pdf->Cell(40,6,'Unit',1,0,'C');
$pdf->Cell(40,6,'Ref. Range',1,1,'C');

$pdf->SetFont('Arial','',10);	
$pdf->SetX(10); 
// $pdf->SetY(40); 
$pdf->MultiCell(70,6,$row['lab_pat_tests'],1,"R",false);
$pdf->SetY(61); 
$pdf->SetX($pdf->GetX() + 70);
$pdf->MultiCell(40,6,$row['lab_pat_results'],1,"R",false);
$pdf->SetY(61); 
$pdf->SetX($pdf->GetX() + 110);
$pdf->MultiCell(40,6,$row['lab_pat_number'],1,"R",false);
$pdf->SetY(61); 
$pdf->SetX($pdf->GetX() + 150);
$pdf->MultiCell(40,6,$row['lab_pat_number'],1,"R",false);



// $pdf->SetX(50); // abscissa of Horizontal position 
// $pdf->MultiCell(100,10,'AlignAlignment = RDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignmement = LDemo About MultiCell Alignment = J',1,'L',false);

// $pdf->Ln(20); // Line gap
// $pdf->SetX(50); // abscissa of Horizontal position 
// $pdf->MultiCell(100,10,'Alignment = RDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = J',1,'R',false);

// $pdf->Ln(20); 
// $pdf->SetX(50); 
// $pdf->MultiCell(100,10,'Alignment = CAlignment = RDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell AlignmeAlignment = RDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignme',1,'C',false);

// $pdf->Ln(20); 
// $pdf->SetX(50); 
// $pdf->MultiCell(100,10,'Demo AAlignment = RDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignment = JDemo About MultiCell Alignmebout MultiCell Alignment = J',1,'J',false);


// $pdf->SetFont('Arial','',12);		
// $pdf->Cell(20,5,'Lab ID : ',0,0);
// $pdf->Cell(95,5,$row['lab_number'],0,0);
// $pdf->Cell(25,5,'Patient Id :',0,0);
// $pdf->Cell(34,5,$row['lab_pat_number'],0,1);

// $pdf->SetFont('Arial','',12);		
// $pdf->Cell(35,5,'Patient Name :',0,0);
// $pdf->Cell(95,5,'lab_pat_name',0,0);
// $pdf->Cell(25,5,'',0,0);
// $pdf->Cell(34,5,'',0,1);

// $pdf->SetFont('Arial','',12);		
// $pdf->Cell(35,5,'Lab Test Date :',0,0);
// $pdf->Cell(95,5,$lab_date_rec,0,0);
// $pdf->Cell(25,5,'',0,0);
// $pdf->Cell(34,5,'',0,1);

// $pdf->SetFont('Arial','',10);		
// $pdf->Cell(71,10,'',0,0);
// $pdf->Cell(59,5,'',0,0);
// $pdf->Cell(50,10,'',0,1);

// $pdf->SetFont('Arial','B',10);	
// $pdf->Cell(70,6,'Test',1,0,'C');
// $pdf->Cell(40,6,'Result',1,0,'C');
// $pdf->Cell(40,6,'Unit',1,0,'C');
// $pdf->Cell(40,6,'Ref. Range',1,1,'C');

// $pdf->SetFont('Arial','',10);	

// $pdf->Cell(70,6,$lab_id,1,0);
// $pdf->Cell(40,6,$lab_pat_results,1,0,'C');
// $pdf->Cell(40,6,'4',1,0,'C');
// $pdf->Cell(40,6,'<7.6',1,1,'C');







$pdf->Output();
?>