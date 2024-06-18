<?php
include "../../../conn.php";

// Get the username and email from the form data
$username = $_POST['NewUsername'];
$email = $_POST['EmailAdd'];

try {
  // Check if the username already exists in the database
  $stmt = $conn->prepare("SELECT COUNT(*) AS Usernum FROM u896821908_bts.admin WHERE Username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row['Usernum'] > 0) {
    // Only username exists, return "username_conflict"
    echo "username_conflict";
  } else {
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




