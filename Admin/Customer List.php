<?php
@session_name('URLSession');
@session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/";
$base_url = $_SESSION['URLSession']['Base Path'];
include $base_url . 'Assets/Components/Admin Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="Assets/CSS/Customer List.css">
</head>

<body>
  <div class="user-container">
    <div class="all-user-heading">
      All User
    </div>
    <div class="user-box">
      <div class="user-data-box">
        <div class="search-and-add-user">
          <div class="search-box-user">
            <input type="text" placeholder="Search here.." class="search">
          </div>
          <div class="add-new-user">
            <a href="#">
              <button class="addnewcustbtn">
                <i class="fa-solid fa-plus"></i>
                <p>Add new</p>
              </button>
            </a>
          </div>
        </div>

        <div class="user-info-box">
          <table>
            <tr class="table-title">
              <th>ID</th>
              <th>User</th>
              <th class="hide-in-mobile">Email</th>
              <th>Action</th>
            </tr>
          </table>
        </div>
      </div>

      <!-- <div class="pagination-container">
        <ul class="pagination">
          <li class="page-item left"><a class="page-link" href="#"><i class='bx bx-left-arrow'></i></a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item active"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item right"><a class="page-link" href="#"><i class='bx bx-right-arrow'></i></a></li>
        </ul>
      </div> -->


    </div>
  </div>
</body>
<script src="Assets/JS/Customer List.js"></script>

</html>