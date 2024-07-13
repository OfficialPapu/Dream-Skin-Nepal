<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Admin/Admin Navbar Config.php';
?>

<head>
    <?php
    include_once  $base_url . 'Assets/PHP/URL/Base URL.php';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="Assets/Product/Media/Images/Logo/Dream skin nepal.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="Assets/CSS/Admin Navbar.css">
</head>

<body>
    <div class="overlay"></div>
    <div class="admin-side-bar-container">
        <div class="side-bar-box">
            <div class="top-nav-bar">
                <a href='Admin'>
                    <div class="dreamskin-icon">
                        <img src="Assets/Product/Media/Images/Logo/Dream skin nepal.png" alt="">
                    </div>
                </a>
                <div class="menu-icon">
                    <i class='bx bx-menu-alt-right' id="Menu-btn"></i>
                </div>
            </div>
            <div class="main-side-bar">
                <div class="first-side-bar-box">
                    <ul class="side-bar">
                        <li><a href="Admin/index.php">
                                <i class='bx bxs-grid-alt'></i>
                                <p>Dashboard</p>
                            </a></li>
                        <li class="subitem-menu">
                            <div class="product-content">
                                <div class="product-title">
                                    <i class='bx bx-layer'></i>
                                    <p>Product</p>
                                </div>
                                <div class="product-icon">
                                    <i class='bx bx-chevron-down'></i>
                                </div>
                            </div>
                            <ul class="submenu-ul">
                                <div class="submenu">
                                    <li>
                                        <a href="Admin/New Product.php">
                                            <div class="new-product">New Product</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Admin/Product List.php">
                                            <div class="list-product">Product List</div>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                        <li class="subitem-menu">
                            <div class="product-content">
                                <div class="product-title">
                                <i class='bx bx-category'></i>
                                    <p>Category</p>
                                </div>
                                <div class="product-icon">
                                    <i class='bx bx-chevron-down'></i>
                                </div>
                            </div>
                            <ul class="submenu-ul">
                                <div class="submenu">
                                    <li><a href="Admin/New Category.php">
                                            <p>New Category</p>
                                        </a></li>
                                    <li>
                                        <a href="Admin/Category Dashboard.php">
                                            <div class="list-product">Category Dashboard</div>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>


                        <li><a href="Admin/Order Management.php">
                                <i class='bx bx-package'></i>
                                <p>Order Management</p>
                            </a></li>

                        <li class="subitem-menu">
                            <div class="product-content">
                                <div class="product-title">
                                    <i class='bx bxs-coupon'></i>
                                    <p>Coupon</p>
                                </div>
                                <div class="product-icon">
                                    <i class='bx bx-chevron-down'></i>
                                </div>
                            </div>
                            <ul class="submenu-ul">
                                <div class="submenu">
                                    <li>
                                        <a href="Admin/Available Coupon.php">
                                            <div class="list-product">Available Coupon</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="Admin/Create New Coupon.php">
                                            <div class="new-product">Create new Coupon</div>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li><a href="Admin/Customer List.php">
                                <i class='bx bxs-user'></i>
                                <p>Customers</p>
                            </a></li>
                        <li><a href="Account/Authentication/Admin Logout.php">
                                <i class='bx bx-log-in'></i>
                                <p>Logout</p>
                            </a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Admin Navbar.js"></script>