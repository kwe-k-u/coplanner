<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/mixpanel.php");

	$mixpanel = new mixpanel_class();
	$mixpanel->log_page_view("Curators Home");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Manage your tour business and easily receive payments from mobile money and bank accounts. List your adventure and soft life tours with us">
    <meta name="keywords" content="Ghana tours, tour booking platform, tourism management system">
    <meta name="author" content="easyGo Tours Ltd">
	<title>easyGo Curators</title>
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
		integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- easygo css -->
	<link rel="stylesheet" href="../assets/css/home.css">
	<link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" href="../assets/css/footer.css">
	<link rel="stylesheet" href="../assets/css/curator.css">
</head>

<body>
	<!-- header NAV  -->
	 <?php
		require_once(__DIR__."/../coplanner/coplanner_navbar.php");
	 ?>
	<!-- header NAV  -->


	<section class="intro-section">
		<div class="row space-between">
			<div class="left-intro col-md-6">
				<h1>Tourism Made Easy</h1>
				<p>
					Let us handle the technology so you can focus on what you do best;
					creating experiences that leave a lasting memory. At easyGo, we
					build tools and services that help your tourism business stay
					organised and grow.
				</p>
				<div class="button-bar">
					<button class="easygo-btn-1 btn" onclick="goto_page('curator/register.php')">Create An account</button>
				</div>
			</div>
			<div class="right-intro col-md-5">
				<div class="stacked-img-pill">
					<img src="../assets/images/carousel/IMG_2647.webp" alt="">
					<img src="../assets/images/carousel/IMG_2115.webp" alt="">
				</div>
			</div>
		</div>


	</section>

	<section class="why-us-section bg-lblue-2 row ">
		<div class="col-lg-6">
			<h5 class="section-header">Why use easyGo?</h5>
			<h2>We want to see your business grow</h2>
		</div>
		<div class="col-lg-6">
			<p>
				Running a tourism company can be tough. There are many moving parts
				that require your attention. With easyGo, it doesn't have to be this way.
				You can take advantage of our booking system to receive payment from
				mobile money and bank transfer from your clients and keep track of who
				has booked slots on your trip.
			</p>
			<p>
				We save you the hassle of needing to manually keep track of your
				booking lists. By listing on our platform, you also make your trips
				easily discoverable by people outside the reach of your audience
				on social media.
			</p>
		</div>

	</section>


	<section class="value-prop-section ">

		<h3>Tour Booking Management Made easy</h3>

		<div class="row">

			<div class="card col-md-3 ">
				<div class="card-icon">
				<i class="payments-icon"></i>
				</div>
				<div class="card-body">
					<h5 class="card-title">
						Seamless Payments
					</h5>
					<p class="card-text">
						Receive payments from mobile money and bank transfers from a single link
					</p>
				</div>
			</div>

			<div class="card  col-md-3">
				<div class="card-icon">
				<i class="connections-icon"></i>
				</div>
				<div class="card-body">
					<h5 class="card-title">
						Discoverability
					</h5>
					<p class="card-text">
						Escape the silos of your audience and take advantage of the combined reach of other curators
					</p>
				</div>
			</div>

			<div class="card  col-md-3">
				<div class="card-icon">
				<i class="booking-list-icon"></i>
				</div>
				<div class="card-body">
					<h5 class="card-title">
						Manage Bookings
					</h5>
					<p class="card-text">
						With easyGo, you can see who has made payment, when payment was made and how many slots they booked
					</p>
				</div>
			</div>
		</div>

	</section>

	<section class="faq-section">
		<h4>Frequently Asked Questions</h4>
		<div class="accordion accordion-flush" id="accordionFlushExample">

			<div class="accordion-item">
			  <h2 class="accordion-header" id="flush-headingOne">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
					What is easyGo?
				</button>
			  </h2>
			  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body">
					<p>
						easyGo is a tourism booking platform that provides tools and services to tour curators to make it
						easy for them to receive bookings for their group and private tours, manage booking listings and
						share information about their tours through a link
					</p>
				</div>
			  </div>
			</div>

			<div class="accordion-item">
			  <h2 class="accordion-header" id="flush-headingTwo">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
				  How much does it cost ?
				</button>
			  </h2>
			  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body">
					<p>
						easyGo is free to use for tour curators. We do not charge you a commission or fee when you list
						or receive bookings on our platform.
					</p>
				</div>
			  </div>
			</div>


			<div class="accordion-item">
			  <h2 class="accordion-header" id="flush-headingThree">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapselimited" aria-expanded="false" aria-controls="flush-collapseThree">
				  Am I limited to easyGo?
				</button>
			  </h2>
			  <div id="flush-collapselimited" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body">
					<p>
						No. You are still able to list your trips on other platforms and receive bookings through your mobile money. However, the full benefit of
						our platform is acheived when you process bookings through us. We provide a single platform that allows you to keep track of your bookings
						and payments, while giving you a route for sharing future trips with past participants.
					</p>
				</div>
			  </div>
			</div>


			<div class="accordion-item">
			  <h2 class="accordion-header" id="flush-headingThree">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
				  What do I need to get started?
				</button>
			  </h2>
			  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
				<div class="accordion-body">
					<p>
						To get signed up, you will need to provide your personal information, payment details and
						upload pictures of a government issued Identification card and your business certificate.<a href="../curator/register.php"> Click here to get started </a>.
						If you're yet to register your company, you can reach out to our support team to make alternative arrangements. <a href="https://www.wa.me/233506899883">Contact Support here</a>
					</p>
				</div>
			  </div>
			</div>
		  </div>
	</section>



	<!-- Footer  -->
	 <?php
		require_once(__DIR__."/../components/footer.php");
	 ?>
	<!-- Footer  -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
	 <?php
		require_once(__DIR__."/../utils/js_env_variables.php");
	 ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>