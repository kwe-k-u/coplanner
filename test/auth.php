<?php
	require_once(__DIR__. "/../utils/core.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>easyGo 2 test - auth</title>
</head>
<body>
	<?php
	if (is_session_logged_in()){
		echo "logged in";
		var_dump($_SESSION);
		echo "<button onclick='return logout()'>logout</button>";
	}
	?>
<h4>Login</h4>
	<form action="" method="post" onsubmit="return login(this)">
		<input type="email" name="email">
		<input type="password" id="password">
		<button type="submit">Submit</button>
	</form>
<br>
<h4>Signup - normal</h4>
	<form action="" method="post" onsubmit="return signup(this)">
		<label for="">email</label>
		<input type="email" name="email"><br>
		<label for="">username</label>
		<input type="text" name="user_name"><br>
		<label for="">password</label>
		<input type="password" name="password"><br>
		<label for="">confirm password</label>
		<input type="password" name="c_password"><br>
		<label for="">Number</label>
		<input type="text" name="phone_number"><br>
		<label for="">country</label>
		<input type="text" name="country"><br>
		<label for="">image</label>
		<input type="text" name="profile_img"><br>
		<button type="submit">Submit</button>
	</form>

<h4>Signup - curator</h4>
	<form action=""  method="post" onsubmit="return signup(this)">
		<label for="">email</label>
		<input type="hidden" name="type" value="curator">

		<input type="email" name="email"><br>
		<label for="">username</label>
		<input type="text" name="user_name"><br>
		<label for="">password</label>
		<input type="password" name="password"><br>
		<label for="">confirm password</label>
		<input type="password" name="c_password"><br>
		<label for="">Number</label>
		<input type="text" name="phone_number"><br>
		<label for="">country</label>
		<input type="text" name="country"><br>
		<label for="">image</label>
		<input type="text" name="profile_img"><br>
		<label for="">curator name</label>
		<input type="text" name="curator_name"><br>
		<button type="submit">Submit</button>
	</form>


	<script>

		function login(form){
			event.preventDefault();
			// alert(form.y.value);
			send_request("POST","../processors/processor.php",
				"action=login" +
				"&email="+ form.email.value +
				"&password=" + form.password.value,

			  (response)=>{
				// alert(response);
				callback_url = url_params("callback_url");
				if(!callback_url){ // if theres no redirect url
					alert(response);
				} else {
					window.location.replace(callback_url);
				}
			});

		}

		function signup(form){
			event.preventDefault();
			profile_image = upload_media(null);
			//TODO check if image upload was successful before proceeding

			payload = "action=signup" +
				"&email="+ form.email.value +
				"&user_name=" + form.user_name.value+
				"&password=" + form.password.value+
				"&phone_number=" + form.phone_number.value+
				"&country=" + form.country.value+
				"&profile_image=" + profile_image;

				if("type" in form){
					payload += "&type=" + form.type.value;
					payload += "&curator_logo=" + "form.curator_name.value";
					payload += "&curator_name=" + form.curator_name.value;
				}
			send_request(
				"POST",
				"../processors/processor.php",
				payload,
				//TODO upload imag
			  (response)=>{
				// alert(response);
				callback_url = url_params("callback_url");
				if(!callback_url){ // if theres no redirect url
					alert(response);
				} else {
					window.location.replace(callback_url);
				}
			});
		}

		function upload_media(image_name){
			return image_name;
		}




		function logout(){
			send_request(
				"POST",
				"../processors/processor.php",
				"action=logout",
				(response)=>{
					window.location.reload();
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