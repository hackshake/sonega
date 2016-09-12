<?php
session_start();
unset($_SESSION['id']);
session_destroy();
echo '<script type="text/javascript">alert("You have logged out successfully");
window.location=\'home2.php\';</script>';
#header("location:regForm.php");
?>