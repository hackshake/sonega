<?php
include 'connect.php';
{
	$uname=$_POST['uname'];
	$upass=$_POST['upass'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$dob=$_POST['dob'];
	$email=$_POST['email'];
	$hash=md5(rand(0,1000));
	$insertinfo=mysqli_query($conn,"insert into info(uname,fname,lname,dob,gmail) values('$uname','$fname','$lname','$dob','$email')");
	$insertlogin=mysqli_query($conn,"insert into login values('$uname','$upass',1)");
	$interest=mysqli_query($conn,"insert into interests(userid) values('$uname')");
	/*to = $email;
         $subject = "Online Game Scheduler-Email Validation";
         $message .="<h1>Online Game Scheduler</h1>";
         $message .= "<p>Hello $fname&nbsp$lname! Thank you for registering for Online Game Scheduler";
         $message .="Please copy the following link to your browser window in order to activate your account.";
         $message .="mytestmailer.netne.net/game_scheduler/gamehome.php?id=$hash";
         $header = "From:Online Game Scheduler \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
            echo "$retval";
         }

	if(!$insertinfo || !$insertlogin)
		header("location:activate_account.php");
	else
	{
		session_start();
		$_SESSION['id']=$uname;
		header("location:gamehome.php");
	}*/
	if(!$insertinfo || $insertlogin || $interests)
	{
		session_start();
		$_SESSION['id']=$uname;
		header("location:gamehome.php");
	}
	else
		header("location:home2.php");
}
?>