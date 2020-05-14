<?php
include "../dbconnection.php";
include "nav.php";
ob_start();


if ($_SESSION["aloggedin"] != 1)
{
	header("Location: login.php");
}

else if(!isset($_REQUEST["id"]))
{
	echo "<script type=\"text/javascript\">
			setTimeout(\"window.location='profile.php';\", 1);
	</script>";
}

else
{
	$nav = new navigation();
	
	if($_SESSION['access'] == 1)
	{
		$type = 'admin';
	}
	
	else
	{
		$type = 'staff';
	}

	$sess_id = $_SESSION["sess_id"];

	$result = mysqli_query($conn, "SELECT * FROM $type where ".$type."_id = $sess_id");
	$row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Edit Profile</title>
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
	
	.fail
	{
		background-color: #fc5555;
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
		<h1>Edit Profile</h1>
		<span class="fail" id="message11"></span>
		<hr>
    <form name="editProfileFrm" method="post" action="" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-xs-3" for="inputEmail">Email:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="inputEmail" name="newEmail" maxlength="40" placeholder="<?php echo $row[$type."_email"] ?>" value="">
				<span class="messages" id="message1"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="fullName">Full Name:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="fullName" name="newName" maxlength="40" placeholder="<?php echo $row[$type."_name"] ?>" value="">
				<span class="messages" id="message3"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="phoneNumber">Phone:</label>
            <div class="col-xs-4">
                <input type="tel" class="form-control" id="phoneNumber" maxlength="12" name="newPnum" placeholder="<?php echo $row[$type."_contact"] ?>" value="">
				<span class="messages" id="message4"></span>
            </div>
        </div>
        
        
        <div class="form-group">
            <label class="control-label col-xs-3" for="postalAddress">Address:</label>
            <div class="col-xs-4">
                <textarea rows="3" class="form-control" id="postalAddress" name="newAddress" placeholder="<?php echo $row[$type."_address"] ?>"></textarea>
				<span class="messages" id="message5"></span>
            </div>
        </div>
		<div class="form-group">
            <label class="control-label col-xs-3">State:</label>
            <div class="col-xs-2">
                <select class="form-control" name="newState">
					<option <?php echo ($row[$type."_state"] == 'Johor')?"selected":"" ?>>Johor</option>
					<option <?php echo ($row[$type."_state"] == 'Kedah')?"selected":"" ?>>Kedah</option>
                    <option <?php echo ($row[$type."_state"] == 'Kelantan')?"selected":"" ?>>Kelantan</option>
                    <option <?php echo ($row[$type."_state"] == 'Melaka')?"selected":"" ?>>Melaka</option>
                    <option <?php echo ($row[$type."_state"] == 'Negeri Sembilan')?"selected":"" ?>>Negeri Sembilan</option>
                    <option <?php echo ($row[$type."_state"] == 'Pahang')?"selected":"" ?>>Pahang</option>
                    <option <?php echo ($row[$type."_state"] == 'Perak')?"selected":"" ?>>Perak</option>
                    <option <?php echo ($row[$type."_state"] == 'Perlis')?"selected":"" ?>>Perlis</option>
                    <option <?php echo ($row[$type."_state"] == 'Penang')?"selected":"" ?>>Penang</option>
                    <option <?php echo ($row[$type."_state"] == 'Sabah')?"selected":"" ?>>Sabah</option>
                    <option <?php echo ($row[$type."_state"] == 'Sarawak')?"selected":"" ?>>Sarawak</option>
                    <option <?php echo ($row[$type."_state"] == 'Selangor')?"selected":"" ?>>Selangor</option>
                    <option <?php echo ($row[$type."_state"] == 'Terengganu')?"selected":"" ?>>Terengganu</option>
                </select>
            </div>
		</div>
		<div class="form-group">
            <label class="control-label col-xs-3">City:</label>
            <div class="col-xs-4">
                <input type="tel" class="form-control" id="city" name="newCity" maxlength="20" placeholder="<?php echo $row[$type."_city"] ?>" value="">
				<span class="messages" id="message6"></span>
            </div>
		</div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="PostCode">Post Code:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="PostCode" maxlength="5" name="newPostCode" placeholder="<?php echo $row[$type."_postcode"] ?>" value="">
				<span class="messages" id="message7"></span>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input type="submit" class="btn btn-primary" name="submitbtn" value="Save">
                <a href="profile.php"><input type="button" class="btn btn-default" value="Cancel"></a>
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
		$error = false;
		$email = mysqli_real_escape_string($conn, $_POST['newEmail']);
		$name = mysqli_real_escape_string($conn, $_POST['newName']);
		$pnum = mysqli_real_escape_string($conn, $_POST['newPnum']);
		$address = mysqli_real_escape_string($conn, $_POST['newAddress']);
		$state = $_POST['newState'];
		$city = mysqli_real_escape_string($conn, $_POST['newCity']);
		$postcode = mysqli_real_escape_string($conn, $_POST['newPostCode']);
		
		if(empty($email) || $email == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please do not leave blank on email&nbsp;\";
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
		
		if(empty($name) || $name == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please do not leave blank on name&nbsp;\";
				document.getElementById(\"fullName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($name))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Only letters are allowed&nbsp;\";
				document.getElementById(\"fullName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($pnum) || $pnum == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message4\").innerHTML = \"&nbsp;Please do not leave blank on phone&nbsp;\";
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
				document.getElementById(\"message5\").innerHTML = \"&nbsp;Please do not leave blank on address&nbsp;\";
				document.getElementById(\"postalAddress\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($city) || $city == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message6\").innerHTML = \"&nbsp;Please do not leave blank on city&nbsp;\";
				document.getElementById(\"city\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($city))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message6\").innerHTML = \"&nbsp;Only letters are allowed&nbsp;\";
				document.getElementById(\"city\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($postcode) || $postcode == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message7\").innerHTML = \"&nbsp;Please do not leave blank on post code&nbsp;\";
				document.getElementById(\"PostCode\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!is_numeric($postcode))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message7\").innerHTML = \"&nbsp;Only numbers are allowed&nbsp;\";
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
			$insert = ("UPDATE ".$type." SET ".$type."_email = '$email', ".$type."_name = '$name', ".$type."_contact = '$pnum', ".$type."_address = '$address', ".$type."_city = '$city', ".$type."_state = '$state', ".$type."_postcode = '$postcode' WHERE ".$type."_id = $sess_id");
			$result2 = mysqli_query($conn, $insert);
			
			// Query failed.
			if(!$result2)
			{
				echo "<script type=\"text/javascript\">
					document.getElementById(\"message11\").innerHTML = \"&nbsp;Update personal detail fail&nbsp;\";
				</script>";
			}
			
			else
			{
				// Direct to profile if successful.
				echo "<script type=\"text/javascript\">
					setTimeout(\"window.location='profile.php';\", 1);
				</script>";
			}
		}
	}
}

catch(Exception $e)
{
	$e->getMessage();
}
?>