<?php
include('assets/inc/config.php');

require('../fpdf/fpdf.php');



$lab_id=$_GET['pres_id'];
// $lab_number=$_GET['lab_number'];
$ret="SELECT  * FROM his_prescriptions WHERE pres_id = ?";
$stmt= $mysqli->prepare($ret) ;
$stmt->bind_param('i',$lab_id);
$stmt->execute() ;
$res=$stmt->get_result();
$row = $res->fetch_assoc();

  //customer and invoice details
  $info=[
    "customer"=>$row['pres_pat_name'],
    "address"=>$row['pres_pat_number'],
    "city"=>$row['pres_pat_name'],
    "invoice_no"=>$row['pres_id'],
    "invoice_date"=>$row['pres_number'],
    "total_amt"=>$row['pres_pat_name'],
    // "words"=>"Rupees Five Thousand Two Hundred Only",
    // "pat_tests"=>$row['lab_pat_tests'],
    // "pat_results"=>$row['lab_pat_results'],
  ];
  
  
  //invoice Products
  $products_info=[
    [
      "name"=>$row['pres_pat_name'],
      "price"=>$row['pres_pat_name'],
      "qty"=>1,
      "total"=>$row['pres_pat_name']
    ],
    // [
    //   "name"=>"Mouse",
    //   "price"=>"400.00",
    //   "qty"=>3,
    //   "total"=>"1200.00"
    // ],
    // [
    //   "name"=>"UPS",
    //   "price"=>"3000.00",
    //   "qty"=>1,
    //   "total"=>"3000.00"
    // ],
  ];
  
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"HMS Lab Report",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"Ponditshar 8082.",0,1);
      $this->Cell(50,7,"Naria, Shariatpur.",0,1);
      $this->Cell(50,7,"PH : +880 1452375406",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-40);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"HMS",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($info,$products_info){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To : ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,"Patient ID : ".$info["address"],0,1);
      $this->Cell(50,7,"Test Date : ".$info["city"],0,1);
      
      //Display Invoice no
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Lab ID : ".$info["invoice_no"]);
      
      //Display Invoice date
      $this->SetY(70);
      $this->SetX(-60);
      $this->Cell(50,7,"Lab Number : ".$info["invoice_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"DESCRIPTION",1,0);
      $this->Cell(40,9,"PRICE",1,0,"C");
      $this->Cell(30,9,"QTY",1,0,"C");
      $this->Cell(40,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);

      //----------
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(80,9,$row["name"],"LR",0);
        $this->Cell(40,9,$row["price"],"R",0,"R");
        $this->Cell(30,9,$row["qty"],"R",0,"C");
        $this->Cell(40,9,$row["total"],"R",1,"R");
      }
    //   Display table empty rows
      for($i=0;$i<12-count($products_info);$i++)
      {
        $this->Cell(80,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
        $this->Cell(30,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
    //   Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"TOTAL",1,0,"l");
      $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
    //   Display amount in words
      $this->SetY(225);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"Amount in Words ",0,1);
      $this->SetFont('Arial','',12);
      // $this->Cell(0,9,$info["words"],0,1);
      
    }
    function Footer(){
      
      //set footer position
      $this->SetY(-50);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,10,"for HMS COMPUTERS",0,1,"R");
      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->Cell(0,10,"This is a computer generated invoice",0,1,"C");
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  
// $lab_id=$_GET['lab_id'];
// $lab_number=$_GET['lab_number'];
// $ret="SELECT  * FROM his_laboratory WHERE lab_id = ?";
// $stmt= $mysqli->prepare($ret) ;
// $stmt->bind_param('i',$lab_id);
// $stmt->execute() ;
// $res=$stmt->get_result();
// $row = $res->fetch_assoc();
// $pdf->SetFont('Arial','B',16);		



$pdf->Output();
?>