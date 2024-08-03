<?php
include '../Assets/PHP/URL/Base Path.php';
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
include $base_url . 'Assets/PHP/Admin/Dashboard Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <div class='brand-heading-box'>
    <div class="product-type-heading">
            <h1>Dashboard<div class="designing-line"></div>
            </h1>
        </div>
               <div class="option-container">
            <div class="option-tag">
                <div class="select-btn">
                    <span class="SelectedText">Filter By Date</span>
                    <i class='bx bx-chevron-down'></i>
                </div>
                <ul class="options">
                    <li class="option-list" data-shorttype="Today">
                        Today
                    </li>
                    <li class="option-list" data-shorttype="7">
                        Last 7 days 
                    </li>
                    <li class="option-list" data-shorttype="15">
                        Last 15 days
                    </li>
                    <li class="option-list" data-shorttype="30">
                        Last 30 days
                    </li>
                    <li class="option-list" data-shorttype="1 years">
                        Last 1 years
                    </li>
                    
                </ul>
            </div>
        </div>
        </div>
        <div class='product-report-order-container'>
        <div class="dashboard-box">
            <div class="today-sales">
                <div class="data-icon total-sales-icon-box">
                    <i class='bx bx-rupee'></i>
                </div>
                <div class="data">
                    <p>Today Sales</p>
                    <p id="TodaySalesPrice"></p>
                </div>
            </div>
            <div class="total-orders">
                <a href='Admin/Order Management.php' target='_blank'>
                <div class="data-icon total-order-icon-box">
                    <i class='bx bx-notepad'></i>
                </div>
                <div class="data">
                    <p>Total Orders</p>
                    <p id="TotalOrder"></p>
                </div>
                </a>
            </div>
            <div class="total-products">
                 <a href='Admin/Product List.php' target='_blank'>
                <div class="data-icon total-product-icon-box">
                    <i class='bx bx-package'></i>
                </div>
                <div class="data">
                    <p>Total Product</p>
                    <p id="TotalProduct"></p>
                </div>
                </a>
            </div>
        </div>
        <div class="latest-orders-container">
            <div class="order-list-box">
                <div class="latest-order-title">
                    Latest Orders
                </div>
                <?php
                if ($LatestOrder->num_rows > 0) {
                    while ($row = $LatestOrder->fetch_assoc()) {
                        $OrderID =$row['ID'];
                        $FirstName = $row['FirstName'];
                        $Email = $row['Email'];
                        $TotalDue=number_format($row['TotalDue']);
                        $TotalDue = "Rs. " . $TotalDue;
                        $OrderStatus = $row['OrderStatus'];
                        $Date = $row['OrderDate'];
                        $timestamp = strtotime($Date);
                        $formattedDate = date('Y-m-d', $timestamp);
                ?>
                        <div class="order-info">
                            <a href='Admin/Order Detail Page.php?OrderID=<?php echo $OrderID; ?>' target='_blank'>
                            <div class="order-number-box">
                                <?php echo  "#" . $OrderID; ?>
                            </div>
                            <div class="customer-name-box">
                                <?php echo $FirstName; ?>
                            </div>
                            <div class="customer-email">
                                <?php echo $Email; ?>
                            </div>
                            <div class="total-price">
                                <?php echo $TotalDue; ?>
                            </div>
                            <?php
                             if ($OrderStatus == 'Review') {
                            echo "<div class='order-status review'>
                            $OrderStatus
                            </div>";
                            }
                            else if ($OrderStatus == 'Complete') {
                                echo "<div class='order-status complete'>
                            $OrderStatus
                            </div>";
                            } else if ($OrderStatus == 'Pending') {
                                echo "<div class='order-status pending'>
                            $OrderStatus
                            </div>";
                            } else if ($OrderStatus == 'Shipped') {
                                echo "<div class='order-status shipped'>
                            $OrderStatus
                            </div>";
                            } else if ($OrderStatus == 'Cancelled' || $OrderStatus == 'Rejected') {
                                echo "<div class='order-status failed'>
                            $OrderStatus
                            </div>";
                            }
                            ?>
                            <div class="order-date">
                                <?php echo $formattedDate; ?>
                            </div>
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
                </div>
            </div>
        </div>
        </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Dashboard.js"></script>

</html>