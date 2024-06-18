<?php
// ./php_scripts/Admin_Adding_Teller_Admin.php
include "../../conn.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Admmin Personal Details
    $lastName = $_POST['DI_LastName'];
    $firstName = $_POST['DI_FirstName'];
    $middleName = $_POST['DI_MiddleName'];
    $suffix = $_POST['DI_Suffix'];

    // Other Details
    $birthdate = $_POST['DI_Birthdate'];
    $civilStatus = $_POST['DI_CivilStatus'];
    $sex = $_POST['SEX'];
    $contactNumber = $_POST['DI_ContactNumber'];

    // Address Details
    $completeAddress = $_POST['DI_CompleteAddress'];
    $city = $_POST['DI_City'];
    $zipCode = $_POST['DI_ZipCode'];
    $citizenship = $_POST['DI_Citizenship'];

    // Account Details
    $emailAddress = $_POST['DI_EmailAdd'];
    $username = $_POST['Username'];
    $password = $_POST['DI_pass'];

    $Role = $_POST['AdminRole'];

    // Process the data as needed, e.g., store in a database
// Prepare the SQL statement
$sql = "INSERT INTO admin (Lastname, Firstname, Middlename, Suffix, Birthdate, Civilstatus, Contactnumber, Sex, Address, ZipCode, Citizenship, picture, City, EmailAddress, Password, Username, Role) VALUES (:lastName, :firstName, :middleName, :suffix, :birthdate, :civilStatus, :contactNumber, :sex, :completeAddress, :zipCode, :citizenship, NULL, :city, :emailAddress, :password, :username, :role)";

// Use PDO prepared statements to prevent SQL injection
$stmt = $conn->prepare($sql);

$stmt->bindParam(':lastName', $lastName);
$stmt->bindParam(':firstName', $firstName);
$stmt->bindParam(':middleName', $middleName);
$stmt->bindParam(':suffix', $suffix);
$stmt->bindParam(':birthdate', $birthdate);
$stmt->bindParam(':civilStatus', $civilStatus);
$stmt->bindParam(':contactNumber', $contactNumber);
$stmt->bindParam(':sex', $sex);
$stmt->bindParam(':completeAddress', $completeAddress);
$stmt->bindParam(':zipCode', $zipCode);
$stmt->bindParam(':citizenship', $citizenship);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':emailAddress', $emailAddress);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':role', $Role);

$result = $stmt->execute();



if ($result) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . $stmt->errorInfo()[2];
}

// Close the database connection
$conn = null;
}
?>
