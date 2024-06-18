<?php
include "../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get the data from the form
    $student_id = $_POST['stud_id'];
    $std_username = $_POST['stud_username'];
    $std_lname = $_POST['stud_lname'];
    $std_fname = $_POST['stud_fname'];
    $DI_id = $_POST['Di_id'];
    $DI_lname = $_POST['Di_lname'];
    $DI_fname = $_POST['Di_fname'];
    $odometer = $_POST['odometer'];
    $vehicle_type = $_POST['vehicleType'];
	$Brand_Model = $_POST['vehicleBrandModel'];
    $date = $_POST['date'];

    try {
        // Prepare and execute the INSERT query
        $stmt = $conn->prepare("INSERT INTO u896821908_bts.di_report_tbl (student_id, std_username, std_lname, std_fname, DI_id, DI_lname, DI_fname, odometer, vehicle_type, Brand_Model, Date) 
                        VALUES (:student_id, :std_username, :std_lname, :std_fname, :DI_id, :DI_lname, :DI_fname, :odometer, :vehicle_type, :Brand_Model, :date)");

		// ...

		// Bind parameters
		$stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
		$stmt->bindParam(':std_username', $std_username, PDO::PARAM_STR);
		$stmt->bindParam(':std_lname', $std_lname, PDO::PARAM_STR);
		$stmt->bindParam(':std_fname', $std_fname, PDO::PARAM_STR);
		$stmt->bindParam(':DI_id', $DI_id, PDO::PARAM_INT);
		$stmt->bindParam(':DI_lname', $DI_lname, PDO::PARAM_STR);
		$stmt->bindParam(':DI_fname', $DI_fname, PDO::PARAM_STR);
		$stmt->bindParam(':odometer', $odometer, PDO::PARAM_INT);
		$stmt->bindParam(':vehicle_type', $vehicle_type, PDO::PARAM_STR);
		$stmt->bindParam(':Brand_Model', $Brand_Model, PDO::PARAM_STR); // Bind the input value for brand and model
		$stmt->bindParam(':date', $date, PDO::PARAM_STR);


        if ($stmt->execute()) {
            header("Location: di_reports.php?success");
            exit; // Make sure to exit after the redirect
        } else {
            header("Location: di_reports.php?failed");
            exit; // Make sure to exit after the redirect
        }
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>
