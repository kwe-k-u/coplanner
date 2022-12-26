<?php
	require_once(__DIR__. "/http_handler.php");
	require_once(__DIR__."/env_manager.php");

//start session
session_start();

//for header redirection
ob_start();




	/**Signs in user accounts */
	function session_log_in($user_id, $profile_img,$role){
		$_SESSION["user_id"] = $user_id;
		$_SESSION["profile_image"] = $profile_img;
		$_SESSION["user_role"] = $role; //admin or user
	}

	/**Logs in users with special access */
	function session_log_in_advanced($user_id,$profile_img,$user_role,$account_id){
		session_log_in($user_id,$profile_img,$user_role);

		$_SESSION["account_id"] = $account_id;
	}



	/**Logs out all user types */
	function session_log_out(){
		unset($_SESSION["user_id"]);
		unset($_SESSION["profile_img"]);
		unset($_SESSION["user_role"]);

		// if the account is a special user (admin, curator, etc) clear those credentials
		if(isset($_SESSION["account_id"])){
			unset($_SESSION["account_id"]);
			// unset($_SESSION["account_type"]);
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
		if (isset($_SESSION["user_role"])){

			return $_SESSION["user_role"] == "admin";
		}
		return false;
	}

	/**Checks if there is a logged in session user */
	function is_session_user_curator(){
		return isset($_SESSION["account_id"]);
	}


	function get_session_user_id(){
		if(isset($_SESSION["user_id"])){
			return $_SESSION["user_id"];
		}
		return false;
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


	function get_current_date(){
		return date("Y-m-d HH:mm");
	}

	function format_string_as_date_fn($date_str){
		return (new DateTime($date_str))->format('d M Y');
	}

	function generate_id(){
		return encrypt(get_current_date().time() . random_bytes((55)));
	}

	function upload_file($directory,$subdir,$tempname,$image){
		//check if the directory exists
		// echo "image $image";
		//Then upload the file into the directory
		$temp_id = generate_id();
		$ext = explode(".",$image); //file extension
		$ext = $ext[count($ext)-1]; //file extension
		$form_name = $temp_id.'.'. $ext;
		$folder = "../$directory/$subdir/".$form_name;

		//create folder if it does not exist
		if (!file_exists("../$directory/$subdir/")){
			mkdir("../$directory/$subdir/",0777);

			// echo("Folder created");
			move_uploaded_file($tempname,$folder);
			return $folder;
		}
		else{
			move_uploaded_file($tempname,$folder);
			return $folder;
		}
		return false;

	}


	function send_json($data, $response = 200){
		echo json_encode(array(
			"data" => $data,
			"status"=> $response)
		);
	}
?>