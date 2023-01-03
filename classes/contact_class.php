<?php
	require_once(__DIR__."/../utils/db_class.php");


	class contact_class extends db_connection{

		function send_contact_message($email,$name,$message,$number){
			$sql = "INSERT INTO `contact_message`(`email`, `name`, `message`, `phone`)
			VALUES ('$email','$name','$message','$number')";
			return $this->db_query($sql);
			}
	}
?>