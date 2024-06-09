<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/mixpanel.php");
	$mixpanel = new mixpanel_class();
	$mixpanel->log_page_view("About Us");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="easyGo connects you to tour experiences created by Ghanaian curators. Find the best things to do and book tours by locals">
    <meta name="keywords" content="things to do Ghana, Accra, tourism, tours, December in Ghana, experience Ghana">
    <meta name="author" content="easyGo Tours Ltd">
	<title>easyGo - About Us</title>
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
	<link rel="stylesheet" href="../assets/css/about.css">
</head>

<body>
	<!-- Header NAV  -->
	 <?php
		require_once(__DIR__."/coplanner_navbar.php");
	 ?>
	<!-- Header NAV  -->


	<section class="intro-section">
		<h5 class="section-header">About Us</h5>
		<h1>Tours are an expression of Identity</h1>
		<!-- <div class="section-text"> -->
			<p>
				Every trip to a new or familiar locations are about more than just sightseeing.
				At easyGo, we believe that each trip is a way for you to express your identity and
				become part of the community of leisure seekers.
				Where you go cannot separate you from who you are
			</p>
		<!-- </div> -->
		<button href="#" class="btn easygo-btn-1">Book A Tour</button>
		<div class="intro-img mt-5">
			<img src="../assets/images/carousel/IMG_7661.JPG" alt="">
		</div>


	</section>

	<section class="why-us-section bg-lblue-2 row ">
		<div class="col-lg-6">
			<h5 class="section-header">What use easyGo?</h5>
			<h2>Find tours from trusted curators with ease</h2>
		</div>
		<div class="col-lg-6">
			<p>
				Finding something to do can be difficult. That is why we built a
				platform that offers you a variety of tours made by Curators who
				have expertise and experience in crafting unforgettable experiences.
				We make it easy for you to make payments for these tours
				so you don't have to hassle with booking slots.
			</p>
		</div>

	</section>


	<section class="contact-us-section row" id="contact-us">

		<div class="contact-description col-md-6">

			<h4>Get In Touch</h4>
			<p>
				We would love to hear your thoughts. You can reach us
				using the contact information below or send us a message with the
				form on the right. It could be a bug you found, an issue with our
				 service or opinions about improvements we can make
			</p>

			<div class="col">
				<h5>Email</h5>
				<p>support@easygo.com.gh</p>
			</div>
			<div class="col">
				<h5>WhatsApp or Phone Call</h5>
				<p>(+233) 50 689 9883</p>
			</div>

		</div>

		<div class="contact-form col-md-6">
			<h4>Speak To Our Support Team</h4>
			<form action="#" onsubmit="contact_support(this)">

				<div class="form-input-field mt-2">
					<label for="">Your name</label>
					<input type="text" name="name">
				</div>
				<div class="form-input-field mt-2">
					<label for="">Email</label>
					<input type="email" name="email">
				</div>
				<div class="form-input-field mt-2">
					<label for="">Message</label>
					<textarea name="message"  rows="7"></textarea>
				</div>

				<div class="justify-content-end mt-3">
					<button class="btn easygo-btn-1 text-white bg-blue" type="submit">Submit</button>
				</div>

			</form>
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