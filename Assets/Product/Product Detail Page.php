<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
if(isset($_GET['product_id'])){
$ID=$_GET['product_id'];
$ProductQuery="SELECT * FROM posts WHERE ID='$ID'";
$ProductQueryRun=mysqli_query($conn,$ProductQuery);
$Data=$ProductQueryRun->fetch_assoc();
$Slug=$Data['Slug Url'];
echo "<script>window.location.href='https://dreamskinnepal.com/Product/$Slug'</script>";
}
?>