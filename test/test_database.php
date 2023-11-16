<?php
	require_once(__DIR__."/../controllers/public_controller.php");

	$result = signup_controller("email","test.user@gami","pass");
	var_dump($result);
?>