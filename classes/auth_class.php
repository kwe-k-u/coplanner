<?php
	require_once(__DIR__."/../utils/db_class.php");

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

		function create_password_reset_token($token,$user_id,$expiry){
			$sql = "INSERT INTO `forgot_password_token`(`token`,`user_id`,`expiry_date`)
			VALUE ('$token','$user_id','$expiry')";
			return $this->db_query($sql);
		}

		function create_email_verification_token($token,$user_id){
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



		//================================ DELETE =============================================
		function remove_user_following($user_id,$curator_id){
			$sql = "DELETE FROM `user_following` WHERE `user_id` = '$user_id' AND `curator_id` = '$curator_id'";
			return $this->db_query($sql);
		}


		function remove_forgot_password_token($token){
			$sql = "REMOVE FROM `forgot_password_token` WHERE `token` = '$token'";
			return $this->db_query($sql);
		}


	}
?>