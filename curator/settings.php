<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../utils/paystack.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

if (!is_session_user_curator()) {
	header("Location: ../index.php");
	die();
}

$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("Curator settings");


$info = get_curator_account_by_user_id(get_session_user_id()); //get_collaborator_info(get_session_user_id());
$user_info = get_user_info(get_session_user_id());
$curator_id = $info["curator_id"];
$user_name = $user_info["user_name"];
$curator_name = $info["curator_name"];
$logo = $info["logo_location"]; //$info["curator_logo"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex, nofollow" />
	<title>easyGo - Account Settings</title>
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
	require_once(__DIR__ . "/../components/new_dash_header.php");
	require_once(__DIR__ . "/../components/new_dash_sidebar.php");
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
					<form action="" onsubmit="update_payment_info(this)">
						<div class="dashcard-body">
							<div class="settings-row">
								<div>
									<p>Bank Name</p>
								</div>


								<div class="form-input-field">
									<select name="bank_name" >
										<?php
											$paystack = new paystack_custom();
											$banks = $paystack->get_banks();

											var_dump($banks);
											foreach ($banks as $entry) {
												$name = $entry["name"];
												$code = $entry["code"];
												echo "<option value='$name=$code'>$name</option>";
											}
										?>
										<option value="">Ecobank</option>
										<option value="">Stanbic</option>
									</select>
								</div>
							</div>

							<div class="settings-row">
								<div>
									<p>Account Number</p>
								</div>
								<div class="form-input-field">
									<input type="text" name="account_number" >
								</div>
							</div>

							<div class="settings-row">
								<div>
									<p>Name on Account</p>
								</div>
								<div class="form-input-field">
									<input type="text" name="account_name" >
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button class="easygo-btn-1 btn">Save Changes</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</section>

		<section class="row" id="account-settings">
			<div class="col-lg-3 col-12">
				<h4>Account Settings</h4>
			</div>
			<div class="col-lg-9 col-12">
				<form action="" onsubmit="reset_password(this)">
					<div class="dashcard">
						<div class="dashcard-title">
							<h5>Change your password</h5>
						</div>
						<div class="dashcard-body">
							<div class="settings-row">

								<div>
									<p>Current Password</p>
								</div>
								<div class="form-input-field">
									<input type="password" name="current_password" id="">
								</div>
							</div>
							<div class="settings-row">

								<div>
									<p>New Password</p>
								</div>
								<div class="form-input-field">
									<input type="password" name="new_password" id="">
								</div>
							</div>
							<div class="settings-row">
								<div>
									<p>Confirm New Password</p>
								</div>
								<div class="form-input-field">
									<input type="password" name="confirm_password" id="">
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-end">

							<button type="submit" class="easygo-btn-5 btn">Change Password</button>
						</div>
					</div>
				</form>
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
							foreach ($collaborators as $entry) {
								$name = $entry["user_name"];
								$email = $entry["email"];
								$count += 1;
								echo "
									<tr>
										<th scope='row w-100'>$count</th>
										<td>$name</td>
										<td>$email</td>
									</tr>
									";
							}
							?>
						</tbody>
					</table>
					<div class="table-footer">
						<button class="btn easygo-btn-5" data-bs-target="#invite-collaborator-modal" data-bs-toggle="modal">Add Team Member</button>
					</div>
				</div>
			</div>
		</section>








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
	<script src="../assets/js/settings.js"></script>
</body>

</html>