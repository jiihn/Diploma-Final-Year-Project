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
<title>Admin - Add Menu</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
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
		<h1>Add New Menu</h1>
		<span class="fail" id="message11"></span>
		<hr>
    <ul class="nav nav-tabs">
		<li class="active"><a href="#">Menu Info</a></li>
	</ul>
	<div id="GIbox">
		<form name="generalInfoFrm" action="" class="form-horizontal" method="post" enctype="multipart/form-data">
		<h4>Upload Image</h4>
		<hr>
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputPicture">Menu Picture:</label>
				<input type="file" class="form-control-file" name="menuPicture" id="inputPicture" aria-describedby="fileHelp">
				<small id="fileHelp" class="form-text text-muted">Only png. jpg. are allowed</small>
				<span class="messages" id="message6"></span>
			</div>
				
		<h4>General Infomation</h4>
		<hr>
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputName">Menu Name:</label>
				<div class="col-xs-4">
					<input type="text" class="form-control" name="menuName" id="inputName" value="<?php echo isset($_POST["menuName"]) ? $_POST["menuName"] : ''; ?>">
					<span class="messages" id="message1"></span>
			   </div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputMainIngredient">Menu Main Ingredient:</label>
				<div class="col-xs-4">
					<input type="text" class="form-control" name="menuIngredient" id="inputMainIngredient" value="<?php echo isset($_POST["menuIngredient"]) ? $_POST["menuIngredient"] : ''; ?>">
					<span class="messages" id="message2"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputPrice">Menu Price:</label>
				<div class="col-xs-4">
					<div class="input-group">
						<span class="input-group-addon">RM</span>
						<input type="text" name="menuPrice" id="inputPrice" class="form-control" value="<?php echo isset($_POST["menuPrice"]) ? $_POST["menuPrice"] : ''; ?>">
						<span class="messages" id="message3"></span>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-xs-3" for="menuDescription">Menu Description:</label>
				<div class="col-xs-4">
					<textarea class="form-control" name="menuDescription" id="menuDescription" rows="3"></textarea>
					<span class="messages" id="message4"></span>
				</div>
			</div>
		
		<h4>Other Infomation</h4>
		<hr>
			<div class="form-group">
				<label class="control-label col-xs-3">Category:</label>
				<div class="col-xs-2">
					<select class="form-control" name="menuCategory">
						<?php
						$result = mysqli_query($conn, "SELECT * FROM category");
						while($row = mysqli_fetch_assoc($result))
						{?>
							<option value="<?php echo $row['category_id']?>"><?php echo $row['category_name']?></option><?php
						}?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Menu Type:</label>
				<div class="col-xs-2">
					<select class="form-control" name="menuType">
						<?php
						$result = mysqli_query($conn, "SELECT * FROM menutype");
						while($row = mysqli_fetch_assoc($result))
						{?>
							<option value="<?php echo $row['menutype_id']?>"><?php echo $row['menutype_name']?></option><?php
						}?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-xs-3">Menu Spice Level:</label>
				<div class="col-xs-2">
					<select class="form-control" name="menuSpiceLevel">
						<option name="menuSpiceLevel" value="None">None</option>
						<option name="menuSpiceLevel" value="Mild">Mild</option>
						<option name="menuSpiceLevel" value="Spicy">Spicy</option>
						<option name="menuSpiceLevel" value="Extra Spicy">Extra Spicy</option>
					</select>
				</div>
			</div>

			<div class="form-group">
			<div class="col-xs-offset-3 col-xs-9">
				  <input type="submit" class="btn btn-primary" name="submitbtn" value="Save">
				  <a href="javascript:history.go(-1)"><input type="button" class="btn btn-default" value="Back"></a>
			</div>
			</div>
		</form>
	</div>
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
		$menuName = mysqli_real_escape_string($conn, $_POST['menuName']);
		$menuIngredient = mysqli_real_escape_string($conn, $_POST['menuIngredient']);
		$menuPrice = mysqli_real_escape_string($conn, $_POST['menuPrice']);
		$menuSpiceLevel = $_POST['menuSpiceLevel'];
		$menuCategory = $_POST['menuCategory'];
		$menuType = $_POST['menuType'];
		$menuDescription = $_POST['menuDescription'];
		
		$errors= array();
		$file_name = $_FILES['menuPicture']['name'];
		$file_size =$_FILES['menuPicture']['size'];
		$file_tmp =$_FILES['menuPicture']['tmp_name'];
		$file_type=$_FILES['menuPicture']['type'];
		$value = explode(".", $_FILES['menuPicture']['name']);
		$file_ext=strtolower(array_pop($value));
		  
		$expensions= array("jpeg","jpg","png");
		  
		if(in_array($file_ext,$expensions)=== false)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message6\").innerHTML = \"&nbsp;Extension not allowed, please choose a JPEG or PNG file&nbsp;\";
				document.getElementById(\"inputPicture\").focus();
			</script>";
			
			$error = true;
		}
		  
		if($file_size > 2097152)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message6\").innerHTML = \"&nbsp;File size must be not more than 2 MB&nbsp;\";
				document.getElementById(\"inputPicture\").focus();
			</script>";
			
			$error = true;
		}
		  
		if(empty($errors)==true)
		{
			move_uploaded_file($file_tmp,"menuImages/".$file_name);
			$path = "menuImages/" . basename($file_name);
		}
		
		else
		{
			print_r($errors);
		}
		
		if(empty($menuName) || $menuName == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please do not leave blank on menu name&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($menuName))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter a valid name&nbsp;\";
				document.getElementById(\"inputName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($menuIngredient) || $menuIngredient == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message2\").innerHTML = \"&nbsp;Please do not leave blank on ingredient&nbsp;\";
				document.getElementById(\"inputMainIngredient\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($menuIngredient))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message2\").innerHTML = \"&nbsp;Please enter a valid ingredient name&nbsp;\";
				document.getElementById(\"inputMainIngredient\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($menuPrice) || $menuPrice == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please do not leave blank on menu price&nbsp;\";
				document.getElementById(\"inputPrice\").focus();
			</script>";
			
			$error = true;
		}
		
		if($menuPrice == 0)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please enter another amount besides zero&nbsp;\";
				document.getElementById(\"inputPrice\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!is_numeric($menuPrice))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please enter a valid price&nbsp;\";
				document.getElementById(\"inputPrice\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($menuDescription) || $menuDescription == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message4\").innerHTML = \"&nbsp;Please enter a menu description&nbsp;\";
				document.getElementById(\"menuDescription\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!$error)
		{
			$insert = "INSERT INTO menu (menu_name, menu_ingredient, menu_price, menu_spicelevel, category_id, menutype_id, menu_path, menu_description) VALUES ('$menuName', '$menuIngredient', $menuPrice, '$menuSpiceLevel', '$menuCategory', '$menuType', '$path', '$menuDescription')";
			$result2 = mysqli_query($conn, $insert);
				
			// Query failed.
			if(!$result2)
			{
				echo "<script type=\"text/javascript\">
					document.getElementById(\"message11\").innerHTML = \"&nbsp;Failed to insert Menu&nbsp;\";
				</script>";
				echo mysqli_error($conn);
			}
			
			else
			{
				// Direct to view menu if successful.
				echo "<script type=\"text/javascript\">
					setTimeout(\"window.location='view_menu.php';\", 1);
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