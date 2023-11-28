<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/db_prepared.php");


	class public_class extends db_prepared{

		function email_signup($name,$email,$password){
			$sql = "SELECT email_signup(?,?,?);";
			$this->prepare($sql);
			$this->bind($name,$email,$password);
			return $this->db_fetch_one();
		}

		function provider_signup($provider,$name,$id){
			$sql = "SELECT provider_signup(?,?,?);";
			$this->prepare($sql);
			$this->bind($provider,$name,$id);
			return $this->db_fetch_one();
		}

		function email_login($email,$password){
			$sql = "SELECT  user_id from vw_users where email = ? and password_hash = ?";
			$this->prepare($sql);
			$this->bind($email,$password);
			return $this->db_fetch_one();
		}

		function provider_login($provider_col,$provider_id){
			$sql = "SELECT user_id FROM vw_users WHERE `$provider_col` = ?";
			$this->prepare($sql);
			$this->bind($provider_id);
			return $this->db_fetch_one();
		}

		function create_itinerary($user_id,$num_people,$status){
			$sql = "SELECT create_itinerary(?,?,?)";;
			$this->prepare($sql);
			$this->bind($user_id,$num_people,$status);
			return $this->db_fetch_one();
		}

		function add_itinerary_day($itinerary_id){
			$sql = "SELECT add_itinerary_day(?)";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_one($sql);
		}


		function add_itinerary_destination($day_id,$destination_id){
			$sql = "SELECT add_itinerary_destination(?,?)";;
			$this->prepare($sql);
			$this->bind($day_id,$destination_id);
			return $this->db_fetch_one();
		}

		function get_destinations_by_name($name){
			$sql = "SELECT * FROM destinations ";
			if($name){
				$sql .=" where destination_name like ? ";
			}
			$this->prepare($sql);

			if($name){
				$this->bind("%$name%");
			}
			return $this->db_fetch_all();
		}

		function get_destination_by_id($id){
			$sql = "SELECT * FROM destinations where destination_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_user_itineraries($user_id){
			$sql = "SELECT * FROM itineraries where owner_id = ?";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_all();
		}

		function get_user_info($user_id){
			$sql = "SELECT * FROM vw_users where user_id = ?";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_one();
		}

		function get_destinations(){
			$sql = "CALL get_destinations()";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_destination_activities($destination_id){
			$sql = "CALL get_destination_activities(?)";
			$this->prepare($sql);
			$this->bind($destination_id);
			return $this->db_fetch_all();
		}

		function get_destination_utilities($destination_id){
			$sql = "CALL get_destination_utilities(?)";
			$this->prepare($sql);
			$this->bind($destination_id);
			return $this->db_fetch_all();
		}

		function get_itineraries($user_id){
			$sql = "CALL get_itineraries(?)";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_all();
		}

		function get_itinerary_collaborators($itinerary_id){
			$sql = "CALL get_itinerary_collaborators(?)";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_all();
		}


	}
?>