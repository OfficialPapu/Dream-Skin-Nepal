<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
include $base_url . 'Assets/PHP/Admin/Orders Management Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="Assets/CSS/Order Management.css">
    <title>Order Management</title>
</head>

<body>
    <div class="product-container">
        <div class="product-container-and-heading-wrapper">
            <div class="order-management-title">
                Order Management
            </div>
            <div class="product-container-box">
                <div class="product-management-heading">
                    <i class="fa-solid fa-mug-hot"></i>
                    Tip search by Product ID: Each product is provided with a unique ID, which you can rely on to find
                    the
                    exact product you need.
                </div>
                <div class="upper-part">
                    <div class="item-number-search-box">
                        <div class="showing-items-box">
                            <p>Showing</p>
                            <p id="CountOrder"><?php echo $OrderCount; ?></p>
                            <p>orders</p>
                        </div>
                        <div class="search-product-box">
                            <input type="text" class="search" placeholder="Search here...">
                        </div>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table>
                        <tr class="table-title">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        if ($OrderList->num_rows > 0) {
                            while ($row = $OrderList->fetch_assoc()) {
                                $OrderID = $row['OrderID'];
                                $Image = $row['ImagePath'];
                                $TotalDue = "Rs. " . $row['TotalDue'] . ".00";
                                $PaymentMethod = $row['PaymentMethod'];
                                $Name=$row['Name'];
                                if ($PaymentMethod == 'Cash On Delivery') {
                                    $PaymentMethod = 'COD';
                                }
                                $OrderStatus = $row['OrderStatus'];

                        ?>  
                                <tr class="product-box">
                                    <td class='user-product-info'>
                                        <div class="product-title-data">
                                            <div class="product-img">
                                                <?php
                                                echo "#$OrderID <img src='$Image'>";
                                                ?>
                                            </div>
                                            <div class='user-name'>
                                            <?php
                                                echo $Name;
                                            ?>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-price-data">
                                            <?php echo $TotalDue; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $PaymentMethod; ?>
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>
                                        <div class="action-data">
                                            <?php
                                            echo"<a href='Admin/Order Detail Page.php?OrderID=$OrderID'>";
                                            ?>
                                                <div class="edit-box">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Order Management.js"></script>
</html>