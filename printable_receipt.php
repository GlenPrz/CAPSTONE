<?php
require('./fpdf186/fpdf.php');
session_start();
include("conn.php");

$paymentOption = isset($_POST['payment_option']) ? $_POST['payment_option'] : '';
$username = $_SESSION['username'];
$date = date('Y-m-d');


if($paymentOption == 'full'){
    $paymentOption = "Full Payment";
}else{
    $paymentOption = "Five Payment";
}

try {
    $stmt = $conn->prepare("SELECT * FROM u896821908_bts.student_enrolled WHERE Username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $priceMotor = 0;
    $priceCar = 0;
    $tdcEnroll = 0;
    $depStatusEnroll = 0;
    $Total = 0;

    if ($row) {
        $tdc = $row['TDC'];
        $dep = $row['DEP'];
        $pdcMotor = $row['PDC-MOTOR'];
        $pdcCar = $row['PDC-CAR'];
        $licenseNumber = $row['LicenseNumber'];
        $expirationDate = $row['ExpirationDate'];

        if ($pdcMotor === "Motorcycle(Automatic)" || $pdcMotor === "Motorcycle(Manual)") {
            $priceMotor = 2500;
        }

        if ($pdcCar === "CAR(Automatic)" || $pdcCar === "CAR(Manual)") {
            $priceCar = 4000;
        }

        if ($tdc === "Enrolling") {
            $tdcEnroll = 1000;  
        }

        if ($dep === "Enrolling") {
            $depStatusEnroll = 1000;  
        }

        $totalWithoutPercentage = $priceCar + $priceMotor + $tdcEnroll + $depStatusEnroll;
        $perWeekAmount = ($totalWithoutPercentage + 1000)/5;
        $totalFivePayment = $totalWithoutPercentage;

    } else {
        echo "No data found for the username: $username";
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}

$pdf = new FPDF('P','mm',array(180,110));
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Image('./img/bts_logo.png', 5, 5, -450);

$pdf->Cell(20,25,'',0,0); //IMG cELL
$pdf->Cell(2,5,'',0,0);  //IMG Spacing CELL

$pdf->Cell(100,5,'BTS DRIVING SCHOOL (PATEROS)',0,1); 

$pdf->SetFont('Arial','',8);
$pdf->Cell(20,25,'',0,0); //Padding for BTS
$pdf->Cell(5,2,'',0,1);  //Padding for BTS

$pdf->Cell(20,25,'',0,0); 
$pdf->Cell(2,5,'',0,0);
$pdf->Cell(100,5,'C&N BLDG., M. ALMEDA ST., BRGY.SAN ROQUE',0,1);

$pdf->Cell(20,25,'',0,0); //Padding 
$pdf->Cell(5,2,'',0,1);//Padding 

$pdf->Cell(20,25,'',0,0); 
$pdf->Cell(2,5,'',0,0); 

$pdf->Cell(100,5,'TEL No.:(02)8723-0574 | MOBILE NO.:(+63)921-5337612',0,1); 
$pdf->Cell(20,25,'',0,0); //Padding 
$pdf->Cell(5,2,'',0,1);//Padding 

$pdf->Cell(20,25,'',0,0); 
$pdf->Cell(2,5,'',0,0); 
$pdf->Cell(100,5,'ACCREDITATION NO.: 2021-00102-13',0,1); 
$pdf->Cell(5,5,'',0,1); //Seperator
$pdf->Cell(5,5,'',0,1); //Seperator

$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(1,130,3);
$pdf->Cell(40,5,'CLIENT ID:',0,0); 
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',15);

$pdf->Cell(5,5,$_SESSION['username'],0,1); 
$pdf->Cell(5,4,'',0,1); 
$pdf->Cell(15,4,'Date:',0,0); 
$pdf->Cell(15,4,$date,0,1); 

$pdf->Cell(5,4,'',0,1); 

$pdf->Cell(5,5,'Enrolled:',0,1); 

$pdf->SetFont('Arial','',10);
if (!empty($tdc)) {
    $pdf->Cell(5,2,'',0,1);
    $pdf->Cell(5,2,'',0,0);  
    $pdf->Cell(45,5,'Theoretical Driving Course:',0,0); 
    $pdf->Cell(15,5,$tdc,0,1); 
}
if (!empty($dep)) {
    $pdf->Cell(5,2,'',0,1);
    $pdf->Cell(5,2,'',0,0);  
    $pdf->Cell(50,5,'Driving Enhancement Program:',0,0); 
    $pdf->Cell(15,5,$dep,0,1); 
}
if (!empty($pdcMotor)) {
    $pdf->Cell(5,2,'',0,1);
    $pdf->Cell(5,2,'',0,0);  
    $pdf->Cell(45,5,'PDC-Motorcycle:',0,0); 
    $pdf->Cell(15,5,$pdcMotor,0,1); 
}
if (!empty($pdcCar)) {
    $pdf->Cell(5,2,'',0,1);
    $pdf->Cell(5,2,'',0,0);  
    $pdf->Cell(45,5,'PDC-Car:',0,0); 
    $pdf->Cell(15,5,$pdcCar,0,1); 
}
if (!empty($licenseNumber)) {
    $pdf->Cell(5,2,'',0,1);
    $pdf->Cell(5,2,'',0,0);  
    $pdf->Cell(45,5,'License Number:',0,0); 
    $pdf->Cell(15,5,$licenseNumber,0,1); 
}
if (!empty($expirationDate)) {
    $pdf->Cell(5,2,'',0,1);
    $pdf->Cell(5,2,'',0,0);  
    $pdf->Cell(45,5,'Expiration Date:',0,0); 
    $pdf->Cell(15,5,$expirationDate,0,1); 
}
$pdf->Cell(5,3,'',0,1);  
$pdf->SetFont('Arial','',15);

$pdf->Cell(45,5,'Mode of Payment:',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,5,$paymentOption,0,1);  

if (isset($_POST['payment_option']) && $_POST['payment_option'] === 'five') {
    $pdf->Cell(5,2,'',0,1);
    $pdf->Cell(5,5,'',0,0);
    for ($week = 1; $week < 6; $week++) {
        $pdf->Cell(15,5,"Week:",0,0);  
        $pdf->Cell(5,5,$week,0,0);  
        $pdf->Cell(5,5,$perWeekAmount,0,1);  
        $pdf->Cell(5,5,'',0,0);  
    }
    $pdf->Cell(5,5,'',0,1);  
    $pdf->SetFont('Arial','B',17);
    $pdf->SetTextColor(1,130,3);

    $pdf->Cell(20,5,"Total:",0,0);  
    $pdf->Cell(15,5,$totalFivePayment + 1000,0,1);  
}else{
    $pdf->Cell(5,5,'',0,1);  
    $pdf->SetTextColor(1,130,3);
    $pdf->SetFont('Arial','B',17);
    $pdf->Cell(20,5,"Total:",0,0);  
    $pdf->Cell(15,5,$totalWithoutPercentage,0,1);  
}

$pdf->Output();
?>