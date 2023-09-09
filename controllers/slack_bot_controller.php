<?php
	require_once(__DIR__."/../utils/slack_bot.php");
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/env_manager.php");



	function notify_tourist_signup($name,$email){
		$bot = new slack_bot_class();
		$message = "Tourist signup:: $name<$email> just created a tourist account";
		return $bot->notify_tourist_log($message);
	}

	function notify_new_curator($company_name,$email,$person){
		$bot = new slack_bot_class();
		$message = "Curator signup:: $person<$email> just created a curator account for $company_name";

		return $bot->notify_curator_log($message);
	}

	function notify_curator_collaborator_removal($curator_name,$admin_name,$admin_email,$removed_name,$removed_email){
		$bot = new slack_bot_class();
		return $bot->notify_curator_log("Curator collaborator removal:: $admin_name<$admin_email> has removed $removed_name<$removed_email> from $curator_name");
	}

	function notify_curator_invite($curator_name,$invite_email,$person_name,$person_email){
		$bot = new slack_bot_class();
		$message = "Curator invite:: $person_name<$person_email> just invited $invite_email to manage $curator_name";
		return $bot->notify_curator_log($message);
	}

	function notify_curator_invite_signup($email,$name,$curator_name){
		$bot = new slack_bot_class();
		$message = "Invite signup:: $name<$email> used their invite to sign up to manager $curator_name";
		return $bot->notify_curator_log($message);
	}

	function notify_new_tour($curatorname,$tour_name,$camp_id){
		$bot = new slack_bot_class();
		$message = "Tour listing:: $curatorname just listed $tour_name >> www.easygo.com.gh/views/tour_description.php?campaign_id=$camp_id";
		return $bot->notify_curator_log($message);
	}


	function notify_booking($name,$email,$tour_name,$booking_id,$seats){
		$bot = new slack_bot_class();
		$message = "Booking:: $name<$email> has booked $seats seats on $tour_name. Booking ID::$booking_id";
		return $bot->notify_transaction_log($message) && $bot->notify_tourist_log($message);
	}

	function notify_campaign_wishlist($username,$user_email,$campaign_name){
		$bot = new slack_bot_class();
		$message = "Tourist wishlist: $username<$user_email> just added $campaign_name to their wishlist";
		return $bot->notify_tourist_log($message);
	}


	function notify_error_log($type){
		$bot = new slack_bot_class();
		$message = "A $type error has been detected";
		return $bot->notify_error_log($message);

	}


	function notify_occurance_update($curatorname,$tripname,$seats,$start,$end, $currency, $fee){
		// $message = "Occurance Update: $curatorname's trip<$tripname> from <$start> to <$end> now costs GHS <$fee> for <$seats> seats ";
		$message = "Tour update:: $curatorname just updated details for the tour $tripname. The dates are $start to $end with $seats seats at $currency $fee";
		$bot = new slack_bot_class();
		return $bot->notify_curator_log($message);
		// return $bot->send_update_cls($message, slack_webhook_monitoring());
	}

	function notify_occurance_creation($curatorname,$tripname,$seats,$start,$end,$currency, $fee){
		// $message = "$curatorname just created occurance for <$tripname> to cost <$fee> for <$seats> starting from <$start> to <$end>";
		$message = "Tour creation:: $curatorname just added an occurance for $tripname. The dates are $start to $end with $seats seats at $currency $fee";
		$bot = new slack_bot_class();
		return $bot->notify_curator_log($message);
		// return $bot->send_update_cls($message, slack_webhook_monitoring());
	}


	function notify_private_tour_bid($curator,$tour_id){
		$message = "Private tour bid<$tour_id>:: $curator just placed a bid on a private tour.";
		$bot = new slack_bot_class();
		return $bot->notify_private_tour_log($message);
	}

	function notify_private_tour_request($user,$email){
		$message = "Private tour Request:: $user<$email> just requested a private tour";
		$bot = new slack_bot_class();
		return $bot->notify_private_tour_log($message);
	}

	function notify_contact_message($name,$email,$phone,$message){
		$message = "Contact message:: $name<$email,$phone> sent <$message> through the support page";
		$bot = new slack_bot_class();
		return $bot->notify_support_log($message);
	}

	function notify_private_tour_accept($name,$email,$quote_id){
		$message = "Private tour bid accepted:: $name<$email> just acceted a bid on their private tour. Bid iD: $quote_id";
		$bot = new slack_bot_class();
		return $bot->notify_private_tour_log($message);
	}

	function notify_curator_follow($user_name,$email,$curatorname,$action){
		$message = "Curator follow:: $user_name<$email> just $action $curatorname";
		$bot = new slack_bot_class();
		return $bot->notify_tourist_log($message);
	}

?>