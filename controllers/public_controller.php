<?php
	require_once(__DIR__."/../classes/public_class.php");


	function signup_controller($auth_type, $first,$second = null,$third = null){
		$public = new public_class();
		switch($auth_type){
			case "email":
			return $public->email_signup($first,$second,$third);
			case "google":
				return $public->provider_signup("google",$first,$second);
			case "apple":
				return $public->provider_signup("apple",$first,$second);
			default:
				return false;
		}
	}

	function email_login($email,$password){
		$public = new public_class();
		return $public->email_login($email,$password);
	}

	function google_login($google_id){
		$public = new public_class();
		return $public->provider_login("google_id",$google_id);
	}

	function apple_login($apple_id){
		$public = new public_class();
		return $public->provider_login("apple_id",$apple_id);
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

	function get_destination_by_id($id){
		$public = new public_class();
		return $public->get_destination_by_id($id);
	}

	function get_user_itineraries($user_id){
		$public = new public_class();
		return $public->get_user_itineraries($user_id);
	}

	function get_destinations_by_name($name = null){
		$public = new public_class();
		return $public->get_destinations_by_name($name);
	}

	function get_user_info($user_id){
		$public = new public_class();
		return $public->get_user_info($user_id);
	}
?>