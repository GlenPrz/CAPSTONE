<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../../vendor/autoload.php';

$firstname = $_POST["firstname"];
$date = $_POST["date"];
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'besttrainingschool101@gmail.com';
$mail->Password = 'ncbccimktisvuzzq';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('besttrainingschool101@gmail.com');
$mail->addAddress($_POST["email"]);
$mail->isHTML(true);
$mail->Subject = 'Enrollment Confirmation';

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
            <h1>ENROLLMENT CONFIRMATION</h1><br>
        </div>
        <p><b>Hello ' . $firstname . '</b>,<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;We are happy to inform you that your enrollment at Best Training School Driving School has been
            successfully processed! You are officially Enrolled as of ' . $date . '. Welcome to BTS Driving School. <br><br>
            You can now access your BTS Account using your credentials, where you will find important information and schedules on your dashboard. We are committed to providing
            you with a comprehensive and enriching learning experience.<br><br><br>
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
    echo '<script>window.location.href="../admin_enroll.php?enrolled";</script>';
    exit;
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
