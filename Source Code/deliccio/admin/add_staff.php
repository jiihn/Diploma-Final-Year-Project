<?php
include "../dbconnection.php";
include "nav.php";
ob_start();

if ($_SESSION["aloggedin"] != 1)
{
	header("Location: login.php");
}

else if($_SESSION['access'] != 1)
{
	echo "<script type=\"text/javascript\">
			setTimeout(\"window.location='access_denied.php';\", 1);
	</script>";
}

else
{
	$nav = new navigation();

	$sess_id = $_SESSION["sess_id"]; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Add Staff</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#dialog" ).dialog();
  } );
</script>
<style type="text/css">
	.navbar{
		margin-top: 20px;
	}
	
	.messages
	{
		color: #f44336;
		opacity: 1;
		transition: opacity 0.6s;
		border-radius : 5px;
	}
	
	.success
	{
		background-color: #4CAF50;
		color: white;
		font-size : 1.7em;
		opacity: 1;
		transition: opacity 0.6s;
		margin-bottom: 15px;
		border-radius : 5px;
	}
</style>
</head> 
<body>
    <?php 
		$nav->header1();
	?>
	<div class="container">
		<h1>Add New Staff</h1>
		<hr>
    <form name="addStaffFrm" method="post" action="" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-xs-3" for="inputEmail">Email:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="inputEmail" name="staffEmail"  maxlength="40" placeholder="Email" value="<?php echo isset($_POST["staffEmail"]) ? $_POST["staffEmail"] : ''; ?>">
				<span class="messages" id="message1"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="inputPassword">Password:</label>
            <div class="col-xs-4">
                <input type="password" class="form-control" id="inputPassword" name="staffPassword"  maxlength="12" placeholder="Password" value="<?php echo isset($_POST["staffPassword"]) ? $_POST["staffPassword"] : ''; ?>">
				<span class="messages" id="message2"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="fullName">Full Name:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="fullName" name="staffName" placeholder="Full Name"  maxlength="40" value="<?php echo isset($_POST["staffName"]) ? $_POST["staffName"] : ''; ?>">
				<span class="messages" id="message3"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="phoneNumber">Phone:</label>
            <div class="col-xs-4">
                <input type="tel" class="form-control" id="phoneNumber" maxlength="12" name="staffPnum" placeholder="Without '-' Eg. 0123456789" value="<?php echo isset($_POST["staffPnum"]) ? $_POST["staffPnum"] : ''; ?>">
				<span class="messages" id="message4"></span>
            </div>
        </div>
        
        
        <div class="form-group">
            <label class="control-label col-xs-3" for="postalAddress">Address:</label>
            <div class="col-xs-4">
                <textarea rows="3" class="form-control" id="postalAddress" name="staffAddress" placeholder="Postal Address"><?php echo isset($_POST["staffAddress"]) ? $_POST["staffAddress"] : ''; ?></textarea>
				<span class="messages" id="message5"></span>
            </div>
        </div>
		<div class="form-group">
            <label class="control-label col-xs-3">State:</label>
            <div class="col-xs-2">
                <select class="form-control" name="staffState">
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri_Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Penang">Penang</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                </select>
            </div>
		</div>
		<div class="form-group">
            <label class="control-label col-xs-3">City:</label>
            <div class="col-xs-4">
                <input type="tel" class="form-control" id="city" name="staffCity" placeholder="City"  maxlength="20" value="<?php echo isset($_POST["staffCity"]) ? $_POST["staffCity"] : ''; ?>">
				<span class="messages" id="message6"></span>
            </div>
		</div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="PostCode">Post Code:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="PostCode" maxlength="5" name="staffPostCode" placeholder="Post Code" value="<?php echo isset($_POST["staffPostCode"]) ? $_POST["staffPostCode"] : ''; ?>">
				<span class="messages" id="message7"></span>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input type="submit" class="btn btn-primary" name="submitbtn" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
                <a href="javascript:history.go(-1)"><input type="button" class="btn btn-default" value="Back"></a>
            </div>
        </div>
    </form>
	</div>
	<hr>
</body>
</html>
<?php
try
{
	if(isset($_POST['submitbtn']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['staffEmail']);
		$password = $_POST['staffPassword'];
		$name = mysqli_real_escape_string($conn, $_POST['staffName']);
		$pnum = mysqli_real_escape_string($conn, $_POST['staffPnum']);
		$address = mysqli_real_escape_string($conn, $_POST['staffAddress']);
		$state = $_POST['staffState'];
		$city = mysqli_real_escape_string($conn, $_POST['staffCity']);
		$postcode = mysqli_real_escape_string($conn, $_POST['staffPostCode']);
		
		if(empty($email) || $email == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter an email&nbsp;\";
				document.getElementById(\"inputEmail\").focus();
			</script>";
			
			$error = true;
		}
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter a valid email&nbsp;\";
				document.getElementById(\"inputEmail\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($password) || $password == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message2\").innerHTML = \"&nbsp;Please enter a password&nbsp;\";
				document.getElementById(\"inputPassword\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($name) || $name == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please enter a name&nbsp;\";
				document.getElementById(\"fullName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($pnum) || $pnum == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message4\").innerHTML = \"&nbsp;Please enter a phone number&nbsp;\";
				document.getElementById(\"phoneNumber\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!is_numeric($pnum))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message4\").innerHTML = \"&nbsp;Please enter a valid phone number&nbsp;\";
				document.getElementById(\"phoneNumber\").focus();
			</script>";
			
			$error = true;
		}
		
		if(strlen((string)$pnum)<10)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message4\").innerHTML = \"&nbsp;Phone number must be at least 10 digit&nbsp;\";
				document.getElementById(\"PostCode\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($address) || $address == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message5\").innerHTML = \"&nbsp;Please enter an address&nbsp;\";
				document.getElementById(\"postalAddress\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($city) || $city == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message6\").innerHTML = \"&nbsp;Please enter a city&nbsp;\";
				document.getElementById(\"city\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($postcode) || $postcode == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message7\").innerHTML = \"&nbsp;Please enter a post code&nbsp;\";
				document.getElementById(\"PostCode\").focus();
			</script>";
			
			$error = true;
		}
		
		if(strlen((string)$postcode)!=5)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message7\").innerHTML = \"&nbsp;Post code length must be 5&nbsp;\";
				document.getElementById(\"PostCode\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!$error)
		{
			// Check for duplicate email.
			$sql = "SELECT * FROM staff WHERE staff_email = '$email'";
			$result = mysqli_query($conn, $sql);
			
			// Result exists.
			if(mysqli_num_rows($result) != 0)
			{
				echo"<script type=\"text/javascript\">
					document.getElementById(\"message1\").innerHTML = \"&nbsp;Email already exists&nbsp;\";
					document.getElementById(\"inputEmail\").focus();
				</script>";
			}
			
			else
			{
				// Encrypt $pass
				$pass2 = md5($password);
				
				$insert = "INSERT INTO staff (staff_email, staff_password, staff_name, staff_contact, staff_address, staff_city, staff_state, staff_postcode) VALUES ('$email', '$pass2', '$name', '$pnum', '$address', '$city', '$state', '$postcode')";
				$result2 = mysqli_query($conn, $insert);
				
				// Query failed.
				if(!$result2)
				{
					?>
					<br />
					<br />
					<div class="alert danger">
						<span class="closebtn">&times;</span>  
						<strong>Registration unsuccessful!</strong>
					</div>
					<?php
				}
				
				else
				{
					// Direct to view staff if successful.
					echo "<script type=\"text/javascript\">
						setTimeout(\"window.location='view_staff.php';\", 1);
					</script>";
				}
			}
		}
	}
}

catch(Exception $e)
{
	$e->getMessage();
}
?>      