<?php
	require_once(__DIR__."/../utils/db_prepared.php");


	class contact_class extends db_prepared{

		function send_contact_message($email,$name,$message,$number){
			$sql = "INSERT INTO `contact_message`(`email`, `name`, `message`, `phone`)
			VALUES (?,?,?,?)";
			$this->prepare($sql);
			$this->bind($email,$name,$message,$number);
			return $this->db_query();
			}
	}
?>