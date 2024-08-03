<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function NotifyAdmin($UserName, $MobileNumber, $ProductTitles, $ProductPrices, $Trackings, $PaymentMethod, $DBStoreName)
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
        $mail->addAddress('dreamskinnepal@gmail.com');

        $EmailContent = "
        <!DOCTYPE html>
        <html lang='en'>
        
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>New Order Notification</title>
            <style>
                body,
                html {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, sans-serif;
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
                <h1>New Order Notification</h1>
                <p>Hello Dream Skin Nepal,</p>
                <p>New orders have just arrived on your website. Below are the details:</p>
                <p><strong>Name:</strong> $UserName</p>
                <p><strong>Phone No:</strong> $MobileNumber</p>";
                if($PaymentMethod=='Cash on Delivery'){
                    $EmailContent.="<p><strong>Payment Method:</strong> $PaymentMethod</p>";
                }elseif($PaymentMethod=='eSewa'){
                    $EmailContent.="<p><strong>Payment Method:</strong> $PaymentMethod</p>";
                }

        for ($i = 0; $i < count($ProductTitles); $i++) {
            $EmailContent .= "
                <div class='order-details'>
                    <p><strong>Product Name:</strong> {$ProductTitles[$i]}</p>
                    <p><strong>Price:</strong> Rs. {$ProductPrices[$i]}.00</p>
                    <p><strong>Order ID:</strong> #{$Trackings[$i]}</p>
                    <hr>
                </div>
            ";
        }
        $EmailContent .= "
                <p>Please check the admin panel for more details.</p>
                <a href='https://www.dreamskinnepal.com/Admin' class='button'>View Orders</a>
            </div>
        </body>
        </html>";

        $mail->isHTML(true);
        $mail->Subject = 'New Order Notification';
        $mail->Body    = $EmailContent;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
