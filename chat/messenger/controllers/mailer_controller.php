<?php
	require_once(__DIR__. "/../classes/mailer.php");



	//send sign up email
	function send_token($email,$token){
		$mail = new mailer_class();
		return $mail->send_email_cls($email,"Your Coplanner Token", $token);
	}

?>