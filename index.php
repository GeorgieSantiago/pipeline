<?php
//Set Headers
switch ($_SERVER['HTTP_ORIGIN']) {
    case ' http://192.168.3.107:3000':
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
    break;
}
require('env.php');
require("resource/index.php");
new pipeline;
?>
