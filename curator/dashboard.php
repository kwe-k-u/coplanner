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

$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("Curator Dashboard");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title>Curator - Dashboard</title>
    <!-- Bootstrap css -->
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


		<div class="bg-color-box">

			<div class="mt-n22 topbar justify-content-space-between">
				<h2>Your Trips</h2>
				<a class="btn easygo-btn-5" onclick="goto_page('curator/experience_settings.php')">Create  New Tour</a>
			</div>

			<?php

			$upcoming = $info["active_listings"];
			$booking_count = $info["booking_count"];
			$upcoming_revenue = 0;
			$revenue = format_string_as_currency_fn($info["revenue"]);
				echo "
				<div class='row card-list '>
				<div class='dashcard'>
					<div class='dashcard-header mb-3'>
						<h4 class='dashcard-title mb-0'>Bookings</h3>
						<div class='icon-box'>
							<i class='fa fa-receipt'></i>
						</div>

					</div>
					<div class='dashcard-body'>
						<h1 class='easygo-fw-1 mb-0'>$booking_count</h1>
					</div>
					<div class='dashcard-footer'>
						<p class='mb-0'>Upcoming Tour Bookings</p>
					</div>
				</div>
				<div class='dashcard'>
					<div class='dashcard-header mb-3'>
						<h4 class='dashcard-title mb-0'>Upcoming Tours</h3>
						<div class='icon-box'>
							<i class='fa fa-bus'></i>
						</div>
					</div>
					<div class='dashcard-body'>
						<h1 class='easygo-fw-1 mb-0'>$upcoming</h1>
					</div>
					<div class='dashcard-footer'>
						<p class='mb-0'>Active tours you have listed (Coming Soon)</p>
					</div>
				</div>
				<div class='dashcard'>
					<div class='dashcard-header mb-3'>
						<h4 class='dashcard-title mb-0'>Revenue</h3>
						<div class='icon-box'>
							<i class='fa fa-cedi-sign'></i>
						</div>
					</div>
					<div class='dashcard-body'>
						<h1 class='easygo-fw-1 mb-0'>GHS $upcoming_revenue</h1>
					</div>
					<div class='dashcard-footer'>
						<p class='mb-0'>Revenue From Upcoming Tour(Coming soon)</p>
					</div>
				</div>
				<div class='dashcard'>
					<div class='dashcard-header mb-3'>
						<h4 class='dashcard-title mb-0'>Gross Revenue</h3>
						<div class='icon-box'>
							<i class='fa fa-cedi-sign'></i>
						</div>
					</div>
					<div class='dashcard-body'>
						<h1 class='easygo-fw-1 mb-0'>GHS $revenue</h1>
					</div>
					<div class='dashcard-footer'>
						<p class='mb-0'>Lifetime Revenue</p>
					</div>
				</div>

			</div>";
			?>
		</div>


		<div class="dash-table">
			<h4 class="table-title">Tours Available</h4>
			<table class="table">

				<thead>
				  <tr>
					<th scope="col">Trip Name</th>
					<th scope="col">Tour Date</th>
					<th scope="col">Members</th>
					<th scope="col">Seats Left</th>
					<th scope="col">Trip Fee</th>
					<th scope="col">Options</th>
				  </tr>
				</thead>
				<tbody>
				<?php
					$trips = get_curator_listings($curator_id);
					$trips = array_slice($trips,0,3);
					foreach($trips as $entry){
						$title = $entry["experience_name"];
						$camp_id = $entry["experience_id"];
						$start_date = format_string_as_date_fn($entry["start_date"]);
						$currency = $entry["currency_name"];
						$fee = $entry["booking_fee"];
						$seats = $entry["remaining_seats"];
						echo "<tr>
								<th scope='row'>$title</th>
								<td>$start_date</td>
								<td>
									<div class='member-stack' data-member-count='0' data-member-max='3'>
									</div>
								</td>
								<td>$seats</td>
								<td>$currency $fee</td>
								<td><a href='#'>Edit</a></td>
							</tr>
						";
					}
				?>

				</tbody>
			  </table>
			  <div class="table-footer">
				<a href="#">View All Trips</a>
			  </div>
		</div>

		<div class="row">
			<div class="col-lg-8">
				<div class="dash-table">
					<h4 class="table-title">Bookings</h4>
					<table class="table">
						<thead>
						  <tr>
							<th scope="col">Member Name</th>
							<th scope="col">Trip Name</th>
							<th scope="col">Booking Date</th>
							<th scope="col">Seats</th>
						  </tr>
						</thead>
						<tbody>
							<?php
								$bookings = get_curator_bookings($curator_id);
								foreach ($bookings as $entry){

									$name = $entry["user_name"];
									$date_booked = format_string_as_date_fn($entry["date_booked"]);
									$transaction_amount = $entry["amount"];
									$currency = $entry["currency_name"];
									$seats = $entry["seats_booked"];
									$trip_date = format_string_as_date_fn($entry["start_date"]);
									$trip_name = $entry["experience_name"];
									echo "
									<tr>
										<th scope='row'>
												<p class=' easygo-fs-4'>$name</p>
										</th>
										<td>
											<div class='col'>
												<p class='m-0 easygo-fs-3'>$trip_name</p>
											</div>
										</td>
										<td>$date_booked</td>
										<td>$seats</td>
									</tr>
									";
								}
							?>


						  </tbody>
						  </table>
						  <div class="table-footer">
							<a href="#">View All Bookings</a>
						  </div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="dash-table">
					<h4 class="table-title">Your Team</h4>
					<table class="table">
						<thead>
						  <tr>
							<th scope="col w-100">Name</th>
							<td>Email</td>
						  </tr>
						</thead>
						<tbody>
							<?php
								$collaborators = get_curator_collaborators($curator_id);
								foreach($collaborators as $entry){
									$name = $entry["user_name"];
									$email = $entry["email"];
									echo "
									<tr>
										<th scope='row w-100'>$name</th>
										<td>$email</td>
									</tr>
									";
								}
							?>

						  </tbody>
						  </table>
						  <div class="table-footer">
							  <button class="btn easygo-btn-1"  data-bs-target="#invite-collaborator-modal" data-bs-toggle="modal">Add Team Member</button>
						  </div>
				</div>
			</div>
		</div>



    <!-- ============================== -->
    <!-- Curator invite modal [start] -->
    <div class="modal fade" id="invite-collaborator-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="col">
                    <div>
                        <div style='overflow-x: auto;'>
                        </div>
                        <h6 class="easygo-fw-1 m-0">Invite A Collaborator</h6>
                        <small class="text-gray-1 easygo-fs-6">(Add another person to manage your account)</small>
                        <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                        <form onsubmit='invite_collaborator(this)'>
                            <input type="hidden" name="curator_id" id="invite_modal_curator_id">
                            <div class="col-lg-7 d-flex flex-column gap-4">
                                <div class="form-input-field">
                                    <div class="text-gray-1 easygo-fs-4">Collaborator Email</div>
                                    <input type="email" name="email" placeholder="example@easygo.com">
                                </div>
                            </div>


                            <div class="col-lg-7 d-flex flex-column gap-4">
                                <div class="form-input-field">
                                    <div class="text-gray-1 easygo-fs-4">Collaborator Role</div>

                                    <select name="collaborator_role">
                                        <option value="admin">Admin</option>
                                        <option value="edit">Edit</option>
                                        <option value="view">View</option>
                                    </select>
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

    <!-- Curator invite modal [end] -->
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
<script src="../assets/js/settings.js"></script>
</body>

</html>