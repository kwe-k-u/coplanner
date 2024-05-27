<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
$mixpanel = new mixpanel_class();
$mixpanel->log_page_view();

if (isset($_GET["id"])) {
    $itinerary_id = $_GET["id"];
    $itinerary = get_itinerary_by_id($itinerary_id);
    $date_created = format_string_as_date_fn($itinerary["date_created"]);
    $owner_name = $itinerary["owner_name"];
    $owner_id = $itinerary["owner_id"];
    $budget = $itinerary["budget"];
    $itinerary_name = $itinerary["itinerary_name"];
    $mixpanel->log_itinerary_views($itinerary_id,$itinerary_name);
    $days = get_itinerary_days($itinerary_id);
    $itinerary_image = $itinerary["media_location"];

}  else {
    echo "url broken";
    die();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>
<link rel="stylesheet" href="trip_summary.css">
    <!-- Bootstrap css -->
    <link rel="preconnect" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="top_bar.css"> -->
    <link rel="stylesheet" href="../assets/css/general.css">


<body class="bg-gray-3">


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
                            <div class="itin-summary-title">
                                Itinerary Description
                            </div>
                            <div class="right-summary-main">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley of type and scrambled it to make a type specimen book. It has survived not only five
                                centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                passages, and more recently with desktop publishing software like Aldus PageMaker including
                                versions of Lorem Ipsum.
                            </div>

                        </div>
                        <div class="left-summary">
                            <div class="bill-header">
                                <p>Bill</p>
                            </div>
                            <div class="itinerary-image  d-sm-block d-md-none mb-4">
                                <?php
                                    echo "<img src='$itinerary_image' />";
                                ?>
                            </div>


                            <div class="invoice-main " id="invoice_section">
                                <div class="invoice-container ">
                                    <?php
                                    $bill = get_travel_plan_bill($itinerary_id);
                                    $price = $bill["price"];
                                    $num_destinations = $bill["num_destinations"];
                                    $currency = $bill["currency_name"];
                                    $platform_fee = $bill["platform_fee"];
                                    $total = $platform_fee + $price;

                                        echo "
                                        <div class='invoice-id'>
                                            Itinerary ID: <span>$itinerary_id </span>
                                        </div>
                                        <div class='invoice-dest'>
                                            <div class='invoice-dets'>
                                                <p> Activities </p>
                                                <div>
                                                    <div> $num_destinations destinations</div>
                                                    <div>$currency <span>$price</span></div>
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

                            <div class="invoice-main hide" id="user_info_section">
                                <div class="invoice-container">
                                    <?php
                                    if(is_session_logged_in()){
                                        $user_info = get_user_info(get_session_user_id());
                                        $name = $user_info["user_name"];
                                        $email = $user_info["email"];
                                        $phone = $user_info["phone"];
                                    }else{
                                        $name = "";
                                        $email = "";
                                        $phone = "";

                                    }
                                        echo "
                                        <div class='form-input-field'>
                                            <label for='name'>Your name</label>
                                            <input type='text' id='user_info_name' value='$name'>
                                        </div>
                                        <div class='form-input-field'>
                                            <label for='name'>Email</label>
                                            <input type='text' id='user_info_email' value='$email'>
                                        </div>
                                        <div class='form-input-field'>
                                            <label for='name'>Phone number</label>
                                            <input type='tel'  id='user_info_phone' value='$phone'>
                                        </div>
                                        ";
                                        ?>
                                    <center class="justify-content-center align-items-center">
                                        Or
                                    </center>

                                    <center class='justify-content-end'>
                                        <?php
                                            if(!is_session_logged_in()){
                                                google_auth_btn();
                                            }
                                        ?>
                                    </center>
                                </div>
                            </div>

                            <div class="invoice-main hide" id="booking_info_section">
                                <div class="invoice-container">
                                    <div class="form-input-field">
                                        <label for="name">Select Your preferred start date</label>
                                        <?php
                                            $num_days = count($days)-1;
                                            echo "<input type='date' id='preferred_start_date' onchange='on_preferred_date_change(this,$num_days);')>";
                                        ?>

                                        <label for="name">End Date</label>
                                        <input type="date" id="preferred_end_date" disabled>
                                    </div>
                                    <div class="form-input-field">
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
                                                    <div> <span id="final_invoice_destination_count">1</span> destinations</div>
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
                                <a class="btn easygo-btn-6">Remind me</a>
                                <button class="btn easygo-btn-1" onclick="payment_btn_click(this)">Book A Seat</button>
                            </div>
                        </div>
                    </div>
                    <div class="summary-itinerary-section">
                        <?php
                            foreach($days as $current_day){
                                $day_id = $current_day["day_id"];
                                $day = get_itinerary_day_info($day_id);
                                $destinations = $day["destinations"];

                                // ===== [start] day =====
                                echo "
                                <div class='summary-itinerary-day'>
                                    <div class='summary-itinerary-title'> Day 1 </div>
                                    <div class='summary-itinerary-row'>
                                ";
                                // ===== [start] day =====
                                // ===== [start] destinations =====

                                foreach($destinations as $destination){
                                    $destination_name = $destination["destination_name"];
                                    $location = $destination["location"];
                                    echo "
                                    <div class='summary-itinerary-location'>
                                        <div class='summary-itin-title'> Destination 1 </div>
                                        <div class='summary-itin-name'> $destination_name </div>
                                        <div class='summary-itin-specloc'> $location </div>
                                        <div class='summary-itin-highlights'>";
                                        $activities = $destination["activities"];
                                        for ($index=0; $index < min(count($activities),3); $index++) {

                                            $activity= $activities[$index];
                                            $activity_name = $activity["activity_name"];
                                            echo "
                                            <div class='activity-span'> $activity_name</div>
                                            ";
                                        }
                                        if(count($activities) > 3){
                                            $count = count($activities) - 3;
                                            echo "<div class='summary-itin-highlight-more'> +<span>$count</span> more</div>";
                                        }
                                    echo "</div>
                                    </div>
                                    ";
                                }


                                // ===== [END] destinations =====
                                // ===== [END] day =====
                                echo "
                                    </div>
                                </div>
                                ";
                                // ===== [END] day =====
                            }
                        ?>

                    </div>
                </div>
            </div>
        </main>
    </div>

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
    <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>

    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="trip_summary.js"></script>

</html>