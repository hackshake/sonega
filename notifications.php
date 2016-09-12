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
<script type="text/javascript">
function accept_req(x)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("req_button").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","accept_gamereq.php?id="+x,true);
  xmlhttp.send();
}
</script>
<style type="text/css">
a:hover
{
	text-decoration: none;
}
.notification_hover:hover
{
  background-color: #f0f0f0;
}
</style>
</head>
<body style='padding-top:100px'>
<div id='includedContent'></div>
<?php
$uname=$_SESSION['id'];
date_default_timezone_set("Asia/Kolkata");
$q=mysqli_query($conn,"select date from friends");
$arr=mysqli_fetch_array($q,MYSQLI_ASSOC);
$date=date('Y-m-d');
$date2=date_create($date);
$info_query=mysqli_query($conn,"select fname,lname from info where uname='$uname'");
$infoarray=mysqli_fetch_array($info_query,MYSQLI_ASSOC);
echo "<p style='text-align:right;margin-top:-35px'><a href='gamehome.php'><span class=\"glyphicon glyphicon-user\"></span>&nbsp$infoarray[fname]&nbsp$infoarray[lname]</a></p>";
//echo date('d-m-y');
?>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Friend Requests</a></li>
  <li><a data-toggle="tab" href="#menu1">Game Requests</a></li>
  <li><a data-toggle="tab" href="#menu2">Upcoming Games</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
   <?php
   echo "<hr>";
$notifications=mysqli_query($conn,"select * from friends where friend2='$uname' and status=0");
$notifications2=mysqli_query($conn,"select * from friends where friend1='$uname' and status=1");
while ($notifications_array=mysqli_fetch_array($notifications,MYSQLI_ASSOC)) {
	$date3=$notifications_array['date'];
	$date4=date_create($date3);
	$newdate=date_diff($date4,$date2);
	if($newdate->format("%R%a")<7)
{	$notification_sender=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array[friend1]'");
	$notification_sender_array=mysqli_fetch_array($notification_sender,MYSQLI_ASSOC);
  $notification_date=date($notifications_array['date']);
	echo "<div class='notification_hover'><a href='view_profiles.php?search_id=$notification_sender_array[uname]'><img src='images\\$notification_sender_array[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array[fname]&nbsp$notification_sender_array[lname]</a> sent you a  friend request<p style='font-size:12px;margin-left:50px'>$notification_date</p><hr></div>";}
}

#getting the notifications for accepted requests status=1 and notification=0
while ($notifications_array2=mysqli_fetch_array($notifications2,MYSQLI_ASSOC)) {
	$date3=$notifications_array['date'];
	$date4=date_create($date3);
	$newdate=date_diff($date4,$date2);
	if($newdate->format("%R%a")<7)
{	$notification_sender2=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array2[friend2]'");
	$notification_sender_array2=mysqli_fetch_array($notification_sender2,MYSQLI_ASSOC);
	echo "<div class='notification_hover'><a href='view_profiles.php?search_id=$notification_sender_array2[uname]'><img src='images\\$notification_sender_array2[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array2[fname]&nbsp$notification_sender_array2[lname]</a> accepted your friend request<p style='font-size:12px;margin-left:50px'>$notifications_array2[date]</p><hr></div>";}
}
   ?>
  </div>
  <div id="menu1" class="tab-pane fade">
    <?php
    echo "<hr>";
    $game_notifications=mysqli_query($conn,"select * from requests where reciever='$uname' and status=0");
$game_notifications2=mysqli_query($conn,"select * from requests where sender='$uname' and status=1");

    while($notifications_array3=mysqli_fetch_array($game_notifications,MYSQLI_ASSOC))
{
	if($notifications_array3['date']>$date)
	{$notification_sender3=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array3[sender]'");
		$notification_sender_array3=mysqli_fetch_array($notification_sender3,MYSQLI_ASSOC);
		echo "<p><a href='view_profiles.php?search_id=$notification_sender_array3[uname]'><img src='images\\$notification_sender_array3[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array3[fname]&nbsp$notification_sender_array3[lname]</a> sent you a game request</p><br>";
		$game_query=mysqli_query($conn,"select * from games where id=$notifications_array3[game]");
		$game_array=mysqli_fetch_array($game_query,MYSQLI_ASSOC);
		echo "<p>Game:&nbsp$game_array[name]<br>Date:&nbsp$notifications_array3[date]<br>$notifications_array3[message]";
		//$set_notification=mysqli_query($conn,"update requests set notification=1 where reqid=$notifications_array3[reqid]");
		echo "<div id='req_button'><button class='btn btn-primary' onclick='accept_req(\"$notifications_array3[reqid]\")'>Accept</button></div><hr>";}
}
while($notifications_array4=mysqli_fetch_array($game_notifications2,MYSQLI_ASSOC))
{
	if($notifications_array4['date']>$date)
	{$notification_sender4=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array4[reciever]'");
		$notification_sender_array4=mysqli_fetch_array($notification_sender4,MYSQLI_ASSOC);
		echo "<p><a href='view_profiles.php?search_id=$notification_sender_array4[uname]'><img src='images\\$notification_sender_array4[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array4[fname]&nbsp$notification_sender_array4[lname]</a> accepted your game request</p><hr><br>";
		//$set_notification=mysqli_query($conn,"update requests set notification=1 where reqid=$notifications_array4[reqid]");
	}
}
    ?>
  </div>
  <div id="menu2" class="tab-pane fade">
  <?php
  echo "<hr>";
  $upcoming=mysqli_query($conn,"select * from requests where sender='$uname' and status=1");
  while($upcoming_array=mysqli_fetch_array($upcoming,MYSQLI_ASSOC)){
  if($upcoming_array['date']>$date)
  {$opponent=mysqli_query($conn,"select * from info where uname='$upcoming_array[reciever]'");
    $opponent_array=mysqli_fetch_array($opponent,MYSQLI_ASSOC);
    $game=mysqli_query($conn,"select name from games where id='$upcoming_array[game]'");
    $game_array=mysqli_fetch_array($game,MYSQLI_ASSOC);
    echo "<a href='view_profiles.php?search_id=$opponent_array[uname]'><img src='images\\$opponent_array[image]' id='thumbnail'>&nbsp&nbsp$opponent_array[fname]&nbsp$opponent_array[lname]</a><br><p style='margin-left:50px'><span class='glyphicon glyphicon-message'></span>$upcoming_array[message]</p><p style='font-size:12px;margin-left:50px'>$game_array[name] on $upcoming_array[date]</p><hr>";}
	}
  $upcoming=mysqli_query($conn,"select * from requests where reciever='$uname' and status=1");
  while($upcoming_array=mysqli_fetch_array($upcoming,MYSQLI_ASSOC)){
  if($upcoming_array['date']>$date)
  {
  	$opponent=mysqli_query($conn,"select * from info where uname='$upcoming_array[sender]'");
    $opponent_array=mysqli_fetch_array($opponent,MYSQLI_ASSOC);
    $game=mysqli_query($conn,"select name from games where id='$upcoming_array[game]'");
    $game_array=mysqli_fetch_array($game,MYSQLI_ASSOC);
    echo "<a href='view_profiles.php?search_id=$opponent_array[uname]'><img src='images\\$opponent_array[image]' id='thumbnail'>&nbsp&nbsp$opponent_array[fname]&nbsp$opponent_array[lname]</a><p style='margin-left:50px'><span class='glyphicon glyphicon-mail'></span>$upcoming_array[message]</p><p style='font-size:12px;margin-left:50px'>$game_array[name] on $upcoming_array[date]</p><hr>";}

}
  ?>
  </div>
</div>