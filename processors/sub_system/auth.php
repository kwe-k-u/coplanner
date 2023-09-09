<?php

	require_once(__DIR__. "/../../controllers/auth_controller.php");
	require_once(__DIR__. "/../../controllers/media_controller.php");
	require_once(__DIR__. "/../../controllers/slack_bot_controller.php");
	require_once(__DIR__."/../../utils/core.php");
	require_once(__DIR__."/../../utils/env_manager.php");

	function auth(){
		$request = $_SERVER["REQUEST_METHOD"];

		if ($request == "POST"){
			if(!isset($_POST["action"])){
				send_json(array("msg"=> "<action> required"));
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
							//Block login if curator access has been suspended
							if($result["access_status"] == "suspended"){
								send_json(
									array(
										"msg" => "Login failed. Your access to the curator account has been suspended"
										."Kindly reach out to a member of your team or your easyGo support person"
									),100);
									die();
							// Block access if the national ID has not been verified
							}else if ($result["id_verified"] == 0){
								send_json(
									array(
										"msg" => "Login failed. Your Identification documents are pending verification"
										." You will receive an email as soon as this process is complete. You can reach "
										."out to our team at main.easygo@gmail.com"
									),100
									);
									die();
								// Block access if curator has not verified their email
							}else if ($result["email_verified"] == 0){
								send_json(
									array(
										"msg" => "You need to verify your email to proceed."
										." Check your email for a verification link"
									),100
									);
									die();
							}
							session_log_in_advanced($result["user_id"],$result["role"],$result["curator_id"]);
							$url = server_base_url() . "curator/dashboard.php";
						} else if (isset($result["admin"])){
							$url = server_base_url() . "admin/dashboard.php";
							session_log_in_advanced($result["user_id"],$result["role"],NULL);
						} else{
							// echo "user";
							$url = server_base_url() . "views/tours.php";
							session_log_in($result["user_id"],$result["role"]);
						}
						// var_dump($_SESSION);

						send_json(array(
							"msg" => "login success",
							"url" => $url,
						));
					}else {
						send_json(
							array(
								"msg" => "Login failed. Credentials may be wrong"
							),100
							);
					}
					die();
					break;
				case "curator_invite_signup":
					// var_dump($_REQUEST);
					$hash = $_POST["invite_hash"];
					$new_user = encrypt(false.$hash) == $_POST["invite_type_hash"];
					$email = $_POST["email"];
					$username = $_POST["user_name"];
					$password = encrypt($_POST["password"]);
					$phone = $_POST["phone_number"];
					$mailer = new mailer();

					if ($new_user){
						// create account
						$user_id = generate_id();
						sign_up_user($user_id,$email,$username,$password,$phone);
					}else {
						// get_id
						$user_id = get_user_by_email($email);
					}


					if(!$user_id){
						send_json(array("msg"=> "We couldn't find your account. Make sure to use the same email that received the invite link"),201);
						die();
					}
					$collaborator_invite = get_curator_invite_by_email($email);
					if($collaborator_invite){
						$user = get_user_by_email($email);
						$user_id = $user["user_id"];
						$curator_id = $collaborator_invite["curator_id"];
						$privilege = $collaborator_invite["privilege"];

						//uploading front side of government id
						$gov_id_front = generate_id();
						$image = $_FILES["gov_id_front"]["name"];
						$tmp = $_FILES["gov_id_front"]["tmp_name"];
						$location = upload_file("uploads","confidential",$tmp,$image);
						$type = get_file_type($image);
						upload_user_media_ctrl($gov_id_front,$user_id,$location,$type);

						//uploading back side of government id
						$gov_id_back = generate_id();
						$image = $_FILES["gov_id_back"]["name"];
						$tmp = $_FILES["gov_id_back"]["tmp_name"];
						$location = upload_file("uploads","confidential",$tmp,$image);
						$type = get_file_type($image);
						upload_user_media_ctrl($gov_id_back,$user_id,$location,$type);

						add_curator_manager($curator_id,$user_id,$gov_id_front,$gov_id_back,$privilege);
						remove_curator_invite($email);
						remove_expired_curator_invites();
						$mailer->curator_invite_success($email);
						$curator_name = get_curator_by_id($curator_id)["curator_name"];
						$name = $user["user_name"];
						notify_curator_invite_signup($email,$name,$curator_name);
						send_json(array("msg"=>"Successfully added as a curator"));
					}else{
						send_json(array("msg"=>"Your invite link may have expired. Kindly request a new one"),201);
					}
					die();

				case "signup":
					$email = $_POST["email"];
					$user_name = $_POST["user_name"];
					$password = encrypt($_POST["password"]);
					$number = $_POST["phone_number"];
					$country = $_POST["country"];
					$mailer = new mailer();
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
						$type = get_file_type($image);
						upload_user_media_ctrl($media_id,$user_id,$location,$type);
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
					$mailer->email_verification($email,$email_token);


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
						$type = get_file_type($image);
						upload_user_media_ctrl($gov_id_front,$user_id,$location,$type);

						//uploading back side of government id
						$gov_id_back = generate_id();
						$image = $_FILES["gov_id_back"]["name"];
						$tmp = $_FILES["gov_id_back"]["tmp_name"];
						$location = upload_file("uploads","confidential",$tmp,$image);
						$type = get_file_type($image);
						upload_user_media_ctrl($gov_id_back,$user_id,$location,$type);

						add_curator_manager($curator_id,$user_id,$gov_id_front,$gov_id_back,$privilege);
						remove_curator_invite($email);
						remove_expired_curator_invites();
						$mailer->curator_invite_success($email);
						send_json(array("msg"=>"Successfully added as a curator"));
						die();
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
								$type = get_file_type($image);
								upload_user_media_ctrl($gov_id_front,$user_id,$location,$type);

								//uploading back side of government id
								$gov_id_back = generate_id();
								$image = $_FILES["gov_id_back"]["name"];
								$tmp = $_FILES["gov_id_back"]["tmp_name"];
								$location = upload_file("uploads","confidential",$tmp,$image);
								$type = get_file_type($image);
								upload_user_media_ctrl($gov_id_back,$user_id,$location,$type);


								add_curator_manager($curator_id,$user_id,$gov_id_front,$gov_id_back);
								notify_new_curator($curator_name,$email,$user_name);
								//TODO include national identification
								$mailer->curator_signup($email);

								break;
							default:
								// ECHO $_POST["type"];
								send_json(array("msg"=> "Not implemented"));
						}
					}else {
						$mailer->tourist_signup($email);
						notify_tourist_signup($user_name,$email);
					}

					send_json($id_array);
					die();

				case "logout":
					session_log_out();
					send_json(array("msg" => "logged out"));
					die();
				case 'request_password_reset':
					$mailer = new mailer();
					remove_expired_tokens();
					$email = $_POST["email"];
					if ($email == ""){
						send_json(array("msg"=> "No email provided"));
						die();
					}
					//delete all expired links for the email
					$token = get_password_token($email);
					if ($token){
						send_json(array("msg"=> "Check your email for the link to reset your password"));
						$mailer->password_reset($email,$token);
					}else {
						send_json(array("msg"=> "Something went wrong. Try again soon or contact support at main.easygo@gmail.com"));
					}
					die();
				case "change_password":
					$token = $_POST["token"];
					$new_password = encrypt($_POST["password"]);
					$mailer = new mailer();

					//remove expired tokens
					remove_expired_tokens();
					//check if token exists and hasn't expired
					$verify = verify_reset_token($token);

					//if its valid, change password and remove token
					if($verify){
						$success = change_user_password($token, $new_password);
						if($success){
							remove_used_password_token($token);
							$u_id = $verify["user_id"];
							$email = get_user_by_id($u_id)["email"];
							$mailer->password_reset_confirmation($email);
							send_json(array("msg"=>"Password change successful. Login with your new password"));
						}else {
							send_json(array("msg"=>"Password change failed."));
						}
					}else {
						send_json(array("msg"=>"The token has expired. Request a new token to be sent"));
					}
					die();
				case "change_password_logged_in":
					$new_password = $_POST["new_password"];
					$current_password = $_POST["current_password"];
					$user_id = (isset($_POST["user_id"])) ? $_POST["user_id"] : get_session_user_id();
					$email = get_user_by_id($user_id)["email"];
					$result = log_in_user($email,$current_password);
					$mailer = new mailer();
					// echo "eres ".$result;
					if ($result){
						change_password_by_user_id($user_id,$new_password);
						$mailer->password_reset_confirmation($email);

						session_log_out();
						send_json(array("msg"=>"You have to log in now"));
					} else {
						send_json("Current password does not match",100);
					}

					die();
				case "invite_curator_collaborator":
					$email = $_POST["email"];
					$curator_id = $_POST["curator_id"];
					$privilege = $_POST["privilege"];
					$mailer = new mailer();

					$user = get_user_by_email($email);
					if ($user){//user exists
						$is_collaborator = is_user_a_collaborator($user["user_id"]);
						if($is_collaborator){
							//send error saying user is a collaborator
							send_json(array("msg"=>"user is a registered collaborator and can't manage several accounts"),100);
							die();
						}

					}
						//create invite entry
						invite_curator_manager($curator_id,$email,$privilege);
						$invite = get_curator_invite_by_email($email);
						$date = $invite["invite_date"];
						$curator_name = $invite["curator_name"];
						$hash = encrypt($email.$curator_id);
						$mailer->curator_invite($email,$hash,$date,$curator_name);
						$user_id = get_session_user_id();
						$user = get_user_by_id($user_id);
						$user_name = $user["user_name"];
						$user_email = $user["email"];
						notify_curator_invite($curator_name,$email,$user_name,$user_email);
						send_json(array("msg"=>"Invite sent to <$email>"));

					die();
				case "remove_curator_collaborator":
					$curator_id = $_POST["curator_id"];
					$r_user_id = $_POST["user_id"];
					$admin_user_id = get_session_user_id();
					$removed_name = get_user_by_id($r_user_id)["user_name"];
					$removed_email = get_user_by_id($r_user_id)["email"];
					$admin_name = get_user_by_id($admin_user_id)["user_name"];
					$admin_email = get_user_by_id($admin_user_id)["email"];
					$curator_name = get_curator_name($curator_id);

					remove_curator_collaborator($r_user_id,$curator_id);
					notify_curator_collaborator_removal($curator_name,$admin_name,$admin_email,$removed_name,$removed_email);
					die();
				case "update_profile":
					var_dump($_POST);
					var_dump($_FILES);
					die();
				case "resend_email_verification":
					$user_id = $_POST["user_id"];

					// $mailer = new mailer();
					// $mailer->email_verification($email,$token);
					// TODO:: send verification email
					send_json(array("msg"=>"Pending implementation"));
					die();
				default:
					send_json(array("msg"=>"No implementation for <". $_POST["action"] .">"));
				}
				die();


		}else{
			send_json(array("msg"=>"unsupported method"));
			die();
		}
		send_json(array("msg"=>"EOF"));
		die();
	}

	auth();
?>