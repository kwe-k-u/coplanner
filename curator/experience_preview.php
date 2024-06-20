<?php
	require_once(__DIR__ . "/../utils/core.php");
	require_once(__DIR__ . "/../controllers/public_controller.php");

	if (!is_session_user_curator()) {
		header("Location: ../index.php");
		die();
	}

$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("Curator Experience Preview");


	$info =get_curator_account_by_user_id(get_session_user_id());//get_collaborator_info(get_session_user_id());
	$user_info = get_user_info(get_session_user_id());
	$curator_id = $info["curator_id"];
	$user_name = $user_info["user_name"];
	$curator_name = $info["curator_name"];
	$logo = $info["logo_location"];//$info["curator_logo"];


	$experience_id = $_GET["experience_id"];
	$experience = get_shared_experience_by_id($experience_id);
	$days = get_shared_experience_days($experience_id);
	if (count ($days) == 0){
		$days = [$experience["start_date"]];
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <title>easyGo - Experience Preview</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dash.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/trip_summary.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/experience_preview.css">
</head>
<body>

	<?php
		require_once(__DIR__."/../components/new_dash_header.php");
		require_once(__DIR__."/../components/new_dash_sidebar.php");
	?>

	<main class=" ">

		<div class="right-body-container">

			<div class="content-container">
				<div class="summary-content">
					<div class="right-summary">


						<?php
							$experience_description = $experience["experience_description"];
							$title = $experience["experience_name"];
							$curator_name = $experience["curator_name"];
							echo "
							<div class='right-summary-title'>

							<h2>$title</h2>
							<small>by $curator_name</small>
						</div>
						<div class='itinerary-image d-none d-lg-block d-md-block'>
							<img src='http://localhost/coplanner/uploads/images/3df8f55c55eeabf64f9f725adb6fdd64.jpg'>                            </div>
						<div >
							<h3 class='mb-0'>Itinerary Description</h3>
						</div>
						<div >
							<p class='mb-0' id='destination-description'>
								$experience_description
							</p>
						</div>";
						?>


						<div class="itinerary-summary-details mt-5">
							<div>
								<h5>Summary of your Itinerary</h5>
							</div>
							<div class="accordion" id="accordionExample">
								<!-- <div class="accordion-item">
								  <h2 class="accordion-header" id="headingOne">
									<button disabled class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									  Share With Previous Members
									</button>
								  </h2>
								  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
									<div class="accordion-body">
									  <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
									</div>
								  </div>
								</div> -->
								<div class="accordion-item">
								  <h2 class="accordion-header" id="headingTwo">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									  Destinations & Activities
									</button>
								  </h2>
								  <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
									<div class="accordion-body" id="itinerary-accordion-body">

									<!-- <div class="day-summary-group">
											<p class="day-label">Day 1 - 25th June 2024</p>
											<div class="list-tile d-flex justify-content-between" id="day_one">
												<div class="destination-info">
													<p class="m-0 destination-name">Destination name</p>
													<p class="m-0 destination-activities">Hiking, Kayaking, Swimming, Dancing</p>
												</div>
												<div>
													<p>Accra, Ghana</p>
												</div>
											</div>
											<div class="list-tile d-flex justify-content-between" id="day_one">
												<div class="destination-info">
													<p class="m-0 destination-name">Destination name</p>
													<p class="m-0 destination-activities">Hiking, Kayaking, Swimming, Dancing</p>
												</div>
												<div>
													<p>Accra, Ghana</p>
												</div>
											</div>
										</div>

									</div> -->
								  </div>
								</div>
								<div class="accordion-item">
								  <h2 class="accordion-header" id="headingThree">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									  Add-on Services
									</button>
								  </h2>
								  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
									<div class="accordion-body">
										<div class="add-on-card">
											<div class="add-on-card-header">
												<p>Accommodation</p>

											</div>
											<div class="add-on-card-body">
												<!-- <a href="#">Click here to request accomodation</a> -->
												<p>You can reach out to your team to arrange for this service</p>
											</div>
										</div>
									</div>
									<div class="accordion-body">
										<div class="add-on-card">
											<div class="add-on-card-header">
												<p>Vehicle Rental</p>

											</div>
											<div class="add-on-card-body">
												<!-- <a href="#">Click here to request accomodation</a> -->
												<p>You can reach out to your team to arrange for this service</p>
											</div>
										</div>
									</div>
									<div class="accordion-body">
										<div class="add-on-card">
											<div class="add-on-card-header">
												<p>Travel Guide</p>

											</div>
											<div class="add-on-card-body">
												<!-- <a href="#">Click here to request accomodation</a> -->
												<p>You can reach out to your team to arrange for this service</p>
											</div>
										</div>
									</div>
								  </div>
								</div>
							  </div>
						</div>
					</div>
					<div class="left-summary">
						<div class="bill-header" style="opacity:0;">
							<p>Bill</p>
						</div>
						<div class="itinerary-image  d-sm-block d-md-none mb-4">
							<img src="http://localhost/coplanner/uploads/images/3df8f55c55eeabf64f9f725adb6fdd64.jpg">                            </div>


						<div class="invoice-main " id="invoice_section">
							<div class="invoice-container ">

									<div class="invoice-dest">
										<div class="invoice-dets">

									<div class="invoice-header">
										<strong>What the tourist pays</strong>
									</div>
									<?php
									$price = $experience["booking_fee"];
									$currency = $experience["currency_name"];
									$platform_fee = $experience["platform_fee"];
									echo "
										<div>
											<div><p class='mb-1'>Booking Fee</p> </div>
											<div><p>$currency <span>$price</span></p></div>
										</div>
										<div>
											<div><p>Platform fee</p> </div>
											<div><p>$currency <span>$platform_fee</span></p></div>
										</div>
									";
									?>

										</div>
									</div>
                                    <div class="agreement-check">
                                        <h6>Payment Note</h6>
                                        <p class="tc-text">
											Payment for each booking will typically be processed within one business day of booking. This means
											if you receive a booking on a Tuesday, the payment will likely reflect on a Wednesday. This is because
											our payment provider processes cashouts on a T+1 schedule. The payment will only be made to the
											account you provided during sign up.
                                        </p>
                                    </div>
									<div class="invoice-total pb-1">
									<div><p>You receive</p></div>
										<?php
											echo "<div> <p>$currency $price</p></div>"
										?>


									</div>

							</div>
						</div>


						<div class="d-flex gap-4 payment-btn-section">
							<!-- <a class="btn easygo-btn-6">Save For Later</a> -->
							<button class="btn easygo-btn-1 w-100" onclick="">Publish</button>
						</div>
					</div>

				</div>
			</div>
		</div>
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
<script src="../assets/js/experience_preview.js"></script>
</body>

</html>