<?php

	require_once(__DIR__. "/../../controllers/interaction_controller.php");
	require_once(__DIR__."/../../utils/core.php");

	function interaction(){
		$request = $_SERVER["REQUEST_METHOD"];

		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "follow_curator":
					$user_id = $_POST["user_id"];
					$curator_id = $_POST["curator_id"];
					follow_curator($user_id,$curator_id);
					die();
				case "unfollow_curator":
					$user_id = $_POST["user_id"];
					$curator_id = $_POST["curator_id"];
					unfollow_curator($user_id,$curator_id);
					die();
				case "add_campaign_wishlist":
					$user_id = $_POST["user_id"];
					$campaign_id = $_POST["campaign_id"];
					$s = add_campaign_wishlist($user_id,$campaign_id);
					echo $s;
					die();
				case "remove_campaign_wishlist":
					$user_id = $_POST["user_id"];
					$campaign_id = $_POST["campaign_id"];
					$s = remove_campaign_wishlist($user_id,$campaign_id);
					echo $s;
					die();
				default:
					echo "No implementation for <". $_POST["action"] .">";
				}
				die();


		}else{
			echo "unsupported method";
			die();
		}
		echo "EOF";
		die();
	}

	// interaction();
?>