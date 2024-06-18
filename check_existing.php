<?php
include "conn.php";

// Get the username and email from the form data
$username = $_POST['Username'];
$email = $_POST['EmailAdd'];

try {
  // Check if the username already exists in the database
  $stmt = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE Username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $userExists = $stmt->rowCount() > 0;

  // Check if the email already exists in the database
  $stmt = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE EmailAddress = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $emailExists = $stmt->rowCount() > 0;

  if ($userExists && $emailExists) {
    // If both username and email exist, it's an update, not a new record
    echo "username_conflict";
  } elseif ($userExists) {
    // Username already exists
    echo "username_conflict";
  } elseif ($emailExists) {
    // Email already exists
    echo "email_conflict";
  } else {
    // No conflict, it's a new record, proceed with form submission
    echo "success";
  }
} catch (PDOException $e) {
  // Error occurred
  echo "error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>



