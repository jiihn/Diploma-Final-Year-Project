<?php
include "../dbconnection.php";
include "nav.php";
ob_start();


if ($_SESSION["aloggedin"] != 1)
{
	header("Location: login.php");
}

else if(!isset($_REQUEST["mtid"]))
{
	echo "<script type=\"text/javascript\">
			setTimeout(\"window.location='view_category.php';\", 1);
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
	
	$mtid = $_REQUEST["mtid"];
	
	$result2 = mysqli_query($conn, "SELECT * FROM menuType where menutype_id =$mtid");
	$row2 = mysqli_fetch_assoc($result2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Edit Menu Type</title>
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
		<h1>Edit Menu Type</h1>
		<span class="fail" id="message11"></span>
		<hr>
    <form name="editMenuTypeFrm" method="post" action="" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-xs-3" for="menuTypeName">Menu Type Name:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="menuTypeName" name="menuTypeName" placeholder="<?php echo $row2["menutype_name"] ?>" value="">
				<span class="messages" id="message3"></span>
            </div>
        </div>
        <br>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input type="submit" class="btn btn-primary" name="submitbtn" value="Save">
                <a href="view_menuType.php"><input type="button" class="btn btn-default" value="Cancel"></a>
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
		$mtName = mysqli_real_escape_string($conn, $_POST['menuTypeName']);
		
		if(empty($mtName) || $mtName == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please do not leave blank on menu type name&nbsp;\";
				document.getElementById(\"menuTypeName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($mtName))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please enter a valid menu type name&nbsp;\";
				document.getElementById(\"menuTypeName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!$error)
		{
			$insert = ("UPDATE menutype SET menutype_name = '$mtName' WHERE menutype_id = $mtid");
			$result2 = mysqli_query($conn, $insert);
			
			// Query failed.
			if(!$result2)
			{
				echo "<script type=\"text/javascript\">
					document.getElementById(\"message11\").innerHTML = \"&nbsp;Update menu type detail fail&nbsp;\";
				</script>";
			}
			
			else
			{
				// Direct to view menu type if successful.
				echo "<script type=\"text/javascript\">
					setTimeout(\"window.location='view_menuType.php';\", 1);
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