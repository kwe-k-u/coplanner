<?php

	require_once(__DIR__. "/../../controllers/newsletter_controller.php");
	require_once(__DIR__."/../../utils/core.php");

	function auth(){
		$request = $_SERVER["REQUEST_METHOD"];

		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "add_subscriber":
					$email = $_POST["email"];
					$success = add_subscriber($email);
					$response = $success ? "Added successfully" : "You might have joined the newsletter recently";
					// $response = "something";

					send_json(array("msg" => $response));
					die();
				case "get_subscribers":
					send_json(array("data"=> get_subscribers()));
					die();
					case "clear_subscribers":
						$success = clear_subscribers();
						$response = $success ? "Success" : "Failed";
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

	auth();
?>