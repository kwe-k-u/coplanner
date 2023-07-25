<?php
	require_once("old_db.php");
	require_once(__DIR__.'/../utils/env_manager.php');
	require_once(__DIR__.'/../utils/core.php');

	$new = new prepared(db_server(),db_username(),db_pass(),db_name());
	$old = new prepared(db_server(),db_username(),db_pass(),'easygo');


	#Transfer users
	$sql = "SELECT * FROM USERS where account_status != 'pending' or account_status != 'suspended'";

	$old->prepare($sql);
	$users = $old->db_fetch_all();

	foreach ($users as $entry) {

		try{
			#create user accounts
			$new->prepare("INSERT INTO `users`(`user_id`, `user_name`, `email`, `password`, `phone_number`, `country`, `account_status`, `date_created`)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			$new->bind($entry["user_id"],$entry["user_name"],$entry["email"],$entry["password"],$entry["user_phone"],$entry["user_country"],$entry["account_status"],$entry["date_created"]);
			$new->db_query();
			#record user logins
			$new->prepare("INSERT INTO login_log (user_id,login_date) values (?,?)");
			$new->bind($entry["user_id"],$entry["last_login"]);
			$new->db_query();
		} catch  (Exception $e){
			echo $e."\n";
			echo "Account creation failed for ". $entry["email"]."\n";
		}

	}




	// Create curator accounts
	$old->prepare("SELECT * FROM curator_information");
	$curators = $old->db_fetch_all();
	foreach ($curators as $entry){
		$curator_id = generate_id();
		try{
			$new->prepare("INSERT INTO curators(`curator_id`, `curator_name`, `country`)
			VALUES (?,?,?)");
			$new->bind($curator_id, $entry['curator_name'] , $entry["country"]);
			$new->db_query();

		} catch (Exception $e){
			echo $e."\n";
			echo "Curator account creation failed for ".""."\n";
		}
		// Create invites for each manager
		try{
			$new->prepare("select * from users where user_id = ?");
			$new->bind($entry["owner_id"]);
			$email = $new->db_fetch_one()["email"];
			$new->prepare("INSERT INTO curator_manager_invite(`curator_id`, `email_address`, `privilege`, `invite_expiry`)
			VALUES (?, ?, ?, ? )");
			$date = date("Y-m-d",strtotime("+1 week"));
			$new->bind($curator_id,$email,"admin",$date);
		} catch(Exception $e){
			echo $e."\n";
			echo "Couldn't send invite for ". $entry["curator_name"]."\n";
		}
	}

	// Check number of curators and compare to new number of curators
	$new->prepare("SELECT count(*) from curators AS num");
	$new_count = $new->db_fetch_one()["number"];
	$old->prepare("SELECT count(*) from curator_information AS num");
	$old_count = $new->db_fetch_one()["num"];

	var_dump($new_count == $old_count);
	echo $new_count == $old_count ?"Count the same for curators\n" : "Different count for curators\n";

	// Check number of old users and compare to new number of users;
	$new->prepare("SELECT count(*) from users AS num");
	$new_count = $new->db_fetch_one()["number"];
	$old->prepare("SELECT count(*) from users AS num");
	$old_count = $new->db_fetch_one()["num"];

	var_dump($new_count == $old_count);
	echo $new_count == $old_count ?"Count the same for users\n" : "Different count for users\n";

	echo "complete";

	#Transfer

?>