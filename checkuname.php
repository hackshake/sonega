<?php
include 'connect.php';
$uname=$_GET['q'];
$unames=mysqli_query($conn,"select uname from info where uname='$uname'");
if(mysqli_num_rows($unames))
echo "Sorry! This username has already been chosen";
else
echo "";
?>