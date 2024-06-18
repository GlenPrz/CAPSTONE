<?php
include "conn.php";

// Get the username and email from the form data
$username = $_POST['Username'];
$email = $_POST['EmailAdd'];
$currentEmail = $_POST['CurrentEmail'];

try {
  // Check if the username already exists in the database
  $stmt = $conn->prepare("SELECT COUNT(*) AS Usernum FROM u896821908_bts.student WHERE Username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row['Usernum'] > 0) {
    // Only username exists, return "username_conflict"
    echo "username_conflict";
  } else {
    // Check if the email has been updated and if it already exists in the database
    if ($email !== $currentEmail) {
      $stmt = $conn->prepare("SELECT COUNT(*) AS Emailnum FROM u896821908_bts.student WHERE EmailAddress = :email");
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($row['Emailnum'] > 0) {
        // Email already exists, return "email_conflict"
        echo "email_conflict";
        exit;
      }
    }
    // No conflicts, return "success"
    echo "success";
  }
} catch (PDOException $e) {
  // Error occurred
  echo "error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>




