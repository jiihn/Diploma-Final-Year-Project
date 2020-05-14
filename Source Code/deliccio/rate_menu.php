<?php
include ("dbconnection.php");
include "nav.php";
ob_start();

$nav = new navigation($conn);

if ($_SESSION["loggedin"] != 1)
{
	header("Location: login.php");
}

else
{
	if(!isset($_REQUEST['mid']) || !isset($_REQUEST['pid']))
	{
		header("Location: view_order_details.php");
	}
	
	else
	{
		$mid = $_REQUEST['mid'];
		$pid = $_REQUEST['pid'];
		
		$nav = new navigation($conn);

		$sess_memid = $_SESSION["sess_memid"]; 

		$result = mysqli_query($conn, "SELECT * FROM member WHERE member_id = $sess_memid");
		$row = mysqli_fetch_assoc($result);
		
		$sql = mysqli_query($conn, "SELECT * FROM menu WHERE menu_id = $mid");
		
		$row = mysqli_fetch_assoc($sql);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Lunar | Rate Menu</title>
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

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
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

.button input[type=submit]
{
	border-radius : 2px;
	width : 200px;
	height : 30px;
	background-color : #f44242;
	color : white;
	border-radius : 6px;
}

.button input[type=button]
{
	border-radius : 2px;
	width : 200px;
	height : 30px;
	background-color : orange;
	color : white;
	border-radius : 6px;
}

.button input[type=submit]:hover
{
	border : 1px solid #f44242;
	background-color : white;
	color : #f44242;
	cursor : pointer;
}

.button input[type=button]:hover
{
	border : 1px solid orange;
	background-color : white;
	color : orange;
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

select
{
	border : 1px solid black;
}

textarea
{
	border : 1px solid black;
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
</style>
</head>
<?php 
$nav->header1($conn);?>
        <!-- / header -->
		
<fieldset>
<div class="main-wrapper">
<div class="left-content">
<form name="changePassfrm" method="POST" action="">
		<h2>Rate Menu</h2>
		<table>
			<tr>
				<th>Menu Image</th>
				<th>Menu Name</th>
			</tr>
			
			<tr>
				<td><img src="admin/<?php echo $row['menu_path'] ?>" width="75px" height="75px"></td>
				<td><b><?php echo $row['menu_name'] ?></b></td>
			</tr>
		</table>
		
		<?php
			$check = mysqli_query($conn, "SELECT * FROM comment_and_rating WHERE purchase_id = $pid AND member_id = $sess_memid AND menu_id = $mid");
			
			if(mysqli_num_rows($check) != 0)
			{
				$exists = mysqli_fetch_assoc($check);
				?>
				<label>Rating</label><br/>
					<select name="menuRating">
						<option <?php echo ($exists['rating'] == 1)?"selected":"" ?>>1</option>
						<option <?php echo ($exists['rating'] == 2)?"selected":"" ?>>2</option>
						<option <?php echo ($exists['rating'] == 3)?"selected":"" ?>>3</option>
						<option <?php echo ($exists['rating'] == 4)?"selected":"" ?>>4</option>
						<option <?php echo ($exists['rating'] == 5)?"selected":"" ?>>5</option>
					</select>
					
					<br />
					<br />
				
					<label>Comments</label><br/>
					<p><textarea name="menuComment" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"><?php echo $exists['comment_feedback']; ?></textarea></p>
				<?php
			}
			
			else
			{?>
				<label>Rating</label><br/>
				<select name="menuRating">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				
				<br />
				<br />
			
				<label>Comments</label><br/>
				<p><textarea name="menuComment" placeholder="Maximum 200 characters including spaces" cols="30" rows="5"></textarea></p>
				<?php
			}
		?>		
		
		<div class="button">
		<input type="submit" name="submitbtn" value="Submit" />
		<input type="button" onclick="window.history.go(-1)" name="backbtn" value="Back">
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
if(isset($_POST['submitbtn']))
{
	$rating = $_POST['menuRating'];
	$comment = $_POST['menuComment'];
	
	if(empty($comment))
	{
		?>
			<div id="dialog" title="Alert">
			<p>Please do not leave blank on comments</p>
			</div>
		<?php
	}
	
	else
	{
		$sel = mysqli_query($conn, "SELECT * FROM comment_and_rating WHERE member_id = $sess_memid AND menu_id = $mid");
		
		if(mysqli_num_rows($sel) != 0)
		{
			$update = mysqli_query($conn, "UPDATE comment_and_rating 
			SET comment_rating_date = now(), comment_rating_time = now(), 
			rating = $rating, comment_feedback = '$comment', member_id = $sess_memid, purchase_id = $pid, menu_id = $mid 
			WHERE member_id = $sess_memid AND menu_id = $mid");
			
			if($update)
			{
				?>
				<div id="dialog" title="Alert">
				<p>Thank you for your comment and rating. Your feedback has been updated</p>
				</div>
				<?php
				
				echo "<script type=\"text/javascript\">
					 setTimeout(\"location.href = 'view_order_details.php';\",4000);
				</script>";
			}
		}
		
		else
		{
			$ins = mysqli_query($conn, "INSERT INTO comment_and_rating 
			(comment_rating_date, comment_rating_time, rating, comment_feedback, member_id, purchase_id, menu_id) 
			VALUES (now(), now(), $rating, '$comment', $sess_memid, $pid, $mid)");
			
			if($ins)
			{
				?>
				<div id="dialog" title="Alert">
				<p>Thank you for your feedback to help us improve our meals</p>
				</div>
				<?php
				
				echo "<script type=\"text/javascript\">
					 setTimeout(\"location.href = 'view_order_details.php';\",4000);
				</script>";
			}
		}
	}
}
?>