<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href='https://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="main.css">
	<title>Document</title>
</head>
<body>  
	<?php
	session_start();
	include("navigationMenu.php");
	require_once("common.php");
	$conn->select_db("You_Yeeun_pizzastore");

	echo "<h3 id='txt'>" . $_SESSION['fname'] . " 's Order Summary: </h3><br/>";
	$qry = "SELECT size, dough, sauce, cheese, veggie, meat, seasoning FROM tblPizza WHERE active = 1";
	$pizzaRS = $conn->query($qry);
	$countQry = sprintf("SELECT COUNT(pizza_id) AS count FROM tblPizza");
	$result = mysqli_query($conn, $countQry);
	$countResult = $result->fetch_object()->count; 
		if($countResult > 0)
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
			
			echo "<h3 id='txt'> Will be delivered to...</h3>";
			$qry2 = sprintf("SELECT name, lastName, email, streetNumber, streetName, aptNumber, city, province, postalCode FROM tblCustomers WHERE email = ('%s') AND active = 1", $_SESSION['email']);
			$cusRS = $conn->query($qry2);
		 
				echo "<table>";
				while ($row = $cusRS->fetch_array())  
				{
					echo "<tr><td>". $row['name']. "</td></tr>
						  <td>" . $row['lastName'] . "</td></tr>
					 	  <td>" . $row['email'] . "</td></tr>
					  	  <td>" . $row['streetNumber'] . "</td></tr>
					      <td>" . $row['streetName'] . "</td></tr>
					      <td>" . $row['aptNumber'] . "</td></tr>
					      <td>" . $row['city'] . "</td></tr>
					      <td>" . $row['province'] . "</td></tr>
					      <td>" . $row['postalCode'] . "</td></tr></table>";
				}  
			$ctime = date("h:ia");
			echo "<div id='wrap'><h3 class='msg'>Please Confirm your order</h3>";
			echo "Current Time: " . $ctime . "<br/>Ordered pizza will be delivered in 45mins";
			echo "<br/><form method='post'><input type='submit' name='confirm' value='Confirm Order' style='margin-left:105%;'></form></div>";


			if($_SERVER['REQUEST_METHOD'] == "POST") 
			{
				if (isset($_POST['confirm'])) 
				{
					$qry = "DELETE FROM tblCart WHERE active = 0 OR active = 1";
					$conn->query($qry);  
					$qry3 = "UPDATE tblCustomers SET active = 0";
					$conn->query($qry3);
					$qry4 = "UPDATE tblPizza SET active = 0";
					$conn->query($qry4);	
					echo "<script>alert('Order Confirmed!');</script>";
					$_SESSION['email'] = "";
					header("location: index.php");
				}
			}
	?> 
</body>
</html>