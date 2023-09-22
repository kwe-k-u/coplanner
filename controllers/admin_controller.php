<?php
	require_once(__DIR__."/../classes/admin_class.php");
	require_once(__DIR__."/../classes/campaign_class.php");

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

	function get_transactions($transaction_id = null){
		$admin = new admin();
		return $admin->get_transactions($transaction_id);
	}

	function get_campaigns($curator_id = null){
		$admin = new admin();
		return $admin->get_campaigns($curator_id);
	}

	function get_user_accounts($user_id = null){
		$admin = new admin();
		return $admin->get_user_accounts($user_id);
	}

	function get_curators(){
		$admin = new admin();
		$data = $admin->get_curators();
		for ($i = 0; $i < sizeof($data); $i++) {
			$entry = $data[$i];
			$id = $entry["curator_id"];
			$data[$i]["collaborators"] = $admin->get_curator_managers($id);
		}
		return $data;
	}

	function get_curator($id){
		$admin = new admin();
		return $admin->get_curator($id);
	}

	function remove_destination_activity($id,$activity_name){
		$admin = new admin();
		return $admin->remove_destination_activity($id,$activity_name);
	}

	function get_emails_from_group($group){
		$admin = new admin();
		$result = array();
		$data = $admin->get_emails_from_group($group);
		foreach ($data as $entry) {
			array_push($result,$entry["email"]);
		}
		return $result;
	}


	function get_destination_info($location_id){
		$admin = new admin();
		$data = $admin->get_destination_info($location_id);
		$data["activities"] = $admin->get_destination_activities($location_id);
		$data["media"] = $admin->get_destination_media($location_id);
		$data["socials"] = $admin->get_destination_socials($location_id);
		return $data;
	}

	function get_location_activities($id){
		$admin = new admin();
		return $admin->get_destination_activities($id);
	}


	function toggle_location_verification($id){
		$admin = new admin();
		$verified = $admin->get_destination_info($id)["is_verified"] == "1";
		$new_status = $verified ? "0" : "1";
		//Toggle verification
		$admin->set_location_verification($id,$new_status);

		return array("new_verification" => $new_status,"destination_id"=>$id);
	}

	//TODO::
	function update_destination_info($name,$desc,$loc,$country,$phone,$contact_name,$cord,$id){
		$admin = new admin();
		if(str_contains($cord,",")){
			$split = explode(",",$cord);
			$lat = $split[0];
			$long = $split[1];
		}else{
			$lat = "";
			$long = "";
		}
		return $admin->update_destination_info($name,$desc,$loc,$country,$phone,$contact_name,$long,$lat,$id);
	}

	function add_destination($id,$name,$desc,$loc,$country, $phone,$contact,$cord){
		$admin = new admin();
		$cord_array = explode(",",$cord); //0-> longitude, 1->latitude
		return $admin->add_destination($id,$name,$desc,$loc,$country,$phone,$contact,$cord_array[0],$cord_array[1]);
	}

	function get_curator_by_name($name){
		$admin = new admin();
		return $admin->get_curator_by_name($name);
	}

	function add_curator($curator_id,$curator_name,$country){
		$admin = new admin();
		return $admin->add_curator($curator_id,$curator_name,$country);
	}

	function add_destination_activity($des_id,$activity,$fee = 0){
		$camp = new campaign_class();
		$act = $camp->get_activity_by_name($activity,true);
		if($act){//link activity if exists
			$activity_id = $act["activity_id"];
		}else { //create activity and then link if exists
			$camp->add_activity($activity);
			$act = $camp->get_activity_by_name($activity,true);
			$activity_id = $act['activity_id'];
		}
		$admin = new admin();
		return $admin->add_destination_activity($des_id,$activity_id,$fee);
	}

	function add_destination_socials($des_id,$type,$link){
		$admin = new admin();
		return $admin->add_destination_socials($des_id,$type,$link);
	}

	function add_destination_media($des_id,$media_id,$is_foriegn){
		$admin = new admin();
		return $admin->add_destination_media($des_id,$media_id,$is_foriegn);
	}

	function add_media($media_id, $location, $type){
		$admin = new admin();
		return $admin->add_media($media_id, $location, $type);
	}


	function get_unverified_curators(){
		$admin = new admin();
		return $admin->get_unverified_curators();
	}

	function get_id_pending_curators(){
		$admin = new admin();
		return $admin->get_id_pending_curators();
	}


	function verify_curator_manager_id($user_id,$action){
		$admin = new admin();
		return $admin->verify_curator_manager_id($user_id,$action ? "1" : "0");
	}


	function verify_curator_account($curator_id,$action){
		$admin = new admin();
		return $admin->verify_curator_account($curator_id,$action ? "1" : "0");
	}


	function get_media($media_id = null){
		$admin = new admin();
		return $admin->get_media($media_id);
	}

	function get_admin_stats(){
		$admin = new admin();
		return $admin->get_admin_stats();
	}

	function get_media_by_category($category){
		$admin = new admin();
		return $admin->get_media_by_category($category);
	}

	function update_media_location($id,$location){
		$admin = new admin();
		return $admin->update_media_location($id,$location);
	}



?>