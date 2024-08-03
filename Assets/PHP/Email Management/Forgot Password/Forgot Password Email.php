<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function ForgotPassword($Email, $Password)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dreamskinnepal@gmail.com';
        $mail->Password   = 'laro hqrp wmrz kixj';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('dreamskinnepal@gmail.com', 'Dream Skin Nepal');
        $mail->addAddress($Email);
        $EmailContent = "
        <!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Password Update Notification</title>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
    body, html {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
    }

    p {
        color: #555;
        line-height: 1.6;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
    }

    .button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div class='container'>
        <h1>Password Update Notification</h1>
        <p>Your password has been successfully updated to <b>$Password</b></p>
        <p>If you did not make this change or believe your account has been compromised, please contact support immediately.</p>
        <a href='https://dreamskinnepal.com' class='button'>Visit our website</a>
    </div>
</body>
</html>";

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Update Notification';
        $mail->Body    = $EmailContent;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
