<?php
include "nav.php";
include ("dbconnection.php");

if ($_SESSION["loggedin"] != 1)
{
	header("Location: login.php");
}

else
{
	$nav = new navigation($conn);

	$sess_memid = $_SESSION["sess_memid"]; 

	$result = mysqli_query($conn, "SELECT * FROM member WHERE member_id = $sess_memid");
	$row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Edit Profile</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script src="js/jquery-1.6.js" ></script>
<script src="js/cufon-yui.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/Forum_400.font.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/tms-0.3.js"></script>
<script src="js/tms_presets.js"></script>
<script src="js/script.js"></script>
<script src="js/atooltip.jquery.js"></script>

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
.main-wrapper
{
	border : 1px solid black;
	width : 920px;
	overflow : auto;
	margin : 0 auto;
	padding : 20px;
	background-color : rgba(255, 255, 255,0.8);
	margin-bottom : 10px;
	border-radius : 10px;
}

.left-content
{
	border : 1px solid black;
	float : left;
	padding : 10px;
	margin-right : 10px;
}

.left-content h3
{
	border-bottom : 1px solid silver;
}

.right-content
{
	border : 1px solid black;
	float : left;
	padding : 10px;
	width : 650px;
}

.right-content h3
{
	border-bottom : 1px solid silver;
}

.right-content input
{
	
	border : 1px solid black;
	width : 200px;
	padding : 7px;
}

.right-content select
{
	
	border : 1px solid black;
	width : 200px;
	padding : 7px;
}

.right-content input[type=text]:focus
{
	background-color : #f1ff96;
}

input[type=submit]
{
	border-radius : 2px;
	width : 100px;
	height : 30px;
	background-color : #1d59ba;
	color : white;
}

input[type=button]
{
	border-radius : 2px;
	width : 100px;
	height : 30px;
	background-color : #f44242;
	color : white;
}

input[type=submit]:hover
{
	background-color : #2870e2;
	color : white;
	cursor : pointer;
}

input[type=button]:hover
{
	background-color : #ff2d2d;
	color : white;
	cursor : pointer;
}
</style>

<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<style type="text/css">.slider_bg {behavior:url("js/PIE.htc")}</style>
<![endif]-->
</head>
<?php 
$nav->header1($conn);?>
        <!-- / header -->
		
		<div class="main-wrapper">
		
			<div class="left-content">
				<h3>Account Dashboard</h3>
				<ul>
					<a href="profile_edit.php"><li><img src="images/personal-info-icon.png" style="width : 20px; height : 20px; float : left; margin-right : 5px;"/>Personal Information</li></a>
					<a href="view_order_details.php"><li><img src="images/order-history.png" style="width : 20px; height : 20px; float : left; margin-right : 5px;"/>Order History</li></a>
				</ul>
			</div>
			
			<div class="right-content">
			<fieldset>
				<form name = "editfrm" method = "POST" action = "">
					<h3>Personal Information</h3>
					<p>
					<br />
					<b><label>Name			: </label></b>
					<input type="text" name="memberName" value="<?php echo $row["member_name"]; ?>" />
					
					<br />
					<br />
					
					<b><label>Email			: </label></b>
					<input type="text" name="memberEmail" value="<?php echo $row["member_email"]; ?>" />
					
					<br />
					<br />
					
					<b><label>Contact	: </label></b>
					<input type="text" name="memberContact" value="<?php echo $row["member_contact"]; ?>" />
					
					<br />
					<br />
					
					<b><label>Address	: </label></b>
					<input type="text" name="memberAddress" value="<?php echo $row["member_address"]; ?>" />
					
					<br />
					<br />
					
					<b><label>Postcode	: </label></b>
					<input type="text" name="memberPostcode" maxlength="5" value="<?php echo $row["member_postcode"]; ?>" />
					
					<br />
					<br />
					
					<b><label>State	: </label></b>
						<select name="memberState">
							<option value=" ">None</option>
							<?php
							$result3 = mysqli_query($conn, "SELECT * FROM state");
							while($row3 = mysqli_fetch_assoc($result3))
							{?>
								<option value="<?php echo $row3['state_name'];?>"<?php if($row3['state_name'] == $row['member_state']) echo 'selected="selected"'; ?> ><?php echo $row3['state_name']?></option><?php
							}?>
						</select>
						
					<br />
					<br />
					
					<b><label>City	: </label></b>
						<select name="memberCity">
							<option value=" ">None</option>
							<?php
							$result2 = mysqli_query($conn, "SELECT * FROM city");
							while($row2 = mysqli_fetch_assoc($result2))
							{?>
								<option value="<?php echo $row2['city_name'];?>"<?php if($row2['city_name'] == $row['member_city']) echo 'selected="selected"'; ?> ><?php echo $row2['city_name']?></option><?php
							}?>
						</select>
					</p>
					
					<input type="submit" name="savebtn" value="Save Changes" />
					<a href="javascript:history.go(-1)"><input type="button" class="btn btn-default" value="Back"></a>
				</form>
				</fieldset>
			</div>	
			
		</div>  

	</div>
  </div>		
		
<?php $nav->footer2() ?>
</body>
</html>

<?php
try
{
	if(isset($_POST["savebtn"]))
	{
		$name = $_POST["memberName"];
		$email = $_POST["memberEmail"];
		$cNumber = $_POST["memberContact"];
		$address = $_POST['memberAddress'];
		$postcode = $_POST['memberPostcode'];
		$state = $_POST['memberState'];
		$city = $_POST['memberCity'];
		
		if(empty($name) && empty($email))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter a name and email</p>
				</div>
			<?php
		}
		
		else if(empty($name))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter a name</p>
				</div>
			<?php
		}
		
		else if(empty($email))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter a email</p>
				</div>
			<?php
		}
		
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter a valid email</p>
				</div>
			<?php
		}
		
		else if (!is_numeric($cNumber))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter a valid contact number</p>
				</div>
			<?php
		}
		
		else if(empty($address))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter an address</p>
				</div>
			<?php
		}
		
		else if(empty($postcode))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter a post code</p>
				</div>
			<?php
		}
		
		else if(!is_numeric($postcode))
		{
			?>
				<div id="dialog" title="Alert">
				<p>Please enter a valid post code</p>
				</div>
			<?php
		}
		
		else
		{
			$result = mysqli_query($conn, "UPDATE member SET 
			member_name = '$name', member_email = '$email', member_contact = $cNumber, 
			member_address = '$address', member_postcode = $postcode, member_state = '$state', 
			member_city = '$city' 
			WHERE member_id = $sess_memid");
			
			if (!$result)
			{
				?>
					<div id="dialog" title="Alert">
					<p>Update Failed</p>
					</div>
				<?php
				echo mysqli_error($conn);
				
				/* echo "<script type=\"text/javascript\">
					alert(\"Update failed\");
				</script>"; */
			}
			
			else
			{
				$result = mysqli_query($conn, "SELECT member_name FROM member WHERE member_id = $sess_memid");
				if (!$result)
				{
					echo mysqli_error($conn);
				}
				
				else
				{
					?>
						<div id="dialog" title="Alert">
						<p>Update Successful</p>
						</div>
					<?php
					
					echo "<script type=\"text/javascript\">
						 setTimeout(\"location.href = 'profile.php';\",3000);
					</script>";
				}
			}
		}
	}
}

catch (Exception $e)
{
	$e->getMessage();
}
?>
