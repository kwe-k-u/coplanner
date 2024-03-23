<?php


require_once(__DIR__."/../utils/env_manager.php");
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__."/../utils/google_auth.php");


// init configuration
// $clientID = '';
// $clientSecret = '';
// $redirectUri = 'http://localhost/coplanner/test/test.php';

$google_auth = new GoogleAuthHandler(google_client_id(),google_client_secret(),google_redirect_url());

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
	$code = $_GET["code"];
	$result = $google_auth->get_user_data($code);
	var_dump($result);
	die();

  // now you can use this profile info to create account in your website and make user logged in.
} else {
	$login_url = $google_auth->generate_login_url();
  echo "<a href='$login_url'>Google Login</a>";
}
?>