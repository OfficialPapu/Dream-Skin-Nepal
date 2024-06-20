<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
include $base_url . 'Assets/PHP/Admin/Product List Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.css">
    <link rel="stylesheet" href="Assets/CSS/Butterup/butterup.min.css">
    <link rel="stylesheet" href="Assets/CSS/Product List.css">
    <title>Product List</title>
</head>

<body>
    <div class="product-container">
        <div class="product-container-and-heading-wrapper">
            <div class="product-container-box">
                <div class="product-management-heading">
                    <i class="fa-solid fa-mug-hot"></i>
                    Tip search by Product ID: Each product is provided with a unique ID, which you can rely on to find
                    the
                    exact product you need.
                </div>
                <div class="upper-part">
                    <div class="item-number-search-box">
                        <div class="search-product-box">
                            <input type="text" class="search" placeholder="Search here...">
                        </div>
                    </div>
                    <div class="add-new-product-box">
                        <a href="Admin/New Product.php">
                            <button class="addnewbtn"><i class="fa-solid fa-plus"></i>
                                <p class="addnewproduct-text">Add New</p>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table>
                        <tr class="table-title">
                            <th>ID</th>
                            <th class='product-title-and-img'>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>

                        <tbody class="table-body">
                         <?php                
                        if ($ListProduct->num_rows > 0) {
                            while ($Row = $ListProduct->fetch_assoc()) {
                                $ProductID=$Row['ProductID'];
                                $CustomID=$Row['CustomID'];
                                $ProductTitle=$Row['Product Title'];
                                $ProductImage=$Row['ProductImage'];
                                $ProductPrice=$Row['Product Price'];
                                $ProductQuantity=$Row['Product Quantity'];
                                
                             ?>
                             <tr class="product-box">
                            <td class="custom-product-id">#<?php echo $CustomID;?></td>
                            <td class="product-image-title">
                                <img src="<?php echo $ProductImage;?>" alt="<?php echo $ProductTitle;?>">
                                <p class="product-title"><?php echo $ProductTitle;?></p>
                            </td>
                            <td>Rs. <?php echo $ProductPrice;?>.00</td>
                            <td><?php echo $ProductQuantity;?></td>
                            <td>
                                <div class="action-data">
                                    <div class="edit-box">
                                        <a href="Admin/Edit Product.php?ProductID=<?php echo $ProductID;?>">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                             <?php   
                            }
                        }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/Butterup/butterup.js"></script>
<script src="Assets/JS/Butterup/butterup.min.js"></script>
<script src="Assets/JS/Product List.js"></script>

</html>