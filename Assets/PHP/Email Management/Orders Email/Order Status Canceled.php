<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function NotifyStatusCanceled($UserEmail, $UserName, $ProductNames)
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
        $mail->addAddress($UserEmail);

        // Construct email content dynamically using arrays
        $EmailContent = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Order Canceled</title>
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
        
            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }
        
            h1 {
                font-size: 28px;
                color: #333333;
                margin-top: 0;
            }
        
            p {
                font-size: 16px;
                color: #666666;
                margin-bottom: 20px;
            }
        
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
            }
        
            .button:hover {
                background-color: #0056b3;
            }
        
            .tracking-info {
                margin-top: 20px;
                padding: 10px;
                background-color: #f0f0f0;
                border-left: 4px solid #007bff;
            }
        
            .tracking-info p {
                margin: 10px 0;
            }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Order Canceled</h1>
                <p>Hello $UserName,</p>
                <p>We regret to inform you that your order(s) have been canceled. Below are the product information:</p>
        ";

        foreach ($ProductNames as $ProductName) {
            $EmailContent .= "
                <div class='tracking-info'>
                    <p><strong>Product Name:</strong> $ProductName</p>
                </div>
            ";
        }

        $EmailContent .= "
                <p>If you have any questions or concerns regarding this cancellation, please feel free to contact us.</p>
                <p>We apologize for any inconvenience caused.</p>
            </div>
        </body>
        </html>";

        $mail->isHTML(true);
        $mail->Subject = 'Regarding your Dream Skin Nepal Order!';
        $mail->Body    = $EmailContent;

        $mail->send();
        return true; 
    } catch (Exception $e) {
        return false; 
    }
}
