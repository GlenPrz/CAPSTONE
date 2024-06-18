<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
	$studentId = $_POST['studentId'];
    $lastName = $_POST['LastName'];
    $firstName = $_POST['FirstName'];
    $middleName = $_POST['MiddleName'];
    $suffix = $_POST['Suffix'];
    $stdPermitNum = $_POST['StdperNum'];
    $expDate = $_POST['exp_date'];
	//$StudentPermit = $_POST['StudentPermit'];
	$Birthdate = $_POST['Birthdate'];
	$SEX = $_POST['SEX'];
	$ContactNumber = $_POST['ContactNumber'];
	$CompleteAddress = $_POST['CompleteAddress'];
	$City = $_POST['City'];
	$ZipCode = $_POST['ZipCode'];
	$Citizenship = $_POST['Citizenship'];
	$ClientID = $_POST['ClientID']; 
	$ContactPerson = $_POST['ContactPerson'];
	$ConPersonNum = $_POST['ConPersonNum'];
	$Relationship = $_POST['Relationship'];

    // Retrieve other form fields in a similar manner

    // Process the data as needed
    // For example, you can insert it into a database, send an email, etc.

    // Here's an example of inserting data into a database using MySQLi:
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

    
// Construct the SQL UPDATE statement
$sql = "UPDATE u896821908_bts.student 
        SET LastName = '$lastName', 
            FirstName = '$firstName', 
            MiddleName = '$middleName', 
            Suffix = '$suffix', 
            Student_permit_number = '$stdPermitNum', 
            Expiration_student_permit = '$expDate', 
            Birthdate = '$Birthdate', 
            Sex = '$SEX', 
            Contactnumber = '$ContactNumber', 
            Address = '$CompleteAddress', 
            City = '$City', 
            ZipCode = '$ZipCode', 
            Citizenship = '$Citizenship', 
			LTO_Client_ID = '$ClientID',
            Contact_Person = '$ContactPerson', 
            Contact_Person_number = '$ConPersonNum', 
            Relationship = '$Relationship'
        WHERE idStudent = $studentId";

// Execute the SQL query
if ($conn->query($sql) === TRUE) {
		 // Redirect back to the last page with 'update' added to the URL
    echo '<script>alert("Record updated successfully."); history.go(-1);</script>';
    exit;
		exit;
} else {
		echo '<script>alert("Record has not been updated.<br>Please try again."); history.go(-1);</script>';
		exit;
}

    // Close the database connection
    $conn->close();

    // You can also perform other actions like sending emails, etc.
} else {
    // If the form was not submitted, handle this case
    echo "Form not submitted.";
}
?>
