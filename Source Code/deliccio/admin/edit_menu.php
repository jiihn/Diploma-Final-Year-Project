<?php
include "../dbconnection.php";
include "nav.php";
ob_start();


if ($_SESSION["aloggedin"] != 1)
{
	header("Location: login.php");
}

else if(!isset($_REQUEST["mid"]))
{
	echo "<script type=\"text/javascript\">
			setTimeout(\"window.location='view_menu.php';\", 1);
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
	
	$mid = $_REQUEST["mid"];
	
	$result2 = mysqli_query($conn, "SELECT * FROM menu where menu_id =$mid");
	$row2 = mysqli_fetch_assoc($result2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Edit Menu</title>
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
	
	img
	{
		width : 150px;
		height : 90px;
	}
</style>
</head> 
<body>
    <?php 
		$nav->header1();
	?>
	<div class="container">
		<h1>Edit Menu</h1>
		<span class="fail" id="message11"></span>
		<hr>
    <form name="editMenuFrm" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
	<h4>Upload Image</h4>
		<hr>
			<div class="form-group">
				<label class="control-label col-xs-3" for="inputPicture">Menu Picture:</label>
				<input type="file" class="form-control-file" name="newMenuPicture" id="inputPicture" aria-describedby="fileHelp">
				<small id="fileHelp" class="form-text text-muted">Only png. jpg. are allowed</small>
				<span class="messages" id="message6"></span>
			</div>
	<h4>Menu Information</h4>	
		<hr>
        <div class="form-group">
            <label class="control-label col-xs-3" for="MenuName">Menu Name:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="menuName" name="menuName" value="<?php echo $row2["menu_name"] ?>" >
				<span class="messages" id="message1"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-3" for="menuMainIngredient">Menu Main Ingredient:</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" id="menuMainIngredient" maxlength="30" name="menuMainIngredient" value="<?php echo $row2["menu_ingredient"] ?>">
				<span class="messages" id="message2"></span>
            </div>
        </div>
        
        
        <div class="form-group">
            <label class="control-label col-xs-3" for="inputPrice">Menu Price:</label>
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">RM</span>
                    <input type="text" name="menuPrice" id="inputPrice" class="form-control" value="<?php echo $row2["menu_price"] ?>" >
					<span class="messages" id="message3"></span>
                </div>
            </div>
        </div>
		<div class="form-group">
				<label class="control-label col-xs-3" for="menuDescription">Menu Description:</label>
				<div class="col-xs-4">
					<textarea class="form-control" name="menuDescription" id="menuDescription" rows="3"><?php echo $row2["menu_description"] ?></textarea>
					<span class="messages" id="message4"></span>
				</div>
			</div>
		<div class="form-group">
            <label class="control-label col-xs-3">Menu Spice Level:</label>
            <div class="col-xs-2">
                <select class="form-control" name="newMenuSpice">
					<option <?php echo ($row2["menu_spicelevel"] == 'None')?"selected":"" ?>>None</option>
					<option <?php echo ($row2["menu_spicelevel"] == 'Mild')?"selected":"" ?>>Mild</option>
					<option <?php echo ($row2["menu_spicelevel"] == 'Spicy')?"selected":"" ?>>Spicy</option>
                    <option <?php echo ($row2["menu_spicelevel"] == 'Extra Spicy')?"selected":"" ?>>Extra Spicy</option>
                </select>
            </div>
		</div>
		<div class="form-group">
            <label class="control-label col-xs-3">Category:</label>
            <div class="col-xs-2">
                <select class="form-control" name="menuCategory">
                    <?php
					$result5 = mysqli_query($conn, "SELECT * FROM category");
					while($row5 = mysqli_fetch_assoc($result5))
					{?>
						<option value="<?php echo $row5["category_id"] ?>" <?php if($row5["category_id"] == $row2["category_id"]) echo 'selected="selected"'; ?> ><?php echo $row5['category_name']?></option><?php
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
					while($row6 = mysqli_fetch_assoc($result))
					{?>
						<option value="<?php echo $row6["menutype_id"] ?>" <?php if($row6["menutype_id"] == $row2["menutype_id"]) echo 'selected="selected"'; ?> ><?php echo $row6['menutype_name']?></option><?php
					}?>
                </select>
            </div>
		</div>
        <br>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input type="submit" class="btn btn-primary" name="submitbtn" value="Save">
                <a href="view_menu.php"><input type="button" class="btn btn-default" value="Cancel"></a>
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
	if (isset($_POST['submitbtn']))
	{
		$error = false;
		$menuName = mysqli_real_escape_string($conn, $_POST['menuName']);
		$menuMainIngredient = mysqli_real_escape_string($conn, $_POST['menuMainIngredient']);
		$menuPrice = $_POST['menuPrice'];
		$menuSpiceLevel = $_POST['newMenuSpice'];
		$menuCategory = $_POST['menuCategory'];
		$menuType = $_POST['menuType'];
		$menuDescription = $_POST['menuDescription'];
		
		$errors= array();
		$file_name = $_FILES['newMenuPicture']['name'];
		$file_size =$_FILES['newMenuPicture']['size'];
		$file_tmp =$_FILES['newMenuPicture']['tmp_name'];
		$file_type=$_FILES['newMenuPicture']['type'];
		$value = explode(".", $_FILES['newMenuPicture']['name']);
		$file_ext=strtolower(array_pop($value));
		  
		$expensions= array("jpeg","jpg","png");
		  
		if(in_array($file_ext,$expensions)=== false)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message6\").innerHTML = \"&nbsp;Extension not allowed, please choose a JPEG or PNG file&nbsp;\";
				document.getElementById(\"inputPicture\").focus();
			</script>";
			echo mysqli_error($conn);
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
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please do not leave blank on menu name&nbsp;\";
				document.getElementById(\"menuName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($menuName))
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter a valid menu name&nbsp;\";
				document.getElementById(\"menuName\").focus();
			</script>";
			
			$error = true;
		}
		
		if(empty($menuMainIngredient) || $menuMainIngredient == "")
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message2\").innerHTML = \"&nbsp;Please do not leave blank on menu main ingredient&nbsp;\";
				document.getElementById(\"menuMainIngredient\").focus();
			</script>";
			
			$error = true;
		}
		
		if(is_numeric($menuMainIngredient))
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message2\").innerHTML = \"&nbsp;Please enter a valid menu main ingredient&nbsp;\";
				document.getElementById(\"menuMainIngredient\").focus();
			</script>";
			
			$error = true;
		}
				
		if(empty($menuPrice) || $menuPrice == "")
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please do not leave blank on menu price&nbsp;\";
				document.getElementById(\"inputPrice\").focus();
			</script>";
			
			$error = true;
		}
		
		if(!is_numeric($menuPrice))
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"&nbsp;Please enter a valid menu price&nbsp;\";
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
			$insert = ("UPDATE menu SET menu_name = '$menuName', menu_ingredient = '$menuMainIngredient', menu_price = '$menuPrice', 
			menu_spicelevel = '$menuSpiceLevel', category_id = $menuCategory, menutype_id = $menuType, menu_path = '$path', menu_description = '$menuDescription'
			WHERE menu_id = $mid");
			echo $insert;
			$result2 = mysqli_query($conn, $insert);
			
			// Query failed.
			if(!$result2)
			{
				echo "<script type=\"text/javascript\">
					document.getElementById(\"message11\").innerHTML = \"&nbsp;Update menu detail fail&nbsp;\";
				</script>";
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