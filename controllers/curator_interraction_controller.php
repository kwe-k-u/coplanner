<?php
	require_once(__DIR__."/../classes/curator_interaction_class.php");



	function get_collaborator_info($user_id){
		$class = new curator_interaction_class();
		return $class->get_collaborator_info($user_id);
	}


	function get_recent_bookings($curator_id){
		$class = new curator_interaction_class();
		return $class->get_recent_bookings($curator_id);
	}

	function get_curator_statistics($curator_id){
		$class = new curator_interaction_class();
		return array(
			"upcoming_trip_count" => $class->get_curator_trip_count($curator_id)["upcoming_trip_count"] ?? 0,
			"total_revenue" =>$class->get_curator_revenue($curator_id)["total_revenue"] ?? 0,
			"withdrawable_balance" => $class->get_curator_balance($curator_id)["withdrawable_balance"] ?? 0
		);
	}


	function get_curator_upcoming_trips($curator_id){
		$class  = new curator_interaction_class();
		return $class->get_curator_upcoming_trips($curator_id);
	}

?>