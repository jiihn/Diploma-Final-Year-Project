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
	
	if(isset($_REQUEST['pid']))
	{
		$pid = $_REQUEST['pid'];
	}
	
	else
	{
		$pid = 0;
	}
	
	if($pid == 0)
	{
		$action = false;
		$sql1 = "SELECT * FROM purchase p 
		LEFT JOIN staff s ON p.staff_id = s.staff_id
		INNER JOIN gst g ON p.gst_id = g.gst_id 
		WHERE member_id = $sess_memid 
		ORDER BY purchase_id DESC";
	}
	
	else
	{
		$action = true;
		$sql2 = "SELECT * FROM purchase_item pi 
		INNER JOIN purchase p ON pi.purchase_id = p.purchase_id 
		INNER JOIN menu m ON pi.menu_id = m.menu_id 
		INNER JOIN gst g ON p.gst_id = g.gst_id
		WHERE pi.purchase_id = $pid";
		
		$check = mysqli_query($conn, "SELECT * FROM comment_and_rating");
		$checking = mysqli_fetch_assoc($check);
	}

	$result2 = mysqli_query($conn, "SELECT * FROM member WHERE member_id = $sess_memid");
	$row = mysqli_fetch_assoc($result2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | View Order</title>
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

.total
{
	font-weight : bold;
	font-size : 1.5em;
	float : left;
}

.price
{
	color : red;
	font-size : 1.3em;
	font-weight : bold;
}

.back
{
	padding : 3px 5px;;
	border : 1px solid #f44242;
	border-radius : 5px;
	background-color : rgba(255, 255, 255,0.8);
	color : #f44242;
}

.back:hover
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
			<div class="header">
				<h2>View Order Details</h2>
			</div>
			<?php
				if($action == true)
				{
					?>
					<table>
						<tr>
							<th width="50px">No.</th>
							<th width="150px">Menu Name</th>
							<th width="150px">Details</th>
							<th width="150px">Price</th>
							<th width="150px">Quantity</th>
							<th width="150px">GST</th>
							<th width="150px">Total(Include GST)</th>
						</tr>
					<?php
					$result = mysqli_query($conn, $sql2);
					$i=0;
					$total = 0;
					while($row = mysqli_fetch_assoc($result))
					{?>
						<tr>
							<td><?php echo $i+1 ?></td>
							<td><?php echo $row['menu_name'] ?></td>
							<td><?php echo $row['purchase_item_details'] ?></td>
							<td>RM <?php echo number_format((float)$row['purchase_item_price'], 2, '.', '') ?></td>
							<td><?php echo $row['purchase_item_quantity'] ?></td>
							<td><?php echo $row['gst_value'] ?>%</td>
							<td>RM <?php echo number_format((float)$row['purchase_item_total']+($row['purchase_item_total']*($row['gst_value']/100)), 2, '.', '') ?></td>
							<?php
								if($row['purchase_delivery_status'] == 'Delivered')
								{?>
									<td><a href="rate_menu.php?mid=<?php echo $row['menu_id'] ?>&pid=<?php echo $row['purchase_id'] ?>"><input type="button" name="ratebtn" value="Rate" class="back"/></a></td><?php
								}
							?>
						</tr>
						
						<?php
						$total += ($row['purchase_item_total']+($row['purchase_item_total']*($row['gst_value']/100)));
						$i++;
					}
					?>
						<tr>
							<td colspan="6"><span class="total">Total Amount : <span class="price">RM <?php echo number_format((float)$total, 2, '.', '') ?></span></span></td>
						</tr>
						<a href="fpdf/form.php?pid=<?php echo $pid ?>" target="_blank"><input type="button" name="receiptbtn" value="View Receipt" class="back"/></a>
					</table>
					<?php
				}
				
				else if($action == false)
				{?>
					<table>
					
						<tr>
							<th width="100px">Order #</th>
							<th width="150px">Placed on</th>
							<th width="150px">Total</th>
							<th width="150px">Status</th>
							<th width="150px">Delivered By</th>
						</tr>
						<?php
						$result = mysqli_query($conn, $sql1);
						while($row = mysqli_fetch_assoc($result))
						{?>
						<tr>
							<td><a href="view_order_details.php?pid=<?php echo $row['purchase_id']; ?>"><?php echo $row['purchase_id']; ?></a></td>
							<td><?php echo $row['purchase_date']; ?></td>
							<td>RM <?php echo number_format((float)$row['purchase_amount']+($row['purchase_amount']*($row['gst_value']/100)), 2, '.', '') ?></td>
							<td><?php echo $row['purchase_delivery_status']; ?></td>
							<td><?php echo $row['staff_name']; ?></td>
						</tr><?php
						}?>
						
					</table>
					<?php
				}
			?>
			
			<input type="button" name="backbtn" onclick="history.go(-1)" value="Back" class="back"/>
		</div>
		</div>
  </div>
<?php $nav->footer2() ?>
</body>
</html>