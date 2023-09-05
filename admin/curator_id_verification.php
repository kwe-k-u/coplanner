<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/curator_interraction_controller.php");
require_once(__DIR__ . "/../controllers/admin_controller.php");

if (!is_session_logged_in()) {
	header("Location: ../views/home.php");
	die();
}

// $info = get_user_by_id(get_session_user_id());
$curator_id = get_session_account_id();
$user_name = ""; //$info["user_name"];
$curator_name = "admin"; //$info["curator_name"];
$logo = ""; //$info["curator_logo"];




?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Curator ID verification</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" href="../assets/css/dashboard.css">
	<link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
	<!-- ============================== -->
	<!-- main-wrapper [start] -->
	<div class="main-wrapper">

		<?php require_once(__DIR__ . "/../components/admin_header.php"); ?>
		<?php require_once(__DIR__ . "/../components/admin_navbar_mobile.php"); ?>
		<!-- ============================== -->
		<!-- dashboard content [start] -->
		<main class="dashboard-content">
			<?php require_once(__DIR__ . "/../components/admin_navbar_desktop.php"); ?>


			<div class="main-content px-3">
				<section class="trip-booking">
					<div class="border-1 border-bottom py-3">
						<div>
							<h5 class="title">Curator ID verification</h5>
							<small class="easygo-fs-5 text-gray-1"><a href="all_tours.php">Admin</a> > Identification Approvals</small>
						</div>
						<p class="mt-4 mb-0">This table shows information about curator managers with pending id verifications.</p>
					</div>
					<div class="controls d-flex justify-content-between align-items-between py-3">
						<div class="left-controls">
							<form id="dashboard-search">
								<div class="form-input-field">
									<input class="p-2" type="text" placeholder="search">
								</div>
							</form>
						</div>
					</div>
					<div class="trip-listing">
						<div class="easygo-list-3 list-striped" style="min-width: 992px;">
							<div class="list-item list-header bg-transparent" style="box-shadow: none;">
								<div class="inner-item">Curator Name</div>
								<div class="inner-item">User name</div>
								<div class="inner-item">ID front</div>
								<div class="inner-item">ID back</div>
								<div class="inner-item">Actions</div>
							</div>

							<?php

							$curators = get_id_pending_curators();

							if (!$curators) {
								echo "<div class='list-item'>
                                        <div class='item-bullet-container'>
                                            <div class='item-bullet'></div>
                                        </div>
                                        <div class='inner-item'>There are no pending identification approvals for curators. </div>
                                    </div>";
							} else {
								foreach ($curators as $entry) {
									$name = $entry["user_name"];
									$curator = $entry["curator_name"];
									$email = $entry["email"];
									$id = $entry["user_id"];
									$curator_id = $entry["curator_id"];
									$id_front = $entry["id_front"];
									$id_back = $entry["id_back"];

									echo "
                                <div class='list-item'>




									<div class='inner-item '>$curator</div>
                                    <div class='inner-item'>
                                        <div class='col'>
                                            <div>
                                                $name
                                            </div>
                                            <div>
                                                $email
                                            </div>
                                        </div>
                                    </div>

									<div class='grid-7' style='max-height: 150px;' id='location-info-images'>
										<div class='grid-item'>
											<a href='#' onclick='show_curator_id_modal(\"$id_front\",\"front\")' data-bs-toggle='modal' data-bs-target='#id-modal'>View Front</a>
										</div>
										<div class='grid-item'>
											<a href='#' onclick='show_curator_id_modal(\"$id_back\",\"back\")' data-bs-toggle='modal' data-bs-target='#id-modal'>View Back</a>
										</div>

									</div>
                                    <div class='inner-item'>
										<div >
											<a href='#' onclick='verify_curator_manager_id(\"$id\",true)'>Approve </a>
											<a href='#' class='text-red' onclick='verify_curator_manager_id(\"$id\",false)'>Reject </a>
										</div>
									</div>
                                </div>
                                    ";
								}
							}
							?>


						</div>
					</div>
					<div class="pagination-section my-5">
						<div class="row">
							<div class="col-lg-3">
								<div class="easygo-fs-5 h-100 d-flex align-items-center">Showing 1 - 20 of 100 trips</div>
							</div>
							<div class="col-lg-9">
								<div class="d-flex justify-content-center align-items-center">
									<nav aria-label="Page navigation m-auto">
										<ul class="pagination gap-2">
											<li class="page-item"><a class="page-link rounded" href="#">Previous</a></li>
											<li class="page-item"><a class="page-link" href="#">1</a></li>
											<li class="page-item"><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">3</a></li>
											<li class="page-item"><a class="page-link rounded" href="#">Next</a></li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</main>
		<!-- dashboard-content [end] -->
		<!-- ============================== -->
	</div>
	<!-- main-wrapper [end] -->
	<!-- ============================== -->


	<!-- ============================== -->
	<!-- ID modal [start] -->
	<div class="modal fade" id="id-modal">
		<div class="modal-dialog modal-xl">
			<div class="modal-content p-5">

				<!-- Modal Content (The Image) -->
				<img class="modal-image" id="curator_id_img">

				<!-- Modal Caption (Image Text) -->
				<div id="caption"></div>
			</div>
		</div>
	</div>
	<!-- ID modal [end] -->
	<!-- ============================== -->

	<!-- ============================== -->
	<!-- Bootstrap js -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!-- JQuery js -->
	<script src="../assets/js/jquery-3.6.1.min.js"></script>
	<!-- easygo js -->
	<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
	<script src="../assets/js/functions.js"></script>
	<script src="../assets/js/general.js"></script>
	<script src="../assets/js/admin/verification.js"></script>
</body>

</html>