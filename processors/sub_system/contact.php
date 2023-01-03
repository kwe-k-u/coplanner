<?php

	require_once(__DIR__. "/../../controllers/contact_controller.php");
	require_once(__DIR__."/../../utils/core.php");

	function contact(){
		$request = $_SERVER["REQUEST_METHOD"];

		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "send_contact_message":
					$email = $_POST["email"];
					$name = $_POST["name"];
					$message = $_POST["message"];
					$number = $_POST["phone"];

					$success = send_contact_message($email,$name,$message,$number);

					send_json(array ("msg" => ($success ? "Success" : "Failed")));
					die();
				default:
					echo "No implementation for <". $_POST["action"] .">";
				}
				die();


		}else{
			echo "unsupported method";
			die();
		}
		echo "EOF";
		die();
	}

	contact();
?>