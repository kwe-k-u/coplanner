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
	<link rel="stylesheet" type="text/css" href="../assets/css/settings.css">
</head>
<body>


	<?php
		require_once(__DIR__."/../components/new_dash_header.php");
		require_once(__DIR__."/../components/new_dash_sidebar.php");
	?>
	<main>




		<section class="row" id="account-settings">
			<div class="col-lg-3">
				<h4>Payment Information</h4>
			</div>

			<div class="col-lg-9">
				<div class="dashcard">
					<div class="dashcard-header">
						<h5>Payment Information</h5>
					</div>
					<div class="dashcard-body">
						<div class="settings-row">
							<div>
								<p>Bank Name</p>
							</div>


								<div class="form-input-field">
									<select name="" id="">
										<option value="">Ecobank</option>
										<option value="">Stanbic</option>
									</select>
								</div>
						</div>

						<div class="settings-row">
							<div><p>Account Number</p></div>
							<div class="form-input-field">
								<input type="text" name="" id="">
							</div>
						</div>

						<div class="settings-row">
							<div><p>Name on Account</p></div>
							<div class="form-input-field">
								<input type="text" name="" id="">
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<button class="easygo-btn-1 btn">Save Changes</button>
						</div>
					</div>
				</div>

			</div>
		</section>

		<section class="row" id="account-settings">
			<div class="col-lg-3 col-12">
				<h4>Account Settings</h4>
			</div>
			<div class="col-lg-9 col-12">
				<div class="dashcard">
					<div class="dashcard-title">
						<h5>Change your password</h5>
					</div>
				<div class="dashcard-body">
					<div class="settings-row">

						<div><p>Current Password</p></div>
						<div class="form-input-field">
							<input type="password" name="" id="">
						</div>
					</div>
					<div class="settings-row">

						<div><p>New Password</p></div>
						<div class="form-input-field">
							<input type="password" name="" id="">
						</div>
					</div>
					<div class="settings-row">
						<div><p>Confirm Password</p></div>
							<div class="form-input-field">
								<input type="password" name="" id="">
							</div>
					</div>
				</div>
				<div class="d-flex justify-content-end">

					<button class="easygo-btn-5 btn">Change Password</button>
				</div>
				</div>
			</div>
		</section>

		<section class="row" id="curator-section">
			<div class="col-lg-3">
				<h4>Team Settings</h4>
			</div>
			<div class="col-lg-9">
				<div class="dash-table">
					<h4 class="table-titled">Your Team</h4>
					<table class="table">
						<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Email</th>
							<th scope="col">Settings</th>
						</tr>
						</thead>
						<tbody>
						<?php
								$collaborators = get_curator_collaborators($curator_id);
								$count = 0;
								foreach($collaborators as $entry){
									$name = $entry["user_name"];
									$email = $entry["email"];
									$count +=1;
									echo "
									<tr>
										<th scope='row w-100'>$count</th>
										<td>$name</td>
										<td>$email</td>
										<td><a href='#'>Options</a></td>
									</tr>
									";
								}
							?>
						</tbody>
						</table>
						<div class="table-footer">
							<button class="btn easygo-btn-5">Add Team Member</button>
						</div>
				</div>
			</div>
		</section>










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