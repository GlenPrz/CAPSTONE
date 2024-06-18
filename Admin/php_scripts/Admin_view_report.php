<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
include "../../conn.php";



// Fetch data for the selected student using the provided 'id'
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $report_id = $_GET['id'];
    
    try {
        $sql = "SELECT * FROM di_report_tbl WHERE report_id = :report_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':report_id', $report_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
		$DI_id = $row['DI_id'];
		$Vehicle = $row['Vehicle'];
		$student_id = $row['student_id'];
		$session = $row['session'];
		$DateofAssessment = $row['DateofAssessment'];
		$Start_Odometer = $row['Start_Odometer'];
		$End_Odometer = $row['End_Odometer'];
        $Total_odo = ($End_Odometer - $Start_Odometer);
		
			$sql_di_info = "SELECT Lastname, Firstname, ContactNumber FROM di WHERE id_DI = :DI_id";
			$stmt_di_info = $conn->prepare($sql_di_info);
			$stmt_di_info->bindParam(':DI_id', $row['DI_id'], PDO::PARAM_INT);
			$stmt_di_info->execute();
			$di_info = $stmt_di_info->fetch(PDO::FETCH_ASSOC);

			$di_full_name = $di_info['Lastname'] . ', ' . $di_info['Firstname'];
			$di_contact_number = $di_info['ContactNumber'];
			
			$sql_student_info = "SELECT * FROM student WHERE idStudent = :student_id";
			$stmt_student_info = $conn->prepare($sql_student_info);
			$stmt_student_info->bindParam(':student_id', $row['student_id'], PDO::PARAM_INT);
			$stmt_student_info->execute();
			$student_info = $stmt_student_info->fetch(PDO::FETCH_ASSOC);

			$student_full_name = $student_info['Lastname'] . ', ' . $student_info['Firstname'] . ' ' . $student_info['Middlename'];
			$student_permitNum = $student_info['Student_permit_number'];
			$student_ContactNum = $student_info['Contactnumber'];
			
			
       echo "<div id='view_report_modal' class='modal'>
				<div class='modal-content'>
					<span class='close' onclick='closeModal()'>&times;</span>
					<header class='modalhead'><h2>Report Details</h2></header>
					<div>
						<label for='report_id'>Report ID:</label>
						<p id='report_id'>$report_id</p>
					</div>
					<div>
						<label for='DI_id'>Driving Instructor ID:</label>
						<p id='DI_id'>$DI_id</p>
					</div>
					<div>
						<label for='di_full_name'>Instructor Full Name:</label>
						<p id='di_full_name'>$di_full_name</p>
					</div>
					<div>
						<label for='di_contact_number'>Instructor Contact Number:</label>
						<p id='di_contact_number'>$di_contact_number</p>
					</div>
					<div>
						<label for='Vehicle'>Vehicle:</label>
						<p id='Vehicle'>$Vehicle</p>
					</div>
					<div>
						<label for='student_id'>Student ID:</label>
						<p id='student_id'>$student_id</p>
					</div>
					<div>
						<label for='student_full_name'>Student Full Name:</label>
						<p id='student_full_name'>$student_full_name</p>
					</div>
					<div>
						<label for='student_ContactNum'>Student Contact Number:</label>
						<p id='student_ContactNum'>$student_ContactNum</p>
					</div>
					<div>
						<label for='student_permitNum'>Student Permit Number:</label>
						<p id='student_permitNum'>$student_permitNum</p>
					</div>
					<div>
						<label for='session'>Session:</label>
						<p id='session'>$session</p>
					</div>
					<div>
						<label for='DateofAssessment'>Date of Assessment:</label>
						<p id='DateofAssessment'>$DateofAssessment</p>
					</div>
					<div>
						<label for='Start_Odometer'>Start Odometer:</label>
						<p id='Start_Odometer'>$Start_Odometer Km</p>
					</div>
					<div>
						<label for='End_Odometer'>End Odometer:</label>
						<p id='End_Odometer'>$End_Odometer Km</p>
					</div>
					<div>
						<label for='Total_odo'>Total Odometer:</label>
						<p id='Total_odo'>$Total_odo Km</p>
					</div>
				</div>
			</div>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the PDO connection
$conn = null;
?>
