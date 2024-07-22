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
					<th scope="col">Booking Date</th>
					<th scope="col">Amount Paid</th>
					<th scope="col">Seats</th>
				</tr>
				</thead>
				<tbody>
				  <?php
					$bookings = get_curator_bookings($curator_id);
					foreach($bookings as $entry){
						$experience_name = $entry["experience_name"];
						$name = $entry["user_name"];
						$booking_date = format_string_as_date_fn($entry["date_booked"]);
						$currency = $entry["currency_name"];
						$amount = $entry["amount"];
						$seats = $entry["seats_booked"];
						echo "
						<tr>
							<th scope='row'>$name</th>
							<td>$experience_name</td>
							<td>$booking_date</td>
							<td>$currency $amount </td>
							<td>$seats</td>
						</tr>
						";
					}
				  ?>
				</tbody>
			  </table>
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