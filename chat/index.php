<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	var_dump($_POST);
	die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>easyGo || Co-planner</title>
</head>

<body>
	<link rel="stylesheet" href="./css/general.css">
	<link rel="stylesheet" href="./css/bootstrap.min.css">

	<div class="col">
		<div id="logo">
			<img src="./css/logo.png" alt="easyGo logo">
		</div>
		<div class="loader"></div>
		<form method="post" onsubmit="login_submit(this)">
			<div class="col">

				<div class="form-input-field" id="email_field">
					<label for="">Email</label><br>
					<input type="email" id="email_sec" name="email">
				</div>
				<div class="form-input-field" id="name_field">
					<label for="name">Name:</label><br>
					<input type="text" name="name">
				</div>
				<div class="form-input-field" id="number_field">
					<label for="">Phone Number</label><br>
					<input type="text" name="number">
				</div>
				<!-- <div class="form-input-field" id="name_field">
					<label for="">Institution</label><br>

						<input type="text" class="border-blue" name="institution" value = "Ashesi University">
				</div> -->

				<button type="submit" onclick="btn_click(this)" class="easygo-btn-1 btn-blue">Next</button>
			</div>
		</form>
	</div>

	<script src="js/script.js">
	</script>
	<script>
		var current = 1;
		var name_field = document.getElementById("name_field");
		var email_field = document.getElementById("email_field");
		var number_field = document.getElementById("number_field");
		var button
		window.onload = () => {
			show_field("email");
			current = 1;
		};

		function hide_fields() {
			name_field.style.display = "none";
			email_field.style.display = "none";
			number_field.style.display = "none";
		}


		async function check_email() {
			// var send_res = null;
			var email = document.getElementById("email_sec").value;
			show_loader();
			await send_request("POST",
				"process/processor.php", {
					"action": "check_email",
					"email": email
				}, (response) => {
					// alert(response);
					// return 1;
					if (response == 1) {
						alert("Welcome back! We have your email in our system and have sent you the login link there (Might take a minute or two). Thank you for trying the Beta");
					hide_loader();
						return 1;
					} else {

						show_field('name');
					current = 2;
					}

			hide_loader();
				}
			);
			// while (send_res = null) {
			// 	continue;
			// }
			// return send_res;
		}

		async function btn_click(element) {
			switch (current) {
				case 1:
					event.preventDefault();
					await check_email();
					break;
				case 2:
					show_field('number');
					element.innerText = "Let's Get Started!"
					current = 3;
					event.preventDefault();
					break;
				case 3:
					break;
				default:
					break;
			}
		}

		function show_field(id) {
			hide_fields();
			document.getElementById(id + "_field").style.display = "block";
		}
	</script>
</body>

</html>