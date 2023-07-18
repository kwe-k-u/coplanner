<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__."/../utils/paystack.php");
var_dump($_FILES);
var_dump($_POST);
// $pay = new paystack_custom();
// $e = $pay->verify_transaction($_GET["id"]);
// send_json($e);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="" method="post" onsubmit="return send(this)">
		<input type="file" name="images" id="images" multiple>
		<button type="submit">Submit</button>
	</form>
	<?php require_once("../utils/js_env_variables.php") ?>
	<script src="../assets/js/functions.js"></script>
	<script>
		function send(form){
			event.preventDefault();
			send_request("POST",
			"test/test.php",
			{},
			(response)=> {},
			form.images.files
			);
		}
	</script>

</body>
</html>