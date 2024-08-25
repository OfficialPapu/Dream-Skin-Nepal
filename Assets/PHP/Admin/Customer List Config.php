<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/PHP/Configuration/Common Function.php';

$Array=[];
if(isset($_POST['ListCustomer'])){
$CustomerListQuery = "SELECT *,(SELECT COUNT(*) FROM `user_table`) AS Count FROM `user_table` ORDER BY ID DESC";
$CustomerList = mysqli_query($conn, $CustomerListQuery);
if ($CustomerList->num_rows > 0) {
    while ($Row = $CustomerList->fetch_assoc()) {
    $Array[]=$Row;
    }
    $Data=json_encode($Array);
    echo $Data;
}
}
?>