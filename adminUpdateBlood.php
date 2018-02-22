<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Update Blood Levels </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
	div {
		margin-bottom: 10px;
	}
	p {
		color: red;
	}
	</style>
</head>
<body style="background-color: bisque;">
<?php include 'master.php';?>
<?php
        session_start();
        if(!isset($_SESSION['user']))
        {
			//When user is not logged in, redirect to login page
            header("location: login.php");
        }
?>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	<div class="container text-center">
	  <h1>Update Blood Levels</h1>
<?php	  
if (isset($_POST['btnAdminQtySubmit'])) {
	//Fetch form field values 
	$bloodGroup = $_POST['selAdminBloodGrp'];
	$quantity = $_POST['txtAdminQty'];	
	updateQuantity($bloodGroup, $quantity);
}
?>
	<div class="container text-center">
	<label for="selAdminBloodGrp">Blood Group: </label>
	<select name="selAdminBloodGrp" required="true">
		<option value="A+">A+</option>
		<option value="A-">A-</option>
		<option value="B+">B+</option>
		<option value="B-">B-</option>
		<option value="AB+">AB+</option>
		<option value="AB-">AB-</option>
		<option value="O+">O+</option>
		<option value="O-">O-</option>
	</select>	
	</div>
	<div class="container text-center">
		<label for="txtAdminQty">Quantity: </label>
		<input type="text" name="txtAdminQty" placeholder="No. of Litres" required="true"/>
	</div>
	<div class="container text-center">
	    <input type="submit" name="btnAdminQtySubmit" value="Update" />
	</div>
	</div>
	</form>
<?php include 'footer.php';?>	
</body>
</html>