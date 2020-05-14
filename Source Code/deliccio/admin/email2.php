<!DOCTYPE html>
<html>
	<head>	
		<meta charset="UTF-8">
		<title>Forgot Password</title>
	</head>

	<body>
		<?php
				echo validation_errors();
      			echo form_open('users/email_reset_password_validation');
     			echo form_input('email',$this->input->post('email'));
      			echo form_submit('submit','Email to reset password');
      			echo form_close();
		?>
	</body>
</html>