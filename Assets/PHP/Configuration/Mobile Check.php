<?php
if (!function_exists('isMobileDevice')) {
    function isMobileDevice()
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return (bool) preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $userAgent);
    }
}

$is_mobile = isMobileDevice();
?>