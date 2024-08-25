<?php
@session_name('URLSession');
@session_start();
$base_url = $_SESSION['URLSession']['Base Path'];
include_once $base_url . 'Assets/Components/Navbar.php';
include_once $base_url . 'Assets/PHP/Account Configuration/My Account Config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="Assets/CSS/My Account.css">
</head>
<body>
    <div class="account-container-data">
        <div class="left-nav-bar hide-item-small-screen">
            <?php
            include_once $base_url . 'Assets/Components/Left Navbar.php';
            ?>
        </div>
        <?php
        if($RunQuery->num_rows > 0){
        ?>
        <div class="right-account-data">
            <div class="my-account-data">
                <div class="account-data">
                    <form action="#" method="POST">
                        <div class="user-image-data">
                            <label for="file-input">
                                <input type="file" id="file-input" accept="image/jpeg, image/png, image/gif">
                                <?php
                                if($UserPic==''){
                                  echo'<img src="Account/UserAccount/User Images/Default User.png" id="preview-img" alt="Image Not Found">';
                                }else{
                                  echo"<img src='Account/UserAccount/User Images/$UserPic' id='preview-img' alt='Image Not Found'>";
                                }
                                ?>
                            </label>
                        </div>
                        <div class="account-holder-name">
                            <?php echo $user_first_name."&nbsp".$user_last_name;?>
                        </div>
    
                        <div class="user-details">
    
                            <div class="data">
                                <div class="full-name user-data-title">
                                    <p class="profile-title">Full Name</p>
                                    <div class="full-name-box">
                                        <input type="text" value="<?php echo ucfirst($user_first_name); ?>" id="firstname" placeholder="First Name" required>
                                        <input type="text" value="<?php echo ucfirst($user_last_name); ?>" id="lastname" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="mobile-number user-data-title">
                                    <p class="profile-title">Mobile Number</p>
                                    <input type="text" value="<?php echo $Mobile ?>" name="mobile" readonly class="acc-mobile">
                                </div>
                                <div class="Address user-data-title">
                                    <p class="profile-title">Address</p>
                                    <input type="text" value="<?php echo $Address ?>" id="address" required>
                                </div>
                                <div class="gender-select user-data-title">
                                    <p class="profile-title">Gender</p>
                                        <select id="gender" class="select-list">
                                            <option>
                                            <?php
                                                if ($Gender == '') {
                                                    echo "Select Gender";
                                                } else {
                                                    echo $Gender;
                                                }
                                                ?>
                                            </option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                            <option value="Others">Others</option>
                                        </select>
                                </div>
                                <div class="dob user-data-title">
                                    <p class="profile-title">Date Of Birth</p>
                                    <input type="date" value="<?php echo $DOB ?>" id="DOB" required>
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" value="Save Changes" id="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="Assets/JS/My Account.js"></script>
</html>
