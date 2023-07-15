<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../controllers/admin_controller.php");



	// var_dump($_SERVER["PATH_INFO"]);
	// die();
	switch($_SERVER["PATH_INFO"]){
		case "/get_location_info":
			$id = $_GET["id"];
			$result = get_location_info($id);
			send_json( $result);
			die();
		case "/toggle_location_verification":
			$id= $_POST["toursite_id"];
			$res = toggle_location_verification($id);
			send_json($res);
			die();
		default:
			echo "No action";
	}
?>