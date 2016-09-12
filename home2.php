<?php
include('include.php');
?>
<script type="text/javascript">
var c=-1;
function animate()
{
//	alert('hello');
	var pics=["fifa16.jpg","dota.jpg","blur.jpg","cs.jpg"];
	document.getElementById('slideshow').src="pics\\"+pics[++c];
	$("#slideshow").fadeIn(2000);
	$("#slideshow").fadeOut(2000);
	if(c==3)
		c=-1;
}setInterval("animate()",4000);
function check()
{
	var mail=document.getElementById('email').value;
	if(mail=="")
	{
		document.getElementById('mailerror').innerHTML='';
		document.getElementById('submitregister').disabled=false;
		return;
	}
	var pattern=/[a-z]+[.]*[0-9]*@vit.ac.in/;
	if(!pattern.test(mail))
	{
		document.getElementById('mailerror').innerHTML='***Not a VIT Gmail account***';
		document.getElementById('submitregister').disabled=true;
	}
	else
	{
		document.getElementById('mailerror').innerHTML='';
		document.getElementById('submitregister').disabled=false;
	}
}
function validatepass()
{
	var pass=document.getElementById('upass').value;
	var repass=document.getElementById('repass').value;
	if(pass!=repass)
	{
		document.getElementById('passerr').innerHTML="passwords don't match!";
		document.getElementById('submitregister').disabled=true;
	}
	else
	{
		document.getElementById('passerr').innerHTML='';
		document.getElementById('submitregister').disabled=false;
	}
		
}
function unique()
{
	//this function will check if the username that the user has chosen is unique
	var x=document.getElementById('uname').value;
	if(x=='')
	{
		document.getElementById('unameerror').innerHTML='';
	}
	else
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHttp");
		}
		xmlhttp.onreadystatechange=function()
		{
			document.getElementById('unameerror').innerHTML=xmlhttp.responseText;
			if(xmlhttp.responseText=="")
			{
				document.getElementById('submitregister').disabled=false;
				document.getElementById('uname').backgroundImage="url(\''pics/red.png\'')";
			}
			else
				document.getElementById('submitregister').disabled=true;
		}
		xmlhttp.open("GET","checkuname.php?q="+x,true);
		xmlhttp.send();
	}
}
</script>
<style type="text/css">
body
{
	background-image: url(walls/pat33.jpg);
	background-repeat: no-repeat;
	background-size: 100%;
}
h1,h2
{
	color: white;
}
input[type='text']:required,input[type='password']:required,input[type='email']:required,input[type='date']:required
{
background-image:url('pics/asterisk.png');
background-size:2%;
background-repeat:no-repeat;
background-position:right;
}
input[type='text']:valid,input[type='password']:valid,input[type='email']:valid,input[type='date']:valid
{
background-image:url('pics/green.png');
background-size:5%;
background-repeat:no-repeat;
background-position:right;
}
input[type='text']:focus:invalid,input[type='password']:focus:invalid,input[type='email']:focus:invalid,input[type='date']:focus:invalid
{
background-image:url('pics/red.png');
background-size:5%;
background-repeat:no-repeat;
background-position:right;
}
</style>
<body onload='animate()'>
<?php
if(isset($_REQUEST['regcode']))
{
	if($_REQUEST['regcode'])
		echo '<script type=\"text/javascript\">alert("Account registered successfully! Please check email for further instructions!")</script>';
	else
		echo '<script type="text/javascript">alert("Error in registration. Please try again later!")</script>';
}
?>
<h1 id='main_heading_home'>Online Game Scheduler</h1>
<img src="pics\fifa16.jpg" id='slideshow' name='slideshow'>

<div id='login'>
	<h2>LOGIN</h2>
<form method='post' action='login.php'>
<input type='text' name='uname' class='form-control' placeholder='Username' style="text-align:center" required><br>
<input type='password' name='upass' class='form-control' placeholder='Password' style="text-align:center" required><br>
<input type='submit' value='LOGIN' class='btn btn-default'>
</form>
<h2 style='color:black'>SIGN UP</h2>
<form method='post' action='register.php' autocomplete='off'>
<input type='text' name='uname' class='form-control' placeholder='Username' style="text-align:center" id='uname' required oninput='unique()'><br>
<span id='unameerror' style="color:red"></span>
<input type='password' name='upass' class='form-control' placeholder='Password' style='text-align:center' id='upass' pattern="(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,}" required oninput='validatepass()'><br>
<span id='passerr' style="color:red"></span>
<input type='password' name='repass' class='form-control' placeholder="Re-enter password" style='text-align:center' id='repass' required oninput='validatepass()'><br>
<input type='text' name='fname' class='form-control' placeholder='First Name' style="text-align:center" required><br>
<input type='text' name='lname' class='form-control' placeholder='Last Name' style="text-align:center" required><br>
<input type='date' name='dob' class='form-control' style="text-align:center" required max="2004-01-01"><br>
<input type='email' name='email' class='form-control' placeholder='VIT Gmail Address' style="text-align:center" id='email' oninput='check()' required>
<span id='mailerror' style='color:red'></span><br>
<button type='submit' value='REGISTER' class='btn btn-default' id='submitregister'>REGISTER</button>
</form>
</div>
</body>
</html>