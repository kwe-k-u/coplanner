<?php
	require_once(__DIR__."/../classes/admin_class.php");

	function get_upcoming_tours(){
		$admin = new admin();
		$data = $admin->get_upcoming_tours();
		for ($i=0; $i < count($data); $i++) {
			$data[$i]["media"] =$admin->get_campaign_image($data[$i]["campaign_id"]);
		}

		return $data;
	}

	function get_bookings(){
		$admin = new admin();
		return $admin->get_bookings();
	}

	function get_user_accounts(){
		$admin = new admin();
		return $admin->get_user_accounts();
	}

	function get_curators(){
		$admin = new admin();
		return $admin->get_curators();
	}


	function get_location_info($location_id){
		$admin = new admin();
		$data = $admin->get_toursite_info($location_id);
		$data["activities"] = $admin->get_toursite_activities($location_id);
		$data["media"] = $admin->get_toursite_media($location_id);
		$data["socials"] = $admin->get_toursite_socials($location_id);
		return $data;
	}


	function toggle_location_verification($id){
		$admin = new admin();
		$verified = $admin->get_toursite_info($id)["is_verified"] == "1";
		$new_status = $verified ? "0" : "1";
		//Toggle verification
		$admin->set_location_verification($id,$new_status);

		return array("new_verification" => $new_status,"toursite_id"=>$id);
	}


?>