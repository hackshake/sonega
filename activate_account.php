<?php
include 'include.php';
$conn=mysqli_connect("mysql8.000webhost.com","a5248758_gamedev","gamedb1","a5248758_game");
if(!$conn)
{
	echo "Unable to connect to database<br>Please try again later!";
}
else
{
	mysqli_select_db($conn,'a5248758_game');
if(isset($_REQUEST['id']))
{
	$activate=mysqli_query($conn,"update login set active=1 where hash='$_REQUEST[id]'");
	if($activate)
	{
		$login=mysqli_query($conn,"select uname from login where hash='$_REQUEST[id]'");
		$details=mysqli_fetch_array($login,MYSQLI_ASSOC);
		$uname=$details['uname'];
		session_start();
		$_SESSION['id']=$uname;
		header("location:gamehome.php");
	}
	else
	{
		header("location:home2.php");
	}
}
}
?>