<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include your database connection and any other necessary files
include "../../conn.php";

// Load Composer's autoloader
require '../../vendor/autoload.php';

$stud_id = $_POST['stud_id'];
$firstname = $_POST['firstname'];
$message = $_POST['message'];

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'besttrainingschool101@gmail.com';
$mail->Password = 'ncbccimktisvuzzq';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('besttrainingschool101@gmail.com');

// Remove trailing dot from email address
$email = rtrim($_POST["email"], '.');

// Check if the email address is valid
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $mail->addAddress($email);
} else {
   echo '<script>window.location.href="../concerns.php?invalidemail";</script>';
    exit;
}

$mail->isHTML(true);
$mail->Subject = 'Respond to concern';

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
            <h1>Customer Support Update</h1><br>
        </div>
        <p><b>Hello ' . $firstname . '</b>,<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;' .$message . '<br><br>
             If, however, we have not fully clarified your questions or if you have additional questions or concerns, please do not hesitate to contact us at besttrainingschool101@gmail.com.<br><br>
        
            Keep safe on the road, and we look forward to assisting you in achieving your driving goals!<br><br><br>
            BTS Driving School
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
    echo '<script>window.location.href="../concerns.php?sent";</script>';
    exit;
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
