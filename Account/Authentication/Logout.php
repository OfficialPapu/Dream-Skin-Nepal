<?php 
// session_name('LoginSession');
session_name('URLSession');
session_start();
session_unset();
session_destroy();

setcookie('Logged_In', '', time() - 3600, "/");
setcookie('user_id', '', time() - 3600, "/");

header("Location: /");
exit();
?>
