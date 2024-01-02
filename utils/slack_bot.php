<?php

use GuzzleHttp\Promise\Is;

require_once(__DIR__."/../utils/env_manager.php");
require_once(__DIR__."/env_manager.php");
require_once(__DIR__."/logger.php");

/**This class manages the interactions between easyGo events and a notification bot on slack. */
	class slack_bot_class{


		/**Sends message into the  channel on Slack corresponding to the webhook */
		function send_update_cls($message, $webhook){
			$logger = new Logger();
			$logger->slack_log($message,$webhook);

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

		function notify_error_log($message){
			return $this->send_update_cls($message,slack_webhook_error_logs());
		}

		function notify_user_log($message){
			return $this->send_update_cls($message,slack_webhook_tourist_logs());
		}

		function notify_transaction_log($message){
			return $this->send_update_cls($message,slack_webhook_transactions());
		}

		function notify_support_log($message){
			return $this->send_update_cls($message,slack_webhook_support());
		}

		function notify_info_log($mssage){
			return $this->send_update_cls($mssage,"");
		}
	}
?>