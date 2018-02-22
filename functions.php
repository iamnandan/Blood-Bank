<?php error_reporting(E_ALL ^ E_NOTICE) ?>
<?php 

/* Function to validate the registration form */
function validateRegistrationForm($username, $password, $cnfrmPassword, $email, $mobile, $zip){	
	//Check username availability
	$sqlQuery = "Select strUsername	from usertbl where strUsername='$username'";
	$users = executeSelectQuery($sqlQuery);
	if ($users->num_rows > 0){
		echo '<p> User Name already exists, Please choose a new one </p>';
		return false;
	}
	//Check passowrd rules
	if(!empty($password) && !empty($cnfrmPassword)) {
		if($password===$cnfrmPassword){
			if (strlen($password) < '8') {
				echo '<p> Your Password Must Contain At Least 8 Characters! </p>';
				return false;
			}
			elseif(!preg_match("/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/",$password)) {
				echo '<p> Your Password must contain atleast one alphabet and one number  </p>';
				return false;
			}
		}
		else {
			echo '<p> Password mismatch, Please try again </p>';
			return false;
		}
	}
	//Check email rules
	$sqlQuery = "Select strUsername	from usertbl where strEmail='$email'";
	$users = executeSelectQuery($sqlQuery);
	if ($users->num_rows > 0){
		echo '<p> Sorry the Email has already been registered with other user </p>';
		return false;
	}
	//Check Mobile Number rules
	if (strlen($mobile) != '10') {
		echo '<p> Your Mobile Number must contain 10 numbers </p>';
		return false;
	}
	else if(!preg_match("/^[1-9][0-9]*$/",$mobile)) {
		echo '<p> Invalid Mobile Number  </p>';
		return false;
	}
	//Check ZIP Code rules
	if (strlen($zip) != '5') {
		echo '<p> Your ZIP Code must contain only 5 numbers </p>';
		return false;
	}
	else if(!preg_match("/^[1-9][0-9]*$/",$zip)) {
		echo '<p> Invalid ZIP Code  </p>';
		return false;
	}
	echo '<p> You have been registered. You must activate your account from the activation link sent to '.$email.'</p>';
	return true;
}

/* Function to execute the given sql query and return the result list */
function executeSelectQuery($sqlQuery){
	// Create connection
	$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Sql query:".$sqlQuery;
	$result = $conn->query($sqlQuery);
	$conn->close();
	return $result;
}

/* Function to insert new user details into database during registration */
function registerUserInDB($username, $password, $email, $mobile, $address, $zip, $userType, $hospCode){
	$activationLink = buildActivationUrl($username);
		// Create DB connection
		$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo '<p> Connection Success </p>';
			$sql = "INSERT INTO usertbl (strUsername, strPassword, strEmail, blnActive, strCode, strDate, strRole, strMobileNum, strAddress, intZipCode, strHospCode) 
								VALUES ('$username', '$password', '$email', 0, '$activationLink', sysdate(), '$userType', '$mobile', '$address', '$zip', '$hospCode')";
			if ($conn->query($sql) === TRUE) {
				//$emailSent = sendEmail($username, $email, $activationLink);
				echo '<p>User Registered, Please activate to complete the registration</p>';
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
}

function sendEmail($username, $email, $activationLink){
	$to = $email;
	$subject = "Blood Bank Activation";
	//$txt = "Hello".$username;
	$txt = $activationLink;
	$headers = "From: admin@bloodbank.com" ;
	mail($to,$subject,$txt,$headers);
}

/* Function to build activationLink for the new user */
function buildActivationUrl($username){
		//echo '<p> http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'].'</p>';
		//Build url for activation
		$host = $_SERVER['HTTP_HOST'];
		$file = "/myProject/activation.php";
		$actCode = substr( md5(rand()), 0, 7);    //Function to generate random code
		$values = "?txtActUsername=".$username."&txtActCode=".$actCode;
		$completeUrl = "http://".$host.$file.$values;
		echo '<p>'.$completeUrl.'</p>';
		return $actCode;
}

/* Function to activate a new user */
function activateUser($userName,$ActCode){
		// Create DB connection
		$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo '<p> Connection Success </p>';
			$sql = "UPDATE usertbl SET  blnActive = 1 WHERE strUsername='$userName'";
			if ($conn->query($sql) === TRUE) {
				echo "<p> Activation Successful, Your registration process is complete </p>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
}

/* Function to validate the login credentials */
function validateCredentials($userName,$password){
	$query = "SELECT strPassword FROM usertbl WHERE strUsername='$userName'";
	$result = executeSelectQuery($query);
	if ($result->num_rows ==	0){
		echo "<p> User does not exist </p>";
		return false;
	}
	while($row = $result->fetch_assoc()) {
		$actualPassword = $row["strPassword"];
	}
	if($password === $actualPassword){
		return true;
	}
	else {
		echo "<p> Invalid passowrd </p>";
		return false;
	}
}

/* Function to fetch role of user */
function fetchRole($userName){
	$query = "SELECT strRole FROM  usertbl WHERE strUsername='$userName'";
	$result = executeSelectQuery($query);
	if ($result->num_rows ==	0){
		return null;
	}
	while($row = $result->fetch_assoc()) {
		$role = $row["strRole"];
	}
	return $role;
}

/* Function to update blood quantity */
function updateQuantity($bloodGroup, $quantity){
		// Create DB connection
		$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo '<p> Connection Success </p>';
			$sql = "UPDATE bloodgrpinfotbl SET  intQuantity = '$quantity' WHERE strBloodGrpName='$bloodGroup'";
			if ($conn->query($sql) === TRUE) {
				echo "<p> Update Successful </p>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
}

/* Function to fetch user details */
function fetchUser($userName){
	$query = "SELECT * FROM  usertbl WHERE strUsername='$userName'";
	$result = executeSelectQuery($query);
	if ($result->num_rows ==	0){
		return null;
	}
	$row = $result->fetch_assoc();
	return $row;
}


/* Function to update user details */
function updateUserDetails($username,$mobile,$addressUpdate,$zip,$hospitalCode){
		// Create DB connection
		$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo '<p> Connection Success </p>';
			$sql = "UPDATE usertbl SET  strMobilenum = '$mobile',strAddress='$addressUpdate',intZipCode='$zip',strHospCode='$hospitalCode' WHERE strUsername='$username'";
			if ($conn->query($sql) === TRUE) {
				echo "<p> Update Successful </p>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
}

/*Function to delete user by admin*/
function deleteUser($username){
	// Create DB connection
		$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo '<p> Connection Success </p>';
			$sql = "DELETE from usertbl WHERE strUsername='$username'";
			if ($conn->query($sql) === TRUE) {
				echo "<p> Update Successful </p>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
}

/* Function to update blood requests from recievers */
function requestBlood($userName, $bloodGroup, $quantity, $priority){
		// Create DB connection
		$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo <p> Connection Success </p>;
			$sql = "INSERT INTO requestdetailstbl (strUsername, strBloodGrpName, intQuantity, strPriority, strStartDate, blnReqOpen) 
								VALUES ('$userName', '$bloodGroup', '$quantity', '$priority', sysdate(), 1)";
			if ($conn->query($sql) === TRUE) {
				echo "<p> Request has been generated successfully </p>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
}

/* Function to display blood levels available */
function printBloodResults($bloodGrpName)
{
	$query = "SELECT intQuantity FROM bloodgrpinfotbl WHERE strBloodGrpName='$bloodGrpName'";
	$result = executeSelectQuery($query);
	if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()) {
		$bloodQty = $row["intQuantity"];
	     }
	return $bloodQty;
	}
	
}

/* Function to schedule slots for blood donations */
function scheduleDonation($userName, $bloodGroup, $donSchDate, $donSchTime){
		// Create DB connection
		$conn = new mysqli("localhost","bankdbuser","bankdbuser","bankdb");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . mysqli_connect_error());
		}
		else {
			//echo <p> Connection Success </p>;
			$sql = "INSERT INTO donorScheduleReqTbl (strUsername, strBloodGrpName, strDate, strTimeSlot) 
								VALUES ('$userName', '$bloodGroup', '$donSchDate', '$donSchTime')";
			if ($conn->query($sql) === TRUE) {
				echo "<p> Your slot has been booked successfully </p>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
}


?>
