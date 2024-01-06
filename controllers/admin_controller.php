<?php
	require_once(__DIR__."/../classes/admin_class.php");
	require_once(__DIR__."/../utils/core.php");

	function create_destination($name,$location,$lat,$long,$rating,$num_ratings = 1){
		$admin = new admin_class();
		return $admin->create_destination($name,$location,$lat,$long,$rating,$num_ratings);
	}

	// function create_itinerary($user_id,$num_people,$status){
	// 	$admin = new admin_class();
	// 	return $admin->create_itinerary($user_id,$num_people,$status);
	// }

	// function add_itinerary_destination($day_id,$destination_id){
	// 	$admin = new admin_class();
	// 	return $admin->add_itinerary_destination($day_id,$destination_id);
	// }

	// function add_itinerary_activity($day_id,$activity_id){
	// 	$admin = new admin_class();
	// 	return $admin->add_itinerary_activity($day_id,$activity_id);
	// }

	// function add_itinerary_day($itinerary_id){
	// 	$admin = new admin_class();
	// 	return $admin->add_itinerary_day($itinerary_id);
	// }

	function add_destination_activity($destination_id,$activity_name,$price = 0){
		$admin = new admin_class();
		return $admin->add_destination_activity($destination_id,$activity_name,$price);
	}

	function get_utility_types(){
		$admin = new admin_class();
		return $admin->get_utility_types();
	}

	function get_destination_types(){
		$admin = new admin_class();
		return $admin->get_destination_types();
	}

	function add_type_of_utility($name){
		$admin = new admin_class();
		return $admin->add_type_of_utility($name);
	}

	function add_type_of_destination($name){
		$admin = new admin_class();
		return $admin->add_type_of_destination($name);
	}

	function add_destination_type($destination_id,$type_id){
		$admin = new admin_class();
		return $admin->add_destination_type($destination_id,$type_id);
	}

	function add_destination_utility($destination_id, $utility_id){
		$admin = new admin_class();
		return $admin->add_destination_utility($destination_id, $utility_id);
	}

	function get_stats(){
		$admin = new admin_class();
		return $admin->get_stats();
	}

	function get_users(){
		$admin = new admin_class();
		return $admin->get_users();
	}

	function get_destination_requests(){
		$admin = new admin_class();
		return $admin->get_destination_requests();
	}

	function toggle_destination_request_status($request_id,$status){
		$admin = new admin_class();
		return $admin->toggle_destination_request_status($request_id,$status);
	}

	function get_destination_request_subscribers($request_id){
		$admin = new admin_class();
		return $admin->get_destination_request_subscribers($request_id);
	}

?>