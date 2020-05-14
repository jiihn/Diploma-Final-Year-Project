<?php
include ("../dbconnection.php");

	    function reset_password_email()
		{
			$this->load->helper('form');

			//view
			$this->load->view('users/reset_password_email');
		
		}

		function email_reset_password_validation()
		{

			$this->load->library('form_validation');
			$this->form_validation->set_rules('email','Email','required|trim|valid_email|xss_clean');
			if($this->form_validation->run())
			{
				$reset_key=md5(uniqid());
				$this->load->model('user_model');
				if($this->user_model->update_reset_key($reset_key))
				{
					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->from('benjaminkohdickson@gmail.com','admin');
					$this->email->to($this->input->post('email'));
					$this->email->subject('Succesfully reset your password to 123456');
					$message="<p>You have requested to reset your password!</p>";
					$message.= "<a href='".base_url()."users/reset_password/".$reset_key."'>Click here to reset your password</a>";
					$this->email->message($message);
					if($this->email->send())
					{
						echo 'Kindly check your email'  .$this->input->post('email').  'to reset your password';
					}
					else
					{
						echo "Cannot send email! Kindly contact Us to help You!";
					}
				}
				
			}

			else
			{
				echo 0;
				$this->load->view('users/reset_password_email');
			}
		}
		
		function update_reset_key($reset_key)
		{
		$email=$this->input->post('email');
		$this->db->where('email',$email);
		$data=array('reset_password_key'=>$reset_key);
		$this->db->update('users',$data);
		if($this->db->affected_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		}
?>