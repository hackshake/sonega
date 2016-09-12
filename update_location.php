<?php
include 'include.php';
include 'connect.php';
include 'include_session.php';
$conn=mysqli_connect("localhost","root","","game");
if(!$conn)
	die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
	die(mysqli_error($conn));
$uname=$_SESSION['id'];
$block=$_POST['block'];
$room=$_POST['room'];
if($room<0 || $room>1199)
{
	echo '<script type="text/javascript">alert("Unable to update information. Invalid room number");
	history.go(-1);</script>';die();
}
$query=mysqli_query($conn,"update info set block='$block', room=$room where uname='$uname'");
if(!$query)
	{
		echo '<script type="text/javascript">alert("Unable to update information. Please try again later!");
		history.go(-1);</script>';
	}
else
	{
		echo '<script type="text/javascript">alert("Information has been updated successfully!");
		window.location=\'myprofile.php\';</script>';
	}
?>