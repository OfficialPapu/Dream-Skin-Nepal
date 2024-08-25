<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function NotifyUser($UserEmail, $UserName, $ProductTitles, $ProductPrices, $ShippingFee, $TrackingNumbers)
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
        
        $EmailContent = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Your order has been received!</title>
            <style>
            body, html {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                overflow: hidden;
            }
            
            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f9f9f9;
            }
            
            h1 {
                font-size: 24px;
                color: #333;
                margin-top: 0;
            }
            
            p {
                font-size: 16px;
                color: #666;
                margin-bottom: 20px;
            }
            
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
            }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Thank you for your order.</h1>
                <p>Hello $UserName,</p>
                <p>Your order(s) have been successfully received. Below are the order details:</p>
        ";

        for ($i = 0; $i < count($ProductTitles); $i++) {
            $EmailContent .= "
                <p><strong>Product Name:</strong> {$ProductTitles[$i]}</p>
                <p><strong>Price:</strong> {$ProductPrices[$i]}.00</p>
                <p><strong>Order ID:</strong> #{$TrackingNumbers[$i]}</p>
                <hr>
            ";
        }

        $EmailContent .= "
                <p><strong>Shipping Fee:</strong> {$ShippingFee}.00</p>
                <p>We hope you enjoy your purchase!</p>
                <a href='https://www.dreamskinnepal.com' class='button'>Track Order</a>
            </div>
        </body>
        </html>";

        $mail->isHTML(true);
        $mail->Subject = 'Dream Skin Nepal - Order Received';
        $mail->Body    = $EmailContent;
        
        $mail->send();
        return true; 
    } catch (Exception $e) {
        return false; 
    }
}
