<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/db_prepared.php");


	class public_class extends db_prepared{

		function email_signup($name,$email,$password){
			$sql = "SELECT email_signup('$name','$email','$password');";
			$this->prepare($sql);
			// $this->bind($name,$email,$password);
			return $this->db_fetch_one();
		}

		function google_signup($name,$id){
			$sql = "SELECT provider_signup('google',?,?);";
			$this->prepare($sql);
			$this->bind($name,$id);
			return $this->db_fetch_one();
		}

		function apple_signup($name,$id){
			$sql = "SELECT provider_signup('apple',?,?);";
			$this->prepare($sql);
			$this->bind($name,$id);
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

	}
?>