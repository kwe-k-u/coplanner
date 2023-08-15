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
				case "toggle_curator_follow":
					if (is_session_logged_in()){
						$user_id = get_session_user_id();
						$curator_id = $_POST["curator_id"];
						if (is_user_following_curator($user_id,$curator_id)){
							unfollow_curator($user_id,$curator_id);
							send_json(
								array(
									"new_status" => false,
									"msg" => "curator has been unfollowed"
								),
							);
						}else{
							follow_curator($user_id,$curator_id);
							send_json(
								array(
									"new_status" => true,
									"msg" => "Curator is being followed"
								),
							);
						}
					}else{
						send_json(array("msg"=> "You need to be logged in"), 201);
					}
					die();
				// case "follow_curator":
				// 	$user_id = $_POST["user_id"];
				// 	$curator_id = $_POST["curator_id"];
				// 	follow_curator($user_id,$curator_id);
				// 	die();
				// case "unfollow_curator":
				// 	$user_id = $_POST["user_id"];
				// 	$curator_id = $_POST["curator_id"];
				// 	unfollow_curator($user_id,$curator_id);
				// 	die();
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

	interaction();
?>