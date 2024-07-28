<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

if (!is_session_user_curator()) {
	header("Location: ../index.php");
	die();
}

$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("Curator Experience Settings");


$info = get_curator_account_by_user_id(get_session_user_id()); //get_collaborator_info(get_session_user_id());
$user_info = get_user_info(get_session_user_id());
$curator_id = $info["curator_id"];
$user_name = $user_info["user_name"];
$curator_name = $info["curator_name"];
$logo = $info["logo_location"]; //$info["curator_logo"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex, nofollow" />
	<title>easyGo - Create An Experience</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dash.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/experience_settings.css">
</head>

<body>

	<?php
	require_once(__DIR__ . "/../components/new_dash_header.php");
	require_once(__DIR__ . "/../components/new_dash_sidebar.php");
	?>
	<main>
		<div class="loader"></div>


		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-9">
				<div class="d-flex col justify-content-center" id="page-info">
					<h1>Share your Experience</h1><br>
				</div>
				<div class="d-flex col justify-content-center" id="page-info">
					<p class="d-block">Let's get started with sharing your trip with the
						rest of the world.
					</p>
				</div>
			</div>
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
									<p id='name-err' class='form-err-msg'></p>
									<input type="text" name="experience_name" id="experience_name">
								</div>
								<div class="form-input-field mt-3">
									<label for="experience_description">Experience Overview</label>
									<p id='description-err' class='form-err-msg'></p>
									<textarea name="experience_description" rows="10" id="experience_description"></textarea>
								</div>


								<label for="">Type of trip</label>
								<div class="pill-select-group">
									<?php
									$experience_tags = get_experience_tags();
									foreach ($experience_tags as $entry) {
										$tag_name = $entry["tag_name"];
										$tag_id = $entry["tag_id"];
										echo "
											<input type='checkbox' class='btn-check ' name='experience_tag' id='$tag_id' value='$tag_name' autocomplete='off'>
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
							<!-- <div class="file-input drag-n-drop type-img" data-display-target="#logo-display" data-input-target="#company_logo">
								<div class="upload-symbol">
									<img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
								</div>
								<a>Upload Flyer</a>
								<span class="text-gray-1">JPG,PNG</span>
								<input class="img-upload" name="company_logo" id="company_logo" accept=".png, .jpg, .jpeg, .svg" type="file" data-display-target="#logo-display">
								<div data-input-target="#company_logo" id="logo-display" class="img-display"></div>
							</div> -->
							<div class="file-input drag-n-drop type-img img-display-2" data-input-target="#company_logo" data-display-target="#company_logo_target" id="company_logo_target">
										<input type="file" class="img-upload" name="company_logo" accept=".png, .jpg, .jpeg, .svg" id="company_logo" data-display-target="#company_logo_target">
										<button class="btn easygo-btn-7">Upload</button>
									</div>
						</div>
						<div class="row mt-4 " id="additional-image-row">
							<small class="text-gray-1">Upload additional Images (We recommend images of activities)</small>
							<div class="col-md-3 col-6">
								<div class="input-field mb-2">
									<div class="file-input drag-n-drop type-img img-display-2" data-input-target="#additional-img-input-1" data-display-target="#additional-img-1" id="additional-img-1">
										<input type="file" class="img-upload" accept=".png, .jpg, .jpeg, .svg" id="additional-img-input-1" data-display-target="#additional-img-1">
										<button class="btn easygo-btn-7">Upload</button>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-6">
								<div class="input-field mb-2">
									<div class="file-input drag-n-drop type-img img-display-2" data-input-target="additional-img-input-2" data-display-target="#additional-img-2" id="additional-img-2">
										<input type="file" class="img-upload" accept=".png, .jpg, .jpeg, .svg" id="additional-img-input-2" data-display-target="#additional-img-2">
										<button class="btn easygo-btn-7">Upload</button>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-6">
								<div class="input-field mb-2">
									<div class="file-input drag-n-drop type-img img-display-2" data-input-target="additional-img-input-3" data-display-target="#additional-img-3" id="additional-img-3">
										<input type="file" class="img-upload" accept=".png, .jpg, .jpeg, .svg" id="additional-img-input-3" data-display-target="#additional-img-3">
										<button class="btn easygo-btn-7">Upload</button>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-6">
								<div class="input-field mb-2">
									<div class="file-input drag-n-drop type-img img-display-2" data-input-target="additional-img-input-4" data-display-target="#additional-img-4" id="additional-img-4">
										<input type="file" class="img-upload" accept=".png, .jpg, .jpeg, .svg" id="additional-img-input-4" data-display-target="#additional-img-4">
										<button class="btn easygo-btn-7">Upload</button>
									</div>
								</div>
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
						<div class="btn-group" role="group" aria-label="Tags for the experience">

							<input type='radio' class='btn-check' data-toggle-target='shared-experience-tab' name='btnradio' id='shared-experience' autocomplete='off' checked>
							<label class='btn btn-outline-primary' for='shared-experience'>Shared Experience</label>

							<input type="radio" class="btn-check" data-toggle-target="travel-plan-tab" name="btnradio" id="travel-plan" autocomplete="off">
							<label class="btn btn-outline-primary" for="travel-plan">Travel plan</label>

							<input type="radio" class="btn-check" data-toggle-target="private-tour-tab" name="btnradio" id="private-tour" autocomplete="off" disabled>
							<label class="btn btn-outline-primary" for="private-tour">Private Tour</label>
						</div>
					</div>
					<div class="dashcard-body">
						<div class="tab-content">
							<div class="tab-pane active" id="shared-experience-tab">
								<label for="" class="">Shared Experiences are group tours with a fixed date that are open for anyone to book as a group</label>

								<div>
									<div>
										<div class="form-input-field hide" id="standard-package-field">
											<label for="">Package Name <span class="text-gray-1">(Optional)</span></label>
											<input type="text" id="package_name" name="package_name" placeholder="Will be displayed as 'Standard' if you leave this blank">
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-input-field">
												<label for="start_date">When does the tour start</label>
												<input type="date" name="start_date" id="start_date">
											</div>
										</div>
										<div class="col-md-6">

											<div class="form-input-field">
												<label for="">Number of seats available</label>
												<input type="number" name="num_seats" id="num_seats">
											</div>
										</div>
										<div class="col-md-6 mt-3">

											<div class="form-input-field">
												<label for="">Currency</label>
												<select name="price-currency" id="price-currency">
													<option value="1" selected>GHS (Ghanaian cedi)</option>
													<option value="2">USD (US Dollar)</option>
												</select>
											</div>

										</div>
										<div class="col-md-6 mt-3">

											<div class="form-input-field">
												<label for="">Booking Fee</label>
												<input type="number" name="booking_fee" id="booking_fee">
											</div>
										</div>
									</div>
								</div>

								<div class="mt-5 package-box hide" id="package-1">
									<div class="d-flex justify-content-end">
										<button style="width: 4rem;" type="button" class="py-2 btn border easygo-fs-5 easygo-fw-2" onclick="remove_package(this)">Remove</button>
									</div>
									<div class="form-input-field">
										<label for="">Package Name</label>
										<input type="text" name="package_name">
									</div>
									<div class="form-input-field">
										<label for="">Package Description <span class="text-gray-1">(Short Description of what the package is)</span></label>
										<input type="text" name="package_description" placeholder="EG: Package books two seats for couples">
									</div>

									<div class="row mt-3">
										<div class="col-md-3">
											<div class="form-input-field">
												<label for="package_start_date">Available From</label>
												<input type="date" name="start_date" id="package_start_date">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-input-field">
												<label for="package_end_date">Available Until</label>
												<input type="date" name="end_date" id="package_end_date">
											</div>
										</div>
										<div class="col-md-3">

											<div class="form-input-field">
												<label for="">Booking Fee</label>
												<input type="number" name="booking_fee" id="">
											</div>
										</div>
										<div class="col-md-3">

											<div class="form-input-field">
												<label for="">Seats Per Booking</label>
												<input type="number" name="num_seats" id="">
											</div>
										</div>
									</div>
								</div>

								<div class="form-input mt-5" id="add-package-button-parent">
									<button class="btn easygo-btn-1" onclick="duplicate_package_box()">Add package</button>
								</div>





							</div>
							<div class="tab-pane hide" id="travel-plan-tab">
								<label for="" class="section-label">Travel Plans are tours that people can book with friends as a single booking</label>
								<div class="row">
									<div class="col-md-6">
										<div class="form-input-field">
											<label for="min-group-size">Minimum Group Size</label>
											<input type="text" name="min-group-size" id="min-group-size">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-input-field">
											<label for="general-location">General Location</label>
											<input type="text" name="general-location" id="general-location">
										</div>
									</div>

									<div class="col-md-6 mt-3">
										<div class="form-input-field">
											<label for="price-estimate">Currency</label>
											<select name="estimate-currency" id="estimate-currency">
												<option value="1" selected>GHS (Ghanaian cedi)</option>
												<option value="2">USD (US Dollar)</option>
											</select>
										</div>
									</div>
									<div class="col-md-6 mt-3">
										<div class="form-input-field">
											<label for="general-location">Price Estimate</label>
											<input type="number" name="price-estimate" id="price-estimate">
										</div>
									</div>
								</div>


								<div class="form-input-field mt-4">
									<label for="">What To Expect <span>(You can add notes about whether you include food in the itinerary)</span></label>
									<textarea name="" id="what-to-expect" rows="7" placeholder="Any Additional Information or notes that the tourists will have be aware of?"></textarea>
								</div>
							</div>
							<div class="tab-pane hide" id="private-tour-tab">third</div>
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
							<button class="btn easygo-btn-1" type="submit" onclick="submit_experience()">Continue</button>
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
	<script src="../assets/js/dash.js"></script>
</body>

</html>