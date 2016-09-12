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
#dp_label:hover,#alias_label:hover,#location_label:hover,#games_label:hover
{
	cursor: pointer;
	text-decoration: underline;
}
#buttonid:hover
{
	cursor: pointer;
}
</style>
<script>
function add(x,y)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("my_interests").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","add_game.php?id="+x+"&game="+y,true);
  xmlhttp.send();
}
function del(x,y)
{
	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("my_interests").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","remove_game.php?id="+x+"&game="+y,true);
  xmlhttp.send();
}
</script>
</head>
<body style='padding-top:100px'>
<div id='includedContent'></div>
<?php
$info=mysqli_query($conn,"select * from info where uname='$uname'");
$infoarray=mysqli_fetch_array($info,MYSQLI_ASSOC);
echo "<p style='text-align:right;margin-top:-35px'><a href='gamehome.php'><span class=\"glyphicon glyphicon-user\"></span>&nbsp$infoarray[fname]&nbsp$infoarray[lname]</a></p>";
echo "<center><img src='images\\$infoarray[image]' id='home_dp'>";
if($infoarray['image']=="default.jpg")
echo "<p><br>You may provide your profile picture so that others can recognize you easily</p>";
?>
<br><br><b id='dp_label' data-target='#dp_form' data-toggle='collapse'>Update Profile Picture</b>
<form method='post' action='update_dp.php' enctype='multipart/form-data' id='dp_form' class='collapse'>
<br><input type='file' name='img'>
<br><input type='submit' class='btn btn-primary' value='Update Profile Picture'>
</form><hr>
<br><br><b id='alias_label' data-target='#alias_form' data-toggle='collapse'>Provide an alias</b>
<form method='post' action='update_alias.php' id='alias_form' class='collapse'>
<br><input type='text' placeholder='Give your alias here' name='alias' class='form-control' style='width:240px' required>
<br><input type='submit' value='Update' class='btn btn-primary'>
</form>
<hr>
<br><br><b id='location_label' data-target='#location_form' data-toggle='collapse'>Provide your hostel details</b>
<form method='post' action='update_location.php' id='location_form' class='collapse'>
<br><select name='block' class='form-control' style='width:240px' required>
<?php
$hostel=mysqli_query($conn,"select * from hostels");
while ($hostel_array=mysqli_fetch_array($hostel,MYSQLI_ASSOC)) {
	echo "<option value='$hostel_array[id]' class='form-control'>$hostel_array[name]</option>";
}
?>
</select><br>
<input type='number' name='room' placeholder='Room Number' class='form-control' style='width:240px' required><br>
<input type='submit' value='Update Hostel Info' class='btn btn-primary'>
</form><hr>
<br><br><b id='games_label' data-target='#games_form' data-toggle='collapse'>Provide games you are interested in</b>
<div id='games_form' class='collapse'>
<br>
<?php
echo "<div id='my_interests'>";
$interests=mysqli_query($conn,"select * from interests where userid='$uname'");
$interests_array=mysqli_fetch_array($interests,MYSQLI_NUM);
$games=mysqli_query($conn,"select * from games");
echo "<table>";
while($games_array=mysqli_fetch_array($games,MYSQLI_ASSOC))
{
	$ii=$games_array['id'];
	if($interests_array[$ii+1]==0)
		{
			echo "<tr style='padding-top:10px'><td>$games_array[name]</td>";
	echo"<td><span class='glyphicon glyphicon-thumbs-up'  style='color:green' id='buttonid' onclick=\"add('$uname','$games_array[id]')\"></span></td></tr>";
		}
}
echo "</table>";
$c=0;//this will track the profile completion status
$interests=mysqli_query($conn,"select * from interests where userid='$uname'");
$interests_array=mysqli_fetch_array($interests,MYSQLI_NUM);
$games=mysqli_query($conn,"select * from games");
while($games_array=mysqli_fetch_array($games,MYSQLI_ASSOC))
{
	$ii=$games_array['id'];
	if($interests_array[$ii+1]==1)
	{
		if($c==0)
			echo "<br><br>You have already added the following games to your interests!<br><br>";
		echo "$games_array[name]";
		echo"<span class='glyphicon glyphicon-remove' style='color:red' id='buttonid' onclick=\"del('$uname','$games_array[id]')\"></span><br>";
		$c=1;
	}
}
echo "</div>";
?>
</div>
<hr><br>
<?php
if($infoarray['image']!="default.jpg")
$c++;
if($infoarray['alias']!="")
	$c++;
if($infoarray['block']!="")
	$c++;
if($infoarray['room']!=0)
	$c++;
$c=$c*20;
echo "<br><br><br><b>Your Profile</b><br>";
echo "<br><div class=\"progress\" style=\"width:240px\">
  <div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\"
  aria-valuenow=\"$c\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:$c%\">
    $c%
  </div>
</div>";
if($c==0)
echo "<p style='color:red'>You are yet to provide any details for your profile!</p>";
?>