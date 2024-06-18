<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

// Create an instance of PHPMailer
$mail = new PHPMailer(true);
if(isset($_POST["send"])){
    session_start();
    $msg = $_POST["message"];
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
    
    $mail->Subject = $_POST["subject"];
    
    $mail->Body = '<html>
    <head>
        <style>
            /* Inline CSS */
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }
            .container {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .logo {
                max-width: 100px;
                height: auto;
            }
            .otp {
                text-align: center;
				font-size: 36px; /* Increase the font size */
				font-weight: bold;
				color: #0ec724;
				margin-top: 20px;
				letter-spacing: 10px; /* Add a gap between characters */
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="https://i.ibb.co/tQ3HVch/bts-logo.png"" alt="BTS DRIVING SCHOOL" class="logo">
                <h1>EMAIL Verification</h1>
            </div>
            <p>Your OTP for BTS DRIVING SCHOOL is:</p>
            <div class="otp">'.$msg.'</div>
        </div>
    </body>
    </html>';

    $mail->send();
    echo"
    <script>
    alert('Check your email for your OTP');
    document.location.href = 'EmailVerification.php';
    </script>
    ";  
    $_SESSION["otp"] = $_POST["message"];
}
?>