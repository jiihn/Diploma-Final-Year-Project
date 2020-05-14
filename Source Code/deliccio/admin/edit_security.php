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
<title>Admin - Edit Security</title>
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
			<h1>Edit Security</h1>
			<span class="fail" id="message11"></span>
			<hr>
		<form name="editSecurityFrm" method="post" action="" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputEmail">Old Password:</label>
				<div class="col-xs-4">
					<input type="password" class="form-control" id="inputOldPass" name="oldPass" maxlength="12" placeholder="Old Password" value="<?php echo isset($_POST["oldPass"]) ? $_POST["oldPass"] : ''; ?>">
					<span class="messages" id="message1"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputEmail">New Password:</label>
				<div class="col-xs-4">
					<input type="password" class="form-control" id="inputNewPass" name="newPass" maxlength="12" placeholder="New Password" value="<?php echo isset($_POST["newPass"]) ? $_POST["newPass"] : ''; ?>">
					<span class="messages" id="message2"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputEmail">Confirm New Password:</label>
				<div class="col-xs-4">
					<input type="password" class="form-control" id="inputConNewPass" name="conNewPass" maxlength="12" placeholder="Confirm New Password" value="<?php echo isset($_POST["conNewPass"]) ? $_POST["conNewPass"] : ''; ?>">
					<span class="messages" id="message3"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-offset-3 col-xs-9">
					<input type="submit" class="btn btn-primary" name="submitbtn" value="Submit">
					<a href="profile.php"><input type="button" class="btn btn-default" value="Cancel"></a>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
<?php
try
{
	if(isset($_POST['submitbtn']))
	{
		$error = false;
		$oldPass = $_POST['oldPass'];
		$newPass = $_POST['newPass'];
		$conNewPass = $_POST['conNewPass'];
		
		if(empty($oldPass) || $oldPass == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Blank password input&nbsp;\";
				document.getElementById(\"inputOldPass\").focus();
			</script>";
		}
		
		else
		{
			$oldPassword = md5($oldPass);
			$result = mysqli_query($conn, "SELECT * FROM ".$type." WHERE ".$type."_id = $sess_id AND ".$type."_password = '$oldPassword'");
			$row = mysqli_fetch_assoc($result);
				
			if(mysqli_num_rows($result) == 0)
			{
				echo"<script type=\"text/javascript\">
					document.getElementById(\"message1\").innerHTML = \"&nbsp;Wrong password&nbsp;\";
					document.getElementById(\"inputOldPass\").focus();
				</script>";
				
				$error = true;
			}
			
			else
			{
				if(empty($newPass))
				{
					echo"<script type=\"text/javascript\">
						document.getElementById(\"message2\").innerHTML = \"&nbsp;Blank password input&nbsp;\";
						document.getElementById(\"inputNewPass\").focus();
					</script>";
					
					$error = true;
				}
				
				if(empty($conNewPass))
				{
					echo"<script type=\"text/javascript\">
						document.getElementById(\"message3\").innerHTML = \"&nbsp;Blank password input&nbsp;\";
						document.getElementById(\"inputConNewPass\").focus();
					</script>";
					
					$error = true;
				}
				
				if($conNewPass != $newPass)
				{
					echo"<script type=\"text/javascript\">
						document.getElementById(\"message2\").innerHTML = \"&nbsp;Password does not match&nbsp;\";
						document.getElementById(\"message3\").innerHTML = \"&nbsp;Password does not match&nbsp;\";
						document.getElementById(\"inputNewPass\").focus();
					</script>";
					
					$error = true;
				}
				
				if(!$error)
				{
					$newPassword = md5($newPass);
					$conNewPassword = md5($conNewPass);
					$insert = ("UPDATE ".$type." SET ".$type."_password = '$newPassword' WHERE ".$type."_id = $sess_id");
					$result2 = mysqli_query($conn, $insert);
					
					if(!$result2)
					{
						echo "<script type=\"text/javascript\">
							document.getElementById(\"message11\").innerHTML = \"&nbsp;Update password fail&nbsp;\";
						</script>";
					}
					
					else
					{
						echo "<script type=\"text/javascript\">
							setTimeout(\"window.location='profile.php';\", 1);
						</script>";
					}
				}
			}
		}
	}
}

catch(Exception $e)
{
	$e->getMessage($e);
}
?>