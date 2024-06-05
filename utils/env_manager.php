<?php

require_once (__DIR__."/../vendor/autoload.php");

// use Dotenv\Dotenv;

// $dotenv = (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


/**Returns a boolean to indicate whether the current environ
 * is on localhost or on the remove server
 * true => remove server
 * false => localhost
 */
function is_env_remote(){
	return $_ENV["SERVER"] == "REMOTE";
}

/**Returns the databse name for the current environment */
function db_name(){
	return $_ENV["DB_NAME"];
	return getenv("DB_NAME");
}

/**Returns the databse username for the current environment */
function db_username(){
	return $_ENV["DB_USERNAME"];
	return getenv("DB_USERNAME");
}

/**Returns the databse password for the current environment */
function db_pass(){
	return $_ENV["DB_PASSWORD"];
	return getenv("DB_PASSWORD");
}

/**Returns the baseurl for the server */
function server_base_url(){
	return $_ENV["SERVER_BASE_URL"];
	return getenv("SERVER_BASE_URL");
}

/**Returns the databse server for the current environment */
function db_server(){
	return $_ENV["DB_SERVER"];
	return getenv("DB_SERVER");
}

/**Returns the app username for triggered mails */
function email_username(){
	return $_ENV["EMAIL_USERNAME"];
	return getenv("EMAIL_USERNAME");
}

/**Returns the app password for triggered mails */
function email_password(){
	return $_ENV["EMAIL_PASSWORD"];
	return getenv("EMAIL_PASSWORD");
}

function slack_webhook_support(){
	return $_ENV["SLACK_WEBSITE_SUPPORT_URL"];
	return getenv("SLACK_WEBSITE_SUPPORT_URL");
}


function slack_webhook_error_logs(){
	return $_ENV["SLACK_WEBSITE_ERRORS_URL"];
	return getenv("SLACK_WEBSITE_ERRORS_URL");
}

function slack_webhook_user_logs(){
	return $_ENV["SLACK_WEBSITE_USER_LOGS_URL"];
	return getenv("SLACK_WEBSITE_USER_LOGS_URL");
}

function slack_webhook_transactions(){
	return $_ENV["SLACK_WEBSITE_TRANSACTIONS_URL"];
	return getenv("SLACK_WEBSITE_TRANSACTIONS_URL");
}

function slack_webhook_info_log(){
	return $_ENV["SLACK_WEBHOOK_INFO_LOG_URL"];
	return getenv("SLACK_WEBHOOK_INFO_LOG_URL");
}

function paystack_public_key(){
	return $_ENV["PAYSTACK_PUBLIC_KEY"];
}

function paystack_private_key(){
	return $_ENV["PAYSTACK_PRIVATE_KEY"];
}

function google_client_id(){
	return $_ENV["GOOGLE_CLIENT_ID"];
}

function google_client_secret(){
	return $_ENV["GOOGLE_CLIENT_SECRET"];
}

function google_redirect_url(){
	return $_ENV["GOOGLE_REDIRECT_URI"];
}

function mixpanel_token(){
	return $_ENV["MIXPANEL_TOKEN"];
}

function whatsapp_token(){
	return $_ENV["WHATSAPP_TOKEN"];
}
function whatsapp_phone_id(){
	return $_ENV["WHATSAPP_PHONE_ID"];
}


?>