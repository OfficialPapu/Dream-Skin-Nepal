<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
$PID=$_GET['product_id'];
$ProductQuery="SELECT * FROM posts WHERE ID='$PID'";
$ProductQueryRun=mysqli_query($con,$ProductQuery);
$Data=$ProductQueryRun->fetch_assoc();
$Slug=$Data['Slug Url'];
echo "<script>window.location.href='Product/$Slug'</script>";
?>