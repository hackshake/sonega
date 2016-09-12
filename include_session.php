<?php
$conn=mysql_connect("localhost","root","");
if(!$conn)
	echo "Network Error<br>Please try again later";
else
{
	session_start();
	if(!$_SESSION['id'] || $_SESSION['id']=="")
	{
		mysqli_select_db($conn,"game");
		header("location:home2.php");
		exit;
	}

}
?>