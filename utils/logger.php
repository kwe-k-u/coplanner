<?php
	require_once(__DIR__."/env_manager.php");
	#a php class that writes log files
	class Logger{

		function write_log($file, $entry){
			// if (!is_env_remote()){
			// 	return "logger disabled for testing profile";
			// }
			$path = __DIR__."/../logs/".$file;
			$data = "\n\n\n";
			// $add timestamp for entry with milliseconds
			$data = date("Y-m-d H:i:s")."\n============<START>================\n".$entry;
			$data .= "\n================<END>=========================\n";

			// $fp = fopen($path, 'a');
			// fwrite($fp, "\n".$data);
			// fclose($fp);
		}

		function js_error($array){

			#take the array and write each key value pair to a new line
			#leave  two new lines between this array and the previous entries
			#separate key and value  with <----->
			#start with 3 new line characters
			$data ="";
			foreach ($array as $key => $value) {
				$data .= $key."<----->".$value."\n";
			}

			$this->write_log("js_error".date("Ymd").".log", $data);
		}

		function general_log($data){
			$entry = "";
			if (is_array($data)){
				foreach ($data as $key => $value) {
					$entry .= $key."<----->".$value."\n";
				}
			} else if (is_string($data)){
				$entry = $data;
			}
			$this->write_log("general-".date("Ymd").".log", $entry);
		}


		function sql_query_log($query){
			// convert prepared statement to string
			$this->write_log("sql_queries-".date("Ymd").".log", $query);
		}

		function email_log($from,$destination, $subject,$message){
			// Log information of email
			$string =
			"From: $from
			To: $destination
			Subject: $subject\n
			Message: $message";
			$this->write_log("email-".date("Ymd").".log",$string);
		}

		function slack_log($message,$webhook){
			$string =
			"
			Webhook: $webhook
			Message: $message
			";
			return $this->write_log("slack_logs-".date("Ymd").".log",$string);
		}
	}
?>