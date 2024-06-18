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
    
    $STDID = $row['idStudent'];
    $usernameValue = $row['Username'];
    $Lastname = $row['Lastname']; 
    $Firstname = $row['Firstname']; 
    $Address = $row['Address'] . ', ' . $row['City']; 
    $Birthdate = $row['Birthdate'];
    $DateEnrolled = $row['DateOfEnrolled'];
    $Citizenship = $row['Citizenship'];
    $Civilstatus = $row['Civilstatus'];
    $Sex = $row['Sex'];
    $LTOCLIENTID = $row['LTO_Client_ID'];
    $Studperm = $row['Student_permit_number'] ?? '';
    $DateCompleted = $row['PDC_Cert_approve_date'];
    $Fullname = $Lastname .', ' .$Firstname;

    $PDCMOTOR = $row['PDC-MOTOR'] ?? '';
    $PDCCAR = $row['PDC-CAR'] ?? '';

    $carData = explode('_', $PDCCAR);
    $vehicleTypeCar = isset($carData[0]) ? $carData[0] : '';
    $TypeCar = isset($carData[1]) ? $carData[1] : '';
    
    // Splitting the data for Motorcycle
    $motorcycleData = explode('_', $PDCMOTOR);
    $vehicleTypeMotorcycle = isset($motorcycleData[0]) ? $motorcycleData[0] : '';
    $manualTypeMotorcycle = isset($motorcycleData[1]) ? $motorcycleData[1] : '';
    
    
    if ($PDCCAR) {
        $stmt_course_std = $conn->prepare("SELECT * 
        FROM u896821908_bts.course_enrolled 
        WHERE 
            (Course_info LIKE :Car AND `Vechile(Type)` LIKE :Type) LIMIT 1");
    
        // Bind the parameters correctly
        $vehicleTypeCar = '%' . $vehicleTypeCar . '%';
        $TypeCar = '%' . $TypeCar . '%';
        
        $stmt_course_std->bindParam(':Car', $vehicleTypeCar, PDO::PARAM_STR);
        $stmt_course_std->bindParam(':Type', $TypeCar, PDO::PARAM_STR);
    
        $stmt_course_std->execute();
        $rowStdCar = $stmt_course_std->fetch(PDO::FETCH_ASSOC); 
        $DlcodeCar = $rowStdCar['DLcode'];
        $courceinfo = $rowStdCar['Course_info'];
        $typeofCar = $rowStdCar['Vechile(Type)'];

    }
    

    if($PDCMOTOR){
        $stmt_course_stdmotor = $conn->prepare("SELECT * 
        FROM u896821908_bts.course_enrolled 
        WHERE 
            (Course_info LIKE :Car AND `Vechile(Type)` LIKE :Type) LIMIT 1");
    
        // Bind the parameters correctly
        $vehicleTypeMotorcycle = '%' . $vehicleTypeMotorcycle . '%';
        $manualTypeMotorcycle = '%' . $manualTypeMotorcycle . '%';
        
        $stmt_course_stdmotor->bindParam(':Car', $vehicleTypeMotorcycle, PDO::PARAM_STR);
        $stmt_course_stdmotor->bindParam(':Type', $manualTypeMotorcycle, PDO::PARAM_STR);
    
        $stmt_course_stdmotor->execute();
        $rowStdmotor = $stmt_course_stdmotor->fetch(PDO::FETCH_ASSOC); 
        $Dlcodemotor = $rowStdmotor['DLcode'];
        $courceinfomotor = $rowStdmotor['Course_info'];
        $typeofmotor = $rowStdmotor['Vechile(Type)']; 
    }

 $Car = $vehicleTypeCar ?? '';
    // Calculate age based on Birthdate
    $birthDate = new DateTime($Birthdate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;

    // Format the Birthdate as a string
    $formattedBirthdate = $birthDate->format('Y-m-d'); // Change the format as needed


$stmt_getID_drivInstructor = $conn->prepare("SELECT DISTINCT `Di_Id`,`Student_id`,`DI_Username` FROM di_assign_tbl WHERE Student_id = :StdID");
$stmt_getID_drivInstructor->bindParam(':StdID', $STDID, PDO::PARAM_STR);
$stmt_getID_drivInstructor->execute();

$rowgetID_drivInstructor = $stmt_getID_drivInstructor->fetch(PDO::FETCH_ASSOC);
    $ID_drivInstructor = $rowgetID_drivInstructor['Di_Id'];
                
                
    $stmt_getDrivingInstructor =  $conn->prepare("SELECT * FROM `di` where id_DI = :DI_id");          
       $stmt_getDrivingInstructor->bindParam(':DI_id', $ID_drivInstructor, PDO::PARAM_STR);
               $stmt_getDrivingInstructor->execute();
                  $rowget_drivInstructor = $stmt_getDrivingInstructor->fetch(PDO::FETCH_ASSOC); 
        $DIAccree = $rowget_drivInstructor['Accreditation_Number'];
$DIIntructorFullName = $rowget_drivInstructor['Lastname'] . $rowget_drivInstructor['Firstname'];
                
                    
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

$pdf->Cell(20,7,'PRACTICAL DRIVING COURSE',0,1); //IMG cELL
$pdf->Cell(20,5,'',0,1); //IMG cELL


$pdf->Cell(100,5,'Student Driver\'s Details ',0,1); 

$pdf->SetFont('Arial','',8);
$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(5,2,'',0,1);  //Padding for BTS

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(5,5,'LTO CLIENT ID:',0,0); 
$pdf->Cell(17,5,'',0,0);
$pdf->Cell(100,5,$LTOCLIENTID,0,1);

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(22,5,'Name:',0,0,'R'); 
$pdf->Cell(100,5,$Fullname,0,1);

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(22,5,'Address:',0,0,'R'); 
$pdf->Cell(100,5,$Address,0,1);

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(22,5,'Date of Birth:',0,0,'R'); 
$pdf->Cell(70,5,$formattedBirthdate,0,0);
$pdf->Cell(7,5,'',0,0,'R'); 
$pdf->Cell(20,5,'Nationality:',0,0,'R'); 
$pdf->Cell(20,5,$Citizenship,0,1,'R'); 

$pdf->Cell(5,25,'',0,0); //Padding for BTS
$pdf->Cell(22,5,'',0,0,'R'); 
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(7,5,'Sex:',0,0);
$pdf->Cell(7,5,$Sex,0,0);
$pdf->Cell(23,5,'',0,0);
$pdf->Cell(20,5,'Civil Status:',0,0,'R');
$pdf->Cell(20,5,$Civilstatus,0,1,'R'); 

$pdf->Cell(20,25,'',0,0); //Padding 
$pdf->Cell(5,2,'',0,1);//Padding 

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,5,'Driving Course Training Information',0,1); 

$pdf->SetFont('Arial','',10);
$pdf->Cell(15,10,'SP No.:',0,0); 
$pdf->Cell(30,10,$Studperm,0,0); 
$pdf->Cell(15,5,'',0,0); 
$pdf->Cell(30,5,'',0,0); 
$pdf->Cell(30,5,'',0,0); 
$pdf->Cell(30,5,'',0,1); 

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,6,'',0,1); 
$pdf->Cell(100,5,'Licensed Applied for:',0,1); 
$pdf->Cell(30,5,'',0,1); 

$pdf->Cell(80,5,$courceinfo,0,0); 
$pdf->Cell(25,5,$typeofCar,0,0); 
$pdf->Cell(5,5,$DlcodeCar,0,1); 

$pdf->Cell(100,5,'',0,1); 
$pdf->Cell(80,5,$courceinfomotor,0,0); 
$pdf->Cell(25,5,$typeofmotor,0,0); 
$pdf->Cell(5,5,$Dlcodemotor,0,1); 
$pdf->Cell(5,50,'',0,1); 

$pdf->Cell(30,5,'Date Started:',0,0); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(25,5,$DateEnrolled,0,0); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,5,'Date Completed:',0,0); 
$pdf->SetFont('Arial','',10);
$pdf->Cell(30,5,$DateCompleted,0,0); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,5,'',0,1); 
$pdf->SetFont('Arial','B',10);


$pdf->Cell(5,10,''.'',0,1); 
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(190,10,'Prepared and issued by:'.'BTS Driving School - PATEROS',0,1, 'C'); 
$pdf->Cell(190,10,'Accreditaion Number:'.'DS20210010213',0,1, 'C'); 
$pdf->Cell(190, 10, 'Authorized Representative: ' . $DIIntructorFullName, 0, 1, 'C');
$pdf->Cell(190,10,'Accreditaion Number: '.$DIAccree,0,1, 'C'); 
$pdf->Output();
?>


