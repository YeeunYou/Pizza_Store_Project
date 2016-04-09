
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<?php 
		require_once("common.php");
		$conn->select_db("You_Yeeun_pizzastore");
		if(isset($_SESSION['email']))
		{
			$qry = sprintf("SELECT name FROM tblCustomers WHERE email = ('%s')", $_SESSION['email']);
			$userRS = $conn->query($qry);
			while ($row = $userRS->fetch_assoc())
			{
				echo '<nav><a> Hello  '. ' ' . $row['name'] . "</a>";
			} 
		echo '<ul><li style="/float:left"><a href="index.php">Home</a></li>
			 <li style="/float:left"><a href="orderPizza.php">Order Pizza</a></li>
			 <li><a href="userInformation.php">Delivery Info</a></li>
			 <li><a href="orderSummary.php">Order Summary</a></li></ul>
			 </nav>';
		}
		else
		{
			echo '<nav><ul><li style="/float:left"><a href="index.php">Home</a></li>
				 <li style="/float:left"><a href="orderPizza.php">Order Pizza</a></li>
				 <li><a href="userInformation.php">Delivery Info</a></li>
				 <li><a href="orderSummary.php">Order Summary</a></li></ul>
				 </nav>';
		} 
	?>
</body>
</html>