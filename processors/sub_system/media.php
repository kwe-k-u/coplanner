<?php

	require_once(__DIR__. "/../../controllers/media_controller.php");
	require_once(__DIR__."/../../utils/core.php");

	function media(){
		$request = $_SERVER["REQUEST_METHOD"];

		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "upload_media":

					$images = $_FILES;
					//accepted values (picture,video,document,confidential)
					$media_type = $_POST["media_type"];

					foreach ($images as $entry) {
						$image = $entry["name"];
						$tmp = $entry["tmp_name"];
						$id = generate_id();
						//Upload media to server
						$location = upload_file("uploads",$media_type,$tmp,$image);

						//Record the data
						if(isset($_POST["curator_id"])){
							 upload_curator_media_ctrl($id,$_POST["curator_id"],$location,$media_type);
						}else if (isset($_POST["user_id"])){
							upload_user_media_ctrl($id, $_POST["user_id"], $location, $media_type);
						}else {
							send_json(array("msg"=>"No uploader id provided"),100);
							die();
						}

						if ($media_type == "confidential"){
							//TODO:: notify confidentiality
						}
						send_json(array("media_id"=> $id));
					}


					die();
				case "link_curator_manager_id":
					$user_id = $_POST["user_id"];
					$id_front = $_POST["front_id"];
					$id_back = $_POST["back_id"];


					$status = link_curator_id($user_id,$id_front,$id_back);

					// send_json(array("status" => $status ), $status ? 200 : 100);
					send_json(array("status" => $status ? "Success" : "Failed"), $status ? 200 : 100);
					die();
					case "update_curator_logo":
						$curator_id = $_POST["curator_id"];
						$media_id = $_POST["media_id"];
						$status = update_curator_logo($curator_id,$media_id);
						send_json(array("status" => $status ? "Success" : "Failed"), $status ? 200 : 100);
						die();
					case "update_user_profile_image":
						$user_id = $_POST["user_id"];
						$media_id = $_POST["media_id"];
						$status = update_profile_image($user_id,$media_id);
						send_json(array("status" => $status ? "Success" : "Failed"), $status ? 200 : 100);
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

	media();
