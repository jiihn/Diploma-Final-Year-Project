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
<title>Admin - Add Category</title>
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
<?php 
	$nav->header1();
?>
	<div class="container">
		<h1>Add New Category</h1>
		<span class="fail" id="message11"></span>
		<hr>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Category Info</a></li>
	</ul>
	
	<h4>General Infomation</h4>
	<hr>
    <form name="generalInfoFrm" class="form-horizontal" method="post">
        <div class="form-group">
            <label class="control-label col-xs-3" for="inputName">Category Name:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="cateName" id="inputName" value="<?php echo isset($_POST["cateName"]) ? $_POST["cateName"] : ''; ?>">
				<span class="messages" id="message1"></span>
            </div>
        </div>
	<div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input type="submit" class="btn btn-primary" name="submitbtn" value="Confirm">
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
		$cate_name = mysqli_real_escape_string($conn, $_POST['cateName']);
		
		if(empty($cate_name) || $cate_name == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please do not leave blank on category name&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($cate_name))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter a valid category name&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!$error)
		{
			$result = mysqli_query($conn, "INSERT INTO category (category_name) VALUES ('$cate_name')");
			
			if(!$result)
			{
				echo "<script type=\"text/javascript\">
					document.getElementById(\"message11\").innerHTML = \"&nbsp;Failed to insert category&nbsp;\";
				</script>";
			}
				
			else
			{
				// Direct to view category if successful.
				echo "<script type=\"text/javascript\">
					setTimeout(\"window.location='view_category.php';\", 1);
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