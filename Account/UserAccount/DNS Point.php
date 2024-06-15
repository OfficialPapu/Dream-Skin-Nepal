<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
if (isset($_SESSION['Logged In'])) {
  $user_id = $_SESSION['LoginSession']['user_id'];
}
$DnsPointQuery = "SELECT * FROM `user_table` WHERE `ID`='$user_id'";
$DnsPointRun = mysqli_query($conn, $DnsPointQuery);
$Row = $DnsPointRun->fetch_assoc();
$DnsPoint = $Row['DNS Point'];
if ($DnsPoint != '') {
  if (intval($DnsPoint) == $DnsPoint) {
    $DnsPoint = number_format($DnsPoint, 2, '.', '');
  }
} else {
  $DnsPoint = "0.00";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <title>DNS Points - Dream Skin Nepal</title>
  <style>
      .dns-container{
        display: flex;
      }
      .right-dns-data{
            width: calc(100vw - 300px);
      }
      @media (max-width:860px) {
        .hide-item-small-screen {
        display: none;
        }
        .dns-container{
       display:block;
      }
    .right-dns-data{
            width: 100vw;
      }
      }
  </style>
</head>

<body>
<div class="dns-container">
 <div class="left-nav-bar hide-item-small-screen">
<?php
include_once $base_url . 'Assets/Components/Left Navbar.php';
?>
</div>   
    <div class="right-dns-data">
  <div class="overlay-dns-container h-screen w-screen bg-[rgba(0,0,0,0.5)] fixed z-[150] top-0  left-0 hidden"></div>
  <div class="md:mt-[70px] mt-[17vh] flex justify-center">
    <div class="md:w-full md:max-w-md px-4 md:px-10 md:pt-4 md:pb-10 py-10 bg-white rounded-lg shadow-[0_0_10px_rgba(255,0,128,0.1)] dark:bg-gray-800">
      <div class="flex flex-col items-center">
        <img src="Assets/Product/Media/Images/Logo/dream skin main logo.jpg" alt="Dream Skin Nepal" class="h-20 md:h-32 object-contain" />
        <h1 class="text-xl md:text-2xl font-bold dns-heading mb-2 text-[#ff007f]">
          Total DNS Points
        </h1>
        <div class="text-3xl md:text-4xl font-bold text-primary dns-points text-[#00adef]"><?php echo $DnsPoint; ?></div>
        <div class="m-2 text-sm md:text-base text-gray-500 dark:text-gray-400">
          You have collected <?php echo $DnsPoint; ?> points so far.
        </div>
        <div class="mt-3 flex md:flex-row gap-4">
          <a class="inline-flex items-center justify-center px-4 py-2 border bg-[#FF007F] hover:bg-[#00ADEF] transition duration-300 text-white text-sm font-medium bg-primary rounded-md hover:bg-primary-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus-visible:ring-offset-gray-800" href="Account/UserAccount/My Orders.php" rel="ugc">
            <i class="fas fa-history mr-2"></i>
            View History
          </a>
          <div class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-[#FF007F] border border-[#00ADEF] border-primary rounded-md focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 dark:text-primary-500 dark:bg-gray-800 dark:border-primary-500 dark:focus-visible:ring-offset-gray-800 hover:bg-[#00ADEF] hover:text-white duration-300 cursor-pointer" id="Redeem">
            <i class="fas fa-gift mr-2"></i>
            Redeem Points
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="popup-box hidden">
    <div class="bg-white dark:bg-gray-950 rounded-lg shadow-[0_0_10px_rgba(255,0,128,0.1)] p-8 md:max-w-md w-[90vw] fixed top-[40%] md:top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[160]">
      <div class="flex flex-col items-center space-y-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-[#00adef]">
          <rect x="3" y="8" width="18" height="4" rx="1"></rect>
          <path d="M12 8v13"></path>
          <path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path>
          <path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5">
          </path>
        </svg>
        <h2 class="text-lg md:text-2xl font-bold">Collect Your Reward</h2>
        <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 text-center">
          Visit our shop to collect your reward points.
        </p>
        <div class="flex space-x-4 w-full">
          <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-xs md:text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background h-8 md:h-10 px-2 md:px-4 py-1 md:py-2 flex-1 text-[#FF007F] border border-[#00ADEF] hover:bg-[#00ADEF] hover:text-white duration-300 cursor-pointer" id="NoTnow">
            <i class="fas fa-times-circle mr-1"></i> Not Now
          </button>
          <a class="inline-flex h-8 md:h-10 items-center justify-center rounded-md bg-[#FF007F] px-2 md:px-4 text-xs md:text-sm font-medium text-gray-50 shadow focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300 flex-1 hover:bg-[#00ADEF] hover:text-white duration-300 cursor-pointer" href="https://maps.app.goo.gl/Bzu3VqcRC1oMMfZR6" target="_blank">
            <i class="fas fa-store mr-1"></i> Visit Shop
          </a>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $("#NoTnow").click(function(e) {
      e.preventDefault();
      $(".popup-box").css("display", "none");
      $(".overlay-dns-container").css("display", "none");
    });
    $('#Redeem').click(function(e) {
      e.preventDefault();
      $(".popup-box").css("display", "block");
      $(".overlay-dns-container").css("display", "block");
    });
  </script>
</body>

</html>