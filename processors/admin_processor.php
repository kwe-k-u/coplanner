<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../controllers/admin_controller.php");
	require_once(__DIR__."/../utils/http_handler.php");
	require_once(__DIR__."/../utils/mailer/mailer_class.php");



	switch($_SERVER["PATH_INFO"]){
		case "/get_location_info":
			$id = $_GET["id"];
			$result = get_location_info($id);
			send_json( $result);
			die();
		case "/toggle_location_verification":
			$id= $_POST["destination_id"];
			$res = toggle_location_verification($id);
			send_json($res);
			die();
		case "/insert_destination":
			$name = $_POST["destination_name"];
			$location = $_POST["destination_location"];
			$desc = $_POST["site_description"];
			$country = $_POST["country"];
			$activities =$_POST["activities"];
			$gps = $_POST["cordinates"];
			$phone = $_POST["owner_number"];
			$contact = $_POST["owner_name"];
			$site_id = generate_id();
			//check if location name exists,
			add_destination($site_id,$name,$desc,$location,$country,$phone,$contact,$gps);

			// Adding activities for the tour site
			foreach ($activities as $name){
				add_destination_activity($site_id,$name);
			}

			if($_POST["facebook"] != ""){
				add_destination_socials($site_id,"facebook",$_POST["facebook"]);
			}
			if($_POST["instagram"] != ""){
				add_destination_socials($site_id,"instagram",$_POST["instagram"]);
			}
			if($_POST["website"] != ""){
				add_destination_socials($site_id,"website",$_POST["website"]);
			}
			if($_POST["tiktok"] != ""){
				add_destination_socials($site_id,"tiktok",$_POST["tiktok"]);
			}




			//upload images for the destination
			foreach ($_FILES as $file) {
				$image =$file["name"][0];
				$tmp = $file["tmp_name"][0];
				$id = generate_id();
				$media_type = 'picture';
				// var_dump($tmp);
				// var_dump($image);

				$location = upload_file("uploads",$media_type,$tmp,$image);
				add_media($id, $location, $media_type);
				add_destination_media($site_id,$id,0);
			}

			// $num_files = count($_FILES);
			// $entry = $_FILES;
			// for ($i=0; $i < $num_files; $i++) {

			// 	$image = $entry["name"][$i];
			// 	$tmp = $entry["tmp_name"][$i];
			// 	$id = generate_id();
			// 	$media_type = 'picture';
			// 	$location = upload_file("uploads",$media_type,$tmp,$image);
			// 	upload_destination_media_ctrl($id,$site_id,$location,false);
			// }

			//link images from other websites if provided
			if(isset($_POST["external_images"])){
				$image_links = $_POST["external_images"];

				foreach ($image_links as $location) {
					// $location = $entry;
					$media_id = generate_id();
					add_media($media_id, $location, "picture");
					add_destination_media($site_id,$media_id,1);
				}
			}

			// if it does add the location
			send_json(array("msg" => "Added tour site"));
			die();
		case "/edit_destination":
			// var_dump($_POST);
			die();
			$name = $_POST["destination_name"];
			$id = $_POST["site_id"];
			$desc = $_POST["site_description"];
			$country = $_POST["country"];
			$owner_name = $_POST["owner_name"];
			$owner_number = $_POST["owner_number"];
			$insta = $_POST["instagram"];
			$tiktok = $_POST["tiktok"];
			$facebook = $_POST["facebook"];
			$website = $_POST["website"];

			//determine which activities have been dropped and which have been added
			$old_activities = get_location_activities($id);
			$add_activities = array();
			$remove_index = array();

			// var_dump($remove_activities[1]);
			// die();

			foreach ($_POST["activities"] as $key => $entry) {
				for ($i=0; $i < count($old_activities); $i++) {
					$act_name = $old_activities[$i]["activity_name"];
					if($act_name == $entry){
						array_push($remove_index,$i);
						break;
					}
				}
				//if activity isn't in the old activities add it
				// $key = array_search($entry, $remove_activities);
				// if (!$key){
				// 	array_push($add_activities, $entry);
				// }else {

				// 	unset($remove_activities[$key]);
				// }

				// check if remove activities has an array with that activityname
			}
			//TODO:: update activities
			//TODO:: update location information
			//TODO:: update images

			// var_dump($remove_activities);
			// var_dump($add_activities);



			die();
		case "/verify_curator_manager_id":
			$curator_id = $_POST["curator_id"];
			$action = $_POST["verify_action"] =="true";
			$success = verify_curator_manager_id($curator_id,$action);
			if($success){
				if($action){
					send_json(array("msg"=> "Curator account has been verified"));
				}else {
					send_json(array("msg"=> "Curator verification has been rejected"));
				}
			}else {
				send_json(array("msg"=> "Something went wrong please try again"));
			}
			die();
		case "/verify_curator_account":
			$curator_id = $_POST["curator_id"];
			$action = !(get_curator($curator_id)["is_verified"] == 1);

			$success = verify_curator_account($curator_id,$action);
			if($success){
				if($action){
					send_json(array("msg"=> "Curator account has been verified"));
				}else {
					send_json(array("msg"=> "Curator verification has been rejected"));
				}
			}else {
				send_json(array("msg"=> "Something went wrong please try again"));
			}
			die();

		case "/change_media":
			$media_id = $_POST["media_id"];
			$media = get_media($media_id);
			if(sizeof($_FILES) == 0){
				$location = $_POST["media"];
				$is_foreign = true;
			}else {
				$is_foreign = false;
				$file = $_FILES["media"];
				$image = $file["name"];
				$tmp = $file["tmp_name"];
				$location = upload_file("uploads",$media["media_type"],$tmp,$image);

			}
			$success = update_media_location($media_id,$location);
			if($success){
				send_json(array("msg" => "Media update successful"));
			}else {
				send_json(array("msg" => "something went wrong"),201);
			}
			die();
		case "/add_curator":
			$curator_id = generate_id();
			$curator_name = $_POST["name"];
			$country = $_POST["country"];
			$email = $_POST["email"];
			$privilege = $_POST["privilege"];

			if(get_curator_by_name($curator_name)){
				send_json(array("msg"=> "A curator exists with that name"));
			}else{
				add_curator($curator_id,$curator_name,$country);
				$http = new http_handler();
				$response = $http->post(server_base_url()."/processors/processor.php",
				array(
					"action"=>"invite_curator_collaborator",
					"email" => "$email",
					"curator_id" => "$curator_id",
					"privilege" => "$privilege"
			));
			send_json(
				array("msg"=>"curator_invite",
				"invite_response"=> $response)
			);
			}
			die();
		case "/send_email":
			$is_group = $_POST["type"] == "group";
			$subject = $_POST["subject"];
			$message = $_POST["message"];
			$recipient = $_POST["recipient"];

			if($is_group){
				// get group emails;
				$recipient = get_emails_from_group($recipient);
			}else{
				$recipient = explode(",",$recipient);
			}
			foreach ($recipient as $email) {
				$mailer = new mailer();
				// if(get_user_by_email($email)){
					$mailer->send_email($email,$subject,$message);
				// }
			}
			send_json(array("msg"=> "Emails scheduled"));
			die();
		default:
			echo "No action";
	}
?>