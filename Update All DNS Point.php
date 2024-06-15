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
?>
<?php


echo "<h1>Update Dns</h1>";
$Array=[];
$FeatchQuery = "SELECT DISTINCT`User ID` FROM `orders`";
$Run = mysqli_query($conn, $FeatchQuery);
while ($row = $Run->fetch_assoc()) {
    $TotalDue=0;
    $ID = $row['User ID'];
    $Array[] = $ID;
}
$len=count($Array);
for ($i=0; $i < $len; $i++) { 
    $TotalDue=0;
    $ID=$Array[$i];
    $FeatchQuery1 = "SELECT `Total Due` FROM `orders` WHERE `User ID`='$ID'";
    $Run1 = mysqli_query($conn, $FeatchQuery1);
    while ($row1 = $Run1->fetch_assoc()) {
   echo  $Price = $row1['Total Due'];
        $TotalDue += $Price;
   echo "<br>";
   }

   $DnsPoint = $TotalDue/100;
    echo "<br>";
    echo "User ID: ".$Array[$i] . "<br>";
    echo "Total due : ".$TotalDue . "<br>";
    echo "Dns Point: ".$DnsPoint . "<br> <br>";
    $Upq = "UPDATE user_table SET `DNS Point`='$DnsPoint' WHERE ID='$ID'";
    $upr = mysqli_query($conn, $Upq);
}
