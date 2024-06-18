<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $DI_id = $_POST['DI_id'];
    $di_username = $_POST['di_username'];
    $std_id = $_POST['std_id'];
    date_default_timezone_set("Asia/Manila");
    $current_date = date("Y-m-d");
   
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

    // SQL query to insert data into di_assign_tbl
    $insert_sql = "INSERT INTO u896821908_bts.di_assign_tbl (Di_Id, DI_Username, Student_id, Date)
            VALUES ('$DI_id', '$di_username', '$std_id', '$current_date')";

    if ($conn->query($insert_sql) === TRUE) {
        // Data inserted successfully, now update the Availability_status
        $update_sql = "UPDATE u896821908_bts.di SET Availability_status = 'Assigned' WHERE id_DI = '$DI_id'";
        
        if ($conn->query($update_sql) === TRUE) {
            header("Location: ../admin_Assign.php?assign");
                exit;
        } else {
             header("Location: ../admin_Assign.php?!assign");
                exit;
        }
    } else {
        header("Location: ../admin_Assign.php?!assign");
                exit;
    }

    // Close the database connection
    $conn->close();
}
?>
