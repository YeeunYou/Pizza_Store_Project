<?php
session_start();
require_once("common.php");
include("navigationMenu.php");
$conn->select_db("databasename");
$fnameErr = $lnameErr = $emailErr = $streetNumErr = $streetNameErr = $aptNumErr = $cityErr = $provinceErr = $postalCodeErr = "";
$error = false;

if($_SERVER['REQUEST_METHOD'] == "POST")
{ 
	if(!isset($_POST['fname']) || empty($_POST['fname']))
	{
		$fnameErr = "First name is required!";
		$error = true;
	}
	else
	{
		$_SESSION['fname'] = $_POST['fname'];
	}
	if(!isset($_POST['lname']) || empty($_POST['lname']))
	{
		$lnameErr = "Last name is required!";
		$error = true;
	}
	else
	{
		$_SESSION['lname'] = $_POST['lname'];
	}
	if(!isset($_POST['email']) || empty($_POST['email']))
	{
		$emailErr = "Email address is required!";
		$error = true;
	}
	else
	{
		$_SESSION['email'] = $_POST['email'];
	}
	if(!isset($_POST['streetNum']) || empty($_POST['streetNum']))
	{
		$streetNumErr = "Street number is required!";
		$error = true;
	}
	else
	{
		$_SESSION['streetNum'] = $_POST['streetNum'];
	}
	if(!isset($_POST['streetName']) || empty($_POST['streetName']))
	{
		$streetNameErr = "Street Name is required!";
		$error = true;
	}
	else
	{
		$_SESSION['streetName'] = $_POST['streetName'];
	}
	if(!isset($_POST['aptNum']) || empty($_POST['aptNum']))
	{
		$aptNumErr = "Apt # is required!";
		$error = true;
	}
	else
	{
		$_SESSION['aptNum'] = $_POST['aptNum'];
	}
	if(!isset($_POST['city']) || empty($_POST['city']))
	{
		$cityErr = "City is required!";
		$error = true;
	}
	else
	{
		$_SESSION['city'] = $_POST['city'];
	}
	if(!isset($_POST['province']) || empty($_POST['province']))
	{
		$provinceErr = "Province is required!";
		$error = true;
	}
	else
	{
		$_SESSION['province'] = $_POST['province'];
	}
	if(!isset($_POST['postalCode']) || empty($_POST['postalCode']))
	{
		$postalCodeErr = "Postal Code is required!";
		$error = true;
	}
	else
	{
		$_SESSION['postalCode'] = $_POST['postalCode'];
	}
	if(!$error)
	{ 
		$qry  = sprintf("INSERT INTO tblCustomers (name, lastName, email, streetNumber, streetName, aptNumber, city, province, postalCode, active) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d)", $_SESSION['fname'],$_SESSION['lname'],$_SESSION['email'],$_SESSION['streetNum'],$_SESSION['streetName'],$_SESSION['aptNum'],$_SESSION['city'],$_SESSION['province'],$_SESSION['postalCode'], 1);
		$conn->query($qry);
		if($conn->affected_rows > 0)
			{ 
				$qry2 = "INSERT INTO tblPizza (customer_id, size, dough, sauce, cheese, veggie, meat, seasoning, active) SELECT customer_id, size, dough, sauce, cheese, veggie, meat, seasoning, active FROM tblCart WHERE active = 1";
				$conn->query($qry2);
				//$qry3 = "UPDATE tblCart SET active = 0 WHERE active = 1";
				//$conn->query($qry3);
				if($conn->affected_rows > 0)
					{
						header("location: orderSummary.php");
					}   
			}			
		/*
		sprintf("INSERT INTO tblOrders (customer_id, pizza_id) SELECT c.customer_id FROM tblCustomers c INNER JOIN tblOrders o ON c.customer_id = o.customer_id INNER JOIN tblPizza p on o.pizza_id = p.pizza_id ");
	 	$conn->query($qry2);
	 	*/
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href='https://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div id="wrap">
	<h1>Thank you for ordering with INFO3106 Pizza!</h1>
		<form method="post">
			
			<!--<h3>Current time: <?php echo date("h:ia"); ?></h3>
			<p>Please fill out delivery information. <br/>
			   The pizza you ordered will be delivered in 45minutes from the moment you click "order" button.</p>-->
			   <p>Please fill out delivery information</p> 
			<table>
			<tr><td>First Name: </td><td><input maxlength="15" type="text" name="fname" value="<?php if(isset($_SESSION['fname'])) {echo $_SESSION['fname'];} ?>"></td></tr>
			<td><span style="color:red"><?php if(isset($fnameErr)){echo $fnameErr;} ?></span></td>
			<tr><td>Last Name: </td><td><input maxlength="15" type="text" name="lname" value="<?php if(isset($_SESSION['lname'])) {echo $_SESSION['lname'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($lnameErr)){echo $lnameErr;} ?></span></td>
			<tr><td>Email: </td><td><input type="text" name="email" value="<?php if(isset($_SESSION['email'])) {echo $_SESSION['email'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($emailErr)){echo $emailErr;} ?></span></td>
			<tr><td>Street #: </td><td><input type="text" name="streetNum" value="<?php if(isset($_SESSION['streetNum'])) {echo $_SESSION['streetNum'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($streetNumErr)){echo $streetNumErr;} ?></span></td>
			<tr><td>Street Name: </td><td><input type="text" name="streetName" value="<?php if(isset($_SESSION['streetName'])) {echo $_SESSION['streetName'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($streetName)){echo $streetName;} ?></span></td>
			<tr><td>Apt #: </td><td><input type="text" name="aptNum" value="<?php if(isset($_SESSION['aptNum'])) {echo $_SESSION['aptNum'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($aptNumErr)){echo $aptNumErr;} ?></span></td>
			<tr><td>City: </td><td><input type="text" name="city" value="<?php if(isset($_SESSION['city'])) {echo $_SESSION['city'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($cityErr)){echo $cityErr;} ?></span></td>
			<tr><td>Province: </td><td><input type="text" maxlength="2" name="province" value="<?php if(isset($_SESSION['province'])) {echo $_SESSION['province'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($provinceErr)){echo $provinceErr;} ?></span></td>
			<tr><td>Postal Code: </td><td><input type="text" maxlength="6" name="postalCode" value="<?php if(isset($_SESSION['postalCode'])) {echo $_SESSION['postalCode'];} ?>"> </td></tr>
			<td><span style="color:red"><?php if(isset($postalCodeErr)){echo $postalCodeErr;} ?></span></td>
			</table>
			<br/>
			<input type="submit" value="Order Now">
		</form>
</div> 
</body>
</html>