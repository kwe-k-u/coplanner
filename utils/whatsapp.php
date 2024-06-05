<?php
require_once(__DIR__ . "http_handler.php");
require_once(__DIR__ . "env_manager.php");

class whatsapp extends http_handler
{
	private $baseurl = "https://graph.facebook.com/";
	private $token = null;
	private $header = array();

	function __construct($version = "v19.0"){
		$this->baseurl .= "$version/".whatsapp_phone_id()."/";
		$this->token = whatsapp_token();
		$this->header = array(
			"Authorization: Bearer " . $this->token,
			"Cache-Control: no-cache",
			"Content-Type: application/json",
		);
	}

	function send_message($number, $message, $preview_url = false){
		$response = $this->post(
			$this->baseurl . "messages",
			array(
				"messaging_product" => "whatsapp",
				"recipient_type" => "individual",
				"to" => "$number",
				"type" => "text",
				"text" => array(
					"preview_url" => $preview_url,
					"body" => "$message"
				)
			),
			$this->header
		);
		return json_decode($response, true);
	}


	public function send_template($number, $templateName, $languageCode = 'en_US'){
		$response = $this->post(
			$this->baseurl . "messages",
			array(
				"messaging_product" => "whatsapp",
				"to" => $number,
				"type" => "template",
				"template" => array(
					"name" => $templateName,
					"language" => array(
						"code" => $languageCode
					)
				)
			),
			$this->header
		);
		return json_decode($response, true);
	}

	function send_interactive($number, $message_header, $body, $footer, $buttons){
		$response = $this->post(
			$this->baseurl . "messages",
			array(
				"messaging_product" => "whatsapp",
				"recipient_type" => "individual",
				"to" => $number,
				"type" => "interactive",
				"interactive" => array(
					"type" => "button",
					"header" => $message_header,
					"body" => array("text" => $body),
					"footer" => array("text" => $footer),
					"action" => array(
						"buttons" => $buttons
					)
				)
			),
			$this->header
		);
		return json_decode($response, true);
	}


	function upload_media($path){
		function file_type($path){
			$type = null;
			switch (explode(".",$path)[0]){
				case "jpg":
				case "jpeg":
					$type = "image/jpeg";
					break;
				case "png":
					$type = "image/png";
					break;
			}

			return $type;
		}

		$type = file_type($path);
		$file = new CURLFILE($path);
		$response = $this->post($this->baseurl."media",
			array(
				"messaging_product" => "whatsapp",
				"file" => $file,
				"type" => $type
			),
			$this->header
		);
		return json_decode($response, true);
	}


	function send_url($number,$header_text,$message,$url,$url_label,$footer_text){

		$response = $this->post($this->baseurl."messages",
			array(
				"messaging_product" => "whatsapp",
				"recipient_type" => "individual",
				"to" => $number,
				"type" => "interactive",
				"interactive" => array(
					// "type" => "interactive",
					"type" => "cta_url",
					// Optional
					"header" => array(
						"type" => "text",
						"text" => $header_text
					),
					"body" => array("text" => $message),
					// "footer" => array("text"=>$footer_text),
					"action" => array(
						"name" => "cta_url",
						"parameters" => array (
							"display_text" => $url_label,
							"url" => $url
						)
					)
				)
			),
			$this->header
		);
		return json_decode($response,true);
	}


	function send_location($number,$location_name, $latitude,$longitude){{
		$response = $this->post($this->baseurl."messages",
			array(
				"messaging_product" => "whatsapp",
				"recipient_type" => "individual",
				"to" => $number,
				"type" => "location",
				"location" => array(
					"longitude" => $longitude,
					"latitude" => $latitude,
					"name" => $location_name
				)
			),
		$this->header);
		return json_decode($response,true);
	// 	"messaging_product": "whatsapp",
	// 	"recipient_type": "individual",
	// 	"to": "<WHATSAPP_USER_PHONE_NUMBER>",
	// 	"type": "location",
	// 	"location": {
	// 	  "latitude": "<LOCATION_LATITUDE>",
	// 	  "longitude": "<LOCATION_LONGITUDE>",
	// 	  "name": "<LOCATION_NAME>",
	// 	  "address": "<LOCATION_ADDRESS>"
	  }
	}

	function request_location($number,$message){
		$response = $this->post($this->baseurl."messages",
			array(
				"messaging_product" => "whatsapp",
				"recipient_type" => "individual",
				"to" => $number,
				"type" => "interactive",
				"interactive" => array(
					"type" => "location_request_message",
					"body" => array(
						"text" => "$message"
					),
					"action" => array("name"=> "send_location")
				)
			),
			$this->header
		);

		return json_decode($response,true);
	}

	function send_contact($recipient_number,$contact_name,$contact_number,$company_name,$url){
		$response = $this->post($this->baseurl."messages",
			array(
				"messaging_product" => "whatsapp",
				"to" => $recipient_number,
				"type" => "contacts",
				"contacts" => [
					array(
						"name" => array(
							"formatted_name" => $contact_name,
							"first_name" => $company_name
						),
						"org" => array("company"=> $company_name),
						"phones" => [
							array("phone"=> $contact_number,"type"=>"main","wa_id" => "$contact_number")
						],
						"urls" => [array("url" => $url,"type"=> "company")
						]
					)

				]

			),
			$this->header
		);
		return json_decode($response,true);
		// {
		// 	"messaging_product": "whatsapp",
		// 	"to": "<WHATSAPP_USER_PHONE_NUMBER>",
		// 	"type": "contacts",
		// 	"contacts": [
		// 	  {
		// 		"name": {
		// 		  "formatted_name": "<FULL_NAME>",
		// 		  "first_name": "<FIRST_NAME>",
		// 		  "last_name": "<LAST_NAME>",
		// 		  "middle_name": "<MIDDLE_NAME>",
		// 		  "suffix": "<SUFFIX>",
		// 		  "prefix": "<PREFIX>"
		// 		},
		// 		"org": {
		// 		  "company": "<COMPANY_OR_ORG_NAME>",
		// 		  "department": "<DEPARTMENT_NAME>",
		// 		  "title": "<JOB_TITLE>"
		// 		},
		// 		"phones": [
		// 		  {
		// 			"phone": "<PHONE_NUMBER>",
		// 			"type": "<PHONE_NUMBER_TYPE>",
		// 			"wa_id": "<WHATSAPP_USER_ID>"
		// 		  }
		// 		  /* Additional phones objects go here, if using */
		// 		],
		// 		"urls": [
		// 		  {
		// 			"url": "<WEBSITE_URL>",
		// 			"type": "<WEBSITE_TYPE>"
		// 		  },
		// 		  /* Additional URLs go here, if using */
		// 		]
		// 	  }
		// 	]
		//   }
	}




}
?>