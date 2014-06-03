<?php
session_start();
set_time_limit(0);
unset($_SESSION['upload_token']);
header("Location: http://db2gd.hol.es/index.php");	


?>