<?php
include "../dbconnection.php";
include "nav.php";
ob_start();

if ($_SESSION["aloggedin"] != 1)
{
	header("Location: login.php");
}

else
{
	$nav = new navigation();

	$sess_id = $_SESSION["sess_id"];
	
	$result = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $sess_id");
	if($result)
	{	
		$row = mysqli_fetch_assoc($result);
	}
	
	else
	{
		$result2 = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id = $sess_id");
		if($result2)
		{
			
			$row2 = mysqli_fetch_assoc($result2);
			
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Add Menu Type</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
<div class="bs-example">
<?php
	$nav->header1();
?>
	<div class="container">
		<h1>Add New Menu Type</h1>
		<span class="fail" id="message11"></span>
		<hr>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Menu type Info</a></li>
	</ul>
	
	<h4>General Infomation</h4>
	<hr>
    <form name="generalInfoFrm" class="form-horizontal" method="post">
        <div class="form-group">
            <label class="control-label col-xs-3" for="inputName">Menu Type Name:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="menuTypeName" id="inputName" value="<?php echo isset($_POST["menuTypeName"]) ? $_POST["menuTypeName"] : ''; ?>">
				<span class="messages" id="message1"></span>
            </div>
        </div>
	<div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input type="submit" name="submitbtn" class="btn btn-primary" value="Save">
                <input type="reset" class="btn btn-default" value="Reset">
				<a href="javascript:history.go(-1)"><input type="button" class="btn btn-default" value="Back"></a>
            </div>
        </div>
    </form>
	
	<hr>
	</div>
</body>
</html>
<?php
try
{
	if(isset($_POST['submitbtn']))
	{
		$menuTypeName = mysqli_real_escape_string($conn, $_POST['menuTypeName']);
		
		if(empty($menuTypeName) || $menuTypeName == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please do not leave blank on menu type name&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
		}
		
		else
		{
			$result = mysqli_query($conn, "INSERT INTO menutype (menutype_name) VALUES ('$menuTypeName')");
			
			if(!$result)
			{
				echo "<script type=\"text/javascript\">
					document.getElementById(\"message11\").innerHTML = \"&nbsp;Failed to insert Menu Type&nbsp;\";
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

catch(exception $e)
{
	$e->getMessage();
}
?>   