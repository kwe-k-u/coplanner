<?php
	// Show php errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

$allowedDomains = array(
    'https://www.prototype.easygo.com.gh',
    'https://prototype.easygo.com.gh',
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
	require_once(__DIR__."/../controllers/public_controller.php");
	require_once(__DIR__."/../controllers/admin_controller.php");
	require_once(__DIR__."/../controllers/slack_controller.php");


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
		case "/login":
			$method = $_POST["method"];
			switch($method){
				case "email":
					$email = $_POST["email"];
					$password = encrypt($_POST["password"]);
					$success = email_login($email,$password);
					if($success){
						session_log_in($success["user_id"]);
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
			$name = $_POST["destination_name"];
			$location = $_POST["destination_location"];
			$description = $_POST["site_description"]; //TODO:: add to sql
			$country = $_POST["country"]; //TODO:: add to sql
			$activities = $_POST["activities"];
			$utilities = json_decode($_POST["utilities"],true);
			$destination_type = json_decode($_POST["destintion_type"],true);
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
				try {
					add_destination_activity($destination_id,$activity_name,$activity_price);
				} catch (\Throwable $th) {
				}
			}

			foreach ($utilities as $id => $utility_name){
				add_destination_utility($destination_id,$id);
			}

			foreach ($destination_type as $id=>$type_name){
				add_destination_type($destination_id,$id);
			}

			send_json(array("msg"=> "Added destination"));
			die();
		case "/google_maps_upload":
			// $type_association = array(
			// 	"amusement_park"=> "Amusement Park",
			// 	"aquarium"=> "Aquarium",
			// 	"art_gallery"=> "Art Gallery",
			// 	"bowling_alley"=> "Bowling Alley",
			// 	"cafe"=> "Cafe",
			// 	"campground"=> "Campground",
			// 	"library"=> "Library",
			// 	"lodging"=> "Accommodation",
			// 	"movie_theater"=> "Movie Theater",
			// 	"musem"=> "Museum",
			// 	"night_club"=> "Night Club",
			// 	"park"=> "Park",
			// 	"casino"=> "Casino",
			// 	"stadium"=> "Stadium",
			// 	"shopping_mall"=> "Shopping Mall",
			// 	"restaurant"=> "Restaurant",
			// 	"zoo"=> "Zoo",
			// 	"tourist_attraction"=> "Tourist Attraction"

			// );
			// $data = json_decode(file_get_contents('php://input'),true)["data"];
			// foreach($data as $_ => $json){
			// 	// $json = json_decode($value,true);
			// 	$name = ucfirst(strtolower($json["name"]));
			// 	$rating = $json["rating"];
			// 	$num_rating = $json["user_ratings_total"];
			// 	$location = $json["vicinity"];
			// 	$latitude = $json["location"]["lat"];
			// 	$longitude = $json["location"]["lng"];
			// 	$types = $json["types"];

			// 	if($num_rating > 100){
			// 		$destination_id = create_destination($name,$location,$latitude,$longitude,$rating,$num_rating)["destination_id"];
			// 		if(!$destination_id){
			// 			// echo("Destination with same name<$name> exists! Additions skipped");
			// 			continue;
			// 		}

			// 		foreach ($types as $key){
			// 			if(key_exists($key,$type_association)){
			// 				add_destination_utility($destination_id,$type_association[$key]);
			// 			}
			// 		}
			// 		// echo"$name added\n";
			// 	}

			// }
			// send_json(array("msg"=> "Received"));
			send_json(array("msg"=> "Endpoint closed"),201);
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
				try {
					add_destination_activity($destination_id,$activity_name,$activity_price);
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
			send_json(array("msg"=> "Preference saved", "id"=> $fileName));
			die();
		case "/create_template":
			// TODO:: Add admin check
			$itinerary_id = $_POST["itinerary_id"];
			$preferences = json_decode($_POST["preferences"],true);
			// create_itinerary_template();

			$directory = "../uploads/template_weights/"; // User creation
			$fileName = $itinerary_id;
			$filePath = $directory . $fileName.".json";
			// Create the directory if it doesn't exist
			if (!file_exists($directory)) {
				mkdir($directory, 0777, true); // Change the permission mode as needed
			}


			notify_slack_template_creation();
			// Save the JSON data to a file
			$fileSaved = file_put_contents($filePath, json_encode($preferences));
			send_json(array("msg"=> "Success","bytes"=> $fileSaved));

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
			$id = create_itinerary($user_id,1);
			send_json(array("msg"=> "Success","itinerary_id" => $id["itinerary_id"]));
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
		case "/toggle_wishlist":
			$itinerary_id = $_POST["itinerary_id"];
			$user_id = get_session_user_id();
			if($user_id){
				$result = toggle_wishlist($user_id,$itinerary_id);
				if($result == 0 || $result == 1){
					send_json(array("added"=>$result));
					die();
				}else{
					//If no response, then something went wrong
					send_json(array("msg"=> "Something went wrong. Try again later"),201);
					die();
				}
			}else{
				send_json(array("msg"=> "You need to be signed in to save an itinerary for later"),201);
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
				send_json(array("msg"=> "You need to sign in to create an itinerary"),201);
			}
			die();
		case "/toggle_destination_request_status":
			//TODO:: Add admin check
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
		case "/finalise_itinerary":
			$itinerary_id = $_POST["itinerary_id"];
			// fail if payment for the itinerary has been made

			create_itinerary_invoice($itinerary_id);
			send_json(array("msg"=> "Itinerary invoice generated"));
			die();
		case "/paystack_callback":
			$_POST = json_decode(file_get_contents("php://input"),true);
			die();
		case "/request_password_reset":
			send_json(array("msg"=> "Kindly send an email to main.easygo@gmail.com for help regaining your account!"),201);
			die();
		default:
			send_json(array("msg"=> "Method not implemented"));
			break;
	}
	die();
?>