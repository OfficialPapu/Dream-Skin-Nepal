<?php
$session_lifetime = 60 * 60 * 24 * 365 * 10; 
session_set_cookie_params($session_lifetime);
session_name('URLSession');
session_start();
$_SESSION['URLSession']['Base Path'] = $_SERVER['DOCUMENT_ROOT'] . "/Dream Skin Nepal/";
$session_expire = time() + $session_lifetime;
setcookie(session_name(), session_id(), $session_expire, "/");
session_write_close();
?>
