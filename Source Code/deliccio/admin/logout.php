<?php include("../dbconnection.php"); ?>
<!DOCTYPE html>
<html>

<head><title>Logout</title>

<script type="text/javascript">

	setTimeout("window.location='login.php';", 2000);
	
	history.forward();

</script>

</head>

<body>

<p>Logout successfully. If does not redirect automatically, please click <a href="login.php">here</a> </p>

<?php
unset ($_SESSION['aloggedin']);
unset ($_SESSION['sess_id']);
unset ($_SESSION["access"]);
session_unset();
session_destroy();
?>

</body>

</html>
