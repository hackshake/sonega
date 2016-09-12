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
function show(x,y)
{
	document.getElementById("formDiv").style.visibility = "visible";
	document.getElementById("req_uname").value=x;
	document.getElementById("req_msg").placeholder="Enter your message for "+y;
}
function hide()
{
	document.getElementById("formDiv").style.visibility = "hidden";
}
function filter(x,y,a)
{
	x="game"+x;z="";var c=0;
	//if(document.getElementById(y).checked)
	//	z='true';
	for(var i=1;i<=y;i++)
	{
		var id="game"+i;
		if(document.getElementById(id).checked)
		{
			c++;
			{
				if(i!=0)
					z=z+"&q"+i+"=game"+document.getElementById(id).value;
				else
					z=z+"q"+i+"=game"+document.getElementById(id).value;
			}
		}
	}
	var c1=0;
	for(i=2;i<=a+1;i++)
	{
		var hid="hostel"+i;
		if(document.getElementById(hid).checked)
		{
			c1++;
			z=z+"&h"+i+"="+document.getElementById(hid).value;
		}
	}
	z="c="+c+"&c1="+c1+z;
	if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("filter_results").innerHTML=xmlhttp.responseText;
  }}
  xmlhttp.open("GET","filter.php?"+z,true);
  xmlhttp.send();
}
function getMyModal(x)
{
	if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("reqModal").innerHTML=xmlhttp.responseText;
  }}
  xmlhttp.open("GET","getReqModal.php?q="+x,true);
  xmlhttp.send();
}
</script>
<style type="text/css">
#form1_head:hover,#form2_head:hover,#notifications_head:hover
{
	cursor: pointer;
	text-decoration: underline;
}
a:hover
{
	text-decoration: none;
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
echo "<center><p style='text-align:right;margin-top:-35px'><a href='gamehome.php'><span class=\"glyphicon glyphicon-user\"></span>&nbsp$infoarray[fname]&nbsp$infoarray[lname]</a></p>
<img src='images\\$infoarray[image]' id='home_dp'>";
if($infoarray['image']=="default.jpg")
echo "<p><br>You may provide your profile picture so that others can recognize you easily</p>";
echo "<p style='padding-top:40px;font-size:20px'>Welcome $infoarray[fname]&nbsp$infoarray[lname]</p>";
if($infoarray['alias']=="")
{
	echo "<p>Please provide an alias by which others can refer you</p>";
}
else
{
	echo "<p>\"$infoarray[alias]\"</p>";
}
#getting the notifications for recieved requests
$notifications=mysqli_query($conn,"select * from friends where friend2='$uname' and notification=0 and status=0");
$notifications2=mysqli_query($conn,"select * from friends where friend1='$uname' and notification=0 and status=1");
$game_notifications=mysqli_query($conn,"select * from requests where reciever='$uname' and status=0 and notification=0");
$game_notifications2=mysqli_query($conn,"select * from requests where sender='$uname' and status=1 and notification=0");
$not=mysqli_num_rows($notifications)+mysqli_num_rows($notifications2)+mysqli_num_rows($game_notifications)+mysqli_num_rows($game_notifications2);
echo "<b data-toggle='collapse' data-target='#notifications' id='notifications_head'>Notifications-$not</b><br><br>";
#echo "<script type='text/javascript'>document.getElementById('notif_button').innerHTML=\"$not\"</script>";
echo "<div id='notifications' class='collapse'>";
while ($notifications_array=mysqli_fetch_array($notifications,MYSQLI_ASSOC)) {
	$notification_sender=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array[friend1]'");
	$notification_sender_array=mysqli_fetch_array($notification_sender,MYSQLI_ASSOC);
	echo "<p><a href='view_profiles.php?search_id=$notification_sender_array[uname]'><img src='images\\$notification_sender_array[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array[fname]&nbsp$notification_sender_array[lname]</a> sent you a friend request</p><hr><br>";
}

#getting the notifications for accepted requests status=1 and notification=0
while ($notifications_array2=mysqli_fetch_array($notifications2,MYSQLI_ASSOC)) {
	$notification_sender2=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array2[friend2]'");
	$notification_sender_array2=mysqli_fetch_array($notification_sender2,MYSQLI_ASSOC);
	echo "<p><a href='view_profiles.php?search_id=$notification_sender_array2[uname]'><img src='images\\$notification_sender_array2[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array2[fname]&nbsp$notification_sender_array2[lname]</a> accepted your friend request</p><hr><br>";
	$set_notification=mysqli_query($conn,"update friends set notification=1 where friend1='$uname'");
}

#getting the game requests
while($notifications_array3=mysqli_fetch_array($game_notifications,MYSQLI_ASSOC))
{
	$notification_sender3=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array3[sender]'");
	$notification_sender_array3=mysqli_fetch_array($notification_sender3,MYSQLI_ASSOC);
	echo "<p><a href='view_profiles.php?search_id=$notification_sender_array3[uname]'><img src='images\\$notification_sender_array3[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array3[fname]&nbsp$notification_sender_array3[lname]</a> sent you a game request</p><br>";
	$game_query=mysqli_query($conn,"select * from games where id=$notifications_array3[game]");
	$game_array=mysqli_fetch_array($game_query,MYSQLI_ASSOC);
	echo "<p>Game:&nbsp$game_array[name]<br>Date:&nbsp$notifications_array3[date]<br>$notifications_array3[message]";
	//$set_notification=mysqli_query($conn,"update requests set notification=1 where reqid=$notifications_array3[reqid]");
	echo "<div id='req_button'><button class='btn btn-primary' onclick='accept_req(\"$notifications_array3[reqid]\")'>Accept</button></div><hr>";
}
while($notifications_array4=mysqli_fetch_array($game_notifications2,MYSQLI_ASSOC))
{
	$notification_sender4=mysqli_query($conn,"select uname,fname,lname,image from info where uname='$notifications_array4[reciever]'");
	$notification_sender_array4=mysqli_fetch_array($notification_sender4,MYSQLI_ASSOC);
	echo "<p><a href='view_profiles.php?search_id=$notification_sender_array4[uname]'><img src='images\\$notification_sender_array4[image]' id='thumbnail'>&nbsp&nbsp$notification_sender_array4[fname]&nbsp$notification_sender_array4[lname]</a> accepted your game request</p><br>";
	$set_notification=mysqli_query($conn,"update requests set notification=1 where reqid=$notifications_array4[reqid]");
}
echo "</div>";
echo "</center>";
?>
<div id='filters' class='panel panel-default'>
<b data-toggle='collapse' data-target='#form1' id='form1_head'>Filter by games</span></b><br><br>
<form id='form1' class='collapse'>
<?php $games=mysqli_query($conn,'select * from games');
$num_games=mysqli_num_rows($games);
$hostels=mysqli_query($conn,'select * from hostels');
$num_hostel=mysqli_num_rows($hostels);
while ($row=mysqli_fetch_array($games,MYSQLI_ASSOC)) {
	echo "<div class=\"checkbox\" style='padding-top:10px;'><label><input type=checkbox name='check_games[]' value='$row[id]' onclick='filter(this.value,$num_games,$num_hostel)' id='game$row[id]'>$row[name]</label></div>";
}?>
<button type='reset' class='btn btn-default' onclick='filter("","")'>Clear Filters</button>
</form>
<hr width='100%'>
<b data-toggle='collapse' data-target='#form2' id='form2_head'>Filter by hostels</b><br><br>
<form id='form2' class='collapse'>
<?php 
while ($row=mysqli_fetch_array($hostels,MYSQLI_ASSOC)) {
	echo "<div class=\"checkbox\" style='padding-top:10px;'><label><input type=checkbox name='check_hostels[]' value='$row[id]' onclick='filter(this.value,$num_games,$num_hostel)' id='hostel$row[id]'>$row[name]</label></div>";
}?>
<button type='reset' class='btn btn-default'>Clear Filters</button>
</form>

</div>
<div id='filter_results' class='panel panel-success'>
<div class='panel-heading'><h3>People You Maybe Interested In</h3></div>
<?php
$q=mysqli_query($conn,"select parameter from interests where userid='$uname'");
$arr=mysqli_fetch_array($q,MYSQLI_ASSOC);
$param=$arr['parameter'];
$len=strlen($param);
for($i=0;$i<$len;$i++)
{
	$check[$i]=$param[$i];
}
$flag=0;echo "<table style='width:80%;margin-top:20px'>";
$q=mysqli_query($conn,"select userid,parameter from interests");
while($arr=mysqli_fetch_array($q,MYSQLI_ASSOC))
{
	if($arr['userid']=='$uname')
		continue;
	$match=0;
	for($i=0;$i<$len;$i++)
	{
		$pattern='/'.$check[$i].'+/';
		if(preg_match($pattern, $arr['parameter']))
		$match++;
	}
	if($match>2)
	{
		if($arr['userid']!=$uname)
		{
			$info_query=mysqli_query($conn,"select * from info where uname='$arr[userid]'");
    		$info_array=mysqli_fetch_array($info_query,MYSQLI_ASSOC);
    		if($info_array['block']!='')
			{$hostel_query=mysqli_query($conn,"select name from hostels where id=$info_array[block]");
			    $hostel_array=mysqli_fetch_array($hostel_query,MYSQLI_ASSOC);}
        	if($flag%4==0)
            	echo "<tr>";
         	echo" <td style='margin-top:10px'><center><a href='view_profiles.php?search_id=$arr[userid]'><img src=\"images\\$info_array[image]\" style='width:100px;height:100px;border-radius:5px'><h5>$info_array[fname]&nbsp$info_array[lname]</h5></a>";
            if($info_array['room']!=0)
            	echo"$hostel_array[name]&nbsp$info_array[room]";
          	echo "<br><button class='btn btn-info btn-sm' onclick='show(\"$info_array[uname]\",\"$info_array[fname]\")'>Game Request</button></center></td>";
          	if($flag%4==3)
            	echo "</tr>";
          	$flag=$flag+1;
		}
	}
	else if($match>1)
	{
		if($arr['userid']!=$uname)
		{
			$info_query=mysqli_query($conn,"select * from info where uname='$arr[userid]'");
    		$info_array=mysqli_fetch_array($info_query,MYSQLI_ASSOC);
    		if($info_array['block']!='')
			{$hostel_query=mysqli_query($conn,"select name from hostels where id=$info_array[block]");
			    $hostel_array=mysqli_fetch_array($hostel_query,MYSQLI_ASSOC);}
        	if($flag%4==0)
            	echo "<tr>";
         	echo" <td style='margin-top:10px'><center><a href='view_profiles.php?search_id=$arr[userid]'><img src=\"images\\$info_array[image]\" style='width:100px;height:100px;border-radius:5px'><h5>$info_array[fname]&nbsp$info_array[lname]</h5></a>";
            if($info_array['room']!=0)
            	echo"$hostel_array[name]&nbsp$info_array[room]";
          	echo "<br><button class='btn btn-info btn-sm' onclick='show(\"$info_array[uname]\",\"$info_array[fname]\")'>Game Request</button></center></td>";
          	if($flag%4==3)
            	echo "</tr>";
          	$flag=$flag+1;
		}
	}
	else if($match>=0)
	{
		if($arr['userid']!=$uname)
		{
			$info_query=mysqli_query($conn,"select * from info where uname='$arr[userid]'");
    		$info_array=mysqli_fetch_array($info_query,MYSQLI_ASSOC);
    		if($info_array['block']==$infoarray['block'] && $info_array['block']!='')
			{$hostel_query=mysqli_query($conn,"select name from hostels where id=$info_array[block]");
			    $hostel_array=mysqli_fetch_array($hostel_query,MYSQLI_ASSOC);
        	if($flag%4==0)
            	echo "<tr>";
         	echo" <td style='margin-top:10px'><center><a href='view_profiles.php?search_id=$arr[userid]'><img src=\"images\\$info_array[image]\" style='width:100px;height:100px;border-radius:5px'><h5>$info_array[fname]&nbsp$info_array[lname]</h5></a>";
            if($info_array['room']!=0)
            	echo"$hostel_array[name]&nbsp$info_array[room]";
          	echo "<br><button class='btn btn-info btn-sm' onclick='show(\"$info_array[uname]\",\"$info_array[fname]\")'>Game Request</button></center></td>";
          	if($flag%4==3)
            	echo "</tr>";
          	$flag=$flag+1;}
		}
	}
}
echo "</table>";
?>
</div>
<div id='formDiv' style="visibility:hidden">
<h3>Send Game Request <span class='glyphicon glyphicon-remove' onclick='hide()'></span></h3>
<form method='post' id='req_form' action='sendReq.php'>
<input type='hidden' class='form-control' placeholder='Enter username' style='width:400px;visibility:hidden' id='req_uname' name='req_uname' required><br>
<select name='game' class='form-control'  style='width:400px' required>
<?php $games=mysqli_query($conn,'select * from games');
$num_games=mysqli_num_rows($games);
while ($row=mysqli_fetch_array($games,MYSQLI_ASSOC)) {
	echo "<option value='$row[id]'>$row[name]</option>";
}?>
</select><br>
<input type='date' class='form-control' style='width:400px' name='date' required min="<?php echo date("Y-m-d");?>"><br>
<textarea class='form-control' placeholder='Enter your message here' rows='8' cols='10' style='width:400px;resize:none' id='req_msg' name='req_msg' required></textarea><br>
<button class='btn btn-primary' type='submit'>Send Request</button>
</form>
</div>
</body>
</html>