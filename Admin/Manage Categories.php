<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
$Query = "SELECT * FROM `product_category`";
$MySqli = mysqli_query($conn, $Query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Manage Categories</title>
</head>
<body>
    <div class="container mx-auto py-8 px-5">
        <div class="flex flex-col md:flex-row items-center justify-between mb-6">
          <h1 class="text-2xl font-bold">Product Categories</h1>
          <div class="flex items-center space-x-4 mt-4 md:mt-0">
            <a class="inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground border border-[#00adef] text-[#ff007f] hover:bg-[#00adef] hover:text-white duration-300" href="Admin/Product List.php">
              Add New Category
            </a>
            <div class="relative flex-1 max-w-md">
              <i class='bx bx-search-alt-2 absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground text-[1.2em]'></i>
              <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none pl-8" placeholder="Search categories..." type="search">
            </div>
          </div>
        </div>

        <div class="grid gap-6">
          <?php
          $Count=0;
            while ($Row=$MySqli->fetch_assoc()) {
              $ProductCategoryID=$Row['Product Category ID'];
              $ProductCategoryName=$Row['Product Category Name'];
              $ProductCategoryAttribute	=$Row['Product Category Attribute'];
              if($ProductCategoryName == $Row['Product Category Name']){

              }else{
            ?>
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-6">
            <div class="flex items-center justify-between">
              <h2 class="text-2xl font-semibold"><?php echo $ProductCategoryName; ?></h2>
            </div>
            <div class="mt-4 grid gap-4">
              <div class="flex items-center justify-between">
                <p><?php echo $ProductCategoryAttribute; ?></p>
                <button class="inline-flex items-center justify-center text-sm font-medium focus-visible:outline-none focus-visible:ring-2 hover:ring-2 border border-input h-9 rounded-md px-3 duration-300">Edit</button>
              </div>
            </div>
          </div>
          <?php
              }
        }
        ?>
        </div>
      </div>
      
</body>

</html>