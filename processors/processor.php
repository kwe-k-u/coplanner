<?php
// Show php errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

$allowedDomains = array(
    'https://www.ai.easygo.com.gh',
    'https://ai.easygo.com.gh',
    'https://easygo.com.gh',
    'https://www.easygo.com.gh'
);

if(isset($_SERVER['HTTP_ORIGIN'])){
	$requestOrigin = $_SERVER['HTTP_ORIGIN'];
}else{
	$requestOrigin = "";
}

if (in_array($requestOrigin, $allowedDomains)) {
    header("Access-Control-Allow-Origin: $requestOrigin");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");
}


	require_once(__DIR__."/../utils/mailer/mailer_class.php");
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/logger.php");
	require_once(__DIR__."/../utils/paystack.php");
	require_once(__DIR__."/../controllers/public_controller.php");
	require_once(__DIR__."/../controllers/admin_controller.php");
	require_once(__DIR__."/../controllers/slack_controller.php");
	$mixpanel = new mixpanel_class();


	switch ($_SERVER["PATH_INFO"]) {
		case '/register':
			$method = $_POST["method"];
			$name = $_POST["name"];
			switch($method){
				case "email":
					$email = $_POST["email"];
					$password = encrypt($_POST["password"]);
					$result = signup_controller($method,$name,$email,$password);
					if($result){
						$mailer = new mailer();
						$mailer->signup_email($email);
						notify_slack_signup($name,$email);

						send_json(array("msg"=> "Signup successful"));
					}else{
						send_json(array("msg"=> "Signup Failed! An account with that email may already exist"),201);
					}
					break;
				case "google":
				case "apple":
					send_json(array("msg"=> "Authentication method pending implementation"),201);
					break;
				default:
					send_json(array("msg"=> "Unknown authentication method"),401);
			}
			die();
		case "/signup_bypass":
			$name = $_POST["name"];
			$email = $_POST["email"];
			$phone = $_POST["phone"];
			//check if email exists
			$response = bypass_signup($name,$email,$phone)["user_id"];
			if($response == -1){
				send_json(array("msg"=> "You already have an account. You need to sign in using our login page"),201);
				die();
				// User has an account;
			}else{
				session_log_in($response);
			}
			send_json(array("msg"=> "Got you"));
			die();
		case "/login":
			$method = $_POST["method"];
			switch($method){
				case "email":
					$email = $_POST["email"];
					$password = encrypt($_POST["password"]);
					$success = email_login($email,$password);
					if($success){
						session_log_in($success["user_id"]);
						$mixpanel->log_user_login($success["user_id"], "email");
						send_json(array("msg"=> "Log in successful", "user_id"=> $success["user_id"]));
					}else{
						send_json(array("msg"=> "Log in Failed"),201);
					}
					break;
				case "google":
				case "apple":
					send_json(array("msg"=> "Authentication method pending implementation"),201);
					break;
				default:
					send_json(array("msg"=> "Unknown authentication method"),401);
			}
			break;
		case "/signout":
			session_log_out();
			send_json(array("msg"=> "Signed out"));
			break;
		case "/create_utility":
			$name = $_POST["utility_name"];
			$utility_id = add_type_of_utility($name);
			if($utility_id){
				send_json(array("msg"=> "Utility Added", "utility_id"=> $utility_id,"utility_name"=> $name));
			}else{
				send_json(array("msg"=> "Something went wrong"),201);
			}
			break;
			die();
		case "/create_type_of_destination":
			$name = $_POST["destination_type_name"];
			$type_id = add_type_of_destination($name);
			if($type_id){
				send_json(array("msg"=> "Type of destination created", "type_id"=> $type_id,"type_name"=>$name));
			}else{
				send_json(array('msg'=> "Something went wrong"),201);
			}
			die();
		case "/create_destination":
			if(isset($_POST["accommodation"])){
				$accomodation = json_decode($_POST["accommodation"],true);
			}else{
				$accomodation = array();
			}
			$name = $_POST["destination_name"];
			$location = $_POST["destination_location"];
			$description = $_POST["site_description"]; //TODO:: add to sql
			$country = $_POST["country"]; //TODO:: add to sql
			if(isset($_POST["activities"])){
				$activities = $_POST["activities"];
			}else{
				$activities = array();
			}
			if(isset($_POST["utilities"])){
				$utilities = json_decode($_POST["utilities"],true);
			}else{
				$utilities = array();
			}
			if(isset($_POST["destination_type"])){
				$destination_type = json_decode($_POST["destintion_type"],true);
			}else{
				$destination_type = array();
			}
			$latitude = explode(",",$_POST["cordinates"])[0];
			$longitude = explode(",",$_POST["cordinates"])[1];
			$rating = $_POST["rating"];
			$review_count = $_POST["num_ratings"];

			$destination_id = create_destination($name,$location,$latitude,$longitude,$rating,$review_count)["destination_id"];
			if(!$destination_id){
				send_json(array("msg"=> "Destination with same name exists! Creation failed"),201);
				die();
			}
			foreach ($activities as $key => $value) {
				$activity_name = explode(" GHS ",$value)[0];
				$activity_price = explode(" GHS ",$value)[1];
				$currency="GHS";
				try {
					add_destination_activity($destination_id,$activity_name,$activity_price,$currency);
				} catch (\Throwable $th) {
				}
			}

			foreach ($utilities as $id => $utility_name){
				add_destination_utility($destination_id,$id);
			}

			foreach ($destination_type as $id=>$type_name){
				add_destination_type($destination_id,$id);
			}

			foreach ($accomodation as $index=> $value) {
				$room_bed_type=$value["bed_type"];
				$room_occupancy=$value["occupancy"];
				$price_currency=explode(" ",$value["price"])[0];
				$room_price=explode(" ",$value["price"])[1];
				$room_name = $value["nickname"];

				add_accommodation($destination_id,$room_name,$room_bed_type,$room_occupancy,$price_currency,$room_price);
			}

			send_json(array("msg"=> "Added destination"));
			die();
		case "/get_destination_info":
			$id = $_GET["id"];
			$data = get_destination_by_id($id);
			send_json(array("msg"=> "Destination information retrieved","data"=> $data));
			die();
		case "/edit_destination":
			$activities = $_POST["activities"];
			$destination_id = $_POST["site_id"];
			//TODO:: Add method to remove activities that have been removed
			//Add destination activities
			foreach ($activities as $key => $value) {
				$activity_name = explode(" GHS ",$value)[0];
				$activity_price = explode(" GHS ",$value)[1];
				$currency="GHS";
				try {
					add_destination_activity($destination_id,$activity_name,$activity_price,$currency);
				} catch (\Throwable $th) {
				}
			}


			//TODO:: Add method to remove unavailable utilities
			//Add destination utilities
			$utilities = json_decode($_POST["utilities"],true);
			foreach ($utilities  as $key => $value) {
				try {
					add_destination_utility($destination_id,$value);
				} catch (\Throwable $th) {
				}
			}
			send_json(array("msg"=> "Updated"));
			die();
		case "/new_itinerary_request":
			$directory = "../uploads/user_itinerary_preference/"; // User creation
			$preferences = $_POST["preference"];
			$fileName = generate_id();
			$filePath = $directory . $fileName.".json";
			// Create the directory if it doesn't exist
			if (!file_exists($directory)) {
				mkdir($directory, 0777, true); // Change the permission mode as needed
			}

			// Create a unique file name (you can modify this logic as needed)

			// Save the JSON data to a file
			$fileSaved = file_put_contents($filePath, $preferences);
			notify_slack_ai_itinerary();
			$mixpanel->log_itinerary_recommendation($fileName);
			send_json(array("msg"=> "Preference saved", "id"=> $fileName));
			die();
		case "/create_template":
			if(!is_session_user_admin()){
				send_json(array("msg"=> "You need an admin account to perform this action"),201);
				die();
			}

			$collection = $_POST["collection"];
			$price = $_POST["price"];
			$currency = "GHS";
			$itinerary_id = $_POST["itinerary_id"];

			$logo_image = $_FILES["image"]["name"];
			$logo_temp = $_FILES["image"]["tmp_name"];
			$logo_type = get_file_type($logo_image);
			$logo_location = upload_file("uploads","images",$logo_temp,$logo_image);
			create_travel_plan_recommendation($itinerary_id,$collection,$price,$currency,$logo_location,$logo_type);


			$preferences = json_decode($_POST["preferences"],true);
			// create_itinerary_template();

			$directory = "../uploads/template_weights/"; // User creation
			$fileName = $itinerary_id;
			$filePath = $directory . $fileName.".json";
			// Create the directory if it doesn't exist
			if (!file_exists($directory)) {
				mkdir($directory, 0777, true); // Change the permission mode as needed
			}


			// Save the JSON data to a file
			$fileSaved = file_put_contents($filePath, json_encode($preferences));
			if($fileSaved){
				notify_slack_template_creation();
				send_json(array("msg"=> "Success","bytes"=> $fileSaved));
			}else{
				send_json(array("msg"=> "Something went wrong"),201);
			}

			die();
		case "/get_day_info":
			$day_id = $_GET["day_id"];
			// get_itinerary
			$day = get_itinerary_day_info($day_id);
			if($day){
				send_json(array("msg"=> "Success","result"=>$day));
			}else{
				send_json(array("msg"=> "Day not found",),201);
			}
			die();
		case "/search_destination":
			$query = $_GET["query"];
			$destinations = get_destinations_by_name($query);
			if(sizeof($destinations)== 0){
				$user_id = get_session_user_id();
				add_destination_request($query,$user_id);
				notify_slack_zero_search_results($query);
			}
			send_json(array("msg"=> "Success","results"=> $destinations));
			die();
		case "/create_itinerary":
			$user_id = get_session_user_id();
			if($user_id){
				$id = create_itinerary($user_id,1);
				send_json(array("msg"=> "Success","itinerary_id" => $id["itinerary_id"]));
			}else{
				send_json(array(
					"msg"=> "You must be signed in to continue",
					"reason" => "unauthenticated"
				),201);
			}
			die();
		case "/update_itinerary_name":
			$itinerary_id = $_POST["itinerary_id"];
			$name = $_POST["new_name"];
			update_itinerary_name($itinerary_id,$name);
			send_json(array("msg"=> "Success"));
			die();
		case "/add_itinerary_activity":
			$day_id = $_POST["day_id"];
			$destination_id = $_POST["destination_id"];
			$activity_id = $_POST["activity_id"];
			$success = add_itinerary_activity($day_id,$activity_id,$destination_id);
			send_json(array("msg"=>"Success","destination_id" => $success));
			die();
		case "/add_itinerary_day":
			$itinerary_id = $_POST["itinerary_id"];
			$day = add_itinerary_day($itinerary_id);
			send_json(array("msg"=> "Day created for itinerary","day_id"=> $day["day_id"]));
			die();
		case "/get_itinerary":
			$itinerary_id = $_GET["itinerary_id"];
			$data = get_itinerary_by_id($itinerary_id);
			send_json(array("msg"=> "Success","data"=> $data));
			die();

		case "/toggle_itinerary_wishlist":
			$itinerary_id = $_POST["itinerary_id"];
			$user_id = get_session_user_id();
			if($user_id){
				$result = toggle_itinerary_wishlist($user_id,$itinerary_id);
				if($result == 0 || $result == 1){
					send_json(array("added"=>$result));
					die();
				}else{
					//If no response, then something went wrong
					send_json(array("msg"=> "Something went wrong. Try again later"),201);
					die();
				}
			}else{
				send_json(array(
					"msg"=> "You need to be signed in to save an itinerary for later",
					"reason"=> "unauthenticated"
			),201);
				die();
			}
			die();
		case "/toggle_experience_visibility":
			$experience_id = $_POST["experience_id"];

			$success = toggle_experience_visbility($experience_id,true);
			if($success){
				send_json(array("msg"=> "Your tour has been published!"));
			}else{
				send_json(array("msg"=> "We couldn't publish your tour. Kindly try again or reach out to our team"),201);
			}
			die();
		case "/toggle_experience_wishlist":
			$experience_id = $_POST["experience_id"];
			$user_id = get_session_user_id();
			if($user_id){
				$result = toggle_experience_wishlist($user_id,$experience_id);
				if($result == 0 || $result == 1){
					send_json(array("added"=>$result));
					die();
				}else{
					//If no response, then something went wrong
					send_json(array("msg"=> "Something went wrong. Try again later"),201);
					die();
				}
			}else{
				send_json(array(
					"msg"=> "You need to be signed in to save an itinerary for later",
					"reason"=> "unauthenticated"
			),201);
				die();
			}
			die();
		case "/duplicate_itinerary":
			$itinerary_id = $_POST["itinerary_id"];
			$user_id = get_session_user_id();
			if($user_id){
				$data = duplicate_itinerary($itinerary_id,$user_id);
				notify_slack_itinerary_duplicate($itinerary_id);
				send_json($data);
			}else{
				send_json(array(
					"msg"=> "You need to sign in to create an itinerary",
					"reason"=> "unauthenticated"
				),201);
			}
			die();
		case "/toggle_destination_request_status":

			if(!is_session_user_admin()){
				send_json(array("msg"=> "You need an admin account to perform this action"),201);
				die();
			}
			$request_id = $_POST["request_id"];
			$status = $_POST["status"];
			toggle_destination_request_status($request_id,$status);
			if($status == "accepted"){
				$users = get_destination_request_subscribers($request_id);
				foreach ($users as $entry) {
					$mailer = new mailer();
					$user_email = $entry["email"];
					$destination_name = $entry["destination_name"];
					$mailer->destination_added_email($user_email,$destination_name);
				}
				$count = sizeof($users);
				send_json(array("msg"=> "Request Approved. Notifying $count users"));
			}else{
				send_json(array("msg"=>"request rejected"));
			}
			die();
		case "/create_itinerary_invoice":
			$itinerary_id = $_POST["itinerary_id"];
			// TODO:: notify destinations associated with the booking
			// fail if payment for the itinerary has been made
			notify_slack_itinerary_invoice_generation($itinerary_id);
			//TODO:: work on number of people count
			$invoice_id = array_values(create_itinerary_invoice($itinerary_id,1))[0];
			send_json(array("msg"=> "Itinerary invoice generated","invoice_id"=> $invoice_id));
			die();
		case "/get_itinerary_invoice":
			$invoice_id = $_POST["invoice_id"];
			// create_itinerary_invoice($itinerary_id);
			$data = get_invoice_by_id($invoice_id);
			send_json(array("invoice"=>$data));
			die();
		case "/get_travel_plan_bill":
			$seats = $_POST["seats"];
			$itinerary_id = $_POST["itinerary_id"];
			$data = get_travel_plan_bill($itinerary_id, $seats);

			send_json(array("invoice"=> $data));
			die();
		case "/get_experience_invoice":
			$experience_id = $_POST["experience_id"];
			$seats = $_POST["seats"] ?? 1;
			$invoice = get_shared_experience_by_id($experience_id);
			$curator_id = $invoice["curator_id"];
			$payout_account = get_curator_payout_account($curator_id);
			$invoice["booking_fee"] = $invoice["booking_fee"] * $seats;
			$invoice["platform_fee"] = $invoice["booking_fee"] * 0.03;
			$invoice["total_fee"] = $invoice["booking_fee"] + $invoice["platform_fee"];
			$invoice["seats_booked"] = $seats;

			if(is_session_logged_in()){
				$user_id = get_session_user_id();
				$email = get_user_info($user_id)["email"];
				$invoice["user_id"] = $user_id;
			}

			if ($payout_account){
				$invoice["payout_account_number"] = $payout_account["account_id"];
				send_json(
					array(
						"payout_account_number"=> $payout_account["account_id"],
						"invoice" => $invoice
						)
				);
			}else{
				send_json(array("invoice"=> $invoice));
			}
			die();
		case "/paystack_callback":
			$_POST = json_decode(file_get_contents("php://input"),true);
			die();
		case "/request_password_reset":
			send_json(array("msg"=> "Kindly send an email to main.easygo@gmail.com for help regaining your account!"),201);
			die();
		case "/get_itinerary_invoices":
			$itinerary_id = $_POST["itinerary_id"];
			$data = get_itinerary_invoices($itinerary_id);
			send_json(array("invoices"=>$data));
			die();
		case "/set_itinerary_visibility":
			$itinerary_id = $_POST["itinerary_id"];
			$status = $_POST["status"];
			set_itinerary_visibility($itinerary_id,$status);
			send_json(array("msg"=> "Changed Itinerary visibility to $status"));

			die();
		case "/set_itinerary_day_date":
			$day_id = $_POST["day_id"];
			$date = $_POST["date"];
			set_itinerary_day_date($day_id, $date);
			send_json(array("msg"=> "Updated visit date"));
			die();
		case "/make_user_admin":
			if(!is_session_user_admin()){
				send_json(array("msg"=> "You need an admin account to perform this action"),201);
				die();
			}
			$user_id = $_POST["user_id"];
			$result = make_user_admin($user_id);
			if($result){
				$email = get_user_info($user_id)["email"];
				$mailer = new mailer();
				$mailer->admin_invite_email($email);
				send_json(array("msg"=> "$email is now an admin "));
			}else{
				send_json(array("msg"=> "Something went wrong"),201);
			}
			die();
		case "/personality_test":
			$preferences = json_decode($_POST["preference"],true);
			$personality_points = array("adventure" => 0, "party"=> 0,"softlife"=>0,"culture"=>0);

			$pairs = array(
				"adventure" => ["skydiving","camp","challenge","action","experience","yes","adventure"],
				"softlife" => ["pool","airbnb","leisure","slow","comfort","no","wellness"],
				"party" => ["bars","party","social","trendy","yes","entertainment"],
				"culture" =>["musuem","culture","history","yes","historical"]
			);

			foreach ($preferences as $question => $answer){
				foreach (array("adventure","softlife","party","culture") as $value) {
					if (array_search($answer,$pairs[$value])){
						$personality_points[$value] += 1;
					}
				}
			}

			$result = array("adventure" => 0);
			foreach ($personality_points as $key => $value) {
				if($value > array_values($result)[0]){
					$result = array($key=>$value);
				}
			}


			send_json(array("personality_type"=> array_key_first($result)));

			$directory = "../uploads/personality_quiz/"; // User creation
			$fileName = generate_id();
			$filePath = $directory . $fileName.".json";
			// Create the directory if it doesn't exist
			if (!file_exists($directory)) {
				mkdir($directory, 0777, true);
			}


			// Save the JSON data to a file
			$fileSaved = file_put_contents($filePath, json_encode($preferences));
			notify_slack_personality_quiz(array_key_first($result));
			die();
		case "/curator_signup":

			$username = $_POST["user_name"];
			$email = $_POST["email"];
			$password = encrypt($_POST["password"]);
			$phone_number = $_POST["phone_number"];
			$account_number = $_POST["account_number"];
			$curator_name = $_POST["curator_name"];
			$bank_number = $_POST["payout_bank_number"];
			$bank_name = $_POST["payout_bank_name"];
			$account_name = $_POST["account_name"];

			$paystack = new paystack_custom();
				// $subaccount_response = $paystack->add_sub_account($curator_name,$bank_number,$account_number,7,"Curator bank account for $curator_name",$email,$username,$phone_number);
				$logger = new Logger();
				$logger->write_log("payment_details.txt","$curator_name $bank_number $account_number $email");

			// $subaccount_response = array(["status"] => true,array("data"=> array("subaccount_code"=>generate_id())));

			if(true){
			// if($subaccount_response["status"]){
				// upload logo
				$logo_image = $_FILES["company_logo"]["name"];
				$logo_temp = $_FILES["company_logo"]["tmp_name"];
				$logo_type = get_file_type($logo_image);
				$logo_location = upload_file("uploads","images",$logo_temp,$logo_image);
				//upload registration document
				$reg_doc_image = $_FILES["inc_doc"]["name"];
				$reg_doc_temp = $_FILES["inc_doc"]["tmp_name"];
				$reg_doc_type = get_file_type($reg_doc_image);
				$reg_doc_location = upload_file("uploads","confidential",$logo_temp,$logo_image);
				$result = create_curator($username,$email,$password,$phone_number,$account_number,$curator_name,$bank_number,$bank_name,$account_name,substr($username,5),$logo_location,$logo_type,$reg_doc_location,$reg_doc_type);
				// $result = create_curator($username,$email,$password,$phone_number,$account_number,$curator_name,$bank_number,$bank_name,$account_name,$subaccount_response["data"]["subaccount_code"],$logo_location,$logo_type,$reg_doc_location,$reg_doc_type);
				if($result){


					//upload id cards
					$front_id_image = $_FILES["gov_id_front"]["name"];
					$back_id_image = $_FILES["gov_id_back"]["name"];

					$front_id_temp = $_FILES["gov_id_front"]["tmp_name"];
					$back_id_temp = $_FILES["gov_id_back"]["tmp_name"];

					$front_location = upload_file("uploads","confidential",$front_id_temp,$front_id_image);
					$back_location = upload_file("uploads","confidential",$back_id_temp,$back_id_image);

					$front_type = get_file_type($front_id_image);
					$back_type = get_file_type($back_id_image);

					 upload_curator_identification($email,$front_location,$front_type,$back_location,$back_type);





					//create entry to record creation permission
					//notify slack
					notify_slack_curator_signup($curator_name,$email);
					$mailer = new mailer();
					 $mailer->curator_signup($email,$curator_name);

					$mixpanel->log_curator_signup();
					send_json(array("msg"=> "Your account has been created"));
					//Upload and save media
				}else{
					notify_slack_curator_signup_failure($email,$username);
					send_json(array("msg"=> "We couldn't create your account. Kinldy reach out to support@easygo.com.gh"),201);
				}
			}else{
				send_json(array("msg"=> "Your payment information is linked to another account. Contact support at support@easygo.com.gh"),201);
			}






			// if($result){
			// 	$result = signup_controller($curator_name,$username,$email,$password);
			// 	if($result){
			// 		send_json(array("msg"=> "Account created"));
			// 	}else{
			// 		send_json(array("msg"=> "Something went wrong"),201);
			// 	}
			// }else{
			// 	send_json(array("msg"=>"Sign up failed. Try again or reach out to support"),201);
			// }

			die();
		case "/invite_collaborator":
			$email = $_POST["email"];
			$curator_id = get_curator_account_by_user_id(get_session_user_id());
			if(!$curator_id || !$curator_id["curator_id"]){
				send_json(array("msg"=> "A curator account can't be found with your account. Contact support@easygo.com.gh"),201);
				die();
			}
			$curator_name = $curator_id["curator_name"];
			$curator_id = $curator_id["curator_id"];

			$result = invite_curator_collaborator($curator_id,$email);
			if($result){
				$result = $result["invite_id"];
				if($result == "1"){
					send_json(array("msg"=>"$email is a manager of your curator account. Contact support@easygo.com.gh if this is a mistake"),201);
				}else if ($result == "2"){
					send_json(array("msg"=>"$email is a manager of another account. Contact support@easygo.com.gh if this is a mistake!"),201);
				}
				else if ($result == "3"){
					send_json(array("msg"=>"$email has an invite to a different curaor account. Contact support@easygo.com.gh if this is a mistake"),201);
				}else{
					$mailer = new mailer();
					$mailer->curator_collaborator_invite($email,$result,$curator_name);
					send_json(array("msg"=> "An invite email has been sent to $email"));
				}
			}else{
				send_json(array("msg"=> "Something went wrong. Try again or contact your easyGo representative"),201);
			}


			die();
		case "/curator_invite_signup":
			$token = $_POST["invite_token"];
			$email = $_POST["email"];
			$user_name = $_POST["user_name"];
			$phone = $_POST["phone_number"];
			$password = encrypt($_POST["password"]);


			$result = create_curator_manager($token,$user_name,$email,$password,$phone);
			if ($result){
				$user_id = $result["user_id"];

				if($user_id == "1"){
					// send_json(array('msg'=> "Your invite token is broken. Request new one to be sent or contact support@easygo.com.gh"),201);
				}else if ($user_id == "2"){
					send_json(array('msg'=> "The Email used does not match the invited email. Contact support@easygo.com.gh if this is a mistake"),201);

				}else{
					//upload id cards
					$front_id_image = $_FILES["gov_id_front"]["name"];
					$back_id_image = $_FILES["gov_id_back"]["name"];

					$front_id_temp = $_FILES["gov_id_front"]["tmp_name"];
					$back_id_temp = $_FILES["gov_id_back"]["tmp_name"];

					$front_location = upload_file("uploads","confidential",$front_id_temp,$front_id_image);
					$back_location = upload_file("uploads","confidential",$back_id_temp,$back_id_image);

					$front_type = get_file_type($front_id_image);
					$back_type = get_file_type($back_id_image);

					upload_curator_identification($email,$front_location,$front_type,$back_location,$back_type);
					$mailer = new mailer();
					$mailer->curator_collaborator_signup($email);
					send_json(array("msg"=> "Sign up successful. You can now login"));
				}

			}else{
				send_json(array("msg"=> "Something went wrong"),201);
			}

			die();
		case "/create_shared_experience":

			if (!is_session_user_curator()){
				send_json(array("msg"=> "You need to be a curator to create shared experiences. Contact support at support@easygo.com.gh"),201);
				die();
			}
			// $itinerary_id = $_POST["itinerary_id"];
			$price = $_POST["price"];
			$seats = $_POST["seat_count"];
			$name = $_POST["experience_name"];
			$description = $_POST["description"];
			$curator = get_curator_account_by_user_id(get_session_user_id());
			$curator_id = $curator["curator_id"];
			$start_date = $_POST["start_date"];
			$curator_name = $curator["curator_name"];
			$tags = $_POST["experience_tags"];
			$media_location = null;
			$media_type= null;

			if ($_FILES){

				$flyer_image = $_FILES["flyer"]["name"];
				$flyer_tmp = $_FILES["flyer"]["tmp_name"];
				$media_type = get_file_type($flyer_image);
				$media_location = upload_file("uploads","images",$flyer_tmp,$flyer_image);
			}


			$experience_id = create_shared_experience($name, $description, $curator_id,$start_date,1,$price,$seats,$media_location,$media_type);

			foreach($tags as $tag){
				add_experience_tag($experience_id,$tag);
			}

			$mixpanel->log_shared_experience_creation($curator_id,$experience_id);

			notify_slack_shared_experience_creation($curator_name,$experience_id);

			send_json(array("msg"=> "Experience Created", "experience_id" => $experience_id));
			die();
		case "/login_as_user":
			$user_id = $_POST["user_id"];
			session_log_in($user_id);
			send_json(array("msg"=> "success"));
			die();
		case "/get_shared_experience_activities":
			$experience_id = $_POST["experience_id"];
			// $activities = get_shared_experience_activities($experience_id);
			$days = get_shared_experience_days($experience_id);
			for($index = 0 ; $index < count($days); $index++){
				$day = $days[$index];
				$days[$index]["activities"] = get_shared_experience_activities_by_day($experience_id,$day['visit_date']);
			}
			send_json(array("days"=> $days));
			die();
		case "/get_shared_experience_activities_by_day":
			$experience_id = $_POST["experience_id"];
			$day = $_POST["day"];
			$activities = get_shared_experience_activities_by_day($experience_id,$day);
			$destinations = array();
			foreach ($activities as $entry) {
				$destination_id = $entry["destination_id"];
				if (!array_search($destination_id,array_keys($destinations))){
					$destination = get_destination_by_id($destination_id);
					array_push($destinations,$destination);
				}
			}
			send_json(array(
				"activities"=> $activities,
				"destinations" => $destinations
				)
			);
			die();
		case "/notify_no_destination":
			$curator_name = $_POST["curator_name"];
			$success = notify_slack_support_msg("$curator_name has requested to add a destination");
			if($success){
				send_json(array("msg"=> "Our team has been notified. Someone will contact you shortly"));
			}else{
				send_json(array("msg"=> "Something must have gone wrong."),201);
			}
			die();
		case "/add_experience_activities":
			$day = $_POST["day"];
			$destination_id = $_POST["destination_id"];
			$activities = $_POST["activities"];
			$experience_id = $_POST["experience_id"];
			foreach ($activities as $activity_id) {
				add_experience_activity($experience_id,$activity_id,$destination_id,$day);
			}
			send_json(array("msg"=> "received"));
			die();
		case "/contact_support":

			$email = $_POST["email"];
			$name = $_POST["name"];
			$message = $_POST["message"];

			notify_slack_support_msg("$name<$email> left a messagin saying ->> $message");
			die();
		case "/test":
			// $mailer = new mailer();
			// $mailer->curator_signup($_GET["email"],$_GET["name"]);
			die();
		case "/get_affiliate_url":
			$name = $_POST['name'];
			$contact = $_POST["contact"];
			$experience = $_POST["experience"];
			$payment_details = $_POST["payment_details"];

			$experience_id = "a689166db222611efaab78ed206f829ea";


			notify_slack_support_msg("Affiliate Sign up: name:$name; contact: $contact; Experience:$experience. Payment details: $payment_details");

			$data = array(
				"snapchat_link" => server_base_url()."coplanner/experience_info.php?id=$experience_id=&campaign=affiliates&channel=snapchat&referred_by=$name",
				"instagram_link" => server_base_url()."coplanner/experience_info.php?id=$experience_id=&campaign=affiliates&channel=instagram&referred_by=$name",
				"twitter_link" => server_base_url()."coplanner/experience_info.php?id=$experience_id=&campaign=affiliates&channel=twitter&referred_by=$name",
				"whatsapp_link" => server_base_url()."coplanner/experience_info.php?id=$experience_id=&campaign=affiliates&channel=whatsapp&referred_by=$name"
			);
			send_json($data);
			die();
		default:
			send_json(array("msg"=> "Method not implemented"));
			break;
	}
	die();
?>