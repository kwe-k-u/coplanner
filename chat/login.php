<?php



	if(isset($_GET["token"])){
		require_once(__DIR__."/class/db_class.php");
		//if token is valid, remove from database and
		$db = new db_class();
		$ver = $db->verify_token($_GET["token"]);
		if($ver){
		//start session
		$db->remove_token($_GET["token"]);
		session_start();
		ob_start();


			$_SESSION["cus_encrypt"] = md5("main.easygo@gmail.com");
			$_SESSION["cus_email"] = $ver["email"];
			header("Location: chat.php");
		}

		//redirect to chat screen with session logged in
	}
	echo $text;
	// echo "Your login attempt failed. Kindly visit easygo.com.gh/chat";
	die();
?>