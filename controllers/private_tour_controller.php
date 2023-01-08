<?php
	require_once(__DIR__."/../classes/private_tour_class.php");


	function create_private_trip($id, $user, $currency,$min_bug,
	$max_bug,$desc,$start,$end,$state,$count){

		$trip = new private_tour_class();
		return $trip->create_private_trip($id, $user, $currency,$min_bug,
			$max_bug,$desc,$start,$end,$state,$count);
		}

		function edit_private_tour_request($id, $currency,$min_bug,$max_bug,
		$desc,$start,$end,$state, $count){
			$trip = new private_tour_class();
			return $trip->edit_private_tour_request($id, $currency,$min_bug,
				$max_bug,$desc,$start,$end,$state,$count);
		}

		function remove_private_tour_request($id){
			$tour = new private_tour_class();
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


	function get_user_private_trip_requests($id){
		$trip = new private_tour_class();
		return $trip->get_user_private_trip_requests($id);
	}


	function get_private_trip_requests($accepted = false){
		$trip = new private_tour_class();
		return $trip->get_private_trip_requests($accepted);
	}

	function get_private_trip_by_id($id){
		$trip = new private_tour_class();
		return $trip->get_private_trip_by_id($id);
	}
?>