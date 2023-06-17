<?php
	require_once(__DIR__."/../utils/paybox.php");
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../controllers/auth_controller.php");
	require_once(__DIR__."/../controllers/campaign_controller.php");
	require_once(__DIR__."/../controllers/finance_controller.php");

	$paybox = new paybox_custom();
	if(!isset($_SERVER["PATH_INFO"])){
		echo "No path provided";
		die();
	}

	switch($_SERVER["PATH_INFO"]){
		case "/verify_email":
			if(!isset($_GET["token"])){
				echo "No token provided. Kindly request a new invite link";
				die();
			}
			$token = $_GET["token"];
			$invite = get_curator_invite_by_token($token);
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
		default:
			die();
	}


	switch($_REQUEST["action"]){
	// 	case "paybox":
	// // 		$_POST=
	// // 	array("status"=> "Success",
	// // 	"message"=> "Test Payment Initiated",
	// // 	"token"=> "bhIYQ0shG0",
	// // 	"timestamp"=> "2022-12-23T03:52:38.000000Z",
	// // 	"currency"=> "GHS",
	// // 	"exchange"=> null,
	// // 	"amount"=> 400,
	// // 	"fee"=> 7.6,
	// // 	"mode"=> "Test",
	// // 	"payment_processor"=> "Test",
	// // 	"transaction"=> "Credit",
	// // 	"payload"=> array("payment_method"=>"momo","contact_name"=>"Mildred","contact_number"=>"0208162626","seats"=>"2","number"=>"0559582518","network"=>"MTN","user_id"=>"a6d783492bfac5fc426a552592d13e57","campaign_id"=>"36d61baa788777e446c0a0361aea6ef2","trip_id"=>"d1a10ba6198572ee80984e0fb17ae533","action"=>"trip_payment"),
	// // 	"order_id"=> null,
	// // 	"environment"=> "Development",
	// // 	"callback_url"=> "https:\/\/www.easygo.com.gh\/processors\/callback.php?action=paybox&mode=",
	// // 	"redirect_url"=> "https:\/\/www.easygo.com.gh\/settings\/test_prod.php",
	// // 	"payer_name"=> null,
	// // 	"payer_email"=> "easy@go",
	// // 	"payer_phone"=> null,
	// // 	"customer_id"=> null
	// // );
	// 		$success = $_POST["status"] == "Success";

	// 		if (!$success){
	// 			echo "end";
	// 			die();
	// 		}

	// 		$payload = $_POST["payload"];
	// 		// echo (json_encode($payload));
	// 		// die();
	// 		$payload = is_string($payload) ? json_encode($payload): $payload;
	// 		$payload = $_POST["payload"];
	// 		$token = $_POST["token"];
	// 		$currency = $_POST["currency"];
	// 		$time = $_POST["timestamp"];
	// 		$transaction_amount = $_POST["amount"];
	// 		$transaction_fee = $_POST["fee"];


	// 		$user_id = $payload["user_id"];
	// 		$trip_id = $payload["trip_id"];
	// 		$campaign_id = $payload["campaign_id"];
	// 		$action = $payload["action"];
	// 		$payment_method=$payload["payment_method"];
	// 		$contact_name = $payload["contact_name"];
	// 		$contact_number = $payload["contact_number"];
	// 		$network = $payload["network"];
	// 		$number = $payload["number"];
	// 		$seats = $payload["seats"];

	// 		$user = get_user_by_id($user_id);
	// 		$trip = get_campaign_trip_by_id($trip_id);

	// 		$amount_expected = floatval($trip["fee"]) * intval($seats);
	// 		$currency_expected = $trip["currency"];

	// 		$body = array (
	// 			"action" => "verify_payment",
	// 			"amount_expected" => $amount_expected,
	// 			"currency_expected" => $currency_expected,
	// 			"provider" => "paybox",
	// 			"token" => $token
	// 		);

	// 		$http = new http_handler();
	// 		//check if payment was successful
	// 		$response = $http->post(
	// 			"localhost/easygo_v2/processors/processor.php",
	// 			$body
	// 		);

	// 		$response = json_decode($response, true);

	// 		// var_dump($response);
	// 		// die();

	// 		if ($response["status"] == "success"){// record transaction
	// 			switch($action){
	// 				case "trip_payment":
	// 					$data = $response["data"];
	// 					// record transaction
	// 					$transaction_date = $data["timestamp"];
	// 					$booking_id = generate_id();
	// 					record_transaction($token,$transaction_date,$amount_expected,"paybox",$data["fee"]);
	// 					// record booking
	// 					book_standard_trip($booking_id,$user_id,$trip_id,$seats,$token,$contact_name,$contact_number);
	// 			}
	// 			// echo $response;
	// 		}else {
	// 			echo "failed";
	// 		}

	// 		//if it was record the transaction and create booking


	}

	// $e = $paybox->withdraw(0.1,"0150509995000","300302","Kweku","main.easygo@gmail.com","2");


// echo $response;
	// var_dump($e);


	//verify transaction and update booking status
	//from payload get user_id, trip_id, $seats_booked
?>