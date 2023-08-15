<?php

use GuzzleHttp\Promise\Is;

require_once(__DIR__."/../utils/env_manager.php");
require_once(__DIR__."/env_manager.php");

/**This class manages the interactions between easyGo events and a notification bot on slack. */
	class slack_bot_class{


		/**Sends message into the `Platform-monitoring` channel on Slack */
		function send_update_cls($message, $webhook){

			/** Don't send notification to slack if function is initated on local host */
			if (!is_env_remote()){
				return null;
			}
			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => $webhook,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>"{
				'text' : \"$message\"
			}",
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			return $response;
		// echo $response;

		}
	}
?>