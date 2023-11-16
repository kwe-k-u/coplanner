<?php
	require_once(__DIR__."/../classes/public_class.php");


	function signup_controller($auth_type, $first,$second = null,$third = null){
		$public = new public_class();
		switch($auth_type){
			case "email":
			return $public->email_signup($first,$second,$third);
			case "google":
				return $public->google_signup($first,$second);
			case "apple":
				return $public->apple_signup($first,$second);
			default:
				return false;
		}
	}

	function create_itinerary($user_id,$num_people,$status){
		$public = new public_class();
		$ids = $public->create_itinerary($user_id,$num_people,$status);
		return $public->add_itinerary_day(array_values($ids)[0]);
	}

	function add_itinerary_day($itinerary_id){
		$public = new public_class();
		return $public->add_itinerary_day($itinerary_id);
	}

	function add_itinerary_destination($day_id,$destination_id){
		$public = new public_class();
		return $public-> add_itinerary_destination($day_id,$destination_id);
	}
?>