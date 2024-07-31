<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/public_controller.php");
	$mixpanel = new mixpanel_class();
	$mixpanel->log_page_view();

	$curator_id = $_GET["curator_id"];
	$info = get_curator_by_id($curator_id);
	$curator_name = $info["curator_name"];
	$logo = $info["logo_location"];
	$bio = $info["bio"];
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
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/curator_profile.css">
	<link rel="stylesheet" href="../assets/css/general.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>
		<?php
			echo "$curator_name Profile";
		?>
	</title>
	<script type="module" src="">
		import mixpanel from 'mixpanel-browser';
	</script>
</head>

<body>

	<main class="main-wrapper">
		<?php
        require_once(__DIR__ . "/../coplanner/coplanner_navbar.php")
		?>


		<section id="header-section mt-5">
			<div class="col">

				<div class="banner-image">
				</div>

				<div class="d-flex pt-3 justify-content-around curator-header-tile">
					<div class="middle-div">
						<div class="row">
						<div class='logo-image-div'>

								<?php
								echo "<img src='$logo' alt='' srcset=''>";
								?>
						</div>




							</div>
							<div class="col">

								<?php
									echo "<h4 class='mb-0'>$curator_name</h4>
									<p>$bio</p>";
								?>

							</div>
						</div>
					</div>

				</div>
				<div class="tabs row">
					<div class="middle-div">

						<ul class="nav nav-tabs">
							<li class=" nav-item">
								<a class="nav-link hide" id="home-section-tab" data-bs-toggle="tab"
									href="#home-section">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" id="group-trips-section-tab" data-bs-toggle="tab"
									href="#group-trips-section">General Trips</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="private-trips-section-tab" data-bs-toggle="tab"
									href="#private-trips-section">Travel Plans</a>
							</li>
							<li class="hide nav-item">
								<a class="nav-link" id="reviews-section-tab" data-bs-toggle="tab"
									href="#reviews-section">Reviews</a>
							</li>
						</ul>
					</div>

				</div>

			</div>
		</section>
		<div class="tab-content">

			<section class="body-section tab-pane fade " id="home-section">
				<div class="middle-div">
					<div class=" profile-card">
						<h5 class="card-heading">About</h5>
						<p class="mb-0">Bio</p>

						<?php echo "<p>$bio</p>"; ?>
						<div class="social-buttons">
							<a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100"
									viewBox="0 0 50 50">
									<path
										d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z">
									</path>
								</svg>
							</a>
							<a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
								<path d="M 34.21875 5.46875 C 28.238281 5.46875 23.375 10.332031 23.375 16.3125 C 23.375 16.671875 23.464844 17.023438 23.5 17.375 C 16.105469 16.667969 9.566406 13.105469 5.125 7.65625 C 4.917969 7.394531 4.597656 7.253906 4.261719 7.277344 C 3.929688 7.300781 3.632813 7.492188 3.46875 7.78125 C 2.535156 9.386719 2 11.234375 2 13.21875 C 2 15.621094 2.859375 17.820313 4.1875 19.625 C 3.929688 19.511719 3.648438 19.449219 3.40625 19.3125 C 3.097656 19.148438 2.726563 19.15625 2.425781 19.335938 C 2.125 19.515625 1.941406 19.839844 1.9375 20.1875 L 1.9375 20.3125 C 1.9375 23.996094 3.84375 27.195313 6.65625 29.15625 C 6.625 29.152344 6.59375 29.164063 6.5625 29.15625 C 6.21875 29.097656 5.871094 29.21875 5.640625 29.480469 C 5.410156 29.742188 5.335938 30.105469 5.4375 30.4375 C 6.554688 33.910156 9.40625 36.5625 12.9375 37.53125 C 10.125 39.203125 6.863281 40.1875 3.34375 40.1875 C 2.582031 40.1875 1.851563 40.148438 1.125 40.0625 C 0.65625 40 0.207031 40.273438 0.0507813 40.71875 C -0.109375 41.164063 0.0664063 41.660156 0.46875 41.90625 C 4.980469 44.800781 10.335938 46.5 16.09375 46.5 C 25.425781 46.5 32.746094 42.601563 37.65625 37.03125 C 42.566406 31.460938 45.125 24.226563 45.125 17.46875 C 45.125 17.183594 45.101563 16.90625 45.09375 16.625 C 46.925781 15.222656 48.5625 13.578125 49.84375 11.65625 C 50.097656 11.285156 50.070313 10.789063 49.777344 10.445313 C 49.488281 10.101563 49 9.996094 48.59375 10.1875 C 48.078125 10.417969 47.476563 10.441406 46.9375 10.625 C 47.648438 9.675781 48.257813 8.652344 48.625 7.5 C 48.75 7.105469 48.613281 6.671875 48.289063 6.414063 C 47.964844 6.160156 47.511719 6.128906 47.15625 6.34375 C 45.449219 7.355469 43.558594 8.066406 41.5625 8.5 C 39.625 6.6875 37.074219 5.46875 34.21875 5.46875 Z M 34.21875 7.46875 C 36.769531 7.46875 39.074219 8.558594 40.6875 10.28125 C 40.929688 10.53125 41.285156 10.636719 41.625 10.5625 C 42.929688 10.304688 44.167969 9.925781 45.375 9.4375 C 44.679688 10.375 43.820313 11.175781 42.8125 11.78125 C 42.355469 12.003906 42.140625 12.53125 42.308594 13.011719 C 42.472656 13.488281 42.972656 13.765625 43.46875 13.65625 C 44.46875 13.535156 45.359375 13.128906 46.3125 12.875 C 45.457031 13.800781 44.519531 14.636719 43.5 15.375 C 43.222656 15.578125 43.070313 15.90625 43.09375 16.25 C 43.109375 16.65625 43.125 17.058594 43.125 17.46875 C 43.125 23.71875 40.726563 30.503906 36.15625 35.6875 C 31.585938 40.871094 24.875 44.5 16.09375 44.5 C 12.105469 44.5 8.339844 43.617188 4.9375 42.0625 C 9.15625 41.738281 13.046875 40.246094 16.1875 37.78125 C 16.515625 37.519531 16.644531 37.082031 16.511719 36.683594 C 16.378906 36.285156 16.011719 36.011719 15.59375 36 C 12.296875 35.941406 9.535156 34.023438 8.0625 31.3125 C 8.117188 31.3125 8.164063 31.3125 8.21875 31.3125 C 9.207031 31.3125 10.183594 31.1875 11.09375 30.9375 C 11.53125 30.808594 11.832031 30.402344 11.816406 29.945313 C 11.800781 29.488281 11.476563 29.097656 11.03125 29 C 7.472656 28.28125 4.804688 25.382813 4.1875 21.78125 C 5.195313 22.128906 6.226563 22.402344 7.34375 22.4375 C 7.800781 22.464844 8.214844 22.179688 8.355469 21.746094 C 8.496094 21.3125 8.324219 20.835938 7.9375 20.59375 C 5.5625 19.003906 4 16.296875 4 13.21875 C 4 12.078125 4.296875 11.03125 4.6875 10.03125 C 9.6875 15.519531 16.6875 19.164063 24.59375 19.5625 C 24.90625 19.578125 25.210938 19.449219 25.414063 19.210938 C 25.617188 18.96875 25.695313 18.648438 25.625 18.34375 C 25.472656 17.695313 25.375 17.007813 25.375 16.3125 C 25.375 11.414063 29.320313 7.46875 34.21875 7.46875 Z"></path>
								</svg>
							</a>
							<a href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
								<path d="M41,4H9C6.243,4,4,6.243,4,9v32c0,2.757,2.243,5,5,5h32c2.757,0,5-2.243,5-5V9C46,6.243,43.757,4,41,4z M37.006,22.323 c-0.227,0.021-0.457,0.035-0.69,0.035c-2.623,0-4.928-1.349-6.269-3.388c0,5.349,0,11.435,0,11.537c0,4.709-3.818,8.527-8.527,8.527 s-8.527-3.818-8.527-8.527s3.818-8.527,8.527-8.527c0.178,0,0.352,0.016,0.527,0.027v4.202c-0.175-0.021-0.347-0.053-0.527-0.053 c-2.404,0-4.352,1.948-4.352,4.352s1.948,4.352,4.352,4.352s4.527-1.894,4.527-4.298c0-0.095,0.042-19.594,0.042-19.594h4.016 c0.378,3.591,3.277,6.425,6.901,6.685V22.323z"></path>
							</svg>
							</a>
						</div>
					</div>
					<div class="profile-card">
						<h5 class="card-heading">Reviews</h5>
						<div class="review-card">
							<div class="info-tile row">
								<div class="col-10">
									<p class="m-0">Person name</p>
									<p class="m-0 text-gray-1">Trip Name</p>
								</div>
								<div class="col-2 d-flex align-content-center justify-content-center">
									<i class="fa-solid fa-ellipsis-vertical"></i>
								</div>
							</div>
							<div class="review-body">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur ab magnam
									dignissimos recusandae illo nemo minima ut ad excepturi modi ullam fuga, voluptatem
									rerum commodi iusto est, omnis vel facere?</p>
							</div>
						</div>

						<div class="review-card">
							<h5>Leave a review</h5>
							<p>Been on a trip with this curator? Why not leave a review? The more you say about your experience, the more useful your review is for others</p>
							<div class="form-input-field">
								<div class="rating-stars">
									<input type="radio" class="btn-check" name="rating" id="star5" value="5">
									<label for="star5"><i class="fa-solid fa-star"></i></label>
									<input type="radio" class="btn-check" name="rating" id="star4" value="4">
									<label for="star4"><i class="fa-solid fa-star"></i></label>
									<input type="radio" class="btn-check" name="rating" id="star3" value="3">
									<label for="star3"><i class="fa-solid fa-star"></i></label>
									<input type="radio" class="btn-check" name="rating" id="star2" value="2">
									<label for="star2"><i class="fa-solid fa-star"></i></label>
									<input type="radio" class="btn-check" name="rating" id="star1" value="1">
									<label for="star1" ><i class="fa-solid fa-star"></i></label>
								</div>
							</div>
							<div class="form-input-field row">
								<div class="col-md-9">
									<input type="text" name="" id="" placeholder="Your Review">
								</div>
								<div class="col-md-3">
									<button class="btn outline-btn">Submit Review</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="tab-pane fade  show active" id="group-trips-section">
				<div class="middle-div">
					<div class="row">
						<?php
							$trips = get_curator_listings($curator_id,true);
							foreach ($trips as $entry) {
                                $title = $entry["experience_name"];
                                $curator_id = $entry["curator_id"];
                                $id = $entry["experience_id"];
                                $curator_name = $entry["curator_name"];
                                $currency = $entry["currency_name"];
                                $fee = $entry["booking_fee"];
                                $base_url = server_base_url();
                                $date = format_string_as_date_fn($entry["start_date"]);

                                // $next = get_campaign_tours($id)[0];
                                // $tour_id = $next["tour_id"];
                                // $currency = $next["currency"];
                                // $fee = $next["fee"];
                                $image = $entry["media_location"]?? (server_base_url()."uploads/images/gokart.jpg");

                                echo "

                        <div class='col-lg-4 col-md-6 p-3'>
                        <div class='trip-card' data-trip-extension='experience_id=$id'>
                            <div class='trip-card-image'>
                            <img src='$image' alt='trip card image'>
                                <div class='trip-card-date-pill'>
                                    <p>$date</p>
                                </div>
                            </div>
                            <div class='trip-card-body'>
                                <div class='trip-card-header'>
                                    <div class='title'>
                                        <h5 class='easygo-fw-1'>$title</h5>
                                        <!-- <p class='text-gray-1 easygo-fs-5'>Accra, Ghana</p> -->
                                        <div class='text-gray-1 location easygo-fs-4'>
                                            Curated by <span class='easygo-fw-1 text-black'>$curator_name</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='trip-card-footer'>
                                <div class='col pt-1'>
                                    <p class='mb-0 easygo-fs-5 text-grayl-1'>Price per person</p>
                                    <h5>$currency$fee</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                                    ";
							}
						?>
					</div>
				</div>
			</section>

			<section class="tab-pane fade" id="private-trips-section">
				<div class="middle-div">
					<div class="row">

					<?php
							$trips = get_curator_travel_plans($curator_id);
							foreach ($trips as $entry) {
                                $title = $entry["experience_name"];
                                $curator_id = $entry["curator_id"];
                                $id = $entry["travel_plan_id"];
                                $curator_name = $entry["curator_name"];
                                $currency = $entry["currency_name"];
                                $fee = $entry["price"];
                                $base_url = server_base_url();

                                // $next = get_campaign_tours($id)[0];
                                // $tour_id = $next["tour_id"];
                                // $currency = $next["currency"];
                                // $fee = $next["fee"];
                                $image = $entry["media_location"];

                                echo "

                        <div class='col-lg-4 col-md-6 p-3'>
                        <div class='trip-card' onclick='goto_page(\"coplanner/private_trip.php?travel_plan_id=$id\")'>
                            <div class='trip-card-image'>
                            <img src='$image' alt='trip card image'>
                            </div>
                            <div class='trip-card-body'>
                                <div class='trip-card-header'>
                                    <div class='title'>
                                        <h5 class='easygo-fw-1'>$title</h5>
                                        <!-- <p class='text-gray-1 easygo-fs-5'>Accra, Ghana</p> -->
                                        <div class='text-gray-1 location easygo-fs-4'>
                                            Curated by <a href='#' class='easygo-fw-1 text-black'>$curator_name</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='trip-card-footer'>
                                <div class='col pt-1'>
                                    <p class='mb-0 easygo-fs-5 text-grayl-1'>Est Package price</p>
                                    <h5>$currency $fee</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                                    ";
							}
						?>
					</div>
				</div>
			</section>

			<section class="tab-pane fade" id="reviews-section">
				<div class="middle-div">
					<div class="profile-card">
						<h5 class="card-heading">Reviews</h5>
						<div class="review-card">
							<div class="info-tile row">
								<div class="col-10">
									<p class="m-0">Person name</p>
									<p class="m-0 text-gray-1">Trip Name</p>
								</div>
								<div class="col-2 d-flex align-content-center justify-content-center">
									<i class="fa-solid fa-ellipsis-vertical"></i>
								</div>
							</div>
							<div class="review-body">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur ab magnam
									dignissimos recusandae illo nemo minima ut ad excepturi modi ullam fuga, voluptatem
									rerum commodi iusto est, omnis vel facere?</p>
							</div>
						</div>
						<div class="review-card">
							<div class="info-tile">
								<div class="col">
									<p>Person name</p>
									<p>12th June 2025</p>
								</div>
								<i class="fa-solid fa-menu"></i>
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>

	</main>
    <?php require_once(__DIR__."/../components/footer.php") ?>

</body>

<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/jquery-3.6.1.min.js"></script>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/functions.js"></script>

</html>