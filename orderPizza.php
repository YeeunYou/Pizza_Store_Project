<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"> 
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>  
<?php
session_start();
require_once("common.php");
include("navigationMenu.php");
$conn->select_db("You_Yeeun_pizzastore");
$error = "";

if (isset($_SESSION['email'])) { 
$qry = sprintf("SELECT customer_id FROM tblCustomers WHERE email = ('%s')", $_SESSION['email']);
	$userRS = $conn->query($qry);
	while ($row = $userRS->fetch_assoc())
	{
		$cusID = $row['customer_id'];
	}

$qry = sprintf("SELECT size, dough, sauce, cheese, veggie, meat, seasoning FROM tblPizza WHERE customer_id = %d", $cusID);
		$pizzaRS = $conn->query($qry);
		$countQry = sprintf("SELECT COUNT(pizza_id) AS count FROM tblPizza");
		$result = mysqli_query($conn, $countQry);
		$countResult = $result->fetch_object()->count; 
		if($countResult > 0)
		{ 
			echo "<h2 id='prevOrder'>Your Previous Order....</h2><table>";
?>
		<tr>
		<th style="display:none">ID</th>
		<th>Size</th>
		<th>DoughType</th>
		<th>Sauce</th>
		<th>Cheese</th>
		<th>Vegi Topping</th>
		<th>Meat Topping</th>
		<th>Seasoning Topping</th>
	</tr> 
<?php

		while ($row = $pizzaRS->fetch_array())  
			{
				echo "<tr><td>". $row['size']. "</td>
					  <td>" . $row['dough'] . "</td>
				 	  <td>" . $row['sauce'] . "</td>
				  	  <td>" . $row['cheese'] . "</td>
				      <td>" . $row['veggie'] . "</td>
				      <td>" . $row['meat'] . "</td>
				      <td>" . $row['seasoning'] . "</td>
			  		  </tr>";
			} 
				echo "</table>";
		}
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['add']))
	{
		if(!isset($_POST['size']) || empty($_POST['size']) || !isset($_POST['dough']) || empty($_POST['dough']) || !isset($_POST['sauce']) || empty($_POST['sauce']) 
		|| !isset($_POST['cheese']) || empty($_POST['cheese']) || !isset($_POST['topping1']) || empty($_POST['topping1']) || !isset($_POST['topping2']) || empty($_POST['topping2']) || 
		!isset($_POST['topping3']) || empty($_POST['topping3']))
		{
			$error = "All fields are required!";
		}
		else
		{
			$_SESSION['size'] = $_POST['size'];
			$_SESSION['dough'] = $_POST['dough'];
			$_SESSION['sauce'] = $_POST['sauce'];
			$_SESSION['cheese'] = $_POST['cheese'];
			$_SESSION['topping1'] = $_POST['topping1'];
			$_SESSION['topping2'] = $_POST['topping2'];
			$_SESSION['topping3'] = $_POST['topping3'];
			
			$countQry = sprintf("SELECT COUNT(customer_id) AS count FROM tblCustomers");
			$result = mysqli_query($conn, $countQry);
			$countResult = $result->fetch_object()->count; 
			$qry = sprintf("INSERT INTO  tblCart (customer_id, size, dough, sauce, cheese, veggie, meat, seasoning, active) VALUES ( %d ,'%s', '%s', '%s', '%s', '%s', '%s', '%s', %d)", ($countResult+1), $_SESSION['size'], $_SESSION['dough'], $_SESSION['sauce'], $_SESSION['cheese'], $_SESSION['topping1'], $_SESSION['topping2'], $_SESSION['topping3'], 1);
			$conn->query($qry); 
				if($conn->affected_rows > 0)
					{

						echo "<script>alert('Pizza Added!');</script>";
					} 
			 
			/*
			$_SESSION['size'] = $_POST['size'];
			$_SESSION['dough'] = $_POST['dough'];
			$_SESSION['sauce'] = $_POST['sauce'];
			$_SESSION['cheese'] = $_POST['cheese'];
			$_SESSION['topping1'] = $_POST['topping1'];
			$_SESSION['topping2'] = $_POST['topping2'];
			$_SESSION['topping3'] = $_POST['topping3'];
			*/
		}
	}
	if(isset($_POST['checkout']))
	{ 
		header("location: userInformation.php"); 
	}
}
?>

<form method="post">
	<span style="color:red;"><?php if(isset($error)){echo $error;} ?></span><br/>
	Choose Pizza Size:<br/>
	<select name="size">  
			<option value='' disabled selected></option>
			<option value="small" <?php if(isset($_POST['size']) && $_POST['size'] == "small") { echo "selected";}  ?>>small</option>
			<option value="medium" <?php if(isset($_POST['size']) && $_POST['size'] == "medium") { echo "selected";}  ?>>medium</option>
			<option value="large" <?php if(isset($_POST['size']) && $_POST['size'] == "large") { echo "selected";}  ?> >large</option>
			<option value="x-large" <?php if(isset($_POST['size']) && $_POST['size'] == "x-large") { echo "selected";}  ?>>x-large</option>
	</select><br/><br/>
	Choose dough:<br/>
	<select name="dough"> 
			<option value='' disabled selected></option>
			<option value="regular" <?php if(isset($_POST['dough']) && $_POST['dough'] == "regular") { echo "selected";}  ?>>regular dough</option>
			<option value="wholeGrain" <?php if(isset($_POST['dough']) && $_POST['dough'] == "wholeGrain") { echo "selected";}  ?>>whole grain dough</option> 
	</select><br/><br/>
	Choose Sauce:<br/>
	<select name="sauce"> 
		    <option value='' disabled selected></option>
			<option value="Chipotle" <?php if(isset($_POST['sauce']) && $_POST['sauce'] == "Chipotle") { echo "selected";}  ?>>Chipotle Sauce</option>
			<option value="TexasBBQ" <?php if(isset($_POST['sauce']) && $_POST['sauce'] == "TexasBBQ") { echo "selected";}  ?>>Texas BBQ</option>
			<option value="CreamyGarlic" <?php if(isset($_POST['sauce']) && $_POST['sauce'] == "CreamyGarlic") { echo "selected";}  ?>>Creamy Garlic Sauce</option>
			<option value="Hot" <?php if(isset($_POST['sauce']) && $_POST['sauce'] == "Hot") { echo "selected";}  ?>>Hot Sauce</option>
			<option value="Pesto" <?php if(isset($_POST['sauce']) && $_POST['sauce'] == "Pesto") { echo "selected";}  ?>>Pesto Sauce</option>
			<option value="SweetChili" <?php if(isset($_POST['sauce']) && $_POST['sauce'] == "SweetChili") { echo "selected";}  ?>>Sweet Chili Thai Sauce</option>
			<option value="No" <?php if(isset($_POST['sauce']) && $_POST['sauce'] == "No") { echo "selected";}  ?>>No Sauce</option>
	</select><br/><br/>
	Choose Cheese:<br/>
	<select name="cheese"> 
			<option value='' disabled selected></option>
			<option value="Mozzarella" <?php if(isset($_POST['cheese']) && $_POST['cheese'] == "Mozzarella") { echo "selected";}  ?>>Mozzarella Cheese</option>
			<option value="Provolone" <?php if(isset($_POST['cheese']) && $_POST['cheese'] == "Provolone") { echo "selected";}  ?>>Smoked Provolone Base</option> 
			<option value="feta" <?php if(isset($_POST['cheese']) && $_POST['cheese'] == "feta") { echo "selected";}  ?>>Feta Cheese</option> 
			<option value="parmesanCheese" <?php if(isset($_POST['cheese']) && $_POST['cheese'] == "parmesanCheese") { echo "selected";}  ?>>Parmesan Cheese</option>
			<option value="goatCheese" <?php if(isset($_POST['cheese']) && $_POST['cheese'] == "goatCheese") { echo "selected";}  ?>>Goat Cheese</option>
	</select><br/><br/>
	Choose Vegetable Topping:<br/>
	<select name="topping1"> 
			<option value='' disabled selected></option>
			<option value="blackOlive" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "blackOlive") { echo "selected";}  ?>>Black olives</option>
			<option value="Broccoli" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "Broccoli") { echo "selected";}  ?>>Broccoli</option>
			<option value="mushroom" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "mushroom") { echo "selected";}  ?>>Mushroom</option>
			<option value="greenOlive" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "greenOlive") { echo "selected";}  ?>>Green olives</option>
			<option value="greenPepper" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "greenPepper") { echo "selected";}  ?>>Green peppers</option>
			<option value="bananaPepper" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "bananaPepper") { echo "selected";}  ?>>Banana peppers</option>
			<option value="jalapeno" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "jalapeno") { echo "selected";}  ?>>Jalapeno peppers</option>
			<option value="onions" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "onions") { echo "selected";}  ?>>Onions</option>
			<option value="potato" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "potato") { echo "selected";}  ?>>Potato slices</option>
			<option value="tomato" <?php if(isset($_POST['topping1']) && $_POST['topping1'] == "tomato") { echo "selected";}  ?>>Tomato</option> 
	</select><br/><br/>
	Choose Meat Topping:<br/>
	<select name="topping2"> 
			<option value='' disabled selected></option>
			<option value="buffaloChicken" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "buffaloChicken") { echo "selected";}  ?>>Buffalo Chicken</option>
			<option value="chipotleChicken" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "chipotleChicken") { echo "selected";}  ?>>Chipotle Chicken</option>
			<option value="bacon" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "bacon") { echo "selected";}  ?>>Bacon</option>
			<option value="chipotleSteak" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "chipotleSteak") { echo "selected";}  ?>>Chipotle Steak</option>
			<option value="grilledChicken" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "grilledChicken") { echo "selected";}  ?>>Grilled Chicken</option>
			<option value="groundbeef" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "groundbeef") { echo "selected";}  ?>>Ground Beef</option>
			<option value="smokedHam" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "smokedHam") { echo "selected";}  ?>>Smoked Ham</option>
			<option value="italianSausage" <?php if(isset($_POST['topping2']) && $_POST['topping2'] == "italianSausage") { echo "selected";}  ?>>Italian Sausage</option> 
	</select><br/><br/>
	Choose  Seasoning Topping:<br/>
	<select name="topping3">  
			<option value='' disabled selected></option>
			<option value="blackPepper" <?php if(isset($_POST['topping3']) && $_POST['topping3'] == "blackPepper") { echo "selected";}  ?>>Black pepper</option>
			<option value="seaSalt" <?php if(isset($_POST['topping3']) && $_POST['topping3'] == "seaSalt") { echo "selected";}  ?>>Sea salt</option> 
			<option value="sweetGarlic" <?php if(isset($_POST['topping3']) && $_POST['topping3'] == "sweetGarlic") { echo "selected";}  ?>>Sweet Garlic And Pepper Seasoning</option> 
	</select>
	<br/><br/><br/>
	<input type="submit" name="add" value="Add"><br/><br/>
	<input type="submit" name="checkout" value="Check out">
</form>
<img id="pizza" src="pizza.jpg" alt="pizza"/>
<br/>
<?php
$qry2 = "SELECT cart_id, size, dough, sauce, cheese, veggie, meat, seasoning FROM tblCart WHERE active = 1";
$pizzaRS = $conn->query($qry2);
$countQry2 = sprintf("SELECT COUNT(cart_id) AS count FROM tblCart");
$result2 = mysqli_query($conn, $countQry2);
$countResult2 = $result2->fetch_object()->count; 

if($countResult2 > 0)
{
	echo "<table>";
?>
	<tr>
		<th style="display:none">ID</th>
		<th>Size</th>
		<th>DoughType</th>
		<th>Sauce</th>
		<th>Cheese</th>
		<th>Vegi Topping</th>
		<th>Meat Topping</th>
		<th>Seasoning Topping</th>
	</tr>
<?php

	while ($row = $pizzaRS->fetch_array())  
	{
		echo "<tr><td>". $row['size']. "</td>
				  <td>" . $row['dough'] . "</td>
				  <td>" . $row['sauce'] . "</td>
				  <td>" . $row['cheese'] . "</td>
				  <td>" . $row['veggie'] . "</td>
				  <td>" . $row['meat'] . "</td>
				  <td>" . $row['seasoning'] . "</td>
			  </tr>";
	} 
	echo "</table>";

}
?>
</body>
</html>
 