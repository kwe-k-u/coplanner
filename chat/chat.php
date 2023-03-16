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
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">

	<div id="logo">
		<img src="css/logo.png" alt="easyGo logo" >
	</div>
<div class="form-input-field">
	<form onsubmit="query_submit(this,'activity')">
		<label for="">Activity</label><br>
		<input type="text" name="text">
		<button class="easygo-btn-2" type="submit">Add</button>
	</form>
	<div id="activity-list" class="grid-1">
		<span class="">Hiking</span><span class="">Dancing</span><span class="">Swimming</span><span class="">Running</span><span class="">Kayaking</span></div>
</div>

<div class="form-input-field">
	<form onsubmit="query_submit(this,'location')">
		<label for="">Location</label><br>
		<input type="text" name="text">
		<button class="easygo-btn-2"type="submit">Add</button>
	</form>
	<div id="location-list" class="grid">
		<span class="">Accra</span>
		<span class="">Botanical Garden</span>
	</div>
</div>
<?php
	$email = $_SESSION["cus_email"];
	echo"<button class='easygo-btn-1' onclick='generate_trip(\"$email\")'>Generate Trip</button>";
?>

<div class="col">
	<div id="prompt_message"></div>
</div>



	<script src="js/script.js">

	</script>

</body>

</html>