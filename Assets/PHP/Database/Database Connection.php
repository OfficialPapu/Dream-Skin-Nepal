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