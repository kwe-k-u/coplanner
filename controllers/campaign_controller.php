<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../classes/campaign_class.php");


	function get_campaign_trip_by_id($id){
		$campaign = new campaign_class();
		$data = $campaign->get_campaign_tour_by_id($id);
		$data["media"] = $campaign->get_campaign_media($data["campaign_id"]);
		return $data;
	}



	// function get_campaign_by_id($id){
	// 	$campaign = new campaign_class();
	// 	return $campaign->get_campaign_by_id($id);
	// }


	// function get_campaign_tours($campaign_id){
	// 	$campaign = new campaign_class();
	// 	return $campaign->get_campaign_tours($campaign_id);
	// }

	// function get_campaign_activities($campaign_id){
	// 	$campaign = new campaign_class();
	// 	return $campaign->get_campaign_activities($campaign_id);
	// }

	// function get_destination_by_campaign($id){
	// 	$camp = new campaign_class();
	// 	return $camp->get_destination_by_campaign($id);
	// }

	// function get_campaign_next_trip($id){
	// 	$camp = new campaign_class();
	// 	return $camp->get_campaign_next_trip($id);
	// }

	function create_campaign($camp_id, $curator_id, $title,$description){
		$campaign = new campaign_class();
		return $campaign->create_campaign($camp_id,$curator_id, $title,$description);
	}

	function create_campaign_trip($tour_id,$camp_id,$pickup,$dropoff,$start,$end,$seats,$currency, $fee,$status){
		$camp = new campaign_class();
		return $camp->create_campaign_trip($tour_id,$camp_id, $pickup,$dropoff,$start,$end,$seats,$currency,$fee,$status);
	}

	function add_destination($id,$name,$desc,$location,$country){
		$camp = new campaign_class();
		return $camp->add_destination($id,$name,$desc,$location,$country);
	}

	function add_destination_activity($site_id,$activity,$fee = 0,$is_verified = false){
		$camp = new campaign_class();
		$act = $camp->get_activity_by_name($activity,true);
		if($act){//link activity if exists
			$activity_id = $act["activity_id"];
		}else { //create activity and then link if exists
			$camp->add_activity($activity);
			$act = $camp->get_activity_by_name($activity,true);
			$activity_id = $act['activity_id'];
		}
		return $camp->add_destination_activity($site_id,$activity_id,$fee,$is_verified);
	}


	function add_campaign_activity($campaign_id, $activity_id,$destination_id){
		$camp = new campaign_class();
		return $camp->add_campaign_activity($campaign_id, $activity_id,$destination_id);
	}


	// function get_current_campaigns(){
	// 	$camp = new campaign_class();
	// 	return $camp->get_current_campaigns();
	// }







	function get_destination_by_name($name,$exact = false){
		$camp = new campaign_class();
		return $camp->get_destination_by_name($name,$exact);
	}
?>
