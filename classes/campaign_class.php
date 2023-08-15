<?php
	require_once(__DIR__. "/../utils/db_prepared.php");


	class campaign_class extends db_prepared{


		//=============================SELECT======================
		function get_campaign_tour_by_id($id){
			$sql = "SELECT * FROM `campaign_tours` WHERE `tour_id`=?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_campaign_media($id){
			$sql = "SELECT
				media.* FROM media
				JOIN campaign_media on campaign_media.media_id = media.media_id
				WHERE campaign_media.campaign_id = ?
			";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}


		function get_destination_by_name($name,$exact = false){
			$sql = "SELECT * FROM `destinations` WHERE `destination_name` LIKE ".($exact ? "?" : " CONCAT('%',?,'%')");
			$this->prepare($sql);
			$this->bind($name);
			return $exact ? $this->db_fetch_one() :$this->db_fetch_all();
		}

		function get_activity_by_name($name, $exact = false){
			$sql = "SELECT * FROM `activities` where activity_name like " .($exact ? "?" : "CONCAT('%',?,'%')");
			$this->prepare($sql);
			$this->bind($name);
			return $exact ? $this->db_fetch_one() :$this->db_fetch_all();
		}





		//=============================INSERT======================
		function create_campaign($campaign_id,$curator_id,$title, $description){
			$sql = "INSERT INTO `campaigns` (`campaign_id`, `curator_id`,`title`,`description` )
			VALUE (?,?,?,?)";
			$this->prepare($sql);
			$this->bind($campaign_id,$curator_id,$title,$description);

			return $this->db_query();
		}

		function add_activity($activity){
			$sql = "INSERT INTO `activities`(`activity_name`) VALUES (?)";
			$this->prepare($sql);
			$this->bind($activity);
			return $this->db_query();
		}


		function create_campaign_trip($tour_id,$campaign_id,$pickup_location, $dropoff_location, $start_date, $end_date,$seats, $currency, $fee,$status){
			$sql = "INSERT INTO `campaign_tours`(`tour_id`, `campaign_id`, `pickup_location`, `dropoff_location`, `start_date`, `end_date`,
			 `seats_available`, `currency`, `fee`, `publish_state`)
			VALUES
			(?,?,?,?,?,?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($tour_id,$campaign_id,$pickup_location,$dropoff_location,$start_date,$end_date,$seats,$currency,$fee,$status);
			return $this->db_query();
		}


		function add_destination($site_id,$name,$desc,$location,$country){
			$sql = "INSERT INTO `destinations`(`destination_id`,`destination_name`,`destination_description`,`destination_location`,`country`)
			VALUE (?, ?,?, ?,?)";
			$this->prepare($sql);
			$this->bind($site_id,$name,$desc,$location,$country);
			return $this->db_query();
		}


		function add_destination_activity($site_id, $activity_id,$fee,$is_verified){
			$sql = "INSERT INTO destination_activity(`activity_id`, `destination_id`,`activity_fee`,`is_verified`)
			VALUE (?,?,?,?) ";
			$this->prepare($sql);
			$this->bind($activity_id,$site_id,$fee,$is_verified);
			return $this->db_query();
		}

		function add_campaign_activity($campaign_id, $activity_id, $touriste_id){
			$sql = "INSERT INTO `campaign_activities` VALUE (?,?,?)";
			$this->prepare($sql);
			$this->bind($campaign_id,$activity_id,$touriste_id);
			return $this->db_query();
		}






		//================================UPDATE ===============================================
	}
?>