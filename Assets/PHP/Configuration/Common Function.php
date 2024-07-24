<?php
@session_name('LoginSession');
@session_name('Cart');
@session_name('URLSession');
@session_start();
@session_start();
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Configuration/User IP.php';
include_once $base_url . 'Assets/PHP/Configuration/Create Slug.php';
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
include_once $base_url . 'Assets/PHP/Email Management/Orders Email/Order Status Pending.php';
include_once $base_url . 'Assets/PHP/Email Management/Orders Email/Order Status Shipped.php';
include_once $base_url . 'Assets/PHP/Email Management/Orders Email/Order Status Complete.php';
include_once $base_url . 'Assets/PHP/Email Management/Orders Email/Order Status Canceled.php';

include $base_url . 'Assets/PHP/Email Management/PHPMailer/SMTP.php';
include $base_url . 'Assets/PHP/Email Management/PHPMailer/PHPMailer.php';
include $base_url . 'Assets/PHP/Email Management/PHPMailer/Exception.php';

// Non Logged In User
if (isset($_SESSION['Logged In'])) {
    $user_id = $_SESSION['LoginSession']['user_id'];
} else if (!isset($_SESSION['Cart']['user_id'])) {
    $random_number = rand(10000, 99999);
    $RandomUserID = "Guest-" . $random_number;
    $_SESSION['Cart']['user_id'] = $RandomUserID;
    $user_id =  $_SESSION['Cart']['user_id'];
} else if (isset($_SESSION['Cart']['user_id'])) {
    $user_id =  $_SESSION['Cart']['user_id'];
}

if (isset($_POST['AddToCart'])) {
    if (isset($_SESSION['Logged In'])) {
        $product_id = $_POST['ProductID'];
        $quantity = $_POST['ProductQuantity'];
        $CheckQuantity = "SELECT * FROM `posts` WHERE `ID`='$product_id'";
        $CheckQuantityRun = mysqli_query($conn, $CheckQuantity);
        $ProductInfo = $CheckQuantityRun->fetch_assoc();
        $ProductQuantityValue = $ProductInfo['Product Quantity'];
        if ($ProductQuantityValue != 0) {
            if ($quantity <= $ProductQuantityValue) {
                $check_product_already_added = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id' AND `Product_ID`='$product_id'";
                $execute = mysqli_query($conn, $check_product_already_added);
                if ($execute->num_rows > 0) {
                    echo "AlreadyExist";
                } else {
                    $add_to_cart = "INSERT INTO `product_cart`(`User ID`, `Product_ID`, `User_IP`, `Total Due`, `Shipping Fee`,`Applied Promo Code`, `Product_Quantity`, `Date & Time`) VALUES ('$user_id','$product_id','$user_ip','','','','$quantity',CONVERT_TZ(NOW(), '+00:00', '+05:45') )";
                    $execute = mysqli_query($conn, $add_to_cart);
                    if ($execute) {
                        echo "Added";
                    }
                }
            } else {
                echo "NotEnoughStock";
            }
        } else {
            echo "OutOfStock";
        }
    } else {
        echo "NotLoggedIn";
    }
}

if (isset($_POST['BuyNow'])) {
    $product_id = $_POST['ProductID'];
    $quantity = $_POST['ProductQuantity'];
    $CheckQuantity = "SELECT * FROM `posts` WHERE `ID`='$product_id'";
    $CheckQuantityRun = mysqli_query($conn, $CheckQuantity);
    $ProductInfo = $CheckQuantityRun->fetch_assoc();
    $ProductQuantityValue = $ProductInfo['Product Quantity'];
    if ($ProductQuantityValue != 0) {
        if ($quantity <= $ProductQuantityValue) {
            $StringUserID = strval($user_id);
            $check_product_already_added = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id' AND `Product_ID`='$product_id'";
            $execute = mysqli_query($conn, $check_product_already_added);
            if ($execute->num_rows > 0) {
                $ClearCartQuery = "DELETE FROM `product_cart` WHERE `User ID`='$StringUserID' AND `Product_ID` != '$product_id'";
                $ClearCartRun = mysqli_query($conn, $ClearCartQuery);
                echo "Success";
            } else {
                $ClearCartQuery = "DELETE FROM `product_cart` WHERE `User ID`='$StringUserID' AND `Product_ID` != '$product_id'";
                $ClearCartRun = mysqli_query($conn, $ClearCartQuery);
                $add_to_cart = "INSERT INTO `product_cart`(`User ID`, `Product_ID`, `User_IP`, `Total Due`, `Shipping Fee`,`Applied Promo Code`, `Product_Quantity`, `Date & Time`) VALUES ('$user_id','$product_id','$user_ip','','','','$quantity',CONVERT_TZ(NOW(), '+00:00', '+05:45') )";
                $execute = mysqli_query($conn, $add_to_cart);
                echo "Success";
            }
        } else {
            echo "NotEnoughStock";
        }
    } else {
        echo "OutOfStock";
    }
}

if (isset($_POST['AddToCartFromWishlist'])) {
    $product_id = $_POST['ProductID'];
    $quantity = $_POST['ProductQuantity'];
    $CheckQuantity = "SELECT * FROM `posts` WHERE `ID`='$product_id' AND `Product Quantity`>=$quantity";
    $CheckQuantityRun = mysqli_query($conn, $CheckQuantity);
    if ($CheckQuantityRun->num_rows > 0) {
        $check_product_already_added = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id' AND `Product_ID`='$product_id'";
        $execute = mysqli_query($conn, $check_product_already_added);
        $match_count = mysqli_num_rows($execute);
        if ($match_count > 0) {
            echo "AlreadyExist";
            $product_delete_query = "DELETE FROM `product_wishlist` WHERE `User ID`='$user_id' AND `Product ID`='$product_id'";
            $execute_query = mysqli_query($conn, $product_delete_query);
        } else {
            $add_to_cart = "INSERT INTO `product_cart`(`User ID`, `Product_ID`, `User_IP`, `Total Due`, `Shipping Fee`, `Product_Quantity`, `Date & Time`) VALUES ('$user_id','$product_id','$user_ip','','','$quantity',CONVERT_TZ(NOW(), '+00:00', '+05:45') )";
            $execute = mysqli_query($conn, $add_to_cart);
            if ($execute) {
                $product_delete_query = "DELETE FROM `product_wishlist` WHERE `User ID`='$user_id' AND `Product ID`='$product_id'";
                $execute_query = mysqli_query($conn, $product_delete_query);
            }
        }
    } else {
        echo "OutOfStock";
    }
}


if (isset($_POST['AddToWishlist'])) {
    if (isset($_SESSION['Logged In'])) {
        $product_id = $_POST['ProductID'];
        $check_product_already_added = "SELECT * FROM `product_wishlist` WHERE `User ID`='$user_id' AND `Product ID`='$product_id'";
        $execute = mysqli_query($conn, $check_product_already_added);
        $match_count = mysqli_num_rows($execute);
        if ($match_count > 0) {
            echo "AlreadyExist";
        } else {
            $add_to_wishlist = "INSERT INTO `product_wishlist`(`User ID`, `Product ID`, `User IP`, `Date & Time`) VALUES ('$user_id','$product_id','$user_ip',CONVERT_TZ(NOW(), '+00:00', '+05:45') )";
            $execute = mysqli_query($conn, $add_to_wishlist);
            if ($execute) {
                echo "Added";
            }
        }
    } else {
        echo "NotLoggedIn";
    }
}



if (isset($_POST['WishlistDataLoad'])) {
    global $conn;
    $item_count = "SELECT * FROM `product_wishlist` WHERE `User ID`='$user_id'";
    $execute = mysqli_query($conn, $item_count);
    $cart_item_count = 0;
    $cart_item_count = mysqli_num_rows($execute);
    echo $cart_item_count;
}

if (isset($_POST['DeleteFromWishlist'])) {
    $product_id = $_POST['ProductID'];
    $product_delete_query = "DELETE FROM `product_wishlist` WHERE `Product ID`='$product_id'";
    $execute_query = mysqli_query($conn, $product_delete_query);
}



if (isset($_POST['CheckDataLoad'])) {
    global $conn;
    $item_count = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id'";
    $execute = mysqli_query($conn, $item_count);
    $cart_item_count = 0;
    $cart_item_count = mysqli_num_rows($execute);
    echo $cart_item_count;
}



if (isset($_POST['DeleteProductIsset'])) {
    global $conn;
    $product_id = $_POST['ProductID'];
    $product_delete_query = "DELETE FROM product_cart WHERE Product_ID=$product_id";
    $execute_query = mysqli_query($conn, $product_delete_query);
}


if (isset($_POST['updatecartquantity'])) {
    $product_id = $_POST['productid'];
    $product_quantity = $_POST['productInput'];
    $CheckQuantity = "SELECT * FROM `posts` WHERE `ID`='$product_id' AND `Product Quantity`>=$product_quantity";
    $CheckQuantityRun = mysqli_query($conn, $CheckQuantity);
    if ($CheckQuantityRun->num_rows > 0) {
        $sendupdate = "UPDATE `product_cart` SET `Product_Quantity`='$product_quantity' WHERE `Product_ID`='$product_id'";
        $queryrun = mysqli_query($conn, $sendupdate);
        $count_product_qty = $queryrun->num_rows;
    } else {
        echo "OutOfStock";
    }
}

if (isset($_POST['ShippingFeeChange'])) {
    $ShippingFee = $_POST['ShippingFeeChangeing'];
    $sendupdate = "UPDATE `product_cart` SET `Shipping Fee`='$ShippingFee'";
    $queryrun = mysqli_query($conn, $sendupdate);
}

if (isset($_POST['SelectList'])) {
    global $conn;
    $SelectName = $_POST['SelectName'];
    $OptionList = array();
    $SelectQuery = "SELECT * FROM `product_category` WHERE `Product Category Name`='$SelectName' ORDER BY `Product Category Attribute` ASC";
    $Select = mysqli_query($conn, $SelectQuery);
    while ($Row = $Select->fetch_assoc()) {
        $OptionList[] = array(
            'ProductCategoryID' => $Row['Product Category ID'],
            'ProductCategoryAttribute' => $Row['Product Category Attribute'],
        );
    }
    $Data = json_encode($OptionList);
    echo $Data;
}

function FindValue($ProductCategoryID)
{
    global $conn;
    if ($ProductCategoryID != '') {
        $ProductCategoryAttribute = "SELECT * FROM `product_category` WHERE `Product Category ID`='$ProductCategoryID'";
        $Find = mysqli_query($conn, $ProductCategoryAttribute);
        $RowCategory = $Find->fetch_assoc();
        return ($RowCategory['Product Category Attribute']);
    }
}

if (isset($_POST['UpdateOrderStatus'])) { {
        $OrderStatus = $_POST['SelectedOption'];
        $UserID = $_POST['UserID'];
        $Subtotal = $_POST['Subtotal'];
        $DsnPoint=$Subtotal/100;
        $RowOrderID = $_POST['RowOrderID'];
        $UpdateQuery = "UPDATE `order_items` SET `Order Status`='$OrderStatus' WHERE `Order ID`='$RowOrderID'";
        $Execute = mysqli_query($conn, $UpdateQuery);
        if ($Execute)

            $OrderInfo = "SELECT
        OrderList.`Tracking Number`,
        p.`Product Title`,
        user.`First Name`,
        user.Email
    FROM `order_items` OrderList
    JOIN posts p ON  p.ID = OrderList.`Product ID`
    JOIN user_table user ON user.ID = OrderList.`User ID`
    WHERE OrderList.`Order ID`='$RowOrderID'";


        $OrderInfoRun = mysqli_query($conn, $OrderInfo);
        $ProductTitle = [];
        $TrackingNumber = [];
        while ($Row = $OrderInfoRun->fetch_assoc()) {
            $ProductTitle[] = $Row['Product Title'];
            $TrackingNumber[] = $Row['Tracking Number'];
            $UserEmail = $Row['Email'];
            $UserName = $Row['First Name'];
        }

        if ($OrderStatus == 'Shipped') {
            NotifyStatusShipped($UserEmail, $UserName, $ProductTitle, $TrackingNumber);
            echo "Shipped";
        } else if ($OrderStatus == 'Pending') {
            NotifyStatusPending($UserEmail, $UserName, $ProductTitle, $TrackingNumber);
            echo "Pending";
        } else if ($OrderStatus == 'Complete') {
            NotifyStatusComplete($UserEmail, $UserName, $ProductTitle);
            echo "Completed";
        } else if ($OrderStatus == 'Cancelled') {
            $UpdateDsnQuery="UPDATE `user_table` SET `DSN Point`=`DSN Point` - '$DsnPoint' WHERE `ID`='$user_id'";
            $UpdateDsnQueryRun=$conn->query($UpdateDsnQuery);    
            NotifyStatusCanceled($UserEmail, $UserName, $ProductTitle);
            echo "Cancelled";
        } else if ($OrderStatus == 'Rejected') {
            $UpdateDsnQuery="UPDATE `user_table` SET `DSN Point`=`DSN Point` - '$DsnPoint' WHERE `ID`='$user_id'";
            $UpdateDsnQueryRun=$conn->query($UpdateDsnQuery); 
            echo "Rejected";
        } else {
            echo "Success";
        }
    }
}

if (isset($_POST['CheckProductStatus'])) {
    $UserID = $_POST['UserID'];
    $RowOrderID = $_POST['RowOrderID'];
    $SatusQuery = "SELECT * FROM `order_items` WHERE `User ID`='$UserID' AND `Order ID`='$RowOrderID'";
    $Satus = mysqli_query($conn, $SatusQuery);
    $Row = $Satus->fetch_assoc();
    $Statusdata = $Row['Order Status'];
    echo $Statusdata;
}


if (isset($_POST['TodaySalePrice'])) {
    $TodaySalePrice = 0;
    $TodaySaleQuery = "SELECT o.`Total Due`, o.`Shipping Fee` FROM `orders` o
    JOIN order_items oi ON oi.`Order ID`=o.`Order ID`
    WHERE DATE(o.`Order Date`) = CURDATE() AND oi.`Order Status` != 'Cancelled' AND oi.`Order Status` != 'Rejected'
    GROUP BY o.`Order ID`";
    $TodaySale = mysqli_query($conn, $TodaySaleQuery);
    if ($TodaySale->num_rows > 0) {
        while ($row = $TodaySale->fetch_assoc()) {
            $TodaySalePrice += $row['Total Due'];
        }
    } else {
        $TodaySalePrice = 0;
    }
    echo $TodaySalePrice;
}


if (isset($_POST['TotalOrders'])) {
    $TotalOrderQuery = "SELECT COUNT(*) AS Count FROM `orders` ";
    $TotalOrder = mysqli_query($conn, $TotalOrderQuery);
    $Row = $TotalOrder->fetch_assoc();
    $TotalOrderCount = $Row['Count'];
    echo $TotalOrderCount;
}

if (isset($_POST['TotalProduct'])) {
    $TotalProductQuery = "SELECT COUNT(*) AS Count FROM `posts` ";
    $TotalProduct = mysqli_query($conn, $TotalProductQuery);
    $Row = $TotalProduct->fetch_assoc();
    $TotalProductCount = $Row['Count'];
    echo $TotalProductCount;
}


if (isset($_POST['Edit'])) {
    $ProductID = $_POST['ProductID'];
    $CustomProductID = strtoupper($_POST['CustomProductID']);
    $Title = addslashes($_POST['Title']);
    $SlugTitle = CreateSlug($Title);
    $Price = $_POST['Price'];
    $DiscountPrice = $_POST['DiscountPrice'];
    $DiscountPercentage = $_POST['DiscountPercentage'];
    $ProductQuantity = $_POST['ProductQuantity'];
    $ProductDescription = addslashes($_POST['ProductDescription']);
    $ProductTypeID = $_POST['ProductTypeID'];
    $BrandID = $_POST['BrandID'];
    $Query = "UPDATE `posts` p 
JOIN `postsmeta` pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key`='Brand ID'
JOIN `postsmeta` pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key`='Product Type ID'
SET p.`Custom Product ID`='$CustomProductID', p.`Product Title` = '$Title',p.`Slug Url`='$SlugTitle', p.`Product Content`= '$ProductDescription', p.`Product Price`='$Price', p.`Discount Price`='$DiscountPrice',`Discount Percentage`='$DiscountPercentage', p.`Product Quantity`='$ProductQuantity',
pm1.`Product Meta Value` = '$BrandID',
pm3.`Product Meta Value` = '$ProductTypeID' 
WHERE p.ID = '$ProductID'";
    $UpdateQuery = $conn->query($Query);
    if ($UpdateQuery) {
        echo "Success";
    } else {
        echo "Failed";
    }
}

if (isset($_POST['FeatchImage'])) {
    $Images = [];
    $RowID = [];
    $ProductID = $_POST['ID'];
    $ImagesQuery = "SELECT * FROM `postsmeta` WHERE `Product Meta Key` LIKE '%Image%' AND `Product ID`='$ProductID' ORDER BY ID ASC";
    $ImagesQueryRun = mysqli_query($conn, $ImagesQuery);
    while ($Row = $ImagesQueryRun->fetch_assoc()) {
        $Images[] = $Row['Product Meta Value'];
        $RowID[] = $Row['ID'];
    }

    if (isset($_POST['ImageUrl'])) {
        $Data = json_encode($Images);
        echo $Data;
    } else if (isset($_POST['RowID'])) {
        $Data = json_encode($RowID);
        echo $Data;
    }
}
if (isset($_POST['CreateCoponCode'])) {
    $couponcode =  $_POST['couponcode'];
    $coupondescription =  $_POST['coupondescription'];
    $enddate = $_POST['enddate'];
    $coupontype = $_POST['coupontype'];
    $couponamount = $_POST['couponamount'];
    $FindDublicateQuery = "SELECT * FROM `coupon_code` WHERE `Coupon Code`='$couponcode'";
    $FindDublicateRun = mysqli_query($conn, $FindDublicateQuery);
    if ($FindDublicateRun->num_rows > 0) {
        echo "Exists";
    } else {
        $InsertCouponcode = "INSERT INTO `coupon_code`(`Coupon Code`, `Coupon Type`, `Coupon Value`, `Description`, `Start Date`, `End Date`) VALUES ('$couponcode','$coupontype','$couponamount','$coupondescription',CONVERT_TZ(NOW(), '+00:00', '+05:45') ,'$enddate')";
        $InsertCouponcodeRun = mysqli_query($conn, $InsertCouponcode);
        if ($InsertCouponcodeRun) {
            echo "Success";
        } else {
            echo "Fail";
        }
    }
}

if (isset($_POST['ApplyCoupon'])) {
    $response = array();
    $item_count = "SELECT * FROM product_cart WHERE `User ID`='$user_id'";
    $execute = mysqli_query($conn, $item_count);
    $cart_item_count = mysqli_num_rows($execute);

    $CouponCode = mysqli_real_escape_string($conn, $_POST['CouponCode']);
    $TotalDueQuery = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id'";
    $runquery = mysqli_query($conn, $TotalDueQuery);

    if ($runquery) {
        $Subtotal = 0;
        $cartItems = array();
        while ($rowcart = $runquery->fetch_assoc()) {
            $Subtotal += $rowcart['Total Due'];
            $cartItems[] = $rowcart;
        }
        $ApplyCouponCodeQuery = "SELECT * FROM `coupon_code` WHERE BINARY `Coupon Code`='$CouponCode'";
        $ApplyCouponCodeRun = mysqli_query($conn, $ApplyCouponCodeQuery);
        $CartValue1 = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id' AND `Applied Promo Code`='$CouponCode'";
        $CartValue2 = "SELECT * FROM `product_cart` WHERE `User ID`='$user_id' AND `Applied Promo Code`!=''";
        $CartValueRun1 = mysqli_query($conn, $CartValue1);
        $CartValueRun2 = mysqli_query($conn, $CartValue2);
        if ($CartValueRun1->num_rows > 0) {
            exit();
        } else {
            if ($ApplyCouponCodeRun->num_rows > 0) {
                $Row = $ApplyCouponCodeRun->fetch_assoc();
                $endDateTimestamp = strtotime($Row['End Date']);

                if ($endDateTimestamp >= time()) {
                    $couponType = $Row['Coupon Type'];
                    $couponValue = $Row['Coupon Value'];
                    $minimumCartPrice = $Row['Minimum Cart Price'];
                    $SubPerProduct = ($couponValue / $cart_item_count);

                    $item_count = "SELECT * FROM product_cart WHERE `User ID`='$user_id'";
                    $execute = mysqli_query($conn, $item_count);
                    $TotalPrice = 0;
                    $TotalSaved = 0;
                    while ($rowcart = $execute->fetch_assoc()) {
                        $TotalPrice += $rowcart['Total Due'];
                        $TotalSaved += $rowcart['Product Price'];
                    }
                    $SavedAmount = $TotalSaved - $TotalPrice;

                    if ($couponType == 'Fixed Amount') {
                        if ($Subtotal >= $minimumCartPrice) {
                            $TotalPrice = $Subtotal - $couponValue;
                            $response['Amount'] = $TotalPrice;
                            $response['Discount Amount'] = $couponValue;
                            $response['Total Saved'] = $couponValue + $SavedAmount;
                            $response['Message'] = "Fixed Amount";
                            foreach ($cartItems as $cartItem) {
                                $RowID = $cartItem['ID'];
                                $PerProductPrice =  $cartItem['Total Due'];
                                $Total = $PerProductPrice - $SubPerProduct;
                                $UpdateCart = "UPDATE `product_cart` SET `Total Due`='$Total', `Applied Promo Code`='$CouponCode' WHERE `ID`='$RowID'";
                                $UpdateCartRun = mysqli_query($conn, $UpdateCart);
                            }
                        } else {
                            $response['Message'] = "Price is less than required!";
                        }
                    } elseif ($couponType == 'Percentage') {
                        $PercentageCalculate = ceil(($Subtotal / 100) * $couponValue);
                        $TotalPrice = $Subtotal - $PercentageCalculate;
                        $response['Amount'] = $TotalPrice;
                        $response['Discount Amount'] = $couponValue;
                        $response['Total Saved Amount'] =  $SavedAmount;
                        $response['Message'] = "Percentage";
                        foreach ($cartItems as $cartItem) {
                            $RowID = $cartItem['ID'];
                            $PerProductPrice =  $cartItem['Total Due'];
                            $Total = $PerProductPrice - (($PerProductPrice / 100) * $couponValue);
                            $UpdateCart = "UPDATE `product_cart` SET `Total Due`='$Total', `Applied Promo Code`='$CouponCode' WHERE `ID`='$RowID'";
                            $UpdateCartRun = mysqli_query($conn, $UpdateCart);
                        }
                    }
                } else {
                    $response['Message'] = "Coupon has expired";
                }
            } else {
                $response['Message'] = "Coupon not found";
            }
        }
    } else {
        $response['Message'] = "Error fetching cart details";
    }
    echo json_encode($response);
}




if (isset($_POST['FindCustomProductID'])) {
    $RecendInsertedRowQuery = "SELECT `Custom Product ID` AS RecentProduct FROM posts WHERE ID = (SELECT MAX(ID) FROM posts)";
    $RecendInsertedRowQueryRun = mysqli_query($conn, $RecendInsertedRowQuery);
    $RecendInsertedRow = $RecendInsertedRowQueryRun->fetch_assoc();
    $RecendInsertedCustomID = $RecendInsertedRow['RecentProduct'];
    echo $RecendInsertedCustomID;
}

if (isset($_POST['ShortItem'])) {
    $ProductTypeID = $_POST['ProductTypeID'];
    $BrandID = $_POST['BrandID'];
    $FeaturedProduct = $_POST['FeaturedProduct'];
    $ShortType = $_POST['ShortType'];
    if ($ShortType == "Default") {
        $Condition = '';
    } else if ($ShortType == 'DESC') {
        $Condition = 'ORDER BY `Product Price` DESC';
    } else if ($ShortType == 'ASC') {
        $Condition = 'ORDER BY `Product Price` ASC';
    }


    if ($ProductTypeID == 0 && $BrandID == 0) {
        //  $FeaturedProduct
        if ($FeaturedProduct == 322) {
            $Where = "WHERE p.ID=30 OR p.ID=325 OR p.ID=143 OR p.ID=192 OR p.ID=327 OR p.ID=292 OR p.ID=187 OR p.ID=329 OR p.ID=121 $Condition";
        } else {
            $Where = "$Condition  LIMIT 0,100 ";
        }
        $ProductMetaType = "Product Type ID";
    } else if ($BrandID == 0 && $FeaturedProduct == 0) {

        // $ProductTypeID
        $ProductMetaType = "Product Type ID";
        $Where = "WHERE pm3.`Product Meta Value`='$ProductTypeID' $Condition";
    } else if ($FeaturedProduct == 0 && $ProductTypeID == 0) {
        // $BrandID
        $ProductMetaType = "Brand ID";
        $Where = "WHERE pm3.`Product Meta Value`='$BrandID' $Condition";
    }




    $query = "SELECT DISTINCT p.ID, p.`Product Title`,p.`Slug Url`, p.`Product Price`,p.`Discount Price`,p.`Discount Percentage`, pm1.`Product Meta Value` 
AS ProductBrand, pm2.`Product Meta Value` AS ProductThumbnail, pm3.`Product Meta Value` AS ProductType,
CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
CASE WHEN ci.`Product_ID` IS NOT NULL AND ci.`User ID`='$user_id' THEN 'Added' ELSE 'Not Added' END AS IsAddedToCart,
CASE WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' ELSE 'In Stock'END AS StockStatus
FROM posts p 
LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID`
LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
JOIN postsmeta pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key` = '$ProductMetaType' $Where";
    $result = $conn->query($query);
    $Output = '';

    if (!function_exists('isMobileDevice')) {
        function isMobileDevice()
        {
            return (bool) preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $_SERVER['HTTP_USER_AGENT']);
        }
    }
    $is_mobile = isMobileDevice();
    while ($row = $result->fetch_assoc()) {
        $product_title = $row['Product Title'];
        if ($is_mobile) {
            $limited_title = (strlen($product_title) > 35) ? substr($product_title, 0, 35) . "...." : $product_title;
        } else {
            $limited_title = (strlen($product_title) > 50) ? substr($product_title, 0, 50) . "...." : $product_title;
        }
        $price = $row['Product Price'];
        $DiscountPrice = $row['Discount Price'];
        $DiscountPercentage = $row['Discount Percentage'];
        $StockStatus = $row['StockStatus'];
        $product_id = $row['ID'];
        $SlugUrl = $row['Slug Url'];
        $AddedInCart = $row['IsAddedToCart'];
        $AddedInWishlist = $row['IsAddedToWishlist'];
        $thumbnail_url = $row['ProductThumbnail'];
        $BrandID = $row['ProductBrand'];
        $FindBrandName = "SELECT * FROM `product_category` WHERE `Product Category ID`='$BrandID'";
        $Find = mysqli_query($conn, $FindBrandName);
        $Row = $Find->fetch_assoc();
        $BrandName = $Row['Product Category Attribute'];
        if($DiscountPercentage != ''){
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $DSNPoint=$DiscountValue/100;
        }elseif($DiscountPrice != ''){
            $DSNPoint=$DiscountPrice/100;
        }else{
            $DSNPoint=$price/100;
        }
        $Output .= "<div class='product-divider'>
        <div class='product-box'>";
        if ($StockStatus == 'Out of Stock') {
            $Output .= "<div class='price-and-stock-info out-of-stock'>
        <i class='bx bxs-purchase-tag'></i> Out of Stock
        </div>";
        } elseif ($DiscountPercentage != '') {
            $Output .= "<div class='price-and-stock-info discount'>
        <i class='bx bxs-purchase-tag'></i> $DiscountPercentage% Off
        </div>";
        } elseif ($DiscountPrice != '') {
            $Output .= "<div class='price-and-stock-info discount'>
        <i class='bx bxs-purchase-tag'></i> Rs. $DiscountPrice 
        </div>";
        }

        if ($AddedInWishlist == 'Not Added') {
            $Output .= "<i class='bx bx-heart AddToWishlist AddToWishlist-btn' data-product-id-wishlist='" . $product_id . "'></i>";
        } else if ($AddedInWishlist == 'Added') {
            $Output .= "<i class='bx bxs-heart AddToWishlist AddToWishlist-btn' data-product-id-wishlist='" . $product_id . "'></i>";
        }

        $Output .= "<a href='Product/$SlugUrl'>
                  <div class='DSN-point-container'>
                 <div class='DSN-point'>
                    $DSNPoint DSN Point
                </div>
                <img src='$thumbnail_url' alt='$product_title' loading='lazy'>
                </div>
                <div class='product-data'>
                    <span class='productbrand'>$BrandName</span>
                    <h5>$limited_title</h5>
            </a>
        </div>
        <div class='price-cart'>";
        if ($DiscountPrice != '') {
            $Output .= "<div class='product-price-box'>
            <h4 class='product-non-discount-price'>Rs. $price.00</h4>
            <h4 class='product-discount-price'>Rs. $DiscountPrice.00</h4>
            </div>";
        } elseif ($DiscountPercentage != '') {
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $Output .= "<div class='product-price-box'>
                    <h4 class='product-non-discount-price'>Rs. $price.00</h4>
                    <h4 class='product-discount-price'>Rs. $DiscountValue.00</h4>
                    </div>";
        } else {
            $Output .= "<h4>Rs. $price.00</h4>";
        }
        if ($AddedInCart == 'Not Added') {
            $Output .= "<i class='bx bx-cart product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        } else if ($AddedInCart == 'Added') {
            $Output .= "<i class='bx bx-check product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        }
        $Output .= "</div>
        </div>
        </div>";
    }
    echo $Output;
}


if (isset($_POST['ShortItemInSearch'])) {
    $ShortType = $_POST['ShortType'];
    if ($ShortType == "Default") {
        $Condition = '';
    } else if ($ShortType == 'DESC') {
        $Condition = 'ORDER BY `Product Price` DESC';
    } else if ($ShortType == 'ASC') {
        $Condition = 'ORDER BY `Product Price` ASC';
    }

    $search_input = $_POST['SearchTerm'];
    $search_input = mysqli_real_escape_string($conn, $search_input);
    $search_input = addslashes($search_input);
    $query = "SELECT DISTINCT p.ID,
    p.`Custom Product ID`, 
    p.`Product Title`, 
    p.`Slug Url`, 
    p.`Slug Url`, 
    p.`Product Price`,
    p.`Discount Price`,
    p.`Product Content`,
    p.`Discount Percentage`, 
    pm1.`Product Meta Value` AS ProductBrand, 
    pm2.`Product Meta Value` AS ProductThumbnail ,
    CASE WHEN wishlist.`Product ID` IS NOT NULL THEN 'Added' ELSE 'Not Added' END AS IsAddedToWishlist,
    CASE 
        WHEN ci.`Product_ID` IS NOT NULL AND ci.`User ID`='$user_id' THEN 'Added' 
        ELSE 'Not Added' 
    END AS IsAddedToCart,
    CASE 
        WHEN p.`Product Quantity` <= 0 THEN 'Out of Stock' 
        ELSE 'In Stock'
    END AS StockStatus
FROM posts p 
LEFT JOIN `product_cart` ci ON p.ID = ci.`Product_ID`
LEFT JOIN `product_wishlist` wishlist ON p.ID = wishlist.`Product ID` AND wishlist.`User ID` = '$user_id'
JOIN postsmeta pm1 ON p.ID = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Brand ID'
JOIN postsmeta pm2 ON p.ID = pm2.`Product ID` AND pm2.`Product Meta Key` = 'Image 1'
JOIN postsmeta pm3 ON p.ID = pm3.`Product ID` AND pm3.`Product Meta Key` = 'Product Type ID'
JOIN product_category pc1 ON pm3.`Product Meta Value` = pc1.`Product Category ID`
WHERE 
    LOWER(p.`Product Title`) LIKE LOWER('%$search_input%') 
    OR LOWER(p.`Slug Url`) LIKE LOWER('%$search_input%') 
    OR LOWER(pc1.`Product Category Attribute`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`Product Price`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`Product Content`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`ID`) LIKE LOWER('%$search_input%')
    OR LOWER(p.`Custom Product ID`) LIKE LOWER('%$search_input%')
    $Condition";
    $result = $conn->query($query);
    $Output = '';

    if (!function_exists('isMobileDevice')) {
        function isMobileDevice()
        {
            return (bool) preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $_SERVER['HTTP_USER_AGENT']);
        }
    }
    $is_mobile = isMobileDevice();
    while ($row = $result->fetch_assoc()) {
        $product_title = $row['Product Title'];
        if ($is_mobile) {
            $limited_title = (strlen($product_title) > 35) ? substr($product_title, 0, 35) . "...." : $product_title;
        } else {
            $limited_title = (strlen($product_title) > 50) ? substr($product_title, 0, 50) . "...." : $product_title;
        }
        $price = $row['Product Price'];
        $DiscountPrice = $row['Discount Price'];
        $DiscountPercentage = $row['Discount Percentage'];
        $StockStatus = $row['StockStatus'];
        $product_id = $row['ID'];
        $SlugUrl = $row['Slug Url'];
        $AddedInCart = $row['IsAddedToCart'];
        $AddedInWishlist = $row['IsAddedToWishlist'];
        $thumbnail_url = $row['ProductThumbnail'];
        $BrandID = $row['ProductBrand'];
        $FindBrandName = "SELECT * FROM `product_category` WHERE `Product Category ID`='$BrandID'";
        $Find = mysqli_query($conn, $FindBrandName);
        $Row = $Find->fetch_assoc();
        $BrandName = $Row['Product Category Attribute'];
        if ($DiscountPercentage != '') {
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $DSNPoint = $DiscountValue / 100;
        } elseif ($DiscountPrice != '') {
            $DSNPoint = $DiscountPrice / 100;
        } else {
            $DSNPoint = $price / 100;
        }
        $Output .= "<div class='product-divider'>
            <div class='product-box'>";
        if ($StockStatus == 'Out of Stock') {
            $Output .= "<div class='price-and-stock-info out-of-stock'>
            <i class='bx bxs-purchase-tag'></i> Out of Stock
            </div>";
        } elseif ($DiscountPercentage != '') {
            $Output .= "<div class='price-and-stock-info discount'>
            <i class='bx bxs-purchase-tag'></i> $DiscountPercentage% Off
            </div>";
        } elseif ($DiscountPrice != '') {
            $Output .= "<div class='price-and-stock-info discount'>
            <i class='bx bxs-purchase-tag'></i> Rs. $DiscountPrice 
            </div>";
        }
        if ($AddedInWishlist == 'Not Added') {
            $Output .= "<i class='bx bx-heart AddToWishlist AddToWishlist-btn' data-product-id-wishlist='" . $product_id . "'></i>";
        } else if ($AddedInWishlist == 'Added') {
            $Output .= "<i class='bx bxs-heart AddToWishlist AddToWishlist-btn' data-product-id-wishlist='" . $product_id . "'></i>";
        }
        $Output .= "<a href='Product/$SlugUrl'>
                    <div class='DSN-point-container'>
                 <div class='DSN-point'>
                    $DSNPoint DSN Point
                </div>
                <img src='$thumbnail_url' alt='$product_title' loading='lazy'>
                </div>
                    <div class='product-data'>
                        <span class='productbrand'>$BrandName</span>
                        <h5>$limited_title</h5>
                </a>
            </div>
            <div class='price-cart'>";
        if ($DiscountPrice != '') {
            $Output .= "<div class='product-price-box'>
                <h4 class='product-non-discount-price'>Rs. $price.00</h4>
                <h4 class='product-discount-price'>Rs. $DiscountPrice.00</h4>
                </div>";
        } elseif ($DiscountPercentage != '') {
            $DiscountValueCalculate = ceil(($price / 100) * $DiscountPercentage);
            $DiscountValue = $price - $DiscountValueCalculate;
            $Output .= "<div class='product-price-box'>
                        <h4 class='product-non-discount-price'>Rs. $price.00</h4>
                        <h4 class='product-discount-price'>Rs. $DiscountValue.00</h4>
                        </div>";
        } else {
            $Output .= "<h4>Rs. $price.00</h4>";
        }
        if ($AddedInCart == 'Not Added') {
            $Output .= "<i class='bx bx-cart product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        } else if ($AddedInCart == 'Added') {
            $Output .= "<i class='bx bx-check product-cart AddToCart' data-product-id='" . $row['ID'] . "'></i>";
        }
        $Output .= "</div>
            </div>
            </div>";
    }
    echo $Output;
}


if (isset($_POST['FilterByDate'])) {
    $ShortType = $_POST['ShortType'];
    if ($ShortType == "Today") {
        $Condition = "WHERE DATE(orders.`Order Date`) = CURDATE() ORDER BY orders.`Order ID` DESC";
        $ConditionForPrice = "WHERE DATE(o.`Order Date`) = CURDATE() AND oi.`Order Status` != 'Cancelled' AND oi.`Order Status` != 'Rejected'
    GROUP BY o.`Order ID`";
        $Title = "Today's Orders";
    } else if ($ShortType == '7') {
        $Condition = 'WHERE orders.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY orders.`Order ID` DESC';
        $ConditionForPrice = "WHERE o.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND oi.`Order Status` != 'Cancelled' AND oi.`Order Status` != 'Rejected'
    GROUP BY o.`Order ID`";
        $Title = "Last 7 days orders";
    } else if ($ShortType == '15') {
        $Condition = 'WHERE orders.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) ORDER BY orders.`Order ID` DESC';
        $ConditionForPrice = "WHERE o.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND oi.`Order Status` != 'Cancelled' AND oi.`Order Status` != 'Rejected'
    GROUP BY o.`Order ID`";
        $Title = "Last 15 days orders";
    } else if ($ShortType == '30') {
        $Condition = 'WHERE orders.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) ORDER BY orders.`Order ID` DESC';
        $ConditionForPrice = "WHERE o.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND oi.`Order Status` != 'Cancelled' AND oi.`Order Status` != 'Rejected'
    GROUP BY o.`Order ID`";
        $Title = "Last 30 days orders";
    } else if ($ShortType == '1 years') {
        $Condition = 'WHERE orders.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 365 DAY) ORDER BY orders.`Order ID` DESC';
        $ConditionForPrice = "WHERE o.`Order Date` >= DATE_SUB(CURDATE(), INTERVAL 365 DAY) AND oi.`Order Status` != 'Cancelled' AND oi.`Order Status` != 'Rejected'
    GROUP BY o.`Order ID`";
        $Title = "Last 1 years orders";
    }

    $LatestOrderQuery = "SELECT DISTINCT orders.`Order ID` AS ID, 
    user.`First Name` AS FirstName,
    user.`Email` AS Email, orders.`Total Due` AS TotalDue, 
    OrderList.`Order Status` AS OrderStatus, orders.`Order Date` AS OrderDate
    FROM `orders`
    JOIN user_table user ON user.`ID`= orders.`User ID`
    JOIN order_items OrderList ON OrderList.`Order ID`=orders.`Order ID` AND OrderList.`User ID`= orders.`User ID` $Condition";
    $LatestOrder = mysqli_query($conn, $LatestOrderQuery);

    $TodaySalePrice = 0;
    $TodaySaleQuery = "SELECT o.`Total Due` AS TotalDue FROM `orders` o
    JOIN order_items oi ON oi.`Order ID`=o.`Order ID` $ConditionForPrice";
    $TodaySale = mysqli_query($conn, $TodaySaleQuery);
    if ($TodaySale->num_rows > 0) {
        while ($row = $TodaySale->fetch_assoc()) {
            $TotalDue = $row['TotalDue'];
            $TodaySalePrice += $TotalDue;
        }
    } else {
        $TodaySalePrice = 0;
    }
    $TodaySalePrice = number_format($TodaySalePrice);
    $TotalOrderQuery = "SELECT COUNT(*) AS Count FROM `orders` $Condition";
    $TotalOrder = mysqli_query($conn, $TotalOrderQuery);
    $Row2 = $TotalOrder->fetch_assoc();
    $TotalOrderCount = $Row2['Count'];

    $TotalProductQuery = "SELECT COUNT(*) AS Count FROM `posts`";
    $TotalProduct = mysqli_query($conn, $TotalProductQuery);
    $Row3 = $TotalProduct->fetch_assoc();
    $TotalProductCount = $Row3['Count'];


    $Output = " <div class='dashboard-box'>
            <div class='today-sales'>
                <div class='data-icon total-sales-icon-box'>
                    <i class='bx bx-rupee'></i>
                </div>
                <div class='data'>
                    <p>Total Sales</p>
                    <p id='TodaySalesPrice'>Rs. $TodaySalePrice</p>
                </div>
            </div>
            <div class='total-orders'>
                <a href='Admin/Order Management.php' target='_blank'>
                <div class='data-icon total-order-icon-box'>
                    <i class='bx bx-notepad'></i>
                </div>
                <div class='data'>
                    <p>Total Orders</p>
                    <p id='TotalOrder'>$TotalOrderCount</p>
                </div>
                </a>
            </div>
            <div class='total-products'>
                 <a href='Admin/Product List.php' target='_blank'>
                <div class='data-icon total-product-icon-box'>
                    <i class='bx bx-package'></i>
                </div>
                <div class='data'>
                    <p>Total Product</p>
                    <p id='TotalProduct'>$TotalProductCount</p>
                </div>
                </a>
            </div>
        </div>";

    $Output .= '<div class="latest-orders-container">
        <div class="order-list-box">';
    $Output .= "<div class='latest-order-title'>$Title</div>";
    if ($LatestOrder->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($LatestOrder)) {
            $OrderID = $row['ID'];
            $FirstName = $row['FirstName'];
            $Email = $row['Email'];
            $TotalDue = number_format($row['TotalDue']);
            $TotalDue = "Rs. " . $TotalDue;
            $OrderStatus = $row['OrderStatus'];
            $Date = $row['OrderDate'];
            $timestamp = strtotime($Date);
            $formattedDate = date('Y-m-d', $timestamp);

            $Output .= "<div class='order-info'>
            <a href='Admin/Order Detail Page.php?OrderID=$OrderID' target='_blank'>
                <div class='order-number-box'>
                    #$OrderID
                </div>
                <div class='customer-name-box'>
                    $FirstName
                </div>
                <div class='customer-email'>
                    $Email
                </div>
                <div class='total-price'>
                    $TotalDue
                </div>";
            if ($OrderStatus == 'Review') {
                $Output .= "<div class='order-status review'>$OrderStatus</div>";
            } else if ($OrderStatus == 'Complete') {
                $Output .= "<div class='order-status complete'>$OrderStatus</div>";
            } else if ($OrderStatus == 'Pending') {
                $Output .= "<div class='order-status pending'>$OrderStatus</div>";
            } else if ($OrderStatus == 'Shipped') {
                $Output .= "<div class='order-status shipped'>$OrderStatus</div>";
            } else if ($OrderStatus == 'Cancelled' || $OrderStatus == 'Rejected') {
                $Output .= "<div class='order-status failed'>$OrderStatus</div>";
            }

            $Output .= "
                <div class='order-date'>
                    $formattedDate
                </div>
            </a>
        </div>";
        }
    } else {
        $Output .= "<div class='order-info'><a>Result Not Found</a></div>";
    }
    $Output .= '</div></div>';
    echo $Output;
}


if (isset($_POST['LiveSearch'])) {
    $searchTerm = $_POST['searchTerm'];
    $SearchQuery = "SELECT
    p.ID AS ProductID,
    pm1.`Product Meta Value` AS ProductImage,
    p.`Product Title`,
    p.`Custom Product ID` AS CustomID,
    p.`Product Price`,
    p.`Product Quantity`,
    pc1.`Product Category Attribute` AS Brand
FROM 
    `posts` p
JOIN 
    postsmeta pm1 ON pm1.`Product ID` = p.ID AND pm1.`Product Meta Key` = 'Image 1'
JOIN 
    postsmeta pm2 ON pm2.`Product ID` = p.ID AND pm2.`Product Meta Key` = 'Brand ID'
JOIN 
    product_category pc1 ON pm2.`Product Meta Value` = pc1.`Product Category ID`
WHERE 
    p.`Product Title` LIKE '%$searchTerm%' 
    OR p.`Custom Product ID` LIKE '%$searchTerm%'
    OR p.`ID` LIKE '%$searchTerm%'
    OR pc1.`Product Category Attribute` LIKE '%$searchTerm%'
    ORDER BY
    CustomID
    DESC";

    $SearchResult = mysqli_query($conn, $SearchQuery);

    if ($SearchResult->num_rows > 0) {
        while ($Row = $SearchResult->fetch_assoc()) {
            $Array[] = $Row;
        }

        $Data = json_encode($Array);
        echo $Data;
    } else {
        echo json_encode(array("message" => "No data found"));
    }
}




if (isset($_POST['OrderManagementLiveSearch'])) {
    $searchTerm = $_POST['searchTerm'];
    $SearchQuery = "SELECT DISTINCT 
    OrderItem.`Order ID` AS 'OrderID',
    OrderItem.`User ID` AS 'UserID',
    OrderItem.`Total Due` AS TotalDue,
    OrderList.`Payment Method` AS PaymentMethod,
    OrderList.`Order Status` AS OrderStatus,
    OrderList.`Tracking Number`,
    deliveryInfo.`Full Name` AS Name,
    deliveryInfo.`Phone`,
    user.`First Name`,
    user.`Last Name`,
    user.`Mobile Number`,
    user.`Email`,
    pm1.`Product Meta Value` AS ImagePath
    FROM
    `orders` OrderItem
JOIN `order_items` AS OrderList ON OrderList.`Order ID` = OrderItem.`Order ID`
JOIN posts p ON OrderList.`Product ID` = p.`ID`
JOIN postsmeta pm1 ON pm1.`Product ID` = OrderList.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
JOIN `delivery_info` deliveryInfo ON deliveryInfo.`User ID`=OrderItem.`User ID`
JOIN `user_table` user ON user.`ID` = OrderItem.`User ID`
WHERE 
 
  deliveryInfo.`Full Name` LIKE '%$searchTerm%' 
    OR deliveryInfo.`Phone` LIKE '%$searchTerm%' 
    OR user.`First Name` LIKE '%$searchTerm%' 
    OR user.`Last Name` LIKE '%$searchTerm%' 
    OR user.`Mobile Number` LIKE '%$searchTerm%' 
    OR user.`User Address` LIKE '%$searchTerm%' 
    OR user.`Email` LIKE '%$searchTerm%'
    OR OrderList.`Tracking Number` LIKE '%$searchTerm%' 
    OR OrderList.`Order Status` LIKE '%$searchTerm%' 
    GROUP BY 
    OrderItem.`Order ID` 
    ORDER BY OrderID DESC";

    $SearchResult = mysqli_query($conn, $SearchQuery);
    $Output = '';
    $Output .= "
        <tr class='table-title'>
        <th>Product</th>
        <th>Price</th>
        <th>Payment</th>
        <th>Status</th>
        <th>Action</th>
        </tr>";

    if ($SearchResult->num_rows > 0) {
        while ($Row = $SearchResult->fetch_assoc()) {
            $OrderID = $Row['OrderID'];
            $Image = $Row['ImagePath'];
            $TotalDue = "Rs. " . $Row['TotalDue'] . ".00";
            $PaymentMethod = $Row['PaymentMethod'];
            $Name = $Row['Name'];
            if ($PaymentMethod == 'Cash On Delivery') {
                $PaymentMethod = 'COD';
            }
            $OrderStatus = $Row['OrderStatus'];

            $Output .= "
        <tr class='product-box'>
        <td class='user-product-info'>
                        <div class='product-title-data'>
                            <div class='product-img'>";
            $Output .= "#$OrderID <img src='$Image'>";
            $Output .= "</div>
                    <div class='user-name'>$Name</div>
                </div>
            </td>
            <td>
                <div class='product-price-data'>$TotalDue</div>
            </td>
            <td>$PaymentMethod</td>
            <td>";
            if ($OrderStatus == 'Review') {
                $Output .= "<div class='order-status review'>$OrderStatus</div>";
            } else if ($OrderStatus == 'Complete') {
                $Output .= "<div class='order-status complete'>$OrderStatus</div>";
            } elseif ($OrderStatus == 'Pending') {
                $Output .= "<div class='order-status pending'>$OrderStatus</div>";
            } elseif ($OrderStatus == 'Shipped') {
                $Output .= "<div class='order-status shipped'>$OrderStatus</div>";
            } elseif ($OrderStatus == 'Cancelled' || $OrderStatus == 'Rejected') {
                $Output .= "<div class='order-status failed'>$OrderStatus</div>";
            }

            $Output .= "</td>
            <td>
                <div class='action-data'>
                    <a href='Admin/Order Detail Page.php?OrderID=$OrderID'>
                        <div class='edit-box'>
                            <i class='fa-regular fa-pen-to-square'></i>
                        </div>
                    </a>
                </div>
            </td>
            </tr>";
        }
    } else {
        $Output .= "<div>Result not found</div>";
    }
    echo $Output;
}



if (isset($_POST['CountOrder'])) {
    $searchTerm = $_POST['searchTerm'];
    $SearchQuery = "SELECT DISTINCT 
    OrderItem.`Order ID` AS 'OrderID',
    OrderItem.`User ID` AS 'UserID',
    OrderItem.`Total Due` AS TotalDue,
    OrderList.`Payment Method` AS PaymentMethod,
    OrderList.`Order Status` AS OrderStatus,
    OrderList.`Tracking Number`,
    deliveryInfo.`Full Name` AS Name,
    deliveryInfo.`Phone`,
    user.`First Name`,
    user.`Last Name`,
    user.`Mobile Number`,
    user.`Email`,
    pm1.`Product Meta Value` AS ImagePath
    FROM
    `orders` OrderItem
JOIN `order_items` AS OrderList ON OrderList.`Order ID` = OrderItem.`Order ID`
JOIN posts p ON OrderList.`Product ID` = p.`ID`
JOIN postsmeta pm1 ON pm1.`Product ID` = OrderList.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
JOIN `delivery_info` deliveryInfo ON deliveryInfo.`User ID`=OrderItem.`User ID`
JOIN `user_table` user ON user.`ID` = OrderItem.`User ID`
WHERE 
 
  deliveryInfo.`Full Name` LIKE '%$searchTerm%' 
    OR deliveryInfo.`Phone` LIKE '%$searchTerm%' 
    OR user.`First Name` LIKE '%$searchTerm%' 
    OR user.`Last Name` LIKE '%$searchTerm%' 
    OR user.`Mobile Number` LIKE '%$searchTerm%' 
    OR user.`User Address` LIKE '%$searchTerm%' 
    OR user.`Email` LIKE '%$searchTerm%'
    OR OrderList.`Tracking Number` LIKE '%$searchTerm%' 
    OR OrderList.`Order Status` LIKE '%$searchTerm%' 
    GROUP BY 
    OrderItem.`Order ID` 
    ORDER BY OrderID DESC";

    $SearchResult = mysqli_query($conn, $SearchQuery);
    $Count =  $SearchResult->num_rows;
    echo $Count;
}
if (isset($_POST['UpdateImages'])) {
    $Array = [];
    $ProductID = $_POST['ProductID'];
    $FeatchImgQuery = "SELECT `Product Meta Key` FROM `postsmeta` WHERE `Product ID`='$ProductID' AND `Product Meta Key` LIKE '%Image%'";
    $FeatchImgQueryRun = mysqli_query($conn, $FeatchImgQuery);
    $ImagesCount = $FeatchImgQueryRun->num_rows;
    $uploadDir = $base_url . "Assets/Product/Media/Images/Product Images/" . date("Y/m");
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    if (!empty($_FILES['Images']['name'][0])) {
        foreach ($_FILES['Images']['tmp_name'] as $key => $tmp_name) {
            $name = $_FILES['Images']['name'][$key];
            $uploadFile = $uploadDir . "/" . basename($name);
            $imagePathWithoutBaseURL = str_replace($base_url, '', $uploadFile);
            if (move_uploaded_file($tmp_name, $uploadFile)) {
                $ImagesCount++;
                $metaKey = "Image $ImagesCount";
                $sqlImage = "INSERT INTO postsmeta (`Product ID`, `Product Meta Key`, `Product Meta Value`) VALUES ('$ProductID', '$metaKey', '$imagePathWithoutBaseURL')";
                $conn->query($sqlImage);
            } else {
                echo "Error";
            }
        }
        echo "Success";
    } else {
        echo "Success";
    }
}

if (isset($_POST['DeleteImage'])) {
    $RowID = $_POST['DeleteImageRowID'];
    if ($RowID != 0) {
        $RowInfoQuery = "SELECT * FROM postsmeta WHERE ID='$RowID'";
        $RowInfoQueryRun = mysqli_query($conn, $RowInfoQuery);
        if ($RowInfoQueryRun->num_rows > 0) {
            $Row = $RowInfoQueryRun->fetch_assoc();
            $ProductID = $Row['Product ID'];
            $ProductMetaKey = $Row['Product Meta Key'];
            $DeleteImagePath = $Row['Product Meta Value'];
            if ($ProductMetaKey != 'Image 1') {
                $DeleteQuery = "DELETE FROM `postsmeta` WHERE ID='$RowID'";
                $DeleteQueryRun = mysqli_query($conn, $DeleteQuery);
                $Delete = unlink($base_url . $DeleteImagePath);
                if ($Delete) {
                    echo "Success";
                }
            } else {
                $RowInfoQuery2 = "SELECT * FROM `postsmeta` WHERE `ID` =( SELECT MIN(`ID`) FROM `postsmeta` WHERE `Product ID` = '$ProductID' AND `Product Meta Key` NOT LIKE 'Image 1' AND `Product Meta Key` LIKE '%Image%')";
                $ResultCountQuery = "SELECT * FROM `postsmeta` WHERE `Product Meta Key` LIKE '%Image%' AND `Product ID` = '$ProductID'";
                $ResultCountQueryRun = mysqli_query($conn, $ResultCountQuery);
                if ($ResultCountQueryRun->num_rows > 1) {
                    $RowInfoQueryRun = mysqli_query($conn, $RowInfoQuery2);
                    $DeleteQuery = "DELETE FROM `postsmeta` WHERE ID='$RowID'";
                    $DeleteQueryRun = mysqli_query($conn, $DeleteQuery);
                    $ID = $RowInfoQueryRun->fetch_assoc()['ID'];
                    $UpdateQuery = "UPDATE `postsmeta` SET `Product Meta Key`='Image 1' WHERE ID='$ID'";
                    $UpdateQueryRun = mysqli_query($conn, $UpdateQuery);
                    $Delete = unlink($base_url . $DeleteImagePath);
                    if ($Delete) {
                        echo "Success";
                    }
                } else {
                    echo "LastImage";
                }
            }
        } else {
            echo "Error";
        }
    } else {
        echo "Not Saved";
    }
}
if (isset($_POST['UpdatePosition'])) {
    $NewImageOrder = $_POST['ShortOrder'];
    $ProductID = $_POST['ID'];
    $ImageArray = array();
    $ImageQuery = "SELECT * FROM `postsmeta` WHERE `Product ID`='$ProductID' AND `Product Meta Key` LIKE '%Image%' ORDER BY ID ASC";
    $RunImageQuery = mysqli_query($conn, $ImageQuery);
    if ($RunImageQuery->num_rows > 0) {
        while ($Row = $RunImageQuery->fetch_assoc()) {
            $ImageArray[] = $Row;
        }
    }

    $RepeteID1 = 0;
    $RepeteID2 = 0;
    for ($i = 0; $i < (count($ImageArray)); $i++) {
        if ($ImageArray[$i]['ID'] != $NewImageOrder[$i]) {
            if ($RepeteID1 == $ImageArray[$i]['ID'] || $RepeteID2 == $NewImageOrder[$i]) {
                break;
            }
            $RepeteID1 = $ImageArray[$i]['ID'];
            $RepeteID2 = $NewImageOrder[$i];
            $ImagePathQuery = "SELECT * FROM `postsmeta` WHERE ID='" . $ImageArray[$i]['ID'] . "' OR ID='" . $NewImageOrder[$i] . "'";
            $ImagePathQueryRun = mysqli_query($conn, $ImagePathQuery);
            $PathArray = [];
            while ($Row = $ImagePathQueryRun->fetch_assoc()) {
                $PathArray[] = $Row['Product Meta Value'];
            }
            $temp = $PathArray[0];
            $PathArray[0] = $PathArray[1];
            $PathArray[1] = $temp;
            $SQL1 = "UPDATE `postsmeta` SET `Product Meta Value`='" . $PathArray[0] . "' WHERE `ID`='" . $ImageArray[$i]['ID'] . "'";
            $SQL2 = "UPDATE `postsmeta` SET `Product Meta Value`='" . $PathArray[1] . "' WHERE `ID`='" . $NewImageOrder[$i] . "'";
            $RunQuery1 = mysqli_query($conn, $SQL1);
            $RunQuery2 = mysqli_query($conn, $SQL2);
        } else {
            echo "Success";
        }
    }
}
if (isset($_POST['EditCategory'])) {
    $ProductCategoryID = $_POST['CategoryID'];
    $ProductCategoryAttribute = $_POST['CategoryAttribute'];
    $SlugUrl = CreateSlug($ProductCategoryAttribute);
    $MetaTitle = $_POST['MetaTitle'];
    $MetaDescription = $_POST['MetaDescription'];
    $MetaKeyword = $_POST['MetaKeyword'];
    $UpdateQuery = "UPDATE `product_category` SET `Product Category Attribute`='$ProductCategoryAttribute',`Slug Url`='$SlugUrl',`Meta Title`='$MetaTitle',`Meta Description`='$MetaDescription',`Meta Keyword`='$MetaKeyword' WHERE `Product Category ID`='$ProductCategoryID'";
    $UpdateQueryRun = mysqli_query($conn, $UpdateQuery);
    if ($UpdateQueryRun) {
        echo "Success";
    } else {
        echo "Fail";
    }
}
