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
<title>Admin - Add State</title>
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
		<h1>Add New State</h1>
		<span class="fail" id="message11"></span>
		<hr>
    <form name="addStateFrm" method="post" action="" class="form-horizontal">
		<div class="form-group">
            <label class="control-label col-xs-3" for="inputState">State:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="inputName" name="stateName"  maxlength="40" placeholder="State" value="<?php echo isset($_POST["stateName"]) ? $_POST["stateName"] : ''; ?>">
				<span class="messages" id="message1"></span>
            </div>
        </div>
		
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
		$error = false;
		$state = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($_POST['stateName']))));
		
		if(empty($state) || $state == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please do not leave blank on state name&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($state))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter a valid state&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
			
			$error = true;
		}
		
		$result =  mysqli_query($conn, "SELECT * FROM state WHERE state_name = '$state'");
		
		if(mysqli_num_rows($result) != 0)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;State already exists&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!$error)
		{
			$sql = mysqli_query($conn, "INSERT INTO state (state_name) VALUES ('$state');");
			
			if(!$sql)
			{
				echo "<script type=\"text/javascript\">
					document.getElementById(\"message11\").innerHTML = \"&nbsp;Failed to insert State&nbsp;\";
				</script>";
			}
			
			else
			{
				// Direct to view state if successful.
				echo "<script type=\"text/javascript\">
					setTimeout(\"window.location='view_state.php';\", 1);
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