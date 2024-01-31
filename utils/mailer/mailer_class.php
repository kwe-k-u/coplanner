<?php
include_once (__DIR__. "/PHPMailer/PHPMailer.php");
include_once (__DIR__. "/PHPMailer/SMTP.php");
include_once (__DIR__. "/PHPMailer/POP3.php");
include_once (__DIR__. "/PHPMailer/OAuth.php");
include_once(__DIR__."/../env_manager.php");
include_once(__DIR__."/../logger.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class mailer{
	private $name;

	function __construct($name = "easyGo Tours Ltd"){
		$this->name = $name;

	}

	function send_email($destination, $subject, $message){
		$_name = $this->name;
		// $path = __DIR__."/../../logs/email_log.log";
		// $data = "\n\n\n";
		// // $add timestamp for entry with milliseconds
		// $data = date("Y-m-d H:i:s")."\n============<START>================";
		// $data .="\nFrom: $_name";
		// $data .="\nTo: $destination";
		// $data .="\nSubject: $subject";
		// $data .="\nMessage: $message";
		// $data .= "\n================<END>=========================\n";



		// $fp = fopen($path, 'a');
		// fwrite($fp, "\n".$data);
		// fclose($fp);

		$logger = new Logger();
		$logger->email_log($_name,$destination,$subject,$message);

		if (!is_env_remote()){
			return null;
		}

		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->isHTML(true);
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = '465';
		$mail->AddAddress($destination);
		$mail->Username = email_username();
		$mail->Password = email_password();
		$mail->SetFrom(email_username(),$this->name);
		$mail->AddReplyTo(email_username(),$this->name);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = $message;
		return $mail->Send();

	}



	/**Sends a welcome message to new users on sign up */
	function signup_email($email){
		ob_clean();
		ob_start();
		include_once(__DIR__."/messages/signup_email.php");
		$content = ob_get_clean();
		return $this->send_email($email,$subject,$content);
	}

	/**Sends a message to notify people when a destination they couldn't find has been added */
	function destination_added_email($email,$destination_name){
		include_once(__DIR__."/messages/destination_added_email.php");
		return $this->send_email($email,$subject,$message);
	}

	function admin_invite_email($email){
		ob_clean();
		ob_start();
		include_once(__DIR__."/messages/admin_invite_email.php");
		$content = ob_get_clean();
		return $this->send_email($email,$subject,$content);
	}

	// function user_itinerary_payment_email($email,$itinerary_id,$amount_paid){

	// }

}
