<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
include $base_url . 'Assets/PHP/Admin/Transaction Record Config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Customer Transaction Record</title>
</head>

<body>
  <?php
  if ($UserInfoQueryRun->num_rows > 0) {
  ?>
    <div class="container mx-auto px-4 md:px-6 py-8 md:mt-[3.5rem] mt-[2rem]">
      <div>
        <div class="flex justify-center align-center md:flex-row flex-col gap-8 mb-10">
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-auto md:w-1/2" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
              <h3 class="whitespace-nowrap text-2xl leading-none tracking-tight text-[#00ADEF] font-bold">
                Customer Details
              </h3>
            </div>
            <div class="px-6 pt-2 pb-6 grid gap-[1.7rem]">
              <div class="flex items-center gap-4">
                <span class="relative flex shrink-0 overflow-hidden rounded-full w-16 h-16 border">
                  <img class="aspect-square h-full w-full" alt="<?php echo $Name; ?>" src="<?php echo $UserPic; ?>" />
                </span>
                <div class="grid gap-1">
                  <div class="font-semibold capitalize"><?php echo $Name; ?></div>
                  <div class="text-sm text-gray-500 capitalize"><?php echo $Email; ?></div>
                  <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $MobileNumber; ?></div>
                  <div class="text-sm text-gray-500"><?php echo $UserAddress; ?></div>
                </div>
              </div>
              <div class="grid gap-2">
                <div class="flex items-center gap-2">
                  <i class='bx bx-wallet text-xl'></i>
                  <div>
                    <div class="font-medium">DSN Points</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $DSNPoint; ?> points</div>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <i class='bx bx-calendar text-xl'></i>
                  <div>
                    <div class="font-medium">Account Creation</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $FormattedDate; ?></div>
                  </div>
                </div>
                <div class="flex items-center gap-2">
                  <i class='bx bx-calendar text-xl'></i>
                  <div>
                    <div class="font-medium">Date Of Birth</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $DateOfBirth; ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-auto md:w-1/2" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
              <h3 class="whitespace-nowrap text-2xl leading-none tracking-tight text-[#00ADEF] font-bold">
                Billing Information
              </h3>
            </div>
            <div class="px-6 pt-2 pb-6 grid gap-4">
            <div class="flex items-center gap-2">
                 <i class='bx bx-credit-card-front text-xl'></i>
                  <div>
                    <div class="font-medium">Lifetime Purchase</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo "Rs. ". $LifetimePurchase.".00"; ?></div>
                </div>
                </div>
              <div class="grid gap-2">
                <div class="font-medium">Name</div>
                <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $BillingName; ?></div>
              </div>
              <div class="grid gap-2">
                <div class="font-medium">Phone Number</div>
                <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $BillingPhone; ?></div>
              </div>
              <div class="grid gap-2">
                <div class="font-medium">Shipping Address</div>
                <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo trim($BillingCity) . ", " . trim($BillingAddress); ?>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="grid gap-8">
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
            <div class="flex flex-col space-y-1.5 p-6">
              <h3 class="whitespace-nowrap text-2xl leading-none tracking-tight text-[#00ADEF] font-bold">
                Purchase History
              </h3>
            </div>
            <div class="p-6">
              <div class="flex gap-4 flex-wrap md:justify-start justify-center">
                <?php
                if ($PurchaseHistoryQueryRun->num_rows > 0) {
                  while ($Row = $PurchaseHistoryQueryRun->fetch_assoc()) {
                    $product_title = $Row['Product Title'];
                    include $base_url . "Assets/PHP/Configuration/TItle Length Count.php";
                    $ProductPrice = $Row['Total Due'];
                    $Thumbnail = $Row['Product Meta Value'];
                    $Orderstatus = $Row['Order Status'];
                    $PaymentMethod = $Row['Payment Method'];
                    $PaymentScreenshot = $Row['Payment Screenshot'];
                    $Orderdate = $Row['Order Date'];
                    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $Orderdate);
                    $formattedDate = $dateTime->format('j M, Y');
                ?>
                    <div class="border rounded-md px-2 pt-4 pb-2 flex justify-evenly">
                      <div class="grid gap-4">
                        <div class="relative group">
                          <img src="<?php echo $Thumbnail; ?>" width="200px" height="200px" class="aspect-square object-cover rounded-lg border border-gray-200" />
                          <div class="grid gap-1">
                            <div class="font-medium w-[200px] mt-2"><?php echo $limited_title; ?></div>
                            <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo "Rs. " . $ProductPrice . ".00"; ?></div>
                            <?php
                            if ($Orderstatus == 'Review') {
                              echo "<span class='review text-[#eab308]'>
                                    $Orderstatus
                              </span>";
                            } elseif ($Orderstatus == 'Pending') {
                              echo "<span class='progress text-[#f59e0b]'>
                                    $Orderstatus
                              </span>";
                            } elseif ($Orderstatus == 'Shipped') {
                              echo "<span class='progress-Shipped text-[#3b82f6]'>
                                     $Orderstatus
                                  </span>";
                            } elseif ($Orderstatus == 'Complete') {
                              echo "<span class='progress-complete text-[#22c55e]'>
                                       $Orderstatus
                                   </span>";
                            } elseif ($Orderstatus == 'Cancelled' || $Orderstatus == 'Rejected') {
                              echo "<span class='progress-failed text-[#ef4444]'>
                                    $Orderstatus
                                    </span>";
                            } else {
                              echo "<span>
                                  $Orderstatus
                              </span>";
                            }
                            ?>
                          </div>
                        </div>
                        <div>
                          <div class="text-sm text-gray-500 dark:text-gray-400"><?php echo $PaymentMethod; ?></div>
                          <div class="text-sm text-gray-500 dark:text-gray-400">Purchased on <?php echo $formattedDate; ?></div>
                        </div>
                        <?php
                        if ($PaymentMethod == 'eSewa') {
                          echo "<a href='Account/UserAccount/Payment Receipts/$PaymentScreenshot' class='w-[100%] text-center grid place-items-center h-10 block border rounded-lg border-[#00ADEF] text-[#FF007F] hover:bg-[#00ADEF] hover:text-white duration-300' target='_blank'>View Screenshot</a>";
                        }
                        ?>
                      </div>
                    </div>

                <?php
                  }
                } else {
                  echo "No purchases have been made.";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <?php
  } else {
    echo '<div class="flex flex-col items-center justify-center min-h-[100dvh] px-4 py-12 text-center">
      <div class="max-w-md space-y-4">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="mx-auto h-12 w-12 text-red-500"
        >
          <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path>
          <path d="M12 9v4"></path>
          <path d="M12 17h.01"></path>
        </svg>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-50">User Not Found</h1>
        <p class="text-gray-500 dark:text-gray-400">The user your ae looking for does not exist or has been removed.</p>
        <a href="#"></a>
      </div>
    </div>';
  }
  ?>
</body>

</html>