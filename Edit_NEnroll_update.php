<?php
include "conn.php";
session_start();

// Validate and sanitize the form inputs
$lastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
$firstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
$middleName = isset($_POST['MiddleName']) ? $_POST['MiddleName'] : '';
$suffix = isset($_POST['Suffix']) ? $_POST['Suffix'] : '';
$birthdate = isset($_POST['Birthdate']) ? $_POST['Birthdate'] : '';
$civilStatus = isset($_POST['CivilStatus']) ? $_POST['CivilStatus'] : '';
$contactNumber = isset($_POST['ContactNumber']) ? $_POST['ContactNumber'] : '';
$sex = isset($_POST['SEX']) ? $_POST['SEX'] : '';
$completeAddress = isset($_POST['CompleteAddress']) ? $_POST['CompleteAddress'] : '';
$city = isset($_POST['City']) ? $_POST['City'] : '';
$zipCode = isset($_POST['ZipCode']) ? $_POST['ZipCode'] : '';
$citizenship = isset($_POST['Citizenship']) ? $_POST['Citizenship'] : '';
$emailAddress = isset($_POST['EmailAdd']) ? $_POST['EmailAdd'] : '';
$password = !empty($_POST['pass']) ? $_POST['pass'] : $password;
$username = isset($_POST['Username']) ? $_POST['Username'] : '';
$newUsername = isset($_POST['NewUsername']) ? $_POST['NewUsername'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

// Retrieve the current profile picture from the database
$stmt = $conn->prepare("SELECT Profile_picture FROM student WHERE Username = :CurrentUsername");
$stmt->bindParam(':CurrentUsername', $_SESSION['username']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$currentProfilePicture = $row['Profile_picture'];

// Handle file upload for profile picture
$profilePicture = $_FILES['profile_picture']['name'];
$profilePictureTmp = $_FILES['profile_picture']['tmp_name'];

if (!empty($profilePictureTmp)) {
    $profilePicturePath = './uploads/'.basename($profilePicture);

    if (move_uploaded_file($profilePictureTmp, $profilePicturePath)) {
        $profilePicture = $profilePicturePath; // Update the profile picture path to be stored in the database
        error_log('Uploaded profile picture: ' . $profilePicture);
    } else {
        // Failed to move uploaded file
        error_log('Failed to move the uploaded file to the desired location.');
        $profilePicture = !empty($currentProfilePicture) ? $currentProfilePicture : './uploads/profileSampleCutie.jpg';
    }
} else {
    // If no new profile picture was uploaded, use the current or original picture
    $profilePicture = !empty($currentProfilePicture) ? $currentProfilePicture : './uploads/profileSampleCutie.jpg';
    error_log('No new profile picture uploaded');
}

// Check if the new username already exists
if (!empty($newUsername) && $newUsername !== $_SESSION['username']) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS num FROM student WHERE Username = :NewUsername");
    $stmt->bindParam(':NewUsername', $newUsername);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['num'] > 0) {
        // New username already exists, send a response to AJAX
        echo "username_conflict";
        $conn = null; // Close the database connection
        exit; // Stop the script execution
    }
}

if (!empty($emailAddress) && $emailAddress !== $email) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS Emailnum FROM student WHERE EmailAddress = :EmailAdd");
    $stmt->bindParam(':EmailAdd', $emailAddress);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['Emailnum'] > 0) {
      // New email already exists, send a response to AJAX
      echo "email_conflict";
      $conn = null; // Close the database connection
      exit; // Stop the script execution
    }
  }

// Prepare the SQL statement to update data in the table
$stmt = $conn->prepare("UPDATE student SET
    LastName = :LastName,
    FirstName = :FirstName,
    MiddleName = :MiddleName,
    Suffix = :Suffix,
    Birthdate = :Birthdate,
    Civilstatus = :CivilStatus,
    ContactNumber = :ContactNumber,
    Sex = :Sex,
    Address = :Address,
    City = :City,
    ZipCode = :ZipCode,
    Citizenship = :Citizenship,
    EmailAddress = :EmailAddress,
    Password = CASE WHEN :Password IS NOT NULL AND :Password <> '' THEN :Password ELSE Password END,
    Username = :NewUsername,
    Profile_picture = :ProfilePicture
    WHERE Username = :CurrentUsername");

$stmt->bindParam(':LastName', $lastName);
$stmt->bindParam(':FirstName', $firstName);
$stmt->bindParam(':MiddleName', $middleName);
$stmt->bindParam(':Suffix', $suffix);
$stmt->bindParam(':Birthdate', $birthdate);
$stmt->bindParam(':CivilStatus', $civilStatus);
$stmt->bindParam(':ContactNumber', $contactNumber);
$stmt->bindParam(':Sex', $sex);
$stmt->bindParam(':Address', $completeAddress);
$stmt->bindParam(':City', $city);
$stmt->bindParam(':ZipCode', $zipCode);
$stmt->bindParam(':Citizenship', $citizenship);
$stmt->bindParam(':EmailAddress', $emailAddress);
$stmt->bindParam(':Password', $password);
$stmt->bindParam(':NewUsername', $newUsername);
$stmt->bindParam(':ProfilePicture', $profilePicture);
$stmt->bindParam(':CurrentUsername', $_SESSION['username']);

// Execute the statement
$stmt->execute();

// Check if a row was affected
$rowCount = $stmt->rowCount();
if ($rowCount > 0) {
    // Update the session with the new username
    $_SESSION['username'] = $newUsername;

    // Send a success message
    echo "<script>alert('Profile updated successfully!');</script>";
} else {
    // Send an error message if no rows were affected
    echo "<script>alert('No records were updated.');</script>";
}

// Close the database connection
$conn = null;

?>
