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
    $activities = get_shared_experience_activities($experience_id);
    $mixpanel->log_shared_experience_view($experience_id, $itinerary_name);
    $experience_description = $itinerary["experience_description"];
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
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
<!-- <link rel="stylesheet" href="top_bar.css"> -->
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


                            <div class="right-summary-title">
                                <?php
                                echo "
                                    <h2>$itinerary_name</h2>
                                    <small>by $owner_name</small>
                                    "
                                ?>
                            </div>
                            <div class="itinerary-image d-none d-lg-block d-md-block">
                                <?php
                                echo "<img src='$itinerary_image' />";
                                ?>
                            </div>
                            <?php
                                if($experience_description){

                                echo "
                                <div class='itin-summary-title'>
                                    Experience Description
                                </div>
                                <div class='right-summary-main'>
                                    $experience_description
                                </div>";
                                }
                            ?>

                        </div>
                        <div class="left-summary">
                            <div class="bill-header" style="opacity:0;">
                                <p>Bill</p>
                            </div>
                            <div class="itinerary-image  d-sm-block d-md-none mb-4">
                                <?php
                                echo "<img src='$itinerary_image' />";
                                ?>
                            </div>


                            <div class="invoice-main hide " id="invoice_section">
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

                            <div class="invoice-main " id="user_info_section">
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

                            <div class="invoice-main hide" id="booking_info_section">
                                <div class="invoice-container">

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

                            <div class="invoice-main hide" id="tc_section">
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

                            <div class="invoice-main hide" id="final_invoice_section">
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
                                <button class="btn easygo-btn-6" id="remind-me-btn">Remind me</button>
                                <button class="btn easygo-btn-1" id="payment_btn" onclick="payment_btn_click(this)">Book A Seat</button>
                            </div>
                        </div>
                    </div>
                    <div class="summary-itinerary-section">
                        <?php
                        $activity = $activities[0];
                        $current_day = $activity["visit_date"];
                        $current_destination = $activity["destination_id"];
                        $day_count = 1;
                        $destination_count = 1;
                        $destination_name = $activity["destination_name"];
                        $location = $activity["location"];
                        $section_text = "
                            <div class='summary-itinerary-title'> Day $day_count </div>
                            <div class='summary-itinerary-row'>
                                <div class='summary-itinerary-location'>
                                    <div class='summary-itin-title'> Destination $destination_count </div>
                                    <div class='summary-itin-name'> $destination_name </div>
                                    <div class='summary-itin-specloc'> $location </div>
                                        <div class='summary-itin-highlights'>";

                        foreach ($activities as $activity) { //activities sorted by date and then destination

                            //Print a new day if the date has changed
                            if ($activity["visit_date"] != $current_day) {
                                $current_day = $activity["visit_date"];
                                $current_destination = null;
                                $day_count += 1;
                                $section_text .= "
                                    </div>
                                    </div>
                                </div>
                                <div class='summary-itinerary-day'>
                                    <div class='summary-itinerary-title'> Day $day_count </div>
                                    <div class='summary-itinerary-row'>";
                            }

                            // print a new destination if destination has changed
                            if ($activity["destination_id"] != $current_destination) {
                                $destination_count += 1;
                                $current_destination = $activity["destination_id"];
                                $destination_name = $activity["destination_name"];
                                $location = $activity["location"];
                                $section_text .= "
                                    </div>
                                </div>
                                <div class='summary-itinerary-location'>
                                    <div class='summary-itin-title'> Destination $destination_count </div>
                                    <div class='summary-itin-name'> $destination_name </div>
                                    <div class='summary-itin-specloc'> $location </div>
                                        <div class='summary-itin-highlights'>";
                            }

                            //print new activity
                            $activity_name = $activity["activity_name"];
                            $section_text .= "
                            <div class='activity-span'> $activity_name</div>";
                        }
                        $section_text .="
                        </div>
                    </div>";
                        echo $section_text;

                        // foreach($days as $current_day){
                        //     $day_id = $current_day["day_id"];
                        //     $day = get_itinerary_day_info($day_id);
                        //     $destinations = $day["destinations"];

                        //     // ===== [start] day =====
                        //     echo "
                        //     <div class='summary-itinerary-day'>
                        //         <div class='summary-itinerary-title'> Day 1 </div>
                        //         <div class='summary-itinerary-row'>
                        //     ";
                        //     // ===== [start] day =====
                        //     // ===== [start] destinations =====

                        //     foreach($destinations as $destination){
                        //         $destination_name = $destination["destination_name"];
                        //         $location = $destination["location"];
                        //         echo "
                        //         <div class='summary-itinerary-location'>
                        //             <div class='summary-itin-title'> Destination 1 </div>
                        //             <div class='summary-itin-name'> $destination_name </div>
                        //             <div class='summary-itin-specloc'> $location </div>
                        //             <div class='summary-itin-highlights'>";
                        //             $activities = $destination["activities"];
                        //             for ($index=0; $index < min(count($activities),3); $index++) {

                        //                 $activity= $activities[$index];
                        //                 $activity_name = $activity["activity_name"];
                        //                 echo "
                        //                 <div class='activity-span'> $activity_name</div>
                        //                 ";
                        //             }
                        //             if(count($activities) > 3){
                        //                 $count = count($activities) - 3;
                        //                 echo "<div class='summary-itin-highlight-more'> +<span>$count</span> more</div>";
                        //             }
                        //         echo "</div>
                        //         </div>
                        //         ";
                        //     }


                        //     // ===== [END] destinations =====
                        //     // ===== [END] day =====
                        //     echo "
                        //         </div>
                        //     </div>
                        //     ";
                        //     // ===== [END] day =====
                        // }
                        ?>

                    </div>
                </div>
            </div>
        </main>
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