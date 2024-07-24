<?php
require_once(__DIR__ . "/../classes/public_class.php");


function bypass_signup($name, $email, $phone) {
	$public = new public_class();
	return $public->bypass_signup($name, $email, $phone);
}

function signup_controller($auth_type, $first, $second = null, $third = null) {
	$public = new public_class();
	switch ($auth_type) {
		case "email":
			return $public->email_signup($first, $second, $third);
		case "google":
			return $public->provider_signup("google", $first, $second, $third);
		case "apple":
			return $public->provider_signup("apple", $first, $second, $third);
		default:
			return false;
	}
}

function email_login($email, $password) {
	$public = new public_class();
	return $public->email_login($email, $password);
}

function google_login($google_id) {
	$public = new public_class();
	return $public->provider_login("google_id", $google_id);
}

function apple_login($apple_id) {
	$public = new public_class();
	return $public->provider_login("apple_id", $apple_id);
}


function create_itinerary($user_id, $num_people, $status = 'public') {
	$public = new public_class();
	$ids = $public->create_itinerary($user_id, $num_people, $status);
	return $ids;
}

function add_itinerary_day($itinerary_id) {
	$public = new public_class();
	return $public->add_itinerary_day($itinerary_id);
}

function add_itinerary_destination($day_id, $destination_id) {
	$public = new public_class();
	return $public->add_itinerary_destination($day_id, $destination_id);
}


function get_destination_by_id($id) {
	$public = new public_class();
	$data = $public->get_destination_by_id($id);
	$data["activities"] = $public->get_destination_activities($id);

	$public = new public_class();
	$data["utilities"] = $public->get_destination_utilities($id);
	$public = new public_class();
	$data["destination_type"] = $public->get_destination_type($id);
	return $data;
}

function get_user_itineraries($user_id) {
	$public = new public_class();
	return $public->get_user_itineraries($user_id);
}

function get_destinations_by_name($name = null) {
	$public = new public_class();
	$destinations = $public->get_destinations_by_name($name);
	for ($i = 0; $i < sizeof($destinations); $i++) {
		$value = $destinations[$i];
		$destinations[$i]["activities"] = get_destination_activities($value["destination_id"]);
	}
	return $destinations;
}

function get_user_info($user_id) {
	$public = new public_class();
	return $public->get_user_info($user_id);
}

function get_destinations() {
	$public = new public_class();
	return $public->get_destinations();
}

function get_destination_activities($destination_id) {
	$public = new public_class();
	return $public->get_destination_activities($destination_id);
}

function get_destination_utilities($destination_id) {
	$public = new public_class();
	return $public->get_destination_utilities($destination_id);
}

function get_itineraries($user_id = null) {
	$public = new public_class();
	return $public->get_itineraries($user_id);
}

function get_itinerary_collaborators($itinerary_id) {
	$public = new public_class();
	return $public->get_itinerary_collaborators($itinerary_id);
}

function get_itinerary_day_info($day_id) {
	// $public = new  public_class();
	// $data = $public->get_itinerary_day_info($day_id);
	// unset($public);
	$data = array();
	$public = new  public_class();
	$data["destinations"] = $public->get_itinerary_day_destinations($day_id);
	// foreach ($data["destinations"] as $destination) {
	for ($i = 0; $i < sizeof($data["destinations"]); $i++) {
		$destination = $data["destinations"][$i];
		// var_dump($data[$i]);
		$des_id = $destination["destination_id"];
		unset($public);
		$public = new  public_class();
		$data["destinations"][$i]["activities"] = $public->get_day_destination_activities($des_id, $day_id);
	}
	// $data["activities"] = $public->get_itinerary_day_activities($day_id);
	return $data;
}

function get_itinerary_days($itinerary_id) {
	$public = new public_class();
	return $public->get_itinerary_days($itinerary_id);
}

function update_itinerary_name($id, $name) {
	$public = new public_class();
	return $public->update_itinerary_name($id, $name);
}

function get_itinerary_by_id($id) {
	$public = new public_class();
	return $public->get_itinerary_by_id($id);
}


function add_itinerary_activity($day_id, $activity_id, $destination_id) {
	$public = new public_class();
	return $public->add_itinerary_activity($day_id, $activity_id, $destination_id);
}

function get_travel_plan_collections() {
	$public = new public_class();
	return $public->get_travel_plan_collections();
}

function get_featured_itineraries($category = "") {
	$public = new public_class();
	return $public->get_travel_plan_collection($category);

	$result = array();
	switch ($category) {
		case "budget":
		case "popular":
		case "family friendly":
		default:
			// return get_itineraries("af5e8e3f5acda11ee94238ed206f829ea");
			$weights = get_itinerary_templates();
			foreach ($weights as $filename) {
				$itinerary = get_itinerary_by_id($filename);
				if ($itinerary) {
					$result[] = $itinerary;
				}
			}

			break;
	}
	return $result;
}

function get_itinerary_templates() {

	$result = array();
	$directory = __DIR__ . "/../uploads/template_weights";
	// Check if the directory exists and is a directory
	if (is_dir($directory)) {

		$dirHandle = opendir($directory);
		if ($dirHandle) { // if the path exists, read its files and parse only jsons
			while (($file = readdir($dirHandle))) {

				if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
					// Get the file name without the extension
					$fileNameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
					$result[] = $fileNameWithoutExt;
				}
			}
			closedir($dirHandle);
		} else {
			//return false if something wrong
			return false;
		}
	} else {
	}

	return $result;
}

function get_itinerary_activities($itinerary_id) {
	$public = new public_class();
	return $public->get_itinerary_activities($itinerary_id);
}


function duplicate_itinerary($itinerary_id, $user_id) {
	$public = new public_class();
	return $public->duplicate_itinerary($itinerary_id, $user_id);
}

function toggle_itinerary_wishlist($user_id, $itinerary_id) {
	$public = new public_class();
	return $public->toggle_itinerary_wishlist($user_id, $itinerary_id)["added"];
}

function add_destination_request($query, $user_id) {
	$public = new public_class();
	return $public->add_destination_request($query, $user_id);
}

function create_itinerary_invoice($itinerary_id, $people_count = 1) {
	$public = new public_class();
	return $public->create_itinerary_invoice($itinerary_id, $people_count);
}

function get_invoice($invoice_id) {
	$public = new public_class();
	return $public->get_invoice($invoice_id);
}


function make_invoice_payment($invoice_id, $provider_transaction_id, $user_id, $purpose, $transaction_amount, $amount, $tax, $charges, $provider = 'paystack') {
	$public = new public_class();
	return $public->make_invoice_payment($invoice_id, $provider_transaction_id, $user_id, $purpose, $transaction_amount, $amount, $tax, $charges, $provider);
}

function get_itinerary_invoices($itinerary_id) {
	$public = new public_class();
	return $public->get_itinerary_invoices($itinerary_id);
}

/**Depracating */
function get_invoice_by_id($invoice_id) {
	$public = new public_class();
	return $public->get_invoice_by_id($invoice_id);
}

function get_travel_plan_bill($itinerary_id, $seats = 1) {
	$public = new public_class();
	$data = $public->get_travel_plan_bill($itinerary_id);
	//Add tax
	$data["price"] = floatval($data["price"]) * intval($seats);
	$data["platform_fee"] = $data["price"] * 0.03;
	$data["total"] = $data["price"] + $data["platform_fee"];
	return $data;
}

function get_invoice_activities($invoice_id) {
	$public = new public_class();
	return $public->get_invoice_activities($invoice_id);
}

function make_experience_payment($experience_id, $package_id, $seats, $provider_transaction_id, $user_id, $description, $transaction_amount, $amount, $tax, $provider_charges, $provider = "paystack") {
	$public = new public_class();
	return $public->make_experience_payment($experience_id, $package_id, $seats, $provider_transaction_id, $user_id, $description, $transaction_amount, $amount, $tax, $provider_charges, $provider);
}

function set_itinerary_visibility($itinerary_id, $visibility) {
	$public = new public_class();
	return $public->set_itinerary_visibility($itinerary_id, $visibility);
}

function set_itinerary_day_date($day_id, $date) {
	$public = new public_class();
	return $public->set_itinerary_day_date($day_id, $date);
}

function create_curator($name, $email, $password, $number, $account_number, $curator_name, $bank_number, $bank_name, $account_name, $subaccount_id, $logo_location, $logo_type, $reg_doc_location, $reg_doc_type) {
	$public = new public_class();
	return $public->create_curator($name, $email, $password, $number, $account_number, $curator_name, $bank_number, $bank_name, $account_name, $subaccount_id, $logo_location, $logo_type, $reg_doc_location, $reg_doc_type);
}

function get_curator_account_by_user_id($user_id) {
	$public = new public_class();
	return $public->get_curator_account_by_user_id($user_id);
}

function get_curator_listings($curator_id) {
	$public = new public_class();
	return $public->get_curator_listings($curator_id);
}

function get_curator_bookings($curator_id) {
	$public = new public_class();
	return $public->get_curator_bookings($curator_id);
}

function get_curator_collaborators($curator_id) {
	$public = new public_class();
	return $public->get_curator_collaborators($curator_id);
}

function create_shared_experience($name, $description, $curator_id, $start_date, $currency, $fee, $seats, $media_location, $media_type) {
	$public = new public_class();
	return $public->create_shared_experience($name, $description, $curator_id, $start_date, $currency, $fee, $seats, $media_location, $media_type)["experience_id"];
}

function get_shared_experience_days($experience_id) {
	$public = new public_class();
	return $public->get_shared_experience_days($experience_id);
}

function get_shared_experiences($show_all = false) {
	$public = new public_class();
	return $public->get_shared_experiences($show_all);
}

function get_shared_experience_activities_by_day($experience_id, $day) {
	$public = new public_class();
	return $public->get_shared_experience_activities_by_day($experience_id, $day);
}

function add_experience_activity($experience_id, $activity_id, $destination_id, $visit_date) {
	$public = new public_class();
	return $public->add_experience_activity($experience_id, $activity_id, $destination_id, $visit_date);
}

function get_shared_experience_by_id($experience_id) {
	$public = new public_class();
	return $public->get_shared_experience_by_id($experience_id);
}

function get_shared_experience_activities($experience_id) {
	$public = new public_class();
	return $public->get_shared_experience_activities($experience_id);
}

function get_shared_experience_destinations($experience_id) {
	$public = new public_class();
	return $public->get_shared_experience_destinations($experience_id);
}

function toggle_experience_wishlist($user_id, $experience_id) {
	$public = new public_class();
	return $public->toggle_experience_wishlist($user_id, $experience_id)["added"];
}

function get_curator_payout_account($curator_id) {
	$public = new public_class();
	return $public->get_curator_payout_account($curator_id);
}

function curator_media_upload($curator_id, $media_location, $media_type, $is_foreign = 0) {
	$public = new public_class();
	return $public->curator_media_upload($curator_id, $media_location, $media_type, $is_foreign);
}

function upload_curator_identification($email, $front_location, $front_type, $back_location, $back_type) {
	$public = new public_class();
	return $public->upload_curator_identification($email, $front_location, $front_type, $back_location, $back_type);
}

function invite_curator_collaborator($curator_id, $email) {
	$public = new public_class();
	return $public->invite_curator_collaborator($curator_id, $email);
}

function create_curator_manager($token, $user_name, $email, $password, $phone) {
	$public = new public_class();
	return $public->create_curator_manager($token, $user_name, $email, $password, $phone);
}


function toggle_experience_visbility($experience_id, $status) {
	$public = new public_class();
	return $public->toggle_experience_visibility($experience_id, $status ? "1" : "0");
}

function get_experience_tags($experience_id = null) {
	$public = new public_class();
	return $public->get_experience_tags($experience_id);
}

function add_experience_tag($experience_id, $tag) {
	$public = new public_class();
	return $public->add_experience_tag($experience_id, $tag);
}

function add_experience_package($experience_id, $name, $description, $currency, $min_amount, $max_amount, $seats, $start, $end, $is_default) {
	$public = new public_class();
	return $public->add_experience_package($experience_id, $name, $description, $currency, $min_amount, $max_amount, $seats, $start, $end, $is_default);
}

function get_experience_packages($experience_id) {
	$public = new public_class();
	return $public->get_experience_packages($experience_id);
}

function get_experience_package_by_id($package_id) {
	$public = new public_class();
	return $public->get_experience_package_by_id($package_id);
}

function add_experience_media($experience_id, $media_location, $media_type) {
	$public = new public_class();
	return $public->add_experience_media($experience_id, $media_location, $media_type);
}

function get_experience_media($experience_id) {
	$public = new public_class();
	return $public->get_experience_media($experience_id);
}

function add_travel_plan_tag($experience_id, $tag) {
	$public = new public_class();
	return $public->add_travel_plan_tag($experience_id, $tag);
}

function add_travel_plan_media($experience_id, $media_location, $media_type) {
	$public = new public_class();
	return $public->add_travel_plan_media($experience_id, $media_location, $media_type);
}

function create_travel_plan($name, $description, $curator_id, $currency, $price, $min_size, $media_location, $media_type, $gen_location, $what_expect) {
	$public = new public_class();
	return $public->create_travel_plan($curator_id, $name, $description, $min_size, $currency, $price, $media_location, $media_type, $gen_location, $what_expect)["experience_id"];
}

function add_travel_plan_activity($plan_id, $destination_id, $activity_name, $day_index) {
	$public = new public_class();
	return $public->add_travel_plan_activity($plan_id, $destination_id, $activity_name, $day_index);
}

function get_travel_plan_days($plan_id) {
	$public = new public_class();
	return $public->get_travel_plan_days($plan_id);
}

function publish_travel_plan($plan_id) {
	$public = new public_class();
	return $public->publish_travel_plan($plan_id);
}

function get_travel_plan_by_id($plan_id) {
	$public = new public_class();
	return $public->get_travel_plan_by_id($plan_id);
}

function get_travel_plan_media($plan_id) {
	$public = new public_class();
	return $public->get_travel_plan_media($plan_id);
}

function get_travel_plan_activities($plan_id) {
	$public = new public_class();
	$retrieved = $public->get_travel_plan_activities($plan_id);
	// Group activities by day and destination
	$results = array();

	foreach ($retrieved as $plan) {
		$dayIndex = $plan["day_index"];
		$destinationName = $plan["destination_name"];

		if (!isset($results[$dayIndex])) {
			$results[$dayIndex] = array();
		}

		if (!isset($results[$dayIndex][$destinationName])) {
			$results[$dayIndex][$destinationName] = array();
		}

		$results[$dayIndex][$destinationName][] = $plan["activity_name"];
	}
	return $results;
}


function create_travel_plan_request($plan, $name, $email, $phone, $group, $notes, $date, $aiport, $accomodation) {
	$public = new public_class();
	return $public->create_travel_plan_request($plan, $name, $email, $phone, $group, $notes, $date, $aiport, $accomodation);
}

function get_curator_travel_plan_requests($curator_id) {
	$public = new public_class();
	return $public->get_curator_travel_plan_requests($curator_id);
}

function get_travel_plan_request_by_id($request_id) {
	$public = new public_class();
	return $public->get_travel_plan_request_by_id($request_id);
}

function reset_user_password($user_id, $current, $new) {
	$public = new public_class();
	return $public->reset_user_password($user_id, $current, $new)["status"];
}


function accept_travel_plan_request($request_id,$notes,$price){
	$public = new public_class();
	return $public->accept_travel_plan_request($request_id,$notes,$price);
}

function reject_travel_plan_request($request_id){
	$public = new public_class();
	return $public->reject_travel_plan_request($request_id);
}

function remove_experience_tags($experience_id,$tag_id=null){
	$public = new public_class();
	return $public->remove_experience_tags($experience_id,$tag_id);
}

function remove_experience_flyer($experience_id){
	$public = new public_class();
	return $public->remove_experience_flyer($experience_id);
}

function remove_experience_media($experience_id,$media_id){
	$public = new public_class();
	return $public->remove_experience_media($experience_id,$media_id);
}

function update_shared_experience_flyer($experience_id,$media_location,$media_type){
	$public = new public_class();
	return $public->update_shared_experience_flyer($experience_id,$media_location,$media_type);
}

function edit_shared_experience($experience_id,$name, $description,$start_date,$currency,$price,$seats){
	$public = new public_class();
	return $public->edit_shared_experience($experience_id,$name, $description,$start_date,$currency,$price,$seats);
}

function edit_shared_experience_package($experience_id,$package_name,$package_description,$currency,$min_fee,$max_fee,
$package_seats,$package_start_date,$package_end_date){
	$public = new public_class(0);
	return $public->edit_shared_experience_package($experience_id,$package_name,$package_description,$currency,$min_fee,$max_fee,
	$package_seats,$package_start_date,$package_end_date);
}
