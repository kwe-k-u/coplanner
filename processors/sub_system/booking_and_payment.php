<?php
	require_once(__DIR__. "/../../controllers/auth_controller.php");
	require_once(__DIR__. "/../../controllers/campaign_controller.php");
	require_once(__DIR__. "/../../controllers/finance_controller.php");
	require_once(__DIR__. "/../../utils/core.php");
	require_once(__DIR__."/../../utils/paybox.php");



	function transactions(){
		$request = $_SERVER["REQUEST_METHOD"];
		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "trip_payment":
					$paybox = new paybox_custom();
					$mode = $_POST["payment_method"];
					$trip_id = $_POST["trip_id"];
					$trip = get_campaign_trip_by_id($trip_id);
					$user_id = $_POST["user_id"];
					$user = get_user_by_id($user_id);
					$seats = $_POST["seats"];
					$amount = floatval($trip["fee"]) * intval($seats);

					if ($mode == "momo"){
						$network = $_POST["network"];
						$number = $_POST["number"];
						$payload = $_POST;
						//issue payment
						$e = $paybox->charge_momo(null,$user["email"],$amount,$network,$number,$payload);
						echo $e;

					} else if ($mode == "card"){

					}
					die();
				case "verify_payment":

					$provider = $_POST["provider"];
					$amount_expected = $_POST["amount_expected"];
					$currency_expected = $_POST["currency_expected"];

					if ($provider == "paybox"){
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

					}










					//create booking

					//issue payment

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