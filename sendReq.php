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
$req_uname=$_POST['req_uname'];
$date=$_POST['date'];
$game=$_POST['game'];
$msg=$_POST['req_msg'];
$query=mysqli_query($conn,"insert into requests(sender,reciever,game,message,date) values('$uname','$req_uname',$game,'$msg','$date')");
if(!$query)
	die(mysqli_error($conn));
else
	echo '<script type="text/javascript">alert("Request has been sent successfully!");
		history.go(-1);</script>';
?>