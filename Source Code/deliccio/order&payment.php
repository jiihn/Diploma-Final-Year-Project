<?php
include "nav.php";
require("PHPMailer/class.phpmailer.php");
include ("dbconnection.php");

$nav = new navigation($conn);

if ($_SESSION["loggedin"] != 1)
{
	header("Location: login.php");
}

if(!isset($_SESSION['buyerID']))
{
	header("Location: view_cart.php");
}

else
{	
	$buyerID = $_SESSION['buyerID'];
		
	$sql = "SELECT * FROM member m INNER JOIN cart sc ON m.member_id = sc.member_id WHERE m.member_id = $buyerID";
		
	$result = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($result);
	if($num ==0)
	{
		echo "<script type=\"text/javascript\">
				setTimeout(\"location.href = 'view_cart.php';\",1);
			</script>";
	}
	$row = mysqli_fetch_assoc($result);
		
	$total = 0;
	$gtotal = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Order/Payment</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script src="js/jquery-1.6.js" ></script>
<script src="js/cufon-yui.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/Forum_400.font.js"></script>
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
	margin : 10px auto;
	overflow : auto;
	background-color : rgba(255, 255, 255, 0.8);
	padding : 10px;
}

.header img
{
	width : 50px;
	height : 50px;
	float : left;
	padding : 10px;
}

.header
{
	border-bottom : 3px solid black;
}

.header h3
{
	font-family : Arial;
}

.header h4
{
	float : right;
	margin-top : 5px;
}

.header1 h4
{
	margin-top : 10px;
	border-bottom : 1px solid black;
}

.content
{
	padding : 10px;
}

.content input
{
}

.content input[type="text"], select
{
	padding : 2px;
	padding-left : 5px;
	border : 1px solid black;
}

.content textarea
{
	padding : 2px;
	padding-left : 5px;
	border : 1px solid black;
}

.content input[type="button"], input[type="submit"]
{
	padding : 10px;
	background-color : #f44242;
	color : white;
	border-radius : 5px;
}

.content input[type="button"]:hover, input[type="submit"]:hover
{
	cursor : pointer;
	opacity : 0.5;
}

.content p
{
	font-size : 1.2em;
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

.table img
{
	width : 100px;
	height : 60px;
}

.messages
{
	color : red;
}
</style>
</head>
<?php 
$nav->header1($conn);				
?>
      <!-- / header -->
	  
			<div class="main-wrapper">
				<div class="header">
					<img src="images/payment-icon.ico" />
					<h4>Order Complete</h4>
					<img src="images/right-arrow.png" style="float : right; width : 20px; height : 20px;"/>
					<h4 style="text-decoration : underline; color : red;">Order/Payment</h4>
					<img src="images/right-arrow.png" style="float : right; width : 20px; height : 20px;"/>
					<a href="view_cart.php"><h4>Shopping Cart</h4></a>
					<h3>Order/Payment</h3>
				</div>
				
				<div class="header1">
					<h4>Shipping Details</h4>
				</div>
				
				<div class="content">
				<form name="reviewfrm" method="POST" action="">
					<p>Payment method: <span style="text-decoration : underline; color : red;">Cash On Delivery</span>
					</p>
					<p>Full Name: <br /><input type="text" name="custFullName" value="<?php echo $row['member_name']; ?>"/> <br />
					Shipping address: <br/><textarea id="inputAddress" name="shippingAddress" cols="30" rows="5"><?php echo $row['member_address']; ?></textarea><span class="messages" id="message1"></span> <br />
					<?php
						$sql3 = mysqli_query($conn,"SELECT * FROM state");
					?>
					State: <br /><select name="delivery_state">
									<?php while($row4 = mysqli_fetch_assoc($sql3)) 
									{?>
										<option value="<?php echo $row4['state_name']; ?>"><?php echo $row4['state_name']; ?></option><?php 
									}?>
								</select><br />
					<br />
					
					<?php
						$sql2 = mysqli_query($conn,"SELECT * FROM city");
					?>
					City: <br /><select name="delivery_city">
									<?php while($row3 = mysqli_fetch_assoc($sql2)) 
									{?>
										<option value="<?php echo $row3['city_name']; ?>"><?php echo $row3['city_name']; ?></option><?php 
									}?>
								</select><br />
					Postcode: <br /><input type="text" id="inputPostcode" maxlength="5" name="custPostcode" value="<?php echo $row['member_postcode']; ?>"/><span class="messages" id="message2"></p>
					
					<p>Contact Number: <br /><span style="color : red; font-size : 0.7em;">*Please make sure that the number are correct and valid</span><br/>
					<input type="text" maxlength="12" name="custContact" value="<?php echo $row['member_contact']; ?>"/></p>
					
					
					<h2>Review Order</h2>
					<div class="table">
					<table>
						<tr>
							<th>Item</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>Remarks</th>
							<th>Price(Inclusive GST)</th>
						</tr>
						
						<?php
						$gst = mysqli_query($conn, "SELECT * FROM gst WHERE gst_status = 'Active'");
						$row5 = mysqli_fetch_assoc($gst);
						$sql2 = "SELECT * FROM member m INNER JOIN cart sc ON m.member_id = sc.member_id INNER JOIN menu men ON sc.menu_id = men.menu_id WHERE m.member_id = $buyerID";
						$result2 = mysqli_query($conn, $sql2);
	
						while($row = mysqli_fetch_assoc($result2))
						{?>
						<tr>
							<input type="hidden" name="menuID" value="<?php echo $row['menu_id']; ?>" />
							<td><img src="admin/<?php echo $row['menu_path'] ?>" /></td>
							<td><?php echo $row['menu_name']; ?></td>
							<td><?php echo $row['quantity']; ?></td>
							<td><?php echo $row['remarks']; ?></td>
							<td style="color : red;">RM <span style="font-weight : bold"><?php echo  number_format((float)$row['total']+($row['total']*($row5['gst_value']/100)), 2, '.', ''); ?></span></td>
							<?php $gtotal +=  $row['total'];?>
						</tr><?php
						}?>
						
						<tr>
							<td colspan="5"><span style="float : right; font-size : 2.5em;">Total Amount : <span style="color : red;">RM <?php echo  number_format((float)$gtotal+($gtotal*($row5['gst_value']/100)), 2, '.', ''); ?></span></span></td>
						</tr>
					</table>
				</div>
					
					<input type="submit" name="confirmbtn" value="Confirm order"/>
					<a href="view_cart.php"><input type="button" name="goBackBtn" value="Go back"/></a>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php $nav->footer2() ?>
</body>
</html>
<?php
if(isset($_POST['confirmbtn']))
{
	$price = "";
	$remarks = "";
	$quantity = "";
	$total = "";
	$menuID = "";
	$error = false;
	$address = $_POST['shippingAddress'];
	$postcode = $_POST['custPostcode'];
	
	if(empty($address) && $address == "")
	{
		echo"<script type=\"text/javascript\">
			document.getElementById(\"message1\").innerHTML = \"&nbsp;Please do not leave blank on address&nbsp;\";
			document.getElementById(\"inputAddress\").focus();
		</script>";
			
		$error = true;
	}
	
	if(empty($postcode) && $postcode == "")
	{
		echo"<script type=\"text/javascript\">
			document.getElementById(\"message2\").innerHTML = \"&nbsp;Please do not leave blank on post code&nbsp;\";
			document.getElementById(\"inputPostcode\").focus();
		</script>";
			
		$error = true;
	}
	
	if(!is_numeric($postcode))
	{
		echo"<script type=\"text/javascript\">
			document.getElementById(\"message2\").innerHTML = \"&nbsp;Please enter a valid post code&nbsp;\";
			document.getElementById(\"inputPostcode\").focus();
		</script>";
			
		$error = true;
	}
	
	if(!$error)
	{
		$sel = mysqli_query($conn, "SELECT * FROM member WHERE member_id = $buyerID");
		$row2 = mysqli_fetch_assoc($sel);
		$encrypt = mt_rand(100000, 999999);
		$update = "UPDATE member SET otp = '$encrypt' WHERE member_id = $buyerID";
		mysqli_query($conn, $update);
		$mail = new PHPMailer();
		$pass = "tokwalurxhzzqqtk";
		$message = "Dear " . $row2['member_name'] . 
		", \n\nWe have received an order from your account. To avoid fake orders, you are required to copy the code below and paste it following link: \n\n"
		.$encrypt.
		"\n\nlocalhost/deliccio/verification.php?mid=".
		$row2['member_id']
		. "\n\nNOTE : IF YOU DID NOT MADE THIS ORDER, PLEASE IGNORE THIS EMAIL";
		// ---------- adjust these lines ---------------------------------------
		$mail->Username = "lunarcafe123@gmail.com"; // your GMail user name
		$mail->Password = $pass; 
		$mail->AddAddress($row2['member_email']); // recipients email
		$mail->FromName = "Lunar Cafe"; // readable name

		$mail->Subject = "Order Verification";
		$mail->Body    = $message; 
		//-----------------------------------------------------------------------

		$mail->Host = "ssl://smtp.gmail.com"; // GMail
		$mail->Port = 465;
		$mail->IsSMTP(); // use SMTP
		$mail->SMTPAuth = true; // turn on SMTP authentication
		$mail->From = $mail->Username;
		if(!$mail->Send())
			echo "Mailer Error: " . $mail->ErrorInfo;
		else
		{
			$_SESSION['address'] = $_POST['shippingAddress'];
			$_SESSION['postcode'] = $_POST['custPostcode'];
			$_SESSION['deliveryCity'] = $_POST['delivery_city'];
			$_SESSION['deliveryState'] = $_POST['delivery_state'];
			$_SESSION['gtotal'] = $gtotal;
			
			?>
				<div id="dialog" title="Alert">
				<p>We have sent you an email to verify this order</p>
				</div>
			<?php
			
			
			echo "<script type=\"text/javascript\">
				setTimeout(\"location.href = 'verification.php?mid=".$row2['member_id']."';\",4000);
			</script>";
		}
	}
}
?>