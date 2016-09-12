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
$date=date("Y-m-d");
$query=mysqli_query($conn,"insert into friends values('$f1','$f2',0,0,'$date')");
if(!$query)
	$response="<button class='btn btn-info' id='buttonid' onclick=change(1,'$f1','$f2')>Send Friend Request</button><br><p style='color=red'>Unable to send request</p>";
else
	$response="<button class='btn btn-warning' id='buttonid' onclick=change(2,'$f1','$f2')>Cancel Request</button>";
echo "$response";	
?>