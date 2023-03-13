<?php

include_once (__DIR__. "/../PHPMailer/PHPMailer.php");
include_once (__DIR__. "/../PHPMailer/SMTP.php");
include_once (__DIR__. "/../PHPMailer/POP3.php");
include_once (__DIR__. "/../PHPMailer/OAuth.php");
// require_once(__DIR__."/../../utils/env_manager.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class mailer_class{


	function send_email_cls($destination, $subject, $message){
		return null;
		// if (!is_env_remote()){
		// 	return null;
		// }

		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		// $mail->isHTML(true);
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure =  "tls";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = '587';
		$mail->AddAddress($destination);
		$mail->Username = "main.easygo@gmail.com";
		$mail->Password = "fgyvymebwwfexwwg";
		$mail->SetFrom("main.easygo@gmail.com",'easyGo Tours Ltd');
		$mail->AddReplyTo("main.easygo@gmail.com","easyGo Tours Ltd");
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->AltBody = $message;
		return $mail->Send();

	}



}
