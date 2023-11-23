<?php
	require_once(__DIR__. "/../../controllers/auth_controller.php");
	require_once(__DIR__. "/../../controllers/campaign_controller.php");
	require_once(__DIR__. "/../../controllers/interaction_controller.php");
	require_once(__DIR__. "/../../controllers/curator_interraction_controller.php");
	require_once(__DIR__. "/../../controllers/media_controller.php");
	require_once(__DIR__. "/../../controllers/slack_bot_controller.php");
	require_once(__DIR__."/../../utils/mailer/mailer_class.php");
	require_once(__DIR__. "/../../utils/core.php");



	function campaign (){
		$request = $_SERVER["REQUEST_METHOD"];
		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "get_campaign":
					$id = $_POST["campaign_id"];
					$camp = get_campaign_by_id($id);
					send_json(array("campaign"=>$camp));
					die();
				case "edit_campaign":
					$title = $_POST["title"];
					$description = $_POST["description"];
					$curator_id = $_POST["curator_id"];
					$campaign_id = $_POST["campaign_id"];
					$tours = json_decode($_POST["trips"],true);
					$activities = json_decode($_POST["activities"],true);
					update_campaign($title,$description,$campaign_id);

					$existing = get_campaign_tours($campaign_id);
					foreach($existing as $prev){
						$remove = true;
						foreach($tours as $entry){
							if($prev["tour_id"] == $entry["tour_id"]){
								$remove = false;
								break;
							}
						}
						if($remove){
							//TODO:: check if people already have bookings for the tour
							remove_campaign_tour($prev["tour_id"]);
						}
					}
					//TODO:: ensure number of available seats is not less than number booked
					foreach ($tours as $entry) {
						$tour_id = $entry["tour_id" ];
						$start_date = $entry["start_date"];
						$end_date = $entry["end_date"];
						$fee = $entry["fee"];
						$seats = $entry["seats"];
						$pickup_loc = $entry["pickup" ];
						$dropoff_loc = $entry["dropoff" ];
						$status = "published";
						$currency = "GHS";

						//todo check for removed campaigns
						if($tour_id == ""){
							$tour_id = generate_id();
							create_campaign_trip($tour_id,$campaign_id,$pickup_loc,$dropoff_loc,$start_date,$end_date,$seats,$currency,$fee,$status);
						}else{
							update_campaign_tour($pickup_loc,$dropoff_loc,$start_date,$end_date,$seats,$fee,$currency,$tour_id);
						}
					}

					send_json(array("msg"=> "Updated campaign"));
					die();
				case "create_campaign":
					$title = $_POST["title"];
					$description = $_POST["description"];
					$curator_id = $_POST["curator_id"];
					$camp_id = generate_id();
					$trips = json_decode($_POST["trips"],true);
					$activities = json_decode($_POST["activities"],true);

					$success = create_campaign($camp_id, $curator_id,$title,$description);
					if ($success){
						//for count, add each trip
						foreach ($trips as $current_trip) {
							$tour_id = generate_id();
							$start = $current_trip["start_date"];
							$end = $current_trip["end_date"];
							$pickup = $current_trip["pickup"];
							$dropoff = $current_trip["dropoff"];
							$seats = $current_trip["seats"];
							$fee = $current_trip["fee"];
							$status = "published";
							$currency = "GHS";
							create_campaign_trip($tour_id,$camp_id,$pickup,$dropoff,$start,$end,$seats,$currency,$fee,$status);
						}

							//add activities
							foreach($activities as $name => $entry){

								$activity_id = array_keys($entry)[0];
								$site = get_destination_by_name($name,true);
								$destination_id = $site["destination_id"];
								add_campaign_activity($camp_id,$activity_id,$destination_id);
							}

							//add images
							if (isset($_FILES["images"])){
								$num_files = count($_FILES["images"]['name']);
								$entry = $_FILES["images"];
								for ($i=0; $i < $num_files; $i++) {

									$image = $entry["name"][$i];
									$tmp = $entry["tmp_name"][$i];
									$id = generate_id();
									$media_type = 'picture';
									$location = upload_file("uploads",$media_type,$tmp,$image);

									upload_curator_media_ctrl($id,$curator_id,$location,$media_type);
									link_campaign_media_ctrl($camp_id,$id);
								}
							}

							$curator_name = get_curator_by_id($curator_id)["curator_name"];

							notify_new_tour($curator_name,$title,$camp_id);
							//notify follows of uploaded tour
							$curator_followers = get_curator_followers($curator_id);
							send_json(array("msg"=> "Tour created successful"));
							$mailer = new mailer();
							foreach($curator_followers as $follower){
								$email = $follower["email"];
								$mailer->notify_curator_alert_list($email,$curator_name,$camp_id);
							}

					}else {
						send_json(array("msg" => "Could not create tour"),100);
					}

					die();

				case "add_tour_site":
					$name = $_POST["destination_name"];
					$location = $_POST["destination_location"];
					$desc = $_POST["site_description"];
					$country = $_POST["country"];
					$activities =$_POST["activities"];
					$site_id = generate_id();
					$phone = $_POST["phone"];
					$contact = $_POST["contact"];
					$cordinates = $_POST["cordinates"] ?? "0.0";
					//TODO:: check if location name exists,
					add_destination($site_id,$name,$desc,$location,$country, $phone,$contact,$cordinates);

					// Adding activities for the tour site
					foreach ($activities as $name){
						add_destination_activity($site_id,$name);
					}


					//upload images for the destination
					if(isset($_FILES["destination_images"])){
						$num_files = count($_FILES["destination_images"]['name']);
						$entry = $_FILES["destination_images"];
						for ($i=0; $i < $num_files; $i++) {

							$image = $entry["name"][$i];
							$tmp = $entry["tmp_name"][$i];
							$id = generate_id();
							$media_type = 'picture';
							$location = upload_file("uploads",$media_type,$tmp,$image);
							upload_destination_media_ctrl($id,$site_id,$location,false);
						}
					}

					//link images from other websites if provided
					if(isset($_POST["images"])){
						$image_links = $_POST["images"];

						foreach ($image_links as $entry) {
							$location = $entry["image_url"];
							upload_destination_media_ctrl('',$site_id,$location,true);
						}
					}

					// if it does add the location
					send_json(array("msg" => "Added tour site"));
					die();
				case "get_site_by_id":
					$site_id = $_POST["destination_id"];
					$response = get_destination_by_id($site_id);
					send_json($response);
					die();
				case "query_site":
					$query = $_POST["query"];
					$type = $_POST["type"];

					if ($type == "Activity"){
						$data = get_destination_by_activity($query);

					}else if($type == "Location"){
						$data = get_destination_by_location($query);
					} else if ($type == "Name"){
						$data = get_destination_by_name($query);
					}



					send_json(array("sites" => $data));
					die();

				case "get_tour_charge":
					$tour_id = $_POST["tour_id"];
					$seats = intval($_POST["adult_seats"])+intval($_POST["kid_seats"]);
					$tour = get_campaign_trip_by_id($tour_id);
					$currency = $tour["currency"];
					$amount = (doubleval($tour["fee"]) * $seats);
					$vat = $amount * VAT_RATE;
					$tourism = $amount * TOURISM_LEVY;
					$amount = $vat + $tourism + $amount;
					send_json(array(
						"tour_id"=> $tour_id,
						"amount" => $amount,
						"currency" => $currency
					));
					die();
				default:
					echo "No implementation for <". $_POST["action"] .">";
					die();
			}
		}else if ($request == "GET"){
			switch($_GET["action"]){
				default:
					die();
			}

		}
	}


	campaign();
?>