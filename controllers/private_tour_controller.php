<?php
	require_once(__DIR__."/../classes/private_tour_class.php");


	function create_private_tour_custom($id, $user, $currency,$min_bug,
	$max_bug,$desc,$start,$end,$state,$count){

		$trip = new private_tour_class();
		$trip->create_private_tour($id, $user, $currency,$min_bug,
			$max_bug,$start,$end,$state,$count);
		return $trip->create_private_tour_custom($id,$desc);
	}


	function create_private_tour_campaign($id,$c_id, $user, $currency,$min_bug,
	$max_bug,$start,$end,$state,$count){

		$trip = new private_tour_class();
		$trip->create_private_tour($id, $user, $currency,$min_bug,
			$max_bug,$start,$end,$state,$count);
		return $trip->create_private_tour_campaign($id,$c_id);
	}




	function edit_custom_private_tour_request($id, $currency,$min_bug,$max_bug,
	$desc,$start,$end,$state, $count){
		$trip = new private_tour_class();
		$trip->edit_private_tour_request($id, $currency,$min_bug,
			$max_bug,$start,$end,$state,$count);
		return $trip->edit_private_tour_description($id,$desc);
	}

	function edit_campaign_private_tour_request($id, $currency,$min_bug,$max_bug,
	$start,$end,$state, $count){
		$trip = new private_tour_class();
		return $trip->edit_private_tour_request($id, $currency,$min_bug,
			$max_bug,$start,$end,$state,$count);
	}


	function remove_private_tour_request($id){
		$tour = new private_tour_class();
		$tour->remove_campaign_private_tour_request($id);
		$tour->remove_custom_private_tour_request($id);
		return $tour->remove_private_tour_request($id);
	}

	function place_tour_request_bid($b_id,$curator,$r_id,$comment,$fee){
		$trip = new private_tour_class();
		return $trip->place_tour_request_bid($b_id,$curator,$r_id,$comment,$fee);
	}

	function count_request_quotes($id){
		$trip = new private_tour_class();
		return $trip->count_request_quotes($id)["count"];
	}


	// Returns a list of all the private tours requested by the user
	// To view campaign private tours, set the {campaign} to true
	function get_user_private_trip_requests($id, $campaign = false){
		$trip = new private_tour_class();
		if($campaign){
			return $trip->get_user_private_trip_requests_campaign($id);
		}
		return $trip->get_user_private_trip_requests_custom($id);
	}


	function get_private_trip_requests($accepted = false){
		$trip = new private_tour_class();
		return $trip->get_private_trip_requests($accepted);
	}

	function get_custom_private_tour_by_id($id){
		$trip = new private_tour_class();
		return $trip->get_custom_private_tour_by_id($id);
	}

	function get_campaign_private_tour_by_id($id){
		$trip = new private_tour_class();
		return $trip->get_campaign_private_tour_by_id($id);
	}
?>