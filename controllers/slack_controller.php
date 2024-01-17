<?php
	require_once(__DIR__."/../utils/slack_bot.php");

	/**Notifies slack when a user creates an itinerary from scratch */
	function notify_slack_itinerary_creation($username,$user_id){
		$slack = new slack_bot_class();
		$message = "$username <$user_id> just created an itinerary";
		return $slack->notify_user_log($message);
	}

	/**Notifies slack when someone signs up */
	function notify_slack_signup($username,$user_email){
		$slack = new slack_bot_class();
		$message = "$username<$user_email> Just Signed Up!";
		return $slack->notify_user_log($message);
	}

	/**Notifies support when a user searches for a location we haven't added yet (or mispells something) */
	function notify_slack_zero_search_results($query){
		$slack = new slack_bot_class();
		$message = "Heads up! Destination search <$query> returned zero results";
		return $slack->notify_support_log($message);
	}

	/**Notifies slack when the admin adds a template to the AI recommendation list */
	function notify_slack_template_creation(){
		$slack = new slack_bot_class();
		$message = "A new itinerary template has been added to the system";
		return $slack->notify_info_log($message);
	}

	/**Notifies slack about a user creating their own version of another users' itinerary */
	function notify_slack_itinerary_duplicate($itinerary_id){
		$slack = new slack_bot_class();
		$message = "A user just duplicated itineray with id $itinerary_id";
		return $slack->notify_info_log($message);
	}

	/**Messages a slack channel about a user creating an itinerary with the AI service */
	function notify_slack_ai_itinerary(){
		$slack = new slack_bot_class();
		$message = "A user just used the AI itinerary creation service";
		return $slack->notify_info_log($message);
	}

	/**Notifies slack about a user making payment for an itinerary */
	function notify_slack_itinerary_payment($itinerary_id,$transaction_id){
		$slack = new slack_bot_class();
		$message = "A user has made payment for itinerary $itinerary_id. Transaction ID is $transaction_id";
		return $slack->notify_transaction_log($message);
	}

	function notify_slack_itinerary_invoice_generation($itinerary_id){
		$slack = new slack_bot_class();
		$message = "A user has generated an invoice for the itinerary with id $itinerary_id";
		return $slack->notify_user_log($message);
	}



?>