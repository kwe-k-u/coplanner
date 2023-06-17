<?php
	require_once(__DIR__."/../utils/db_prepared.php");
	require_once(__DIR__."/../utils/core.php");

	class auth_class extends db_prepared{



		//======================================= SELECT ====================================
		function user_login($email,$password){
			$sql = "SELECT * FROM `users`
			WHERE `email` = ? AND `password` = ?
			";

			$this->prepare($sql);

			$this->bind($email,$password);
			return $this->db_fetch_one();

			// return $sql;
			// return $this->db_fetch_one($sql);
		}


		function curator_login($user_id){
			$sql = "SELECT * FROM `curator_manager`
			JOIN users on curator_manager.user_id = users.user_id
			WHERE curator_manager.user_id = ?";
			// return $this->db_fetch_one($sql);

			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_one();
		}


		function admin_login($user_id){
			$sql = "SELECT * FROM `admin_users`
			JOIN users on users.user_id = admin_users.user_id
			WHERE admin_users.user_id = ?";
			// return $this->db_fetch_one($sql);

			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_one();
		}


		function get_password_token($email){
			$sql = "SELECT `token` FROM `forgot_password_token`
			JOIN `users` on users.user_id = forgot_password_token.user_id
			WHERE users.email = ?
			 AND forgot_password_token.expiry_date < CURRENT_TIMESTAMP";
			// return $this->db_fetch_one($sql);

			$this->prepare($sql);
			$this->bind($email);

			return $this->db_fetch_one();
		}

		function is_user_a_collaborator($user_id){
			$sql = "SELECT * FROM `curator_manager` WHERE
			`user_id`= ?";
			// return $this->db_fetch_one($sql);

			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_one();
		}

		function get_user_by_email($email){
			$sql = "SELECT * FROM `users` WHERE `email` = ?";
			// return $this->db_fetch_one($sql);
			$this->prepare($sql);
			$this->bind($email);

			return $this->db_fetch_one();
		}

		function get_user_by_id($id){
			$sql = "SELECT
			users.*,
			media.media_location,
			media.media_type
			FROM `users`
			LEFT JOIN media on media.media_id = users.profile_image
			WHERE `user_id`=?";

			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function verify_reset_token($token){
			$sql = "SELECT * FROM `forgot_password_token` WHERE `token`=?";
			// return $this->db_fetch_one($sql);
			$this->prepare($sql);
			$this->bind($token);
			return $this->db_fetch_one();
		}


		function get_curator_collaborators($curator_id){
			$sql = "SELECT * FROM `curator_manager`
			WHERE `curator_id`=?";
			// return $this->db_fetch_all($sql);
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_one();
		}

		function get_curator_invite_by_email($email){
			$sql = "SELECT * FROM `curator_manager_invite` WHERE email_address = ?
			AND `invite_expiry` < CURRENT_TIMESTAMP";
			$this->prepare($sql);
			$this->bind($email);

			return $this->db_fetch_one();
		}

		function get_curator_invite_by_token($token){
			$sql = "SELECT * FROM `curator_manager_invite` WHERE token = ?";
			$this->prepare($sql);
			$this->bind($token);

			return $this->db_fetch_one();
		}



		//===================================== INSERT =========================================

		/**Creates a user entry with the parameters passed */
		function sign_up_user($user_id, $email, $user_name,$password,$phone_number,$country){
			$sql = "INSERT INTO `users`(`user_id`,`email`,`user_name`,`password`,`phone_number`,`country`)
			VALUES(?,?,?,?, ?,?)";
			$this->prepare($sql);
			$this->bind($user_id,$email,$user_name,$password,$phone_number,$country);
			return $this->db_query();
		}



		function create_curator_account($curator_id,$curator_name, $country){
			$sql = "INSERT INTO `curators`(`curator_id`,`curator_name`,`curator_logo`, `country`)
			VALUES (?,?,NULL, ?)";
			$this->prepare($sql);
			$this->bind($curator_id,$curator_name,$country);
			return $this->db_query();
		}

		function add_curator_manager($curator_id, $user_id,$id_front,$id_back, $privilege){
			$sql = "INSERT INTO `curator_manager`(`curator_id`, `user_id`,`privilege`, `gov_id_front`, `gov_id_back`)
			VALUES (?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($curator_id,$user_id,$privilege,$id_front,$id_back);
			return $this->db_query();
		}


		function invite_curator_manager($curator_id,$email, $privilege){
			$sql = "INSERT INTO `curator_manager_invite` (`curator_id`, `email_address`, `privilege`,`invite_expiry`)
			VALUE (?,?,?,now() + INTERVAL 24 HOUR)";
			$this->prepare($sql);
			$this->bind($curator_id,$email,$privilege);
			return $this->db_query();
		}

		function add_admin_user($user_id,$privilege){
			$sql = "INSERT INTO `admin_users`(`user_id`, `privilege`)
			VALUES ('$user_id','$privilege');
			UPDATE `users` set `role` = 'admin' WHERE `user_id` = '$user_id'
			";

			return $this->db_query($sql);
		}


		function record_user_login($user_id){
			$sql = "INSERT INTO `login_log`(`user_id`) VALUE (?)";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_query();
		}


		function add_user_following($user_id,$curator_id){
			$sql = "INSERT INTO `user_following`(`user_id`, `curator_id`)
			VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($user_id,$curator_id);
			return $this->db_query();
		}

		function create_password_reset_token($token,$user_id){
			$sql = "INSERT INTO `forgot_password_token`(`token`,`user_id`,`expiry_date`)
			VALUE (?,?,now() + INTERVAL 4 HOUR)";
			$this->prepare($sql);
			$this->bind($token,$user_id);
			return $this->db_query($sql);
		}

		function create_email_verification_token($token, $user_id){
			$sql = "INSERT INTO `email_verification`(`token`,`user_id`)
			VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($token,$user_id);
			return $this->db_query();
		}





		// ============================ UPDATE=========================================
		function change_user_role($user_id, $role){
			$sql = "UPDATE `users` SET `role` = ? WHERE `user_id` = ?";
			$this->prepare($sql);
			$this->bind($user_id,$role);
			return $this->db_query();
		}


		function change_user_account_status($user_id, $status){
			$sql = "UPDATE `users` SET `account_status` = ? WHERE `user_id` = ?";
			$this->prepare($sql);
			$this->bind($status,$user_id);
			return $this->db_query();
		}

		function change_user_password($token,$password){
			$sql = "UPDATE `users`
				inner join forgot_password_token on users.user_id = forgot_password_token.user_id
				SET users.password =?
				where forgot_password_token.token = ?";
			$this->prepare($sql);
			$this->bind($password,$token);
				// return $sql;
			return $this->db_query($sql);
		}

		function change_password_by_user_id($user_id,$password){
			$sql = "UPDATE `users` SET `password`=?
			WHERE `user_id`=?";
			$this->prepare($sql);
			$this->bind($password,$user_id);
			return $this->db_query();
		}



		//================================ DELETE =============================================
		function remove_user_following($user_id,$curator_id){
			$sql = "DELETE FROM `user_following` WHERE `user_id` = ? AND `curator_id` = ?";

			$this->prepare($sql);
			$this->bind($user_id,$curator_id);
			return $this->db_query();
		}


		function remove_used_password_token($token){
			$sql = "DELETE FROM `forgot_password_token` WHERE `token` = ?";
			$this->prepare($sql);
			$this->bind($token);
			return $this->db_query($sql);
		}


		function remove_expired_tokens(){
			$sql = "REMOVE FROM `forgot_password_token` WHERE `expiry_date` < CURRENT_TIMESTAMP";
			$this->prepare($sql);
			return $this->db_query($sql);
		}

		function remove_expired_curator_invites(){
			$sql = "REMOVE FROM `curator_manager_invite` WHERE `invite_expiry` < CURRENT_TIMESTAMP";
			$this->prepare($sql);
			$this->db_query();
			// return $this->db_query($sql);
		}

		function remove_curator_invite($email){
			$sql = "DELETE FROM `curator_manager_invite` WHERE `email_address`=?";
			$this->prepare($sql);
			$this->bind($email);
			return $this->db_query();
			// return $this->db_query($sql);
		}

		function remove_curator_collaborator($user_id,$curator_id){
			$sql = "DELETE FROM `curator_manager`
			WHERE `user_id` = ? AND  `curator_id`=?";
			$this->prepare($sql);
			$this->bind($user_id,$curator_id);
			return $this->db_query();
			// return $this->db_query($sql);
		}
	}
?>