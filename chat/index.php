<?php
if( $_SERVER['REQUEST_METHOD'] == "POST"){
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

	<div class="col">
		<p>Logo</p>
		<form method="post" onsubmit="login_submit(this)">
			<div class="col">

				<div class="form-input">
					<label for="name">Name:</label>
					<input type="text" name="name" value="Kweku">
				</div>
				<div class="form-input">
					<label for="">Email</label>
					<input type="email" name="email" value="kwekuaacquaye@gmail.com">
				</div>
				<div class="form-input">
					<label for="">Phone Number</label>
					<input type="text" name="number" value="0559582518">
				</div>
				<div class="form-input">
					<label for="">Institution</label>
					<input type="text" name="institution" value = "Ashesi University">
				</div>

				<button type="submit">Let's get started</button>
			</div>
		</form>
	</div>
	<script src="js/script.js">

	</script>
</body>

</html>