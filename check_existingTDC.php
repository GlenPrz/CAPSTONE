<?php
include "conn.php";

// Get the username and email from the form data
$email = $_POST['EmailAdd'];

try {
  // Check if the email already exists in the database
  $stmt = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE EmailAddress = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $emailExists = $stmt->rowCount() > 0;

  if (!$emailExists) {
    echo "success";
  } elseif ($emailExists) {
    echo "email_conflict";
  }
} catch (PDOException $e) {
  // Error occurred
  echo "error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>



