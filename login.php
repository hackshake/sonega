<?php
include ('connect.php');
include ('include.php');
	$uname=$_POST['uname'];
	$upass=$_POST['upass'];
	$login=mysqli_query($conn,"select * from login where uname='$uname' and password='$upass'");
	if(!$login)
		die(mysqli_error($conn));
	if(mysqli_num_rows($login))
	{
		$active=mysqli_fetch_array($login,MYSQLI_ASSOC);
		if($active['active']==1)
		{
			session_start();
			$_SESSION['id']=$uname;
			header("location:gamehome.php");
		}
		else
		{
			echo '<script type="text/javascript">alert(\'Account has not yet been activated!\');history.go(-1);</script>';
		}	
	}
	else
	{
		echo '<script type="text/javascript">alert(\'Incorrect username or password\');history.go(-1);</script>';
	}
?>