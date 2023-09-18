<?php
	// Show php errors
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


	require_once(__DIR__."/../utils/mailer/mailer_class.php");


	// if (!isset($_SERVER["PATH_INFO"])){
	// 	respond("No subsystem specified",false);
	// }
	 $auth_actions = array (
		"login",
		"signup",
		"logout",
		"request_password_reset",
		"change_password",
		"change_password_logged_in",
		"invite_curator_collaborator",
		"curator_invite_signup",
		"remove_curator_collaborator",
		"update_profile",
		"resend_email_verification"
	);
	$booking_actions = array(
		"book_trip",
		"book_standard_tour"
	);

	$campaign_actions = array(
		"create_campaign",
		"add_tour_site",
		"get_site_by_id",
		"query_site",
		"get_tour_charge"
	);


	$private_tour_actions = array(
		"request_private_tour",
		"bid_private_tour",
		"get_custom_private_request",
		"get_campaign_private_request",
		"edit_private_tour",
		"delete_private_tour",
		"react_to_quote",
		"get_private_tour_charge"
	);

	$interaction_actions = array(
		"toggle_curator_follow",
		"add_campaign_wishlist",
		"remove_campaign_wishlist"
	);
	$media_actions = array(
		"upload_media",
		"link_curator_manager_id",
		"update_curator_logo",
		"update_user_profile_image"
	);

	$newsletter_actions = array(
		"add_subscriber",
		"get_subscribers",
		"clear_subscribers"
	);

	$contact_actions = array(
		"send_contact_message"
	);

	$analytics = array(
		"error_log"
	);

	if (isset($_SERVER["PATH_INFO"]) && $_SERVER["PATH_INFO"] == "/log_error"){
		require_once(__DIR__."/sub_system/event_manager.php");
		die();
	}




	if(in_array($_REQUEST["action"],$auth_actions)){
		include_once(__DIR__."/sub_system/auth.php");
		die();
	}
	else if(in_array($_REQUEST["action"],$campaign_actions)){
		include_once(__DIR__."/sub_system/campaign.php");
		die();
	}
	else if(in_array($_REQUEST["action"],$private_tour_actions)){
		include_once(__DIR__."/sub_system/private_tour.php");
		die();
	}
	else if(in_array($_REQUEST["action"],$interaction_actions)){
		include_once(__DIR__."/sub_system/user_interaction.php");
		die();
	}
	else if(in_array($_REQUEST["action"],$booking_actions)){
		include_once(__DIR__."/sub_system/booking_and_payment.php");
		die();
	}
	else if(in_array($_REQUEST["action"],$media_actions)){
		include_once(__DIR__."/sub_system/media.php");
		die();
	}
	else if(in_array($_REQUEST["action"],$newsletter_actions)){
		include_once(__DIR__."/sub_system/newsletter.php");
	} else if (in_array($_REQUEST["action"], $contact_actions)){
		include_once(__DIR__."/sub_system/contact.php");
		die();
	}
?>