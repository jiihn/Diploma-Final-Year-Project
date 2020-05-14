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
<title>Lunar | Profile</title>
<meta charset="utf-8">
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

<style type="text/css">
.main-wrapper
{
	border : 1px solid black;
	width : 1000px;
	overflow : auto;
	margin : 0 auto;
	padding : 20px;
	background-color : rgba(255, 255, 255,0.8);
	margin-bottom : 10px;
	border-radius : 10px;
	font-family : Verdana;
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
	float : left;
}

.first-content
{
	border : 1px solid black;
	float : left;
	margin-right : 10px;
	padding : 10px;
	width : 310px;
}

a:hover
{
	cursor : pointer;
}

.second-content
{
	border : 1px solid black;
	float : left;
	margin-right : 10px;
	padding : 10px;
	height : 220px;
	width : 375px;
}

table
{
	border-collapse : separate;
	margin : 0 auto;
	margin-bottom : 30px;
	border-spacing : 10px 2px;
}

th, td
{
	border-bottom : 1px solid #ddd;
	text-align : center;
	padding : 10px;
}

td
{
	border-right : 1px solid silver;
}

.upper-content h4
{
	border-bottom : 1px solid silver;
}

.second-content h4
{
	border-bottom : 1px solid silver;
}

.second-content input[type='button']
{
	margin-top : 13px;
}

.edit
{
	padding : 3px 5px;;
	border : 1px solid #f44242;
	border-radius : 5px;
	background-color : rgba(255, 255, 255,0.8);
	color : #f44242;
}

.edit:hover
{
	border : 1px solid #f44242;
	cursor : pointer;
	background-color : #f44242;
	color : white;
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
					<a href="change_pass.php"><li><img src="images/padlock.png" style="width : 20px; height : 20px; float : left; margin-right : 5px;"/>Change Password</li></a>
				</ul>
			</div>
			
			<div class="right-content">
			
				<div class="upper-content">
					<div class="first-content">
						<img src="images/personal-info-icon.png" style="width : 20px; height : 20px; float : left; margin-right : 5px;"/>		
						<h4>Personal Information</h4>
						<p>
						<label><b>Name 	: </b></label><?php echo $row["member_name"]; ?><br />
						<label><b>Email	: </b></label><?php echo $row["member_email"]; ?><br />
						<label><b>Contact	: </b></label><?php echo $row["member_contact"]; ?><br />
						<label><b>Address	: </b></label><?php echo $row["member_address"] ." ". $row["member_city"] .", ". $row["member_postcode"] .", ". $row["member_state"]; ?>
						</p>
						<br />
						<br />
						<br />
						<a href="profile_edit.php"><input type="button" name="editbtn" value="Edit" class="edit"/></a>
					</div>
				
				<div class="second-content">
					<img src="images/recent-order-icon.png" style="width : 25px; height : 25px; float : left; margin-right : 5px;"/>	
					<h4>Recent Order</h4>
					<table>
					
						<tr>
							<th>Order #</th>
							<th>Placed on</th>
							<th>Total</th>
							<th>Status</th>
						</tr>
						
						<?php $sql = mysqli_query($conn, "SELECT * FROM purchase p INNER JOIN gst g ON p.gst_id = g.gst_id WHERE member_id = $sess_memid ORDER BY purchase_id DESC LIMIT 3");
						while($row = mysqli_fetch_assoc($sql))
						{?>
						<tr>
							<td><a href="view_order_details.php?pid=<?php echo $row['purchase_id']; ?>"><?php echo $row['purchase_id']; ?></a></td>
							<td><?php echo $row['purchase_date']; ?></td>
							<td>RM <?php echo number_format((float)$row['purchase_amount']+($row['purchase_amount']*($row['gst_value']/100)), 2, '.', '') ?></td>
							<td><?php echo $row['purchase_delivery_status']; ?></td>
						</tr><?php
						}?>
						
					</table>
					
					<a href="view_order_details.php"><input type="button" name="editbtn" value="View More" class="edit"/></a>
				</div>
				</div>
				
			</div>	
			
		</div>  

	</div>
  </div>
		
<?php $nav->footer2() ?>
</body>
</html>
