<?php
include('include.php');
include ('connect.php');
include('include_session.php');
$conn=mysqli_connect("localhost","root","","game");
if(!$conn)
	die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
	die(mysqli_error($conn));

?>
<html>
<head>
	<title>Online Game Scheduler | Home</title>
<script> 
    $(function(){
      $("#includedContent").load("navbar.html"); 
    });
</script>
<style type="text/css">
a:hover
{
	text-decoration: none;
}
#friends_div
{
	margin-left: 40px;
}
</style>
</head>
<body style='padding-top:100px'>
<div id='includedContent'></div>
<?php
$uname=$_SESSION['id'];
$info=mysqli_query($conn,"select * from info where uname='$uname'");
if(!$info)
	die(mysqli_error($conn));
$infoarray=mysqli_fetch_array($info,MYSQLI_ASSOC);
if(!$infoarray)
	die(mysqli_error($conn));
echo "<p style='text-align:right;margin-top:-35px'><a href='gamehome.php'><span class=\"glyphicon glyphicon-user\"></span>&nbsp$infoarray[fname]&nbsp$infoarray[lname]</a></p>";
$friends1=mysqli_query($conn,"select friend2 from friends where friend1='$uname' and status=1");
$friends2=mysqli_query($conn,"select friend1 from friends where friend2='$uname' and status=1");
$num=mysqli_num_rows($friends1)+mysqli_num_rows($friends2);
echo "<center><h4>Friends-$num</h4></center>";
echo "<div id='friends_div'>";
while($friends1_array=mysqli_fetch_array($friends1,MYSQLI_ASSOC))
{
	echo "<table style='width:20%'>";
	$friend_info=mysqli_query($conn,"select * from info where uname='$friends1_array[friend2]'");
	$friend_info_array=mysqli_fetch_array($friend_info,MYSQLI_ASSOC);
	echo "<tr><td rowspan='2'><img src='images\\$friend_info_array[image]' id='thumbnail_big'></td><td><a href='view_profiles.php?search_id=$friend_info_array[uname]'>$friend_info_array[fname]&nbsp$friend_info_array[lname]</a><br><br>";
	if($friend_info_array['room']!=0)
	{
		$hostel_query=mysqli_query($conn,"select * from hostels where id='$friend_info_array[block]'");
		$hostel_array=mysqli_fetch_array($hostel_query,MYSQLI_ASSOC);
		echo "$hostel_array[name]&nbsp-&nbsp$friend_info_array[room]";
	}
	//echo "";
	echo "</td></tr><hr></table>";
}
while($friends2_array=mysqli_fetch_array($friends2,MYSQLI_ASSOC))
{
	echo "<table style='width:20%'>";
	$friend_info=mysqli_query($conn,"select * from info where uname='$friends2_array[friend1]'");
	$friend_info_array=mysqli_fetch_array($friend_info,MYSQLI_ASSOC);
	echo "<tr><td rowspan='2'><img src='images\\$friend_info_array[image]' id='thumbnail_big'></td><td><a href='view_profiles.php?search_id=$friend_info_array[uname]'>$friend_info_array[fname]&nbsp$friend_info_array[lname]</a><br><br>";
	if($friend_info_array['room']!=0)
	{
		$hostel_query=mysqli_query($conn,"select * from hostels where id='$friend_info_array[block]'");
		$hostel_array=mysqli_fetch_array($hostel_query,MYSQLI_ASSOC);
		echo "$hostel_array[name]&nbsp-&nbsp$friend_info_array[room]";
	}
	//echo "";
	echo "</td></tr><hr></table>";
}
echo "</div>";
