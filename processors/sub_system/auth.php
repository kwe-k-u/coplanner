<?php

	require_once(__DIR__. "/../../controllers/auth_controller.php");
	require_once(__DIR__. "/../../controllers/media_controller.php");
	require_once(__DIR__."/../../utils/core.php");
	require_once(__DIR__."/../../utils/env_manager.php");

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
					if($result){
						record_user_login($result["user_id"]);
						//check if user has special permissions
						if(isset($result["curator_id"])){
							session_log_in_advanced($result["user_id"],$result["role"],$result["curator_id"]);
							$url = server_base_url() . "curator/dashboard.php";
						} else if (isset($result["admin"])){
							$url = server_base_url() . "admin/dashboard.php";
							session_log_in_advanced($result["user_id"],$result["role"],NULL);
						} else{
							$url = server_base_url() . "views/trips.php";
							session_log_in($result["user_id"],$result["role"]);
						}

						send_json(array(
							"msg" => "login success",
							"url" => $url
						));
					}else {
						send_json(
							array(
								"msg" => "Login failed"
							),100
							);
					}
					die();
					break;
				case "signup":
					$email = $_POST["email"];
					$user_name = $_POST["user_name"];
					$password = encrypt($_POST["password"]);
					$number = $_POST["phone_number"];
					$country = $_POST["country"];
					// $referral = $_POST["referral"];

					//generate user id
					$user_id = generate_id();

					$response = sign_up_user($user_id,$email, $user_name,$password,$number,$country);
					// if a profile image is provide, upload it
					if(isset($_FILES["profile_img"])){
						$media_id = generate_id();
						$image = $_FILES["profile_img"]["name"];
						$tmp = $_FILES["profile_img"]["tmp_name"];
						$location = upload_file("uploads","picture",$tmp,$image);
						upload_user_media_ctrl($media_id,$user_id,$location);
						update_profile_image($user_id,$media_id);
					}
					//create email verification
					if(!$response){//sign up was not successful
						send_json(array("msg"=> "Sign up failed"), 100);
						die();
					}
					$id_array = array("user_id"=> $user_id);
					$email_token = encrypt(get_current_date());
					create_email_verification_token($email_token,$user_id);
					//TODO send email verification

					//check if a curator invite link has been sent and add them
					$collaborator_invite = get_curator_invite_by_email($email);
					if($collaborator_invite){
						$user_id = get_user_by_email($email)["user_id"];
						$curator_id = $collaborator_invite["curator_id"];
						$privilege = $collaborator_invite["privilege"];

							//uploading front side of government id
							$gov_id_front = generate_id();
							$image = $_FILES["gov_id_front"]["name"];
							$tmp = $_FILES["gov_id_front"]["tmp_name"];
							$location = upload_file("uploads","confidential",$tmp,$image);
							upload_user_media_ctrl($gov_id_front,$user_id,$location);

							//uploading back side of government id
							$gov_id_back = generate_id();
							$image = $_FILES["gov_id_back"]["name"];
							$tmp = $_FILES["gov_id_back"]["tmp_name"];
							$location = upload_file("uploads","confidential",$tmp,$image);
							upload_user_media_ctrl($gov_id_back,$user_id,$location);

						add_curator_manager($curator_id,$user_id,$gov_id_front,$gov_id_back,$privilege);
						remove_curator_invite($email);
						remove_expired_curator_invites();
						//TODO send email letting them know addition was successful
					}


					if(isset($_POST["type"])){
						switch($_POST["type"]){
							case "curator":
								$curator_id = generate_id();
								$curator_name = $_POST["curator_name"];
								$id_array = array_merge($id_array,array("curator_id"=>$curator_id));

								//create curator account
								create_curator_account($curator_id,$curator_name, $country);
								//add user to curator management


								//adding uploaded images


							//if company logo is uploaded, add it
							if(isset($_FILES["company_logo"])){
								$media_id = generate_id();
								$image = $_FILES["company_logo"]["name"];
								$tmp = $_FILES["company_logo"]["tmp_name"];
								$location = upload_file("uploads","picture",$tmp,$image);
								upload_curator_media_ctrl($media_id,$curator_id,$location);
								update_curator_logo($curator_id,$media_id);

							}
							//if incorporation document is uploaded, add it
							if(isset($_FILES["inc_doc"])){
								$media_id = generate_id();
								$image = $_FILES["inc_doc"]["name"];
								$tmp = $_FILES["inc_doc"]["tmp_name"];
								$location = upload_file("uploads","confidential",$tmp,$image);
								upload_curator_media_ctrl($media_id,$curator_id,$location,"doc");
								update_curator_inc_doc($curator_id,$media_id);

							}
							//uploading front side of government id
							$gov_id_front = generate_id();
							$image = $_FILES["gov_id_front"]["name"];
							$tmp = $_FILES["gov_id_front"]["tmp_name"];
							$location = upload_file("uploads","confidential",$tmp,$image);
							upload_user_media_ctrl($gov_id_front,$user_id,$location);

							//uploading back side of government id
							$gov_id_back = generate_id();
							$image = $_FILES["gov_id_back"]["name"];
							$tmp = $_FILES["gov_id_back"]["tmp_name"];
							$location = upload_file("uploads","confidential",$tmp,$image);
							upload_user_media_ctrl($gov_id_back,$user_id,$location);


								add_curator_manager($curator_id,$user_id,$gov_id_front,$gov_id_back);
								//TODO include national identification

								// $
								// die();
								break;

							default:
								// ECHO $_POST["type"];
								echo "Not implemented";
						}
					}

					send_json($id_array);
					die();

				case "logout":
					session_log_out();
					send_json(array("msg" => "logged out"));
					die();
				case 'request_password_reset':
					remove_expired_tokens();
					$email = $_POST["email"];
					if ($email == ""){
						echo "No email provided";
						die();
					}
					//delete all expired links for the email
					$token = get_password_token($email);
					if ($token){
						echo "Check your email for link to reset your password";
					}else {
						echo 'Something went wrong. Try again soon';
					}
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
				case "change_password_logged_in":
					$new_password = $_POST["new_password"];
					$current_password = $_POST["current_password"];
					$user_id = (isset($_POST["user_id"])) ? $_POST["user_id"] : get_session_user_id();
					$email = get_user_by_id($user_id)["email"];
					$result = log_in_user($email,$current_password);
					echo "eres ".$result;
					if ($result){
						change_password_by_user_id($user_id,$new_password);

						session_log_out();
						send_json("You have to log in now");
					} else {
						send_json("Current password does not match",100);
					}

					die();
				case "invite_curator_collaborator":
					send_json(array("msg" => "Action blocked. Government registration required"),100);
					die();
					$email = $_POST["email"];
					$curator_id = $_POST["curator_id"];
					$privilege = $_POST["privilege"];

					$user = get_user_by_email($email);
					if ($user){//user exists
						$is_collaborator = is_user_a_collaborator($user["user_id"]);
						if($is_collaborator){
							//send error saying user is a collaborator
							echo "";
							send_json(array("msg"=>"user is a registered collaborator and can't manage several accounts"));
						}else {
							//add the managers
							// add_curator_manager($curator_id,$user["user_id"],$privilege);
							send_json(array("msg"=>"Added <$email> as collaborator"));
							//TODO send email
						}

					}else {//user doesn't exist
						//create invite entry
						invite_curator_manager($curator_id,$email,$privilege);
						send_json(array("msg"=>"Invite sent to <$email>"));
						//TODO Send email to notify

					}
					die();
				case "remove_curator_collaborator":
					$curator_id = $_POST["curator_id"];
					$user_id = $_POST["user_id"];
					remove_curator_collaborator($user_id,$curator_id);
					die();
				case "update_profile":
					var_dump($_POST);
					var_dump($_FILES);
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