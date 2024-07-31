<?php

	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../controllers/public_controller.php");
	require_once(__DIR__."/../utils/mixpanel.php");
	$mixpanel = new mixpanel_class();
	$mixpanel->log_page_view("Travel Plan View");

	$plan_id = $_GET["travel_plan_id"];
	$travel_plan = get_travel_plan_by_id($plan_id);
	$media = get_travel_plan_media($plan_id);
	$activities = get_travel_plan_activities($plan_id);
	$name = $travel_plan["experience_name"];
	$description = $travel_plan["description"];
	$curator_name = $travel_plan["curator_name"];
	$currency = $travel_plan["currency_name"];
	$media_location = $travel_plan["media_location"];
	$min_size = $travel_plan["min_size"];
	$price = $travel_plan["price"];
	$gen_location = $travel_plan["general_location"];
	$what_expect = $travel_plan["what_to_expect"];
	$curator_id = $travel_plan["curator_id"];
	$num_days = count($activities);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <?php include_once(__DIR__ . "/../utils/analytics/google_head_tag.php") ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta name="description"
		content="easyGo connects you to tour experiences created by Ghanaian curators. Find the best things to do and book tours by locals">
	<meta name="keywords" content="things to do Ghana, Accra, tourism, tours, December in Ghana, experience Ghana">
	<meta name="author" content="easyGo Tours Ltd">
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
		integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>
		<?php
			echo "easyGo - $name";
		?>
	</title>
	<script type="module" src="">
		import mixpanel from 'mixpanel-browser';
	</script>

</head>
<!-- <link rel="stylesheet" href="../assets/css/trip_summary.css"> -->
<link rel="stylesheet" href="../assets/css/private_trip.css">
<!-- Bootstrap css -->
<link rel="preconnect" href="../assets/css/bootstrap.min.css">
<!-- Fontawesome css -->
<link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
	integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/general.css">


<body class="bg-gray-3">
	<?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>


	<div class="main-wrapper">
		<?php
			require_once(__DIR__."/coplanner_navbar.php");
		?>
		<main class="container ">


			<?php
				echo "<h1>$name</h1>
				<p>Hosted by <a href='curator_profile.php?curator_id=$curator_id'>$curator_name</a></p>";
			?>

			<div class="share-row hide">
				<div class="review-group">
					<i class="fa-solid fa-star"></i>
					<i class="fa-solid fa-star"></i>
					<i class="fa-solid fa-star"></i>
					<i class="fa-solid fa-star "></i>
					<p class="d-inline ">Editor's rating: 5 stars</p>
				</div>
				<div class="button-group">
					<button class="btn ">
						<i class="fa-solid fa-share"></i> Share
					</button>
					<button class="btn ">
						<i class="fa-solid fa-heart"></i> Wishlist
					</button>
					<button class="btn ">
						<i class="fa-solid fa-rating"></i> Reviews
					</button>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-md-9 col-12 image-section">
					<div class="additional-images">
						<?php
							foreach($media as $m){
								$m_path = $m["media_location"];
								echo "
						<div>
							<img class='itinerary-image' src='$m_path' alt=''>
						</div>
								";
							}
						?>

					</div>
					<div class='image-container'>
						<?php
							echo "<img class='itinerary-image' src='$media_location' alt=''>";
						?>

					</div>

				</div>
				<div class="col-md-3">
					<div class="curator-info-card">
						<div class="section " id="info-selection" data-target-next="personal-info">
							<h5>Pick A Date & Number of people</h5>

							<div class="form-input-field mb-4">
								<label for="preferred-date">Prefered Date</label>
								<input type="date" id="preferred-date" class="form-input">
							</div>
							<div class="form-input-field">
								<label for="number-of-people">Number of People</label>
								<?php
									echo "<input type='number' id='number-of-people' min='$min_size' value='$min_size' class='form-input'>";
								?>

							</div>
							<?php
								echo "<small class='text-gray-1'>Estimated price of $currency $price for a group of $min_size</small>";
							?>
						</div>

						<div class="section hide" id="personal-info" data-target-next="additional-info" data-target-previous="info-selection">
							<h4>Your Information</h4>
							<div class="form-input-field mb-3">
								<label for="person-name">Your Name</label>
								<input type="text" id="person-name" class="form-input">
							</div>
							<div class="form-input-field mb-3">
								<label for="person-number">Your Phone Number</label>
								<input type="text" id="person-number" class="form-input">
							</div>
							<div class="form-input-field mb-3">
								<label for="person-email">Your Email</label>
								<input type="text" id="person-email" class="form-input">
							</div>

						</div>
						<div class="section hide" id="additional-info" data-target-previous="personal-selection">
							<h4>Additional Services</h4>
							<div class="check-option">
								<input type="checkbox" name="airport-check" id="airport-check">
									<label for="airport-check">Do you require Airport pickup?</label>
							</div>
							<div class="check-option">
								<input type="checkbox" name="accomodation-check" id="accomodation-check">
									<label for="accomodation-check">Do you require accomodation options?</label>
							</div>
							<div class="form-input-field mt-3">
								<label for="">Extra notes for the curator</label>
								<textarea name="" id="extra-notes" row="10"></textarea>
							</div>

						</div>
						<button class="btn easygo-btn-1 w-100 mt-4" onclick="submit_click()">Proceed</button>
					</div>

				</div>
			</div>

			<div class="quick-info-section d-flex justify-items-center">
				<?php

					echo "
					<p><span class='label'> Minimum Group Size:</span> $min_size</p>
				<p><span class='label'> Location:</span> $gen_location</p>
				<p>
					<span class='label'> Duration:</span> $num_days days
				</p>
				";
				?>
			</div>

			<div class="accordion mt-3" id="infoAccordion">
				<div class="accordion-item">
					<h2 class="accordion-header" id="about-experience">
						<button class="accordion-button" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-about-experience" aria-expanded="true" aria-controls="collapse-about-experience">
							About this Experience
						</button>
					</h2>
					<div id="collapse-about-experience" class="accordion-collapse collapse show" aria-labelledby="about-experience"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<?php
								echo "$description";
							?>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="what-to-expect">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-what-to-expect" aria-expanded="false" aria-controls="collapse-what-to-expect">
							Activities Included
						</button>
					</h2>
					<div id="collapse-what-to-expect" class="accordion-collapse collapse" aria-labelledby="what-to-expect"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<?php
								$html = "";

								foreach ($activities as $dayIndex => $destinations) {
									$html .= "<h5>Day " . $dayIndex . "</h5>";
									$html .= "<ul>";

									$previousDestination = '';

									foreach ($destinations as $destinationName => $activities) {
										if ($destinationName !== $previousDestination) {
											if ($previousDestination !== '') {
												$html .= "</ul>"; // Close previous destination's activity list
											}
											$html .= "<li>" . $destinationName . "</li>";
											$html .= "<ul>";
											$previousDestination = $destinationName;
										}

										foreach ($activities as $index => $activityName) {
											$html .= "<li>" . $activityName . " " . ($index + 1) . "</li>";
										}
									}

									$html .= "</ul>"; // Close the last destination's activity list
									$html .= "</ul>";
								}


								// Output the HTML
								echo $html;
							?>
						</div>
					</div>
				</div>
				<!-- <div class="accordion-item">
					<h2 class="accordion-header" id="whats-included">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-whats-included" aria-expanded="false" aria-controls="collapse-whats-included">
							Whats included
						</button>
					</h2>
					<div id="collapse-whats-included" class="accordion-collapse collapse" aria-labelledby="whats-included"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<strong>This is the third item's accordion body.</strong> It is hidden by default, until the
							collapse plugin adds the appropriate classes that we use to style each element. These
							classes control the overall appearance, as well as the showing and hiding via CSS
							transitions. You can modify any of this with custom CSS or overriding our default variables.
							It's also worth noting that just about any HTML can go within the
							<code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div> -->
				<div class="accordion-item">
					<h2 class="accordion-header" id="additional-info">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-additional-info" aria-expanded="false" aria-controls="collapse-additional-info">
							What To Expect
						</button>
					</h2>
					<div id="collapse-additional-info" class="accordion-collapse collapse" aria-labelledby="additional-info"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<?php
								echo "$what_expect";
							?>
						</div>
					</div>
				</div>
			</div>

			<?php
				if (false){
			?>
			<div class="stuff-card row mt-4">
				<div class="col-12 col-md-6 ">
					<h4>Review Scores</h4>
					<div class="review-summary-card">
						<p class="review-number">4.9</p>
						<!-- <p class="blue-text-1">Perfect Itinerary</p> -->
						<small>Editor's Review</small>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<h4>Organised by</h4>
					<div class="curator-card">
						<div class="curator-tile ">
							<div class="d-flex">
								<div class="profile-image">

								</div>
								<div class="">
									<strong>Curator Name</strong>
									<p class="mb-0"><strong>360</strong> people follow Curator</p>
									<p class="rating">
										<i class="fa-solid fa-star"></i>
										<i class="fa-solid fa-star"></i>
										<i class="fa-solid fa-star"></i>
										<i class="fa-solid fa-star"></i>
									</p>
								</div>
							</div>
							<div class="button-group d-flex d-none ">
								<button class="btn easygo-btn-7">Contact</button>
								<button class="btn easygo-btn-1">Follow</button>
							</div>
						</div>
						<div class="curator-description p-4">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi atque rem, dolor praesentium porro animi a non tenetur nostrum explicabo delectus fuga. Corporis nisi aliquam nemo non cumque ratione repellendus.
						</div>
						<!-- <div class="social-tile d-flex justify-content-center">
							<button class="btn easygo-btn-icon">
								<i class="bi bi-facebook"></i>
							</button>
							<button class="btn easygo-btn-icon">
								<i class="bi bi-facebook"></i>
							</button>
							<button class="btn easygo-btn-icon">
								<i class="bi bi-facebook"></i>
							</button>
						</div> -->
					</div>

				</div>
			</div>
			<?php
				}
			?>


			<section class="other-trips mt-5 hide">
				<h4>Other Travel Plans by the Curator</h4>
				<div class="row mt-2">
					<div class="travel-plan-card">
						<div class="image-section">d</div>
						<div class="card-body">
							<p class="ratings">
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
								<i class="fa-solid fa-star"></i>
							</p>
							<h5><strong>Travel Plan Name</strong></h5>
							<p>Accra, Greater Accra</p>
							<p>From <strong>GHS 500</strong></p>
						</div>
						<div class="card-footer">
							<div class="d-flex">
								<p class="mr-3">3 Days</p>
								<p>12 people</p>
							</div>
							<a href="">Explore</a>
						</div>
					</div>
				</div>

			</section>

		</main>
	</div>


	<div class="modal" id="image-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<img class="modal-image" id="modal-image" src="" alt="" srcset="">
		</div>
	</div>

	<?php
		require_once(__DIR__."/../components/footer.php");
	?>

</body>

<script>
	function toggleSidebar(show) {
		var sidebar = document.getElementById('sidebar');
		if (show) {
			sidebar.classList.remove('sidebar-hidden');
		} else {
			sidebar.classList.add('sidebar-hidden');
		}
	}
</script>
<!-- Bootstrap js -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- JQuery js -->
<script src="../assets/js/jquery-3.6.1.min.js"></script>
<!-- paystack js -->
<script src="https://js.paystack.co/v1/inline.js"></script>


<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script src="../assets/js/private_trip.js"></script>

</html>