<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "../../conn.php";

// Load Composer's autoloader
require '../../vendor/autoload.php';

$stud_id = $_POST['stud_id'];
$firstname = $_POST['firstname'];
$reason = $_POST['Main_reason'];
$otherReason = $_POST['additional_comments'];



//update the value of enrollment status, total amount and balance to null
	$query = "UPDATE student SET Enroll_Status = NULL, total_amount = NULL, balance = NULL, `PDC-MOTOR` = NULL, `PDC-CAR` = NULL, TDC = NULL  WHERE idStudent = :stud_id";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':stud_id', $stud_id);
	$stmt->execute();
	
//Delete all the online payment of the student
	$query2 = "DELETE FROM olpayment_tb WHERE student_id LIKE :stud_id";
	$stmt2 = $conn->prepare($query2);
	$stmt2->bindParam(':stud_id', $stud_id);
	$stmt2->execute();

// UPDATE AND DELETE THE PDC SCHEDULES ASSIGNED FOR THE STUDENT
try {
    $stmt3 = $conn->prepare("SELECT DISTINCT schedule1, schedule2, time1, time2 FROM student_schedule_pdc WHERE Student_Id = $stud_id");
    $stmt3->execute();

    // Fetch data
    $result = $stmt3->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        // Get the values
        $distinctSchedule1 = $row['schedule1'];
        $distinctSchedule2 = $row['schedule2'];
        $distinctTime1 = $row['time1'];
        $distinctTime2 = $row['time2'];

        // Update 'slot' column in pdc_schedule
        $updateStmt = $conn->prepare("UPDATE pdc_schedule SET slot = slot + 1 WHERE schedule1 = :schedule1 AND schedule2 = :schedule2 AND time1 = :time1 AND time2 = :time2 ORDER BY slot ASC LIMIT 1");
        $updateStmt->bindParam(':schedule1', $distinctSchedule1);
        $updateStmt->bindParam(':schedule2', $distinctSchedule2);
        $updateStmt->bindParam(':time1', $distinctTime1);
        $updateStmt->bindParam(':time2', $distinctTime2);
        $updateStmt->execute();

        // Delete the row in student_schedule_pdc
        $deleteStmt = $conn->prepare("DELETE FROM student_schedule_pdc WHERE Student_Id = :stud_id AND schedule1 = :schedule1 AND schedule2 = :schedule2 AND time1 = :time1 AND time2 = :time2 LIMIT 1");
        $deleteStmt->bindParam(':stud_id', $stud_id);
        $deleteStmt->bindParam(':schedule1', $distinctSchedule1);
        $deleteStmt->bindParam(':schedule2', $distinctSchedule2);
        $deleteStmt->bindParam(':time1', $distinctTime1);
        $deleteStmt->bindParam(':time2', $distinctTime2);
        $deleteStmt->execute();
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// UPDATE AND DELETE THE TDC SCHEDULES ASSIGNED FOR THE STUDENT
try {
    $stmt3 = $conn->prepare("SELECT DISTINCT schedule1, schedule2, time1, time2 FROM student_schedule_tdc WHERE Student_Id = $stud_id");
    $stmt3->execute();

    // Fetch data
    $result = $stmt3->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        // Get the values
        $distinctSchedule1TDC = $row['schedule1'];
        $distinctSchedule2TDC = $row['schedule2'];
        $distinctTime1TDC = $row['time1'];
        $distinctTime2TDC = $row['time2'];

        // Update 'slot' column in pdc_schedule
        $updateStmt = $conn->prepare("UPDATE tdc_schedule SET slot = slot + 1 WHERE schedule1 = :schedule1 AND schedule2 = :schedule2 AND time1 = :time1 AND time2 = :time2 ORDER BY slot ASC LIMIT 1");
        $updateStmt->bindParam(':schedule1', $distinctSchedule1TDC);
        $updateStmt->bindParam(':schedule2', $distinctSchedule2TDC);
        $updateStmt->bindParam(':time1', $distinctTime1TDC);
        $updateStmt->bindParam(':time2', $distinctTime2TDC);
        $updateStmt->execute();

        // Delete the row in student_schedule_pdc
        $deleteStmt = $conn->prepare("DELETE FROM student_schedule_tdc WHERE Student_Id = :stud_id AND schedule1 = :schedule1 AND schedule2 = :schedule2 AND time1 = :time1 AND time2 = :time2 LIMIT 1");
        $deleteStmt->bindParam(':stud_id', $stud_id);
        $deleteStmt->bindParam(':schedule1', $distinctSchedule1TDC);
        $deleteStmt->bindParam(':schedule2', $distinctSchedule2TDC);
        $deleteStmt->bindParam(':time1', $distinctTime1TDC);
        $deleteStmt->bindParam(':time2', $distinctTime2TDC);
        $deleteStmt->execute();
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}


$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'besttrainingschool101@gmail.com';
$mail->Password = 'ncbccimktisvuzzq';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('besttrainingschool101@gmail.com');
$mail->addAddress($_POST["email"]);
$mail->isHTML(true);
$mail->Subject = 'Enrollment Denied';

// Email body
$mail->Body = '<!DOCTYPE html>
<html>
<head>
<style>
    /* Inline CSS */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 80%;
        margin: 0 auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .logo {
        max-width: 150px;
        height: auto;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co/tQ3HVch/bts-logo.png" alt="BTS DRIVING SCHOOL" class="logo">
            <h1>ENROLLMENT DENIED</h1><br>
        </div>
        <p><b>Hello ' . $firstname . '</b>,<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;We hope this email finds you well. It is with regret to inform you that your enrollment application has been denied
			at BTS Driving School. The reason for denial is due to ' . $reason. '. Upon careful review of the information provided during the enrollment process,
			we found out that you inserted an ' . $reason. ', which are crucial for the enrollment process.<br>
			<b>Reason: </b>' . $reason. ', <br><b>Detail: </b>' . $otherReason . '<br><br>
			We will automatically delete your enrollment for this reason. You can still enroll by loging-in your account in https://btsdrivingschool.website/login.php.<br><br>
			If you believe this is an error or if you have any further questions, please don\'t hesitate to reach out to our dedicated admissions team at besttrainingschool101@gmail.com.
			We understand that these situations can be challenging, and we are here to assist you in resolving any concerns you may have regarding your enrollment. 
			Your journey towards safe driving and success on the road are our top priorities. We are dedicated to providing the guidance and support you need to become a confident and responsible driver. 
			Keep safe on the road, and we look forward to assisting you in achieving your driving goals!<br><br><br>
			BTS Driving School
        </p>
    </div>
</body>
</html>';

try {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loading...</title>
        <style>
            body {
				font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
				background-color: #f4f4f4;
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				margin: 0;
			}

			.loader-container {
				text-align: center;
			}

			.loader {
				border: 8px solid #4CAF50; /* Green border */
				border-top: 8px solid #ffffff; /* White border for top */
				border-radius: 50%;
				width: 60px; /* Adjusted width */
				height: 60px; /* Adjusted height */
				animation: spin 1s linear infinite;
				margin: 20px auto; /* Center the loader */
			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
        </style>
    </head>
    <body>
        <div class="loader"></div>
    </body>
    </html>';

    ob_flush();
    flush();

    $mail->send();
    echo '<script>window.location.href="../admin_enroll.php?Denied";</script>';
    exit;
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
