<?php
	require_once(__DIR__."/../utils/core.php");
	$user_id = get_session_user_id();
	echo $user_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>test - booking</title>
</head>
<body>
	<?php echo "<form id='booking_form'>"; ?>
		<input type="hidden" name="mode">
	<h4>Personal information</h4>
		<label >Emergency contact name</label>
		<input type="text" name="contact_name"><br>

		<label>Emergency contact number</label>
		<input type="text" name="contact_number"><br>

		<label>Seats</label>
		<input type="number" name="seats"><br>

		<h4>Payment information</h4>
		<h5>Pay with momo</h5>
		<label >Number</label>
		<input type="tel" name="number"><br>
		<label>Network</label>
		<select name="network">
			<option value="AirtelTigo">AirtelTigo</option>
			<option value="Mtn">Mtn</option>
			<option value="Vodafone">Vodafone</option>
		</select><br>
		<!-- <button type="submit" onclick="pay_mobile_money(this)">Book with momo</button> -->
		<!-- <input type="submit" name="payment_option" value="momo"> -->
		<!-- <button onclick="pay('momo')">Pay with Momo</button> -->

		<?php echo "<button onclick=\"pay('momo', '$user_id')\">Pay with Mobile money</button>"; ?>
		<br>
		<h5>Pay with Credit card</h5>

		<label>First name</label>
		<input type="text" name="card_first_name"><br>
		<label>First name</label>
		<input type="text" name="card_last_name"><br>

		<label>Select country</label>
		<select name="card_country">
			<?php
			$country_code = json_decode(
				file_get_contents("http://country.io/names.json")
			, true);

			sort($country_code);

			foreach ($country_code as $code => $country) {
				echo "<option value='$code'>$country</option>";
			}

			?>
		</select><br>


		<!-- <button onclick="pay('card')">Pay with card</button> -->
		<?php
			echo "<button>Pay with card<\button>";
			// echo "<button onclick=\"pay('card','$user_id')\">Pay with card<\button>";
		?>
		<button></button>
	</form>
</body>
<script>

	function pay(option,user_id){

		var form = document.getElementById("booking_form");
		form.mode.value = option;
		form.submit()
	}


	function on_booking_submit(form,user_id){
		event.preventDefault();
		// alert(form.mode.value);
		payload = "action=trip_payment";
		payload += "&tour_id=" + url_params("tour_id");
		payload += "&payment_method=" + form.mode.value;
		payload += "&user_id="+user_id;
		payload += "&seats="+form.seats.value;
		payload += "&contact_name="+form.contact_name.value;
		payload += "&contact_number="+form.contact_number.value;
		if (form.mode.value =="card"){//attach card details
			payload += "&card_number=" + form.card_number.value;
			payload += "&card_first_name=" + form.card_first_name.value;
			payload += "&card_last_name=" + form.card_last_name.value;
			payload += "&card_expiry=" + form.card_expiry.value;
			payload += "&card_cvc=" + form.card_cvc.value;
			payload += "&card_city=" + form.card_city.value;
			payload += "&card_state=" + form.card_state.value;
			payload += "&card_zip=" + form.card_zip.value;
			payload += "&card_email=" + form.card_email.value;
			payload += "&card_country=" + form.card_country.value;

		}else { //attach mobile money details
			payload += "&number=" + form.number.value;
			payload += "&network=" + form.network.value;

		}
		//send request
		//initiate 10 second delay to prevent multiple request send

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
</html>