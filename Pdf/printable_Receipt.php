<?php
require('../fpdf186/fpdf.php');
session_start();
include("../conn.php");

$TransactionId = $_GET['Transaction_ID'];

$queryTransaction = "SELECT *
FROM student_transaction
INNER JOIN student ON student_transaction.student_id = student.idStudent
WHERE Transaction_ID = :TransactionId;";

$stmtTransaction = $conn->prepare($queryTransaction);
$stmtTransaction->bindParam(':TransactionId', $TransactionId, PDO::PARAM_INT);
$stmtTransaction->execute();
$dataTransaction = $stmtTransaction->fetchAll(PDO::FETCH_ASSOC);

$StdName = '';
$STdId = '';
$STD_AmountPaid ='';
$Std_Trans_Remark = '';
$Std_Mode_of_Payment = '';
$Std_Total_Balance = '';

foreach ($dataTransaction as $rowTransaction) {
    $transactionId = $rowTransaction['Transaction_ID'];
    $studentId = $rowTransaction['student_id'];
    $amountPaid = $rowTransaction['Amount_paid'];
    $submitDate = $rowTransaction['Submit_date'];
    $transactionRemark = $rowTransaction['Transaction_Remark'];
    $transactionTime = $rowTransaction['Transaction_time'];
    $course = $rowTransaction['Course'];
    $StdName.= $rowTransaction['Lastname'] . '  ' . $rowTransaction['Firstname'];
    $STdId.= $rowTransaction['student_id'];
    $STD_AmountPaid.= $rowTransaction['Amount_paid'];
    $Std_Trans_Remark .= $rowTransaction['Transaction_Remark'];
    $Std_Mode_of_Payment .= $rowTransaction['Mode_of_Payment'];
    $Std_Total_Balance .= $rowTransaction['balance'];

}


$date = date('Y-m-d');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,5,'',0,0); //IMG cELL
$pdf->Cell(5,5,'',0,1);  //IMG Spacing CELL
$pdf->SetTextColor(0, 128, 0);
$pdf->SetFont('Arial','B',30);
$pdf->Cell(35,5,'',0,0);
$pdf->Cell(20,7,'BEST TRAINING SCHOOL',0,1); //IMG cELL
$pdf->SetTextColor(0,0,0);

$pdf->Cell(40,5,'',0,0);
$pdf->SetFont('Arial','B',10);

$pdf->Cell(20,7,'C & N BLDG. ALMEDA ST. SAN ROQUE, PATEROS, METRO MANILA',0,1); //IMG cELL
$pdf->Cell(70,5,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,7,'09215447612 / 02-87230574',0,1); //IMG cELL

$pdf->Cell(20,5,'',0,1); //IMG cELL
$pdf->Line(10, 40, 200,40);
$pdf->Cell(20,5,'',0,1); 
$pdf->Cell(60,5,'',0,0); 
$pdf->SetFont('Arial','B',20);
$pdf->Cell(20,5,'OFFICIAL RECEIPT',0,1); 
$pdf->SetFont('Arial','',16);

$pdf->Cell(20,5,'',0,1); 
$pdf->Cell(20,5,'Date:',0,0); 

$pdf->Cell(90,5,$submitDate,0,0); 
$pdf->Cell(20,5,'Time:',0,0); 

$pdf->Cell(20,5,$transactionTime,0,1); 
$pdf->Cell(20,5,'',0,1); 
$pdf->Cell(12,5,'No:',0,0); 
$pdf->Cell(20,5,$transactionId,0,1); 
$pdf->Cell(20,5,'',0,1); 
 
$pdf->Cell(40,5,'Student Name:',0,0); 
$pdf->Cell(20,5,$StdName,0,1); 
$pdf->Cell(20,5,'',0,1);

$pdf->Cell(45,5,'Student Number:',0,0); 
$pdf->Cell(20,5,$STdId,0,1); 
$pdf->Cell(20,5,'',0,1);

$pdf->Cell(23,5,'Amount:',0,0); 
$pdf->Cell(20, 5, 'Php ' . $STD_AmountPaid, 0, 1);
$pdf->Cell(20,5,'',0,1);


//MODE OF PAYMENT HERE 
// $pdf->Cell(47,5,'Mode of payment:',0,0); 
// $pdf->Cell(20,5,$Std_Mode_of_Payment,0,1); 
// $pdf->Cell(20,5,'',0,1);
//MODE OF PAYMENT HERE 




$pdf->Cell(27,5,'Remarks:',0,0); 
$pdf->Cell(20,5,$Std_Trans_Remark,0,1); 
$pdf->Cell(20,5,'',0,1);

$pdf->Cell(37,5,'Total Balance:',0,0); 
$pdf->Cell(20,5, 'Php ' .$Std_Total_Balance,0,1); 
$pdf->Cell(20,5,'',0,1);

$pdf->SetFont('Arial','B',20);
$pdf->Cell(20,10,'',0,0);
$pdf->Cell(70,5,'',0,0);
$pdf->Cell(20,10,'Received by:',0,1);

$pdf->Cell(20,10,'',0,0);
$pdf->Cell(70,5,'',0,0);
$pdf->Cell(20,5,'',0,1);
$pdf->SetFont('Arial','B',16);

$pdf->Cell(20,10,'',0,0);
$pdf->Cell(70,5,'',0,0);
$pdf->Cell(20,5,'Best Training School',0,1);

$pdf->Output();
?>


