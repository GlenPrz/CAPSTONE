<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];

    try {
        // Check if the provided username and email exist in the student table
        $query = "SELECT * FROM student WHERE Username = :username AND EmailAddress = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
			
				 echo 'exists';
        } else {
             // Check if the provided username and email exist in the student table
                $query2 = "SELECT * FROM di WHERE Username = :username AND Email = :email";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bindParam(':username', $username);
                $stmt2->bindParam(':email', $email);
                $stmt2->execute();
        
                if ($stmt2->rowCount() > 0) {
                    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        			
        				 echo 'exists';
                } else {
                    // Check if the provided username and email exist in the admin table
                    $query3 = "SELECT * FROM admin WHERE Username = :username AND EmailAddress = :email";
                    $stmt3 = $conn->prepare($query3);
                    $stmt3->bindParam(':username', $username);
                    $stmt3->bindParam(':email', $email);
                    $stmt3->execute();
                    
                    if ($stmt3->rowCount() > 0) {
                        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                        echo 'exists';
                    } else {
                        // Data does not exist
                        echo 'not_exists';
                    }
            }
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo 'Error: ' . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }
}
?>
