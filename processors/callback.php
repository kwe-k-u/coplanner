<?php

	// require_once(__DIR__."/../utils/paybox.php");
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/mailer/mailer_class.php");
	require_once(__DIR__."/../utils/paystack.php");
	require_once(__DIR__."/../controllers/public_controller.php");
	require_once(__DIR__."/../controllers/slack_controller.php");
	require_once(__DIR__."/../utils/logger.php");

	// $paybox = new paybox_custom();
	if(!isset($_SERVER["PATH_INFO"])){
		echo "No path provided";
		die();
	}

	$paystack = new paystack_custom();
	$mailer = new mailer();
	$mixpanel = new mixpanel_class();

	$itinerary_gen_url = "ai.easygo.com.gh";

	switch($_SERVER["PATH_INFO"]){
		case "/paystack_callback":
			$logger = new Logger();

			// log the contents of the request
			$_POST = json_decode(file_get_contents("php://input"),true);
			$logger->paystack_log($_POST);


			// If the payment coming was a success, process it appropriately
			if ($_POST["event"] == "charge.success"){

				//TODO:: check if the request is coming from paystack servers before continuing


				$data = $_POST["data"];
				$amount = $data["amount"];
				$currency = $data["currency"];
				$metadata = $data["metadata"];
				$reference = $data["reference"];

				// check if payment was valid
				$res = $paystack->verify_transaction($reference);

				if($res["status"]){
					//check why we are receiving the payment
					$purpose = $metadata["payment_purpose"];
					switch($purpose){
						case "experience_payment":
							$experience_id = $metadata["experience_id"];
							$provider_transaction_id = $data["id"];
							$transaction_amount = $data["amount"] / 100;
							$currency = $data["currency"];
							if(isset($metadata["user_id"])){
								$user_id = $metadata["user_id"];
							}else{
								// get_user_info();
								$name = $metadata["user_name"];
								$email = $metadata["user_email"];
								$phone = $metadata["user_phone"];
								$bypass = bypass_signup($name,$email,$phone);
								$user_id = $bypass["user_id"];
							}


							$provider_charges = $data["fees"]/100;
							$tax = 0;
							$transaction_date = $data["paid_at"]; //TODO:: record
							$amount = $transaction_amount - $provider_charges - $tax;
							$seats = $metadata["seats_booked"];
							notify_slack_support_msg(implode($_POST));
							$description = $metadata["description"];
							$package = $_POST["package_id"];
							//todo change user_id to user email
							$transaction_id = make_experience_payment($experience_id,$package, $seats,$provider_transaction_id,$user_id,$description,$transaction_amount,$amount,$tax,$provider_charges);
							$transaction_id = array_values($transaction_id)[0];
							if($transaction_id){
								$email = $data["customer"]["email"];
								notify_slack_experience_payment($email,$transaction_id,$experience_id);
								send_json(array("msg"=> "success", "data"=> $transaction_id));
								$mixpanel->log_experience_booking($user_id,$experience_id,$transaction_amount);
							}else{
								send_json(array("msg"=> "failed"),201);
							}
							die();
						case "itineray_payment":
							$invoice_id = $metadata["invoice_id"];
							$provider_transaction_id = $data["id"];
							$user_id = $meta["user_id"];
							$description = $meta["description"];
							$transaction_amount = $data["amount"] /100;
							$provide_charges = $data["fees"] / 100;
							$tax = 0;
							$transaction_date = $data["paid_at"]; //TODO:: record
							$amount = $transaction_amount - $charges - $tax;

							$transaction_id = make_invoice_payment($invoice_id,$provider_transaction_id,$user_id,$description,$transaction_amount,$amount,$tax,$charges);
							$transaction_id = array_values($transaction_id)[0];

							// if transaction worked, notify slack
							if ($transaction_id){
								notify_slack_itinerary_payment($invoice_id,$transaction_id);
								send_json(array("msg"=> "Ok"));
								$mixpanel->log_itinerary_booking($user_id,$metadata["itinerary_id"],$transaction_amount);
							}else{
								send_json(array("msg"=> "Something went wrong"),401);
							}
							die();
						default:
						die();
					}
				}
			}

		die();

		case "/google_oauth":
			$google = new GoogleAuthHandler(google_client_id(),google_client_secret(),google_redirect_url());
			$code = $_GET["code"];
			$user_data = $google->get_user_data($code);

			if($user_data){//If oauth works, proceed with authentication
				//Check if the user is registered with easyGo
				$google_id = $user_data["id"];
				$login = google_login($google_id);

				if(!$login){ // If the user isn't registered, create an account and get the login credentials
					$email = $user_data["email"];
					$name = $user_data["name"];
					$signup = signup_controller("google",$name,$google_id,$email);
					if($signup){ // If signup was successful, get login details
						$login = google_login($id);
					}else{//If signup failed, restart the process
						$auth_url = $google->generate_login_url();
						echo "Something went wrong. You need to try again. <a href='$auth_url'>Sign In With Google</a>";
						die();
					}
				}

				// log the user into easyGo
				// var_dump($login);
				// die();
				$user_id= $login["user_id"];
				session_log_in($user_id);
				$mixpanel = new mixpanel_class();
				$mixpanel->log_event_login($user_id,"google");

				// header("Location: /../index.php");
				header("Location: ".server_base_url());
				die();
			}else{ //if oauth fails, restart the process
				$auth_url = $google->generate_login_url();
				echo "something went wrong with your login. You need to try again. <a href='$auth_url'>Sign In Again</a>";
				die();
			}

			die();




































			die();
			$meta = $_POST["data"]["metadata"];
			$data = $_POST["data"];
			$referrer = $meta["referrer"];
			//if the paystack request did not come from coplanner, redirect to the old booking webiste
			if (strpos($referrer,$itinerary_gen_url) == false){
				$ch = curl_init("https://www.easygo.com.gh/processors/callback.php/paystack_callback");
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_POST));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, [
					'Content-Type: application/json',
					'Content-Length: ' . strlen(json_encode($_POST))
				]);

				// Execute the request
				$result = curl_exec($ch);
				curl_close($ch);
				die();
			}
			// $paystack->log_json($data["id"],json_encode($_POST));

			$reference = $data["reference"];

			// check the transaction status
			$res = $paystack->verify_transaction($reference);
			$status = $res["status"];

			// TODO:: Update to check what action is needed to be taken
			if ($status){ // If a user paid for an itinerary
				$verification_response = $paystack->verify_transaction($reference);
				$payment_status = $verification_response["status"];
				if ($status){ // payment was successful
					//  Act based on the purpose of the payments
						$payment_purpose = $meta["payment_purpose"];
						switch ($payment_purpose){
						case "itinerary_payment":
							// retrieve relevant information
							$invoice_id = $meta["invoice_id"];
							$provider_transaction_id = $data["id"];
							$user_id = $meta["user_id"];
							$purpose = $meta["purpose"];
							$transaction_amount = $data["amount"]/100; // Amount that the user send
							$charges = $data["fees"] / 100; // Amount that paystack charges for the transaction
							$tax = 0;
							$transaction_date = $data["paid_at"];//TODO:: record
							$amount = $transaction_amount - $charges - $tax;

							//perform transaction
							$transaction_id =  make_invoice_payment($invoice_id,$provider_transaction_id,$user_id,$purpose,$transaction_amount,$amount,$tax,$charges);
							$trasaction_id = array_values($transaction_id)[0];

							//Send a status update
							if($transaction_id){
								//TODO:: send email to user to confirm payment
								// $mailer->user_itinerary_payment_email();
								//notify admin of payment
								notify_slack_itinerary_payment($invoice_id,$transaction_id);
								send_json(array("msg"=> "Ok"));
							}else{
								send_json(array("msg"=> "Something went wrong "));
							}
							die();
						default:
							die();
						}

				}


			}



			die();

		case "/verify_payment":
			$reference = $_GET["reference"];
			$response = $paystack->verify_transaction($reference);
			if($response["status"]){
				// echo "We have received payment. You should get an email from us confirming your seat! Contact support at main.easygo@gmail.com if you don't recieve a reciept";
				send_json(array("msg"=> "We have received payment. You should get an email from us confirming your seat! Contact support at main.easygo@gmail.com if you don't recieve a reciept"));
			}else{
				// echo "Hmm.. We haven't received payment! If you are still completing payment, refresh the page when you're done or contact support at main.easygo@gmail.com if you believe this is a mistake";
				send_json(array("msg"=> "Hmm.. We haven't received payment! If you are still completing payment, refresh the page when you're done or contact support at main.easygo@gmail.com if you believe this is a mistake"),201);
			}
			die();
		// case "/verify_email":
		// 	$token = $_GET["token"];
		// 	$exists = check_email_verification_token($token);
		// 	if($exists){
		// 		$success = verify_user_email($token);
		// 		echo "Your email has been verified. <a href='".server_base_url()."views/login.php'>Click here to return to login</a>";
		// 	}else{
		// 		echo "your verification token may have expired. Kindly contact support at main.easygo@gmail.com";
		// 	}
		// 	die();
		// case "/curator_invite":

		// 	if(!isset($_GET["hash"]) or !isset($_GET["date"])){
		// 		echo "Your link seems broken. Kindly request a new one";
		// 		die();
		// 	}



		// 	$date  = $_GET["date"];
		// 	$hash = $_GET["hash"];
		// 	$date = strtr($date,array("%"=>" "));


		// 	//get all invites sent on that day that match the hash
		// 	$invite = get_curator_invite_by_hash($hash,$date);
		// 	if(strtotime($invite["invite_expiry"] - time()) <0){
		// 		echo "Your invite has expired. Kindly request a new one";
		// 		die();
		// 	}
		// 	$email = get_user_by_email($invite["email_address"]) == true;
		// 	//encrypt with true if existing user; encrypt with false if new user
		// 	$hash2 = encrypt($email.$hash);


		// 	header("Location: ".server_base_url()."curator/register.php?hash=$hash&confirm=$hash2");
		// 	// var_dump($invite);
		// 	die();









		// 	if (!$token){
		// 		echo "This token does not exist. Kindly request a new token";
		// 		die();
		// 	}
		// 	// Block if the invite has expired
		// 	else if(strtotime($invite["invite_expiry"] - time()) <0){
		// 		echo "Your invite has expired. Kindly request a new one";
		// 		die();
		// 	}
		// 	$user_id = $token["user_id"];
		// 	$role = $invite["privilege"];
		// 	//TODO: create a page with a form that lets the invited curator upload
		// 	//their national ID. Without this, the user cannot be added
		// 	//Then redirect them here with a post request and obtain the documents
		// 	//



		// 	die();
		case "/paystack_callback_first":
			// $_POST = json_decode(file_get_contents("php://input"),true);

			// $meta = $_POST["data"]["metadata"];
			// $data = $_POST["data"];

			// $reference = $data["reference"];

			// // check the transaction status
			// $res = $paystack->verify_transaction($reference);
			// $status = $res["status"];

			// //If payment was successful record data and send invoice
			// if($status){
			// 	// Check what the payment is for
			// 	$action = $meta["action"];
			// 	switch($action){
			// 		case "book_standard_tour":
			// 			$contact_name = $meta["contact_name"];
			// 			$contact_number = $meta["contact_number"];
			// 			$transaction_id = $data["id"];
			// 			$kids = $meta["num_kids"];
			// 			$adults = $meta["num_adults"];
			// 			$trans_amount = $data["amount"]/100;
			// 			$easygo_amount = $trans_amount/ (1+VAT_RATE + TOURISM_LEVY);
			// 			$tax = $trans_amount - $easygo_amount;
			// 			$currency = $data["currency"];
			// 			$booking_id = generate_id();
			// 			$user_id = $meta["user_id"];
			// 			$tour_id = $meta["tour_id"];
			// 			$trans_fee = $data["fees"] / 100;
			// 			$trans_date = $data["paid_at"];

			// 			// record transaction
			// 				record_transaction($transaction_id,$trans_date,$currency,$trans_amount,$easygo_amount,$trans_fee,$tax);
			// 				book_standard_trip($booking_id,$user_id,$tour_id,$adults,$kids,$transaction_id,$contact_name,$contact_number);

			// 				$user = get_user_by_id($user_id);
			// 				$email = $user["email"];
			// 				$tour_name =get_campaign_by_tour_id($tour_id)["title"];
			// 				$mailer->booking_confirmation($email);
			// 				notify_booking($user["user_name"],$email,$tour_name,$booking_id,$adults + $kids);

			// 			send_json(array("response"=> "received"));
			// 			die();
			// 		default:
			// 		//TODO:: record data and log error
			// 		die();
			// 	}

			// }

			die();
		default:
			die();
	}


?>