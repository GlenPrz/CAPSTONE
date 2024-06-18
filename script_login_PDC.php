<?php
  include "conn.php";
  session_start();
  $username = $_SESSION['UsernameTDC'];
//   echo  $_SESSION['pdfPathPDC'];
//   echo  $_SESSION['UsernameTDC'];
    echo $_POST['radio-group'];

  try {

// For motor_manual
$motor_manual_schedule1 = isset($_POST['motor_manual_schedule1']) ? $_POST['motor_manual_schedule1'] : "";
$motor_manual_time1 = isset($_POST['motor_manual_time1']) ? $_POST['motor_manual_time1'] : "";
$motor_manual_schedule2 = isset($_POST['motor_manual_schedule2']) ? $_POST['motor_manual_schedule2'] : "";
$motor_manual_time2 = isset($_POST['motor_manual_time2']) ? $_POST['motor_manual_time2'] : "";    
    
// For motor_automatic
$motor_automatic_schedule1 = isset($_POST['motor_automatic_schedule1']) ? $_POST['motor_automatic_schedule1'] : "";
$motor_automatic_time1 = isset($_POST['motor_automatic_time1']) ? $_POST['motor_automatic_time1'] : "";
$motor_automatic_schedule2 = isset($_POST['motor_automatic_schedule2']) ? $_POST['motor_automatic_schedule2'] : "";
$motor_automatic_time2 = isset($_POST['motor_automatic_time2']) ? $_POST['motor_automatic_time2'] : "";

// For car_manual
$car_manual_schedule1 = isset($_POST['car_manual_schedule1']) ? $_POST['car_manual_schedule1'] : "";
$car_manual_time1 = isset($_POST['car_manual_time1']) ? $_POST['car_manual_time1'] : "";
$car_manual_schedule2 = isset($_POST['car_manual_schedule2']) ? $_POST['car_manual_schedule2'] : "";
$car_manual_time2 = isset($_POST['car_manual_time2']) ? $_POST['car_manual_time2'] : "";

// For car_automatic
$car_automatic_schedule1 = isset($_POST['car_automatic_schedule1']) ? $_POST['car_automatic_schedule1'] : "";
$car_automatic_time1 = isset($_POST['car_automatic_time1']) ? $_POST['car_automatic_time1'] : "";
$car_automatic_schedule2 = isset($_POST['car_automatic_schedule2']) ? $_POST['car_automatic_schedule2'] : "";
$car_automatic_time2 = isset($_POST['car_automatic_time2']) ? $_POST['car_automatic_time2'] : "";

$EnrollingforCM = $_POST["Enrolling_PDC_Car"];
$EnrollingforM = $_POST["Enrolling_PDC_Motor"];
$combinedValue = $_POST['PermitNum'];

$TotalPdc = $_POST['TotalPdc'];

    // Prepare the SQL statement to update student information
    $stmt = $conn->prepare("UPDATE u896821908_bts.student 
        SET LastName = :LastName,
            FirstName = :FirstName,
            MiddleName = :MiddleName,
            Suffix = :Suffix,
            Birthdate = :Birthdate,
            Civilstatus = :CivilStatus,
            ContactNumber = :ContactNumber,
            Sex = :Sex,
            Address = :Address,
            City = :City,
            ZipCode = :ZipCode,
            Citizenship = :Citizenship,
            Role = :Role,
            DateOfEnrolled = :DateOfEnrolled,
            Enroll_Status = :Enroll_Status,
            Contact_person = :Contact_person,
            Contact_person_number = :Contact_person_number,
            Relationship = :Relationship,
            LTO_Client_ID = :clientID,
            Student_permit_img = :pdf_pathSP,
            Expiration_student_permit = :Expiration_student_permit,
            Student_permit_number = :Student_permit_number
        WHERE Username = :Username");

    $stmt->bindParam(':Username', $username);
    $stmt->bindParam(':LastName', $_POST['LastName']);
    $stmt->bindParam(':FirstName', $_POST['FirstName']);
    $stmt->bindParam(':MiddleName', $_POST['MiddleName']);
    $stmt->bindParam(':Suffix', $_POST['Suffix']);
    $stmt->bindParam(':Birthdate', $_POST['BirthdatePDC']);
    $stmt->bindParam(':CivilStatus', $_POST['CivilStatusPDC']);
    $stmt->bindParam(':ContactNumber', $_POST['ContactNumberPDC']);
    $stmt->bindParam(':Sex', $_POST['SEXPDC']);
    $stmt->bindParam(':Address', $_POST['CompleteAddressPDC']);
    $stmt->bindParam(':City', $_POST['CityPDC']);
    $stmt->bindParam(':ZipCode', $_POST['ZipCodePDC']);
    $stmt->bindParam(':Citizenship', $_POST['CitizenshipPDC']);
    $stmt->bindParam(':Contact_person', $_POST['ContactPersonPDC']);
    $stmt->bindParam(':Contact_person_number', $_POST['ConPersonNumPDC']);
    $stmt->bindParam(':clientID', $_POST['clientID']);
    $stmt->bindParam(':Relationship', $_POST['RelationshipPDC']);

    $stmt->bindValue(':Enroll_Status', "pending");
    $stmt->bindValue(':Role', "Student");
    $stmt->bindValue(':Expiration_student_permit', $_POST['EXPDATE']);
    $stmt->bindValue(':Student_permit_number', $combinedValue);
    $stmt->bindParam(':pdf_pathSP', $_SESSION['pdfPathPDC']);

    $currentDate = date('Y-m-d');
    $stmt->bindValue(':DateOfEnrolled', $currentDate);

    $stmt->execute();


    //SELECTING ID STUDENT
    $sqlSTDId = "SELECT idStudent FROM student WHERE Username = :Username";
    $stmtStdId = $conn->prepare($sqlSTDId);
    $stmtStdId->bindParam(':Username', $username);
    $stmtStdId->execute();
    $resultStd_ID = $stmtStdId->fetch();

    if ($resultStd_ID) {
        $idStudent = $resultStd_ID['idStudent'];
    }
    //SELECTING ID STUDENT

    //UPDATE STUDENT
    $stmtEnroll = $conn->prepare("UPDATE u896821908_bts.student SET `PDC-MOTOR` = :EnrollingforM, `PDC-CAR` = :EnrollingforCM WHERE Username = :Username");
    $stmtEnroll->bindParam(':Username', $_SESSION["UsernameTDC"]);
    $stmtEnroll->bindParam(':EnrollingforM', $EnrollingforM);
    $stmtEnroll->bindParam(':EnrollingforCM', $EnrollingforCM);
    $stmtEnroll->execute();
    //UPDATE STUDENT

    //MOTOR PDC SCHED
    if($EnrollingforM == "Motorcycle_Manual"){

        $insert_Sched = "INSERT INTO `u896821908_bts`.`student_schedule_pdc`
        (`Student_Id`, `Username`, `PDC_Vechicle`, `schedule1`, `schedule2`, `Time1`, `Time2`)
       
        VALUES (:Student_Id, :username, :PDC_Vechicle, :schedule1_motor_manual, 
        :schedule2_motor_manual, :time1_motor_manual, :time2_motor_manual)";
    
        $insertSchedMotorManual = $conn->prepare($insert_Sched);
        $insertSchedMotorManual->bindParam(':Student_Id', $idStudent);
        $insertSchedMotorManual->bindParam(':username', $username);
        $insertSchedMotorManual->bindParam(':PDC_Vechicle', $EnrollingforM);
        $insertSchedMotorManual->bindParam(':schedule1_motor_manual', $motor_manual_schedule1);  
        $insertSchedMotorManual->bindParam(':schedule2_motor_manual', $motor_manual_schedule2);
        $insertSchedMotorManual->bindParam(':time1_motor_manual', $motor_manual_time1);
        $insertSchedMotorManual->bindParam(':time2_motor_manual', $motor_manual_time2);
        

        $Update_SchedMotorManual = "UPDATE pdc_schedule
        SET Slot = Slot - 1
        WHERE schedule1 = :schedule1
        AND schedule2 = :schedule2
        AND time1 = :time1
        AND time2 = :time2
        AND Slot > 0;"; // Add the Slot condition

        $Update_Slot_SchedMotorManual = $conn->prepare($Update_SchedMotorManual);
        $Update_Slot_SchedMotorManual->bindParam(':schedule1', $motor_manual_schedule1);  
        $Update_Slot_SchedMotorManual->bindParam(':schedule2', $motor_manual_schedule2);
        $Update_Slot_SchedMotorManual->bindParam(':time1', $motor_manual_time1);
        $Update_Slot_SchedMotorManual->bindParam(':time2', $motor_manual_time2);

        if ($Update_Slot_SchedMotorManual->execute()) {
            $rowsAffected = $Update_Slot_SchedMotorManual->rowCount(); // Get the number of rows affected
            if ($rowsAffected > 0) {

                $insertSchedMotorManual->execute(); 
                
    $enrolledDateHistoSTD = date("Y-m-d H:i:s");
    $sqlHistorySTD = "INSERT INTO std_enrollment_history (idStudent, Enrolled, Enrolled_Date) VALUES (:idStudent, :enrolled, :enrolledDate)";
    $stmtHistorySTD = $conn->prepare($sqlHistorySTD);

    $stmtHistorySTD->bindParam(':idStudent', $idStudent, PDO::PARAM_STR);
    $stmtHistorySTD->bindValue(':enrolled', "Motorcycle_Manual");
    $stmtHistorySTD->bindParam(':enrolledDate', $enrolledDateHistoSTD, PDO::PARAM_STR);
    
    // Execute the statement
    $stmtHistorySTD->execute();
                
                
                
                
                $insertSchedMotorManual->closeCursor(); 
            } else {
                $_SESSION['No_slot_Motorcycle_Manual'] = true;
            }
        } else {
            echo "Error updating slot.";
        }

        $Update_Slot_SchedMotorManual->closeCursor();


    }

    else if($EnrollingforM == "Motorcycle_Automatic"){
        $insert_Sched = "INSERT INTO `u896821908_bts`.`student_schedule_pdc`
        (`Student_Id`, `Username`, `PDC_Vechicle`, `schedule1`, `schedule2`, `Time1`, `Time2`)
        
        VALUES (:Student_Id, :username, :PDC_Vechicle, :schedule1_motor_automatic, 
        :schedule2_motor_automatic, :time1_motor_automatic, :time2_motor_automatic)";
    
        $insertSchedMotorAuto = $conn->prepare($insert_Sched);
        $insertSchedMotorAuto->bindParam(':Student_Id', $idStudent);
        $insertSchedMotorAuto->bindParam(':username', $username);
        $insertSchedMotorAuto->bindParam(':PDC_Vechicle', $EnrollingforM);
        $insertSchedMotorAuto->bindParam(':schedule1_motor_automatic', $motor_automatic_schedule1);  
        $insertSchedMotorAuto->bindParam(':schedule2_motor_automatic', $motor_automatic_schedule2);
        $insertSchedMotorAuto->bindParam(':time1_motor_automatic', $motor_automatic_time1);
        $insertSchedMotorAuto->bindParam(':time2_motor_automatic', $motor_automatic_time2);


        $Update_SchedMotorAuto = "UPDATE pdc_schedule
        SET Slot = Slot - 1
        WHERE schedule1 = :schedule1
        AND schedule2 = :schedule2
        AND time1 = :time1
        AND time2 = :time2
        AND Slot > 0;"; // Add the Slot condition

        $Update_Slot_SchedMotorAuto = $conn->prepare($Update_SchedMotorAuto);
        $Update_Slot_SchedMotorAuto->bindParam(':schedule1', $motor_automatic_schedule1);  
        $Update_Slot_SchedMotorAuto->bindParam(':schedule2', $motor_automatic_schedule2);
        $Update_Slot_SchedMotorAuto->bindParam(':time1', $motor_automatic_time1);
        $Update_Slot_SchedMotorAuto->bindParam(':time2', $motor_automatic_time2);

        if ($Update_Slot_SchedMotorAuto->execute()) {
            $rowsAffected = $Update_Slot_SchedMotorAuto->rowCount(); // Get the number of rows affected
            if ($rowsAffected > 0) {
                
    $enrolledDateHistoSTD = date("Y-m-d H:i:s");
    $sqlHistorySTD = "INSERT INTO std_enrollment_history (idStudent, Enrolled, Enrolled_Date) VALUES (:idStudent, :enrolled, :enrolledDate)";
    $stmtHistorySTD = $conn->prepare($sqlHistorySTD);

    $stmtHistorySTD->bindParam(':idStudent', $idStudent, PDO::PARAM_STR);
    $stmtHistorySTD->bindValue(':enrolled', "Motorcycle_Automatic");
    $stmtHistorySTD->bindParam(':enrolledDate', $enrolledDateHistoSTD, PDO::PARAM_STR);
    
    // Execute the statement
    $stmtHistorySTD->execute();
                
                
                
                $insertSchedMotorAuto->execute();  
                $insertSchedMotorAuto->closeCursor(); 
            } else {
                $_SESSION['No_slot_Motorcycle_Automatic'] = true;
                echo "No slot left for Motorcycle_Automatic."; // No rows were updated (Slot was already 0)
            }
        } else {
            echo "Error updating slot.";
        }

        $Update_Slot_SchedMotorAuto->closeCursor();
    }

//MOTOR PDC SCHED


//CAR PDC SCHED
 if($EnrollingforCM == "Car_Manual"){
    $insert_Sched = "INSERT INTO `u896821908_bts`.`student_schedule_pdc`
    (`Student_Id`, `Username`, `PDC_Vechicle`, `schedule1`, `schedule2`, `Time1`, `Time2`)
    
    VALUES
    (:Student_Id, :username, :PDC_Vechicle, :schedule1_car_manual,:schedule2_car_manual, :time1_car_manual, :time2_car_manual)";

    $insertSchedManual = $conn->prepare($insert_Sched);
    $insertSchedManual->bindParam(':Student_Id', $idStudent);
    $insertSchedManual->bindParam(':username', $username);
    $insertSchedManual->bindParam(':PDC_Vechicle', $EnrollingforCM);

    $insertSchedManual->bindParam(':schedule1_car_manual', $car_manual_schedule1);  
    $insertSchedManual->bindParam(':schedule2_car_manual', $car_manual_schedule2);
    $insertSchedManual->bindParam(':time1_car_manual', $car_manual_time1);
    $insertSchedManual->bindParam(':time2_car_manual', $car_manual_time2);
  

        $Update_SchedManual = "UPDATE pdc_schedule
        SET Slot = Slot - 1
        WHERE schedule1 = :schedule1
        AND schedule2 = :schedule2
        AND time1 = :time1
        AND time2 = :time2
        AND Slot > 0;"; // Add the Slot condition

        $Update_Slot_SchedManual = $conn->prepare($Update_SchedManual);
        $Update_Slot_SchedManual->bindParam(':schedule1', $car_manual_schedule1);  
        $Update_Slot_SchedManual->bindParam(':schedule2', $car_manual_schedule2);
        $Update_Slot_SchedManual->bindParam(':time1', $car_manual_time1);
        $Update_Slot_SchedManual->bindParam(':time2', $car_manual_time2);

        if ($Update_Slot_SchedManual->execute()) {
            $rowsAffected = $Update_Slot_SchedManual->rowCount(); // Get the number of rows affected
            if ($rowsAffected > 0) {
                
                  $enrolledDateHistoSTD = date("Y-m-d H:i:s");
    $sqlHistorySTD = "INSERT INTO std_enrollment_history (idStudent, Enrolled, Enrolled_Date) VALUES (:idStudent, :enrolled, :enrolledDate)";
    $stmtHistorySTD = $conn->prepare($sqlHistorySTD);

    $stmtHistorySTD->bindParam(':idStudent', $idStudent, PDO::PARAM_STR);
    $stmtHistorySTD->bindValue(':enrolled', "Car_Manual");
    $stmtHistorySTD->bindParam(':enrolledDate', $enrolledDateHistoSTD, PDO::PARAM_STR);
    
    // Execute the statement
    $stmtHistorySTD->execute();
                
                
                
                $insertSchedManual->execute(); 
                $insertSchedManual->closeCursor(); 
            } else {
                $_SESSION['No_slot_Car_Manual'] = true;
                echo "No slot left for Car_Manual"; // No rows were updated (Slot was already 0)
            }
        } else {
            echo "Error updating slot.";
        }

        $Update_Slot_SchedManual->closeCursor();

}

else if($EnrollingforCM == "Car_Automatic"){
    $insert_Sched = "INSERT INTO `u896821908_bts`.`student_schedule_pdc`
    (`Student_Id`, `Username`, `schedule1`, `schedule2`, `Time1`, `Time2`)VALUES
    (:Student_Id, :username, :schedule1_car_automatic,:schedule2_car_automatic, :time1_car_automatic, :time2_car_automatic)";

    $insertSchedCarAuto = $conn->prepare($insert_Sched);
    $insertSchedCarAuto->bindParam(':Student_Id', $idStudent);
    $insertSchedCarAuto->bindParam(':username', $username);
    $insertSchedCarAuto->bindParam(':schedule1_car_automatic', $car_automatic_schedule1);  
    $insertSchedCarAuto->bindParam(':schedule2_car_automatic', $car_automatic_schedule2);
    $insertSchedCarAuto->bindParam(':time1_car_automatic', $car_automatic_time1);
    $insertSchedCarAuto->bindParam(':time2_car_automatic', $car_automatic_time2);
    

    $Update_SchedCarAuto = "UPDATE pdc_schedule
    SET Slot = Slot - 1
    WHERE schedule1 = :schedule1
    AND schedule2 = :schedule2
    AND time1 = :time1
    AND time2 = :time2
    AND Slot > 0;"; // Add the Slot condition

    $Update_Slot_SchedCarAuto = $conn->prepare($Update_SchedCarAuto);
    $Update_Slot_SchedCarAuto->bindParam(':schedule1', $car_automatic_schedule1);  
    $Update_Slot_SchedCarAuto->bindParam(':schedule2', $car_automatic_schedule2);
    $Update_Slot_SchedCarAuto->bindParam(':time1', $car_automatic_time1);
    $Update_Slot_SchedCarAuto->bindParam(':time2', $car_automatic_time2);

    if ($Update_Slot_SchedCarAuto->execute()) {
        $rowsAffected = $Update_Slot_SchedCarAuto->rowCount(); // Get the number of rows affected
        if ($rowsAffected > 0) {
            
              $enrolledDateHistoSTD = date("Y-m-d H:i:s");
    $sqlHistorySTD = "INSERT INTO std_enrollment_history (idStudent, Enrolled, Enrolled_Date) VALUES (:idStudent, :enrolled, :enrolledDate)";
    $stmtHistorySTD = $conn->prepare($sqlHistorySTD);

    $stmtHistorySTD->bindParam(':idStudent', $idStudent, PDO::PARAM_STR);
    $stmtHistorySTD->bindValue(':enrolled', "Car_Automatic");
    $stmtHistorySTD->bindParam(':enrolledDate', $enrolledDateHistoSTD, PDO::PARAM_STR);
    
    // Execute the statement
    $stmtHistorySTD->execute();
            
            $insertSchedCarAuto->execute();     
            $insertSchedCarAuto->closeCursor(); 
        } else {
            $_SESSION['No_slot_Car_Automatic'] = true;
            echo "No slot left for Car_Automatic"; // No rows were updated (Slot was already 0)
        }
    } else {
        echo "Error updating slot.";
    }

    $Update_Slot_SchedCarAuto->closeCursor();

}



$BalTotalsql = "UPDATE `u896821908_bts`.`student` SET
    total_amount = IFNULL(total_amount, 0) + :TotalPdc,
    balance = IFNULL(balance, 0) + :TotalPdc
WHERE
    idStudent = :StudentId;";
    $BalTotalstmt = $conn->prepare($BalTotalsql);
    $BalTotalstmt->bindParam(':StudentId', $idStudent);
    $BalTotalstmt->bindParam(':TotalPdc', $TotalPdc);
    $BalTotalstmt->execute();     


    $conn = null;

if($_POST['radio-group'] == "GCASH"){
    $_SESSION['STD_USERNAME_GCASH'] = $username;
    $_SESSION['STD_idStudent_GCASH'] = $idStudent;
    $_SESSION['STD_NAME_GCASH'] = $_POST['LastName'] . ' ' . $_POST['FirstName'];
}



} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>


