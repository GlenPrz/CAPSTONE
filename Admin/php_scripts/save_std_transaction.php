<?php
session_start();
// Establish a database connection (replace with your database credentials)
    $servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Initialize variables to store form data
$stud_id = "";
$course_enrolled = "";
$lastname = "";
$firstname = "";
$middlename = "";
$birthdate = "";
$civilstatus = "";
$contactnum = "";
$gender = "";
$completeaddress = "";
$enrollmentstatus = "";
$balance_before = "";
$paid = "";
$date_of_payment = "";
$remarks = "";
$date_enrolled = "";
date_default_timezone_set("Asia/Manila");
$current_time = date("Y-m-d h:i:s A"); // Get the current date and time in the format "YYYY-MM-DD HH:MM:SS"
$current_date = date("Y-m-d");


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    // Retrieve data from the form
	$stud_id = $_POST['stud_id'];
	$course_enrolled = $_POST['course_enrolled_for_transaction'];
	$date_enrolled = $_POST['date_enrolled'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname1'];
    $middlename = $_POST['middlename'];
    $birthdate = $_POST['birthdate'];
    $civilstatus = $_POST['civilstatus'];
    $contactnum = $_POST['contactnum'];
    $gender = $_POST['gender'];
	$email = $_POST['email']; 
    $completeaddress = $_POST['completeaddress'];
    $enrollmentstatus = $_POST['enrollmentstatus'];
    //$balance_before = $_POST['balance'];
    $paid = $_POST['paid'];
    $date_of_payment = $_POST['date_of_payment'];
    $remarks = $_POST['remarks'];
	$Receiver_id = $_SESSION['Adminid'];
	
	// Retrieve student data from the "student" table
	$select_student_sql = "SELECT * FROM student WHERE idStudent = '$stud_id'";
	$result = $conn->query($select_student_sql);

	if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $balance_before = (int)$row['balance']; // Convert balance to integer
		$isTrue = false;
        // Check if enrollmentstatus is "pending"
        if ($enrollmentstatus === "pending") {
            $enrollmentstatus = "enrolled"; // Set enrollmentstatus to "enrolled" when it's "pending"
            $date_enrolled = $current_date;
			$isTrue = true;
			
        }
		//EMAIL CONFIRMATION EMAIL
			echo '
				<form class="" action="EC_email.php" method="post" id="Send_form">
					<input type="hidden" class="hidden-input" name="email" value="' . $email . '">
					<input type="hidden" class="hidden-input" name="subject" value="BTS Driving School: Enrollment Confirmation">
					<input type="hidden" class="hidden-input" name="date" value="'.   $date_enrolled .'">
					<input type="hidden" class="hidden-input" name="firstname" value="'.   $firstname .'">
				</form>';
				
        // SQL query to insert data into the "student_transaction" table
        $sql = "INSERT INTO student_transaction (Receiver_id, student_id, Amount_paid, Submit_date, Transaction_Time, Transaction_Remark, Course)
                VALUES ('$Receiver_id', '$stud_id', '$paid', '$date_of_payment', '$current_time', '$remarks', '$course_enrolled')";

        if ($conn->query($sql) === TRUE) {
            // Computation for BALANCE
            $balance_after = $balance_before - $paid;

            // SQL query to update the "student" table
            $update_sql = "UPDATE student SET Enroll_Status = '$enrollmentstatus', balance = '$balance_after', DateOfEnrolled = '$date_enrolled' WHERE idStudent = '$stud_id'";

            if ($conn->query($update_sql) === TRUE) {
              
				if ($isTrue) {
					echo '<script>
						document.getElementById("Send_form").submit(); // Submit the form
						</script>';
				}else{
                header("Location: ../admin_enroll.php?Paid");
                exit;
				}
            } else {
                // Handle the case where the update query fails
                header("Location: ../admin_enroll.php?UpdateFailed");
                exit;
            }
        } else {
            // Handle the case where the insert query fails
            header("Location: ../admin_enroll.php?InsertFailed");
            exit;
        }
    } else {
        // Handle the case where the student ID doesn't exist in the database
        header("Location: ../admin_enroll.php?StudentNotFound");
        exit;
    }
	
	
	


	
	
	
	
}

// Close the database connection
$conn->close();
?>
