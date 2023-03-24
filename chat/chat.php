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
	<div class="easygo-badge-orange">
		Caution: This feature is in <span style='color:red'>beta</span>. Itinerary generated may included errors
		and wrong quotes. We do not guarantee the accuracy of generated itinerary and advise you speak to our
		human curators after you find an itinery that meets your needs
	</div>

	<div id="logo">
		<img src="css/logo.png" alt="easyGo logo" >
	</div>
	<p>Tell us the activities and locations you are interested in visiting</p>
	<p>Have nothing in mind? Just click generate😊</p>
	<div class="loader"></div>
<div class="form-input-field">
	<form onsubmit="query_submit(this,'activity')">
		<label for=""><strong>Activity</strong></label><br>
		<input type="text" name="text">
		<button class="easygo-btn-2" type="submit">Add</button>
	</form>
	<div id="activity-list" class="grid">
</div>

<div class="form-input-field">
	<form onsubmit="query_submit(this,'location')">
		<label for=""><strong>Location</strong></label><br>
		<input type="text" name="text">
		<button class="easygo-btn-2"type="submit">Add</button>
	</form>
	<div id="location-list" class="grid">
	</div>
</div>
<?php
	$email = $_SESSION["cus_email"];
	echo"<button class='easygo-btn-1' onclick='generate_trip(\"$email\")'>Generate Trip</button>";

echo "<div class='easygo-badge-blue' onclick='contact_curator(\"$email\")'>
		Do you like this itinerary? Click here to have our experienced curators refine it and give you
		accurate quotes.
	</div>"
?>


<div class="col">
	<div id="prompt_message"></div>
</div>



	<script src="js/script.js">

	</script>

</body>

</html>