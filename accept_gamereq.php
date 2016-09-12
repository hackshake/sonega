<?php
include 'include.php';
include 'connect.php';
include 'include_session.php';
$conn=mysqli_connect("localhost","root","","game");
if(!$conn)
	die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
	die(mysqli_error($conn));
$reqid=$_REQUEST['id'];
$query=mysqli_query($conn,"update requests set status=1 and notification=0 where reqid=$reqid");
if($query)
{
	echo "Request Accepted!";
}
else
{
	echo"<button class='btn btn-primary' onclick='accept_req(\"$reqid\")'>Accept</button>";
}
?>