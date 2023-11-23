<?php
	require_once (__DIR__."/../utils/core.php");


	// if request is a post add data into session
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_SESSION['preview_data'] = $_POST;

		send_json(array("msg"=> "complete"));
		die();
	}


	if(!isset($_SESSION["preview_data"])){
		echo "No data provided";
	}else{
		$path = isset($_SESSION["preview_data"]["template_path"]) ? $_SESSION["preview_data"]["template_path"]:null;
		$message = isset($_SESSION["preview_data"]["custom_message"]) ? $_SESSION["preview_data"]["custom_message"]:null;

		if($path){
			include_once(__DIR__."/../utils/mailer/messages".$path);
			echo "Subject: $subject<br>";
			echo "Message: $message";
		}
	}
?>