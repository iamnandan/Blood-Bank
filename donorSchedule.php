<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Schedule Donation </title>
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
	<form class="form-horizantal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	<div class="container text-center">
	  <h1>Schedule your donation</h1>
<?php	  
if (isset($_POST['btnDonScheSubmit'])) {
	//Fetch form field values 
	$userName = $_SESSION['user'];
	$bloodGroup = $_POST['selDonBloodGrp'];
	$donSchDate = $_POST['calDonSchedule'];
	$donSchTime = $_POST['selDonTime'];
	scheduleDonation($userName, $bloodGroup, $donSchDate, $donSchTime);
}
?>
	
	<div>
	<label for="selDonBloodGrp">Blood Group: </label>
	<select name="selDonBloodGrp" required="true">
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
	<div>
	<label for="calDonSchedule">Date: </label>
        <input type="date" name="calDonSchedule" class="hide-replaced"  required="true"/>
	<label for="selDonTime">Time Slot: </label>
	<select name="selDonTime" required="true">
		<option value="10AM">10AM</option>
		<option value="12PM">12PM</option>
		<option value="2PM">02PM</option>
	</select>	
	</div>
	<div>
	    <input type="submit" name="btnDonScheSubmit" value="Schedule" />
	</div>
	</div>
	</form>
<?php include 'footer.php';?>	
</body>
</html>