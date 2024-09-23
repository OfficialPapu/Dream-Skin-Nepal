<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
include_once $base_url . 'Assets/PHP/Configuration/Slider Config.php';


if (isset($_POST['FirstCategory'])) {
$loadedCategories = $_POST['loadedCategories'];
$CategorySql = "SELECT * FROM `product_category`
    WHERE `Product Category Attribute` IN('Cleanser','Toner/ Toner Pad','Essence','Serum','Moisturizer','Sunscreen/ Sun Stick','Sheet Mask','Hair Care','Cushion Foundation','Lip Stick (Lip Tint/Lip Balm)' ) 
    ORDER BY CASE `Product Category Attribute` 
    WHEN 'Cleanser' THEN 1 
    WHEN 'Toner/ Toner Pad' THEN 2 
    WHEN 'Essence' THEN 3 
    WHEN 'Serum' THEN 4 
    WHEN 'Moisturizer' THEN 5 
    WHEN 'Sunscreen/ Sun Stick' THEN 6 
    WHEN 'Sheet Mask' THEN 7 
    WHEN 'Lip Stick (Lip Tint/Lip Balm)' THEN 8 
    WHEN 'Cushion Foundation' THEN 9 
    WHEN 'Hair Care' THEN 10
    ELSE 11 END, `Product Category Attribute` ASC LIMIT $loadedCategories, 2";
$CategorySqlRun = mysqli_query($conn, $CategorySql);

while ($Row = $CategorySqlRun->fetch_assoc()) {
    $CategoryAttribute = $Row['Product Category Attribute'];
    $CategoryID = $Row['Product Category ID'];
    $SlugUrl = $Row['Slug Url'];
    $ImageUrl = $Row['Image Url'];
    $Sql = "WHERE pm3.`Product Meta Value`='$CategoryID' AND p.`Product Quantity`>0";
    echo "<div class='products'>
        <div class='view-more-box'>
            <div class='heading-box'>
                <h2 class='product-heading'>$CategoryAttribute</h2>
            </div>
            <div class='view-more'>
                <a href='Category/SkinCare.php/$SlugUrl'>Shop More<i class='bx bx-chevron-right'></i></a>
            </div>
        </div>";
    if ($ImageUrl != "") {
        echo "<div class='banner'>
        <a href='Category/SkinCare.php/$SlugUrl'>
            <img src='Assets/Product/Media/Images/Banners/$ImageUrl' alt='$CategoryAttribute' loading='lazy'>
            </a>
            </div>";
    }

    echo '<div class="swiper swiper-container">';
    $result = SliderQuery($Sql, $conn, $base_url, $user_id);
    include $base_url . "Assets/PHP/Configuration/Mobile Check.php";
    Slider($result, $base_url, $is_mobile, $conn);
    echo '<div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>';
    echo "</div>";
    echo '<script src="Assets/JS/Slider Config.js"></script>';

}
}
