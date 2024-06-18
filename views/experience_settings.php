<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/public_controller.php");

	// if (!is_session_user_curator()) {
	// 	header("Location: ../index.php");
	// 	die();
	// }


	$info =get_curator_account_by_user_id(get_session_user_id());//get_collaborator_info(get_session_user_id());
	$user_info = get_user_info(get_session_user_id());
	$curator_id = $info["curator_id"];
	$user_name = $user_info["user_name"];
	$curator_name = $info["curator_name"];
	$logo = "https://github.com/mdo.png";//$info["curator_logo"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
		integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dash.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/experience_settings.css">
</head>

<body>

	<?php
		require_once(__DIR__."/../components/new_dash_header.php");
		require_once(__DIR__."/../components/new_dash_sidebar.php");
	?>
	<main>


		<div class="d-flex col justify-content-center" id="page-info">
			<h1>Share your Experience</h1>
			<p>Let's get started with sharing your trip with the
				rest of the world.
			</p>
		</div>



		<section class="row" id="basic-trip-info">
			<div class="col-lg-3">
				<h4>Basic Information</h4>
			</div>

			<div class="col-lg-9">
				<div class="dashcard">
					<div class="dashcard-header d-block">
						<h5>Basic information about the trip</h5>
						<p>Provide simple information that people are likely to ask</p>
					</div>
					<div class="dashcard-body">
						<div class="col">
							<form action="">
								<div class="form-input-field">
									<label for="experience_name">Name of Experience</label>
									<input type="text" name="experience_name" id="experience_name">
								</div>
								<div class="form-input-field">
									<label for="experience_description">Experience Description</label>
									<textarea name="experience_description" rows="10" id="experience_description"></textarea>
								</div>


								<label for="">Type of trip</label>
								<div class="pill-select-group">
									<?php
										$experience_tags = ["Adventure","Soft Life","Arts","History & Culture","Nature & Wildlife"];
										foreach ($experience_tags as $entry){
											$tag_name = $entry;
											$tag_id = $entry[3];
											echo "
											<input type='checkbox' class='btn-check ' name='experience_type' id='$tag_id' autocomplete='off'>
											<label class='btn btn-outline-primary pill-select-option' for='$tag_id'>
												$tag_name
											</label>";
										}
									?>


								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="row">
			<div class="col-lg-3">
				<h4>Experience media</h4>
			</div>

			<div class="col-lg-9">
				<div class="dashcard">
					<div class="dashcard-header">
						<h5>Images for the trip</h5>
					</div>
					<div class="dashcard-body">
						<div class="input-field">
							<small class="text-gray-1">This will be the first image people see<span class="text-gray-2"></span></small>
							<div class="file-input drag-n-drop type-img" data-display-target="#logo-display" data-input-target="#company_logo"  >
								<div class="upload-symbol">
									<img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
								</div>
								<a>Upload Flyer</a>
								<span class="text-gray-1">JPG,PNG</span>
								<input class="img-upload" name="company_logo" id="company_logo" accept=".png, .jpg, .jpeg, .svg" type="file" data-display-target="#logo-display">
								<div data-input-target="#company_logo" id="logo-display" class="img-display"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>


		<section class="row">
			<div class="col-lg-3">
				<h4>Type of Experience</h4>
			</div>
			<div class="col-lg-9">
				<div class="dashcard">
					<div class="dashcard-header">

						<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
							<input type="radio" class="btn-check" data-toggle-target="shared-experience-tab"
								name="btnradio" id="btnradio1" autocomplete="off" checked>
							<label class="btn btn-outline-primary" for="btnradio1">Shared Experience</label>

							<input type="radio" class="btn-check" data-toggle-target="tab2" name="btnradio"
								id="btnradio2" autocomplete="off" disabled>
							<label class="btn btn-outline-primary" for="btnradio2">Travel plan</label>

							<input type="radio" class="btn-check" data-toggle-target="tab3" name="btnradio"
								id="btnradio3" autocomplete="off" disabled>
							<label class="btn btn-outline-primary" for="btnradio3">Private Tour</label>
						</div>
					</div>
					<div class="dashcard-body">
						<div class="tab-content">
							<div class="tab-pane active" id="shared-experience-tab">

								<div class="row">
									<div class="col-md-4">
										<div class="form-input-field">
											<label for="start_date">Start Date</label>
											<input type="date" name="start_date" id="start_date">
										</div>
									</div>
									<div class="col-md-4">

										<div class="form-input-field">
											<label for="">Booking Fee</label>
											<input type="number" name="booking_fee" id="">
										</div>
									</div>
									<div class="col-md-4">

										<div class="form-input-field">
											<label for="">Number of seats</label>
											<input type="number" name="num_seats" id="">
										</div>
									</div>
								</div>

						</div>
						<div class="tab-pane hide" id="tab2">second</div>
						<div class="tab-pane hide" id="tab3">third</div>
					</div>
				</div>

			</div>
			</div>
		</section>


		<section class="row" id="terms">
			<div class="col-lg-3">
				<h4>Community Notes</h4>
			</div>
			<div class="col-lg-9">
				<div class="dashcard">
					<div class="dashcard-header">
						<h5>Community Notes</h5>
					</div>
					<div class="dashcard-body">
						<div class="terms">
							<label for="accuracy_term">Content Accuracy</label>
							<p id="accuracy_term">Ensure that information you have provided is accurate</p>

							<label for="quality_term">Quality Standards</label>
							<p id="quality_term">Adhere to high standards of safety, accommodation, and transportation.</p>

							<label for="quality_term">Responsibility</label>
							<p id="quality_term">You are responsible for delivering the trip as described.</p>

							<label for="quality_term">Marketing</label>
							<p id="quality_term">We may use your listing in market material and may use images you post on social media to promote the platform and/or your tour</p>

							<label for="quality_term">Reviews</label>
							<p id="quality_term">We may collect and display customer reviews.</p>
						</div>
					</div>
					<div class="dashcard-footer">
						<p>View the full curator <a href="#">Terms & Conditions</a></a></p>
						<div class="d-flex justify-content-end">
							<button class="btn easygo-btn-1" type="submit" onclick="create_experience()">Continue</button>
						</div>
					</div>
				</div>
			</div>
		</section>










	</main>

	<!-- Bootstrap js -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!-- JQuery js -->
	<script src="../assets/js/jquery-3.6.1.min.js"></script>
	<!-- easygo js -->
	<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
	<script src="../assets/js/general.js"></script>
	<script src="../assets/js/functions.js"></script>
	<script src="../assets/js/experience_settings.js"></script>
</body>

</html>