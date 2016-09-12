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
$query=mysqli_query($conn,"update friends set status=1 where friend2='$f2' and friend1='$f1'");
//set buttons accordingly
if(!$query)
{
	echo "<button class='btn btn-danger' id='buttonid' onclick=\"change(3,'$f2','$f1')\">Accept</button>";
	echo "&nbsp&nbsp<button class='btn btn-danger' id='buttonid' onclick=\"change(4,'$f2','$f1')\">Reject</button>";
}
else
{
	echo "You are now friends with $fname[fname]!<br><hr>";
	echo "<button class='btn btn-primary' id='buttonid' onclick=\"change(5,'f1','$f2')\">Unfriend</button>";
}
?>