<?php
	require("../utils/core.php");
	require("../utils/db_prepared.php");

	// var_dump($_FILES);
	send_json(array("files", count($_POST)));

	die();

	class test_db extends db_prepared{


		function login(){
			$query = "SELECT * FROM toursites";


			$this->prepare($query);


			// $sql = mysqli_prepare($this->db,$query);
			return $this->db_fetch_all();
		}

	}

	$class = new test_db();
	$results = $class->login();
	var_dump($results);

	// echo generate_id();
	// $_SESSION["val"] = NULL;
	// var_dump($_SESSION);
	// log_in_session_user("");
	// var_dump($_SESSION);
?>