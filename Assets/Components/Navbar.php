<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Configuration/Navbar Configuration.php';
?>

<head>
    <?php
    include_once  $base_url . 'Assets/PHP/URL/Base URL.php';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="Assets/Product/Media/Images/Logo/Dream skin nepal.png" type="image/x-icon">
    <link rel="stylesheet" href="Assets/CSS/Navbar.css">
</head>

<div class="overlay-box"></div>
<header>
    <nav class="nav">
        <div class="header-container">
            <div class="menu-and-close-icon hide-item">
                <i class='bx bx-menu menu-icon' id="menu-btn"></i>
                <i class='bx bx-x close-icons' id="close-btn"></i>
            </div>
            <div class="authentic-text-box hide-item">
                <p class="authentic-text-content">#<span class="pink-color">Genuinely</span><span class="blue-color bold-style-text">Authentic</span></p>
            </div>
            <div class="logo">
                <a href="/"> <img src="Assets/Product//Media//Images/Logo/dream skin main logo.jpg" alt="Logo" class="Dreamskin-logo"></a>
            </div>
        </div>
        <div class="bottom-top-navbar">
        <div class="dropdown-menu-container">
            <div class="custom-dropdown-menu">
                <ul class="dropdown-menu-ul">
                    <li class="dropdown-align">
                        <div class="toggle-name"><a href="/" class="color">Home</a> </div>
                    </li>
                    <li class="dropdown-align">
                        <div class="toggle-name"><span class="bold-style">Skin Care</span>
                            <!--<span class="plus-minus-box">-->
                            <!--    <i class='bx bx-plus plus hide-item'></i>-->
                            <!--    <i class='bx bx-minus minus hide-item'></i>-->
                            <!--    <i class='bx bx-chevron-down arrow hide-item-in-mobile'></i>-->
                            <!--</span>-->
                        </div>
                        <ul class="sub-category-dorpdown-menu ">
                            <?php
                            while ($row = $Query->fetch_assoc()) {
                                $SkinCare = $row['Product Category Attribute'];
                                $SlugUrl = $row['Slug Url'];
                                echo "<li><a href='$SkinCareUrl/$SlugUrl' class='sub-category-dorpdown-link'>$SkinCare</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                <li class="dropdown-align">
                        <div class="toggle-name"> <span class="bold-style">Skin Type</span>
                            <!--<span class="plus-minus-box">-->
                            <!--    <i class='bx bx-plus plus hide-item'></i>-->
                            <!--    <i class='bx bx-minus minus hide-item'></i>-->
                            <!--    <i class='bx bx-chevron-down arrow hide-item-in-mobile'></i>-->
                            <!--</span>-->
                        </div>
                        <ul class="sub-category-dorpdown-menu low-height">
                            <?php
                            while ($row = $Query3->fetch_assoc()) {
                                $SkinType = $row['Product Category Attribute'];
                                $SlugUrl = $row['Slug Url'];
                                echo "<li><a href='$SkinTypeUrl/$SlugUrl' class='sub-category-dorpdown-link'>$SkinType</a></li>";
                            }
                            ?>
                        </ul>
                    </li>

                    <li class="dropdown-align">
                        <div class="toggle-name"> <span class="bold-style">Make Up</span>
                            <!--<span class="plus-minus-box">-->
                            <!--    <i class='bx bx-plus plus hide-item'></i>-->
                            <!--    <i class='bx bx-minus minus hide-item'></i>-->
                            <!--    <i class='bx bx-chevron-down arrow hide-item-in-mobile'></i>-->
                            <!--</span>-->
                        </div>
                        <ul class="sub-category-dorpdown-menu second-dropdown">
                            <?php
                            while ($row = $Query2->fetch_assoc()) {
                                $Makeup = $row['Product Category Attribute'];
                                $SlugUrl = $row['Slug Url'];
                                echo "<li><a href='$MakeupUrl/$SlugUrl' class='sub-category-dorpdown-link'>$Makeup</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    
                    <li class="dropdown-align">
                       <div class="toggle-name"><a href="<?php echo $BodyAndHairCareUrl; ?>/Hair-Care" class="color"><span class="bold-style">Hair Care</span></a></div>
                    </li>
                    
                    <li class="dropdown-align">
                       <div class="toggle-name"><a href="<?php echo $BodyAndHairCareUrl; ?>/Body-Care" class="color"><span class="bold-style">Body Care</span></a></div>
                    </li>
                    
                    <li class="dropdown-align">
                       <div class="toggle-name"><a href="<?php echo $BabyCareUrl; ?>/Baby-Care" class="color"><span class="bold-style">Baby Care</span></a></div>
                    </li>
                    <li class="dropdown-align">
                        <a href='Category/BrandList.php' class="toggle-name">
                            <div><span class="color">Brands</span></div>
                        </a>
                    </li>
                </ul>
                <div class="social-links-nav-bar hide-item">
                    <a href="https://www.instagram.com/dream.skin.nepal"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="bottom-menu">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class='bx bx-home-alt nav-icon display-none hide-item'></i>
                        <span class="nav-name hide-item">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Assets/PHP/Database/SearchProduct.php" class="nav-link">
                        <i class='bx bx-search-alt-2 nav-icon'></i>
                        <span class="nav-name hide-item">Search</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Account/UserAccount/Cart.php" class="nav-link">
                        <i class='bx bx-cart nav-icon number-icon-position'><sup class="quantity-number cart-number"></sup></i>
                        <span class="nav-name align display-none hide-item">Cart</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Account/UserAccount/Wishlist.php" class="nav-link">
                        <i class='bx bx-heart nav-icon number-icon-position'>
                            <sup class="quantity-number wishlist-number"></sup></i>
                        <span class="nav-name display-none hide-item"> Wishlist</span>
                    </a>
                </li>
                <li class="nav-item account-show">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class='bx bx-user nav-icon' id='account-btn-icon'></i>
                        <span class="nav-name display-none hide-item">Account</span>
                    </a>
                    <?php
                    if (isset($_SESSION['Logged In'])) {
                        echo "<div class='account-container-nav-bar hide-item-in-mobile'>
                                <div class='account-title'>
                                    My Account
                                </div>
                                <div class='account-data-nav-bar'>
                                    <div class='user-img'>";
                        if ($UserPic == '') {
                            echo '<img src="Account/UserAccount/User Images/Default User.png" id="preview-img">';
                        } else {
                            echo "<img src='Account/UserAccount/User Images/$UserPic' id='preview-img'>";
                        }
                        echo " </div>
                                    <div class='mange-btn-box-and-name-email'>
                                        <div class='name-and-email'>
                                            <div class='user-name'>
                                                $FirstName
                                                $LastName
                                            </div>
                                            <div class='user-email'>
                                                $Email
                                            </div>
                                        </div>
                                        <div class='manage-account'>
                                            <a href='Account/UserAccount/My Account.php'><button class='manage-acc-btn'>Manage Profile</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class='user-account-detail'>
                                    <ul>
                                        <li><a href='Account/UserAccount/My Account.php'><i class='bx bx-home-alt'></i>My Profile</a></li>
                                        <li><a href='Account/UserAccount/Wishlist.php'><i class='bx bx-heart'></i>My Wishlist</a></li>
                                        <li><a href='Account/UserAccount/Cart.php'><i class='bx bx-cart'></i>My Cart</a></li>
                                        <li><a href='Account/Authentication/Logout.php'><i class='bx bx-exit'></i>Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                            </li>";
                    }
                    ?>
            </ul>
        </div>
                </div>
    </nav>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="Assets/JS/Navbar.js"></script>