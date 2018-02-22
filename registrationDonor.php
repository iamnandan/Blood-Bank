<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Registration Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type="text/css">
	p {
		color: red;
	}
	</style>
</head>

<body style="background-color: bisque;">
<?php include 'master.php';?>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	<div class="container text-center">
	  <h1>Registration Page</h1>

<?php	  
if (isset($_POST['btnRegSubmit'])) {
	//Fetch form field values 
	$username = $_POST['txtRegUsrName'];
	$password = $_POST['txtRegPassword'];
	$cnfrmPassword = $_POST['txtRegPasswordConfirm'];
	$email = $_POST['txtRegEmail'];	
	$mobile = $_POST['txtRegMobile'];
	$address = $_POST['txtRegAddress'];
	$zip = $_POST['txtRegZip'];
	$booleanValidations = validateRegistrationForm($username, $password, $cnfrmPassword, $email, $mobile, $zip);
	if($booleanValidations==true){
		registerUserInDB($username, $password, $email, $mobile, $address, $zip, "donor", NULL);
	}
}
?>

	  <input type="text" name="txtRegUsrName" placeholder="UserName" style="margin-bottom: 10px;" required="true"/><br>
	  <input type="password" name="txtRegPassword" placeholder="Password" style="margin-bottom: 10px;" required="true"/><br>
	  <input type="password" name="txtRegPasswordConfirm" placeholder="Retype Password" style="margin-bottom: 10px;" required="true"/><br>
	  <input type="email" name="txtRegEmail" placeholder="Email Address" style="margin-bottom: 10px;" required="true"/><br>
	  <input type="text" name="txtRegMobile" maxlength="10" placeholder="Mobile Number" style="margin-bottom: 10px;" required="true"/><br>
	  <textarea name="txtRegAddress" rows="2" cols="22" placeholder="Address" style="margin-bottom: 10px;" required="true"></textarea> <br>
	  <input type="text" name="txtRegZip" placeholder="ZIP Code" style="margin-bottom: 10px;" required="true"/><br>
	  <input type="submit" name="btnRegSubmit" value="Register" />
	</div>
	</form>
<?php include 'footer.php';?>	
</body>
</html>