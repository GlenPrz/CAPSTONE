<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection file
include("../conn.php");

if (isset($_POST['TDC']) && isset($_POST['TDCSchedID']) && isset($_POST['Theoritical_schedule1']) && isset($_POST['Theoritical_schedule2']) && isset($_POST['Theoritical_time1']) && isset($_POST['Theoritical_time2'])) {
  
$studentId = $_POST['TDCSchedID']; 
$selectedSchedule1 = $_POST['Theoritical_schedule1'];
$selectedSchedule2 = $_POST['Theoritical_schedule2'];
$selectedTime1 = $_POST['Theoritical_time1'];
$selectedTime2 = $_POST['Theoritical_time2'];
$old_sched = $_POST['TDCSched'];
$Enrolled = "TDC";
$IdSched = $_POST['SchedTDCID'];

        $new_sched = "'$selectedSchedule1' -- '$selectedSchedule2' | '$selectedTime1' -- '$selectedTime2'";
        
        
$sqlCheckStd = $conn->prepare("SELECT * FROM student WHERE idStudent = :idSTD;");
$sqlCheckStd->bindParam(':idSTD', $studentId);
$sqlCheckStd->execute();
$resultCheckTDC = $sqlCheckStd->fetch(PDO::FETCH_ASSOC);
$TDCreSched = $resultCheckTDC['TDC_Resched'];
        
        

try {
//     $sqlTDCsched = "INSERT INTO std_resched (idStudent, Enrolled, old_sched, new_sched,scheduleID) 
// VALUES (:idStudent, :Enrolled, :old_sched, :new_sched, :SchedID)";

//     $stmtTDCsched = $conn->prepare($sqlTDCsched);

//     $stmtTDCsched->bindParam(':idStudent', $studentId);
//     $stmtTDCsched->bindParam(':old_sched', $old_sched);
//     $stmtTDCsched->bindParam(':new_sched', $new_sched);
//     $stmtTDCsched->bindParam(':Enrolled', $Enrolled);
//     $stmtTDCsched->bindParam(':SchedID', $IdSched);
if(!isset($TDCreSched)){

  $sql = "UPDATE student_schedule_tdc 
                SET schedule1 = :schedule1, schedule2 = :schedule2, Time1 = :time1, Time2 = :time2
                WHERE idstudent_schedule = :studentId";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':schedule1', $selectedSchedule1);
        $stmt->bindParam(':schedule2', $selectedSchedule2);
        $stmt->bindParam(':time1', $selectedTime1);
        $stmt->bindParam(':time2', $selectedTime2);
        $stmt->bindParam(':studentId', $IdSched);

    $stmt->execute();
   
        echo "Request successfully";
        
        $TDCrescheded = $conn->prepare("UPDATE student SET TDC_Resched = 1
        WHERE idStudent = :idSTD;");
$TDCrescheded->bindParam(':idSTD', $studentId);
$TDCrescheded->execute();
        
        $Update_Sched_Slot = "UPDATE tdc_schedule
SET Slot = Slot - 1
WHERE schedule1 = :schedule1
  AND schedule2 = :schedule2
  AND time1 = :time1
  AND time2 = :time2
  AND Slot > 0;"; // Add the Slot condition

$Update_Slot = $conn->prepare($Update_Sched_Slot);
$Update_Slot->bindParam(':schedule1', $selectedSchedule1);  
$Update_Slot->bindParam(':schedule2', $selectedSchedule2);
$Update_Slot->bindParam(':time1', $selectedTime1);
$Update_Slot->bindParam(':time2', $selectedTime2);
        $Update_Slot->execute();

        
        
}else{
    echo "TDCdone";
}
        

} catch (PDOException $e) {
    echo "Error updating record: " . $e->getMessage();
}

$conn = null;
} else {
    echo $_POST['TDCSched'];
}



//PDC
if (isset($_POST['PDC']) && isset($_POST['PDCSchedID']) && isset($_POST['Car_manual_schedule1']) && isset($_POST['Car_manual_schedule2']) && isset($_POST['Car_manual_time1']) && isset($_POST['Car_manual_time2'])) {
    
$studentId = $_POST['StdIDPDC']; 
$selectedSchedule1 = $_POST['Car_manual_schedule1'];
$selectedSchedule2 = $_POST['Car_manual_schedule2'];
$selectedTime1 = $_POST['Car_manual_time1'];
$selectedTime2 = $_POST['Car_manual_time2'];

$old_sched = $_POST['SchedPDC_CarManua'];
$Enrolled = "PDC: Car_manual";
$IdSched = $_POST['PDCSchedID_CarManual'];

        $new_sched = "'$selectedSchedule1' -- '$selectedSchedule2' | '$selectedTime1' -- '$selectedTime2'";

$sqlCheckPDCcar = $conn->prepare("SELECT * FROM student WHERE idStudent = :idSTD;");
$sqlCheckPDCcar->bindParam(':idSTD', $studentId);
$sqlCheckPDCcar->execute();
$resultCheckPDC = $sqlCheckPDCcar->fetch(PDO::FETCH_ASSOC);
$PDCreSched = $resultCheckPDC['PDC_Car_Resched'];

    try {
        // Prepare SQL update query with placeholders
//         $sql = "INSERT INTO std_resched (idStudent, Enrolled, old_sched, new_sched,scheduleID) 
// VALUES (:idStudent, :Enrolled, :old_sched, :new_sched, :SchedID)";

//         // Prepare the SQL statement
//          $stmt = $conn->prepare($sql);

//     $stmt->bindParam(':idStudent', $studentId);
//     $stmt->bindParam(':old_sched', $old_sched);
//     $stmt->bindParam(':new_sched', $new_sched);
//     $stmt->bindParam(':Enrolled', $Enrolled);
//     $stmt->bindParam(':SchedID', $IdSched);
if(!isset($PDCreSched)){

  $sql = "UPDATE student_schedule_pdc 
                SET schedule1 = :schedule1, schedule2 = :schedule2, Time1 = :time1, Time2 = :time2
                WHERE idstudent_schedule = :studentId";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':schedule1', $selectedSchedule1);
        $stmt->bindParam(':schedule2', $selectedSchedule2);
        $stmt->bindParam(':time1', $selectedTime1);
        $stmt->bindParam(':time2', $selectedTime2);
        $stmt->bindParam(':studentId', $IdSched);
        
        // Execute the update query
        $stmt->execute();

        echo "Record updated successfully";
        
        $PDCreschededCar = $conn->prepare("UPDATE student SET PDC_Car_Resched = 1
        WHERE idStudent = :idSTD;");
$PDCreschededCar->bindParam(':idSTD', $studentId);
$PDCreschededCar->execute();
        
        $Update_SchedManual = "UPDATE pdc_schedule
        SET Slot = Slot - 1
        WHERE schedule1 = :schedule1
        AND schedule2 = :schedule2
        AND time1 = :time1
        AND time2 = :time2
        AND Slot > 0;"; // Add the Slot condition

        $Update_Slot_SchedManual = $conn->prepare($Update_SchedManual);
        $Update_Slot_SchedManual->bindParam(':schedule1', $selectedSchedule1);  
        $Update_Slot_SchedManual->bindParam(':schedule2', $selectedSchedule2);
        $Update_Slot_SchedManual->bindParam(':time1', $selectedTime1);
        $Update_Slot_SchedManual->bindParam(':time2', $selectedTime2);
                $Update_Slot_SchedManual->execute();



}else{
        echo "PDCdone";
}
        
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating record: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
}

if (isset($_POST['PDC']) && isset($_POST['PDCSchedID_CarAuto']) && isset($_POST['Car_automatic_schedule1']) && isset($_POST['Car_automatic_schedule2']) && isset($_POST['Car_automatic_time1']) && isset($_POST['Car_automatic_time2'])) {
    $studentId = $_POST['StdIDPDC']; // Assuming PDCSchedID is the student ID
    $selectedSchedule1 = $_POST['Car_automatic_schedule1'];
    $selectedSchedule2 = $_POST['Car_automatic_schedule2'];
    $selectedTime1 = $_POST['Car_automatic_time1'];
    $selectedTime2 = $_POST['Car_automatic_time2'];

$old_sched = $_POST['SchedPDC_CarAuto'];
$Enrolled = "PDC: Car_automatic";
$IdSched = $_POST['PDCSchedID_CarAuto'];

        $new_sched = "'$selectedSchedule1' -- '$selectedSchedule2' | '$selectedTime1' -- '$selectedTime2'";

$sqlCheckPDCcar = $conn->prepare("SELECT * FROM student WHERE idStudent = :idSTD;");
$sqlCheckPDCcar->bindParam(':idSTD', $studentId);
$sqlCheckPDCcar->execute();
$resultCheckPDC = $sqlCheckPDCcar->fetch(PDO::FETCH_ASSOC);
$PDCreSched = $resultCheckPDC['PDC_Car_Resched'];

    try {
        // Prepare SQL update query with placeholders
//       $sql = "INSERT INTO std_resched (idStudent, Enrolled, old_sched, new_sched,scheduleID) 
// VALUES (:idStudent, :Enrolled, :old_sched, :new_sched, :SchedID)";

//         $stmt = $conn->prepare($sql);

//     $stmt->bindParam(':idStudent', $studentId);
//     $stmt->bindParam(':old_sched', $old_sched);
//     $stmt->bindParam(':new_sched', $new_sched);
//     $stmt->bindParam(':Enrolled', $Enrolled);
//     $stmt->bindParam(':SchedID', $IdSched);
if(!isset($PDCreSched)){

  $sql = "UPDATE student_schedule_pdc 
                SET schedule1 = :schedule1, schedule2 = :schedule2, Time1 = :time1, Time2 = :time2
                WHERE idstudent_schedule = :studentId";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':schedule1', $selectedSchedule1);
        $stmt->bindParam(':schedule2', $selectedSchedule2);
        $stmt->bindParam(':time1', $selectedTime1);
        $stmt->bindParam(':time2', $selectedTime2);
        $stmt->bindParam(':studentId', $IdSched);



        // Execute the update query
        $stmt->execute();

        echo "Record updated successfully";
        
         $PDCreschededCar = $conn->prepare("UPDATE student SET PDC_Car_Resched = 1
        WHERE idStudent = :idSTD;");
$PDCreschededCar->bindParam(':idSTD', $studentId);
$PDCreschededCar->execute();

$Update_SchedCarAuto = "UPDATE pdc_schedule
    SET Slot = Slot - 1
    WHERE schedule1 = :schedule1
    AND schedule2 = :schedule2
    AND time1 = :time1
    AND time2 = :time2
    AND Slot > 0;"; // Add the Slot condition

    $Update_Slot_SchedCarAuto = $conn->prepare($Update_SchedCarAuto);
    $Update_Slot_SchedCarAuto->bindParam(':schedule1', $selectedSchedule1);  
    $Update_Slot_SchedCarAuto->bindParam(':schedule2', $selectedSchedule2);
    $Update_Slot_SchedCarAuto->bindParam(':time1', $selectedTime1);
    $Update_Slot_SchedCarAuto->bindParam(':time2', $selectedTime2);
                $Update_Slot_SchedCarAuto->execute();

}else{
            echo "PDCdone";
}
        
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating record: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
} 






if (isset($_POST['PDC']) && isset($_POST['PDCSchedID_Mmanual']) && isset($_POST['motor_manual_schedule1']) && isset($_POST['motor_manual_schedule2']) && isset($_POST['motor_manual_time1']) && isset($_POST['motor_manual_time2'])) {
    $studentId = $_POST['PDCSchedID_Mmanual']; // Assuming PDCSchedID is the student ID for motor_manual
    $selectedSchedule1 = $_POST['motor_manual_schedule1'];
    $selectedSchedule2 = $_POST['motor_manual_schedule2'];
    $selectedTime1 = $_POST['motor_manual_time1'];
    $selectedTime2 = $_POST['motor_manual_time2'];
    $STDMmanual = $_POST['PDCMmanual'];
    
    
    
$sqlCheckPDMotor = $conn->prepare("SELECT * FROM student WHERE idStudent = :idSTD;");
$sqlCheckPDMotor->bindParam(':idSTD', $STDMmanual);
$sqlCheckPDMotor->execute();
$resultCheckPDC = $sqlCheckPDMotor->fetch(PDO::FETCH_ASSOC);
$PDCreSched = $resultCheckPDC['PDC_Motor_Resched'];
    
    try {
        if(!isset($PDCreSched)){
        // Prepare SQL update query with placeholders
        $sql = "UPDATE student_schedule_pdc 
                SET schedule1 = :schedule1, schedule2 = :schedule2, Time1 = :time1, Time2 = :time2
                WHERE idstudent_schedule = :studentId";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':schedule1', $selectedSchedule1);
        $stmt->bindParam(':schedule2', $selectedSchedule2);
        $stmt->bindParam(':time1', $selectedTime1);
        $stmt->bindParam(':time2', $selectedTime2);
        $stmt->bindParam(':studentId', $studentId);

        // Execute the update query
        $stmt->execute();

        echo "Record updated successfully";
        
         $PDCreschededMotor = $conn->prepare("UPDATE student SET PDC_Motor_Resched = 1
        WHERE idStudent = :idSTD;");
$PDCreschededMotor->bindParam(':idSTD', $STDMmanual);
$PDCreschededMotor->execute();


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
                $Update_Slot_SchedMotorManual->execute();

        
        }else{
                    echo "PDCMotordone";
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating record: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
}

if (isset($_POST['PDC']) && isset($_POST['PDCSchedM_auto']) && isset($_POST['motor_automatic_schedule1']) && isset($_POST['motor_automatic_schedule2']) && isset($_POST['motor_automatic_time1']) && isset($_POST['motor_automatic_time2'])) {
    $STDMAuto = $_POST['PDCStdIdM_auto'];
    $studentId = $_POST['PDCSchedM_auto']; // Assuming PDCSchedID is the student ID for motor_manual
    $selectedSchedule1 = $_POST['motor_automatic_schedule1'];
    $selectedSchedule2 = $_POST['motor_automatic_schedule2'];
    $selectedTime1 = $_POST['motor_automatic_time1'];
    $selectedTime2 = $_POST['motor_automatic_time2'];

$sqlCheckPDMotor = $conn->prepare("SELECT * FROM student WHERE idStudent = :idSTD;");
$sqlCheckPDMotor->bindParam(':idSTD', $STDMAuto);
$sqlCheckPDMotor->execute();
$resultCheckPDC = $sqlCheckPDMotor->fetch(PDO::FETCH_ASSOC);
$PDCreSched = $resultCheckPDC['PDC_Motor_Resched'];

    try {
        
        if(!isset($PDCreSched)){
        // Prepare SQL update query with placeholders
        $sql = "UPDATE student_schedule_pdc 
                SET schedule1 = :schedule1, schedule2 = :schedule2, Time1 = :time1, Time2 = :time2
                WHERE idstudent_schedule = :studentId";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':schedule1', $selectedSchedule1);
        $stmt->bindParam(':schedule2', $selectedSchedule2);
        $stmt->bindParam(':time1', $selectedTime1);
        $stmt->bindParam(':time2', $selectedTime2);
        $stmt->bindParam(':studentId', $studentId);

        // Execute the update query
        $stmt->execute();

        echo "Record updated successfully";
        
         $PDCreschededCar = $conn->prepare("UPDATE student SET PDC_Motor_Resched = 1
        WHERE idStudent = :idSTD;");
$PDCreschededCar->bindParam(':idSTD', $STDMAuto);
$PDCreschededCar->execute();


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
                        $Update_Slot_SchedMotorAuto->execute();

        }else{
                    echo "PDCMotordone";
            
        }
        
        // 
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error updating record: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
} 


}
?>


