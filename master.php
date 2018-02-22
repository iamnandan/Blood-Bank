<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="main.css">
		<script src="jchart.js"></script>
<style type="text/css">
div.jumbotron {
    padding-top: 10px;
    padding-bottom: 10px;
	background-image: url("blood.jpg");
}
p.tagLine {
	color: white;
}
nav.navbar.navbar-inverse {
    background-color: firebrick;
}
</style>
</head>

<body>
<div class="jumbotron">
<div class="container text-center">
<h1>Blood Bank</h1>
<p class="tagLine">Give Blood Give Life</p>
</div>
</div>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li class="active"><a href="index.php" style="background-color: firebrick;"><span class="glyphicon glyphicon-home"></span> Home </a></li>
<li><a href="aboutUs.php">About Us</a></li>
<li><a href="blooddetails.php">Blood Availabilty</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<?php include 'functions.php';?>
<?php
	session_start();
    if(isset($_SESSION['user']))
    {
		$isLogged = true;
		//Check the role of user
		$role = fetchRole($_SESSION['user']);
		//echo $role;
	}
	else { $isLogged = false; }
	
	//Menu options 
	if($isLogged)
	{
		if("donor"==$role){
			echo '<li><a href="donorSchedule.php"><span class="glyphicon glyphicon-pencil"></span> Schedule Donation </a></li>';
		}
		if("reciever"==$role){
			echo '<li><a href="requestBlood.php"><span class="glyphicon glyphicon-pencil"></span> Request Blood </a></li>';
		}
		if("admin"==$role){
			echo '<li><a href="adminUpdateBlood.php"><span class="glyphicon glyphicon-pencil"></span> Update Blood </a></li>';
			echo '<li><a href="adminSearchUser.php"><span class="glyphicon glyphicon-pencil"></span> Search/Update User </a></li>';
		}
		//echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Your Account </a></li>';
		echo '<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout </a></li>';
	}
	else{
		echo '<li><a href="preRegistrationStep.php"><span class="glyphicon glyphicon-pencil"></span> Register </a></li>';
		echo '<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Login </a></li>';
	}
?>
</ul>
</div>
</div>
</nav>
</body>
</html>