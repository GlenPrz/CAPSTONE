<?php
include "../conn.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profpic = $_POST['pic'];

    // Create a database connection (modify these with your actual database credentials)

    try {

        // Prepare and execute the SQL INSERT statement
        $stmt = $conn->prepare("INSERT INTO student (EmailAddress, Username, Password, Profile_picture, Role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$email, $username, $password, $profpic, 'Student']);
        

        // Check if the data was inserted successfully
        if ($stmt->rowCount() > 0) {
            // Redirect to another PHP file
            header('Location:..\login.php?inserted');
            exit(); // Ensure no more code is executed after the redirection
        } else {
			header('Location:..\login.php?!inserted');
            exit(); // Ensure no more code is executed after the redirection
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
