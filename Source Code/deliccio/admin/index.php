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
	$user = "";
	
	$nav = new navigation();

	$sess_id = $_SESSION["sess_id"]; 
	
	$sql = mysqli_query($conn, "SELECT * FROM staff");
	$num = mysqli_num_rows($sql);
	
	$sql2 = mysqli_query($conn, "SELECT * FROM menu");
	$num2 = mysqli_num_rows($sql2);
	
	$sql3 = mysqli_query($conn, "SELECT * FROM category");
	$num3 = mysqli_num_rows($sql3);
	
	$sql4 = mysqli_query($conn, "SELECT * FROM menutype");
	$num4 = mysqli_num_rows($sql4);
	
	$sql5 = mysqli_query($conn, "SELECT * FROM purchase GROUP BY purchase_date, purchase_time, member_id");
	$num5 = mysqli_num_rows($sql5);
	
	$sql6 = mysqli_query($conn, "SELECT * FROM state");
	$num6 = mysqli_num_rows($sql6);
	
	$sql7 = mysqli_query($conn, "SELECT * FROM city");
	$num7 = mysqli_num_rows($sql7);
	
	$sql8 = mysqli_query($conn, "SELECT * FROM gst");
	$num8 = mysqli_num_rows($sql8);
	
	$sql9 = mysqli_query($conn, "SELECT * FROM member");
	$num9 = mysqli_num_rows($sql9);

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = $sess_id");
	if($result)
	{	
		$row = mysqli_fetch_assoc($result);
		
		$user = "Admin";
	}
	
	else
	{
		$result2 = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id = $sess_id");
		if($result2)
		{
			
			$row2 = mysqli_fetch_assoc($result2);
			
			$user = "Staff";
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
<title>Admin - Dashboard</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style type="text/css">
	.navbar{
		margin-top: 20px;
	}
	
	.page-header h2
	{
		background: linear-gradient(to right, #efefef, #ffffff);
		border-radius : 10px;
	}
	
	.col-xs-4 img
	{
		width : 50px;
		height : 50px;
		margin-bottom : 10px;
		background : #8ac7db;
	}
	
	.row a
	{
		color : #8ac7db;
	}
	
	.row a:hover
	{
		text-decoration : none;
	}
</style>
</head> 
<body>
    <?php 
		$nav->header1();
		
		if($_SESSION['access'] == 1)
		{
	?>
	<div class="container">
	<div class="page-header">
		<h1>Dashboard</h1>      
	</div>
	<div class="page-header">
		<h2>Meal Management</h2>      
	</div>
	<div class="row">
		<div class="col-xs-4">
		<a href="add_menu.php">
			<h4>ADD MENU</h4>
			<img src="../images/add-menu.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="add_category.php">
			<h4>ADD CATEGORY</h4>
			<img src="../images/add-category.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="add_menuType.php">
			<h4>ADD MENU TYPE</h4>
			<img src="../images/add-menu.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="view_menu.php">
			<h4>VIEW MENU <span class="label label-default"><?php echo $num2 ?></span></h4>
			<img src="../images/view-menu.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="view_category.php">
			<h4>VIEW CATEGORY <span class="label label-default"><?php echo $num3 ?></span></h4>
			<img src="../images/view-category.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="view_menuType.php">
			<h4>VIEW MENU TYPE <span class="label label-default"><?php echo $num4 ?></span></h4>
			<img src="../images/view-menutype.png" alt=""/>
		</a>
		</div>
	</div>
	
	<hr />
	
	<div class="page-header">
		<h2>Staff Management</h2>      
	</div>
	<div class="row">
		<div class="col-xs-4">
		<a href="add_staff.php">
			<h4>ADD STAFF</h4>
			<img src="../images/add-staff.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="view_staff.php">
			<h4>VIEW STAFF <span class="label label-default"><?php echo $num ?></span></h4>
			<img src="../images/view-staff.png" alt=""/>
		</a>
		</div>
	</div>
	
	<hr />
	
	<div class="page-header">
		<h2>Finance Management</h2>      
	</div>
	<div class="row">
		<div class="col-xs-4">
			<a href="add_gst.php">
				<h4>ADD GST</h4>
				<img src="../images/add_gst.png" alt=""/>
			</a>
		</div>
		<div class="col-xs-4">
			<a href="view_gst.php">
				<h4>VIEW GST <span class="label label-default"><?php echo $num8 ?></span></h4>
				<img src="../images/gst.png" alt=""/>
			</a>
		</div>
	</div>
	<hr />
	
	<div class="page-header">
		<h2>Location Management</h2>      
	</div>
	<div class="row">
		<div class="col-xs-4">
		<a href="add_state.php">
			<h4>Add State</h4>
			<img src="../images/add_location.png" alt=""/>
		</a>
		<a href="view_state.php">
			<h4>View State <span class="label label-default"><?php echo $num6 ?></span></h4>
			<img src="../images/location.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="add_city.php">
			<h4>Add City</h4>
			<img src="../images/add_city.png" alt=""/>
		</a>
		<a href="view_city.php">
			<h4>View City <span class="label label-default"><?php echo $num7 ?></span></h4>
			<img src="../images/city.png" alt=""/>
		</a>
		</div>
	</div>
	
	<hr>
	
	<div class="page-header">
		<h2>Others</h2>      
	</div>
	<div class="row">
		<div class="col-xs-4">
		<a href="order_details.php">
			<h4>TOTAL ORDERS <span class="label label-default"><?php echo $num5 ?></span></h4>
			<img src="../images/total-orders.png" alt=""/>
		</a>
		</div>
	</div>
	<hr>
</div>
<?php
		}
		
		else if($_SESSION['access'] == 0)
		{
			$sql5 = mysqli_query($conn, "SELECT * FROM purchase WHERE staff_id = $sess_id GROUP BY purchase_date, purchase_time, member_id");
			$num5 = mysqli_num_rows($sql5);
			
?>

	<div class="container">
	<div class="page-header">
		<h1>Dashboard</h1>      
	</div>
	<div class="page-header">
		<h2>Meal Management</h2>      
	</div>
	<div class="row">
		<div class="col-xs-4">
		<a href="view_menu.php">
			<h4>VIEW MENU <span class="label label-default"><?php echo $num2 ?></span></h4>
			<img src="../images/view-menu.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="view_category.php">
			<h4>VIEW CATEGORY <span class="label label-default"><?php echo $num3 ?></span></h4>
			<img src="../images/view-category.png" alt=""/>
		</a>
		</div>
		<div class="col-xs-4">
		<a href="view_menuType.php">
			<h4>VIEW MENU TYPE <span class="label label-default"><?php echo $num4 ?></span></h4>
			<img src="../images/view-menutype.png" alt=""/>
		</a>
		</div>
	</div>
	
	<hr />
	
	<div class="page-header">
		<h2>Others</h2>      
	</div>
	<div class="row">
		<div class="col-xs-4">
		<a href="order_details.php">
			<h4>TOTAL ORDERS <span class="label label-default"><?php echo $num5 ?></span></h4>
			<img src="../images/total-orders.png" alt=""/>
		</a>
		</div>
	</div>
	<hr>
</div>

<?php
		}
?>
</body>
</html>      