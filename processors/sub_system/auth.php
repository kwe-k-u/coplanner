<?php

	require_once(__DIR__. "/../../controllers/auth_controller.php");
	require_once(__DIR__."/../../utils/core.php");

	function auth(){
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
						record_user_login($result["user_id"]);
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

					//check if a curator invite link has been sent and add them
					$collaborator_invite = get_curator_invite_by_email($email);
					if($collaborator_invite){
						$user_id = get_user_by_email($email)["user_id"];
						$curator_id = $collaborator_invite["curator_id"];
						$privilege = $collaborator_invite["privilege"];
						add_curator_manager($curator_id,$user_id,$privilege);
						remove_curator_invite($email);
						remove_expired_curator_invites();
						//TODO send email letting them know addition was successful
					}


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
								die();

							default:
								ECHO $_POST["type"];
								echo "Not implemented";
						}
					}
					echo "sign up successful";
					break;

				case "logout":
					session_log_out();
					die();
				case 'request_password_reset':
					$email = $_POST["email"];
					//delete all expired links for the email
					remove_expired_tokens();
					$token = get_password_token($email);
					echo $token;
					die();
				case "change_password":
					$token = $_POST["token"];
					$new_password = encrypt($_POST["password"]);

					//remove expired tokens
					remove_expired_tokens();
					//check if token exists and hasn't expired
					$verify = verify_reset_token($token);

					//if its valid, change password and remove token
					if($verify){
						$success = change_user_password($token, $new_password);
						if($success){
							remove_used_password_token($token);
							echo "Password change successful. Login with your new password";
						}else {
							echo "Password change failed.";
						}
					}else {
						echo "The token has expired. Request a new token to be sent";
					}
					die();
				case "invite_curator_collaborator":
					$email = $_POST["email"];
					$curator_id = $_POST["curator_id"];
					$privilege = $_POST["privilege"];

					$user = get_user_by_email($email);
					if ($user){//user exists
						$is_collaborator = is_user_a_collaborator($user["user_id"]);
						if($is_collaborator){
							//send error saying user is a collaborator
							echo "user is a registered collaborator and can't manage several accounts";
						}else {
							//add the managers
							add_curator_manager($curator_id,$user["user_id"],$privilege);
							echo "Added <$email> as collaborator";
							//TODO send email
						}

					}else {//user doesn't exist
						//create invite entry
						invite_curator_manager($curator_id,$email,$privilege);
						echo "Invite sent to <$email>";
						//TODO Send email to notify

					}
					die();
				case "remove_curator_collaborator":
					$curator_id = $_POST["curator_id"];
					$user_id = $_POST["user_id"];
					remove_curator_collaborator($user_id,$curator_id);
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

	// auth();
?>