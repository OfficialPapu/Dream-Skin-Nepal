<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function Promation($Email)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'uttrhdhfjrvi@gmail.com';
        $mail->Password   = 'mqiy dqon arur uzid';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('uttrhdhfjrvi@gmail.com', 'Dream Skin Nepal');
        $mail->addAddress($Email);

        $EmailContent = "
       <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>10% Anniversary Discount</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f3f4f6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
            color: #ff6f61;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        .attachment {
            margin-top: 20px;
            text-align: center;
        }
        .attachment a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .attachment p {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
        .cta-button{
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class='email-container'>
    <div class='header'>🎉 10% Anniversary Discount! 🎉</div>
    <div class='content'>
        <p>Celebrate with us and enjoy a <strong>Flat 10% OFF</strong> on all purchases from <strong>August 28th to September 7th</strong>! 🎁</p>
        <p>Don't miss out—<strong>shop now</strong> by checking out the attached catalog or visiting our website <a href='https://dreamskinnepal.com' class='cta-button'>(Click Here)!</a></p>
    </div>
    <div class='attachment'>
        <p>One attachment - Scanned by Gmail</p>
        <a href='path/to/your-document.pdf' download>Download PDF Catalog</a>
        <p>New Product Catalog (PDF)</p>
    </div>
</div>

</body>
</html>

       
        ";

        $mail->isHTML(true);
        $mail->Subject = 'New Order Notification';
        $mail->Body    = $EmailContent;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
