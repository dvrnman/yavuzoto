<?php 
ob_start();
require_once  "../baglan.php";
session_start();
session_destroy();
header("Location:index.php");
exit();



?>