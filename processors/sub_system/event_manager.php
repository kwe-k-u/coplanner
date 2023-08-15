<?php
	require_once(__DIR__."/../../utils/core.php");
	require_once(__DIR__."/../../utils/logger.php");
	require_once(__DIR__."/../../controllers/slack_bot_controller.php");

	$logger = new Logger();

	switch($_REQUEST["type"]){
		case "js": #js logger
			$logger->js_error($_REQUEST);

		default:
			$logger->general_log($_REQUEST);
			$res = notify_error_log();
			send_json(array("msg"=> "logged error"));
			break;
			#general logger
	}
?>