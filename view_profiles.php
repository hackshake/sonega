<?php
//include ('connect.php');
require 'connect.php';
include ('include.php');
include 'include_session.php';
$conn=mysqli_connect("localhost","root","","game");
if(!$conn)
	die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
	die(mysqli_error($conn));
$uname=$_SESSION['id'];
$name=$_REQUEST['search_id'];
?>
<html>
<head>
	<title>Online Game Scheduler-View Profiles | <?php echo "$infoarray[fname]&nbsp$infoarray[lname]";?></title>
<script> 
    $(function(){
      $("#includedContent").load("navbar.html"); 
    });
</script>
<style type="text/css">
#dp_label:hover,#alias_label:hover,#location_label:hover
{
	cursor: pointer;
	text-decoration: underline;
}
</style>
<script>
function change(x,f1,f2)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("buttonarea").innerHTML=xmlhttp.responseText;
    }
  }
	switch(x)
	{
		case 1:xmlhttp.open("GET","addfriend.php?f1="+f1+"&f2="+f2,true);
		break;
		case 2:xmlhttp.open("GET","cancelreq.php?f1="+f1+"&f2="+f2,true);
		break;
		case 3:xmlhttp.open("GET","acceptrequest.php?f1="+f2+"&f2="+f1,true);
		break;
		case 4:xmlhttp.open("GET","rejectrequest.php?f1="+f2+"&f2="+f1,true);
		break;
		case 5:xmlhttp.open("GET","unfriend.php?f1="+f1+"&f2="+f2,true);
		break;
	}
	xmlhttp.send();
}
</script>
</head>
<body style='padding-top:100px'>
<div id='includedContent'></div>
<?php
$info_query=mysqli_query($conn,"select fname,lname from info where uname='$uname'");
$infoarray=mysqli_fetch_array($info_query,MYSQLI_ASSOC);
echo "<p style='text-align:right;margin-top:-35px'><a href='gamehome.php'><span class=\"glyphicon glyphicon-user\"></span>&nbsp$infoarray[fname]&nbsp$infoarray[lname]</a></p>";
$info=mysqli_query($conn,"select * from info where uname='$name'");
if(!$info)
	die(mysqli_error($conn));
$infoarray=mysqli_fetch_array($info,MYSQLI_ASSOC);
if(!$infoarray)
	die(mysqli_error($conn));
echo "<center><img src='images\\$infoarray[image]' id='home_dp'>";
echo "<p style='padding-top:40px;font-size:20px'>$infoarray[fname]&nbsp$infoarray[lname]</p>";
echo "<p><b>$infoarray[alias]</b></p><hr>";
$fquery=mysqli_query($conn,"select * from friends where friend1='$uname' and friend2='$infoarray[uname]'");
$fquery2=mysqli_query($conn,"select * from friends where friend2='$uname' and friend1='$infoarray[uname]'");
$frow=mysqli_fetch_array($fquery,MYSQLI_ASSOC);
$frow2=mysqli_fetch_array($fquery2,MYSQLI_ASSOC);
if(mysqli_num_rows($fquery))
{
	if($frow['status']==1)
	{
		$fbtncls="btn btn-primary";
		$fbtntxt="Unfriend";
		$fbtnid=5;
	}
	else
	{
		$fbtncls="btn btn-warning";
		$fbtntxt="Cancel Request";
		$fbtnid=2;
	}
}
else if(mysqli_num_rows($fquery2))
{
	if($frow2['status']==0)
	{
		$fbtncls="btn btn-success";
		$fbtntxt="Accept";
		$fbtnid=3;
	}
	else
	{
		$fbtncls="btn btn-primary";
		$fbtntxt="Unfriend";
		$fbtnid=5;
	}
}
else
{
	$fbtncls="btn btn-info";
	$fbtntxt="Send Friend Request";
	$fbtnid=1;
}
echo "<div id='buttonarea'>";
if($uname!=$infoarray['uname'])
echo "<button class='$fbtncls' id='buttonid' onclick=\"change($fbtnid,'$uname','$infoarray[uname]')\">$fbtntxt</button>";
if($fbtnid==3)
echo "&nbsp&nbsp<button class='btn btn-danger' id='buttonid' onclick=\"change(4,'$uname','$infoarray[uname]')\">Reject</button>";
if($fbtnid==5)
{
	echo "<br><br>You are already friends with $infoarray[fname]!<br>";
	if($infoarray['block']!='')
	{	
		$loc_info=mysqli_query($conn,"select name from hostels where id='$infoarray[block]'");
		$loc_array=mysqli_fetch_array($loc_info,MYSQLI_ASSOC);
		echo "<br>$loc_array[name]&nbsp$infoarray[room]";
	}
	$interests=mysqli_query($conn,"select * from interests where userid='$name'");
	$interests_array=mysqli_fetch_array($interests,MYSQLI_NUM);
	$games=mysqli_query($conn,"select * from games");
	$num=mysqli_num_rows($games);
	echo "<br>Interested in<br>";
	for($i=2;$i<=$num+1;$i++)
	{
		if($interests_array[$i]==1)
		{
			$j=$i-1;
			$game=mysqli_query($conn,"select name from games where id='$j'");
			$game_array=mysqli_fetch_array($game,MYSQLI_ASSOC);
			echo "$game_array[name]&nbsp";
		}
	}
}
echo "</div>";
?>