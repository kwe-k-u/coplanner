<?php
require_once(__DIR__ . "/../../utils/core.php");
require_once(__DIR__ . "/../../controllers/public_controller.php");

login_check();

$user_id = get_session_user_id();
$user_name = ""; //get_username_by_id($user_id);
$profile = ""; //get_user_profile_img($user_id);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include_once(__DIR__ . "/../../utils/analytics/google_tag.php") ?>
	<link rel="icon" href="../../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>easyGo - User Dashboard</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../../assets/css/general.css">
	<link rel="stylesheet" href="../../assets/css/home.css">
</head>

<body>

	<!-- main content start -->
	<div class="main-wrapper">
		<nav class="navbar d-md-none">
			<div class="container-fluid">
				<button class="navbar-toggler sidebar-toggler border-0 text-black" type="button" data-target="userdashboard-sidebar">
					<i class="fa-solid fa-bars"></i>
				</button>
				<h5>Trips</h5>
				<button class="btn"><i class="fa-solid fa-bell"></i></button>
		</nav>
		<main>
			<div class="dashboard-content">
				<!-- ============================== -->
				<!-- sidebar [start] -->
				<aside id="userdashboard-sidebar" class="sidebar sidebar-left bg-white">
					<div class="sidebar-header py-3">
						<script>
							function goHome() {
								window.location.href = "../home.php";
							}
						</script>
						<div class="logo m-md-auto" onclick="return goHome()">
							<img class="logo-medium" src="../../assets/images/site_images/logo.png" alt="easygo logo">
						</div>
						<button class="crossbars close-sidebar btn d-md-none" data-target="userdashboard-sidebar">
							<span class="bar"></span>
							<span class="bar"></span>
						</button>
					</div>
					<nav class="sidebar-navbar">
						<div>
							<?php
							require_once(__DIR__ . "/../../components/user_dashboard_navbar.php");
							?>
						</div>
					</nav>
					<div class="d-flex justify-content-center my-3 d-md-none">
						<div class="d-flex gap-2">
							<?php
							echo "
								<div class='user-icon bg-blue'>
                                <img src='$profile' alt=''>
                            </div>
                            <div class='d-flex flex-column gap-1'>
                                <h5 class='easygo-fs-4 m-0'>$user_name</h5>
                                <h6 class='text-gray-1 easygo-fs-5 m-0'>User profile</h6>
                            </div>";
							?>
						</div>
					</div>
				</aside>
				<!-- sidebar [end] -->
				<!-- ============================== -->
				<!-- ============================== -->
				<!-- dashboard content [start] -->
				<main class="main-content bg-gray-3">
					<div class=" px-2">
						<div class="main-content-header d-flex justify-content-between align-items-center py-4 d-none d-md-flex">
							<h3 class="m-0">Dashboard</h3>
							<div class="d-flex justify-content-center my-3">
								<div class="d-flex gap-2">
									<?php
									echo "<div class='user-icon bg-blue'>
                                        <img src='$profile' alt=''>
                                    </div>
                                    <div class='d-flex flex-column justify-content-center gap-1'>
                                        <h5 class='easygo-fs-4 m-0'>$user_name</h5>
                                        <h6 class='text-gray-1 easygo-fs-5 m-0'>User profile</h6>
                                    </div>";
									?>
								</div>
							</div>
						</div>
						<div class="main-content-body py-2">
							<!-- ============================== -->
							<!-- Upcoming itinerary section [start] -->

							<div class='col-lg-12 col-md-9 pb-2'>
									<div class='trip-card-2 row'>
										<div class="col-sm-6 pb-1">
											<div class='trip-card-img'>
												<img src='$c_media' alt='$c_name image'>
											</div>
											<button class="easygo-btn easygo-btn-1">Resume</button>
											<div class='trip-card-content'>
											</div>
										</div>
										<div class="col-sm-6">
											<h4>Trip Name</h4>
											<div class="activity-list">
												<span class="activity-span">Hiking</span>
												<span class="activity-span">Swimming</span>
											</div>
											<h4>GHS 2 500</h4>
										</div>
									</div>
								</div>

							<!-- Upcoming itinerary section [start] -->
							<!-- ============================== -->
							<!-- ============================== -->
							<!-- Upcoming itinerary section [start] -->
							<section class="upcoming-itinerary-section">
								<h4>Your Wishlist</h4>
								<div class='col-lg-4 col-md-6 pb-2'>
									<div class='trip-card-2'>
										<div class='trip-card-img'>
											<img src='$c_media' alt='$c_name image'>
										</div>
										<div class='trip-card-content'>
											<h5 class='header'>$c_name</h5>
											<div class='easygo-fs-5 d-flex align-items-center justify-content-between'>
												<div><i class='fa-regular fa-calendar-days'></i> $created_date</div>
												<div><i class='fa-solid fa-pen-to-square'></i> Created by <span class='text-blue'>$owner_name</span></div>
											</div>
											<div class='easygo-fs-5'>
											</div>
											<div class='py-3 d-flex justify-content-between align-items-center easygo-fs-5'>
												<div>
													<a class='btn px-3 py-1 border easygo-fs-5' href='../coplanner/itinerary_view.php?id=$c_id'>Details</a>
													<a class='btn px-3 py-1 border easygo-fs-5' href='../coplanner/coplanner_setup.php?itinerary_id=$c_id'>Make Template</a>
												</div>
											</div>
										</div>
									</div>
								</div>

							</section>
							<!-- Upcoming itinerary section [end] -->
							<!-- ============================== -->
						</div>
					</div>
				</main>
				<!-- dashboard content [start] -->
				<!-- ============================== -->
			</div>
		</main>
	</div>
	<!-- main content end -->
	<!-- Bootstrap js -->
	<script src="../../assets/js/bootstrap.bundle.min.js"></script>
	<!-- JQuery js -->
	<script src="../../assets/js/jquery-3.6.1.min.js"></script>
	<!-- easygo js -->
	<?php require_once(__DIR__ . "/../../utils/js_env_variables.php"); ?>
	<script src="../../assets/js/general.js"></script>
	<script src="../../assets/js/functions.js"></script>
</body>

</html>