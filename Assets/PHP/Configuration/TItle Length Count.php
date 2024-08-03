<?php
if ($is_mobile) {
$limited_title = (strlen($product_title) > 35) ? substr($product_title, 0, 35) . "...." : $product_title;
} else {
$limited_title = (strlen($product_title) > 50) ? substr($product_title, 0, 50) . "...." : $product_title;
}
?>