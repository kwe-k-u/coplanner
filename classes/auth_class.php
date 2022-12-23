<?php
	require_once(__DIR__."/../utils/db_class.php");
	require_once(__DIR__."/../utils/core.php");

	class auth_class extends db_connection{



		//======================================= SELECT ====================================
		function user_login($email,$password){
			$sql = "SELECT * FROM `users`
			WHERE `email` = '$email' AND `password` = '$password'
			";
			// return $sql;
			return $this->db_fetch_one($sql);
		}

		function curator_login($user_id){
			$sql = "SELECT * FROM `curator_manager`
			JOIN users on curator_manager.user_id = users.user_id
			WHERE curator_manager.user_id = '$user_id'";
			return $this->db_fetch_one($sql);
		}


		function admin_login($user_id){
			$sql = "SELECT * FROM `admin_manager`
			JOIN users on users.user_id = admin_manager.user_id
			WHERE admin_manager.user_id = '$user_id'";
			return $this->db_fetch_one($sql);
		}


		function get_password_token($email){
			$sql = "SELECT `token` FROM `forgot_password_token`
			JOIN `users` on users.user_id = forgot_password_token.user_id
			WHERE users.email = '$email'
			 AND forgot_password_token.expiry_date < CURRENT_TIMESTAMP";
			return $this->db_fetch_one($sql);
		}

		function is_user_a_collaborator($user_id){
			$sql = "SELECT * FROM `curator_manager` WHERE
			`user_id`='$user_id'";
			return $this->db_fetch_one($sql);
		}

		function get_user_by_email($email){
			$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
			return $this->db_fetch_one($sql);
		}

		function get_user_by_id($id){
			$sql = "SELECT * FROM `users` WHERE `user_id`='$id'";
			return $this->db_fetch_one($sql);
		}

		function verify_reset_token($token){
			$sql = "SELECT * FROM `forgot_password_token` WHERE `token`='$token'";
			return $this->db_fetch_one($sql);
		}


		function get_curator_collaborators($curator_id){
			$sql = "SELECT * FROM `curator_manager`
			WHERE `curator_id`='$curator_id'";
			return $this->db_fetch_all($sql);
		}

		function get_curator_invite_by_email($email){
			$sql = "SELECT * FROM `curator_manager_invite`";
			return $this->db_fetch_one($sql);
		}



		//===================================== INSERT =========================================

		/**Creates a user entry with the parameters passed */
		function sign_up_user($user_id, $email, $user_name,$password,$phone_number,$country,$profile_image){
			$sql = "INSERT INTO `users`(`user_id`,`email`,`user_name`,`password`,`phone_number`,`country`,`profile_image`)
			VALUES('$user_id','$email','$user_name','$password', '$phone_number','$country',NULL)";
			// return $sql;
			return $this->db_query($sql);
		}



		function create_curator_account($curator_id,$curator_name,$logo_id){
			$sql = "INSERT INTO `curators`(`curator_id`,`curator_name`,`curator_logo`)
			VALUES ('$curator_id','$curator_name',NULL)";
			return $this->db_query($sql);
		}

		function add_curator_manager($curator_id, $user_id, $privilege){
			$sql = "INSERT INTO `curator_manager`(`curator_id`, `user_id`,`privilege`)
			VALUES ('$curator_id', '$user_id', '$privilege')";
			return $this->db_query($sql);
		}


		function invite_curator_manager($curator_id,$email, $privilege){
			$sql = "INSERT INTO `curator_manager_invite` (`curator_id`, `email_address`, `privilege`,`invite_expiry`)
			VALUE ('$curator_id','$email','$privilege',now() + INTERVAL 24 HOUR)";
			return $this->db_query($sql);
		}

		function add_admin_user($user_id,$privilege){
			$sql = "INSERT INTO `admin_users`(`user_id`, `privilege`)
			VALUES ('$user_id','$privilege');
			UPDATE `users` set `role` = 'admin' WHERE `user_id` = '$user_id'
			";

			return $this->db_query($sql);
		}


		function record_user_login($user_id){
			$sql = "INSERT INTO `login_log`(`user_id`) VALUE ('$user_id')";
			return $this->db_query($sql);
		}


		function add_user_following($user_id,$curator_id){
			$sql = "INSERT INTO `user_following`(`user_id`, `curator_id`)
			VALUE ('$user_id','$curator_id')";
			return $this->db_query($sql);
		}

		function create_password_reset_token($token,$user_id){
			$sql = "INSERT INTO `forgot_password_token`(`token`,`user_id`,`expiry_date`)
			VALUE ('$token','$user_id',now() + INTERVAL 4 HOUR)";
			return $this->db_query($sql);
		}

		function create_email_verification_token($token, $user_id){
			$sql = "INSERT INTO `email_verification`(`token`,`user_id`)
			VALUE ('$token','$user_id')";
			return $this->db_query($sql);
		}





		// ============================ UPDATE=========================================
		function change_user_role($user_id, $role){
			$sql = "UPDATE `users` SET `role` = '$role' WHERE `user_id` = '$user_id'";
			return $this->db_query($sql);
		}


		function change_user_account_status($user_id, $status){
			$sql = "UPDATE `users` SET `account_status` = '$status' WHERE `user_id` = '$user_id'";
			return $this->db_query($sql);
		}

		function change_user_password($token,$password){
			$sql = "UPDATE `users`
				inner join forgot_password_token on users.user_id = forgot_password_token.user_id
				SET users.password ='$password'
				where forgot_password_token.token = '$token'";
				// return $sql;
			return $this->db_query($sql);
		}



		//================================ DELETE =============================================
		function remove_user_following($user_id,$curator_id){
			$sql = "DELETE FROM `user_following` WHERE `user_id` = '$user_id' AND `curator_id` = '$curator_id'";
			return $this->db_query($sql);
		}


		function remove_used_password_token($token){
			$sql = "DELETE FROM `forgot_password_token` WHERE `token` = '$token'";
			return $this->db_query($sql);
		}


		function remove_expired_tokens(){
			$sql = "REMOVE FROM `forgot_password_token` WHERE `expiry_date` < CURRENT_TIMESTAMP";
			return $this->db_query($sql);
		}

		function remove_expired_curator_invites(){
			$sql = "REMOVE FROM `curator_manager_invite` WHERE `invite_expiry` < CURRENT_TIMESTAMP";
			return $this->db_query($sql);
		}

		function remove_curator_invite($email){
			$sql = "DELETE FROM `curator_manager_invite` WHERE `email_address`='$email'";
			return $this->db_query($sql);
		}

		function remove_curator_collaborator($user_id,$curator_id){
			$sql = "DELETE FROM `curator_manager`
			WHERE `user_id` = '$user_id' AND  `curator_id`='$curator_id'";
			return $this->db_query($sql);
		}
	}
?>