<?php
	require_once("../utils/core.php");
	require_once("../controllers/interaction_controller.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test - trips</title>


</head>
<body>
	<h4>Create a campaign</h4>
	<form action="" method="post" onsubmit="create_campaign(this)">
		<label for="">Title</label>
		<input type="text" name="title"><br>
		<label for="">Description</label>
		<input type="text" name="description"><br>
		<?php
			$curator_id = get_session_account_id();
			echo "<input type='hidden' name='curator_id' value='$curator_id'>"
		?>

		<h5>Campaign trips</h5>
		<label>Pickup location</label>
		<input type="text" name="pickup_location" ><br>
		<label>dropoff location</label>
		<input type="text" name="dropoff_location" ><br>
		<label>seats</label>
		<input type="number" name="seats" ><br>
		<label>fee</label>
		<input type="number" name="fee" ><br>
		<label>start date</label>
		<input type="date" name="start_date" ><br>
		<label>end date</label>
		<input type="date" name="end_date" ><br>

		<button type="submit">submit</button>
	</form>


	<h3>Add a Tour site</h3>
	<form action="" onsubmit="add_site(this)">
		<label for="">Name</label>
		<input type="text" name="name" ><br>
		<label for="">Location (Particular city, or township)</label>
		<input type="text" name="location" ><br>
		<label for="">Country</label>
		<input type="text" name="country" ><br>
		<label for="">Activities (separated by ',')</label>
		<input type="text" name="activities" ><br>
		<button type="submit">Submit</button>

	</form>


	<h3>Trips</h3>
	<ol>

		<?php
		$trips = get_all_campaigns();

		foreach ($trips as $trip) {
			$trip_name = $trip["title"];
			$campaign_id = $trip["campaign_id"];
			echo "<li>".$trip_name. "</li>";
			echo "<ul>";
			$occurances = get_campaign_tours($campaign_id);
			foreach ($occurances as $occurance) {
				$start = format_string_as_date_fn($occurance["start_date"]);
				$currency = $occurance["currency"];
				$o_id = $occurance["tour_id"];
				$fee = $occurance["fee"];
				echo "<li>".$start. " - ". $currency. $fee;
				echo "<a href='booking.php?campaign_id=$campaign_id&tour_id=$o_id'>Book</a>
				</li>";
			}
			echo "</ul>";
		}
		?>
	</ol>



<script>



	function create_campaign(form){
		event.preventDefault();


		// alert(JSON.stringify(te));
		payload = "action=create_campaign";
		payload += "&title=" + form.title.value;
		payload += "&description=" + form.description.value;
		payload += "&curator_id=" + form.curator_id.value;
		payload += "&trips=" + parse_trips(form)

		send_request("POST",
			"../processors/processor.php",
			payload,
			(response)=>{
				alert(response);
			}
		 );


	}

	function parse_trips(form){
		//TODO add states for each trip
		var data = {
			"count" : 1,
			0 : {
				"start_date" : form.start_date.value,
				"end_date" : form.end_date.value,
				"seats" : form.seats.value,
				"fee" : form.fee.value,
				"pickup_location" : form.pickup_location.value,
				"dropoff_location" : form.dropoff_location.value,
			}
		}

		return JSON.stringify(data);
	}


	function add_site(form){
		event.preventDefault();

		var payload = "action=add_site";
		payload += "&name=" + form.name.value;
		payload += "&location=" + form.location.value;
		payload += "&country=" + form.country.value;
		payload += "&activities=" + form.activities.value;


		send_request(
			"POST",
			"../processors/processor.php",
			payload,
			(response)=>{
				alert(response);
			}
		);


	}


	function send_request(type, endpoint, data, onFinish){
		const xhttp = new XMLHttpRequest();
		xhttp.open(type, endpoint);
		xhttp.onreadystatechange = function (){
			if (xhttp.readyState == XMLHttpRequest.DONE){
				onFinish(xhttp.response);
			}
		}
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(data);
	}



	function url_params(key){
		url = window.location.search.substr(1);
		params = url.split("&");
		params.forEach(element => {
			pair = element.split("=");
			element_key = pair[0];
			if(element_key= key){
				value = pair[1];
			}
		});

		return value;
	}

</script>
</body>

</html>



