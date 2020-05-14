<?php
include "nav.php";
include ("dbconnection.php");

$nav = new navigation($conn);

if ($_SESSION["loggedin"] != 1)
{
	header("Location: login.php");
}

$memid = $_SESSION['sess_memid'];

if (isset($_REQUEST["mid"]))
{
	$mid = $_REQUEST["mid"]; 
	mysqli_query($conn, "DELETE FROM cart WHERE menu_id = $mid AND member_id = $memid");
	
	header("Location: view_cart.php");
}

/*if (isset($_REQUEST["eid"]))
{
	$eid = $_REQUEST["eid"];
}*/

$sql3 = "DELETE FROM cart WHERE expired < DATE_ADD(NOW(),INTERVAL -5 DAY)";
$del = mysqli_query($conn, $sql3);

$sql5 = mysqli_query($conn, "SELECT * FROM gst WHERE gst_status = 'Active'");
$row5 = mysqli_fetch_assoc($sql5);

$sel = "SELECT m.menu_id, m.menu_name, m.menu_ingredient, m.menu_price, m.menu_spicelevel, 
		m.menu_path, c.cart_id, c.menu_id, c.member_id, c.quantity, c.total, c.remarks FROM menu m INNER JOIN cart c 
		ON m.menu_id = c.menu_id WHERE member_id = $memid";
		
$sql = mysqli_query($conn, $sel);


$gtotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Lunar | Shopping Cart</title>
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="http://t4t5.github.io/sweetalert/dist/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="http://t4t5.github.io/sweetalert/dist/sweetalert.css">
  <script>
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Delete all items": function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  } );
  </script>
<script>
  $( function() {
    $( "#dialog" ).dialog();
  } );
  </script>
  
  <script type="text/javascript">

function confirmation()
{
	con = confirm("Are you sure you want to delete this item?");
	
	return con;
}
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

.table input[type=submit]:hover
{	
	opacity : 0.5;
	cursor : pointer;
}

.button input
{
	background-color : #f44242;
	color : white;
	width : 200px;
	height : 30px;
	margin : 0 auto;
	margin-top : 5px;
	border-radius : 5px;
}

.button input:hover
{
	opacity : 0.5;
	cursor : pointer;
}

.orderBtn a:hover
{
	opacity : 0.5;
	cursor : pointer;
}
</style>

</head>
<?php 
$nav->header1($conn);				
?>
      <!-- / header -->
	  
			<div class="main-wrapper">
				<div class="header">
					<img src="images/shopping-cart.ico" />
					<h4>Order Complete</h4>
					<img src="images/right-arrow.png" style="float : right; width : 20px; height : 20px;"/>
					<h4>Order/Payment</h4>
					<img src="images/right-arrow.png" style="float : right; width : 20px; height : 20px;"/>
					<h4 style="text-decoration : underline; color : red;">Shopping Cart</h4>
					<h3>Shopping Cart</h3>
				</div>
				
				<form name="cartFrm" method="post" action="">
				<div class="header1">
					<h4>Shopping List</h4>
				</div>
				
				<div class="table">
					<table>
						<tr>
							<th>Item</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>GST</th>
							<th>Total(Inclusive GST)</th>
							<th>Remarks</th>
							<th>Action</th>
						</tr>
						
						<?php
						while($row = mysqli_fetch_assoc($sql))
						{?>
						<tr>
							<input type="hidden" name="menuID" value="<?php echo $row['menu_id']; ?>" />
							<td><img src="admin/<?php echo $row['menu_path'] ?>" /></td>
							<td><?php echo $row['menu_name']; ?></td>
							<td><?php echo $row['quantity']?></td>
							<td style="color : red;">RM <span style="font-weight : bold"><?php echo  number_format((float)$row['menu_price'], 2, '.', ''); ?></span></td>
							<td><?php  echo $row5['gst_value'] ?>%</td>
							<td style="color : red;">RM <span style="font-weight : bold"><?php echo  number_format((float)$row['total']+($row['total']*($row5['gst_value']/100)), 2, '.', ''); ?></span></td>
							<td><?php echo  $row['remarks']; ?></span></td>
							<td><a href="product_description.php?pid=<?php echo $row['menu_id']; ?>"><input type="button" name="editbtn" value="Edit" style="background-color : #f44242; color : white; padding : 5px; border-radius : 5px; border : 1px solid black; margin-bottom : 5px; width : 70px;"/></a>
							<a href="view_cart.php?mid=<?php echo $row['menu_id']; ?>" onclick="return confirmation();"><input type="button" name="deletebtn" value="Delete" style="background-color : white; color : black; padding : 5px; border-radius : 5px; border : 1px solid black; margin-bottom : 5px; width : 70px;"/></a></td>
							<?php $total = $row['menu_price'] * $row['quantity']?>
							<?php $gtotal +=  $total?>
						</tr><?php
						}?>
						
						<tr>
							<td colspan="8"><span style="float : right; font-size : 2.5em;">Total Amount : <span style="color : red;">RM <?php echo  number_format((float)$gtotal+($gtotal*($row5['gst_value']/100)), 2, '.', ''); ?></span></span></td>
						</tr>
					</table>
				</div>
				
				<div class="button">
					<input type="submit" name="orderAllbtn" value="Checkout" />
				</div>
				</form>
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
	if(isset($_POST['orderAllbtn']))
	{
		$sql4 = mysqli_query($conn, "SELECT * FROM cart WHERE member_id = $memid");
		
		if(mysqli_num_rows($sql4) == 0)
		{
			?>
				<div id="dialog" title="Alert">
				<p>Your cart is empty</p>
				</div>
			<?php
			
			echo "<script type=\"text/javascript\">
				 setTimeout(\"location.href = 'view_cart.php';\",3000);
			</script>";
		}
		
		else
		{
			$_SESSION['buyerID'] = $memid;
			
			echo "<script type=\"text/javascript\">
					 setTimeout(\"location.href = 'order&payment.php';\",1);
				</script>";
		}
	}
}

catch(Exception $e)
{
	$e->getMessage();
}
?>