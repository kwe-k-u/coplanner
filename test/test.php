<?php
	require("../utils/core.php");
	require("../utils/db_prepared.php");

	class test_db extends db_prepared{


		function login($email,$password){
			$query = "INSERT INTO `tesat` VALUE(?,?)";


			$this->prepare($query);

			$this->bind($email,$password);

			// $sql = mysqli_prepare($this->db,$query);
			return $this->db_query();
		}

	}

	$class = new test_db();
	var_dump($results);

	// echo generate_id();
	// $_SESSION["val"] = NULL;
	// var_dump($_SESSION);
	// log_in_session_user("");
	// var_dump($_SESSION);
?>