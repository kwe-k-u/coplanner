<?php

require_once (__DIR__."/../vendor/autoload.php");


$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();


/**Returns a boolean to indicate whether the current environ
 * is on localhost or on the remove server
 * true => remove server
 * false => localhost
 */
function is_env_remote(){
	return getenv("SERVER") == "REMOTE";
}

/**Returns the databse name for the current environment */
function db_name(){
	return getenv("DB_NAME");
}

/**Returns the databse username for the current environment */
function db_username(){
	return getenv("DB_USERNAME");
}

/**Returns the databse password for the current environment */
function db_pass(){
	return getenv("DB_PASSWORD");
}

/**Returns the baseurl for the server */
function server_base_url(){
	return getenv("SERVER_BASE_URL");
}

/**Returns the databse server for the current environment */
function db_server(){
	return getenv("DB_SERVER");
}

/**Returns the app username for triggered mails */
function email_username(){
	return getenv("EMAIL_USERNAME");
}

/**Returns the app password for triggered mails */
function email_password(){
	return getenv("EMAIL_PASSWORD");
}

function slack_webhook_support(){
	return getenv("SLACK_WEBSITE_SUPPORT_URL");
}

// /** [::Deprecated::]Returns the url for webhook of slack channel - Platform-monitoring */
// function slack_webhook_monitoring(){
// 	return getenv("SLACK_PLATFORM_MONITORING_URL");
// }

// /** [::Deprecated::]Returns the url for webhook of slack channel - Platform-monitoring-claims */
// function slack_webhook_claims(){
// 	return getenv("SLACK_PLATFORM_MONITORING_CLAIMS_URL");
// }

// /**
//  * [::Deprecated::]Returns the url for webhook of slack channel - platform-monitoring-logs
//  */
// function slack_webhook_logs(){
// 	return getenv("SLACK_PLATFORM_MONITORING_LOGS_URL");
// }

// /** [::Deprecated::] Returns the url for webhook of slack channel - Platform-monitoring-withdrawals */
// function slack_webhook_withdrawals(){
// 	return getenv("SLACK_PLATFORM_MONITORING_WITHDRAWALS_URL");
// }

function slack_webhook_cron_logs(){
	return getenv("SLACK_WEBSITE_CRON_TASKS_URL");
}

function slack_webhook_curator_logs(){
	return getenv("SLACK_WEBSITE_CURATORS_LOG_URL");
}

function slack_webhook_error_logs(){
	return getenv("SLACK_WEBSITE_ERRORS_URL");
}

function slack_webhook_private_tour_logs(){
	return getenv("SLACK_WEBSITE_PRIVATE_TOUR_LOGS_URL");
}

function slack_webhook_tourist_logs(){
	return getenv("SLACK_WEBSITE_TOURIST_LOGS_URL");
}

function slack_webhook_transactions(){
	return getenv("SLACK_WEBSITE_TRANSACTIONS_URL");
}

/**Returns the paybox token */
function paybox_token(){
	return getenv("PAYBOX_BEARER_TOKEN");
}

/**Returns the paystack public key */
function paystack_public_key(){
	return getenv("PAYSTACK_PUBLIC_KEY");
}

/** Returns the paystack private key */
function paystack_private_key(){
	return getenv("PAYSTACK_SECRET_KEY");
}
?>