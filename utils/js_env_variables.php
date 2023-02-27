<?php
	require_once(__DIR__."/env_manager.php");

	$base_url = server_base_url();
	$server_mode = is_env_remote() ? "true" : "false";


	echo "
	<script>
		const baseurl = '$base_url';
		const server_mode = $server_mode;
	</script>";
?>