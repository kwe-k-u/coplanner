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
	$logo = $info["logo_location"];//$info["curator_logo"];

$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("Curator Bookings");


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title>easyGo - Your Bookings</title>
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
			<h4 class="table-title">Bookings Table</h4>
			<table class="table">
				<thead>
				<tr>
					<th scope="col">Member Name</th>
					<th scope="col">Trip Name</th>
					<th scope="col">Preferred Date</th>
					<th scope="col">Your Price</th>
					<th scope="col">Date Request</th>
					<th scope="col">Group Size</th>
					<th scope="col">Status</th>
					<th scope="col">Options</th>
				</tr>
				</thead>
				<tbody>
				  <?php
					$bookings = get_curator_travel_plan_requests($curator_id);
					foreach($bookings as $entry){

						$experience_name = $entry["experience_name"];
						$name = $entry["user_name"];
						$request_id = $entry["request_id"];
						$date_requested = format_string_as_date_fn($entry["date_created"]);
						$currency = $entry["currency_name"];
						$amount = $entry["curator_quote"];
						$seats = $entry["group_size"];
						$status = $entry["status"];
						$preferred_date = format_string_as_date_fn($entry["preferred_date"]);

						echo "
						<tr>
							<th scope='row'>$name</th>
							<td>$experience_name</td>
							<td>$preferred_date</td>
							<td>$currency $amount </td>
							<td>$date_requested</td>
							<td>$seats</td>
							<td>$status</td>
							<td> <a href='#' data-bs-toggle='modal' data-bs-target='#request-modal' onclick='select_request(\"$request_id\")'>Options</a> </td>
						</tr>
						";
					}
				  ?>
				</tbody>
			  </table>
		</div>



	</main>

	 <!-- ============================== -->
    <!-- Curator invite modal [start] -->
    <div class="modal fade" id="request-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="col">
                    <div>
                        <div style='overflow-x: auto;'>
                        </div>
                        <h6 class="easygo-fw-1 m-0">Respond to A Travel Plan Request</h6>
                        <small class="text-gray-1 easygo-fs-6">(Add another person to manage your account)</small>
                        <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>

						<div class="form-input-display">
							<label for="">Experience Name</label>
							<p id="modal_experience_name">Name of the Experience on Website</p>
						</div>
                        <form onsubmit='travel_plan_response(this)'>

						<input type="hidden" name="request_id" id="modal_request_id">

						<div class="row mb-4">
							<div class="col-md-6">
								<div class="form-input-display">
									<label for="">Person Name</label>
									<p id="modal_tourist_name">Person's Name</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-input-display">
									<label for="">Group Size</label>
									<p id="modal_group_size">6 people</p>
								</div>
							</div>
						</div>

						<div class="form-input-display">
							<label for="">Tourist's notes</label>
							<p id="modal_tourist_notes">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi officiis incidunt maxime rerum consectetur quos, dicta necessitatibus vel accusantium fugit ut. Quaerat laborum eligendi nihil provident, quae ducimus exercitationem animi!</p>
						</div>

							<div class="row">
								<div class="col-md-6 d-flex flex-column gap-4">
									<div class="form-input-field">
										<div class="text-gray-1 easygo-fs-4">Change request status</div>

										<select name="curator_accept_status" id="">
											<option value="accept" selected>Accept</option>
											<option value="reject">Reject</option>
										</select>
									</div>
								</div>


								<div class="col-md-6 d-flex flex-column gap-4 mt-1 mb-1">
									<div class="form-input-field">
										<div class="text-gray-1 easygo-fs-4">How much will you charge to excute this trip</div>
										<input type="number" name="quote_price" placeholder="0.00">
									</div>
								</div>
							</div>

							<div class="form-input-field">
								<label for="">Leave Notes for the tourist</label>
								<textarea name="curator_notes" rows="5"></textarea>
							</div>



                            <div class="d-flex justify-content-end gap-2 align-items-center mt-4">
                                <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="py-2 easygo-btn-1 border easygo-fs-5 easygo-fw-2" >Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Invite_collaborator_modal modal [end] -->
        <!-- ============================== -->
    </div>

    <!-- Curator invite modal [end] -->
    <!-- ============================== -->

<!-- Bootstrap js -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- JQuery js -->
<script src="../assets/js/jquery-3.6.1.min.js"></script>
<!-- easygo js -->
<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script src="../assets/js/dash.js"></script>
<script src="../assets/js/travel_plan_requests.js"></script>
</body>

</html>