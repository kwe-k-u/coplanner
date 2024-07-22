<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/public_controller.php");

	if (!is_session_user_curator()) {
		header("Location: ../index.php");
		die();
	}


	$info =get_curator_account_by_user_id(get_session_user_id());//get_collaborator_info(get_session_user_id());
	$user_info = get_user_info(get_session_user_id());
	$curator_id = $info["curator_id"];
	$user_name = $user_info["user_name"];
	$curator_name = $info["curator_name"];
	$logo = $info["logo_location"];//$info["curator_logo"];


	if(isset($_GET["experience_id"])){
		$experience_id = $_GET["experience_id"];
		$experience = get_shared_experience_by_id($experience_id);
		$days = get_shared_experience_days($experience_id);
		if (count ($days) == 0){
			$days = [array("visit_date"=>$experience["start_date"])];
		}
	}else if(isset($_GET["travel_plan_id"])){
		$days = get_travel_plan_days($_GET["travel_plan_id"]);
		if(count($days) == 0){
			$days = [array("visit_date"=>1)];
		}else{
			$days_temp = $days;
			$days = [];
			foreach ($days_temp as $temp){
				array_push($days,array("visit_date"=> $temp["day_index"]));
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title> easyGo - Destinatons</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dash.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/destinations.css">
</head>
<body>

	<?php
		require_once(__DIR__."/../components/new_dash_header.php");
		require_once(__DIR__."/../components/new_dash_sidebar.php");
	?>
	<main>

		<section class="destination-section">
			<div class="modify-destination-options d-flex justify-content-end">
				<?php
					echo "<p>Can't find a destination? <a href='#' onclick='notify_no_destination(\"$curator_name\")'>Add a new destination</a></p>";
				?>

			</div>
			<div class="destination-search justify-content-between">
				<div class="day-buttons" id="day-buttons" onclick="day_button_clicked()">

					<?php
						$count = 1;
						foreach($days as $entry){
							$date = $entry["visit_date"];
							$button_label = $count == 1 ? "outline-btn" : "no-outline-btn";
							echo "<button class='btn $button_label' data-day-id = '$date'>Day $count</button>";
							$count ++;
						}
					?>
					<button class="btn outline-btn" onclick='add_day()'>Add Day</button>
				</div>
				<div class="form-input-field">
					<input type="text" name="search" oninput="filter_destinations(this)" id="">
				</div>
			</div>
			<div class="destination-list" id="destination-list">
				<?php
					$destinations = get_destinations();
					foreach ($destinations as $entry) {
						$name = $entry["destination_name"];
						$location = $entry["location"];
						$destination_id = $entry["destination_id"];
						$destination_image = server_base_url()."assets/images/site_images/sorry_".rand(1,2).".webp";

						echo "
						<div class='card' >
							<img src='$destination_image' class='card-img-top' alt='...'>
							<div class='card-body'>
							<h5 class='card-title' >$name</h5>
							<p class='card-text text-align-justify'>
								We are actively working on
								getting descriptions that appropriately describe locations but
								this doesn't affect how the platform works.
							</p>
							</div>
							<ul class='list-group list-group-flush'>
								<li class='list-group-item' >$location</li>
							</ul>
							<div class='card-body'>
								<a href='#' class='card-link'>Suggest Edit</a>
								<a href='#' class='card-link' data-bs-toggle='modal' data-bs-target='#destination-modal' data-destination-id='$destination_id' onclick='populate_destination_modal(this)'>Add Destination</a>
							</div>
						</div>
						";
					}
				?>

			</div>
		</section>







		<nav id="bottom-selection-info" class="bottom-selection-info">
			<div class="day-info">
				<h3 class="mb-0" id="bs-day-label">Day </h3>
				<p class="m-0" id="bs-day-info"> Destination(s) Selected </p>
			</div>
			<div class="d-flex ">
				<!-- <div>
					<button class="btn outline-btn ">Preview</button>
				</div> -->
				<div>
					<?php
					if(isset($_GET["experience_id"])){
						$url = "curator/preview.php?experience_id=$experience_id";
					}else{
						$url = "curator/travel_plan_preview.php?travel_plan_id=".$_GET["travel_plan_id"];
					}
						echo "
						<button class='btn easygo-btn-1' onclick='goto_page(\"$url\")'>Continue</button>
						";
					?>
				</div>
			</div>
		</nav>

	</main>

	<div id="destination-modal" data-destination-id="" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				  <h5>Add destination to your plan</h5>
			  </div>
			<div class="destination-modal-info row">
				<div class="col-lg-6">
					<div>
						<img  id="modal-image" src="../assets/images/site_images/sorry_1.webp" alt="">
					</div>

					<h5 id="destination-name" class="mb-0">Destination Name</h5>
					<p id="destination-location"><i class="fa-solid fa-location-pin"></i> Accra, Ghana</p>

					<!-- <div class="destination-tag row">
						<div class="">Hot tubs</div>
						<div class="">Breakfast</div>
						<div class="">Pool</div>
					</div> -->
					<div id="destination-description">
						This section is reserved for descriptions of destinations.
						 We are actively working on
						getting descriptions that appropriately describe locations but
						this doesn't affect how the platform works.
					</div>

				</div>


				<div class="col-lg-6">
					<!-- <div id="other-images">

					</div> -->

					<div id="activities-selection">
						<h5>Activities available</h5>
						<div class="pill-select-group" id='modal-activities-div'>
							<!-- <input type="checkbox" class="btn-check " name="activity"autocomplete="off">
							<label class="btn btn-outline-primary pill-select-option" for="btn-check-outlined1">
								Adventure
							</label>
							<input type="checkbox" class="btn-check " name="activity" id="btn-check-outlined2" autocomplete="off">
							<label class="btn btn-outline-primary pill-select-option" for="btn-check-outlined2">
								Soft Life
							</label>
							<input type="checkbox" class="btn-check " name="activity" id="btn-check-outlined2" autocomplete="off">
							<label class="btn btn-outline-primary pill-select-option" for="btn-check-outlined2">
								Arts
							</label>

							<input type="checkbox" class="btn-check " name="activity" id="btn-check-outlined3" autocomplete="off">
							<label class="btn btn-outline-primary pill-select-option" for="btn-check-outlined3">
								History & Culture
							</label>
							<input type="checkbox" class="btn-check " name="activity" id="btn-check-outlined3" autocomplete="off">
							<label class="btn btn-outline-primary pill-select-option" for="btn-check-outlined3">
								Nature & Wildlife
							</label> -->
						</div>
					</div>

				</div>

			</div>
			<div class="modal-footer">
				<button class="btn outline-btn" data-bs-dismiss="modal" >Cancel</button>
				<button class="btn easygo-btn-1" data-bs-dismiss="modal" onclick='destination_modal_confirm()' >Confirm</button>
			</div>
		  </div>
		</div>
	</div>
<!-- Bootstrap js -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- JQuery js -->
<script src="../assets/js/jquery-3.6.1.min.js"></script>
<!-- easygo js -->
<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script src="../assets/js/dash.js"></script>
<script src="../assets/js/destinations.js"></script>
</body>

</html>