<?php
include ("dbconnection.php");
require("PHPMailer/class.phpmailer.php");
include "nav.php";
ob_start();

$nav = new navigation($conn);
?>
<!DOCTYPE html>
<html>
<head>
<title>Lunar | Forget Password</title>
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
	width : 500px;
	text-align : center;
	border : 1px solid black;
	overflow : hidden;
	padding : 10px;
	background-color : rgba(255, 255, 255,0.5);
	margin-bottom : 20px;
	font-family : Verdana;
	border-radius : 10px;
}

input[type="email"]
{
	border : 1px solid black;
	width : 300px;
	padding : 7px;
	float : left;
	background-image : url(images/contact.png);
	background-size : 25px 25px;
    background-position : 2px 1px; 
    background-repeat : no-repeat;
	padding-left : 35px;
}

input[type="email"]:hover
{
	background-color : #f1ff96;
}

input[type="email"]:focus
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
	text-align : center;
	font-weight : bold;
	font-size : 1.5em;
	float : left;
	margin-right : 30px;
}

h2
{
	font-size : 3em;
	font-family : Georgia;
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
<form name="forgetPassfrm" method="POST" action="">
		<h2>Forgot your password?</h2>
		<p>Please enter the email address registered to your account.</p>
		<label>E-mail</label>
			<input type="email" name="memberEmail" placeholder="Enter your email"/>
		
		<br />
		<br />
		
		<div class="button">
		<input type="submit" name="resetbtn" value="Reset Password" />
		</div>

</form>
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
	if(isset($_POST['resetbtn']))
	{
		$email = $_POST['memberEmail'];
		
		// Empty email input.
		if($email == '')
		{
			?>
					<div id="dialog" title="Alert">
					<p>Please enter your email</p>
					</div>
				<?php
		}
		
		else
		{
			$sql = mysqli_query($conn, "SELECT * FROM member WHERE member_email = '$email'");
			
			if(mysqli_num_rows($sql) == 0)
			{
				?>
					<div id="dialog" title="Alert">
					<p>Email does not exists</p>
					</div>
				<?php
			}
			
			else
			{
				$sel = mysqli_query($conn, "SELECT * FROM member WHERE member_email = '$email'");
				$row2 = mysqli_fetch_assoc($sel);
				$encrypt = md5(strtotime(date("Y-m-d H:i:s"))*$row2['member_id']);
				$update = "UPDATE member SET otp = '$encrypt' WHERE member_email = '$email'";
				mysqli_query($conn, $update);
				$mail = new PHPMailer();
				$row = mysqli_fetch_assoc($sql);
				$pass = "tokwalurxhzzqqtk";
				$message = "Dear " . $row['member_name'] . 
				", \n\nWe have received a request to reset your password for your Lunar Cafe account: \n"
				. $row['member_email'] . ". We are here to help! 
				\n\nCopy the link below and paste it in your url \n\n localhost/deliccio/reset_password.php?code=".
				$encrypt
				. "\n\nNOTE : IF YOU DID NOT REQUEST TO RESET YOUR PASSWORD, PLEASE IGNORE THIS EMAIL";
				// ---------- adjust these lines ---------------------------------------
				$mail->Username = "lunarcafe123@gmail.com"; // your GMail user name
				$mail->Password = $pass; 
				$mail->AddAddress($email); // recipients email
				$mail->FromName = "Lunar Cafe"; // readable name

				$mail->Subject = "Reset Password";
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
					?>
						<div id="dialog" title="Alert">
						<p>Message sent</p>
						</div>
					<?php
				}
			}
		}
	}
}

catch(Exception $e)
{
	$e->getMessage();
}
?>