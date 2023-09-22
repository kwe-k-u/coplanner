<?php
	require_once(__DIR__."/../classes/curator_interaction_class.php");
	require_once(__DIR__."/../classes/interaction_class.php");



	function get_collaborator_info($user_id){
		$class = new curator_interaction_class();
		return $class->get_collaborator_info($user_id);
	}


	function get_recent_bookings($curator_id){
		$class = new curator_interaction_class();
		return $class->get_recent_bookings($curator_id);
	}

	/**Returns an array with summary stats about the curator. Toggle full to show all stats */
	function get_curator_statistics($curator_id, $full = false){
		$class = new curator_interaction_class();
		$rating = get_average_rating($curator_id);
		return array(
			($full ? "tour_count" : "upcoming_trip_count") => $class->get_curator_trip_count($curator_id, $full)["upcoming_trip_count"] ?? 0,
			"total_revenue" =>$class->get_curator_revenue($curator_id)["total_revenue"] ?? 0,
			"withdrawable_balance" => $class->get_curator_balance($curator_id)["withdrawable_balance"] ?? 0,
			"average_rating" =>$rating["average_rating"] ?? 0,
			"review_count" => $rating["review_count"]
		);
	}

	function get_average_rating($curator_id){
		$class = new curator_interaction_class();
		$results = $class->get_average_rating($curator_id);
		return $results ? $results : array("average_rating"=> 0, "review_count" => 0);
	}


	function get_curator_upcoming_trips($curator_id){
		$class  = new curator_interaction_class();
		$data = $class->get_curator_upcoming_trips($curator_id);
		for ($i=0; $i < count($data); $i++) {
			$data[$i]["media"] =$class->get_campaign_image($data[$i]["campaign_id"]);
		}
		return $data;
	}

	function get_curator_reviews($curator_id){
		$class = new curator_interaction_class();
		return $class->get_curator_reviews($curator_id);
	}

	function get_curator_bookings($curator_id){
		$class = new curator_interaction_class();
		return $class->get_curator_bookings($curator_id);
	}

	function get_curator_campaigns($curator_id){
		$class = new curator_interaction_class();
		return $class->get_curator_campaigns($curator_id);
	}

	// Returns all the campaigns with how many bookings for their various tours
	function get_booking_summary_by_trip($curator_id){
		$class = new curator_interaction_class();
		$trips = $class->get_curator_campaigns($curator_id);
		$data = array();
		foreach($trips as $e){
			$id = $e["campaign_id"];
			$count = $class->count_campaign_bookings($id)["booking_count"];

			if ($count > 0 ){
				$data = array_merge($data,array(
					"campaign_id" => $id,
					"booking_count" => $count,
					"title" => $e["title"]
				));
			}
		}
		return $data;
	}


	function get_all_transactions($curator_id){
		$class = new curator_interaction_class();
		return $class->get_all_transactions_curator($curator_id);
	}


	function get_booking_transactions($curator_id){
		$class = new curator_interaction_class();
		return $class->get_booking_transactions_curator($curator_id);
	}


	function get_withdrawal_transactions($curator_id){
		$class = new curator_interaction_class();
		return $class->get_withdrawal_transactions($curator_id);
	}


	function get_custom_private_tour_requests(){
		$class = new curator_interaction_class();
		return $class->get_custom_private_tour_requests();
	}

	function get_accepted_tour_requests($curator_id){
		$class = new curator_interaction_class();
		return $class->get_accepted_tour_requests($curator_id);
	}

	function get_private_tour_requests_with_bids($curator_id){
		$class = new curator_interaction_class();
		return $class->get_private_tour_requests_with_bids($curator_id);
	}

	function get_destination_by_activity($activity){
		$class = new curator_interaction_class();
		return $class->get_destination_by_activity($activity);
	}


	function get_destination_by_location($location){
		$class = new curator_interaction_class();
		return $class->get_destination_by_location($location);
	}

	function get_destinations(){
		$class = new curator_interaction_class();
		return $class->get_destinations();
	}

	function get_destination_by_id($id){
		$class = new curator_interaction_class();
		$data =  $class->get_destination_by_id($id);
		//get activities
		$data["activities"] = $class->get_destination_activities($id);
		//get media
		$data["media"] = $class->get_destination_media($id);
		//get socials
		$data["socials"] = $class->get_destination_socials($id);
		return $data;
	}



	function get_destination_media($site_id){
		$class = new curator_interaction_class();
		return $class->get_destination_media($site_id);
	}

	function get_curator_collaborators($curator_id){
		$class = new curator_interaction_class();
		return $class->get_curator_collaborators($curator_id);
	}


	function get_campaign_image($campaign_id){
		$class = new curator_interaction_class();
		return $class->get_campaign_image($campaign_id);
	}

	// if(!function_exists('get_campaign_by_id')){
	// 	function get_campaign_by_id($c_id){
	// 		$class = new interaction_class();
	// 		return $class->get_campaign_by_id($c_id);
	// 	}
	// }

	function count_trip_booking($tour_id){
		$class = new curator_interaction_class();
		return $class->count_campaign_bookings($tour_id);
	}


	if(!function_exists('get_campaign_tours')){
		function get_campaign_tours($campaign_id){
			$class = new interaction_class();
			return $class->get_campaign_tours($campaign_id);
		}
	}

	function get_trip_bookings($tour_id){
		$class = new curator_interaction_class();
		return $class->get_trip_bookings($tour_id);
	}

	function get_curator_followers($curator_id = null){
		$class = new curator_interaction_class();
		return $class->get_curator_followers($curator_id);
	}
?>