<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Login Page </title>
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
	<script>
	function setBGColor(){
		document.getElementById("loginBody").style.
		= "bisque";
	}
	</script>
	
</head>
<body id="loginBody" onload="setBGColor()">

<?php include 'master.php';?>
	<form action="" method="post">
	<div class="container text-center">
	  <h1>Login Page</h1>
	<?php
		if(isset($_POST['btnLogLogin']))
		{
        session_start();
		$inputUserName = $_POST['txtLogUsername'];
		$inputPassword = $_POST['txtLogPassword'];
		$authSuccess = validateCredentials($inputUserName,$inputPassword);
		if($authSuccess == true){
			//Storing the name of user in SESSION variable.
			$_SESSION['user']=$_POST['txtLogUsername'];
			if(isset($_SESSION['user'])){
				header("location: index.php");
				}
			}
		}
	?>
	  <label for="userName">Username: </label>
	  <input type="text" name="txtLogUsername" required="true" />
	</div>
	<div class="container text-center">
	  <label for="password">Password: </label>
	  <input type="password" name="txtLogPassword" required="true"/>
	 </div>
	 <div class="container text-center">
	  <input type="submit" name="btnLogLogin" value="Login" />
	</div>
	</form>
<?php include 'footer.php';?>	
</body>
</html>