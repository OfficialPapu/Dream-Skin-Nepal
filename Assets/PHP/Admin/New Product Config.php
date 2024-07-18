<?php
if (isset($_POST['AddNewProduct'])) {
    @session_name('URLSession');
    @session_start();
    $base_url = $_SESSION['URLSession']['Base Path'];
    include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
    include_once $base_url . 'Assets/PHP/Configuration/Create Slug.php';
    $CustomProductID= strtoupper($_POST['CustomProductID']);
    $productTitle = addslashes($_POST["ProductTitle"]);
    $SlugTitle= CreateSlug($productTitle);
    $productContent = addslashes($_POST["ProductDescription"]);
    $productPrice = $_POST["Price"];
    $discountPrice = $_POST["DiscountPrice"];
    $DiscountPercentage = $_POST["DiscountPercentage"];
    $Quantity=$_POST['ProductQuantity'];
    $ProductTypeID = $_POST["ProductTypeID"];
    $BrandID = $_POST["BrandID"];

    $sql = "INSERT INTO posts (`Custom Product ID`, `Product Title`,`Slug Url`,`Product Content`, `Product Price`, `Discount Price`, `Discount Percentage`, `Product Quantity`, `Post Date`) VALUES ('$CustomProductID','$productTitle','$SlugTitle','$productContent', '$productPrice', '$discountPrice','$DiscountPercentage', '$Quantity', CONVERT_TZ(NOW(), '+00:00', '+05:45'))";
    if ($conn->query($sql) === TRUE) {
        $productId = $conn->insert_id;

        $metaKeys = array("Brand ID", "Product Type ID");
        $metaValues = array($BrandID, $ProductTypeID);
        foreach ($metaKeys as $key => $metaKey) {
            $metaValue = $metaValues[$key];
            $sqlMeta = "INSERT INTO postsmeta (`Product ID`, `Product Meta Key`, `Product Meta Value`) VALUES ('$productId', '$metaKey', '$metaValue')";
            $conn->query($sqlMeta);
        }

        // Create folder structure for images
        $uploadDir = $base_url . "Assets/Product/Media/Images/Product Images/" . date("Y/m");
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Upload multiple images directly into SQL query
        if (!empty($_FILES['Images']['name'][0])) {
            foreach ($_FILES['Images']['tmp_name'] as $key => $tmp_name) {
                $name = $_FILES['Images']['name'][$key];
                $uploadFile = $uploadDir . "/" . basename($name);
                $imagePathWithoutBaseURL = str_replace($base_url, '', $uploadFile);
                if (move_uploaded_file($tmp_name, $uploadFile)) {
                    $imageNumber = $key + 1;
                    $metaKey = "Image $imageNumber";
                    $sqlImage = "INSERT INTO postsmeta (`Product ID`, `Product Meta Key`, `Product Meta Value`) VALUES ('$productId', '$metaKey', '$imagePathWithoutBaseURL')";
                    $conn->query($sqlImage);
                } else {
                    echo "Error uploading file.";
                }
            }
        }

        echo "Product added";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>