<?php
	require_once(__DIR__."/core.php");

	$base_url = server_base_url();
	$server_mode = is_env_remote() ? "true" : "false";
	$paystack_key = paystack_public_key();

	echo "
	<script>
		const baseurl = '$base_url';
		const server_mode = $server_mode;
		const paystack_public_key = '$paystack_key';
	</script>";
?>

