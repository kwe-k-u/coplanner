<?php
	require_once(__DIR__. "/http_handler.php");
	require_once(__DIR__. "/env_manager.php");


	class paystack_custom extends http_handler{
		private $baseurl = "https://api.paystack.co/";
		private $public_key = null;
		private $private_key = null;

		function __construct()
		{
			$this->public_key = paystack_public_key();
			$this->private_key = paystack_private_key();
		}


		function verify_transaction($reference){
			$response = $this->get($this->baseurl."transaction/verify/$reference",
			null,
			array(
				"Authorization: Bearer ".$this->private_key,
				"Cache-Control: no-cache",
			  )
			);

			return json_decode($response,true);
		}




		// function popup(){
		// 	return $this->post(
		// 		$this->baseurl."",
		// 		array(
		// 			"email" => $email,
		// 			"amount" => $amount,
		// 			"ref" => $tour_id,
		// 			"currency" => $currency,
		// 			"metadata" => $metadata,
		// 		)

		// 	);
		// }


		// private function charge($email,$amount){
		// 	$url = "https://api.paystack.co/charge";

		// 	$fields = array (
		// 		"email" => $email,
		// 		"amount" =? $amount
		// 	);


		// 	$fields = [
		// 		'email' => "customer@email.com",

		// 		'amount' => "10000",

		// 		"metadata" => {

		// 		"custom_fields" => [

		// 			{

		// 			"value" => "makurdi",

		// 			"display_name" => "Donation for",

		// 			"variable_name" => "donation_for"

		// 			}

		// 		]

		// 		},

		// 		"bank" => {

		// 			"code" => "057",

		// 			"account_number" => "0000000000"

		// 		},

		// 		"birthday" => "1995-12-23"

		// 	];


		// 	$fields_string = http_build_query($fields);
		// 	//open connection
		// 	$ch = curl_init();



		// 	//set the url, number of POST vars, POST data

		// 	curl_setopt($ch,CURLOPT_URL, $url);

		// 	curl_setopt($ch,CURLOPT_POST, true);

		// 	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(

		// 		"Authorization: Bearer SECRET_KEY",

		// 		"Cache-Control: no-cache",

		// 	));



		// 	//So that curl_exec returns the contents of the cURL; rather than echoing it

		// 	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);



		// 	//execute post

		// 	$result = curl_exec($ch);

		// 	echo $result;
		// }



		//send mobile money
		function paystack_momo($email){

		}

		//send bank

		// check payment status

	//payment callback
	}
?>