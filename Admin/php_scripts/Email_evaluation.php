<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "../../conn.php";

// Load Composer's autoloader
require '../../vendor/autoload.php';

// Assuming $_POST["SelectedEmailAdd"] contains a comma-separated list of email addresses
$emails = explode(',', $_POST["SelectedEmailAdd"]);

foreach ($emails as $email) {
    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'besttrainingschool101@gmail.com';
        $mail->Password = 'ncbccimktisvuzzq';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('besttrainingschool101@gmail.com');
        $mail->addAddress(trim($email)); // Trim to remove any extra spaces
        $mail->isHTML(true);
        $mail->Subject = 'BTS Evaluation';

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
                    <h1>BTS Evaluation</h1><br>
                </div>
                <p><b>Dear BTS Driving School Students,</b>,<br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;We value your feedback and would like to hear about your experience at BTS Driving School. Your input is crucial in helping us maintain the highest standards of education and service.
                Please take a moment to fill out our evaluation form by clicking on the following link: https://btsdrivingschool.website/BTS_EvaluationForm.php
                Your feedback is important to us and will contribute to the continuous improvement of our driving programs. Thank you for your participation.<br><br>

                Best regards,<br>
                BTS Driving School Team
                </p>
            </div>
        </body>
        </html>';

        $mail->send();

    } catch (Exception $e) {
        echo "Email could not be sent to {$email}. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>



























