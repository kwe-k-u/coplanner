<?php
	require_once(__DIR__. "/../utils/db_class.php");


	class campaign_class extends db_connection{



		//=============================INSERT======================
		function create_campaign_cls($campaign_id,$curator_id,$title, $description){
			$sql = "INSERT INTO `campaigns` (`campaign_id`, `curator_id`,`title`,`description` )
			VALUE ('$campaign_id', '$curator_id', '$title', '$description')";
			return $this->db_query($sql);
		}


		function create_campaign_trip($trip_id,$campaign_id,$pickup_location, $dropoff_location, $start_date, $end_date,$seats, $fee,$status){
			$sql = "INSERT INTO `campaign_trips` (`trip_id`, `campagin_id`,`pickup_location`,`dropoff_location`,`start_date`,`end_date`,`fee`,`seats`)
			VALUE ('$trip_id','$campaign_id','$pickup_location','$dropoff_location', '$start_date', '$end_date','$seats','$fee','$status')";
			return $this->db_query($sql);
		}





		//================================UPDATE ===============================================
	}
?>