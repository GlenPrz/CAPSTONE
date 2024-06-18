<?php
include "../conn.php";

// Get the username and email from the form data
$username = $_POST['Username'];
$email = $_POST['DI_EmailAdd'];

try {
  $stmt = $conn->prepare("SELECT * FROM u896821908_bts.di WHERE Username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $userExists = $stmt->rowCount() > 0;

  $stmt = $conn->prepare("SELECT * FROM u896821908_bts.di WHERE Email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $emailExists = $stmt->rowCount() > 0;

  if ($userExists && $emailExists) {
    echo "username_conflict";
  } elseif ($userExists) {
    echo "username_conflict";
  } elseif ($emailExists) {
    echo "email_conflict";
  } else {
    echo "success";
  }
} catch (PDOException $e) {
  echo "error: " . $e->getMessage();
}
$conn = null;
?>



