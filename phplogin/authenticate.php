<?php
session_start();
// Change this to your connection info.
$host = '172.20.128.61';
$user = 'brage';
$pass = 'drlig7i0';
$db = 'Login_side';
// Try and connect using the info above.
$con = mysqli_connect($host, $user, $pass, $db);
