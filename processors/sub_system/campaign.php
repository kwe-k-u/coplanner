<?php
	require_once(__DIR__. "/../../controllers/campaign_controller.php");
	require_once(__DIR__. "/../../controllers/curator_interraction_controller.php");
	require_once(__DIR__. "/../../controllers/media_controller.php");
	require_once(__DIR__. "/../../utils/core.php");



	function campaign (){
		$request = $_SERVER["REQUEST_METHOD"];
		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "create_campaign":
					$title = $_POST["title"];
					$description = $_POST["description"];
					$curator_id = $_POST["curator_id"];
					$camp_id = generate_id();
					$trips = json_decode($_POST["trips"],true);
					$activities = $_POST["activities"];

					// echo "count ". var_dump($trips["count"]);
					// die();
					$success = create_campaign($camp_id, $curator_id,$title,$description);
					// echo $success;
					if ($success){
						//for count, add each trip
						foreach ($trips as $current_trip) {
							$trip_id = generate_id();
							$start = $current_trip["start_date"];
							$end = $current_trip["end_date"];
							$pickup = "Accra";//$current_trip["pickup_location"];
							$dropoff = "Accra";//$current_trip["dropoff_location"];
							$seats = $current_trip["seats"];
							$fee = $current_trip["fee"];
							$status = "published";
							$currency = "GHS";
							create_campaign_trip($trip_id,$camp_id,$pickup,$dropoff,$start,$end,$seats,$currency,$fee,$status);


							//add activities
							foreach($activities as $activity_id){
								add_campaign_activity($camp_id,$activity_id);
							}

							//add images
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
						send_json(array("msg"=> "image upload successful"));

					}else {
						send_json(array("msg" => "Could not create trip"),100);
					}

					die();

				case "add_site":
					$name = $_POST["name"];
					$location = $_POST["location"];
					$country = $_POST["country"];
					$activities = explode(",",$_POST["activities"]);
					$site_id = generate_id();
					//check if location name exists,
					add_toursite($site_id,$name,$location,$country);

					foreach ($activities as $act){
						$act_id = generate_id();
						add_toursite_activity($site_id, $act_id, $act);
					}

					// if it does add the location
					// add location activities if they don't exists
					echo "Added location";
					die();
				case "get_site_by_id":
					$site_id = $_POST["toursite_id"];
					$response = get_toursite_by_id($site_id);
					send_json($response);
					die();
				case "query_site":
					$query = $_POST["query"];
					$type = $_POST["type"];

					if ($type == "Activity"){
						$data = get_toursite_by_activity($query);

					}else if($type == "Location"){
						$data = get_toursite_by_location($query);
					} else if ($type == "Name"){
						$data = get_toursite_by_name($query);
					}



					send_json(array("sites" => $data));
					die();
				default:
					echo "No implementation for <". $_POST["action"] .">";
					die();
			}
		}else if ($request == "GET"){

		}
	}


	campaign();
?>