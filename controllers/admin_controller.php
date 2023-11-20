<?php
	require_once(__DIR__."/../classes/admin_class.php");
	require_once(__DIR__."/../utils/core.php");

	function create_destination($name,$location,$lat,$long,$rating){
		$admin = new admin_class();
		return $admin->create_destination($name,$location,$lat,$long,$rating);
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
?>