<?php
include "nav.php";
include ("dbconnection.php");

$nav = new navigation($conn);
$action = false;
if(!isset($_REQUEST["pid"]))
{
	echo "<script type=\"text/javascript\">
				 setTimeout(\"location.href = 'index.php';\",1);
			</script>";
}

else
{	
	if(isset($_SESSION["sess_memid"]))
	{
		$sess_memid = $_SESSION["sess_memid"];
	}
	
	if(isset($_SESSION['query']))
	{
		$query = $_SESSION['query'];
		$action = true;
	}
	
	$pid = $_REQUEST["pid"];
	
	$sql = mysqli_query($conn, "SELECT * FROM menu m INNER JOIN category c ON m.category_id = c.category_id 
			INNER JOIN menutype mt ON m.menutype_id = mt.menutype_id 
			WHERE menu_id = $pid");
	if($sql)
	{
		$row = mysqli_fetch_assoc($sql);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Product - <?php echo $row['menu_name'] ?></title>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#dialog" ).dialog();
  } );
  </script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<style type="text/css">.slider_bg {behavior:url("js/PIE.htc")}</style>
<![endif]-->

<style type="text/css">
.main-wrapper
{
	border : 1px solid black;
	background-color : rgba(255, 255, 255, 0.8);
	padding : 0 10px 10px 10px;
	margin : 0 auto;
	margin-bottom : 10px;
}

.product-image img
{
	border : 1px solid silver;
	width : 275px;
	height : 185px;
	float : left;
	margin-top : 30px;
}

.product-details
{
	float : left;
	margin-left : 25px;
	padding : 10px;
	width : 600px;
}

.product-details h2
{
	border-bottom : 1px solid black;
}

.actual-price
{
	text-decoration : line-through;
}

.discount-price
{
	font-size : 1.5em;
	color : red;
}

.line
{
	border-bottom : 1px solid silver;
}

hr
{
	border : 1px solid black;
}

.total
{
	font-size : 2.0em;
	color : red;
	float : right;
}


.product-details input[type="button"], .product-details input[type="submit"]
{
	border : 1px solid orange;
	margin : 25px 10px 10px 10px;
	padding : 10px;
	background-color : orange;
	color : white;
	width : 170px;
	font-weight : bold;
}

.product-details input[type="button"]:hover, .product-details input[type="submit"]:hover
{
	color : orange;
	background-color : white;
	font-weight : bold;
	cursor : pointer;
}

.buttongroup
{
	
}

.table table
{
	border-collapse : collapse;
}

.table th
{
	border-right : 1px solid black;
	border-bottom : 1px solid black;
	text-align : center;
	width : 200px;
	padding : 5px;
}

.table td
{
	border-right : 1px solid black;
	border-bottom : 1px solid black;
	text-align : center;
	width : 200px;
	padding : 5px;
}

.name
{
	font-weight : bold;
	font-size : 1.5em;
}

.date
{
	color : gray;
}
</style>

</head>
<?php 
$nav->header1($conn);				
?>
      <!-- / header -->
		<?php
			if($action == true)
			{?>
				<div class="main-wrapper">
		<form name="descriptionfrm" action="" method="POST">
			<div class="product-image">
				<img src="admin/<?php echo $row['menu_path']; ?> "/>
				<p><?php echo $row['menu_description']; ?></p>
			</div>
			
			<div class="product-details">
				<h2><?php echo $row['menu_name']; ?></h2>
				<!--<p><span class="actual-price">RM 17.50 </span> <br />--> <p><span class="discount-price">RM <?php echo  number_format((float)$row['menu_price'], 2, '.', ''); ?> </span>(GST excluded)</p>
				
			<?php
			if(isset($_SESSION["loggedin"]))
			{
				$check = mysqli_query($conn, "SELECT * FROM cart WHERE menu_id = ".$row['menu_id']." AND member_id = $sess_memid");
			
				
				if(mysqli_num_rows($check) != 0)
				{
					$exists = mysqli_fetch_assoc($check);
					
					?>
					<p style="border-top : 1px solid silver;">Quantity <select name="quantity">
																		<option <?php echo ($exists['quantity'] == 1)?"selected":"" ?>>1</option>
																		<option <?php echo ($exists['quantity'] == 2)?"selected":"" ?>>2</option>
																		<option <?php echo ($exists['quantity'] == 3)?"selected":"" ?>>3</option>
																		<option <?php echo ($exists['quantity'] == 4)?"selected":"" ?>>4</option>
																		<option <?php echo ($exists['quantity'] == 5)?"selected":"" ?>>5</option>
																		<option <?php echo ($exists['quantity'] == 6)?"selected":"" ?>>6</option>
																		<option <?php echo ($exists['quantity'] == 7)?"selected":"" ?>>7</option>
																		<option <?php echo ($exists['quantity'] == 8)?"selected":"" ?>>8</option>
																		<option <?php echo ($exists['quantity'] == 9)?"selected":"" ?>>9</option>
																		<option <?php echo ($exists['quantity'] == 10)?"selected":"" ?>>10</option>
																	</select></p>
				
				<hr />
				<h4>Remarks</h4>
				<p><textarea name="custRemark" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"><?php echo $exists['remarks'] ?></textarea></p>
				
				<?php
				}
				
				else
				{
					?>
						<p style="border-top : 1px solid silver;">Quantity <select name="quantity">
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																		<option value="6">6</option>
																		<option value="7">7</option>
																		<option value="8">8</option>
																		<option value="9">9</option>
																		<option value="10">10</option>
																	</select></p>
				
				<hr />
				<h4>Remarks</h4>
				<p><textarea name="custRemark" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"></textarea></p>
					<?php
				}
			}		
				else
				{
					?>
						<p style="border-top : 1px solid silver;">Quantity <select name="quantity">
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																		<option value="6">6</option>
																		<option value="7">7</option>
																		<option value="8">8</option>
																		<option value="9">9</option>
																		<option value="10">10</option>
																	</select></p>
				
				<hr />
				<h4>Remarks</h4>
				<p><textarea name="custRemark" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"></textarea></p>
					<?php
				}
			?>
				
				
				<span class="buttongroup"><input type="submit" name="add_to_cart" value="Add to Cart"></span>
			</form>
			<form name="backbtn" method="POST" action="search.php">
				<input type="hidden" name="query" value="<?php echo $query ?>">
				<input type="submit" name="backbtn" value="Back">
			</form>
			</div>
			<div class="product-description">
				<h2>Menu Description</h2>
				<hr />
				<?php
					if(empty($row['menu_description']))
					{?>
						<p>None</p>
						<?php
					}
					
					else
					{?>
						<p><?php echo $row['menu_description']; ?></p>
						<?php
					}
				?>
				
				<h2>Menu Infomation</h2>
				<hr />
				<table>
					<tr>
						<td>Main Ingredient<td>
						<td> : <?php echo $row['menu_ingredient']; ?></td>
					</tr>
					<tr>
						<td>Spice Level<td>
						<?php
							if($row['menu_spicelevel'] == 'None' )
							{?>
								<td> : None </td><?php
							}
							else if($row['menu_spicelevel'] == 'Mild' )
							{?>
								<td> : <img src="images/chilli.png" width="25px" height="25px" /></td><?php
							}
							
							else if($row['menu_spicelevel'] == 'Spicy' )
							{?>
								<td> : <img src="images/chilli.png" width="25px" height="25px" /><img src="images/chilli.png" width="25px" height="25px" /></td><?php
							}
							
							else if($row['menu_spicelevel'] == 'Extra Spicy' )
							{?>
								<td> : <img src="images/chilli.png" width="25px" height="25px" /><img src="images/chilli.png" width="25px" height="25px" /><img src="images/chilli.png" width="25px" height="25px" /></td><?php
							}
						?>
					</tr>
					<tr>
						<td>Category<td>
						<td> : <?php echo $row['category_name']; ?></td>
					</tr>
					<tr>
						<td>Menu Type<td>
						<td> : <?php echo $row['menutype_name']; ?></td>
					</tr>
				</table>
			</div>
			<?php
				$sql2 = mysqli_query($conn, "SELECT * FROM comment_and_rating cr 
				INNER JOIN member m ON cr.member_id = m.member_id 
				WHERE menu_id = $pid");
			?>
				<h2>Comments and Ratings</h2>
				<hr />
			<?php
				if(mysqli_num_rows($sql2) == 0)
				{?>
					<p>No comments and ratings on this menu yet.</p>
					<?php
				}
				
				else
				{
					while($row2 = mysqli_fetch_assoc($sql2))
					{
			?>
						<p>
							<span class="name"><?php echo $row2['member_name'] . "</span> "; ?>
							<?php
							if($row2['rating'] == 1)
							{?>
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 2)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 3)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 4)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 5)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							?>
							<span class="date"><?php echo date('d F Y', strtotime($row2['comment_rating_date'])) . " AT " . $row2['comment_rating_time']; ?></span> <br /> 
							<?php echo $row2['comment_feedback']; ?>
						</p>
			<?php
					}
				}
			?>
		</div>
				<?php
			}
			
			else
			{?>
				<div class="main-wrapper">
		<form name="descriptionfrm" action="" method="POST">
			<div class="product-image">
				<img src="admin/<?php echo $row['menu_path']; ?> "/>
			</div>
			<div class="product-details">
				<h2><?php echo $row['menu_name']; ?></h2>
				<!--<p><span class="actual-price">RM 17.50 </span> <br />--> <p><span class="discount-price">RM <?php echo  number_format((float)$row['menu_price'], 2, '.', ''); ?> </span>(GST excluded)</p>
				
			<?php
			if(isset($_SESSION["loggedin"]))
			{
				$check = mysqli_query($conn, "SELECT * FROM cart WHERE menu_id = ".$row['menu_id']." AND member_id = $sess_memid");
			
				
				if(mysqli_num_rows($check))
				{
					$exists = mysqli_fetch_assoc($check);
					
					?>
					<p style="border-top : 1px solid silver;">Quantity <select name="quantity">
																		<option <?php echo ($exists['quantity'] == 1)?"selected":"" ?>>1</option>
																		<option <?php echo ($exists['quantity'] == 2)?"selected":"" ?>>2</option>
																		<option <?php echo ($exists['quantity'] == 3)?"selected":"" ?>>3</option>
																		<option <?php echo ($exists['quantity'] == 4)?"selected":"" ?>>4</option>
																		<option <?php echo ($exists['quantity'] == 5)?"selected":"" ?>>5</option>
																		<option <?php echo ($exists['quantity'] == 6)?"selected":"" ?>>6</option>
																		<option <?php echo ($exists['quantity'] == 7)?"selected":"" ?>>7</option>
																		<option <?php echo ($exists['quantity'] == 8)?"selected":"" ?>>8</option>
																		<option <?php echo ($exists['quantity'] == 9)?"selected":"" ?>>9</option>
																		<option <?php echo ($exists['quantity'] == 10)?"selected":"" ?>>10</option>
																	</select></p>
				
				<hr />
				<h4>Remarks</h4>
				<p><textarea name="custRemark" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"><?php echo $exists['remarks'] ?></textarea></p>
				
				<?php
				}
				
				else
				{
					?>
						<p style="border-top : 1px solid silver;">Quantity <select name="quantity">
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																		<option value="6">6</option>
																		<option value="7">7</option>
																		<option value="8">8</option>
																		<option value="9">9</option>
																		<option value="10">10</option>
																	</select></p>
				
				<hr />
				<h4>Remarks</h4>
				<p><textarea name="custRemark" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"></textarea></p>
					<?php
				}
			}		
				else
				{
					?>
						<p style="border-top : 1px solid silver;">Quantity <select name="quantity">
																		<option value="1">1</option>
																		<option value="2">2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																		<option value="5">5</option>
																		<option value="6">6</option>
																		<option value="7">7</option>
																		<option value="8">8</option>
																		<option value="9">9</option>
																		<option value="10">10</option>
																	</select></p>
				
				<hr />
				<h4>Remarks</h4>
				<p><textarea name="custRemark" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"></textarea></p>
					<?php
				}
			?>
				
				
				<span class="buttongroup"><input type="submit" name="add_to_cart" value="Add to Cart"></span>
				<br />
				<input type="button" onclick="window.history.go(-1)" name="backbtn" value="Back">
			</form>
			</div>
			<div class="product-description">
				<h2>Menu Description</h2>
				<hr />
				<?php
					if(empty($row['menu_description']))
					{?>
						<p>None</p>
						<?php
					}
					
					else
					{?>
						<p><?php echo $row['menu_description']; ?></p>
						<?php
					}
				?>
				<h2>Menu Infomation</h2>
				<hr />
				<table>
					<tr>
						<td>Main Ingredient<td>
						<td> : <?php echo $row['menu_ingredient']; ?></td>
					</tr>
					<tr>
						<td>Spice Level<td>
						<?php
							if($row['menu_spicelevel'] == 'None' )
							{?>
								<td> : None </td><?php
							}
							else if($row['menu_spicelevel'] == 'Mild' )
							{?>
								<td> : <img src="images/chilli.png" width="25px" height="25px" /></td><?php
							}
							
							else if($row['menu_spicelevel'] == 'Spicy' )
							{?>
								<td> : <img src="images/chilli.png" width="25px" height="25px" /><img src="images/chilli.png" width="25px" height="25px" /></td><?php
							}
							
							else if($row['menu_spicelevel'] == 'Extra Spicy' )
							{?>
								<td> : <img src="images/chilli.png" width="25px" height="25px" /><img src="images/chilli.png" width="25px" height="25px" /><img src="images/chilli.png" width="25px" height="25px" /></td><?php
							}
						?>
					</tr>
					<tr>
						<td>Category<td>
						<td> : <?php echo $row['category_name']; ?></td>
					</tr>
					<tr>
						<td>Menu Type<td>
						<td> : <?php echo $row['menutype_name']; ?></td>
					</tr>
				</table>
			</div>
			<?php
				$sql2 = mysqli_query($conn, "SELECT * FROM comment_and_rating cr 
				INNER JOIN member m ON cr.member_id = m.member_id 
				WHERE menu_id = $pid");
			?>
				<h2>Comments and Ratings</h2>
				<hr />
			<?php
				if(mysqli_num_rows($sql2) == 0)
				{?>
					<p>No comments and ratings on this menu yet.</p>
					<?php
				}
				
				else
				{
					while($row2 = mysqli_fetch_assoc($sql2))
					{
			?>
						<p>
							<span class="name"><?php echo $row2['member_name'] . "</span> "; ?>
							<?php
							if($row2['rating'] == 1)
							{?>
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 2)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 3)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 4)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							
							if($row2['rating'] == 5)
							{?>
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" />
								<img src="images/star.png" width="25px" height="25px" /><br />
							<?php
							}
							?>
							<span class="date"><?php echo date('d F Y', strtotime($row2['comment_rating_date'])) . " AT " . $row2['comment_rating_time']; ?></span> <br /> 
							<?php echo $row2['comment_feedback']; ?>
						</p>
			<?php
					}
				}
			?>
		</div>
			<?php
			}
		?>
		
	</div>
</div>
<?php $nav->footer2() ?>
</body>
</html>
<?php
if(isset($_POST['add_to_cart']))
{
	if(!isset($_SESSION["loggedin"]))
	{
		?>
			<div id="dialog" title="Alert">
			<p>Please log in to continue</p>
			</div>
		<?php
	}
	
	else
	{
		$memid = $_SESSION["sess_memid"];
		
		$quantity = $_POST['quantity'];
		$remarks = $_POST['custRemark'];
		$total = $row['menu_price'] * $quantity;
		
		if(strlen($remarks) > 200)
		{
			?>
				<div id="dialog" title="Alert">
				<p>Remarks too long</p>
				</div>
			<?php
		}
		
		else
		{
			$sel = "SELECT * FROM cart WHERE menu_id = $pid AND member_id = $memid";
			$result = mysqli_query($conn, $sel);
			if(mysqli_num_rows($result) != 0)
			{
				$update = mysqli_query($conn, "UPDATE cart SET quantity = $quantity, remarks = '$remarks', total = $total, expired=now() WHERE menu_id = $pid AND member_id = $memid");
				if($update)
				{
					?>
						<div id="dialog" title="Alert">
						<p>Update cart successfully</p>
						</div>
					<?php
				}
				
				else
				{
					echo mysqli_error($conn);
				}
			}
			
			else
			{
				$result = mysqli_query($conn, "INSERT INTO cart (menu_id, member_id, quantity, remarks, total, expired) VALUES ($pid, $memid, $quantity, '$remarks', $total, (now()))");
				if($result)
				{
					?>
						<div id="dialog" title="Alert">
						<p>Add to cart successfully</p>
						</div>
					<?php
				}
				
				else
				{
					echo mysqli_error($conn);
				}
			}
		}
	}
}
?>