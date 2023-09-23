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

							foreach ($destinations as $site) {
								$site_id = $site["destination_id"];
								$destination_name = $site["destination_name"];
								$destination_location = $site["destination_location"];
								$site_country = $site["country"];
								$verified_text = $site["is_verified"] == "1" ? "Verified (Click to Change)" : "Unverified(Click to Change)";
								$star = $site["is_verified"] == "1" ? "full_star" : "empty_star";
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
							if(count($destinations) != 0){
							$site = $destinations[0];
							$site_id = $site["destination_id"];
							$site = get_destination_by_id($site_id);
							$destination_name = $site["destination_name"];
							$site_desc = $site["destination_description"];
							$destination_location = $site["destination_location"];
							$site_country = $site["country"];
							$site_activities = $site["activities"];
							$site_media = $site["media"];

						}else {

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
									Tour site Profile
								</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link easygo-fs-4 h-100 " id="add-location-profile-tab" data-bs-toggle="tab" data-bs-target="#add-location-media" type="button" role="tab" aria-controls="add-location-profile" aria-selected="false">
									Tour site media
								</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link easygo-fs-4 h-100" id="add-location-activities-tab" data-bs-toggle="tab" data-bs-target="#add-location-activities" type="button" role="tab" aria-controls="add-location-activities" aria-selected="false">
									Tour site Activities
								</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link easygo-fs-4 h-100" id="add-location-info-tab" data-bs-toggle="tab" data-bs-target="#add-location-info" type="button" role="tab" aria-controls="add-location-info" aria-selected="false">
									Other information
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

									<!-- Tour site profile [start] -->
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
												<!-- TODO::Make GPS location -->
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
										</div>

									</div>
									<!-- Tour site profile [end] -->

									<!-- Tour site media [start] -->
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
										<!-- Tour site media [end] -->
										<!-- Tour site activities [start] -->
										<div class="col tab-pane fade" role="tabpanel" id="add-location-activities">
											<div class="d-flex align-items-center gap-2 my-4">
												<h6 class="easygo-fw-1 m-0">Activities</h6>
												<small class="text-gray-1 easygo-fs-6">(Activities that the tour site provides)</small>
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
										<!-- Tour site activities [end] -->
										<!-- Tour site extra info [start] -->
										<div class="col tab-pane fade" role="tabpanel" id="add-location-info">
											<div class="d-flex align-items-center gap-2 my-4">
												<h6 class="easygo-fw-1 m-0">Extra information</h6>
												<small class="text-gray-1 easygo-fs-6">(More information about the tour site)</small>
												<div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
											</div>


											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">
													Owner Name
													<small class="text-gray-1 easygo-fs-6">(Optional)</small>
												</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="owner_name" name="owner">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">
													Owner Number
													<small class="text-gray-1 easygo-fs-6">(Optional)</small>
												</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="owner_number" name="number">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">
													Website
													<small class="text-gray-1 easygo-fs-6">(Optional)</small>
												</label>
												<input class="px-4 py-2 flex-grow-1" id="website" type="text" name="website">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">
													Tiktok handle
													<small class="text-gray-1 easygo-fs-6">(Optional)</small>
												</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="tiktok" name="tiktok">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">
													Instagram handle
													<small class="text-gray-1 easygo-fs-6">(Optional)</small>
												</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="instagram" name="instagram">
											</div>

											<div class="form-input-field">
												<label class="text-gray-1 easygo-fs-4 ">
													Facebook handle
													<small class="text-gray-1 easygo-fs-6">(Optional)</small>
												</label>
												<input class="px-4 py-2 flex-grow-1" type="text" id="facebook" name="facebook">
											</div>
										</div>
									</div>
									<!-- Tour site extra info [end] -->
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

				<div class="row">

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