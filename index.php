<?php
session_start();
require_once("common.php");

$emailReg = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
$emailErr = "";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['email']) && !empty($_POST['email']))
	{
		if(preg_match($emailReg, $_POST['email']))
		{
			$_SESSION['email'] = $_POST['email'];
			header("location: orderPizza.php");
			exit();
		}
		else
		{
			$emailErr = "Please enter email address in a valid form"; 
		}
	}
	else
	{
		header("location: orderPizza.php");
		exit();
	}
}
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title> 
	<link href='https://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div id="wrap">
		<h1>INFO 3106 Pizza store</h1>
		<h3 class="msg">London's largest pizza store 'INFO 3106 Pizza' provides online ordering service!
		 With a few simple clicks on your device, you will be able to conveniently place your pizza order while on the go</h3>
		<br/>
		<p id="txt">Have you ordered with us? If yes, please enter your email</p>
		<br/>
		<form method="post" class="msg">
			<span style="color:red"><?php if(isset($emailErr)){echo $emailErr;} ?></span><br/>
			Email: <input type="text" placeholder="your email here" name="email"/><br/><br/>
			<input type="submit" value="Begin"/>
			<input type="submit" value="First Time"/>
		</form>
	</div>
</body>
</html>
