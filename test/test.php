<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../controllers/public_controller.php");

	$result = is_session_user_admin();
	var_dump($result);

?>