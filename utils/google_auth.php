


<?php
	require_once (__DIR__.'/../vendor/autoload.php');

	class GoogleAuthHandler{
		private $client = null;

		function __construct($clientID,$clientSecret,$redirectUri){
			$this->client = new Google_Client();
			$this->client->setClientId($clientID);
			$this->client->setClientSecret($clientSecret);
			$this->client->setRedirectUri($redirectUri);
			$this->client->addScope("email");
			$this->client->addScope("profile");
		}


		function generate_login_url(){
			return $this->client->createAuthUrl();
		}

		function get_user_data($code){
			$data = array();

			$token = $this->client->fetchAccessTokenWithAuthCode($code);
			$this->client->setAccessToken($token['access_token']);
			// get profile info
			$google_oauth = new Google_Service_Oauth2($this->client);
			$google_account_info = $google_oauth->userinfo->get();
			$data["email"] =  $google_account_info->email;
			$data["name"] =  $google_account_info->name;
			$data["id"] = $google_account_info->id;

			return $data;
		}
	}
?>