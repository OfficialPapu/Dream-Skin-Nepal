<?php
function sanitize_main_url($url){
    $special_chars = ['\'', '"', ';', '<', '>', '#', '{', '}', '|', '\\', '^', '~', '`', ' ', '$', '!','@','%5E', '*'];
    $url = str_replace($special_chars, '', $url);
    return $url;
}

function ChangeUrl(){
    $current_url = $_SERVER['REQUEST_URI'];
    $sanitized_url = sanitize_main_url($current_url);
    if ($current_url !== $sanitized_url) {
        echo "<script>window.location.href='$sanitized_url'</script>";
        exit;
    }
}
@session_name('LoginSession');
@session_start();
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
include_once $base_url . 'Assets/PHP/Configuration/Common Function.php';
$SkinCareUrl = 'Category/SkinCare.php';
$BrandUrl = 'Category/ProductBrand.php';
$MakeupUrl='Category/Makeup.php';
$BodyAndHairCareUrl='Category/BodyandHairCare.php';
$BabyCareUrl='Category/BabyCare.php';
$SkinTypeUrl='Category/SkinType.php';
if (isset($_SESSION['Logged In'])) {
    $userID = $_SESSION['LoginSession']['user_id'];
    $UserDataFeatch = "SELECT * FROM user_table WHERE ID='$userID'";
    $RunQuery = mysqli_query($conn, $UserDataFeatch);
    if ($RunQuery->num_rows > 0) {
        while ($row = $RunQuery->fetch_assoc()) {
            $FirstName = $row['First Name'];
            $LastName = $row['Last Name'];
            $Email = $row['Email'];
            $UserPic = $row['User Picture'];
        }
    }
}
$ProductBrand="SELECT * FROM `product_category` WHERE `Product Category Name`='Brand' ORDER BY `Product Category Attribute` ASC";
$Execute=mysqli_query($conn,$ProductBrand);
$SkinCare="SELECT * FROM `product_category` WHERE `Product Category Name`='Skin Care' ORDER BY `Product Category Attribute` ASC";
$Query=mysqli_query($conn,$SkinCare);
$Makeup="SELECT * FROM `product_category` WHERE `Product Category Name`='Makeup' ORDER BY `Product Category Attribute` ASC";
$Query2=mysqli_query($conn,$Makeup);
$SkinType="SELECT * FROM `product_category` WHERE `Product Category Name`='Skin Type' ORDER BY `Product Category Attribute` ASC";
$Query3=mysqli_query($conn,$SkinType);
$BodyAndHairCare="SELECT * FROM `product_category` WHERE `Product Category Name`='Body & Hair Care' ORDER BY `Product Category Attribute` ASC";
$Query4=mysqli_query($conn,$BodyAndHairCare);
?>

<?php
$Url=$_SERVER['REQUEST_URI'];
$Url=preg_replace('/(&|\?)product_id=\d+/', '', $Url);
if($Url=="/Product.php/Assets/Product/Product%20Detail%20Page.php"){
echo $ID=$_GET['product_id'];
$ProductQuery="SELECT * FROM posts WHERE ID='$ID'";
$ProductQueryRun=mysqli_query($conn,$ProductQuery);
$Data=$ProductQueryRun->fetch_assoc();
$Slug=$Data['Slug Url'];
echo "<script>window.location.href='https://dreamskinnepal.com/Product/$Slug'</script>";
}
?>

<?php
 if (!isset($_SESSION['Logged In'])) {
    if(isset($_COOKIE['Logged_In'])){
        $CookieUserID=$_COOKIE['user_id'];
        $UserQuery="SELECT * FROM user_table WHERE ID = '$CookieUserID'";
        $UserQueryRun=mysqli_query($conn,$UserQuery);
        $row=$UserQueryRun->fetch_assoc();
        @session_start();
        $_SESSION['Logged In'] = true;
        $_SESSION['user_first_name'] = $row['First Name'];
        $_SESSION['user_last_name'] = $row['Last Name'];
        $_SESSION['user_email'] = $row['Email'];
        $_SESSION['LoginSession']['user_id'] = $row['ID'];
    }
 }
?>