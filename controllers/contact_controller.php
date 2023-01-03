<?php
	require_once(__DIR__."/../classes/contact_class.php");


	function send_contact_message($email,$name,$message,$number){
		$contact = new contact_class();
		return $contact->send_contact_message($email,$name,$message,$number);
	}
?>