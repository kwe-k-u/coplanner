<?php
	// require_once(__DIR__."/../utils/paybox.php");
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/paystack.php");
	require_once(__DIR__."/../controllers/auth_controller.php");
	require_once(__DIR__."/../controllers/campaign_controller.php");
	require_once(__DIR__."/../controllers/interaction_controller.php");
	require_once(__DIR__."/../controllers/finance_controller.php");
	require_once(__DIR__."/../controllers/slack_bot_controller.php");
	require_once(__DIR__."/../utils/mailer/mailer_class.php");

	// $paybox = new paybox_custom();
	if(!isset($_SERVER["PATH_INFO"])){
		echo "No path provided";
		die();
	}


	$paystack = new paystack_custom();
	$mailer = new mailer();

	switch($_SERVER["PATH_INFO"]){
		case "/verify_payment":
			$reference = $_GET["reference"];
			$response = $paystack->verify_transaction($reference);
			if($response["status"]){
				echo "We have received payment. You should get an email from us confirming your seat! Contact support at main.easygo@gmail.com if you don't recieve a reciept";
			}else{
				echo "Hmm.. We haven't received payment! If you are still completing payment, refresh the page when you're done or contact support at main.easygo@gmail.com if you believe this is a mistake";
			}
			die();
		case "/verify_email":
			$token = $_GET["token"];
			$exists = check_email_verification_token($token);
			if($exists){
				$success = verify_user_email($token);
				echo "Your email has been verified. <a href='".server_base_url()."views/login.php'>Click here to return to login</a>";
			}else{
				echo "your verification token may have expired. Kindly contact support at main.easygo@gmail.com";
			}
			die();
		case "/curator_invite":

			if(!isset($_GET["hash"]) or !isset($_GET["date"])){
				echo "Your link seems broken. Kindly request a new one";
				die();
			}



			$date  = $_GET["date"];
			$hash = $_GET["hash"];
			$date = strtr($date,array("%"=>" "));


			//get all invites sent on that day that match the hash
			$invite = get_curator_invite_by_hash($hash,$date);
			if(strtotime($invite["invite_expiry"] - time()) <0){
				echo "Your invite has expired. Kindly request a new one";
				die();
			}
			$email = get_user_by_email($invite["email_address"]) == true;
			//encrypt with true if existing user; encrypt with false if new user
			$hash2 = encrypt($email.$hash);


			header("Location: ".server_base_url()."curator/register.php?hash=$hash&confirm=$hash2");
			// var_dump($invite);
			die();









			if (!$token){
				echo "This token does not exist. Kindly request a new token";
				die();
			}
			// Block if the invite has expired
			else if(strtotime($invite["invite_expiry"] - time()) <0){
				echo "Your invite has expired. Kindly request a new one";
				die();
			}
			$user_id = $token["user_id"];
			$role = $invite["privilege"];
			//TODO: create a page with a form that lets the invited curator upload
			//their national ID. Without this, the user cannot be added
			//Then redirect them here with a post request and obtain the documents
			//



			die();
		case "/paystack_callback":
			$_POST = json_decode(file_get_contents("php://input"),true);

			$meta = $_POST["data"]["metadata"];
			$data = $_POST["data"];

			$reference = $data["reference"];

			// check the transaction status
			$res = $paystack->verify_transaction($reference);
			$status = $res["status"];

			//If payment was successful record data and send invoice
			if($status){
				// Check what the payment is for
				$action = $meta["action"];
				switch($action){
					case "book_standard_tour":
						$contact_name = $meta["contact_name"];
						$contact_number = $meta["contact_number"];
						$transaction_id = $data["id"];
						$kids = $meta["num_kids"];
						$adults = $meta["num_adults"];
						$trans_amount = $data["amount"]/100;
						$easygo_amount = $trans_amount/ (1+VAT_RATE + TOURISM_LEVY);
						$tax = $trans_amount - $easygo_amount;
						$currency = $data["currency"];
						$booking_id = generate_id();
						$user_id = $meta["user_id"];
						$tour_id = $meta["tour_id"];
						$trans_fee = $data["fees"] / 100;
						$trans_date = $data["paid_at"];

						// record transaction
							record_transaction($transaction_id,$trans_date,$currency,$trans_amount,$easygo_amount,$trans_fee,$tax);
							book_standard_trip($booking_id,$user_id,$tour_id,$adults,$kids,$transaction_id,$contact_name,$contact_number);

							$user = get_user_by_id($user_id);
							$email = $user["email"];
							$tour_name =get_campaign_by_tour_id($tour_id)["title"];
							$mailer->booking_confirmation($email);
							notify_booking($user["user_name"],$email,$tour_name,$booking_id,$adults + $kids);

						send_json(array("response"=> "received"));
						die();
					default:
					//TODO:: record data and log error
					die();
				}

			}

			die();
		default:
			die();
	}


?>