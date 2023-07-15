<?php
	require_once(__DIR__."/../../controllers/private_tour_controller.php");
	require_once(__DIR__."/../../controllers/finance_controller.php");
	require_once(__DIR__."/../../utils/core.php");
	require_once(__DIR__."/../../utils/paystack.php");

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
					$start = $_POST["start_date"];
					$end = $_POST["end_date"];
					$state = $_POST["state"];
					$count = $_POST["person_count"];
					$type = $_POST["type"];
					$trip_id = generate_id();


					if ($type == "custom"){
						$desc = $_POST["description"];
						create_private_tour_custom($trip_id,$user_id,
							$currency,$min,$max,$desc,$start,$end,$state,$count);
					}else {

					}
					//TODO: Email curators on posting of private tour request
					send_json(array("msg"=>"Uploaded your private trip request. Curators will send quotes soon"));
					die();
				case "bid_private_tour":
					$request_id = $_POST["request_id"];
					$comment = $_POST["comment"];
					$fee = $_POST["fee"];
					$currency = $_POST["currency"];
					$curator = $_POST["curator_id"];
					$b_id = generate_id();

					$success = place_tour_request_bid($b_id,$curator,$request_id,$comment,$currency,$fee);
					// echo $success;
					// die();
					if($success){
						send_json(array("msg"=> 'Bid placed'));
						//TODO: email user on bid received
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
					$start = $_POST["start_date"];
					$end = $_POST["end_date"];
					$state = $_POST["state"];
					$count = $_POST["person_count"];
					$type = $_POST["type"];
					if ($type == 'custom'){
						$desc = $_POST["description"];
						$success = edit_custom_private_tour_request($id, $currency,$min,$max,
							$desc,$start,$end,$state, $count);
					}else {
						$success = edit_campaign_private_tour_request($id, $currency,$min,$max,
							$start,$end,$state, $count);
					}


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
				case "get_custom_private_request":
					$id = $_POST["request_id"];
					$request = get_custom_private_tour_by_id($id);

					send_json($request);
					die();

				case "get_campaign_private_request":
					$id = $_POST["request_id"];
					$request = get_campaign_private_tour_by_id($id);

					send_json($request);
					die();

				case "get_private_tour_charge":
					$quote_id = $_POST["quote_id"];
					$quote = get_private_tour_quote($quote_id);
					$fee = $quote["fee"];
					$tourism = $fee * TOURISM_LEVY;
					$discount = 0;
					$vat = $fee * VAT_RATE;
					$currency = $quote["currency"];

					$total = $fee + $tourism + $vat -$discount;
					$subtotal = $fee - $discount;




					$response = array(
						"quote_id"=> $quote_id,
						"vat" => $vat,
						"tourism_levy"=> $tourism,
						"discount" => $discount,
						"currency"=> $currency,
						"fee" => $fee,
						"sub_total"=> $subtotal,
						"total"=> $total
					);
					send_json($response);
					die();
				case "react_to_quote":
					$quote_id = $_POST["quote_id"];
					$status = $_POST["accepted"] == "true";
					$quote = get_private_tour_quote($quote_id);
					$tour_id = $quote["private_tour_id"];

					if ($status){ // if the quote was accepted check payment details and record
						$reference = $_POST["payment_reference"];
						$paystack = new paystack_custom();
						$res = $paystack->verify_transaction($reference);
						$paid = $res["status"];
						// if payment has been received accept booking bid
						if($paid){
							$data = $res["data"];
							$transaction_id = $data["reference"];
							$trans_fee=$data["fees"]/100;
							$trans_date = $data["paid_at"];
							$trans_amount = $data["amount"]/100;//(1+tax_rate)*amount
							$currency = $data["currency"];
							$amount = $trans_amount/ (1+VAT_RATE + TOURISM_LEVY);
							$tax = $trans_amount - $amount;

							record_transaction($transaction_id,$trans_date,$currency,$trans_amount,$amount,$trans_fee,$tax);
							invoice_private_tour($transaction_id,$tour_id,$transaction_id,$trans_date);
						}
					}

					react_to_private_quote($quote_id,$status,$tour_id);
					//check transaction id id

					send_json(array("msg"=> "Booking complete"));


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