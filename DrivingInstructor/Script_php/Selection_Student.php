<?php
include "../conn.php";
$userdataret = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM u896821908_bts.di WHERE Username = :studentUsername");
$stmt->bindParam(':studentUsername', $userdataret); // Replace $studentId with the actual student ID
$stmt->execute();
$studentData = $stmt->fetch(PDO::FETCH_ASSOC);

// Assign the retrieved data to variables
$lastName = $studentData['Lastname'];
$firstName = $studentData['Firstname'];
$middleName = $studentData['Midllename'];
$suffix = $studentData['Suffix'];
$birthdate = $studentData['Birthdate'];
$civilStatus = $studentData['Civil_status'];
$contactNumber = $studentData['ContactNumber'];
$sex = $studentData['Sex'];
$completeAddress = $studentData['Address'];
$city = $studentData['City'];
$zipCode = $studentData['ZipCode'];
$citizenship = $studentData['Citizenship'];
$emailAddress = $studentData['Email'];
$password = $studentData['Password'];
$username = $studentData['Username'];
$profilePicture = $studentData['DI_profile_pic'];
?>