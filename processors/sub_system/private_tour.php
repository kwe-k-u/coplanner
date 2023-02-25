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
					send_json(array("msg"=>"Uploaded your private trip request. Curators will send quotes soon"));
					die();
				case "bid_private_tour":
					$request_id = $_POST["request_id"];
					$comment = $_POST["comment"];
					$fee = $_POST["fee"];
					$curator = $_POST["curator_id"];
					$b_id = generate_id();

					$success = place_tour_request_bid($b_id,$curator,$request_id,$comment,$fee);
					// echo $success;
					// die();
					if($success){
						send_json(array("msg"=> 'Bid placed'));
					} else {
						send_json(array("msg"=> 'Failed to place bid'),100);
					}
					die();
				case "edit_private_tour":
					$id = $_POST["request_id"];
					$user_id = $_POST["user_id"];
					$currency = $_POST["currency"];
					$max = $_POST["max_budget"];
					$min = $_POST["min_budget"];
					$desc = $_POST["description"];
					$start = $_POST["start_date"];
					$end = $_POST["end_date"];
					$state = $_POST["state"];
					$count = $_POST["person_count"];
					$success = edit_private_tour_request($id, $currency,$min,$max,
						$desc,$start,$end,$state, $count);


					$msg = $success ? "Edited your request, we will notify curators"
					: "Something went wrong, try again";


					send_json(array("msg"=>$msg, $success ? 200:100));
					die();
					case "delete_private_tour":
						$id = $_POST["request_id"];
						$success = remove_private_tour_request($id);

						$msg = $success ? "Successfully deleted your request" : "We cant delete a request that has received quotes";
						send_json(array("msg"=>$msg, $success ? 200:100));
						die();
				case "get_private_request":
					$id = $_POST["request_id"];
					$request = get_private_trip_by_id($id);

					send_json($request);
					die();

				default:
					echo "No implementation for <". $_POST["action"] .">";
					die();
			}
		}else if ($request == "GET"){

		}
	}

	private_tour();
?>