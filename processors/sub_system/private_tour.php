<?php
	require_once(__DIR__."/../../controllers/private_tour_controller.php");
	require_once(__DIR__."/../../utils/core.php");

	function private_tour (){
		$request = $_SERVER["REQUEST_METHOD"];
		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "request_private_tour":
					$user_id = $_POST["user_id"];
					$currency = $_POST["currency"];
					$max = $_POST["max_budget"];
					$min = $_POST["min_budget"];
					$desc = $_POST["description"];
					$start = $_POST["start_date"];
					$end = $_POST["end_date"];
					$state = $_POST["state"];
					$count = $_POST["person_count"];
					$trip_id = generate_id();

					create_private_trip($trip_id,$user_id,
						$currency,$min,$max,$desc,$start,$end,$state,$count);
					echo "Uploaded your private trip request. Curators will send quotes soon";
					die();
				case "bid_private_trip":
					$request_id = $_POST["request_id"];
					$comment = $_POST["comment"];
					$fee = $_POST["fee"];
					$curator = $_POST["curator_id"];
					$b_id = generate_id();

					$success = place_tour_request_bid($b_id,$curator,$request_id,$comment,$fee);
					// echo $success;
					// die();
					if($success){
						echo "bid placed";
					} else {
						echo "Failed to place bid";
					}
					die();

				default:
					echo "No implementation for <". $_POST["action"] .">";
					die();
			}
		}else if ($request == "GET"){

		}
	}

	// private_tour();
?>