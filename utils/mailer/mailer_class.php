<?php
include_once (__DIR__. "/PHPMailer/PHPMailer.php");
include_once (__DIR__. "/PHPMailer/SMTP.php");
include_once (__DIR__. "/PHPMailer/POP3.php");
include_once (__DIR__. "/PHPMailer/OAuth.php");
include_once(__DIR__."/../env_manager.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class mailer{
	private $name;

	function __construct($name = "easyGo Tours Ltd"){
		$this->name = $name;

	}

	function send_email($destination, $subject, $message){
// 			$path = __DIR__."/../../logs/email_log.log";
// 			$data = "\n\n\n";
// 			// $add timestamp for entry with milliseconds
// 			$_name = $this->name;
// 			$data = date("Y-m-d H:i:s")."\n============<START>================\n
// From: $_name
// To: $destination
// Subject: $subject\n
// Message: $message
// 			";
// 			$data .= "\n================<END>=========================\n";



// 			$fp = fopen($path, 'a');
// 			fwrite($fp, "\n".$data);
// 			fclose($fp);

			$logger = new Logger();
			$logger->email_log($this->name,$destination,$subject,$message);

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
	function tourist_signup($email){
		include_once(__DIR__."/messages/tourist_signup.php");
		return $this->send_email($email,$subject,$message);
	}

	/**Sends a welcome message to new curators on sign up */
	function curator_signup($email){
		include_once(__DIR__."/messages/curator_signup.php");
		return $this->send_email($email,$subject,$message);

	}

	/**Sends token to user to verify their email */
	function email_verification($email,$token){
		include_once(__DIR__."/messages/email_verification.php");
		return $this->send_email($email,$subject,$message);

	}

	/**Emails the invite token to an invited user */
	function curator_invite($email,$hash,$date,$curator_name){
		include_once(__DIR__."/messages/curator_invite.php");
		return $this->send_email($email,$subject,$message);

	}

	/**Notifies user that they've become a curator manager */
	function curator_invite_success($email){
		include_once(__DIR__."/messages/curator_invite_success.php");
		return $this->send_email($email,$subject,$message);

	}


	/**Sends a password reset token to users who request new passwords */
	function password_reset($email,$token){
		include_once(__DIR__."/messages/password_reset.php");
		return $this->send_email($email,$subject,$message);

	}

	/**Sends a success message when a password is changed */
	function password_reset_confirmation($email){
		include_once(__DIR__."/messages/password_reset_confirmation.php");
		return $this->send_email($email,$subject,$message);

	}

	/**Sends email informing invited user that they have
	 * successfully being added as a manager
	 */
	function curation_invite_confirmation($email){
		include_once(__DIR__."/messages/curation_invite_confirmation.php");
		return $this->send_email($email,$subject,$message);

	}

	/**Sends email to users who have enabled two factor authentication */
	function two_factor_auth($email){
		include_once(__DIR__."/messages/two_factor_auth.php");
		return $this->send_email($email,$subject,$message);

	}



	/**Sends a booking reciept to users who have booked a tour */
	function booking_confirmation($email){
		include_once(__DIR__."/messages/booking_confirmation.php");
		return $this->send_email($email,$subject,$message);

	}


	/**Sends curators notices when a private tour request is made */
	function curator_private_tour_notice(){
		include_once(__DIR__."/messages/curator_private_tour_notice.php");
		return $this->send_email($email,$subject,$message);

	}

	/**Notify tourists when a quote for their private tour is received */
	function tourist_private_tour_quote(){
		include_once(__DIR__."/messages/tourist_private_tour_quote.php");
		return $this->send_email($email,$subject,$message);

	}



}
