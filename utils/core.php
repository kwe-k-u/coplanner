<?php
	require_once(__DIR__. "/http_handler.php");
	require_once(__DIR__."/env_manager.php");
	require_once(__DIR__."/google_auth.php");

//start session
// if session isn't started then start session


//for header redirection
//if header redirection isn't started then start header redirection
if (ob_get_length() == 0){
	ob_start();
	// if (session_status() == PHP_SESSION_NONE){

	// 	session_start();
	// }
}

if (session_status() == PHP_SESSION_NONE){
	session_start();
}



	/*** RATES */
	CONST TOURISM_LEVY = 0.0;
	const VAT_RATE = 0;
	const DOLLAR_RATE =11.5;



	/**Signs in user accounts */
	function session_log_in($user_id){
		$_SESSION["user_id"] = $user_id;
		// $_SESSION["user_role"] = $role; //admin or user
	}

	function get_default_profile_img(){
		return server_base_url()."assets/images/others/profile.jpeg";
	}

	/**Logs in users with special access */
	function session_log_in_advanced($user_id,$user_role,$account_id){
		session_log_in($user_id,$user_role);

		$_SESSION["account_id"] = $account_id;
	}



	/**Logs out all user types */
	function session_log_out(){
		unset($_SESSION["user_id"]);
		// unset($_SESSION["user_role"]);

		// if the account is a special user (admin, curator, etc) clear those credentials
		if(isset($_SESSION["account_id"])){
			unset($_SESSION["account_id"]);
			// unset($_SESSION["account_type"]);
		}

	}

	function login_check(){
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
		|| $_SERVER['SERVER_PORT'] == 443)
		? "https://" : "http://";
		$redirect = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		if (!is_session_logged_in()){
			header("Location: ../login.php?redirect_url=$redirect");
			die();
		}
	}

	/**Allows the admin to sign into another user's account */
	function admin_log_in_as($user_id, $role, $account_id = null){
		$_SESSION["admin_user_id"] = $_SESSION["user_id"];
		$_SESSION["user_id"] = $user_id;
		$_SESSION["user_role"] = $role;

		if ($account_id){
			$_SESSION["account_id"] = $account_id;
		}
	}


	/**Signs the admin out of the user (s)he is signed into */
	function admin_log_out_as(){
		$_SESSION["user_id"] = $_SESSION["admin_user_id"];
		$_SESSION["user_role"] = "admin";

		unset($_SESSION["admin_user_id"]);

		if(isset($_SESSION["account_id"])){
			unset($_SESSION["account_id"]);
		}
	}


	/**Checks if the current user is an admin */
	function is_session_user_admin(){
		require_once(__DIR__."/../controllers/admin_controller.php");
		$user_id = get_session_user_id();
		return get_admin_privilege($user_id) == true;
	}

	/**Checks if there is a logged in session user */
	function is_session_user_curator(){
		require_once(__DIR__."/../controllers/public_controller.php");
		$user_id = get_session_user_id();
		return get_curator_account_by_user_id($user_id) == true;
	}


	function get_session_user_id(){
		if(isset($_SESSION["user_id"])){
			return $_SESSION["user_id"];
		}
		return false;
	}


	/**Returns an appropriate greeting based on time. eg Good Afternoon */
	function greet(){
		$hour      = date('H');

		if ($hour > 17) {
		return "Good evening";
		} elseif ($hour > 11) {
			return "Good afternoon";
		} elseif ($hour < 12) {
		return "Good morning";
		}

	}

	// /**Returns the type of entity account a user has (curator, etc). Returns false if none exists*/
	// function get_session_account_type(){
	// 	if(isset($_SESSION["account"])){
	// 		return $_SESSION["account_type"];
	// 	}
	// 	return false;
	// }

	/**Returns the account id that the user has access to. Returns false if none exists */
	function get_session_account_id(){
		if(isset($_SESSION["account_id"])){
			return $_SESSION["account_id"];
		}
		return false;
	}


	function is_session_logged_in(){
		return isset($_SESSION["user_id"]);
	}





	//========================== helpful functions ==========================

	function encrypt(string $string){
		return md5($string );
	}

	function shorten($string, $max_char = 256){
		return mb_strimwidth($string,0,$max_char,"...");
	}


	function get_current_date(){
		return date("Y-m-d HH:mm");
	}

	function format_string_as_date_fn($date_str){
		return (new DateTime($date_str))->format('d D M Y');
	}

	function format_string_as_time_fn($string){
		return (new DateTime($string))->format('h:m A');
	}

	function format_string_as_currency_fn($string){
		return number_format((float)$string,2,"."," ");
	}

	function generate_id(){
		return encrypt(get_current_date().time() . random_bytes((55)));
	}

	function upload_file($directory,$subdir,$tempname,$image){
		//check if the directory exists
		//Then upload the file into the directory
		$temp_id = generate_id();
		$ext = explode(".",$image); //file extension
		$ext = $ext[count($ext)-1]; //file extension
		$form_name = $temp_id.'.'. $ext;
		$folder = "$directory/$subdir/".$form_name;

		//create folder if it does not exist
		if (!file_exists("../$directory/$subdir/")){
			mkdir("../$directory/$subdir/",0777);
			move_uploaded_file($tempname,"../".$folder);
			return server_base_url().$folder;
		}
		else{
			move_uploaded_file($tempname,"../".$folder);
			return server_base_url().$folder;
		}
		return false;

	}

	function get_file_type($filename){
		switch(pathinfo($filename,PATHINFO_EXTENSION)){
			// Images
			case "jpg":
			case "jpeg":
			case "png":
				$type = "picture";
				break;
			// Documents
			case "doc":
			case "docx":
			case "pdf":
				$type = "doc";
			// Videos TODO:: add videos
			default:
				$type = "";
		}
		return $type;
	}


	function send_json($data, $response = 200){
		echo json_encode(array(
			"data" => $data,
			"status"=> $response)
		);
	}

	// an image randomizer for itineraries
	function suggest_image(){
		$num = random_int(0,12);
		return "$num.jpg";
	}



?>