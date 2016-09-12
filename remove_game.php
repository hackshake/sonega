<?php
include 'include.php';
include 'connect.php';
include 'include_session.php';
$conn=mysqli_connect("localhost","root","","game");
if(!$conn)
	die(mysqli_error($conn));
if(!mysqli_select_db($conn,"game"))
	die(mysqli_error($conn));
$uname=$_REQUEST['id'];
$game=$_REQUEST['game'];
$game_row="game".$game;
$query=mysqli_query($conn,"update interests set game$game=0 where userid='$uname'");
//$parameter_new=$param_array['parameter'].$param_append;
$interests=mysqli_query($conn,"select * from interests where userid='$uname'");
$interests_array=mysqli_fetch_array($interests,MYSQLI_NUM);
$games=mysqli_query($conn,"select * from games");
echo "<table>";
while($games_array=mysqli_fetch_array($games,MYSQLI_ASSOC))
{
	$ii=$games_array['id'];
	if($interests_array[$ii+1]==0)
		{
			echo "<tr><td>$games_array[name]</td>";
	echo"<td><span class='glyphicon glyphicon-thumbs-up' style='color:green' id='buttonid' onclick=\"add('$uname','$games_array[id]')\"></span></td></tr>";
		}
}
echo "</table>";
	$c=0;//this will track the profile completion status
$interests=mysqli_query($conn,"select * from interests where userid='$uname'");
$interests_array=mysqli_fetch_array($interests,MYSQLI_NUM);
$games=mysqli_query($conn,"select * from games");
$parameter_new="";
$check['a']=0;$check['b']=0;$check['c']=0;$check['d']=0;
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
		switch ($games_array['id']) {
			case 1:
			case 4:$param_append='a';
			break;
			case 5:
			case 6:
			case 7:
			case 8:$param_append='b';
			break;
			case 2:
			case 3:
			case 11:$param_append='c';
			break;
			case 9:
			case 10:$param_append='d';
			break;
		}
		if($check[$param_append]==0)
		{
			$parameter_new=$parameter_new.$param_append;
			$check[$param_append]=1;
		}
	}
}	
$update_param=mysqli_query($conn,"update interests set parameter='$parameter_new' where userid='$uname'");
?>