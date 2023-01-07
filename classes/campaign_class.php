<?php
	require_once(__DIR__. "/../utils/db_class.php");


	class campaign_class extends db_connection{


		//=============================SELECT======================
		function get_campaign_tour_by_id($id){
			$sql = "SELECT * FROM `campaign_trips` WHERE `trip_id`='$id'";
			return $this->db_fetch_one($sql);
		}


		function get_toursite_by_name($name){
			$sql = "SELECT * FROM `toursites` WHERE `site_name` LIKE %$name%";
			return $this->db_fetch_all($sql);
		}




		//=============================INSERT======================
		function create_campaign($campaign_id,$curator_id,$title, $description){
			$sql = "INSERT INTO `campaigns` (`campaign_id`, `curator_id`,`title`,`description` )
			VALUE ('$campaign_id', '$curator_id', '$title', '$description')";
			return $this->db_query($sql);
		}


		function create_campaign_trip($trip_id,$campaign_id,$pickup_location, $dropoff_location, $start_date, $end_date,$seats, $currency, $fee,$status){
			$sql = "INSERT INTO `campaign_trips`(`trip_id`, `campaign_id`, `pickup_location`, `dropoff_location`, `start_date`, `end_date`, `seats_available`, `currency`, `fee`, `publish_state`)
			VALUES
			('$trip_id','$campaign_id','$pickup_location','$dropoff_location','$start_date','$end_date','$seats','$currency','$fee', '$status')";
			return $this->db_query($sql);
		}


		function add_toursite($site_id,$name,$location,$country){
			$sql = "INSERT INTO `toursites`(`toursite_id`,`site_name`,`site_location`,`country`)
			VALUE ('$site_id', '$name', '$location','$country')";
			return $this->db_query($sql);
		}


		function add_toursite_activity($site_id, $activity_id,$activity){
			$sql = "INSERT INTO toursite_activity(`activity_id`, `toursite_id`,`activity_name`)
			VALUE ('$activity_id', '$site_id', '$activity') ";
			return $this->db_query($sql);
		}

		function add_campaign_activity($campaign_id, $activity_id){
			$sql = "INSERT INTO `campaign_activities` VALUE ('$campaign_id', '$activity_id')";
			return $this->db_query($sql);
		}






		//================================UPDATE ===============================================
	}
?>