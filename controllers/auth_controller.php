<?php

	require_once(__DIR__. "/../classes/auth_class.php");
	require_once(__DIR__."/../utils/core.php");

	//Creates a user account with the information passed and returns the new user id. False if an error occurs
	function sign_up_user($user_id,$email, $user_name,$password,$phone_number,$country){
		$user = new auth_class();
		return $user->sign_up_user($user_id,$email, $user_name,$password,$phone_number,$country);
	}

	function log_in_user($email,$password){
		$user = new auth_class();

		//check credentials if they work
		$success = $user->user_login($email,$password);
		if($success){
			//check if user is admin
			$temp = $user->admin_login($success["user_id"]);
			if ($temp){
				$success = $temp;
				return $success;
			}

			//check if user is attributed to a curator
			$temp = $user->curator_login($success["user_id"]);
			if ($temp){
				 $success = $temp;
			}

			return $success;
		}
		return false;
		//check if user has special access
	}


	function get_user_by_email($email){
		$auth = new auth_class();
		return $auth->get_user_by_email($email);
	}


	function get_user_by_id($id){
		$auth = new auth_class();
		return $auth->get_user_by_id($id);
	}


	function get_password_token($email){
		$auth = new auth_class();
		$token = $auth->get_password_token($email);
		if($token){
			$token = $token["token"];
		}else{
			$token = generate_id();
			$user = $auth->get_user_by_email($email)["user_id"];
			$auth->create_password_reset_token($token,$user);
		}
		return $token;
	}


	function is_user_a_collaborator($user_id){
		$auth = new auth_class();
		return $auth->is_user_a_collaborator($user_id);
	}


	function verify_reset_token($token){
		$auth = new auth_class();
		$result = $auth->verify_reset_token($token);

		if ($result){
			return $result["token"] === $token;
		}
		return false;
	}


	function get_curator_collaborators($curator_id){
		$auth = new auth_class();
		return $auth->get_curator_collaborators($curator_id);
	}

	function get_curator_invite_by_email($email){
		$auth = new auth_class();
		return $auth->get_curator_invite_by_email($email);
	}




	function change_user_password($token,$password){
		$auth = new auth_class();
		return $auth->change_user_password($token,$password);
	}





	function create_email_verification_token($token,$user_id){
		$user = new auth_class();
		return $user->create_email_verification_token($token,$user_id);
	}


	function add_curator_manager($curator_id, $user_id, $privilege = 'admin'){
		$user = new auth_class();
		return $user->add_curator_manager($curator_id, $user_id, $privilege);
	}

	function invite_curator_manager($curator_id,$email, $privilege){
		$user = new auth_class();
		return $user->invite_curator_manager($curator_id,$email, $privilege);
	}


	function create_curator_account($curator_id,$curator_name, $country){
		$user = new auth_class();
		return $user->create_curator_account($curator_id,$curator_name, $country);
	}

	function record_user_login($user_id){
		$user = new auth_class();
		return $user->record_user_login($user_id);
	}



	function remove_used_password_token($token){
		$auth = new auth_class();
		return $auth->remove_used_password_token($token);
	}

	function remove_expired_tokens(){
		$auth = new auth_class();
		return $auth->remove_expired_tokens();
	}

	function remove_expired_curator_invites(){
		$auth = new auth_class();
		return $auth->remove_expired_curator_invites();
	}

	function remove_curator_invite($email){
		$auth = new auth_class();
		return $auth->remove_curator_invite($email);
	}


	function remove_curator_collaborator($user_id,$curator_id){
		$auth = new auth_class();
		return $auth->remove_curator_collaborator($user_id,$curator_id);
	}

?>