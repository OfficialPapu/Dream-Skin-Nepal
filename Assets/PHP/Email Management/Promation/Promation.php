<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>

    $(document).ready(function() {
        function Proom(Data, Initial, i) {
            $.ajax({
                type: "POST",
                url: "#",
                data: {
                    SendMail: true,
                    Data: Data,
                    Initial: Initial,
                },
                success: function(response) {
                    $('body').append(`${Data} times email send to  response${response} <br>`);
                    setTimeout(() => {
                        Proom(Data + 1, Data, i + 1)
                    }, 10000);
                }
            });
        }

        Proom(1, 0, 0);
    });
</script>

</html>
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dream skin nepal';
// $servername = 'localhost';
// $username = 'dreamsk1_database';
// $password = '5_&*6XhiMh}2';
// $dbname = 'dreamsk1_database';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Connection Fail";
}
?>
<?php
include '../PHPMailer/SMTP.php';
include '../PHPMailer/PHPMailer.php';
include '../PHPMailer/Exception.php';
include 'Promation Config.php';

if (isset($_POST['SendMail'])) {
    $Data = $_POST['Data'];
    $Initial = $_POST['Initial'];
    $SqlQuery = "SELECT * FROM `user_table` WHERE ID>=$Initial AND ID<=$Data";
    $Run = mysqli_query($conn, $SqlQuery);
    while ($Row = $Run->fetch_assoc()) {
        $emailAddresse = $Row['Email'];
        echo Promation($emailAddresse);
        // if (Promation($emailAddresse)) {
        //     echo "Success";
        // } else {
        //     echo "Fail";
        // }
    }
}
?>