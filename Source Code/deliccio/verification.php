<?php
include "nav.php";
include ("dbconnection.php");

$exists = false;

if ($_SESSION["loggedin"] != 1)
{
	header("Location: login.php");
}

if (!isset($_REQUEST["mid"]))
{
	echo "<script type=\"text/javascript\">
		setTimeout(\"location.href = 'index.php';\",1);
	</script>";
}

else
{
	$nav = new navigation($conn);
	
	$mid = $_REQUEST["mid"]; 

	$result = mysqli_query($conn, "SELECT * FROM member WHERE member_id = $mid");
	
	if(mysqli_num_rows($result) == 0)
	{
		echo "<script type=\"text/javascript\">
			setTimeout(\"location.href = 'index.php';\",1);
		</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Verification</title>
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
body
{
	background-image : url(images/background.jpg);
}

fieldset
{
	margin : 0 auto;
	width : 700px;
	text-align : center;
	border : 1px solid black;
	overflow : hidden;
	padding : 10px;
	background-color : rgba(255, 255, 255,0.5);
	margin-bottom : 20px;
	font-family : Verdana;
	border-radius : 10px;
}

input[type="text"]
{
	border : 1px solid black;
	width : 300px;
	padding : 7px;
	background-size : 25px 25px;
    background-position : 2px 1px; 
    background-repeat : no-repeat;
}

input[type="text"]:hover
{
	background-color : #f1ff96;
}

input[type="text"]:focus
{
	background-color : #f1ff96;
}

.button input[type=submit]
{
	border-radius : 2px;
	width : 200px;
	height : 30px;
	background-color : #f44242;
	color : white;
	border-radius : 6px;
}

.button input[type=submit]:hover
{
	background-color : #ff2d2d;
	color : white;
	cursor : pointer;
}

.button input[type=button]:hover
{
	background-color : #2870e2;
	color : white;
	cursor : pointer;
}

label
{
	font-weight : bold;
	font-size : 1.5em;
}

h2
{
	font-size : 3em;
	font-family : Verdana;
}

.main-wrapper
{
	
	overflow : auto;
	font-family : Verdana;
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
		<fieldset>
			<div class="main-wrapper">
			<div class="left-content">
			<form name="verificationfrm" method="POST" action="">
					<h2>Order Verification</h2>
					<label>Verification Code</label><br/>
						<input type="text" name="verifyCode" maxlength="100" value="<?php echo isset($_POST["verifyCode"]) ? $_POST["verifyCode"] : ''; ?>" placeholder="Enter verify code"/>
					
					<br />
					<br />
					
					<div class="button">
						<input type="submit" name="verifybtn" value="Verify" />
					</div>

			</form>
			</div>
			</div>
		</fieldset>
		<br />
	</div>
</div>		
		
<?php $nav->footer2() ?>
</body>
</html>
<?php
if(isset($_POST['verifybtn']))
{
	$code = $_POST['verifyCode'];
	
	$sql = "SELECT * FROM member WHERE member_id = $mid AND otp = $code";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) != 1)
	{
		?>
			<div id="dialog" title="Alert">
			<p>Wrong verification code.</p>
			</div>
		<?php
	}
	
	else
	{
		$price = "";
		$remarks = "";
		$quantity = "";
		$total = "";
		$menuID = "";
		$gtotal = $_SESSION['gtotal'];
		$address = $_SESSION['address'];
		$city = $_SESSION['deliveryCity'];
		$state = $_SESSION['deliveryState'];
		$postcode = $_SESSION['postcode'];
		$row = mysqli_fetch_assoc($result);
		$gst = mysqli_query($conn, "SELECT * FROM gst WHERE gst_status = 'Active'");
		$row5 = mysqli_fetch_assoc($gst);
		
		$gst_id = $row5['gst_id'];
		$deliveryAddress = strtoupper($address . " " . $city . " " . $row['member_postcode'] . " " . $state);
		$state = $_SESSION['deliveryState'];
			
		$ins = "INSERT INTO purchase 
		(purchase_date, purchase_time, purchase_amount, purchase_delivery_address, purchase_delivery_status, 
		purchase_delivery_state, member_id, gst_id)
		VALUES (now(), now(), $gtotal, '$deliveryAddress', 'Pending', '$state', $mid, $gst_id)";
			
		$success = mysqli_query($conn, $ins);
			
		if($success)
		{
			$last_id = mysqli_insert_id($conn);
			$sel = mysqli_query($conn, "SELECT * FROM cart c INNER JOIN menu m ON c.menu_id = m.menu_id WHERE member_id = $mid");
			while($row2=mysqli_fetch_assoc($sel))
			{
				$price = $row2['menu_price'];
				$remarks = $row2['remarks'];
				$quantity = $row2['quantity'];
				$total = $row2['total'];
				$menuID = $row2['menu_id'];
				
				$ins2 = "INSERT INTO purchase_item 
				(purchase_item_price, purchase_item_details, purchase_item_quantity, purchase_item_total, menu_id, purchase_id) 
				VALUES ($price, '$remarks', $quantity, $total, $menuID, $last_id)";
				
				$result3 = mysqli_query($conn, $ins2);
			}
			
			if($result3)
			{
				?>
					<div id="dialog" title="Alert">
					<p>Order Complete</p>
					</div>
				<?php
					
				mysqli_query($conn, "DELETE FROM cart WHERE member_id = $mid");
				mysqli_query($conn, "UPDATE member SET otp = '' WHERE member_id = $mid");
				unset ($_SESSION['buyerID']);
				unset ($_SESSION['gtotal']);
				unset ($_SESSION['address']);
				unset ($_SESSION['deliveryCity']);
				unset ($_SESSION['deliveryState']);
				unset ($_SESSION['postcode']);
				
				$_SESSION['purchase_id'] = $last_id;
				
				echo "<script type=\"text/javascript\">
					setTimeout(\"location.href = 'order_complete.php';\",3000);
				</script>";
			}
		}
			
		else
		{
			echo mysqli_error($conn);
		}
	}
}
?>