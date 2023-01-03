<?php

	// function respond($payload, $success = true){
	// 	return array(
	// 		"status" => $success ? "success" : "error",
	// 		"payload" => $payload
	// 	);
	// 	die();
	// }


	// if (!isset($_SERVER["PATH_INFO"])){
	// 	respond("No subsystem specified",false);
	// }
	 $auth_actions = array ("login",
	  "signup",
	 "logout",
	 "request_password_reset",
	 "change_password",
	 "invite_curator_collaborator",
	 "remove_curator_collaborator"
	);
	$booking_actions = array(
		"trip_payment",
		"verify_payment"
	);

	$campaign_actions = array(
		"create_campagin",
		"add_site"
	);

	$private_tour_actions = array(
		"request_private_tour",
		"bid_private_trip"
	);

	$interaction_actions = array(
		"follow_curator",
		"unfollow_curator",
		"add_campaign_wishlist",
		"remove_campaign_wishlist"
	);
	$media_actions = array(
		"upload_media",
		"link_curator_manager_id",
		"update_curator_logo"
	);

	$newsletter_actions = array(
		"add_subscriber",
		"get_subscribers",
		"clear_subscribers"
	);

	$contact_actions = array(
		"send_contact_message"
	);




	if(in_array($_POST["action"],$auth_actions)){
		include_once(__DIR__."/sub_system/auth.php");
	}
	else if(in_array($_POST["action"],$campaign_actions)){
		include_once(__DIR__."/sub_system/campaign.php");
	}
	else if(in_array($_POST["action"],$private_tour_actions)){
		include_once(__DIR__."/sub_system/private_tour.php");
	}
	else if(in_array($_POST["action"],$interaction_actions)){
		include_once(__DIR__."/sub_system/user_interaction.php");
	}
	else if(in_array($_POST["action"],$booking_actions)){
		include_once(__DIR__."/sub_system/booking_and_payment.php");
	}
	else if(in_array($_POST["action"],$media_actions)){
		include_once(__DIR__."/sub_system/media.php");
	}
	else if(in_array($_POST["action"],$newsletter_actions)){
		include_once(__DIR__."/sub_system/newsletter.php");
	} else if (in_array($_POST["action"], $contact_actions)){
		include_once(__DIR__."/sub_system/contact.php");
	}
?>