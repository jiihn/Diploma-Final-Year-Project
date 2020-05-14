<?php
include "../dbconnection.php";
include "nav.php";
ob_start();

$total = 0;

if ($_SESSION["aloggedin"] != 1)
{
	header("Location: login.php");
}

else if(!isset($_REQUEST["pid"]))
{
	echo "<script type=\"text/javascript\">
			setTimeout(\"window.location='order_details.php';\", 1);
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
	
	$pid = $_REQUEST["pid"];
	
	if($type == "staff")
	{
		$check = mysqli_query($conn, "SELECT * FROM purchase WHERE purchase_id = $pid");
		$checked = mysqli_fetch_assoc($check);
		
		if($sess_id != $checked['staff_id'])
		{
			echo "<script type=\"text/javascript\">
				setTimeout(\"window.location='access_denied.php';\", 1);
			</script>";
		}
	}
	
	$sql="SELECT * FROM purchase p 
	INNER JOIN purchase_item pi ON p.purchase_id = pi.purchase_id 
	INNER JOIN menu m ON pi.menu_id = m.menu_id 
	INNER JOIN gst g ON p.gst_id = g.gst_id 
	WHERE p.purchase_id = $pid";
	$result3=mysqli_query($conn, $sql);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - View Order Details</title>
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
	}
	
	.success
	{
		background-color: #4CAF50;
		color: white;
		font-size : 1.7em;
		opacity: 1;
		transition: opacity 0.6s;
		margin-bottom: 15px;
		border-radius : 5px;
	}
	
	.date table
	{
		font-size : 1.5em;
	}
</style>
</head> 
<body>
    <?php 
		$nav->header1();
	?>
	<div class="container">
		<h1>Order Details </h1>
		<span class="success" id="message11"></span>
		<hr>
	<?php
	
//==========================================================================================================================================================================================================================
// ADMIN
//==========================================================================================================================================================================================================================	

		if($type == 'admin')
		{?>
			<form name="view_order-assign" method="post" action="" class="form-horizontal">
			<?php
				$sql2="SELECT * FROM purchase p 
				INNER JOIN purchase_item pi ON p.purchase_id = pi.purchase_id 
				INNER JOIN menu m ON pi.menu_id = m.menu_id 
				INNER JOIN gst g ON p.gst_id = g.gst_id 
				INNER JOIN member mem ON p.member_id = mem.member_id 
				LEFT JOIN staff s ON p.staff_id = s.staff_id 
				WHERE p.purchase_id = $pid";
				$result4=mysqli_query($conn, $sql2);
				$datetime = mysqli_fetch_assoc($result4);
			?>
			<div class="date">
				<table>
					<tr>
						<td width="200px">Purchase ID</td>
						<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_id']?></td>
					</tr>
					
					<tr>
						<td width="200px">Purchase Date</td>
						<td> : <?php echo date('d F Y', strtotime($datetime['purchase_date']))?></td>
					</tr>
					
					<tr>
						<td width="200px">Purchase Time</td>
						<td> : <?php echo date('h:i:s a', strtotime($datetime['purchase_time'])) ?></td>
					</tr>
					
					<tr>
						<td width="200px">Delivery Address</td>
						<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_delivery_address']?></td>
					</tr>
					
					<tr>
						<td width="200px">Delivery State</td>
						<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_delivery_state']?></td>
					</tr>
					
					<tr>
						<td width="200px">Member Name (ID)</td>
						<td style="text-transform : capitalize"> : <?php echo $datetime['member_name']?> (<?php echo $datetime['member_id'] ?>)</td>														
					</tr>
					
					<tr>
						<td width="200px">Delivery Status</td>
						<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_delivery_status']?></td>
					</tr>
					
					<tr>
						<td width="200px">Staff Name (ID)</td>
						<td style="text-transform : capitalize"> 
							 <div class="col-xs-3">
								<select class="form-control" name="staffAssigned">
									<?php
									$result5 = mysqli_query($conn, "SELECT * FROM staff");
									while($row5 = mysqli_fetch_assoc($result5))
									{?>
										<option value="<?php echo $row5['staff_id']?>"><?php echo $row5['staff_name']?> (<?php echo $row5['staff_id']?>)</option><?php
									}?>
								</select>
							</div>
						</td>
					</tr>
					
					<tr>
						<td width="200px">Delivery Time</td>
						<?php
							if(empty($datetime['purchase_delivery_time']))
							{?>
								<td> : Pending</td>
								<?php
							}
							
							else
							{
						?>
								<td> : <?php echo date('h:i:s a', strtotime($datetime['purchase_delivery_time'])) ?></td>
						<?php
							}
						?>
					</tr>
				</table>
				<script>
					$(document).ready(function(){
						$('[data-toggle="popover"]').popover();   
					});
				</script>
			</div>
			<hr />
			<table id="myTable" class="table table-striped">
			<thead>
				<tr class="header">
					<th width="100">Menu Name</th>
					<th width="100">Menu Price</th>
					<th width="50">Quantity</th>
					<th width="100">Remarks</th>
					<th width="100">Purchase Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
					while($row = mysqli_fetch_assoc($result3))
					{?>
						<tr>
							<td style="text-transform : capitalize;"><?php echo $row['menu_name']?></td>
							<td style="text-transform : capitalize">RM <?php echo number_format((float)$row['menu_price'], 2, '.', '')?></td>
							<td style="text-transform : capitalize"><?php echo $row['purchase_item_quantity']?></td>
							<td style="text-transform : capitalize"><?php echo $row['purchase_item_details']?></td>
							<td style="text-transform : capitalize">RM <?php echo number_format((float)$row['purchase_item_total']+($row['purchase_item_total']*($row['gst_value']/100)), 2, '.', '')?></td>
							<?php
								$total += $row['purchase_item_total'];
							?>
						</tr><?php
					}
					$sql2="SELECT * FROM purchase p 
					INNER JOIN purchase_item pi ON p.purchase_id = pi.purchase_id 
					INNER JOIN menu m ON pi.menu_id = m.menu_id 
					INNER JOIN gst g ON p.gst_id = g.gst_id 
					WHERE p.purchase_id = $pid";
					$result4=mysqli_query($conn, $sql2);
					$row2 = mysqli_fetch_assoc($result4);
					?>
					<tr>
						<td style="font-size : 2em;" colspan="13">Total Amount(Include GST <?php echo $row2['gst_value'] ?>%) <span style="font-weight : bold; color : red;">RM <?php echo number_format((float)$total+($total*($row2['gst_value']/100)), 2, '.', '') ?></span></td>
					</tr>
			</tbody>
		</table>
	<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
			<br>
			<div class="form-group">
				<div class="col-xs-offset-3 col-xs-9">
					<input type="submit" class="btn btn-primary" name="assignbtn" value="Assign">
					<a href="order_details.php"><input type="button" class="btn btn-default" value="Back"></a>
				</div>
			</div>
		</form>
		<?php
		}
		
//==========================================================================================================================================================================================================================
// STAFF
//==========================================================================================================================================================================================================================		

		else
		{
	?>	
		
    <form name="view_order-details" method="post" action="" class="form-horizontal">
		<?php
			$sql2="SELECT * FROM purchase p 
			INNER JOIN purchase_item pi ON p.purchase_id = pi.purchase_id 
			INNER JOIN menu m ON pi.menu_id = m.menu_id 
			INNER JOIN gst g ON p.gst_id = g.gst_id 
			INNER JOIN member mem ON p.member_id = mem.member_id 
			LEFT JOIN staff s ON p.staff_id = s.staff_id 
			WHERE p.purchase_id = $pid";
			$result4=mysqli_query($conn, $sql2);
			$datetime = mysqli_fetch_assoc($result4);
		?>
		<div class="date">
			<table>
				<tr>
					<td width="200px">Purchase ID</td>
					<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_id']?></td>
				</tr>
				
				<tr>
					<td width="200px">Purchase Date</td>
					<td> : <?php echo date('d F Y', strtotime($datetime['purchase_date']))?></td>
				</tr>
				
				<tr>
					<td width="200px">Purchase Time</td>
					<td> : <?php echo date('h:i:s a', strtotime($datetime['purchase_time'])) ?></td>
				</tr>
				
				<tr>
					<td width="200px">Delivery Address</td>
					<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_delivery_address']?></td>
				</tr>
				
				<tr>
					<td width="200px">Delivery State</td>
					<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_delivery_state']?></td>
				</tr>
				
				<tr>
					<td width="200px">Member Name (ID)</td>
					<td style="text-transform : capitalize"> : <?php echo $datetime['member_name']?> (<?php echo $datetime['member_id'] ?>)</td>														
				</tr>
				
				<tr>
					<td width="200px">Delivery Status</td>
					<td style="text-transform : capitalize"> : <?php echo $datetime['purchase_delivery_status']?></td>
				</tr>
				
				<tr>
					<td width="200px">Staff Name (ID)</td>
					<td style="text-transform : capitalize"> : <?php echo $datetime['staff_name']?> (<?php echo $datetime['staff_id'] ?>)</td>
				</tr>
				
				<tr>
					<td width="200px">Delivery Time</td>
					<td> : <?php echo date('h:i:s a', strtotime($datetime['purchase_delivery_time'])) ?></td>
				</tr>
			</table>
			<script>
				$(document).ready(function(){
					$('[data-toggle="popover"]').popover();   
				});
			</script>
		</div>
		<hr />
		<table id="myTable" class="table table-striped">
        <thead>
            <tr class="header">
				<th width="100">Menu Name</th>
				<th width="100">Menu Price</th>
				<th width="50">Quantity</th>
				<th width="100">Remarks</th>
				<th width="100">Purchase Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
			
				while($row = mysqli_fetch_assoc($result3))
				{?>
					<tr>
						<td style="text-transform : capitalize;"><?php echo $row['menu_name']?></td>
						<td style="text-transform : capitalize">RM <?php echo number_format((float)$row['menu_price'], 2, '.', '')?></td>
						<td style="text-transform : capitalize"><?php echo $row['purchase_item_quantity']?></td>
						<td style="text-transform : capitalize"><?php echo $row['purchase_item_details']?></td>
						<td style="text-transform : capitalize">RM <?php echo number_format((float)$row['purchase_item_total']+($row['purchase_item_total']*($row['gst_value']/100)), 2, '.', '')?></td>
						<?php
							$total += $row['purchase_item_total'];
						?>
					</tr><?php
				}
				$sql2="SELECT * FROM purchase p 
				INNER JOIN purchase_item pi ON p.purchase_id = pi.purchase_id 
				INNER JOIN menu m ON pi.menu_id = m.menu_id 
				INNER JOIN gst g ON p.gst_id = g.gst_id 
				WHERE p.purchase_id = $pid";
				$result4=mysqli_query($conn, $sql2);
				$row2 = mysqli_fetch_assoc($result4);
				?>
				<tr>
					<td style="font-size : 2em;" colspan="13">Total Amount(Include GST <?php echo $row2['gst_value'] ?>%) <span style="font-weight : bold; color : red;">RM <?php echo number_format((float)$total+($total*($row2['gst_value']/100)), 2, '.', '') ?></span></td>
				</tr>
        </tbody>
	</table>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <br>
        <div class="form-group">
            <div class="col-xs-offset-3 col-xs-9">
                <input type="submit" class="btn btn-primary" name="submitbtn" value="Delivered">
                <a href="order_details.php"><input type="button" class="btn btn-default" value="Back"></a>
            </div>
        </div>
    </form>
	
	<?php
		}
	?>
	</div>
	<hr>
</body>
</html>
<?php
try
{
	if(isset($_POST['submitbtn']))
	{
		$sql2 = "UPDATE purchase SET purchase_delivery_time = now(), purchase_delivery_status = 'Delivered', staff_id = $sess_id WHERE purchase_id = $pid";
		$row3 = mysqli_query($conn, $sql2);
		
		if($row3)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message11\").innerHTML = \"&nbsp;Update Status Successful&nbsp;\";
			</script>";
			
			echo "<script type=\"text/javascript\">
				 setTimeout(\"location.href = 'order_details.php';\",1500);
			</script>";
		}
	}
	
	else if(isset($_POST['assignbtn']))
	{
		$staffID = $_POST['staffAssigned'];
		$sql3 = "UPDATE purchase SET staff_id = $staffID WHERE purchase_id = $pid";
		echo $sql3;
		$assign = mysqli_query($conn, $sql3);
		
		if($assign)
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message11\").innerHTML = \"&nbsp;Successfully Assign Staff&nbsp;\";
			</script>";
			
			echo "<script type=\"text/javascript\">
				 setTimeout(\"location.href = 'order_details.php';\",1500);
			</script>";
		}
		
		else
		{
			echo mysqli_error($conn);
		}
	}
		
}

catch(Exception $e)
{
	$e->getMessage();
}
?>






