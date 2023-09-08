<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/admin_controller.php");

	if (!is_session_user_admin()) {
		header("Location: ../views/home.php");
		die();
	}

	$selected_curator = isset($_GET["curator_id"]) ? $_GET["curator_id"] : null;






?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin || Group Tours</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
	<!-- ============================== -->
	<!-- main-wrapper [start] -->
	<div class="main-wrapper">
		<?php require_once(__DIR__ . "/../components/admin_header.php") ?>
		<?php require_once(__DIR__ . "/../components/admin_navbar_mobile.php"); ?>
		<!-- ============================== -->
		<!-- dashboard content [start] -->
		<main class="dashboard-content">
			<?php require_once(__DIR__ . "/../components/admin_navbar_desktop.php"); ?>
			<div class="main-content px-3">
				<section class="all-trips">
					<div class="d-flex justify-content-between align-items-center border-1 border-bottom py-3">
						<div>
							<h5 class="title easygo-fs-3 easygo-fw-1 m-0">All Trips</h5>
							<small class="easygo-fs-5 text-gray-1 align-middle"><a href="#">Trips</a> <i class="fa-solid fa-chevron-right"></i> All Trips</small>
						</div>

						<div class="form-input-field">
							<div class="text-gray-1 easygo-fs-4">Curator</div>

							<select name="collaborator_role" onchange="return select_curator()">
								<option value="">All</option>
								<?php
									$curators = get_curators();
									foreach($curators as $c){
										$c_id = $c["curator_id"];
										$c_name = $c["curator_name"];
										$selected = $c_id == $selected_curator ? "selected" : "";
										echo "<option value='$c_id' $selected>$c_name</option>";
									}
								?>
							</select>
						</div>
						<a href="create_a_tour.php" class="easygo-btn-1">Create a Trip</a>

					</div>
					<!-- ============================== -->
					<!-- tirp card listing [start] -->
					<div class="trip-cards">
						<div class="row pt-5">
							<!-- ============================== -->
							<!-- tirp card [start] -->
							<?php
							$trips = get_campaigns($selected_curator);
							// $trips = null;
							// var_dump($trips);

							if (!$trips) {
								echo "<h4>There aren't any listed campaigns by curators</h4>";
							} else {
								foreach ($trips as $entry) {
									$c_id = $entry["campaign_id"];
									$c_name = $entry["title"];
									$c_media = $entry["media_location"];
									$type = $entry["tour_id"] ? "Group" : "Private";
									echo "
                                        <div class='col-lg-4 col-md-6 pb-4'>
                                <div class='trip-card-2'>
                                    <div class='trip-card-img'>
                                        <img src='$c_media' alt='$c_name image'>
                                    </div>
                                    <div class='trip-card-content'>
                                        <h5 class='header'>$c_name</h5>
                                        <div class='easygo-fs-5 d-flex align-items-center justify-content-between'>
                                            <div><i class='fa-regular fa-calendar-days'></i> Sea</div>
                                            <div><i class='fa-solid fa-pen-to-square'></i> t_booking Booked Seats</div>
                                        </div>
                                        <div class='easygo-fs-5'>
                                        </div>
                                        <div class='py-3 d-flex justify-content-between align-items-center easygo-fs-5'>
                                            <span><i class='fa-solid fa-tag'></i> $type</span>
                                            <div>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='../views/tour_description.php?campaign_id=$c_id'>Details</a>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='bookings.php?campaign_id=$c_id'>Bookings</a>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='create_a_tour.php?id=$c_id'>Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        ";
								}
							}
							?>

						</div>
					</div>
					<!-- tirp card listing [end] -->
					<!-- ============================== -->
				</section>
			</div>
		</main>
		<!-- dashboard-content [end] -->
		<!-- ============================== -->
	</div>
	<!-- main-wrapper [end] -->
	<!-- ============================== -->



	<!-- ============================== -->
	<!-- Bootstrap js -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
	<!-- JQuery js -->
	<script src="../assets/js/jquery-3.6.1.min.js"></script>
	<!-- easygo js -->
	<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
	<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
	<script src="../assets/js/functions.js"></script>
	<script src="../assets/js/general.js"></script>
	<!-- Custom script-->
	<script>
		function select_curator(){
			let id = event.target.value;
			if (id){
				goto_page("admin/group_tours.php?curator_id="+id);
			}else{
				goto_page('admin/group_tours.php');
			}
		}
	</script>
</body>

</html>