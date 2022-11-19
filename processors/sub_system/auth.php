<?php

	require_once(__DIR__. "/../../controllers/auth_controller.php");
	require_once(__DIR__."/../../utils/core.php");

	function main(){
		$request = $_SERVER["REQUEST_METHOD"];

		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "login":
					$email = $_POST["email"];
					$password = encrypt($_POST["password"]);
					$result = log_in_user($email,$password);
					// var_dump($result);
					if($result){
						//check if user has special permissions
						if(isset($result["curator_id"])){
							session_log_in_advanced($result["user_id"],'$result["media_location"]',$result["role"],$result["curator_id"]);
						} else if (isset($result["admin"])){
							session_log_in_advanced($result["user_id"],'$result["media_location"]',$result["role"],NULL);

						} else{
							session_log_in($result["user_id"],'$result["media_location"]',$result["role"]);
						}

						echo "login success";
					}else {
						echo "login failed";
					}
					die();
					break;
				case "signup":
					$email = $_POST["email"];
					$user_name = $_POST["user_name"];
					$password = encrypt($_POST["password"]);
					$number = $_POST["phone_number"];
					$country = $_POST["country"];
					$image_id = $_POST["profile_image"];

					//generate user id
					$user_id = generate_id();

					$response = sign_up_user($user_id,$email, $user_name,$password,$number,$country,$image_id);
					//create email verification
					if(!$response){//sign up was not successful
						echo "sign up failed";
						die();
					}
					$email_token = encrypt(get_current_date());
					create_email_verification_token($email_token,$user_id);
					//TODO send email verification


					if(isset($_POST["type"])){
						switch($_POST["type"]){
							case "curator":
								$logo_id = $_POST["curator_logo"];
								$curator_id = generate_id();
								$curator_name = $_POST["curator_name"];

								//create curator account
								create_curator_account($curator_id,$curator_name,$logo_id);
								//add user to curator management
								add_curator_manager($curator_id,$user_id);
								//TODO include national identification
								break;

							default:
								ECHO $_POST["type"];
								echo "Not implemented";
						}
					}
					echo "sign up successful";
					break;

				case "logout":
					session_log_out();
					break;

				default:
					echo "No implementation for <action>";
					die();
			}


		}else{
			echo "unsupported method";
			die();
		}
		echo "EOF";
		die();
	}

	main();
?>