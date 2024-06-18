<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Database connection configuration
    $servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	// Set the timezone to Philippines
	date_default_timezone_set('Asia/Manila');

	// Get the current date and time in the Philippines
	$currentDate = date('Y-m-d H:i:s'); // Change the format as needed
	$student_id = $_POST["std_id"];
	$session = $_POST["session"];
	$course = $_POST["course"];
	$DI_id = $_POST["DI_id"];
	$StartOdo = $_POST["StartOdo"];
	
	$totalRating = 0;
	$question_count = 0;
   foreach ($_POST as $question => $rating) {
		$rating = intval($rating);
		if ($rating >= 1 && $rating <= 5) {
			$sql = "INSERT INTO u896821908_bts.pdc_assessment (DI_id, std_id, session, Course, Q_title, rate, Assessment_Date)
					VALUES ('$DI_id', '$student_id', '$session', '$course', '$question', '$rating', '$currentDate')";

			// Insert the new assessment data
			if ($conn->query($sql) !== TRUE) {
				echo "Error inserting record: " . $conn->error;
			}
			$question_count++;
			$totalRating = $totalRating + $rating;

			// Add code to delete rows where Q_title is equal to DI_id or session
			$deleteSql = "DELETE FROM u896821908_bts.pdc_assessment WHERE Q_title = 'DI_id' OR Q_title = 'session'";
			if ($conn->query($deleteSql) !== TRUE) {
				echo "Error deleting records: " . $conn->error;
        }
    }
}
	$question_count -= 1;
	//$totalRating2 = $totalRating - ($DI_id + $session);
    // Close the database connection
    $conn->close();
	session_start();
    $_SESSION['totalRating'] = $totalRating;
	$_SESSION['Di_id'] = $DI_id;
	$_SESSION['question_count'] = $question_count;
	$_SESSION['Di_StudentId'] = $student_id;
	$_SESSION['Di_Student_course'] = $course;
	$_SESSION['Di_Student_session'] = $session;
	$_SESSION['Di_Student_currentDate'] = $currentDate;
	$_SESSION['Start_Odometer'] = $StartOdo;
	
    // Redirect to another page (summary.php) with assessment data as URL parameters
    header("Location: summary.php?" . http_build_query($_POST));
    exit;
}
?>
