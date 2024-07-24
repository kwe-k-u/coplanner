<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
$mixpanel = new mixpanel_class();
$mixpanel->log_page_view();

if (isset($_GET["experience_id"])) {
    $experience_id = $_GET["experience_id"];
    $itinerary = get_shared_experience_by_id($experience_id);
    $date_created = "";
    $owner_name = $itinerary["curator_name"];
    $owner_id = $itinerary["curator_id"];
    $total = $itinerary["total_fee"];
    $platform_fee = $itinerary["platform_fee"];
    $listing_fee = $itinerary["booking_fee"];
    // $available_seats = $itinerary["number_of_seats"];
    $media_location = $itinerary["media_location"];
    $itinerary_name = $itinerary["experience_name"];
    $itinerary_image = $itinerary["media_location"];
    $currency = $itinerary["currency_name"];
    $package_id = $itinerary["plan_id"];
    $start_date = format_string_as_date_fn($itinerary["start_date"]);
    $activities = get_shared_experience_activities($experience_id);
    $mixpanel->log_shared_experience_view($experience_id, $itinerary_name);
    $experience_description = $itinerary["experience_description"];
    $experience_tags = get_experience_tags($experience_id);
} else {
    echo "url broken";
    die();
}


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
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>
        <?php echo "easyGo - $itinerary_name" ?>
    </title>
    <script type="module" src="">
        import mixpanel from 'mixpanel-browser';
    </script>

</head>
<link rel="stylesheet" href="../assets/css/trip_summary.css">
<!-- Bootstrap css -->
<link rel="preconnect" href="../assets/css/bootstrap.min.css">
<!-- Fontawesome css -->
<link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/general.css">


<body class="bg-gray-3">
    <?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>


    <div class="main-wrapper">
        <?php require_once(__DIR__ . "/../coplanner/coplanner_navbar.php") ?>
        <main class="container ">

            <div class="right-body-container">

                <div class="content-container">
                    <div class="summary-content">
                        <div class="right-summary">



                                <div class="mb-4 row d-lg-flex d-md-flex image-group">

                                    <div class="itinerary-image" data-imgs=''>
                                        <?php
                                        echo "<img src='$itinerary_image' />";
                                        ?>
                                    </div>
                                    <div class="col-12 additional-image-group">
                                        <?php
                                            $additional_images = get_experience_media($experience_id);
                                            foreach($additional_images as $image){
                                                $image_location = $image["media_location"];
                                                echo "<img class='additional-image' src='$image_location' alt='' srcset=''>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                echo "
                                    <h2 class='mb-1'>$itinerary_name</h2>
                                    <small>by $owner_name</small>
                                    <h4 class='mb-0 mt-3'>Date</h4>
                                    <p>$start_date</p>
                                    ";


                            ?>

                        </div >
                        <div class="left-summary">


                            <div class="invoice-main  hide" id="invoice_section" data-previous-target="user_info_section" data-next-target="tc_section">
                                <div class="invoice-container ">
                                    <?php


                                    echo "
                                        <div class='invoice-dest'>
                                            <div class='invoice-dets'>
                                                <div>
                                                    <div> 1 Slot</div>
                                                    <div>$currency <span>$listing_fee</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='invoice-tax'>
                                            <div>
                                                <div>3% Platform Fee</div>
                                            </div>
                                            <div>$currency <span>$platform_fee</span></div>
                                        </div>
                                        <div class='invoice-total'>
                                            <div>TOTAL</div>
                                            <div> $currency $total</div>
                                        </div>
                                        ";
                                    ?>

                                </div>
                            </div>

                            <div class="invoice-main hide" id="user_info_section" data-previous-target="booking_info_section" data-next-target="tc_section">
                                <div class="invoice-container">
                                    <?php
                                    if (is_session_logged_in()) {
                                        $user_info = get_user_info(get_session_user_id());
                                        $name = $user_info["user_name"];
                                        $email = $user_info["email"];
                                        $phone = $user_info["phone"];
                                    } else {
                                        $name = "";
                                        $email = "";
                                        $phone = "";
                                    }
                                    echo "
                                        <div class='form-input-field'>
                                            <label for='name'>Your name</label>
                                            <input type='text' id='user_info_name' value='$name'>
                                            <p id='name-err' class='form-err-msg'></p>
                                        </div>
                                        <div class='form-input-field'>
                                            <label for='name'>Email</label>
                                            <input type='text' id='user_info_email' value='$email'>
                                            <p id='email-err' class='form-err-msg'></p>
                                        </div>
                                        <div class='form-input-field'>
                                            <label for='name'>Phone number</label>
                                            <input type='tel'  id='user_info_phone' value='$phone'>
                                            <p id='phone-err' class='form-err-msg'></p>
                                        </div>
                                        ";
                                    ?>
                                    <center class="justify-content-center align-items-center">

                                    <!-- </center>

                                    <center class='justify-content-end'> -->
                                        <?php
                                        if (!is_session_logged_in()) {
                                            echo "Or";
                                            google_auth_btn();
                                        }
                                        ?>
                                    </center>
                                </div>
                            </div>

                            <div class="invoice-main " id="booking_info_section" data-next-target="user_info_section">
                                <div class="invoice-container">
                                    <h4>Select A Package</h4>

                                    <?php
                                    echo "
                                        <div class='package-option d-flex'>
                                            <input type='radio' name='package' value='$package_id' id='package_$package_id' checked>
                                            <label for='package_$package_id' class='w-100'>
                                                    <div class='col d-flex justify-content-between w-100'>
                                                        <p class='mb-0 package-option-name'>Standard Package</p>
                                                        <p class='d-inline-flex package-option-price'>$currency $listing_fee</p>
                                                        </div>
                                                    <div class='col'>
                                                        <p class='mb-0 package-option-description'>
                                                            This is the standard package for the trip. You can select multiple seats
                                                        </p>
                                                    </div>
                                            </label>
                                        </div>";
                                        $packages = get_experience_packages($experience_id);
                                        foreach($packages as $package){
                                            $package_name = $package["package_name"];
                                            $package_id = $package["plan_id"];
                                            $package_description = $package["package_description"];
                                            $min_amount = $package["min_amount"];
                                            $package_seats = $package["seats"];
                                            echo
                                            "
                                            <div class='package-option d-flex'>
                                                <input type='radio' name='package' value='$package_id' id='package_$package_id'>
                                                <label for='package_$package_id' class='package-label w-100'>
                                                        <div class='col d-flex justify-content-between w-100'>
                                                            <p class='mb-0 package-option-name'>$package_name</p>
                                                            <p class='d-inline-flex package-option-price'>$currency $min_amount</p>
                                                        </div>
                                                        <div class='col'>
                                                            <p class='mb-0 package-option-description'>
                                                                $package_description
                                                            </p>
                                                        </div>
                                                        <div class='package-option-footer'>
                                                            $package_seats Seats
                                                        </div>
                                                </label>
                                            </div>
                                            ";
                                        }
                                    ?>

                                    <div class="form-input-field" id="number_seats_field">
                                        <label for="name">Number of seats</label>
                                        <input type="number" id="number_seats" min="1" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-main hide" id="tc_section" data-previous-target="user_info_section" data-next-target="final_invoice_section">
                                <div class="invoice-container">
                                    <div class="agreement-check">
                                        <h6>Marketing</h6>
                                        <p class="tc-text">You consent to, and understand that the Curator and/or easyGo may take pictures of you during the trip.
                                            These pictures may be used in marketing and advertisement material by either party
                                        </p>
                                    </div>
                                    <div class="agreement-check">
                                        <h6>Damages</h6>
                                        <p class="tc-text">
                                            You understand that some activities included in itineraries may have inherient risks for personal injury.
                                            Although the curator is obliged to ensure your safety during the trip, you agree agree to take reasonable
                                            care to protect yourself and other participants from incuring injury to themselves or damage to property
                                            charge
                                        </p>
                                    </div>
                                    <div class="agreement-check">
                                        <h6>Cancellation</h6>
                                        <p class="tc-text">By clicking I agree, you consent to our cancellation policy. You receive a full refund if you cancel your booking within 48 hours
                                            after booking. However, you will receive a partial refund if you cancel after 48 hours, bearing the processing fees for your refund
                                        </p>
                                    </div>
                                    <div class="agreement-check">
                                        <input type="checkbox" required>
                                        <span class="tc-text"> I agree to these terms and have read the
                                            <a href="https://drive.google.com/file/d/1nhn8LGxFU_eWkp1FaRZafN1BfMrSWUi3/view?usp=sharing">
                                                Tourist terms and conditions
                                            </a>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="invoice-main hide" id="final_invoice_section" data-previous-target="tc_section" >
                                <div class="invoice-container">
                                    <h4>Final Invoice</h4>
                                    <div class='invoice-dest'>
                                        <div class='invoice-date' id="final_invoice_dates"> June 16th, 2024 - June 20th, 2024 </div>
                                        <div class='invoice-dets'>
                                            <p> Activities </p>
                                            <div>
                                                <div> <span id="final_invoice_destination_count">1</span> Booking Slots</div>
                                                <div>
                                                    <span id="final_invoice_price">GHS 200</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='invoice-tax'>
                                        <div>
                                            <div>3% Platform Fee</div>
                                        </div>
                                        <div>
                                            <span id="final_invoice_platform_fee">
                                                GHS 6
                                            </span>
                                        </div>
                                    </div>
                                    <div class='invoice-total'>
                                        <div>TOTAL</div>
                                        <div>
                                            <span id="final_invoice_total">
                                                GHS 206
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-4 payment-btn-section">
                                <button class="btn easygo-btn-6" onclick="remind_me()">Remind me</button>
                                <button class="btn easygo-btn-1" onclick="payment_btn_click(this)">Select Package</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-4" id="experience-description-div" >
                        <?php

                            if($experience_description){

                                echo "
                                <h3 class='experience-title'>About this Experience</h3>
                                    <p class='experience-description'>
                                        $experience_description
                                    </p>
                                    ";
                            }


                            if($experience_tags){
                                $tag_text= "";
                                foreach($experience_tags as $tag){
                                    $tag_name = $tag["tag_name"];
                                    $tag_id = $tag["tag_id"];
                                    $tag_text .="
                                    <input type='checkbox' class='btn-check ' name='experience_tag' id='$tag_id' value='$tag_name' autocomplete='off' disabled>
                                    <label class='btn btn-outline-primary text-pill' for='7'>
                                        $tag_name
                                    </label>
                                    ";
                                }
                                echo "
                                <div class='text-pill-group'>
                                    $tag_text
                                </div>";
                            }

                        ?>
                    </div>
                    <div class="summary-itinerary-section">

                        <?php
                        $groupedPlans = array();

                        foreach ($activities as $plan) {
                            $visitDate = date("Y-m-d", strtotime($plan["visit_date"]));

                            if (!isset($groupedPlans[$visitDate])) {
                                $groupedPlans[$visitDate] = array();
                            }

                            $groupedPlans[$visitDate][] = $plan;
                        }

                        // Start generating the HTML
                        $html = "";


foreach ($groupedPlans as $visitDate => $plans) {
    $html .= "<h5>" . date("jS F Y", strtotime($visitDate)) . "</h5>";
    $html .= "<ul class=''>";

    $previousDestination = '';

    foreach ($plans as $plan) {
        if ($plan["destination_name"] !== $previousDestination) {
            if ($previousDestination !== '') {
                $html .= "</ul>"; // Close previous destination's activity list
            }
            $html .= "<li class='d-flex'>" . $plan["destination_name"] . "</li>";
            $html .= "<ul>";
            $previousDestination = $plan["destination_name"];
        }
        $html .= "<li>" . $plan["activity_name"] . "</li>";
    }

    $html .= "</ul>"; // Close the last destination's activity list
    $html .= "</ul>";
}


                        // Output the HTML
                        echo $html;
                    //     $activity = $activities[0];
                    //     $current_day = $activity["visit_date"];
                    //     $current_destination = $activity["destination_id"];
                    //     $day_count = 1;
                    //     $destination_count = 1;
                    //     $destination_name = $activity["destination_name"];
                    //     $location = $activity["location"];
                    //     $section_text = "
                    //         <div class='summary-itinerary-title'> Day $day_count </div>
                    //         <div class='summary-itinerary-row'>
                    //             <div class='summary-itinerary-location'>
                    //                 <div class='summary-itin-title'> Destination $destination_count </div>
                    //                 <div class='summary-itin-name'> $destination_name </div>
                    //                 <div class='summary-itin-specloc'> $location </div>
                    //                     <div class='summary-itin-highlights'>";

                    //     foreach ($activities as $activity) { //activities sorted by date and then destination

                    //         //Print a new day if the date has changed
                    //         if ($activity["visit_date"] != $current_day) {
                    //             $current_day = $activity["visit_date"];
                    //             $current_destination = null;
                    //             $day_count += 1;
                    //             $section_text .= "
                    //                 </div>
                    //                 </div>
                    //             </div>
                    //             <div class='summary-itinerary-day'>
                    //                 <div class='summary-itinerary-title'> Day $day_count </div>
                    //                 <div class='summary-itinerary-row'>";
                    //         }

                    //         // print a new destination if destination has changed
                    //         if ($activity["destination_id"] != $current_destination) {
                    //             $destination_count += 1;
                    //             $current_destination = $activity["destination_id"];
                    //             $destination_name = $activity["destination_name"];
                    //             $location = $activity["location"];
                    //             $section_text .= "
                    //                 </div>
                    //             </div>
                    //             <div class='summary-itinerary-location'>
                    //                 <div class='summary-itin-title'> Destination $destination_count </div>
                    //                 <div class='summary-itin-name'> $destination_name </div>
                    //                 <div class='summary-itin-specloc'> $location </div>
                    //                     <div class='summary-itin-highlights'>";
                    //         }

                    //         //print new activity
                    //         $activity_name = $activity["activity_name"];
                    //         $section_text .= "
                    //         <div class='activity-span'> $activity_name</div>";
                    //     }
                    //     $section_text .="
                    //     </div>
                    // </div>";
                    //     echo $section_text;

                        ?>

                    </div>
                </div>
            </div>
        </main>
    </div>


<div class="modal" id="image-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
            <img class="modal-image"  id="modal-image" src="" alt="" srcset="">
    </div>
</div>



    <?php require_once(__DIR__."/../components/footer.php") ?>

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
<script src="https://js.paystack.co/v1/inline.js"></script>


<?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
<script src="../assets/js/general.js"></script>
<script src="../assets/js/functions.js"></script>
<script src="../assets/js/experience_info.js"></script>

</html>