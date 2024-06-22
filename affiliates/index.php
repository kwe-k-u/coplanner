<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");


$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("easyGo affiliates");

// $info = get_curator_account_by_user_id(get_session_user_id()); //get_collaborator_info(get_session_user_id());
// $user_info = get_user_info(get_session_user_id());
// $curator_id = $info["curator_id"];
// $user_name = $user_info["user_name"];
// $curator_name = $info["curator_name"];

// $logo = $info["logo_location"]; //$info["curator_logo"];

// $experience_id = $_GET["experience_id"];
// $experience = get_shared_experience_by_id($experience_id);
// $date_created = "";
// $owner_name = $experience["curator_name"];
// $total = $experience["total_fee"];
// $platform_fee = $experience["platform_fee"];
// $listing_fee = $experience["booking_fee"];

// $media_location = $experience["media_location"];
// $experience_name = $experience["experience_name"];
// $experience_description = $experience["experience_description"];
// $experience_image = $experience["media_location"];
// $currency = $experience["currency_name"];
// $activities = get_shared_experience_activities($experience_id);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
	<?php include_once(__DIR__ . "/../utils/analytics/google_head_tag.php") ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
	<meta name="description" content="easyGo connects you to tour experiences created by Ghanaian curators. Find the best things to do and book tours by locals">
	<meta name="keywords" content="things to do Ghana, Accra, tourism, tours, December in Ghana, experience Ghana">
	<meta name="author" content="easyGo Tours Ltd">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>
		easyGo -Affiliates
	</title>
</head>
<link rel="stylesheet" href="../assets/css/trip_summary.css">
<!-- Bootstrap css -->
<link rel="preconnect" href="../assets/css/bootstrap.min.css">
<!-- Fontawesome css -->
<link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/general.css">
<link rel="stylesheet" type="text/css" href="../assets/css/trip_summary.css">
<link rel="stylesheet" type="text/css" href="../assets/css/dash.css">
<link rel="stylesheet" type="text/css" href="../assets/css/experience_preview.css">


<body class="bg-gray-3">
	<?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>

	<?php
	require_once(__DIR__ . "/../coplanner/coplanner_navbar.php");
	?>

	<main class=" ">

		<div class="right-body-container">

			<div class="content-container">
				<div class="summary-content">
					<div class="right-summary">


						<div class="right-summary-title">
							<h2>The easyGo Affiliate program</h2>
						</div>
						<div class="itinerary-image d-none d-lg-block d-md-block">
						<img src='https://www.easygo.com.gh/uploads/1.png' />
						</div>
						<?php

						?>
						<div class="itin-summary-title">
							<h2>Affiliate Program Terms</h2>

						</div>
						<div class="right-summary-main">
							<h5>1. Eligibility</h5>
							<p>Participants must be at least 18 years of age to join the easyGo Affiliate Program.</p>
							<p>By signing up, you represent and warrant that the information you provide is accurate and truthful.</p>

							<h5>2. Terms Summary</h5>
							<p>You agree not to engage in spam, false advertising, deception, or any illegal or morally questionable tactics to promote your affiliate links.</p>
							<p>All bookings must be made by the customer directly on the easyGo website.</p>
							<p>Referrals are deemed successful only when a referred person books a selected trip by making payment on easyGo, joins, and completes the trip.</p>
							<p>Canceled bookings will not be counted as successful referrals.</p>
							<p>Only the first 5 booking referrals will be rewarded during this campaign. Further campaigns will be treated separately</p>
							<p>Payments for successful referrals will be processed 48 hours after the trip's end date and upon confirmation of the referral.</p>

							<h5>3. Independent Contractor Status</h5>
							<p>You acknowledge that you are an independent contractor, and nothing in this agreement will create any partnership, joint venture, agency, franchise, sales representative, or employment relationship between you and easyGo.</p>
							<p>You will have no authority to make or accept any offers or representations on behalf of easyGo.</p>

							<h5>4. Accuracy of Information</h5>
							<p>You agree to provide accurate, current, and complete information about yourself as prompted by our registration form, and to maintain and update this information to keep it accurate, current, and complete.</p>

							<h5>5. No Guarantee of Earnings</h5>
							<p>easyGo makes no express or implied warranties or representations with respect to the Affiliate Program or any products sold through the Program.</p>
							<p>We do not guarantee any earnings or specific results from participating in the Affiliate Program.</p>

							<h5>6. Program Development and Commitment</h5>
							<p>The easyGo Affiliate Program is still in development, and we cannot guarantee that everything will operate smoothly at all times.</p>
							<p>We are committed to working towards providing a stable and effective affiliate program and will make reasonable efforts to address and resolve any issues that arise.</p>

							<h5>7. General Terms</h5>
							<p>By participating in the easyGo Affiliate Program, you agree to these terms and conditions.</p>
							<p>These terms and conditions are subject to change, and it is your responsibility to review them regularly. Continued participation in the program constitutes your acceptance of any changes.</p>
							<p>We reserve the right to terminate your participation in the program at any time if you violate these terms and conditions or for any other reason at our discretion.</p>

							<p>By joining the easyGo Affiliate Program, you acknowledge that you have read, understood, and agree to be bound by these terms and conditions.</p>

						</div>

					</div>
					<div class="left-summary">
						<div class="bill-header" style="opacity:0;">
							<p>Bill</p>
						</div>
						<div class="itinerary-image  d-sm-block d-md-none mb-4">
							<img src="https://www.easygo.com.gh/uploads/1.png">
						</div>


						<div class="invoice-main " id="info_section">
							<div class="invoice-container ">
								<div class="invoice-header">
									<strong>Set up your Tracking Links</strong>
								</div>

								<div class="invoice-det">

									<label for="affiliate_name">Your Alias <span class="gray-text">(A nickname you want to use)</span></label>
									<p id="name-err" class="form-err-msg">Password must be at least 8 characters long</p>
									<div class="form-input-field mb-3">
										<input type="text" name="affiliate_name" id="affiliate_name" data-eh-target="name-err">
									</div>
									<label for="experience">Select an Experience to sell</label>
									<div class="form-input-field mb-3">
										<select name="" id="experience">
											<option value="The Votla Experience"> The Volta Experience</option>
										</select>
									</div>
									<label for="whatsapp_contact">WhatsApp Contact</label>
									<p id="contact-err" class="form-err-msg">Password must be at least 8 characters long</p>
									<div class="form-input-field mb-3">
										<input type="text" name="" placeholder="233506899883" data-eh-target="contact-err" id="whatsapp_contact">
									</div>
									<label for="payment_info">Payment details</label>
									<p id="payment-err" class="form-err-msg">Password must be at least 8 characters long</p>
									<div class="form-input-field">
										<input type="text" name="" id="payment_info" data-eh-target="payment-err" placeholder="Ecobank - XXXXXXXX">
									</div>

								</div>

							</div>
						</div>

						<div class="invoice-main  hide" id="tc_section">
							<div class="invoice-container ">
								<div class="invoice-header">
									<strong>Our Terms and Conditions</strong>
								</div>

								<div class="agreement-check">
									<h6>Terms Summary</h6>
									<p class="tc-text">
									You agree not to engage in spam, false advertising, deception,
									or any illegal or morally questionable tactics to promote your affiliate links.
									</p>
									<h6>Payment Note</h6>
									<p class="tc-text">
									Referrals are deemed successful only when a referred person books a
									selected trip by making payment on easyGo, joins, and completes the trip.
									Canceled bookings will not be counted as successful referrals
									</p>
									<p class="tc-text">
										Only the first 5 booking referrals will be rewarded.
									</p>
									<p class="tc-text">
									Payments for successful referrals will be processed 48 hours
									after the trip's end date and upon confirmation of the referral.
									</p>
									<p class="tc-text">
									By participating in the easyGo Affiliate Program, you agree to these terms and conditions.
									</p>
								</div>

							</div>
						</div>
						<div class="invoice-main hide" id="links_section">
							<div class="invoice-container ">

								<div class="invoice-dest">
									<div class="invoice-dets">

										<div class="invoice-header">
											<strong>Your Tracking Links</strong>
										</div>

									</div>
								</div>
								<style>
									#links_section label{
										color:grey;
										margin-top: 12px;
									}
									.link-div > *{
										display: inline-block;
										color: var(--easygo-blue);

									}
									.link-div{
										align-content: center;
										justify-content: end;
										display: flex;
									}
									.link-div > p{
										min-width: 80%;
										max-width: 80%;
										margin-bottom: 0px;
										white-space: nowrap;
										color: black;
										text-overflow: ellipsis;
										overflow: hidden;
										word-wrap: break-word;
										margin-left: 8px;
									}
								</style>
								<label for="">Snapchat</label>
								<div class="link-div align-content-center">
									<p id="snapchat_link">https://www.easygo.com.gh?campaign=affiliate&referred_by=easygo</p>
									<button class="btn easygo-icon-button"  onclick='copy_link()' data-target="snapchat_link"><i class="fa fa-copy" ></i></button>
								</div>
								<label for="">Instagram</label>
								<div class="link-div align-content-center">
									<p id="instagram_link">https://www.easygo.com.gh?campaign=affiliate&referred_by=easygo</p>
									<button class="btn easygo-icon-button"  onclick='copy_link()' data-target="instagram_link"><i class="fa fa-copy" ></i></button>
								</div>
								<label for="">Twitter (X)</label>
								<div class="link-div align-content-center">
									<p id="twitter_link">https://www.easygo.com.gh?campaign=affiliate&referred_by=easygo</p>
									<button class="btn easygo-icon-button"  onclick='copy_link()' data-target="twitter_link"><i class="fa fa-copy" ></i></button>
								</div>
								<label for="">WhatsApp</label>
								<div class="link-div align-content-center">
									<p id="whatsapp_link">https://www.easygo.com.gh?campaign=affiliate&referred_by=easygo</p>
									<button class="btn easygo-icon-button"  onclick='copy_link()' data-target="whatsapp_link"><i class="fa fa-copy" ></i></button>
								</div>
								<div class="invoice-total pb-1">
									<div>
										<!-- <p>You receive</p> -->
									</div>
									<div>
										<p>GHS 50 <small>per booking</small></p>

									</div>


								</div>

							</div>
						</div>


						<div class="d-flex gap-4 payment-btn-section">
							<button id="button" class="btn easygo-btn-1 w-100" onclick="button_clicked()">Proceed</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>


</body>

<script>

	function button_clicked(){
		const info = document.getElementById("info_section");
		const tc = document.getElementById("tc_section");
		const links = document.getElementById("links_section");
		const button = document.getElementById("button");

		let name = document.getElementById("affiliate_name");
		let contact = document.getElementById("whatsapp_contact");
		let experience = document.getElementById("experience");
		let payment_details = document.getElementById("payment_info");


		let validated_input =validateFormInputs(
			{
			type: "text" ,
			value: name.value,
			message: "Please provide a name longer than 3 characters",
			message_target: name.getAttribute("data-eh-target")
			},
			{
			type: "text" ,
			value: contact.value,
			message: "Please provide a valid whatsapp number",
			message_target: contact.getAttribute("data-eh-target")
			},
			{
			type: "text" ,
			value: payment_details.value,
			message: "Please provide valid payment details",
			message_target: payment_details.getAttribute("data-eh-target")
			}
		);

		if(!validated_input){
			return;
		}

		if (!info.classList.contains("hide")){
			send_request("POST",
				"processors/processor.php/get_affiliate_url",
				{
					"name" : name.value ,
					"contact" : contact.value ,
					"experience" : experience.value ,
					"payment_details" : payment_details.value ,
				}, (response)=>{
					if (response.status == 200){
						update_links(response.data);
					}else{
						showDialog("Something went wrong. Contact our team via support@easygo.com.gh");
					}
				}
			)
			info.classList.add("hide");
			tc.classList.remove("hide");
			button.innerText = "I Agree"
		}else if (!tc.classList.contains("hide")){
			button.innerText = "Download Assets"
			tc.classList.add("hide");
			links.classList.remove("hide");
		}else{
			const link = document.createElement("a");
			link.href = "data:https://www.easygo.com.gh/uploads/images/the_volta_experience.zip";
			link.download = "the_volta_experience.zip";
			link.click();
		}

	}

	function update_links(data){
		document.getElementById("snapchat_link").innerText = data.snapchat_link;
		document.getElementById("instagram_link").innerText = data.instagram_link;
		document.getElementById("twitter_link").innerText = data.twitter_link;
		document.getElementById("whatsapp_link").innerText = data.whatsapp_link;

	}

	function copy_link(){
		let target_id = event.target.getAttribute("data-target");
		navigator.clipboard.writeText(document.getElementById(target_id).innerText);
		showToast("Copied link to your clickboard");
	}
</script>
<!-- Bootstrap js -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- JQuery js -->
<script src="../assets/js/jquery-3.6.1.min.js"></script>


<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>

</html>