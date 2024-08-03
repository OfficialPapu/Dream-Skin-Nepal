<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
include_once $base_url . 'Assets/PHP/Database/Database Connection.php';
$Query = "SELECT * FROM `product_category` ORDER BY `Product Category Attribute` ASC";
$MySqli = mysqli_query($conn, $Query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Category Dashboard</title>
</head>

<body class="bg-[#E5F0F9]">
  <div class="container mx-auto py-8 px-5 mt-[4.5rem]">
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-[#ff007f]">Product Category</h1>
      <div class="flex items-center space-x-4 mt-4 md:mt-0">
        <a class="bg-white inline-flex h-9 items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground border border-[#00adef] text-[#ff007f] hover:bg-[#00adef] hover:text-white duration-300" href="Admin/New Category.php">
          Add Category
        </a>
        <div class="relative flex-1 max-w-md">
          <i class='bx bx-search-alt-2 absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground text-[1.2em]'></i>
          <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none pl-8 focus:ring-1" placeholder="Search categories..." type="search">
        </div>
      </div>
    </div>

    <div class="grid gap-6">
      <?php
      $Categories = [];
      while ($Row = $MySqli->fetch_assoc()) {
        $ProductCategoryID = $Row['Product Category ID'];
        $ProductCategoryName = $Row['Product Category Name'];
        $ProductCategoryAttribute = $Row['Product Category Attribute'];

        if (!isset($Categories[$ProductCategoryName])) {
          $Categories[$ProductCategoryName] = [];
        }
        $Categories[$ProductCategoryName][$ProductCategoryAttribute][] = $ProductCategoryID;
      }
      ?>

      <?php foreach ($Categories as $CategoryName => $Attributes) { ?>
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm px-6 py-4 bg-white">
          <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold"><?php echo $CategoryName; ?></h2>
          </div>
          <div class="mt-4 flex gap-1 md:justify-start r items-center flex-wrap">
            <?php foreach ($Attributes as $CategoryAttribute => $CategoryID) { ?>
              <div class="">
                <a href="Admin/Manage Category.php?CategoryID=<?php echo $CategoryID[0]; ?>"><p class="inline-flex items-center justify-center text-sm font-medium focus-visible:outline-none focus-visible:ring-2 hover:ring-1 border border-input h-9 rounded-md px-3 duration-300 text-gray-500 hover:text-gray-900"><?php echo $CategoryAttribute; ?></p></a>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php }?>
    </div>
  </div>

</body>

</html>