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

		function get_current_campaigns(){
			$sql = "SELECT campaigns.*,curators.curator_name FROM `campaigns`
			JOIN curators on campaigns.curator_id = curators.curator_id";
			return $this->db_fetch_all($sql);
		}

		function get_campaign_by_id($id){
			$sql = "SELECT campaigns.*, curators.curator_name FROM `campaigns`
			join curators on curators.curator_id = campaigns.curator_id
			where campaigns.campaign_id = '$id'";

			return $this->db_fetch_one($sql);
		}

		function get_campaign_trips($campaign_id){
			$sql = "SELECT * FROM `campaign_trips`
			WHERE `campaign_id` = '$campaign_id'";
			return $this->db_fetch_all($sql);
		}


		function get_campaign_activities($campaign_id){
			$sql = "SELECT toursite_activity.activity_name FROM `campaign_activities`
			join toursite_activity on toursite_activity.activity_id = campaign_activities.activity_id
			WHERE campaign_activities.campaign_id = '$campaign_id'";
			return $this->db_fetch_all($sql);
		}

		function get_toursite_by_campaign($id){
			$sql = "SELECT toursites.* from toursites
			join toursite_activity on toursite_activity.toursite_id = toursites.toursite_id
			join campaign_activities on toursite_activity.activity_id = campaign_activities.activity_id
			WHERE campaign_activities.campaign_id = '$id' ";
			return $this->db_fetch_all($sql);
		}

		function get_campaign_next_trip($id){
			$sql = "SELECT * FROM `campaign_trips`
			where `campaign_id`='$id' AND start_date > CURRENT_TIMESTAMP";
			return $this->db_fetch_one($sql);
		}



		function get_past_campaigns(){
			$sql = "SELECT * FROM `campaigns`";
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