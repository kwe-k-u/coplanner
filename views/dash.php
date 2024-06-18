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
	$logo = "https://github.com/mdo.png";//$info["curator_logo"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
				<a class="btn easygo-btn-5" onclick="goto_page('views/experience_settings.php')">Create  New Tour</a>
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
						<p class='mb-0'>15 Trips</p>
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
							  <button class="btn easygo-btn-1">Add Team Member</button>
						  </div>
				</div>
			</div>
		</div>


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