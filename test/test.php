<?php

var_dump($_REQUEST);
var_dump($_FILES);
die();
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__."/../utils/paystack.php");
require_once(__DIR__."/../controllers/auth_controller.php");
// $email=$_GET["email"];
$curator_id="791f40acb7ce8843d0894ba2f00731e9";
// $invite = get_curator_invite_by_email($email);
// $date = $invite["invite_date"];
// $curator_name = $invite["curator_name"];
$hash = encrypt(false.$curator_id);
echo $hash;

die();
$location = upload_file("uploads",$media_type,$tmp,$image);
var_dump($location);
$location = upload_file("/var/www/html/easygo_v2/uploads",$media_type,$tmp,$image);
var_dump($location);
foreach ($_FILES as $file) {
	$image =$file["name"][0];
	$tmp = $file["tmp_name"][0];
	$id = generate_id();
	$media_type = 'picture';
	// var_dump($tmp);
	// var_dump($image);

	$location = upload_file("uploads",$media_type,$tmp,$image);
	var_dump($location);
}
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