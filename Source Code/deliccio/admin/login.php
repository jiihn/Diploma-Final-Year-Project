<?php
include ("../dbconnection.php");

ob_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Log In</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>

var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}

	function check_input()
	{
		var email = document.getElementById('inputEmail').value;
		var password = document.getElementById('inputPassword').value;
		
		if(email == "")
		{
			alert("Please enter your email");
		}
		
		else if(password == "")
		{
			alert("Please enter your password");
		}
		
		else
		{
			document.loginfrm.submit();
		}
	}
</script>

<style type="text/css">
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}

.title
{
	text-align : center;
}

.container
{
	border : 1px solid black;
	border-radius : 10px;
	margin : 0 auto;
	margin-top : 20px;
	width : 400px;
	padding : 10px;
}

.bottom
{
	margin-top : 10px;
	margin-bottom : 10px;
	width : 100%;
}

.bottom a:hover
{
	cursor : pointer;
	color : red;
}

.messages
{
	color:  #f44336;
	opacity: 1;
	transition: opacity 0.6s;
	border-radius : 5px;
}
</style>
</head>
<body>
<div class="title">
<img src="../images/logo2.png" />
</div>
<div class="container">
<h1 style="border-bottom : 1px solid silver;">Log In</h1>
<form name="loginfrm" method="post" action="">
        <div class="form-group">
            <label for="inputEmail">Email</label>
			<input type="text" class="form-control" name="email" id="inputEmail" placeholder="Email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
			<span class="messages" id="message1"></span>
		</div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
			<input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>">
			<span class="messages" id="message2"></span>
		</div>
		<div class="bottom">
			<br />
			<button type="submit" class="btn btn-primary" name="loginbtn">Login</button>
		</div>
</form>
</div>
</body>
</html>
<?php
try
{
	if(isset($_POST['loginbtn']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = $_POST['password'];
		
		if(empty($email) || $email == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter your email&nbsp;\";
				document.getElementById(\"inputEmail\").focus();
			</script>";
		}
		
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message1\").innerHTML = \"&nbsp;Please enter a valid email&nbsp;\";
				document.getElementById(\"inputEmail\").focus();
			</script>";
		}
		
		else if($password == "")
		{
			echo"<script type=\"text/javascript\">
				document.getElementById(\"message2\").innerHTML = \"&nbsp;Please enter your password&nbsp;\";
				document.getElementById(\"inputEmail\").focus();
			</script>";
		}
		
		else
		{
			$pass = md5($password);
			
			$result = mysqli_query($conn, "SELECT * FROM admin WHERE admin_email = '$email' AND admin_password = '$pass'");
			$row = mysqli_fetch_assoc($result);
			
			if(mysqli_num_rows($result) == 0)
			{
				$result2 = mysqli_query($conn, "SELECT * FROM staff WHERE staff_email = '$email' AND staff_password = '$pass'");
				$row2 = mysqli_fetch_assoc($result2);
				
				if(mysqli_num_rows($result2) == 0)
				{
					?>
						<br/>
						<br/>
						<br/>
						<br/>
						<br/>
						<div class="alert danger">
						  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>  
						  <strong>Wrong email or password!</strong>
						</div>
					<?php
				}
				
				else
				{
					$_SESSION["sess_id"] = $row2["staff_id"];
					$_SESSION["email"] = $row2["staff_email"];
					$_SESSION["aloggedin"] = 1;
					$_SESSION["access"] = 0;
					header("Location: index.php");
				}
			}
			
			else
			{
				$_SESSION["sess_id"] = $row["admin_id"];
				$_SESSION["email"] = $row["admin_email"];
				$_SESSION["aloggedin"] = 1;
				$_SESSION["access"] = 1;
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