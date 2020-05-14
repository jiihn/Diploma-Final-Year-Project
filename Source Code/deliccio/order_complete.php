<?php
include "nav.php";
include ("dbconnection.php");

$nav = new navigation($conn);

if ($_SESSION["loggedin"] != 1)
{
	header("Location: login.php");
}

$purchase_id = $_SESSION['purchase_id'];

if(!isset($purchase_id))
{
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Order Complete</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script src="js/jquery-1.6.js" ></script>
<script src="js/cufon-yui.js"></script>
<script src="js/cufon-replace.js"></script>
<script src="js/Forum_400.font.js"></script>
<script src="js/atooltip.jquery.js"></script>
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
	height : 500px;
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

.content p
{
	font-size : 1.2em;
	
}

.content textarea
{
	padding : 2px;
	padding-left : 5px;
	border : 1px solid black;
}

.content select
{
	padding : 5px;
	border : 1px solid black;
}

.content input[type="submit"], input[type="button"]
{
	padding : 5px;
	background-color : #f44242;
	color : white;
	border-radius : 5px;
}

.content input[type="submit"]:hover
{
	cursor : pointer;
	opacity : 0.5;
}

.content a:hover
{
	cursor : pointer;
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
					<h4 style="text-decoration : underline; color : red;">Order Complete</h4>
					<img src="images/right-arrow.png" style="float : right; width : 20px; height : 20px;"/>
					<h4>Order/Payment</h4>
					<img src="images/right-arrow.png" style="float : right; width : 20px; height : 20px;"/>
					<h4>Shopping Cart</h4>
					<h3>Order Complete</h3>
				</div>
				
				<div class="header1">
					<h4>Order Complete</h4>
				</div>
				
				<div class="content">
					<h2>Thank you for your order!</h2>
					Click <a href="fpdf/form.php?pid=<?php echo $purchase_id ?>" target="_blank">here</a> to print the receipt<br /><br />
					<a href="index.php"><input type="button" value="Home" /></a>
				</div>
	  
	  
	  </div>
	</div>
</div>
</div>
<?php $nav->footer2() ?>
</body>
</html>