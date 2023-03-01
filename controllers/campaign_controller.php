<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../classes/campaign_class.php");


	function get_campaign_trip_by_id($id){
		$campaign = new campaign_class();
		return $campaign->get_campaign_tour_by_id($id);
	}


	// function get_campaign_by_id($id){
	// 	$campaign = new campaign_class();
	// 	return $campaign->get_campaign_by_id($id);
	// }


	// function get_campaign_trips($campaign_id){
	// 	$campaign = new campaign_class();
	// 	return $campaign->get_campaign_trips($campaign_id);
	// }

	// function get_campaign_activities($campaign_id){
	// 	$campaign = new campaign_class();
	// 	return $campaign->get_campaign_activities($campaign_id);
	// }

	// function get_toursite_by_campaign($id){
	// 	$camp = new campaign_class();
	// 	return $camp->get_toursite_by_campaign($id);
	// }

	// function get_campaign_next_trip($id){
	// 	$camp = new campaign_class();
	// 	return $camp->get_campaign_next_trip($id);
	// }

	function create_campaign($camp_id, $curator_id, $title,$description){
		$campaign = new campaign_class();
		return $campaign->create_campaign($camp_id,$curator_id, $title,$description);
	}

	function create_campaign_trip($trip_id,$camp_id,$pickup,$dropoff,$start,$end,$seats,$currency, $fee,$status){
		$camp = new campaign_class();
		return $camp->create_campaign_trip($trip_id,$camp_id, $pickup,$dropoff,$start,$end,$seats,$currency,$fee,$status);
	}

	function add_toursite($id,$name,$location,$country){
		$camp = new campaign_class();
		return $camp->add_toursite($id,$name,$location,$country);
	}

	function add_toursite_activity($site_id,$activity_id,$activity){
		$camp = new campaign_class();
		return $camp->add_toursite_activity($site_id,$activity_id, $activity);
	}


	function add_campaign_activity($campaign_id, $activity_id){
		$camp = new campaign_class();
		return $camp->add_campaign_activity($campaign_id, $activity_id);
	}


	// function get_current_campaigns(){
	// 	$camp = new campaign_class();
	// 	return $camp->get_current_campaigns();
	// }







	function get_toursite_by_name($name){
		$camp = new campaign_class();
		return $camp->get_toursite_by_name($name);
	}
?>
