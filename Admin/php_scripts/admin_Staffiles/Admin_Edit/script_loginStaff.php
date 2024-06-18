<?php
include "../../../conn.php";
echo "test";
try {
  // Prepare the SQL statement to insert data into the table
  $stmt = $conn->prepare("INSERT INTO u896821908_bts.admin 
    (Username, LastName, FirstName, MiddleName, Suffix, Birthdate, Civilstatus, 
    ContactNumber, Sex, Address, City, ZipCode, Citizenship, EmailAddress, 
    Password, picture, Role, DateOfEnrolled) VALUES 
    (:Username, :LastName, :FirstName, :MiddleName, :Suffix, :Birthdate, 
    :CivilStatus, :ContactNumber, :Sex, :Address, :City, :ZipCode, 
    :Citizenship, :EmailAddress, :Password, :Picture, :Role, :DateOfEnrolled)");

  $testUsername = 'test'; // Constant value for Username
  $lastName = $_POST['LastNameStaff'];
  $firstName = $_POST['FirstNameStaff'];
  $middleName = $_POST['MiddleNameStaff'];
  $suffix = $_POST['SuffixStaff'];
  $birthdate = $_POST['BirthdateStaff'];
  $civilStatus = $_POST['CivilStatusStaff'];
  $contactNumber = $_POST['ContactNumberStaff'];
  $sex = $_POST['SEXStaff'];
  $address = $_POST['CompleteAddressStaff'];
  $city = $_POST['CityStaff'];
  $zipCode = $_POST['ZipCodeStaff'];
  $citizenship = $_POST['CitizenshipStaff'];
  $emailAddress = $_POST['EmailAddStaff'];
  $password = $_POST['passStaff'];
  $role = $_POST['RoleStaff'];
  $currentDate = date('Y-m-d'); // Get the current date in YYYY-MM-DD format

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

  // Bind parameters
  $stmt->bindParam(':Username', $testUsername);
  $stmt->bindParam(':LastName', $lastName);
  $stmt->bindParam(':FirstName', $firstName);
  $stmt->bindParam(':MiddleName', $middleName);
  $stmt->bindParam(':Suffix', $suffix);
  $stmt->bindParam(':Birthdate', $birthdate);
  $stmt->bindParam(':CivilStatus', $civilStatus);
  $stmt->bindParam(':ContactNumber', $contactNumber);
  $stmt->bindParam(':Sex', $sex);
  $stmt->bindParam(':Address', $address);
  $stmt->bindParam(':City', $city);
  $stmt->bindParam(':ZipCode', $zipCode);
  $stmt->bindParam(':Citizenship', $citizenship);
  $stmt->bindParam(':EmailAddress', $emailAddress);
  $stmt->bindParam(':Password', $password);
  $stmt->bindParam(':Role', $role);
  $stmt->bindValue(':DateOfEnrolled', $currentDate, PDO::PARAM_STR); // Specify that it's a string parameter

  // Execute the statement
  $stmt->execute();

  // Send a success message to the browser console
  echo "Data inserted successfully!";
} catch (PDOException $e) {
  // Send an error message to the browser console
  echo "<script>console.error('Error: " . $e->getMessage() . "');</script>";
}

// Close the database connection
$conn = null;
?>



