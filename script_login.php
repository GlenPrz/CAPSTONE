<?php
include "conn.php";

try {
  // Prepare the SQL statement to insert data into the table
  $stmt = $conn->prepare("INSERT INTO student 
  (Username, LastName, FirstName, MiddleName, Suffix, Birthdate, Civilstatus, ContactNumber, Sex, Address, City, ZipCode, Citizenship, EmailAddress, Password, Profile_picture, Role, DateOfEnrolled) VALUES 
  (:Username, :LastName, :FirstName, :MiddleName, :Suffix, :Birthdate, :CivilStatus, :ContactNumber, :Sex, :Address, :City, :ZipCode, :Citizenship, :EmailAddress, :Password, :Picture, :Role, :DateOfEnrolled)");

$stmt->bindParam(':Username', $_POST['Username']);
$stmt->bindParam(':LastName', $_POST['LastName']);
$stmt->bindParam(':FirstName', $_POST['FirstName']);
$stmt->bindParam(':MiddleName', $_POST['MiddleName']);
$stmt->bindParam(':Suffix', $_POST['Suffix']);
$stmt->bindParam(':Birthdate', $_POST['Birthdate']);
$stmt->bindParam(':CivilStatus', $_POST['CivilStatus']);
$stmt->bindParam(':ContactNumber', $_POST['ContactNumber']);
$stmt->bindParam(':Sex', $_POST['SEX']);
$stmt->bindParam(':Address', $_POST['CompleteAddress']);
$stmt->bindParam(':City', $_POST['City']);
$stmt->bindParam(':ZipCode', $_POST['ZipCode']);
$stmt->bindParam(':Citizenship', $_POST['Citizenship']);
$stmt->bindParam(':EmailAddress', $_POST['EmailAdd']);
$stmt->bindParam(':Password', $_POST['pass']);
$stmt->bindValue(':Role', "Student");
$currentDate = date('Y-m-d'); // Get the current date in YYYY-MM-DD format
$stmt->bindValue(':DateOfEnrolled', $currentDate, PDO::PARAM_STR); // Specify that it's a string parameter

  // Check if an image file was uploaded
  if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $filename = $_FILES["profile_picture"]["name"];
    $tempname = $_FILES["profile_picture"]["tmp_name"];
    $folder = "./uploads/" . $filename;

    if (move_uploaded_file($tempname, $folder)) {
      // Bind the image file path parameter
      $stmt->bindParam(':Picture', $folder);
      echo "<h3>Image uploaded successfully!</h3>";
    } else {
      echo "<h3>Failed to upload image!</h3>";
      $folder = "./uploads/user_icon.png";
      // Set the Picture parameter to the default image path
      $stmt->bindParam(':Picture', $folder);
    }
  } else {
    $folder = "./uploads/user_icon.png";
    // Set the Picture parameter to the default image path
    $stmt->bindParam(':Picture', $folder);
  }

  // Execute the statement
  $stmt->execute();

  // Send a success message to the browser console
} catch (PDOException $e) {
  // Send an error message to the browser console
  echo "<script>console.error('Error: " . $e->getMessage() . "');</script>";
}

// Close the database connection
$conn = null;
?>


