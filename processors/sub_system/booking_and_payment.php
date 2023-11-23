<?php
	require_once(__DIR__. "/../../controllers/auth_controller.php");
	require_once(__DIR__. "/../../controllers/campaign_controller.php");
	require_once(__DIR__. "/../../controllers/interaction_controller.php");
	require_once(__DIR__. "/../../controllers/finance_controller.php");
	require_once(__DIR__. "/../../controllers/slack_bot_controller.php");
	require_once(__DIR__. "/../../utils/core.php");
	require_once(__DIR__."/../../utils/paybox.php");
	require_once(__DIR__."/../../utils/paystack.php");



	function transactions(){
		$request = $_SERVER["REQUEST_METHOD"];
		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				// case "book_trip":
				// 	$paybox = new paybox_custom();
				// 	$mode = $_POST["payment_method"];
				// 	$tour_id = $_POST["tour_id"];
				// 	$trip = get_campaign_trip_by_id($tour_id);
				// 	$user_id = $_POST["user_id"];
				// 	$user = get_user_by_id($user_id);
				// 	$kids = $_POST["num_kids"];
				// 	$adults = $_POST["num_adults"];
				// 	$amount = floatval($trip["fee"]) * (intval($adults)+intval($kids));

				// 	if ($mode == "momo"){
				// 		$network = $_POST["network"];
				// 		$number = $_POST["number"];
				// 		$payload = $_POST;
				// 		//issue payment
				// 		$e = $paybox->charge_momo(null,$user["email"],$amount,$network,$number,$payload);
				// 		echo $e;

				// 	} else if ($mode == "card"){

				// 	}
				// 	die();
				case "verify_payment":
					
					die();
				case "book_standard_tour":

					$provider = $_POST["provider"];
					$amount_expected = $_POST["amount_expected"];
					$currency_expected = $_POST["currency_expected"];
					$mailer = new mailer();

					if ($provider == "paybox"){
						send_json(array("msg"=> "Payment through PayBox has been discontinued"),500);
						die();
						$token = $_POST["token"];
						$paybox = new paybox_custom();
						$transaction = $paybox->get_transaction($token);
						$transaction = json_decode($transaction, true);


						$t_currency = $transaction["currency"];
						$t_amount = $transaction["amount"];
						 $response = array (
							"status" => $t_amount == $amount_expected && $t_currency == $currency_expected,
							"data" => $transaction
						);
						 echo json_encode($response);

					}else if ($provider = "paystack"){
						$reference = json_decode($_POST["response"],true)["reference"];
						$paystack = new paystack_custom();
						$res =  $paystack->verify_transaction($reference);
						$status = $res["status"];
						// if payment has been received create a booking
						if($status){
							$data = $res["data"];
							$payload = json_decode($_POST["payload"],true);

							$adult_seats= intval($payload["num_adults"]);
							$kid_seats = intval($payload["num_kids"]);
							$contact_name = $payload["contact_name"];
							$contact_number = $payload["contact_number"];
							$user_id = $payload["user_id"];
							$tour_id = $payload["tour_id"];
							$booking_id = generate_id();

							$transaction_id = $data["id"];
							$trans_fee=$data["fees"]/100;
							$trans_date = $data["paid_at"];
							$trans_amount = $data["amount"]/100;
							$amount = $trans_amount/ (1+VAT_RATE + TOURISM_LEVY);
							$tax = $trans_amount - $amount;
							$currency = $data["currency"];

							record_transaction($transaction_id,$trans_date,$currency,$trans_amount,$amount,$trans_fee,$tax);
							book_standard_trip($booking_id,$user_id,$tour_id,$adult_seats,$kid_seats,$transaction_id,$contact_name,$contact_number);

							$user = get_user_by_id($user_id);
							$email = $user["email"];
							$tour_name =get_campaign_by_tour_id($tour_id)["title"];
							$mailer->booking_confirmation($email);
							notify_booking($user["user_name"],$email,$tour_name,$booking_id,$adult_seats + $kid_seats);

						}

						send_json(array(
							"status" => $status,
							"msg" => $status ? "Your seat(s) has been booked. Check your email for a reciept from us"
							: "We couldn't confirm your payment. Kindly Try again or contact support at main.easygo@gmail.com"
						));
					}

					die();
				default:
					echo "No implementation for <". $_POST["action"] .">";
					die();
			}
		}else if ($request == "GET"){

		}
	}


	transactions();
?>