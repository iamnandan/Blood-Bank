<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Home Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body style="background-color: bisque;">
<?php include 'master.php';?>
	<?php
        session_start();
        if(!isset($_SESSION['user']))
        {
			//When user is not logged in, redirect to login page
            //header("location: login.php");
			echo '<p style="color:brown;">Hello Guest,</p>';
        }
		else echo '<p style="color:brown;">Hello '.$_SESSION['user'].',</p>';
		$test = "ab"!="def";
		echo '<p>"{$test}"</p>';
?>
	<div class="container text-center">
	  <h1>Welcome to Blood Bank Kansas City</h1>
		<p style="text-align: left;"> 
		  The motto of our blood bank is to reduce the gap between donor and hospitals in Kansas city. People in need of blood 
	      can easily look for availability with us and schedule an appointment via hospital for the required blood.
		  Blood is universally recognized as the most precious element that sustains life. It saves innumerable lives
		  across the world in a variety of conditions. The need for blood is great - on any given day, approximately
		  39,000 units of Red Blood Cells are needed. More than 29 million units of blood components are
		  transfused every year. Despite the increase in the number of donors, blood remains in short supply during
		  emergencies, mainly attributed to the lack of information and accessibility. We positively believe this tool
		  can overcome most of these challenges by effectively connecting the blood donors with the blood recipients. <br/><br/>
		  <b>WHAT YOU SHOULD EAT BEFORE DONATING BLOOD:</b><br/>
		  A healthy diet helps ensure a successful blood donation, and also makes you feel better!
		  Check out the following recommended foods to eat prior to your donation.<br/>
		  1)Low fat foods<br/>
		  2)Iron rich foods
		</p>
	</div>
<?php include 'footer.php';?>	
</body>
</html>