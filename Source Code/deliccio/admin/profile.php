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

	if($_SESSION['access'] == 1)
	{
		$type = 'admin';
	}
	
	else
	{
		$type = 'staff';
	}
	
	$sess_id = $_SESSION["sess_id"];

	$result = mysqli_query($conn, "SELECT * FROM ".$type." WHERE ".$type."_id = $sess_id");
	
	if($result)
	{	
		$row = mysqli_fetch_assoc($result);
	}
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
<style type="text/css">
	.navbar{
		margin-top: 20px;
	}
</style>
</head> 
<body>
<?php
$nav->header1();
?>
</div>
<div class="container">
	<div class="col-xs-4">
			<h3 style="border-bottom : 1px solid silver;">Personal Information</h3>
			<p><strong>Email : </strong><?php echo $row[$type.'_email']; ?></p>
			<p style="text-transform : capitalize"><strong>Name : </strong><?php echo $row[$type.'_name']; ?></p>
			<p><strong>Contact : </strong><?php echo $row[$type.'_contact']; ?></p>
			<p style="text-transform : capitalize"><strong>Address : </strong><?php echo $row[$type.'_address']; ?></p>
			<p style="text-transform : capitalize"><strong>State : </strong><?php echo $row[$type.'_state']; ?></p>
			<p style="text-transform : capitalize"><strong>City : </strong><?php echo $row[$type.'_city']; ?></p>
			<p><strong>Postcode : </strong><?php echo $row[$type.'_postcode']; ?></p>
			<p><a href="edit_profile.php?id=<?php echo $row[$type.'_id']; ?>" class="btn btn-default">Edit &raquo;</a></p>
	</div>
	<div class="col-xs-4">
			<h3 style="border-bottom : 1px solid silver;">Security Details</h3>
			<p><strong>Password : </strong>******</p>
			<p><strong>Security Question 1 : </strong>******</p>
			<p><strong>Security Question 2 : </strong>******</p>
			<p><a href="edit_security.php?id=<?php echo $row[$type.'_id']; ?>" class="btn btn-default">Edit &raquo;</a></p>
	</div>
</div>
<hr>
</body>
</html> 