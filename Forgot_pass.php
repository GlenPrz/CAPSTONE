<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include("conn.php");

// Load Composer's autoloader
require 'vendor/autoload.php';

// Retrieve values from the URL
$username = isset($_GET['username']) ? $_GET['username'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';


// Function to generate a random password
			function generateRandomPassword($length = 12) {
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$password = '';

				for ($i = 0; $i < $length; $i++) {
					$index = rand(0, strlen($characters) - 1);
					$password .= $characters[$index];
				}

				return $password;
			}

			// Generate an 8-character random password
			$randomPassword = generateRandomPassword(12);


 // Check if the provided username and email exist in the student table
        $query = "SELECT * FROM student WHERE Username = :username AND EmailAddress = :email";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$firstname = $result['Firstname'];


			// Update the student's password
			$updateQuery = "UPDATE student SET Password = :password WHERE Username = :username";
			$updateStmt = $conn->prepare($updateQuery);
			$updateStmt->bindParam(':password', $randomPassword); 
			$updateStmt->bindParam(':username', $username);
			$updateStmt->execute();
			
		} else {
			// Check if the provided username and email exist in the student table
            $query = "SELECT * FROM di WHERE Username = :username AND Email = :email";
    		$stmt = $conn->prepare($query);
    		$stmt->bindParam(':username', $username);
    		$stmt->bindParam(':email', $email);
    		$stmt->execute();
    
    		if ($stmt->rowCount() > 0) {
    			$result = $stmt->fetch(PDO::FETCH_ASSOC);
    			$firstname = $result['Firstname'];
    
    			// Update the student's password
    			$updateQuery = "UPDATE di SET Password = :password WHERE Username = :username";
    			$updateStmt = $conn->prepare($updateQuery);
    			$updateStmt->bindParam(':password', $randomPassword); 
    			$updateStmt->bindParam(':username', $username);
    			$updateStmt->execute();
    			
    		} else {
    			// Check if the provided username and email exist in the student table
                $query = "SELECT * FROM admin WHERE Username = :username AND EmailAddress = :email";
        		$stmt = $conn->prepare($query);
        		$stmt->bindParam(':username', $username);
        		$stmt->bindParam(':email', $email);
        		$stmt->execute();
        
        		if ($stmt->rowCount() > 0) {
        			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        			$firstname = $result['Firstname'];
        
        
        			// Update the student's password
        			$updateQuery = "UPDATE admin SET Password = :password WHERE Username = :username";
        			$updateStmt = $conn->prepare($updateQuery);
        			$updateStmt->bindParam(':password', $randomPassword); 
        			$updateStmt->bindParam(':username', $username);
        			$updateStmt->execute();
        		} else {
        			// Data does not exist
        			echo 'not_exists';
        		}
    		}
		}

		
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'besttrainingschool101@gmail.com';
$mail->Password = 'ncbccimktisvuzzq';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('besttrainingschool101@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = 'Temporary Password';

// Email body
$mail->Body = '<!DOCTYPE html>
<html>
<head>
<style>
    /* Inline CSS */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 80%;
        margin: 0 auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .logo {
        max-width: 150px;
        height: auto;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://i.ibb.co/tQ3HVch/bts-logo.png" alt="BTS DRIVING SCHOOL" class="logo">
            <h1>TEMPORARY PASSWORD</h1><br>
        </div>
        <p><b>Hello ' . $firstname . '</b>,<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;This will be your temporary Password. Please reset your password as soon as you logged
			in to your account to prevent possible hacking of your account.<br><br>
			To change your password, Go to Edit Profile on the Navigation, there you can set your new password.<br><br>
			<b>Credentials:</b><br>
			Username: ' .$username . '<br>
			Password: ' .$randomPassword . '
			<br><br>
            If you have any questions or need assistance, feel free to reach out to us at besttrainingschool101@gmail.com. Happy driving!
        </p>
    </div>
</body>
</html>';

try {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loading...</title>
        <style>
            body {
				font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
				background-color: #f4f4f4;
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				margin: 0;
			}

			.loader-container {
				text-align: center;
			}

			.loader {
				border: 8px solid #4CAF50; /* Green border */
				border-top: 8px solid #ffffff; /* White border for top */
				border-radius: 50%;
				width: 60px; /* Adjusted width */
				height: 60px; /* Adjusted height */
				animation: spin 1s linear infinite;
				margin: 20px auto; /* Center the loader */
			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
			}
        </style>
    </head>
    <body>
        <div class="loader"></div>
    </body>
    </html>';

    ob_flush();
    flush();

    $mail->send();
    echo '<script>window.location.href="login.php?enrolled";</script>';
    exit;
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
