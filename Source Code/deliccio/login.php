<?php
include ("dbconnection.php");
include "nav.php";
ob_start();

$nav = new navigation($conn);
?>
<!DOCTYPE html>
<html>
<head>
<title>Lunar | Log In</title>
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
	border : 1px solid black;
	width : 950px;
	padding : 10px;
	margin : 0 auto;
	background-color : rgba(255, 255, 255,0.5);
	margin-bottom : 20px;
	font-family : Georgia;
	border-radius : 10px;
}

input[type="email"], input[type="password"]
{
	border : 1px solid black;
	width : 300px;
	padding : 7px;
	float : left;
}

input[type="email"]
{
	background-image : url(images/contact.png);
	background-size : 25px 25px;
    background-position : 2px 1px; 
    background-repeat : no-repeat;
	padding-left : 35px;
}

input[type="password"]
{
	background-image : url(images/padlock.png);
	background-size : 25px 25px;
    background-position : 2px 1px; 
    background-repeat : no-repeat;
	padding-left : 35px;
}

input[type="email"]:hover, input[type="password"]:hover
{
	background-color : #f1ff96;
}

input[type="email"]:focus, input[type="password"]:focus
{
	background-color : #f1ff96;
}

.button input[type=submit]
{
	border-radius : 2px;
	width : 100px;
	height : 30px;
	background-color : #f44242;
	color : white;
}

.button input[type=button]
{
	border-radius : 2px;
	width : 100px;
	height : 30px;
	background-color : #1d59ba;
	color : white;
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
	float : left;
}

.login
{
	font-size : 2em;
}

.main-wrapper
{
	
	overflow : auto;
	font-family : Verdana;
}

.left-content
{
	float : left;
	margin-right : 10px;
	border-right : 2px solid black;
	padding-right : 20px;
	margin-bottom : 10px;
	padding : 40px;
}

.right-content
{
	padding : 50px;
	float : left;
	display : inline;
}

.forget-pass a:hover
{
	cursor : pointer;
	color : red;
}
</style>
</head>
<?php 
$nav->header1($conn);?>
        <!-- / header -->
		
<fieldset>
<div class="main-wrapper">
<div class="left-content">
<form name="loginfrm" method="POST" action="">
		<label class="login">Log In</label>
		<br />
		<br />
		<label>E-mail</label> <br />
			<input type="email" name="memberEmail" value="<?php echo isset($_POST["memberEmail"]) ? $_POST["memberEmail"] : ''; ?>" placeholder="Enter your email"/>
		
		<br />
		<br />
	
		<label>Password</label> <br />
			<input type="password" name="memberPass" value="<?php echo isset($_POST["memberPass"]) ? $_POST["memberPass"] : ''; ?>" placeholder="Enter your password"/>
		
		<br />
		<br />
		<div class="button">
		<input type="submit" name="loginbtn" value="Log In" />
		<span class="forget-pass"><a href="forget_pass.php">Forgot password?</a></span>
		</div>

</form>
</div>
<div class="right-content">
<form name="signup">
	<label class="login" style="margin-top : 50px; font-size : 2em;">Are you a new Customer?</label>
	<br />
	<br />
	<br />
	<br />
	<p>Start shopping with us.</p>
	<div class="button">
	<a href="signup.php"><input type="button" name="signupbtn" value="Sign Up" /></a>
	</div>
</form>
</div>
</div>
</fieldset>
<br />
		</div>
	  </div>
	</div>

<?php $nav->footer2() ?>
</body>
</html>

<?php
try
{
	if(isset($_POST['loginbtn']))
	{
		$email = $_POST['memberEmail'];
		$pass = $_POST['memberPass'];
		
		// Empty email input.
		if($email == '')
		{
			?>
					<div id="dialog" title="Alert">
					<p>Please enter your email</p>
					</div>
				<?php
				
			/* echo "<script type=\"text/javascript\">
				alert(\"Please enter your email\");
			</script>"; */
		}
		
		// Empty password input.
		else if($pass == '')
		{
			?>
					<div id="dialog" title="Alert">
					<p>Please enter your password</p>
					</div>
				<?php
			
			/* echo "<script type=\"text/javascript\">
				alert(\"Please enter your password\");
			</script>"; */
		}
		
		else
		{
			// Check email.
			$pass2 = md5($pass);
			$result = mysqli_query($conn, "SELECT * FROM member WHERE member_email = '$email' AND member_password = '$pass2'");
			$row = mysqli_fetch_assoc($result);
			
			// Wrong email or password.
			if(mysqli_num_rows($result) == 0)
			{
				?>
					<div id="dialog" title="Alert">
					<p>Wrong email or password</p>
					</div>
				<?php
				
				/* echo "<script type=\"text/javascript\">
					alert(\"Wrong email or password\");
				</script>"; */
			}
			
			// Correct email and password.
			else
			{
				$_SESSION["sess_memid"] = $row["member_id"];
				$_SESSION["loggedin"] = 1;
				header("Location: index.php");
			}
		}
	}
}

catch(Exception $e)
{
	$e->getMessage();
}
?>