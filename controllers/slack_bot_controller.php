<?php
	require_once(__DIR__."/../utils/slack_bot.php");
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/env_manager.php");



	function notify_new_tripgoer($name,$email){
		$bot = new slack_bot_class();
		$message = "We have a new trip goer sign up! $name<$email>";
		return $bot->send_update_cls($message, slack_webhook_monitoring());
	}

	function notify_new_curator($company_name,$email){
		$bot = new slack_bot_class();
		$message = "We have a new curator signup! $company_name<$email>";
		return $bot->send_update_cls($message, slack_webhook_monitoring());}

	function notify_new_trip($curatorname,$trip_name, $occurance_count){

		$bot = new slack_bot_class();
		$message = "<$curatorname> just listed a trip <$trip_name> with $occurance_count occurances";
		return $bot->send_update_cls($message, slack_webhook_monitoring());
	}

	function notify_claim($name, $email, $subject){
		$bot = new slack_bot_class();
		$message = "A claim has been raised by $name<$email> about $subject";
		return $bot->send_update_cls($message, slack_webhook_claims());
	}

	function notify_booking($name,$email,$trip_name){
		$bot = new slack_bot_class();
		$message = "$name<$email> has booked a trip <$trip_name>";
		return $bot->send_update_cls($message, slack_webhook_monitoring());
	}

	function notify_transaction_initiation($transaction_id, $name, $email,$amount){
		$bot = new slack_bot_class();
		$amount_str= format_string_as_currency_fn($amount);
		$message = "Transaction(ID: $transaction_id) has been initiated by $name<$email> for GHC $amount_str";
		return $bot->send_update_cls($message, slack_webhook_monitoring());
	}

	function notify_transaction_completion($transaction_id,$amount){
		$bot = new slack_bot_class();
		$amount_str= format_string_as_currency_fn($amount);
		$message = "Transaction(ID: $transaction_id) has been confirmed for GHC $amount_str";
		return $bot->send_update_cls($message, slack_webhook_monitoring());
	}


	function notify_withdrawal_request($email,$curator_name,$request_id,$amount){
		$bot = new slack_bot_class();
		$amount_str = format_string_as_currency_fn($amount);
		$message = "A withdrawal request(ID: $request_id) has been initiated by $curator_name<$email> for GHC $amount_str";
		return $bot->send_update_cls($message, slack_webhook_withdrawals());
	}

	function notify_withdrawal_request_status($email,$curator_name,$request_id,$amount, $status){
		$bot = new slack_bot_class();
		$amount_str = format_string_as_currency_fn($amount);
		$message = "withdrawal request(ID: $request_id) by $curator_name<$email> for GHC $amount_str as been $status";
		return $bot->send_update_cls($message, slack_webhook_withdrawals());
	}

	function notify_error_log(){
		$bot = new slack_bot_class();
		// $message = str_replace("
		// ","\n",$message);
		$message = "An error has been detected";
		return $bot->send_update_cls($message, slack_webhook_monitoring());

	}

	function notify_system_log($log){
		$bot = new slack_bot_class();
		return $bot->send_update_cls($log, slack_webhook_logs());
	}

	function notify_occurance_update($curatorname,$tripname,$seats,$start,$end, $fee){
		$message = "Occurance Update: $curatorname's trip<$tripname> from <$start> to <$end> now costs GHS <$fee> for <$seats> seats ";
		$bot = new slack_bot_class();
		return $bot->send_update_cls($message, slack_webhook_monitoring());
	};

	function notify_occurance_creation($curatorname,$tripname,$seats,$start,$end, $fee){
		$message = "<$curatorname> just created occurance for <$tripname> to cost <$fee> for <$seats> starting from <$start> to <$end>";
		$bot = new slack_bot_class();
		return $bot->send_update_cls($message, slack_webhook_monitoring());
	};
?>