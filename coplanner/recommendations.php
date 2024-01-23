<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/public_controller.php");



	$user_preference_file = "../uploads/user_itinerary_preference/".$_GET["id"].".json";
	$template_weight_path = "../uploads/template_weights/";


	// Check if the file exists
	if (file_exists($user_preference_file)) {
		// Read the JSON data from the file
		$json = file_get_contents($user_preference_file);
		if ($json !== false) {
			$preferences = json_decode($json, true);

			if ($preferences ==null) {
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


	$results = exec("python ../utils/recommender/itinerary_recommender.py " . escapeshellarg($user_preference_file) . " " . escapeshellarg($template_weight_path),$recommendations,$return_val);
	//pass the file path to the python script, and the path to the template jsons
	//let the python script return a list of file paths for the recommended itineraries
	//get the itineraries from the path and return those as the recommendations
	$recommendations = explode(" ",str_replace(".json","",$results));
	$recommendations = array_slice($recommendations,0,4);
	$itineraries = array();
	foreach ($recommendations as $itinerary_id) {
		$template = get_itinerary_by_id($itinerary_id);
		if($template){
			array_push($itineraries,$template);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
	<?php include_once(__DIR__ . "/../utils/analytics/google_head_tag.php") ?>
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
<?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>

	<!-- main content start -->
	<div class="main-wrapper">
		<!--- ================================ -->
		<!-- navbar [start] -->
		<?php
		require_once("./coplanner_navbar.php");
		?>
		<!-- navbar [end] -->
		<!--- ================================ -->
		<main class="container" style="height: 200vh; padding-top: 9rem; padding-bottom: 3rem;">
			<div class="loader"></div>
			<div class="col">
				<h3>Here are some recommendations to choose from</h3>
				<div class="row">
					<div class="itinerary-cards-container easygo-scroll-bar scroll-h" style="gap:50px">

						<?php

						foreach ($itineraries as $entry) {
							$itinerary_name = $entry["itinerary_name"];
							$budget = $entry["budget"];
							$itinerary_id = $entry["itinerary_id"];
							$owner_name = $entry["owner_name"];
							$num_days = $entry["num_days"];
							$num_participants = $entry["num_of_participants"];
							$num_destinations = $entry["num_destinations"];
							$day = $entry["first_day"];
							$activity_text = "";
							$activities = get_itinerary_activities($itinerary_id);
							$added = array();
							for($i = 0; $i <sizeof($activities); $i++){
								$act_name = trim($activities[$i]["activity_name"]);
								if(sizeof($added)==3){
									$remaining = sizeof($activities) - $i;
									if($remaining > 0){
										$activity_text .= "<div class='text-gray-1 d-flex align-items-center'>+$remaining more</div>
										";
									}
									break;
								}
								if(!array_search($act_name,$added)){
									array_push($added,$act_name);
									$activity_text .= "
									<div class='activity'>$act_name</div>";
								}
							}
							$suggested_image = suggest_image();
							$suggested_image = server_base_url()."assets/images/suggestions/$suggested_image";

							echo "
									<div class='itinerary-card grid-item m-2'  onclick='goto_page(\"coplanner/itinerary_view.php?id=$itinerary_id\")'>
										<img src='$suggested_image' class='about-image w-100 h-100'>
										<div class='itinerary-card-body'>
											<div class='price-and-people'>
												<div>
													Creator: $owner_name <br>
												</div>
												<div>
													GHS $budget <br>
												</div>
											</div>
											<div>
												<h6 class='easygo-fw-1'>$itinerary_name</h6>
												<p class='itinerary-desc'>
													An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
												</p>
											</div>
											<div class='itinerary-activities'>
												$activity_text

											</div>
										</div>
									</div>
									";
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