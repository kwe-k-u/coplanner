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


	function create_itinerary($user_id,$num_people,$status = 'public'){
		$public = new public_class();
		$ids = $public->create_itinerary($user_id,$num_people,$status);
		return $ids;
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
		$data = $public->get_destination_by_id($id);
		$data["activities"] = $public->get_destination_activities($id);

		$public = new public_class();
		$data["utilities"] = $public->get_destination_utilities($id);
		$public = new public_class();
		$data["destination_type"] = $public->get_destination_type($id);
		return $data;
	}

	function get_user_itineraries($user_id){
		$public = new public_class();
		return $public->get_user_itineraries($user_id);
	}

	function get_destinations_by_name($name = null){
		$public = new public_class();
		$destinations = $public->get_destinations_by_name($name);
		for ($i = 0; $i < sizeof($destinations); $i++) {
			$value = $destinations[$i];
			$destinations[$i]["activities"] = get_destination_activities($value["destination_id"]);
		}
		return $destinations;
	}

	function get_user_info($user_id){
		$public = new public_class();
		return $public->get_user_info($user_id);
	}

	function get_destinations(){
		$public = new public_class();
		return $public->get_destinations();
	}

	function get_destination_activities($destination_id){
		$public = new public_class();
		return $public->get_destination_activities($destination_id);
	}

	function get_destination_utilities($destination_id){
		$public = new public_class();
		return $public->get_destination_utilities($destination_id);
	}

	function get_itineraries($user_id = null){
		$public = new public_class();
		return $public->get_itineraries($user_id);
	}

	function get_itinerary_collaborators($itinerary_id){
		$public = new public_class();
		return $public->get_itinerary_collaborators($itinerary_id);
	}

	function get_itinerary_day_info($day_id){
		$public = new  public_class();
		$data = $public->get_itinerary_day_info($day_id);
		unset($public);
		$public = new  public_class();
		$data["destinations"] = $public->get_itinerary_day_destinations($day_id);
		// foreach ($data["destinations"] as $destination) {
			for( $i = 0 ; $i < sizeof($data["destinations"]); $i++){
				$destination = $data[$i];
				// var_dump($data[$i]);
				$des_id = $destination["destination_id"];
				unset($public);
				$public = new  public_class();
			$data["destinations"][$i]["activities"]=$public->get_day_destination_activities($des_id,$day_id);
		}
		// $data["activities"] = $public->get_itinerary_day_activities($day_id);
		return $data;
	}

	function get_itinerary_days($itinerary_id){
		$public = new public_class();
		return $public->get_itinerary_days($itinerary_id);
	}

	function update_itinerary_name($id,$name){
		$public = new public_class();
		return $public->update_itinerary_name($id,$name);
	}

	function get_itinerary_by_id($id){
		$public = new public_class();
		return $public->get_itinerary_by_id($id);
	}


	function add_itinerary_activity($day_id,$activity_id,$destination_id){
		$public = new public_class();
		return $public->add_itinerary_activity($day_id,$activity_id,$destination_id);
	}

	function get_featured_itineraries($category = ""){
		switch ($category) {
			case "budget":
			case "popular":
			case "family friendly":
			default:
				return get_itineraries("af5e8e3f5acda11ee94238ed206f829ea");
				break;
		}
	}

	function get_itinerary_activities($itinerary_id){
		$public = new public_class();
		return $public->get_itinerary_activities($itinerary_id);
	}


	function duplicate_itinerary($itinerary_id,$user_id){
		$public = new public_class();
		return $public->duplicate_itinerary($itinerary_id,$user_id);
	}

	function toggle_wishlist($user_id,$itinerary_id){
		$public = new public_class();
		return $public->toggle_wishlist($user_id,$itinerary_id)["added"];
	}

	function add_destination_request($query,$user_id){
		$public = new public_class();
		return $public->add_destination_request($query,$user_id);
	}

	function create_itinerary_invoice($itinerary_id){
		$public = new public_class();
		return $public->create_itinerary_invoice($itinerary_id);
	}




?>