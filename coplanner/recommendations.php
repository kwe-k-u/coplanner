<?php
	require_once(__DIR__ . "/../utils/core.php");



	$filePath = "../uploads/user_itinerary_preference/".$_GET["id"].".json";

	// Check if the file exists
	if (file_exists($filePath)) {
		// Read the JSON data from the file
		$json = file_get_contents($filePath);
		if ($json !== false) {
			$preferences = json_decode($json, true);

			if ($preferences !== null) {
				print_r($preferences);
				//TODO:: get admin itinerary list
				// filename is the itinerary id
				// run comparisons on the itineraries and return the top 2

			} else {
				// Handle JSON decoding errors if any
				echo "Error decoding JSON data.";
			}
		} else {
			// Handle file read errors if any
			echo "Error reading file.";
		}
	} else {
		echo "Your Url is broken! Kindly start the itinerary process again";
	}
	die();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Coplanner - Recommendations</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/general.css">
</head>

<body class="bg-gray-3">

	<!-- main content start -->
	<div class="main-wrapper">
		<!--- ================================ -->
		<!-- navbar [start] -->
		<?php
		require_once("./coplanner_navbar.php");
		?>
		<!-- navbar [end] -->
		<!--- ================================ -->
		<main class="container" style="height: 100vh; padding-top: 9rem; padding-bottom: 3rem;">
			<div class="loader"></div>
			<div class="col">
				<h3>Here are some recommendations to choose from</h3>
				<div class="row">
					<div class="grid-container gap-1" style="gap:50px">

						<?php
						for ($i = 0; $i < 2; $i++) {
						?>

							<div class="itinerary-card grid-item m-3" style="display:inline-table" onclick="goto_page('coplanner/itinerary_item_view.php')">
								<p class="itinerary-card-top-note">Pay to view</p>
								<div class="itinerary-card-body">
									<div class="price-and-people">
										<div>
											GHC 500 <br>
											Single day
										</div>
										<div>
											3-5 People <br>
											Single day
										</div>
									</div>
									<div>
										<h6 class="easygo-fw-1">Shared Itineries</h6>
										<p class="itinerary-desc">
											An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
										</p>
									</div>
									<div class="itinerary-activities">
										<div class="activity">Hike</div>
										<div class="activity">Hike</div>
										<div class="text-gray-1 d-flex align-items-center">+3 more</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</main>
	</div>
	<!-- main content end -->

	<!-- Bootstrap js -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!-- JQuery js -->
	<script src="../assets/js/jquery-3.6.1.min.js"></script>
	<!-- easygo js -->
	<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
	<script src="../assets/js/general.js"></script>

	<script src="../assets/js/functions.js"></script>
	<script>
	</script>
</body>

</html>