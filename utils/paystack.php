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

		function log_json($id,$json){
			$path = __DIR__."/../logs/paystack-".$id.".json";

			$fp = fopen($path, 'a');
			fwrite($fp, $json);
			fclose($fp);
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


		function add_sub_account($business_name,$bank,$account_number,$percentage_charge,$description,$email,$contact_name,$contact_number,$meta = null){
			$response = $this->post($this->baseurl."subaccount",
			array(
				"account_number" => $account_number,
				"business_name" => $business_name,
				"settlement_bank" => $bank,
				"percentage_charge" => $percentage_charge,
				"description" => $description,
				"metadata" => $meta,
				"primary_contact_email" => $email,
				"primary_contact_phone" => $contact_number,
				"primary_contact_name" => $contact_name
			),
			array(
				"Authorization: Bearer ".$this->private_key,
				"Cache-Control: no-cache",
			  )
			);
			$response = json_decode($response,true);
			return $response;
		}

		function get_payout_account($id){
			$response = $this->get($this->baseurl."subaccount/$id",
			null,
			array(
				"Authorization: Bearer ".$this->private_key,
				"Cache-Control: no-cache",
			  )
			);
			$response = json_decode($response,true);

			return $response["data"];
		}

		/**
		 * Returns a list of banks supported by paystack
		 */
		function get_banks(){
			$response = $this->get($this->baseurl."bank?country=ghana");
			$response = json_decode($response,true);
			return $response["data"];
		}




	}
?>