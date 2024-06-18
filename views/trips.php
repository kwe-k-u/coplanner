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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
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
					<th scope="col">Seats Left</th>
					<th scope="col">Trip Fee</th>
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
							echo "
							<tr>
								<th scope='row'>$name</th>
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
</body>

</html>