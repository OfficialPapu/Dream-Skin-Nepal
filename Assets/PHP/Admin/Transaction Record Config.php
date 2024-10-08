<?php
if (!function_exists('isMobileDevice')) {
  function isMobileDevice()
  {
    return (bool) preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $_SERVER['HTTP_USER_AGENT']);
  }
}

$is_mobile = isMobileDevice();
$UserID = $_GET['UserID'];

$UserInfoQuery = "SELECT *,
    SUM(order_items.`Total Due`) AS LifetimePurchase
FROM user_table
LEFT JOIN delivery_info delivery ON user_table.ID = delivery.`User ID`
LEFT JOIN orders ON orders.`User ID` = user_table.ID 
LEFT JOIN order_items ON order_items.`Order ID` = orders.`Order ID` AND order_items.`Order Status` != 'Cancelled' AND order_items.`Order Status` != 'Rejected'
WHERE user_table.`ID` = '$UserID'";

$UserInfoQueryRun = mysqli_query($conn, $UserInfoQuery);

if ($UserInfoQueryRun->num_rows > 0) {
  $PurchaseHistoryQuery = "SELECT
     p.`Product Title`,
    order_items.`Total Due`,
    `pm1`.`Product Meta Value`,
    `order_items`.`Order Status`,
    `orders`.`Payment Method`,
    `orders`.`Payment Screenshot`,
    `orders`.`Order Date`
FROM `order_items`
JOIN posts p ON p.`ID` = order_items.`Product ID`
JOIN postsmeta pm1 ON p.`ID` = pm1.`Product ID` AND pm1.`Product Meta Key` = 'Image 1'
JOIN orders ON orders.`Order ID` = order_items.`Order ID`
WHERE `User ID` = '$UserID'";

  $PurchaseHistoryQueryRun = mysqli_query($conn, $PurchaseHistoryQuery);
  $Row = $UserInfoQueryRun->fetch_assoc();

  $Name = $Row['First Name'] . " " . $Row['Last Name'];
  $Email = $Row['Email'];
  $MobileNumber = $Row['Mobile Number'];
  $UserAddress = $Row['User Address'];
  $UserPic = $Row['User Picture'];
  $DSNPoint = $Row['DSN Point'];
  $LifetimePurchase = $Row['LifetimePurchase'];
  $AccountSignupDate = $Row['Account Signup Date'];

  $FormattedDate = '';
  $DateTime = DateTime::createFromFormat('Y-m-d H:i:s', $AccountSignupDate);
  if ($DateTime !== false) {
    $FormattedDate = $DateTime->format('j M, Y g:i A');
  } else {
    $FormattedDate = 'Invalid date format';
  }

  $BillingName = $Row['Full Name'];
  $BillingPhone = $Row['Phone'];
  $BillingCity = $Row['City'];
  $BillingAddress = $Row['Address'];

  if ($DSNPoint == '') {
    $DSNPoint = "0";
  }

  if ($LifetimePurchase == NULL) {
    $LifetimePurchase = "0";
  }

  $DateOfBirth = $Row['Date Of Birth'];

  if ($UserPic == '') {
    $UserPic = "Account/UserAccount/User Images/Default User.png";
  } else {
    $UserPic = "Account/UserAccount/User Images/$UserPic";
  }
}
