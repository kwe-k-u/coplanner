<?php
	require_once(__DIR__."/../utils/db_prepared.php");

	class admin_class extends db_prepared{

		function create_destination($name,$location,$lat,$long,$rating){
			$sql = "SELECT create_destination(?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($name,$location,$lat,$long,$rating);
			return $this->db_fetch_one();
		}

		// function create_itinerary($user_id,$num_people,$status){
		// 	$sql = "SELECT create_itinerary(?,?,?)";
		// 	$this->prepare($sql);
		// 	$this->bind($user_id,$num_people,$status);
		// 	return $this->db_fetch_one();
		// }

		function add_itinerary_destination($day_id,$destination_id){
			$sql = "SELECT add_itinerary_destination(?,?)";
			$this->prepare($sql);
			$this->bind($day_id,$destination_id);
			return $this->db_fetch_one();
		}

		function add_itinerary_activity($day_id,$activity_id){
			$sql = "SELECT add_itinerary_activity(?,?);";
			$this->prepare($sql);
			$this->bind($day_id,$activity_id);
			return $this->db_fetch_one();
		}

		function add_itinerary_day($itinerary_id){
			$sql = "SELECT  add_itinerary_day(?)";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_one();
		}

		function add_destination_activity($destination_id,$activity_name,$price){
			$sql = "SELECT add_destination_activity(?,?,?)";
			$this->prepare($sql);
			$this->bind($destination_id,$activity_name,$price);
			return $this->db_fetch_one();
		}
	}
?>