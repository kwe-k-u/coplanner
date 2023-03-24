<?php
	require_once(__DIR__. "/db_connection.php");


	class db_class extends db_prepared{

		function credentials_exist($email){
			$sql = "SELECT * FROM users WHERE email = ?";
			$this->prepare($sql);
			$this->bind($email);
			return $this->db_fetch_one() ==true;
		}

		function get_current_prompt($email){
			$sql = "SELECT * FROM `generated_prompt`
			JOIN requests on requests.request_id = generated_prompt.request_id
			JOIN users on users.email = requests.email
			WHERE requests.email = ?
			ORDER BY generated_prompt.prompt_id DESC";
			$this->prepare($sql);
			$this->bind($email);
			return $this->db_fetch_one();
		}



		function location_exists($location){
			$sql = "SELECT * from locations where location_name = ?";
			$this->prepare($sql);
			$this->bind($location);
			return $this->db_fetch_one() == true;
		}

		function activity_exists($activity){
			$sql = "SELECT * from activities where activity_name = ?";
			$this->prepare($sql);
			$this->bind($activity);
			return $this->db_fetch_one() == true;
		}


		function create_account($name,$email,$institution,$number){
			if(!$this->credentials_exist($email)){
				$sql = "INSERT INTO users(email,user_name,phone,institution)
				 VALUE (?,?,?,?)";
				 $this->prepare($sql);
				 $this->bind($email, $name,$number,$institution);
				//  $this->bind($name);
				// $this->bind($number);
				// $this->bind($institution);

				return $this->db_query();
			}

			return true;
		}

		function verify_token($token){
			$sql = "SELECT * FROM login_token where token = ?";
			$this->prepare($sql);
			$this->bind($token);
			return $this->db_fetch_one();
		}

		function store_token($email,$token){
			$sql = "INSERT INTO login_token(email,token) VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($email,$token);
			return $this->db_query();
		}

		function remove_token($token){
			$sql = "DELETE FROM login_token where token = ?";
			$this->prepare($sql);
			$this->bind($token);
			return $this->db_query();
		}

		function add_location($location,$request_id){
			if (!$this->location_exists($location)){
				$sql = "INSERT INTO locations VALUE (?)";
				$this->prepare($sql);
				$this->bind($location);
				$this->db_query();
			}
			$sql = "INSERT INTO request_location(`request_id`,`location_name`) VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($request_id,$location);
			return $this->db_query();
		}

		function add_activity($activity,$request_id){
			if (!$this->activity_exists($activity)){
				$sql = "INSERT INTO activities VALUE (?)";
				$this->prepare($sql);
				$this->bind($activity);
				$this->db_query();
			}
			$sql = "INSERT INTO request_activity(`request_id`,`activity_name`) VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($request_id,$activity);
			return $this->db_query();
		}

		function add_request($email){
			$sql = "INSERT INTO requests(`email`) VALUE (?)";
			$this->prepare($sql);
			$this->bind($email);
			$this->db_query();
			$sql = "SELECT request_id FROM requests where email= ? ORDER BY request_id desc";
			$this->prepare($sql);
			$this->bind($email);
			return $this->db_fetch_one()["request_id"];
		}

		function save_response($request_id,$prompt_text){
			$sql = "INSERT INTO generated_prompt(`request_id`,`prompt_text`) VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($request_id,$prompt_text);
			return $this->db_query();
		}


	}
?>