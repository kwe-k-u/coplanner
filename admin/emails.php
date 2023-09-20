<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/curator_interraction_controller.php");
require_once(__DIR__ . "/../controllers/admin_controller.php");

if (!is_session_logged_in()) {
	header("Location: ../views/home.php");
	die();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin || Emails</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
	<!-- ============================== -->
	<!-- main-wrapper [start] -->

	<div class="main-wrapper">

		<?php require_once(__DIR__ . "/../components/admin_navbar_mobile.php"); ?>
		<!-- ============================== -->
		<!-- dashboard content [start] -->
		<main class="dashboard-content">
			<?php require_once(__DIR__ . "/../components/admin_navbar_desktop.php"); ?>


			<div class="main-content px-3">

				<div class="border-1 border-bottom py-2">
					<p class="mt-4 mb-0">Send emails to users on the easyGo platform.</p>


				</div>
				<div class="row ">

					<div class="col-lg-6">

						<div class='location-listing py-4' id="site_result_div">
							<?php

							$destinations = array();

							$templates = glob(__DIR__ . "/../utils/mailer/messages/*");

							foreach ($templates as $entry) {
								$name = strrchr($entry, "/");
								echo "
						<div class='location-card border p-4 rounded my-3'>
							<div class='header d-flex justify-content-between'>
								<h1 class='easygo-fs-3'>$name</h1>
							</div>
							<div class='text-gray-1 easygo-fs-6'>
								<div class='time'>
									<span></span>
									&nbsp;
									&nbsp;
									<span>template</span>
								</div>
							</div>
							<div class='d-flex gap-2 pt-3'>
								<button class='btn border easygo-fs-5 py-1 px-4' onclick='preview_template(\"$name\")'>Preview</button>
								<button class='easygo-btn-1 easygo-fs-5 py-1 px-4' onclick='add_location_toggle(\"$name\")'>Select</button>
							</div>
						</div>";
							}

							?>
						</div>
					</div>
					<div class="col-lg-6">
						<form onsubmit="return send_email(this)">

							<div class="col">


								<div class="d-flex gap-2">

									<div class="form-input-field" id="individual_select">
										<input class="px-4 py-2 flex-grow-1" type="text" placeholder="main.easygo@gmail.com" name="recipient_individual">
										<small class="easygo-fs-5"> Send to 4 people</small>
									</div>
									<div class="form-input-field hide" id="group_select">
										<select name="recipient_group">
											<option value="admin">Admins</option>
											<option value="curator">Curators</option>
											<option value="all">Everyone</option>
											<option value="tourist">Tourists</option>
										</select>
										<small class="easygo-fs-5"> Send to 4 people</small>
									</div>

									<div class="form-input-field">
										<select name="receipient_type" onchange="toggle_receipients(this)">
											<option value="individual">Individual</option>
											<option value="group">Group</option>
										</select>
									</div>
									<div>
										<button class="btn easygo-btn-1 border px-4 py-2">Select</button>
									</div>
								</div>
									<div class="form-input-field" id="individual_select">
										<input class="px-4 py-2 flex-grow-1" type="text" placeholder="Email subject" name="subject">
									</div>

								<div class="form-input-field">
									<label class="text-gray-1 easygo-fs-4 ">Message</label>
									<!-- <input class="px-4 py-2 flex-grow-1" type="text" id="description" name="description"> -->
									<textarea name="message" id="message" class="px-4 py-2 flex-grow-1" cols="30" rows="10"></textarea>
								</div>
								<div>
									<button class="easygo-btn-1 mt-4 ms-auto easygo-fs-5" id="submit_loc_btn" name="loc_id" value="">Send Email</button>
								</div>

							</div>
						</form>

					</div>
				</div>

			</div>
		</main>
		<!-- dashboard-content [end] -->
		<!-- ============================== -->
	</div>
	<!-- main-wrapper [end] -->
	<!-- ============================== -->


	<!-- ============================== -->
	<!-- Bootstrap js -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!-- JQuery js -->
	<script src="../assets/js/jquery-3.6.1.min.js"></script>
	<!-- easygo js -->
	<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
	<script src="../assets/js/general.js"></script>
	<script src="../assets/js/functions.js"></script>
	<script src="../assets/js/admin/emails.js"></script>
</body>

</html>