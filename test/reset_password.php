<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test -reset password</title>
</head>
<body>
<label for="">New Pasword</label>
<form action="" onsubmit="reset_password(this)">
	<input type="password" name="password"><br>
	<button type="submit">Reset password</button>
</form>

<script>

	function reset_password(form){
		event.preventDefault();
		var password = form.password.value;
		var token = url_params("token");

		payload = "action=change_password";
		payload += "&token="+token;
		payload += "&password="+password;

		send_request(
			"POST",
			"../processors/processor.php",
			payload,
			(response)=>{
				alert(response);
			}
		)
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