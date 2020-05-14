<?php
include ("dbconnection.php");
include "nav.php";
ob_start();

$nav = new navigation($conn);

if (!isset($_REQUEST["code"]))
{
	echo "<script type=\"text/javascript\">
		setTimeout(\"location.href = 'index.php';\",1);
	</script>";
}

else
{
	$code = $_REQUEST["code"];
	
	$sql = mysqli_query($conn, "SELECT * FROM member WHERE otp = '$code'");
	
	if(mysqli_num_rows($sql) == 0)
	{
		?>
			<div id="dialog" title="Alert">
			<p>Invalid Code</p>
			</div>
		<?php
				
			echo "<script type=\"text/javascript\">
				 setTimeout(\"location.href = 'login.php';\",3000);
			</script>";
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Lunar | Reset Password</title>
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

input[type="password"]
{
	border : 1px solid black;
	width : 300px;
	padding : 7px;
	background-image : url(images/padlock.png);
	background-size : 25px 25px;
    background-position : 2px 1px; 
    background-repeat : no-repeat;
	padding-left : 35px;
}

input[type="password"]:hover
{
	background-color : #f1ff96;
}

input[type="password"]:focus
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
</head>
<?php 
$nav->header1($conn);?>
        <!-- / header -->
		
<fieldset>
<div class="main-wrapper">
<div class="left-content">
<form name="resetPassfrm" method="POST" action="">
		<h2>Reset password</h2>
		<label>New Password</label><br/>
			<input type="password" name="memberNewPass" maxlength="12" value="<?php echo isset($_POST["memberNewPass"]) ? $_POST["memberNewPass"] : ''; ?>" placeholder="Enter new password"/>
			
			<br />
			<br />
		<label>Confirm Password</label><br/>
			<input type="password" name="ConMemberNewPass" maxlength="12" value="<?php echo isset($_POST["ConMemberNewPass"]) ? $_POST["ConMemberNewPass"] : ''; ?>" placeholder="Confirm new password"/>
		
		<br />
		<br />
		
		<div class="button">
		<input type="submit" name="resetbtn" value="Reset Password" />
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
if(isset($_POST['resetbtn']))
{
	$error = false;
	$newPass = $_POST['memberNewPass'];
	$conNewPass = $_POST['ConMemberNewPass'];
	
	if($newPass == "")
	{
		?>
			<div id="dialog" title="Alert">
			<p>Please enter your password</p>
			</div>
		<?php
		$error = true;
	}
	
	if($conNewPass == "")
	{
		?>
			<div id="dialog" title="Alert">
			<p>Please confirm your new password</p>
			</div>
		<?php
		$error = true;
	}
	
	if(strlen($newPass) < 6)
	{
		?>
			<div id="dialog" title="Alert">
			<p>Password must be more than 6</p>
			</div>
		<?php
		$error = true;
	}
	
	if($conNewPass != $newPass)
	{
		?>
			<div id="dialog" title="Alert">
			<p>Password does not match</p>
			</div>
		<?php
		$error = true;
	}
	
	if(!$error)
	{
		$pass = md5($newPass);
		
		$reset = mysqli_query($conn, "UPDATE member SET member_password = '$pass' WHERE otp = '$code'");
		
		if($reset)
		{
			$clear = mysqli_query($conn, "UPDATE member SET otp = '' WHERE otp = '$code'");
			
			if($clear)
			{
				?>
					<div id="dialog" title="Alert">
					<p>Password reset successfully!</p>
					</div>
				<?php
				
				echo "<script type=\"text/javascript\">
					setTimeout(\"location.href = 'login.php';\",4000);
				</script>";
			}
		}
	}
}
?>