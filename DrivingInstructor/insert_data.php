<?php
$servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get the data from the form
    $username = $_POST['username'];
    $course = $_POST['course'];
	$session = $_POST['session'];
    $assessment = $_POST['assessment'];
	//////////////////
	$student_id = $_POST['stud_id'];
    $std_lname = $_POST['stud_lname'];
    $std_fname = $_POST['stud_fname'];
    $DI_id = $_POST['Di_id'];
    $DI_lname = $_POST['Di_lname'];
    $DI_fname = $_POST['Di_fname'];
    $odometer = $_POST['odometer'];
    $vehicle_type = $_POST['vehicleType'];
	$Brand_Model = $_POST['vehicleBrandModel'];
    $date = $_POST['date'];
    // Create a connection to the database
    $conn = new mysqli($servername, $user, $password, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the first INSERT query for di_report_tbl
    $stmt = $conn->prepare("INSERT INTO u896821908_bts.di_report_tbl (student_id, std_username, std_lname, std_fname, DI_id, DI_lname, DI_fname, odometer, vehicle_type, vehicle_brand_model, Date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssississs", $student_id, $username, $std_lname, $std_fname, $DI_id, $DI_lname, $DI_fname, $odometer, $vehicle_type, $Brand_Model, $date);

    // Execute the statement
    if ($stmt->execute()) {
        // Prepare and execute the INSERT query for PDC_result
        $stmt = $conn->prepare("INSERT INTO u896821908_bts.pdc_result (Username, PDC_Course_enrolled, session, Assessment, Date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $username, $course, $session, $assessment, $date);

        if ($stmt->execute()) {
            header("Location: di_assesment.php?success");
            exit; // Make sure to exit after the redirect
        } else {
            header("Location: di_assesment.php?failed");
            exit; // Make sure to exit after the redirect
        }
    } else {
        header("Location: di_assesment.php?failed");
        exit; // Make sure to exit after the redirect
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
