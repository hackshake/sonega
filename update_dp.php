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
$filename=$_FILES['img']['name'];
if($filename=='')
{
	echo '<script type="text/javascript">alert("Please select an image to set as your profile picture");
		history.go(-1);</script>';
}
if(move_uploaded_file($_FILES['img']['tmp_name'], "images/".$filename))
{
	$uname=$_SESSION['id'];
	$q=mysqli_query($conn,"select * from info where uname='$uname'");
	$row=mysqli_fetch_array($q,MYSQLI_ASSOC);
	$result=mysqli_query($conn,"update info set image='$filename' where uname='$uname'");
	if(!$result)
	{	echo '<script type="text/javascript">alert("Unable to update the profile picture");
		window.location=\'myprofile.php\';</script>';
		#echo "$filename <br> $uname";
		#echo "<img src='images/".$filename."'width='300' height='300'	/>";
	}
	else
	{
		echo '<script type="text/javascript">alert("Profile picture updated successfully");
		window.location=\'myprofile.php\';</script>';
	}}
?>