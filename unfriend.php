<?php
include 'include.php';
include 'connect.php';
include 'include_session.php';
$conn=mysqli_connect("localhost","root","","game");
if(!$conn)
	die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
	die(mysqli_error($conn));
$f1=$_REQUEST['f1'];
$f2=$_REQUEST['f2'];
$fname_q=mysqli_query($conn,"select fname from info where uname='$f1'");
$fname=mysqli_fetch_array($fname_q,MYSQLI_ASSOC);
$query=mysqli_query($conn,"delete from friends where friend1='$f1' and friend2='$f2'");
if(!$query)
{
	$query2=mysqli_query($conn,"delete from friends where friend2='$f1' and friend1='$f2'");
	if(!$query2)
	{
		echo "You are now friends with $fname[fname]!<br><hr>";
		echo "<button class='btn btn-primary' id='buttonid' onclick=\"change(5,'f1','$f2')\">Unfriend</button>";die();
	}	
}
echo "<button class='btn btn-info' id='buttonid' onclick=change(1,$f1,$f2)>Send Friend Request</button><br>";