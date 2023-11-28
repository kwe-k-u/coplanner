<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/admin_controller.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

// if (!is_session_user_admin()) {
// 	header("Location: ../views/home.php");
// 	die();
// }



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin || Destinations</title>
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

		<?php require_once(__DIR__ . "/../components/admin_header.php"); ?>
		<?php require_once(__DIR__ . "/../components/admin_navbar_mobile.php"); ?>
		<!-- ============================== -->
		<!-- dashboard content [start] -->
		<main class="dashboard-content">
			<?php require_once(__DIR__ . "/../components/admin_navbar_desktop.php"); ?>


			<div class="main-content px-3">

				<div class="border-1 border-bottom py-2">
					<div>
						<button class="btn easygo-btn-1" onclick='add_location_toggle()'>Add Destination</button>
					</div>
					<p class="mt-4 mb-0">All destinations on the platform.</p>
					<!-- locations search bar [start]  -->
					<div class="al-search">
						<form onsubmit='on_location_search(this)'>
							<div class="d-flex gap-2">

								<div class="form-input-field">
									<input class="px-4 py-2 flex-grow-1" type="text" placeholder="Search" name="query">
									<small class="easygo-fs-5"><span id="site_search_result_count">4</span> results found<span class="text-gray-1"></span></small>
								</div>
								<div class="dropdown">
									<a id="location_search_filter" href="#Name" class="btn btn-default border dropdown-toggle text-blue px-4 py-2" type="button" id="citymenu" data-bs-toggle="dropdown" aria-expanded="false">
										Name
									</a>
									<ul class="dropdown-menu px-2" aria-labelledby="citymenu">
										<li onclick="on_option_select('location_search_filter','Name')">Name</li>
										<li onclick="on_option_select('location_search_filter','Activity')">Activity</li>
										<li onclick="on_option_select('location_search_filter','Location')">Location</li>
									</ul>
								</div>
								<div>
									<button class="btn btn-default border text-blue px-4 py-2">Search</button>
								</div>
							</div>
						</form>

					</div>
					<!-- locations search bar [end]  -->
					<!-- <button class="btn btn-default border text-blue px-4 py-2">Search</button> -->


				</div>
				<div class="row ">

					<div class="col-lg-6">

						<div class='location-listing py-4' id="site_result_div">
							<?php

							$destinations = get_destinations();

							foreach (array_slice($destinations,0,5) as $site) {
								$site_id = $site["destination_id"];
								$destination_name = $site["destination_name"];
								$destination_location = $site["location"];
								$rating = $site["rating"];
								$rating_count = $site["num_ratings"];
								$site_country = "$rating from $rating_count ratings"; //$site["country"];
								$verified_text = true ? "Verified (Click to Change)" : "Unverified(Click to Change)";
								$star = true ? "full_star" : "empty_star";
								echo "
						<div class='location-card border p-4 rounded my-3'>
							<div class='header d-flex justify-content-between'>
								<h1 class='easygo-fs-3 text-capitalize'>$destination_name</h1>
								<h5 class='easygo-fs-4 text-orange'>$site_country</h5>
							</div>
							<div class='text-gray-1 easygo-fs-6'>
								 <div class='rating-and-info d-flex align-items-center gap-1'>
									<span>
										<img src='../assets/images/svgs/$star.svg' alt='star' id='verified_image_$site_id'>
									</span>
									<span onclick='return verification_toggle(\"$site_id\")' id='verified_text_$site_id'>$verified_text</span>
								</div>
								<div class='time'>
									<span></span>
									&nbsp;
									&nbsp;
									<span>$destination_location</span>
								</div>
							</div>
							<div class='d-flex gap-2 pt-3'>
								<button class='easygo-btn-1 easygo-fs-5 py-1 px-4' onclick='expand_location_info(\"$site_id\")'>Expand</button>
								<button class='easygo-btn-2 easygo-fs-5 py-1 px-4' onclick='add_location_toggle(\"$site_id\")'>Edit</button>
							</div>
						</div>";
							}

							?>
						</div>
					</div>
					<div class="col-lg-6" id="site_info_col">
						<div>
							<?php
							if (count($destinations) != 0) {
								$site = $destinations[0];
								$site_id = $site["destination_id"];
								$site = get_destination_by_id($site_id);
								$destination_name = $site["destination_name"];
								$site_desc = $site["destination_description"];
								$destination_location = $site["destination_location"];
								$site_country = $site["country"];
								$site_activities = $site["activities"];
								$site_media = $site["media"];
							} else {

								$site = "";
								$site_id = "";
								$site = "";
								$destination_name = "";
								$site_desc = "";
								$destination_location = "";
								$site_country = "";
								$site_activities = [];


								$site_media = [];
							}


							echo "<h5 class='loc-title pb-3 border-bottom' id='location-info-title'>$destination_name</h5>
						<div class='loc-info'>
							<p class='easygo-fs-5' id='location-info-desc'>
							$site_desc
							</p>
						</div>";
							?>
							<div style='overflow-x: auto;'>
								<div class='grid-7' style='max-height: 500px;' id='location-info-images'>
									<?php
									foreach ($site_media as $entry) {
										$media = $entry["media_location"];
										// $media_location = $site_media[""];
										echo "<div class='grid-item'>
							<img class='w-100 h-100 rounded' src='$media' alt='scene 1'>
						</div>";
									}
									?>

								</div>
							</div>
							<div class="activity-listing" id="activity-listing">
								<div class="d-flex align-items-center gap-2 my-4">
									<h6 class="easygo-fw-1 m-0">Activities</h6>
									<div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
								</div>
								<div id="activity-list-div" class="activity-list d-flex flex-wrap gap-2">
									<?php
									foreach ($site_activities as $value) {
										$act_id = $value['activity_id'];
										$act_name = $value["activity_name"];
										echo "<span class='px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span' id='$act_id'>$act_name</span>";
									}
									?>

								</div>
							</div>
							<div>
							</div>
						</div>
					</div>

					<div class="col-lg-6 hide" id="site_form_col">

						<ul class="nav nav-tabs easygo-nav-tabs" role="tablist">

							<li class="nav-item" role="presentation">
								<button class="nav-link easygo-fs-4 h-100 active" id="add-location-profile-tab" data-bs-toggle="tab" data-bs-target="#add-location-profile" type="button" role="tab" aria-controls="add-location-profile" aria-selected="false">
									Destination Profile
								</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link easygo-fs-4 h-100 " id="add-location-profile-tab" data-bs-toggle="tab" data-bs-target="#add-location-media" type="button" role="tab" aria-controls="add-location-profile" aria-selected="false">
									Destination media
								</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link easygo-fs-4 h-100" id="add-location-activities-tab" data-bs-toggle="tab" data-bs-target="#add-location-activities" type="button" role="tab" aria-controls="add-location-activities" aria-selected="false">
									Destination Activities
								</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link easygo-fs-4 h-100" id="add-location-utilities-tab" data-bs-toggle="tab" data-bs-target="#add-location-utilities" type="button" role="tab" aria-controls="add-location-utilities" aria-selected="false">
									Destination Utilities
								</button>
							</li>
						</ul>
						<form onsubmit="return create_site(this)">
							<div>
								<div style='overflow-x: auto;'>
									<div class='grid-7' style='max-height: 500px;' id='location-info-images'>

									</div>
								</div>
								<div class="tab-content">

									<!-- Destination profile [start] -->
									<div class="col tab-pane fade active show" role="tabpanel" id="add-location-profile">
										<div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">Name</label>
												<input class="px-4 py-2 flex-grow-1" id="name" type="text" name="name">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">Description</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="description" name="description">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">Location</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="location" name="location">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">Country</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="country" name="country">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">GPS Cordinates</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="cordinates" name="cordinates">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">Default Rating</label>
												<input class="px-4 py-2 flex-grow-1" type="number" id="rating" name="rating">
											</div>
										</div>

									</div>
									<!-- Destination profile [end] -->

									<!-- Destination media [start] -->
									<div class="col tab-pane fade " role="tabpanel" id="add-location-media">
										<div class="row border-1 border-bottom py-4 pe-lg-5">
											<!-- <div class="col-lg-5">
                                    <h3 class="easygo-fs-3 easygo-fw-1">Flyer</h3>
                                    <p class="text-gray-1 easygo-fs-5">Upload the flyer for the trip if you have any</p>
                                </div> -->
											<input type="file" name="images" id="images" multiple>
											<ul id="external-images">

											</ul>
											<div>

												<label for="external-image-field">External image urls</label>
												<input type="url" id="external-image-field">
												<button class="easygo-btn-2" id="external-image-btn" onclick="insert_external_image_url()">Add external image</button>
											</div>


										</div>
									</div>
									<!-- Destination media [end] -->
									<!-- Destination activities [start] -->
									<div class="col tab-pane fade" role="tabpanel" id="add-location-activities">
										<div class="d-flex align-items-center gap-2 my-4">
											<h6 class="easygo-fw-1 m-0">Activities</h6>
											<small class="text-gray-1 easygo-fs-6">(Activities that the Destination provides)</small>
											<div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
										</div>

										<div class="form-input-field">
											<label class="text-gray-1 easygo-fs-4 ">Activity</label>

											<input class="px-4 py-2 flex-grow-1" type="text" id="add_loc_activity_input">
											<div class="col">
												<ul id='add_loc_activity_list'>
													<!-- TODO:: Change how the activities are displayed. We should select the active location and show the activities for that location. The list of activities changes when another location is selected -->
												</ul>
											</div>
											<button class="btn btn-default border text-blue px-4 py-2" onclick="add_loc_activity()">Add Activity</button>
										</div>

									</div>
									<!-- Destination activities [end] -->
									<!-- Destination utilities [start] -->
									<div class="col tab-pane fade" role="tabpanel" id="add-location-utilities">
										<div class="d-flex align-items-center gap-2 my-4">
											<h6 class="easygo-fw-1 m-0">Utilities</h6>
											<small class="text-gray-1 easygo-fs-6">(Utilities that are available at the destiantion)</small>
											<div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
										</div>

										<div class="form-input-field">
											<label class="text-gray-1 easygo-fs-4 ">Utility Types</label>
											<select name="utility_type" id="utility_options" onchange="select_destination_utility(this)">
												<option value="">Please Select</option>
												<?php
												$utilities = get_utility_types();
												foreach ($utilities as $_ => $utility_data) {
													$value = $utility_data["type_id"];
													$key = $utility_data["type_name"];
													echo "<option value='$value'>$key</option>";
												}
												?>
											</select>
											<div class="col">
												<ul id='utility_list'>
												</ul>
											</div>
											<button class="btn btn-default border text-blue px-4 py-2" data-bs-target="#create-utility-modal" data-bs-toggle="modal">Create Utility</button>
										</div>

									</div>
									<!-- Destination activities [end] -->
								</div>
								<div>
									<button class="easygo-btn-1 mt-4 ms-auto easygo-fs-5" id="submit_loc_btn" name="loc_id" value="">Add Destination</button>
								</div>
								<div class="d-flex justify-content-end gap-2 align-items-center mt-4">
									<button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" onclick="return add_location_toggle()">Close</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<!-- ============================== -->
			</div>
		</main>
		<!-- dashboard-content [end] -->
		<!-- ============================== -->
	</div>
	<!-- main-wrapper [end] -->
	<!-- ============================== -->

	<!-- ============================== -->
	<!-- Create Utility modal [start] -->
	<div class="modal fade" id="create-utility-modal">
		<div class="modal-dialog modal-xl">
			<div class="modal-content p-5">
				<div class="col">
					<div>
						<div style='overflow-x: auto;'>
						</div>
						<h6 class="easygo-fw-1 m-0">Create a new destiantion utility</h6>
						<small class="text-gray-1 easygo-fs-6">(Add a new utility option for destinations)</small>
						<div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
						<form onsubmit='create_utility(this)'>
							<input type="hidden" name="curator_id" id="invite_modal_curator_id">
							<div class="col-lg-7 d-flex flex-column gap-4">
								<div class="form-input-field">
									<div class="text-gray-1 easygo-fs-4">Name of utility</div>
									<input type="text" name="utility_name" placeholder="Type of utility">
								</div>
							</div>


							<div class="col-lg-7 d-flex flex-column gap-4">
								<div class="form-input-field">
									<div class="text-gray-1 easygo-fs-4">Collaborator Role</div>

								</div>
							</div>
							<div class="d-flex justify-content-end gap-2 align-items-center mt-4">
								<button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="py-2 easygo-btn-1 border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Send Invite</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Invite_collaborator_modal modal [end] -->
		<!-- ============================== -->
	</div>

	<!-- Create Utility modal [end] -->
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
	<script src="../assets/js/admin/locations.js"></script>
</body>

</html>