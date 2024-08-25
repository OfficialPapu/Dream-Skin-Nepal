<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/PHP/Account Configuration/My Orders Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="Assets/CSS/My Orders.css">
</head>

<body>
  <div class="flex">
    <div class="left-nav-bar hide-item-small-screen">
      <?php
      include_once $base_url . 'Assets/Components/Left Navbar.php';
      ?>
    </div>
    <div class="order-data-container">
      <div class="container px-0 md:px-6 py-8">
        <h1 class="text-2xl font-bold mb-6 text-[#00ADEF] px-6 md:p-0">Order History</h1>
        <div class="grid gap-6">
          <div class="bg-white dark:bg-gray-950 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-[2%] md:p-6 p-2 md:w-auto w-100">
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $OrderID = $row['Order ID'];
                  $ProductTitle = $row['Product Title'];
                  $ProductPrice = $row['ProductPrice'];
                  $trackingnumber = $row['Tracking Number'];
                  $ShippingFee = $row['Shipping Fee'];
                  $orderdate = $row['Order Date'];
                  $dateTime = new DateTime($orderdate);
                  $formattedDate = $dateTime->format("j M, Y");
                  $orderstatus = $row['Order Status'];
                  $thumbnail_url = $row['ProductTmumbnail'];
              ?>
                  <div class="flex flex-col justify-between border border-gray-200 dark:border-gray-800 rounded-lg p-7 md:w-auto w-[96vw]">
                    <div class="flex justify-between items-start">
                      <span class="text-gray-500 dark:text-gray-400"><?php echo $formattedDate; ?></span>
                      <div class="flex flex-col items-end">
                        <span class="font-medium">#<?php echo $OrderID; ?></span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm">Tracking: <?php echo $trackingnumber; ?></span>
                      </div>
                    </div>
                    <div class="flex items-center gap-4 my-4">
                      <img src="<?php echo $thumbnail_url; ?>" alt="Product Image" width="64" height="64" style="aspect-ratio: 64 / 64; object-fit: cover;" class="rounded-md" />
                      <div class="w-[40%]">
                        <div class="md:text-xl text-xs font-bold font-small text-[#00ADEF]">Rs. <?php echo $ProductPrice; ?></div>
                        <div class="text-sm">
                          <?php
                          if ($orderstatus == 'Review') {
                            echo "<span class='review text-[#eab308]'>
                                    $orderstatus
                              </span>";
                          } elseif ($orderstatus == 'Pending') {
                            echo "<span class='progress text-[#f59e0b]'>
                                    $orderstatus
                              </span>";
                          } elseif ($orderstatus == 'Shipped') {
                            echo "<span class='progress-Shipped text-[#3b82f6]'>
                                     $orderstatus
                                  </span>";
                          } elseif ($orderstatus == 'Complete') {
                            echo "<span class='progress-complete text-[#22c55e]'>
                                       $orderstatus
                                   </span>";
                          } elseif ($orderstatus == 'Cancelled' || $orderstatus == 'Rejected') {
                            echo "<span class='progress-failed text-[#ef4444]'>
                                    $orderstatus
                                    </span>";
                          } else {
                            echo "<span>
                                  $orderstatus
                              </span>";
                          }
                          ?>
                        </div>
                      </div>
                      <div class="text-xs text-gray-500">
                        <?php echo $ProductTitle; ?>
                      </div>
                    </div>
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Shipping fee: Rs. <?php echo $ShippingFee; ?></span>
                  </div>
              <?php
                }
              }else {
            echo '<div class="flex flex-col items-center justify-center min-h-screen px-4 md:px-6 absolute left-1/2 top-1/2 translate-y-[-50%] translate-x-[-50%]">
            <svg data-id="6" xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 text-gray-500 dark:text-gray-400 mb-2"><circle cx="12" cy="12" r="10"></circle><path d="M16 16s-1.5-2-4-2-4 2-4 2"></path><line x1="9" x2="9.01" y1="9" y2="9"></line><line x1="15" x2="15.01" y1="9" y2="9"></line></svg>
              <div class="max-w-md text-center space-y-2">
                <h1 class="text-3xl font-bold">No orders yet</h1>
                <p class="text-gray-500 dark:text-gray-400 md:w-auto w-[80vw]">
                    Looks like you have not placed any orders. Start shopping to see your orders here.
                </p>
                <a data-id="7" class="inline-flex h-10 items-center justify-center rounded-md px-6 text-sm font-medium text-[#FF007F] transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:focus-visible:ring-gray-300 border border-[#00ADEF] hover:text-white hover:bg-[#00ADEF] duration-300" href="/"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 mr-2"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
          Start Shopping
        </a>
              </div>
            </div>';
            }
        ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>