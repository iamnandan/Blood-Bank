<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Activation Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src=""></script>
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

	<form action=# method="get">https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js
	<div class="container text-center" >
	  <h1>Activation Page</h1>
	  <?php	  
		if (isset($_GET['btnActActivate'])) {
		$userName = $_GET["txtActUsername"];
		$ActCode = $_GET["txtActCode"];
		activateUser($userName,$ActCode);
		}
	  ?>
	<label for="actUsername" style="margin-right: 30px;">Username: </label>
	  <input type="text" name="txtActUsername" value="<?php echo htmlspecialchars($_GET["txtActUsername"]); ?>"/>
	</div>
	<div class="container text-center">
	  <label for="actCode">ActivationCode: </label>
	  <input type="text" name="txtActCode" value="<?php echo htmlspecialchars($_GET["txtActCode"]); ?>" />
	 </div>	
	 <div class="container text-center">
	  <input type="submit" name="btnActActivate" value="Activate" />  
	</div>
	</form>
	
<?php include 'footer.php';?>	
</body>
</html>
