
<?php
// Include the database connection file
include('conn.php');

// Retrieve form data
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
$contactNumber = $_POST['contact-number'];
$message = $_POST['message'];
$createdAt = date("Y-m-d H:i:s");


try {
    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("INSERT INTO std_contact_us (Firstname, Lastname, Email, ContactNo, Message, created_at) VALUES (:firstName, :lastName, :email, :contactNumber, :message, :createdAt)");

    // Bind parameters
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contactNumber', $contactNumber);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':createdAt', $createdAt); // Bind the created_at parameter

    // Execute the query
    $stmt->execute();

    // Success message
    echo "success";
    
} catch(PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>


