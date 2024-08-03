<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 100px;
            object-fit: cover;
            height: 100px;
        }
        div{
            border: 2px solid red;
        }
        *{
            font-size: 1rem;
        }
        body{
            display: flex;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
<?php
// $servername = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'dream skin nepal';
$servername = 'localhost';
$username = 'dreamsk1_database';
$password = '5_&*6XhiMh}2';
$dbname = 'dreamsk1_database';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    echo "Connection Fail";
} 
$i=1;
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$Query="SELECT * FROM postsmeta WHERE `Product Meta Key` LIKE '%Image%'";
$Execute=mysqli_query($conn,$Query);
while($Row=$Execute-> fetch_assoc()){
    echo "<div>";
    // echo $i++;
  echo $Row['Product ID'];
 $Src=$Row['Product Meta Value'];
    echo "<img src='" . $Src . "' alt='11new'>";
    echo "</div>";
}
?>

</body>
</html>