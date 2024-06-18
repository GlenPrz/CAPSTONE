<?php
  include "conn.php";
  session_start();
  $username = $_SESSION['UsernameTDC'];  

  echo $_POST['radio-group'];

  try {

    $selectedSchedule1 = $_POST["schedule1"];
    $selectedTime1 = $_POST["time1"];
    $selectedSchedule2 = $_POST["schedule2"];
    $selectedTime2 = $_POST["time2"];


    
//     echo "Selected Schedule 1: " . $selectedSchedule1 . "<br>";
// echo "Selected Time 1: " . $selectedTime1 . "<br>";
// echo "Selected Schedule 2: " . $selectedSchedule2 . "<br>";
// echo "Selected Time 2: " . $selectedTime2 . "<br>";

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
            BirthCertType = :Bcerttype,
            BirthCert = :pdf_pathSP
        WHERE Username = :Username");

    $stmt->bindParam(':Username', $username);
    $stmt->bindParam(':LastName', $_POST['PLastName']);
    $stmt->bindParam(':FirstName', $_POST['PFirstName']);
    $stmt->bindParam(':MiddleName', $_POST['PMiddleName']);
    $stmt->bindParam(':Suffix', $_POST['PSuffix']);
    $stmt->bindParam(':Birthdate', $_POST['BirthdateP']);
    $stmt->bindParam(':CivilStatus', $_POST['CivilStatusP']);
    $stmt->bindParam(':ContactNumber', $_POST['ContactNumberP']);
    $stmt->bindParam(':Sex', $_POST['SEXP']);
    $stmt->bindParam(':Address', $_POST['CompleteAddressP']);
    $stmt->bindParam(':City', $_POST['CityP']);
    $stmt->bindParam(':ZipCode', $_POST['ZipCodeP']);
    $stmt->bindParam(':Citizenship', $_POST['CitizenshipP']);
    $stmt->bindParam(':Contact_person', $_POST['ContactPersonP']);
    $stmt->bindParam(':Contact_person_number', $_POST['ConPersonNumP']);
    $stmt->bindParam(':Relationship', $_POST['RelationshipP']);
    $stmt->bindParam(':Bcerttype', $_POST['BirthCertype']);

    $stmt->bindParam(':pdf_pathSP', $_SESSION['pdfPath']);

    $stmt->bindValue(':Enroll_Status', "pending");
    $stmt->bindValue(':Role', "Student");

    $currentDate = date('Y-m-d');
    $stmt->bindValue(':DateOfEnrolled', $currentDate);

    // GET STUDENT ID GET STUDENT ID GET STUDENT ID GET STUDENT ID GET STUDENT ID GET STUDENT ID
   
    $sqlSTDId = "SELECT idStudent FROM u896821908_bts.student WHERE Username = :Username";
    $stmtStdId = $conn->prepare($sqlSTDId);
    $stmtStdId->bindParam(':Username', $username, PDO::PARAM_STR); // Make sure to specify the data type
    $stmtStdId->execute();

    $resultStd_ID = $stmtStdId->fetch(PDO::FETCH_ASSOC); // Specify fetching as associative array
    
    if ($resultStd_ID) {
        $idStudent = $resultStd_ID['idStudent'];
    }
    $stmtStdId->closeCursor();


    // GET STUDENT ID GET STUDENT ID GET STUDENT ID GET STUDENT ID GET STUDENT ID GET STUDENT ID

    $insert_Sched = "INSERT INTO `u896821908_bts`.`student_schedule_tdc`
    (`Student_Id`, `Username`, `schedule1`, `schedule2`, `Time1`, `Time2`)
    VALUES (:Student_Id, :username, :schedule1, :schedule2, :time1, :time2)";

    $insertSched = $conn->prepare($insert_Sched);
    $insertSched->bindParam(':Student_Id', $idStudent);
    $insertSched->bindParam(':username', $username);
    $insertSched->bindParam(':schedule1', $selectedSchedule1);  
    $insertSched->bindParam(':schedule2', $selectedSchedule2);
    $insertSched->bindParam(':time1', $selectedTime1);
    $insertSched->bindParam(':time2', $selectedTime2);
    $insertSched->execute();
    $insertSched->closeCursor();

    $Update_Bal_total_Student = "
    UPDATE u896821908_bts.student 
    SET
        total_amount = IFNULL(total_amount, 0) + :totalAmt,
        balance = IFNULL(balance, 0) + :bal
    WHERE idStudent = :Student_Id
";

 $sqlTDCPrice = "SELECT * FROM `course_enrolled` WHERE `Course` = 'TDC'";

    // Prepare and execute the query
    $stmtTDCPrice = $conn->prepare($sqlTDCPrice);
    $stmtTDCPrice->execute();
    $resultTDCPrice = $stmtTDCPrice->fetchAll(PDO::FETCH_ASSOC);

  foreach ($resultTDCPrice as $rowTDCPrice) {
        // Access the "Course" column value
        $coursePrice = $rowTDCPrice["Price"];
    }







$insert_Bal_total_Student = $conn->prepare($Update_Bal_total_Student);
$insert_Bal_total_Student->bindParam(':Student_Id', $idStudent, PDO::PARAM_INT);

$totalAmt = $_POST['TDC_Price'];
$bal = $_POST['TDC_Price'];

$insert_Bal_total_Student->bindParam(':totalAmt', $totalAmt, PDO::PARAM_INT);
$insert_Bal_total_Student->bindParam(':bal', $bal, PDO::PARAM_INT);
$insert_Bal_total_Student->execute();
$insert_Bal_total_Student->closeCursor();



    // Execute the student update query
    $stmt->execute();
    $stmt->closeCursor();

    // Enroll the student
    $stmtEnroll = $conn->prepare("UPDATE u896821908_bts.student SET TDC = :TDC where Username = :Username;");
    $stmtEnroll->bindParam(':Username', $_SESSION["UsernameTDC"]);
    $stmtEnroll->bindValue(':TDC', "Enrolling");
    // Execute the student enrollment query
    $stmtEnroll->execute();
    $stmtEnroll->closeCursor();


    $enrolledDateHistoSTD = date("Y-m-d H:i:s");
    $sqlHistorySTD = "INSERT INTO u896821908_bts.std_enrollment_history (idStudent, Enrolled, Enrolled_Date) VALUES (:idStudent, :enrolled, :enrolledDate)";
    $stmtHistorySTD = $conn->prepare($sqlHistorySTD);

    $stmtHistorySTD->bindParam(':idStudent', $idStudent, PDO::PARAM_STR);
    $stmtHistorySTD->bindValue(':enrolled', "TDC");
    $stmtHistorySTD->bindParam(':enrolledDate', $enrolledDateHistoSTD, PDO::PARAM_STR);
    
    // Execute the statement
    $stmtHistorySTD->execute();



// UPDATE SCHEDULE SLOT // UPDATE SCHEDULE SLOT // UPDATE SCHEDULE SLOT // UPDATE SCHEDULE SLOT
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

if ($Update_Slot->execute()) {
    $rowsAffected = $Update_Slot->rowCount(); // Get the number of rows affected
    if ($rowsAffected > 0) {
        echo "Success";
    } else {
        echo "No slot left."; // No rows were updated (Slot was already 0)
    }
} else {
    echo "Error updating slot.";
}

$Update_Slot->closeCursor();

if($_POST['radio-group'] == "GCASH"){
    $_SESSION['STD_USERNAME_GCASH'] = $username;
    $_SESSION['STD_idStudent_GCASH'] = $idStudent;
    $_SESSION['STD_NAME_GCASH'] = $_POST['PLastName'] . ' ' . $_POST['PFirstName'];
}
     
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally{
    $conn = null;
}

?>


