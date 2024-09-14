<?php
@session_name('URLSession');
@session_start();
if (isset($_SESSION['RedirectUrl'])) {
    echo $_SESSION['RedirectUrl'];
    unset($_SESSION['RedirectUrl']);
} else {
    echo ''; 
}
?>