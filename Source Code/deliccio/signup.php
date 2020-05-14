<?php
include ("dbconnection.php");
include "nav.php";
ob_start();

$nav = new navigation($conn);
?>
<!DOCTYPE html>
<html>
<head>
<title>Lunar | Sign Up</title>

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

<script type="text/javascript">
function check_input()
{
	var password_strength = document.getElementById("message1");
	var password = document.signupfrm.new_member_password.value;
 
        //Password length less than 6.
        if (password.length < 6) {
            password_strength.innerHTML = "<span style='color : red;'>Password must be at least 6 characters</span>";
            return;
        }
 
        //Regular Expressions.
        var regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[a-z]"); //Lowercase Alphabet.
        regex.push("[0-9]"); //Digit.
        regex.push("[$@$!%*#?&]"); //Special Character.
 
        var passed = 0;
 
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(password)) {
                passed++;
            }
        }
 
        //Validate for length of Password.
        if (passed > 2 && password.length > 8) {
            passed++;
        }
 
        //Display status.
        var color = "";
        var strength = "";
        switch (passed) {
            case 0:
            case 1:
                strength = "Weak";
                color = "red";
                break;
            case 2:
                strength = "Good";
                color = "darkorange";
                break;
            case 3:
            case 4:
                strength = "Strong";
                color = "green";
                break;
            case 5:
                strength = "Very Strong";
                color = "darkgreen";
                break;
        }
        password_strength.innerHTML = "<span style='color:black'>Password Strength : </span>" +strength;
        password_strength.style.color = color;
}

function check_pass()
{
	var pass = document.signupfrm.new_member_password.value;
	var conPass = document.signupfrm.new_member_confirmPassword.value;
	
	if(pass != conPass)
	{
		document.getElementById("message2").innerHTML = "Password does not match";
	}
	
	else
	{
		document.getElementById("message2").innerHTML = "";
	}
}
</script>
<style type="text/css">
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

input[type="password"], input[type="email"], input[type="text"], input[type="date"]
{
	width : 300px;
	padding : 5px;
	border : 1px solid black;
}

input[type="password"]:focus, input[type="email"]:focus, input[type="text"]:focus, input[type="date"]:focus
{
	background-color : #fff89b;
}

.button input[type="submit"]
{
	width : 300px;
	font-size : 1.2em;
	color : white;
	background-color : #f44242;
	padding : 10px;
	border-radius : 5px;
}

.button input[type="submit"]:hover
{
	cursor : pointer;
	opacity : 0.8;
}

fieldset p
{
	border-bottom : 1px solid black;
	font-family : Verdana;
	font-size : 2.3em;
}

fieldset label
{
	font-size : 1.5em;
}
</style>

</head>
<?php 
$nav->header1($conn);
?>
        <!-- / header -->
		<div class="signup">
		<fieldset>
			<p>Create Account</p>
			<br />
			<form name="signupfrm" method="POST" action="">
			<label>E-mail</label> <br />
			<input type="email" name="new_member_email" value="<?php echo isset($_POST["new_member_email"]) ? $_POST["new_member_email"] : ''; ?>"/>
			<br />
			<span id="message3" style="font-size : 0.9em; border-bottom : 0px; color : red;"></span>
	
			<br />
			<br />
	
			<label>Password</label> <br />
			<input type="password" name="new_member_password" maxlength="20" value="<?php echo isset($_POST["new_member_password"]) ? $_POST["new_member_password"] : ''; ?>" onKeyUp="return check_input()"/>
			<br />
			<span id="message1" style="font-size : 0.9em; border-bottom : 0px; color : red;"></span>
			<br />
	
			<label>Confirm Password</label> <br />
			<input type="password" name="new_member_confirmPassword" maxlength="20" value="<?php echo isset($_POST["new_member_confirmPassword"]) ? $_POST["new_member_confirmPassword"] : ''; ?>" onKeyUp="check_pass()"/>
			<br />
			<span id="message2" style="font-size : 0.9em; border-bottom : 0px; color : red;"></span>
	
			<br />
			<br />
			<br />
	
			<p>More Info</p>

			<br />
	
			<label>Full Name</label> <br />
			<input type="text" name="new_member_fname" value="<?php echo isset($_POST["new_member_fname"]) ? $_POST["new_member_fname"] : ''; ?>"/>
			<br />
			<span id="message4" style="font-size : 0.9em; border-bottom : 0px; color : red;"></span>
	
			<br />
			<br />
			<div class="button">
			<input type="submit" name="signupbtn" value="Sign up" onClick="check_input()"/>
			</div>
	
			</form>
		</fieldset>
	</div>
		</div>
  </div>


<?php $nav->footer2() ?>
</body>
</html>

<?php
try
{
	if(isset($_POST['signupbtn']))
	{
		$error = false;
		$email = mysqli_real_escape_string($conn, $_POST['new_member_email']);
		$pass = $_POST['new_member_password'];
		$conPass = ($_POST['new_member_confirmPassword']);
		$name = $_POST['new_member_fname'];
		
		// Empty Email input.
		if($email == '')
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message3\").innerHTML = \"Please enter your email\";
			</script>";
			
			$error = true;
		}
		
		// Empty Password input.
		if($pass == '')
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"Please enter your password\";
			</script>";
			
			$error = true;
		}
		
		// Password length is less than 6.
		if(strlen($pass) < 6)
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"Password must be more than 6\";
			</script>";
			
			$error = true;
		}
		
		// Empty Confirm Password input.
		if($conPass == '')
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message2\").innerHTML = \"Please confirm your password\";
			</script>";
			
			$error = true;
		}
		
		// Password not match.
		else if($pass != $conPass)
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"Password does not match\";
				document.getElementById(\"message2\").innerHTML = \"Password does not match\";
			</script>";
			
			$error = true;
		}
		
		// Empty Name input.
		if($name == '')
		{
			echo "<script type=\"text/javascript\">
				document.getElementById(\"message4\").innerHTML = \"Please enter your name\";
			</script>";
			
			$error = true;
		}
		
		// All input filled.
		if(!$error)
		{
			// Check for duplicate email.
			$sql = "SELECT * FROM member WHERE member_email = '$email'";
			$result = mysqli_query($conn, $sql);
			
			// Result exists.
			if(mysqli_num_rows($result) != 0)
			{
				?>
					<div id="dialog" title="Alert">
					<p>Email already exists</p>
					</div>
				<?php
			}
			
			else
			{
				// Encrypt $pass
				$pass2 = md5($pass);
				$insert = "INSERT INTO member (member_email, member_password, member_name) values ('$email', '$pass2', '$name')";
				$result2 = mysqli_query($conn, $insert);
				
				// Query failed.
				if(!$result2)
				{
					?>
					<div id="dialog" title="Alert">
					<p>There has been an error. Registration unsuccessful.</p>
					</div>
					<?php
				}
				
				else
				{
					?>
						<div id="dialog" title="Alert">
						<p>Registration successful. You will be redirect to login page in a few seconds</p>
						</div>
					<?php
					
					echo "<script type=\"text/javascript\">
						 setTimeout(\"location.href = 'login.php';\",4000);
					</script>";
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