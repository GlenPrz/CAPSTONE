<?php
	
	
        $servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Retrieve the student ID from the form
		$studentId = $_POST["student_id"];

		// Prepare the SQL query with a WHERE clause to delete the record
		$sql = "DELETE FROM u896821908_bts.student WHERE idStudent = ?";

		// Create a prepared statement
		$stmt = $conn->prepare($sql);

		// Bind the student ID parameter
		$stmt->bind_param("i", $studentId);

		// Execute the statement
		if ($stmt->execute()) {
			$conn->commit(); // Manually commit the transaction
				header("Location: ../admin_enroll.php?deleted");
				exit; // Make sure to exit after the redirect
		  } else {
				header("Location: ../admin_enroll.php?not_deleted");
				exit; // Make sure to exit after the redirect
		  }

		// Close the statement
		$stmt->close();
}

// Close the database connection
$conn->close();
?>

