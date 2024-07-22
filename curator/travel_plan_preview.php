<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <?php include_once(__DIR__ . "/../utils/analytics/google_head_tag.php") ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta name="description"
		content="easyGo connects you to tour experiences created by Ghanaian curators. Find the best things to do and book tours by locals">
	<meta name="keywords" content="things to do Ghana, Accra, tourism, tours, December in Ghana, experience Ghana">
	<meta name="author" content="easyGo Tours Ltd">
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
		integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>
		easyGo - Travel Plan
	</title>
	<script type="module" src="">
		import mixpanel from 'mixpanel-browser';
	</script>

</head>
<!-- <link rel="stylesheet" href="../assets/css/trip_summary.css"> -->
<link rel="stylesheet" href="../assets/css/private_trip.css">
<!-- Bootstrap css -->
<link rel="preconnect" href="../assets/css/bootstrap.min.css">
<!-- Fontawesome css -->
<link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
	integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/general.css">


<body class="bg-gray-3">
	<?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>


	<div class="main-wrapper">
		<?php
			require_once(__DIR__."/../coplanner/coplanner_navbar.php");
		?>
		<main class="container ">


			<h1 class="">Experience Name being something really cool and Catch</h1>
			<div class="share-row hide">
				<div class="review-group">
					<i class="fa-solid fa-star"></i>
					<i class="fa-solid fa-star"></i>
					<i class="fa-solid fa-star"></i>
					<i class="fa-solid fa-star "></i>
					<p class="d-inline ">Editor's rating: 5 stars</p>
				</div>
				<div class="button-group">
					<button class="btn ">
						<i class="fa-solid fa-share"></i> Share
					</button>
					<button class="btn ">
						<i class="fa-solid fa-heart"></i> Wishlist
					</button>
					<button class="btn ">
						<i class="fa-solid fa-rating"></i> Reviews
					</button>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-12 image-section">
					<div class="additional-images">
						<div>
							<img class="itinerary-image" src="http://localhost/coplanner/uploads/images/d6aee3642f8c819ba4c703daf1b93463.png" alt="">
						</div>
						<div>
							<img class="itinerary-image" src="http://localhost/coplanner/uploads/images/d6aee3642f8c819ba4c703daf1b93463.png" alt="">
						</div>
						<div>
							<img class="itinerary-image" src="http://localhost/coplanner/uploads/images/d6aee3642f8c819ba4c703daf1b93463.png" alt="">
						</div>
						<div>
							<img class="itinerary-image" src="http://localhost/coplanner/uploads/images/d6aee3642f8c819ba4c703daf1b93463.png" alt="">
						</div>
					</div>
					<div class="image-container">
						<img class="itinerary-image" src="http://localhost/coplanner/uploads/images/d6aee3642f8c819ba4c703daf1b93463.png" alt="">
					</div>

				</div>
			</div>

			<div class="quick-info-section d-flex justify-items-center">
				<p><span class="label"> Minimum Group Size:</span> 10</p>
				<p><span class="label"> Location:</span> Greater Accra, Ghana</p>
				<p>
					<span class="label"> Duration:</span> 5 days
				</p>
			</div>

			<div class="accordion mt-3" id="infoAccordion">
				<div class="accordion-item">
					<h2 class="accordion-header" id="about-experience">
						<button class="accordion-button" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-about-experience" aria-expanded="true" aria-controls="collapse-about-experience">
							About this Experience
						</button>
					</h2>
					<div id="collapse-about-experience" class="accordion-collapse collapse show" aria-labelledby="about-experience"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<strong>This is the first item's accordion body.</strong> It is shown by default, until the
							collapse plugin adds the appropriate classes that we use to style each element. These
							classes control the overall appearance, as well as the showing and hiding via CSS
							transitions. You can modify any of this with custom CSS or overriding our default variables.
							It's also worth noting that just about any HTML can go within the
							<code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="what-to-expect">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-what-to-expect" aria-expanded="false" aria-controls="collapse-what-to-expect">
							Activities Included
						</button>
					</h2>
					<div id="collapse-what-to-expect" class="accordion-collapse collapse" aria-labelledby="what-to-expect"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<strong>This is the second item's accordion body.</strong> It is hidden by default, until
							the collapse plugin adds the appropriate classes that we use to style each element. These
							classes control the overall appearance, as well as the showing and hiding via CSS
							transitions. You can modify any of this with custom CSS or overriding our default variables.
							It's also worth noting that just about any HTML can go within the
							<code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div>
				<!-- <div class="accordion-item">
					<h2 class="accordion-header" id="whats-included">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-whats-included" aria-expanded="false" aria-controls="collapse-whats-included">
							Whats included
						</button>
					</h2>
					<div id="collapse-whats-included" class="accordion-collapse collapse" aria-labelledby="whats-included"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<strong>This is the third item's accordion body.</strong> It is hidden by default, until the
							collapse plugin adds the appropriate classes that we use to style each element. These
							classes control the overall appearance, as well as the showing and hiding via CSS
							transitions. You can modify any of this with custom CSS or overriding our default variables.
							It's also worth noting that just about any HTML can go within the
							<code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div> -->
				<div class="accordion-item">
					<h2 class="accordion-header" id="additional-info">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse-additional-info" aria-expanded="false" aria-controls="collapse-additional-info">
							Additional Information
						</button>
					</h2>
					<div id="collapse-additional-info" class="accordion-collapse collapse" aria-labelledby="additional-info"
						data-bs-parent="#infoAccordion">
						<div class="accordion-body">
							<strong>This is the third item's accordion body.</strong> It is hidden by default, until the
							collapse plugin adds the appropriate classes that we use to style each element. These
							classes control the overall appearance, as well as the showing and hiding via CSS
							transitions. You can modify any of this with custom CSS or overriding our default variables.
							It's also worth noting that just about any HTML can go within the
							<code>.accordion-body</code>, though the transition does limit overflow.
						</div>
					</div>
				</div>
			</div>


			<div class="bottom-bar">
				<div>
					<p class="mb-0">Min Group Size: <strong>5</strong></p>
					<p>Est Booking Fee: <strong>GHS 500</strong></p>
				</div>
				<div>

					<button class="btn easygo-btn-1" onclick="publish_travel_plan()">Publish</button>
				</div>
			</div>



		</main>
	</div>


	<div class="modal" id="image-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<img class="modal-image" id="modal-image" src="" alt="" srcset="">
		</div>
	</div>

	<?php
		require_once(__DIR__."/../components/footer.php");
	?>

</body>

<script>
	function toggleSidebar(show) {
		var sidebar = document.getElementById('sidebar');
		if (show) {
			sidebar.classList.remove('sidebar-hidden');
		} else {
			sidebar.classList.add('sidebar-hidden');
		}
	}
</script>
<!-- Bootstrap js -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- JQuery js -->
<script src="../assets/js/jquery-3.6.1.min.js"></script>
<!-- paystack js -->


<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script src="../assets/js/travel_plan_preview.js"></script>
<script src="../assets/js/dash.js"></script>

</html>