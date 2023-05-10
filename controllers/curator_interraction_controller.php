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


	function get_private_tour_requests(){
		$class = new curator_interaction_class();
		return $class->get_private_tour_requests();
	}

	function get_accepted_tour_requests($curator_id){
		$class = new curator_interaction_class();
		return $class->get_accepted_tour_requests($curator_id);
	}

	function get_private_tour_requests_with_bids($curator_id){
		$class = new curator_interaction_class();
		return $class->get_private_tour_requests_with_bids($curator_id);
	}

	function get_toursite_by_activity($activity){
		$class = new curator_interaction_class();
		return $class->get_toursite_by_activity($activity);
	}


	function get_toursite_by_location($location){
		$class = new curator_interaction_class();
		return $class->get_toursite_by_location($location);
	}

	function get_toursites(){
		$class = new curator_interaction_class();
		return $class->get_toursites();
	}

	function get_toursite_by_id($id){
		$class = new curator_interaction_class();
		$data =  $class->get_toursite_by_id($id);
		//get activities
		$data["activities"] = $class->get_toursite_activities($id);
		//get media
		$data["media"] = $class->get_toursite_media($id);
		return $data;
	}


	function get_toursite_media($site_id){
		$class = new curator_interaction_class();
		return $class->get_toursite_media($site_id);
	}

	function get_curator_collaborators($curator_id){
		$class = new curator_interaction_class();
		return $class->get_curator_collaborators($curator_id);
	}


	function get_campaign_image($campaign_id){
		$class = new curator_interaction_class();
		return $class->get_campaign_image($campaign_id);
	}

	function get_campaign_by_id($c_id){
		$class = new interaction_class();
		return $class->get_campaign_by_id($c_id);
	}

	function count_trip_booking($trip_id){
		$class = new curator_interaction_class();
		return $class->count_campaign_bookings($trip_id);
	}


	function get_campaign_trips($campaign_id){
		$class = new interaction_class();
		return $class->get_campaign_trips($campaign_id);
	}

	function get_trip_bookings($trip_id){
		$class = new curator_interaction_class();
		return $class->get_trip_bookings($trip_id);
	}
?>