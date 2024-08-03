<?php
session_name('URLSession');
session_start();
session_unset();
session_destroy();
header("location:../../Admin");

?>