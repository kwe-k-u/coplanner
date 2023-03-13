<?php

session_start();
ob_start();

if (!($_SESSION["cus_encrypt"] == md5("main.easygo@gmail.com"))) {
	echo "credential verification failed. Try loggin in again";
	die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>easygo || Coplanner</title>
</head>

<body>

<div class="form-input">
	<form onsubmit="query_submit(this,'activity')">
		<label for="">Activity</label>
		<input type="text" name="text">
		<button type="submit">Add</button>
	</form>
	<div id="activity-list" class="grid"><span class="px-3 mx-1 py-1 rounded-border text-capitalize">Hiking</span><span class="px-3 mx-1 py-1 rounded-border text-capitalize">Dancing</span><span class="px-3 mx-1 py-1 rounded-border text-capitalize">Swimming</span><span class="px-3 mx-1 py-1 rounded-border text-capitalize">Running</span><span class="px-3 mx-1 py-1 rounded-border text-capitalize">Kayaking</span></div>
</div>

<div class="form-input">
	<form onsubmit="query_submit(this,'location')">
		<label for="">Location</label>
		<input type="text" name="text">
		<button type="submit">Add</button>
	</form>
	<div id="location-list" class="grid"><span class="px-3 mx-1 py-1 rounded-border text-capitalize">Accra</span><span class="px-3 mx-1 py-1 rounded-border text-capitalize">Botanical Garden</span></div>
</div>
<?php
	$email = $_SESSION["cus_email"];
	echo"<button onclick='generate_trip(\"$email\")'>Generate Trip</button>";
?>

<div class="col">
	<div id="prompt_message"></div>
</div>



	<script src="js/script.js">

	</script>

</body>

</html>