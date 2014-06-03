<?php

session_start();
set_time_limit(0);
ob_start();
$_SESSION['action'] = 'copy';


include 'index3.php';
ob_flush();
include 'index2.php';
ob_flush();
unset($_SESSION['action']);
ob_end_flush();
?>