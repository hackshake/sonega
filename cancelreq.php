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
$query=mysqli_query($conn,"delete from friends where friend1='$f1'");
if(!$query)
{
		echo "<button class='btn btn-info' id='buttonid' onclick=\"change(2,'f1','$f2')\">Cancel Request</button>";die();	
}
echo "<button class='btn btn-info' id='buttonid' onclick=change(1,'$f1','$f2')>Send Friend Request</button><br>";