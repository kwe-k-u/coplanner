<?php
	// Show php errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// $http_origin = $_SERVER['HTTP_ORIGIN'];
// if ($http_origin == "http://easygo.com.gh" ||
// 	 $http_origin == "http://www.easygo.com.gh" ||
// 	 $http_origin == "https://easygo.com.gh" ||
// 	 $http_origin == "https://www.easygo.com.gh")
// {
//     header("Access-Control-Allow-Origin: $http_origin");
// 	header('Access-Control-Allow-Methods: GET, POST');
// 	header("Access-Control-Allow-Headers: X-Requested-With");
// }


	require_once(__DIR__."/../utils/mailer/mailer_class.php");
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../controllers/public_controller.php");
	require_once(__DIR__."/../controllers/admin_controller.php");

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
						send_json(array("msg"=> "Signup successful"));
					}else{
						send_json(array("msg"=> "Signup Failed"),201);
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
		case "/create_destination":
			$name = $_POST["destination_name"];
			$location = $_POST["destination_location"];
			$description = $_POST["site_description"]; //TODO:: add to sql
			$country = $_POST["country"]; //TODO:: add to sql
			$activities = $_POST["activities"];
			$utilities = json_decode($_POST["utilities"],true);
			$latitude = explode(",",$_POST["cordinates"])[0];
			$longitude = explode(",",$_POST["cordinates"])[1];
			$rating = $_POST["rating"];

			$destination_id = create_destination($name,$location,$latitude,$longitude,$rating)["destination_id"];
			if(!$destination_id){
				send_json(array("msg"=> "Destination with same name exists! Creation failed"),201);
				die();
			}
			foreach ($activities as $value){
				add_destination_activity($destination_id,$value);
			}

			foreach ($utilities as $id => $utility_name){
				add_destination_utility($destination_id,$id);
			}
			send_json(array("msg"=> "Added destination"));
			die();
		case "/google_maps_upload":
			$type_association = array(
				"amusement_park"=> "Amusement Park",
				"aquarium"=> "Aquarium",
				"art_gallery"=> "Art Gallery",
				"bowling_alley"=> "Bowling Alley",
				"cafe"=> "Cafe",
				"campground"=> "Campground",
				"library"=> "Library",
				"lodging"=> "Accommodation",
				"movie_theater"=> "Movie Theater",
				"musem"=> "Museum",
				"night_club"=> "Night Club",
				"park"=> "Park",
				"casino"=> "Casino",
				"stadium"=> "Stadium",
				"shopping_mall"=> "Shopping Mall",
				"restaurant"=> "Restaurant",
				"zoo"=> "Zoo",
				"tourist_attraction"=> "Tourist Attraction"

		);
			$data = json_decode(file_get_contents('php://input'),true)["data"];
			foreach($data as $_ => $json){
				// $json = json_decode($value,true);
				$name = ucfirst(strtolower($json["name"]));
				$rating = $json["rating"];
				$num_rating = $json["user_ratings_total"];
				$location = $json["vicinity"];
				$latitude = $json["location"]["lat"];
				$longitude = $json["location"]["lng"];
				$types = $json["types"];

				if($num_rating > 100){
					$destination_id = create_destination($name,$location,$latitude,$longitude,$rating,$num_rating)["destination_id"];
					if(!$destination_id){
						// echo("Destination with same name<$name> exists! Additions skipped");
						continue;
					}

					foreach ($types as $key){
						if(key_exists($key,$type_association)){
							add_destination_utility($destination_id,$type_association[$key]);
						}
					}
					// echo"$name added\n";
				}

			}
			send_json(array("msg"=> "Received"));
			die();
		default:
			send_json(array("msg"=> "Method not implemented"));
			break;
	}

?>