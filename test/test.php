<?php
	require("../utils/core.php");

	function first(){
		echo "first ";
		return 1;
	}

	function second(){
		echo "second";
		return 1;
	}

	function run(){
		return first() && second();
	}

	run();


	// echo generate_id();
	// $_SESSION["val"] = NULL;
	// var_dump($_SESSION);
	// log_in_session_user("");
	// var_dump($_SESSION);
?>