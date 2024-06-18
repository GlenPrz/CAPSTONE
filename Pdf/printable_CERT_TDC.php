<?php
require('../fpdf186/fpdf.php');
session_start();
include("../conn.php");

$username = $_GET['id'] ?? '';
$date = date('Y-m-d');





try {
    $stmt = $conn->prepare("SELECT * from u896821908_bts.student where Username = :username LIMIT 1");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $Std_id = $row['idStudent'];
    $usernameValue = $row['Username'];
    $Lastname = $row['Lastname']; 
    $Firstname = $row['Firstname']; 
    $Address = $row['Address'] . ', ' . $row['City']; 
    $Birthdate = $row['Birthdate'];
    $DateEnrolled = $row['DateOfEnrolled'];
    $DateCompleted = $row['TDC_Cert_approve_date'];

    // Calculate age based on Birthdate
    $birthDate = new DateTime($Birthdate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;

    // Format the Birthdate as a string
    $formattedBirthdate = $birthDate->format('Y-m-d'); // Change the format as needed
    
  $DIInstructorFullNames = [
    ["Mendoza, Nestor Jr, Gatchallan", "IDE2022876013"],
    ["Perez, Jeffrey Atienza", "IDE2022912013"],
    ["Arthur, Morgan", "IDE2024784213"],
];


// Take the first element of the shuffled array
$randomAssignment = $DIInstructorFullNames[0];

// Extract the values from the assignment
$randomInstructor = $randomAssignment[0];
$randomDIAccree = $randomAssignment[1];


$stmtCors = $conn->prepare("SELECT * FROM `student_result` WHERE `username` = :username AND `result` = 'Passed'");
$stmtCors->bindParam(':username', $username, PDO::PARAM_STR);
$stmtCors->execute();


} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Image('../img/TDC_CERT_HEADER_TOp.png', 30, 5, -190);
$pdf->Cell(20,25,'',0,0); //IMG cELL
$pdf->Cell(5,65,'',0,1);  //IMG Spacing CELL

$pdf->SetFont('Arial','B',15);
$pdf->Cell(53,5,'',0,0);
$pdf->Cell(20,7,'CERTIFICATE OF COMPLETION',0,1); //IMG cELL
$pdf->Cell(58,5,'',0,0);
$pdf->SetFont('Arial','B',12);

$pdf->Cell(20,7,'THEORETICAL DRIVING COURSE',0,1); //IMG cELL
$pdf->Cell(20,5,'',0,1); //IMG cELL


$pdf->Cell(100,5,'Student Driver\'s Details ',0,1); 

$pdf->SetFont('Arial','',8);
$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(5,2,'',0,1);  //Padding for BTS

$pdf->Cell(5,15,'',0,0); //Padding for BTS
$pdf->Cell(5,5,'',0,0); 
$pdf->Cell(17,5,'Student Id:',0,0,'R');
$pdf->Cell(100,5,$Std_id,0,1);

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(22,5,'Name:',0,0,'R'); 
$pdf->Cell(100,5,$username,0,1);

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(22,5,'Address:',0,0,'R'); 
$pdf->Cell(100,5,$Address,0,1);

// $pdf->Cell(5,25,'',0,0); 
// $pdf->Cell(22,5,'Age:',0,0,'R'); 
// $pdf->Cell(100,5,$age,0,1);

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(22,5,'Date of Birth:',0,0,'R'); 
$pdf->Cell(100,5,$formattedBirthdate,0,1);

$pdf->Cell(20,25,'',0,0); //Padding 
$pdf->Cell(5,2,'',0,1);//Padding 
$pdf->SetFont('Arial','B',13);
$pdf->Cell(5,10,'Completed Session:',0,1);//Padding 

foreach ($stmtCors as $rowCors) {
    $sessionNum = $rowCors['Session_num'];
    $result = $rowCors['result'];
    $score = $rowCors['Score'];
    
    // Output the PDF cells based on fetched data.
    $pdf->Cell(14, 2, '', 0, 1); // Padding
    $pdf->Cell(14, 2, '', 0, 0); // Padding
    $pdf->SetFont('Arial', '', 13);
    $pdf->Cell(35, 2, 'Session #' . $sessionNum, 0, 0); // Padding
    $pdf->Cell(20, 2, $result, 0, 0); // Padding
    $pdf->Cell(20, 2, 'Score:', 0, 0, 'R'); // Padding
    $pdf->Cell(10, 2, $score, 0, 1); // Padding
    $pdf->Cell(5, 1, '', 0, 1); // Padding
}

    $pdf->Cell(5, 8, '', 0, 1); // Padding

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,5,'Driving Course Training Information',0,1); 

$pdf->SetFont('Arial','',12);

$pdf->Cell(12,5,'',0,1); 
$pdf->Cell(10,5,'',0,0); 
$pdf->Cell(26,5,'Date Started:',0,0);
$pdf->Cell(20,5,$DateEnrolled,0,0);
$pdf->Cell(35,5,'',0,0); 
$pdf->Cell(35,5,'Date Completed:',0,0); 
$pdf->Cell(26,5,$DateCompleted,0,1); 
$pdf->Cell(12,5,'',0,1); 
$pdf->Cell(10,5,'',0,0); 
$pdf->Cell(20,5,'Learning:',0,0);
$pdf->Cell(20,5,'Online',0,1); 



$pdf->Cell(5,10,''.'',0,1); 
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190,10,'Prepared and issued by:'.'BTS Driving School - PATEROS',0,1, 'C'); 
$pdf->Cell(190,10,'Accreditaion Number:'.'DS20210010213',0,1, 'C'); 
$pdf->Cell(190, 10, 'Authorized Representative: ' . $randomInstructor, 0, 1, 'C');
$pdf->Cell(190,10,'Accreditaion Number: '.$randomDIAccree,0,1, 'C'); 
$pdf->Output();
?>


