<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/public_controller.php");

	if (!is_session_user_curator()) {
		header("Location: ../index.php");
		die();
	}



$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("Curator Trips");

	$info =get_curator_account_by_user_id(get_session_user_id());//get_collaborator_info(get_session_user_id());
	$user_info = get_user_info(get_session_user_id());
	$curator_id = $info["curator_id"];
	$user_name = $user_info["user_name"];
	$curator_name = $info["curator_name"];
	$logo = $info["logo_location"];//$info["curator_logo"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title>easyGo - Your Trips</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dash.css">
</head>
<body>


<?php
		require_once(__DIR__."/../components/new_dash_header.php");
		require_once(__DIR__."/../components/new_dash_sidebar.php");
	?>
	<main>




		<div class="dash-table">
			<h4 class="table-title">Tours Available</h4>
			<table class="table">
				<thead>
				  <tr>
					<th scope="col">Trip Name</th>
					<th scope="col">Date</th>
					<th scope="col">Members</th>
					<th scope="col">Trip Fee</th>
					<th scope="col">Status</th>
					<th scope="col">Options</th>
				  </tr>
				</thead>
				<tbody>
					<?php
						$trips = get_curator_listings($curator_id);
						foreach($trips as $entry){
							// var_dump($entry);
							$name = $entry["experience_name"];
							$currency = $entry["currency_name"];
							$fee = $entry["booking_fee"];
							$seats = $entry["number_of_seats"];
							$start_date = format_string_as_date_fn($entry["start_date"]);
							$publish = $entry["is_visible"] ? "Published" : "draft";
							$camp_id = $entry["experience_id"];
							$url = server_base_url()."curator/experience_settings.php?experience_id=$camp_id";
							echo "
							<tr id='trip_row_$camp_id'>
								<th scope='row'>$name</th>
								<td>$start_date</td>
								<td>
									<div class='member-stack' data-member-count='0' data-member-max='3'>
									</div>
								</td>
								<td>$currency $fee</td>
								<td>$publish</td>
								<td><a href='#' data-bs-toggle='modal' data-bs-target='#quick-edit-modal' data-experience-id='$camp_id' onclick='quick_edit_prep()'>Edit</a></td>
							</tr>
							";
						}
					?>

				</tbody>
			  </table>
		</div>

		<!-- ============================== -->
		<!-- Quick Edit modal [start] -->
		<div class="modal fade" id="quick-edit-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content p-5">
					<div class="">
						<h4>Quick Edit</h4>
						<p>Experience Name</p>
					</div>

					<div class="input-field">
						<small class="text-gray-1">Change the flyer Image<span class="text-gray-2"></span></small>
						<div class="file-input drag-n-drop type-img img-display-2" data-input-target="#company_logo" data-display-target="#company_logo_target" id="company_logo_target">
							<input type="file" class="img-upload" name="company_logo" accept=".png, .jpg, .jpeg, .svg" id="company_logo" data-display-target="#company_logo_target">
							<button class="btn easygo-btn-7">Upload</button>
						</div>
					</div>

					<div class="row">
						<div class="col-4">
							<div class="form-input-field">
								<label for="">Seats</label>
								<input type="text" name="" id="quick-edit-seats">
							</div>
						</div>
						<div class="col-4">
							<div class="form-input-field">
								<label for="">Price</label>
								<input type="text" name="" id="quick-edit-fee">
							</div>
						</div>
						<div class="col-4">
							<div class="form-input-field">
								<label for="">Status</label>
								<select name="" id="quick-edit-status">
									<option value="1">Publish</option>
									<option value="0">Draft</option>
								</select>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-between mt-4">
						<div>
							<a class="btn easygo-btn-4 outline-btn" id='adv-edit-btn'>Advanced Edits</a>
						</div>
						<div>
							<button class="btn easygo-btn-1" onclick="quick_edit_submit()">Save Changes</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Quick Edit modal [end] -->
		<!-- ============================== -->


	</main>

<!-- Bootstrap js -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- JQuery js -->
<script src="../assets/js/jquery-3.6.1.min.js"></script>
<!-- easygo js -->
<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script src="../assets/js/dash.js"></script>
</body>

</html>