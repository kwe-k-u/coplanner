<?php
	require_once(__DIR__. "/../utils/core.php");
	require_once(__DIR__. "/../controllers/private_tour_controller.php");

	$user_id = get_session_user_id();
	$curator_id = get_session_account_id();
	echo $curator_id."<br>";
	echo $user_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test - private trip</title>
</head>
<body>
	<h4>Create private trip</h4>
	<form action="" method="post" onsubmit="request_trip(this)">
		<label for="">Description of tour</label><br>
		<textarea name="description"  cols="30" rows="10"></textarea><br>

		<label for="">Currency</label>
		<select name="currency">
			<option value="GHS">GHS</option>
			<option value="USD">USD</option>
		</select><br>

		<label for="">Number of people</label>
		<input type="number" name="count"><br>

		<label for="">Budget Min</label>
		<input type="number" name="min_b"><br>

		<label for="">Budget max</label>
		<input type="number" name="max_b"><br>

		<label for="">Start date</label>
		<input type="date" name="start"><br>

		<label for="">End date</label>
		<input type="date" name="end"><br>

		<!-- //TODO get user id  -->
		<?php
			echo "<input type='hidden' name='user_id' value ='$user_id'>";
		?>


		<label for="">Publish</label>
		<select name="state" id="">
			<option value="publish">Publish</option>
			<option value="review">Review</option>
		</select><br>

		<button type="submit">Place request</button>


	</form>


	<h4>Quote for private trip</h4>
	<form action="" method="post" onsubmit="bid_private_trip(this)">
		<label for="">Requests</label>
		<select name="request_id" id="">
		<?php
			$requests = get_private_trip_requests();
			foreach ($requests as $req) {
				$id = $req["private_tour_id"];
				$currency = $req["currency"];
				$min = $req["min_budget"];
				$max = $req["max_budget"];
				echo "<option value='$id'>$currency $min - $currency $max</option>";
			}
		?>

		</select><br>

		<label for="">Comments</label>
		<input type="text" name="comment" ><br>

		<label for="">Fee</label>
		<input type="number" name="fee"><br>

		<?php
			echo "
			<input type='hidden' name='curator_id' value='$curator_id'>
			";
		?>
		<button type="submit">Submit</button>
	</form>




	<script>


	function request_trip(form){
		event.preventDefault();
		var desc = form.description.value;
		var currency = form.currency.value;
		var count = form.count.value;
		var min_b = form.min_b.value;
		var max_b = form.max_b.value;
		var state = form.state.value;
		var user_id = form.user_id.value;
		var start_date = form.start.value;
		var end_date = form.end.value;

		var payload = "action=request_private_tour";
		payload += "&user_id=" + user_id;
		payload += "&currency=" + currency;
		payload += "&max_budget=" + max_b;
		payload += "&min_budget=" + min_b;
		payload += "&description=" + desc;
		payload += "&start_date=" + start_date;
		payload += "&end_date=" + end_date;
		payload += "&state=" + state;
		payload += "&person_count=" + count;

		send_request(
			 "POST",
			 "../processors/processor.php",
			 payload,
			 (response) =>{
				alert(response);
			 }
		);

	}


	function bid_private_trip(form){
		event.preventDefault();

		var request_id = form.request_id.value;
		var comment = form.comment.value;
		var fee = form.fee.value;
		var curator = form.curator_id.value;

		payload = "action=bid_private_trip";
		payload += "&request_id=" + request_id;
		payload += "&comment=" + comment;
		payload += "&fee="+fee;
		payload += "&curator_id="+curator;

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