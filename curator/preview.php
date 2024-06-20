<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");


$mixpanel = new mixpanel_class();
$mixpanel->log_page_view("Curator preview");

	$info =get_curator_account_by_user_id(get_session_user_id());//get_collaborator_info(get_session_user_id());
	$user_info = get_user_info(get_session_user_id());
	$curator_id = $info["curator_id"];
	$user_name = $user_info["user_name"];
	$curator_name = $info["curator_name"];

	$logo = $info["logo_location"];//$info["curator_logo"];

    $experience_id = $_GET["experience_id"];
    $experience = get_shared_experience_by_id($experience_id);
    $date_created = "";
    $owner_name = $experience["curator_name"];
    $total = $experience["total_fee"];
    $platform_fee = $experience["platform_fee"];
    $listing_fee = $experience["booking_fee"];

    $media_location = $experience["media_location"];
    $experience_name = $experience["experience_name"];
    $experience_description = $experience["experience_description"];
    $experience_image = $experience["media_location"];
    $currency = $experience["currency_name"];
    $activities = get_shared_experience_activities($experience_id);


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
        <?php echo "easyGo - $experience_name" ?>
    </title>
</head>
<link rel="stylesheet" href="../assets/css/trip_summary.css">
<!-- Bootstrap css -->
<link rel="preconnect" href="../assets/css/bootstrap.min.css">
<!-- Fontawesome css -->
<link rel="preconnect" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <link rel="stylesheet" href="top_bar.css"> -->
<link rel="stylesheet" href="../assets/css/general.css">
<link rel="stylesheet" type="text/css" href="../assets/css/trip_summary.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dash.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/experience_preview.css">


<body class="bg-gray-3">
    <?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>

	<?php
		require_once(__DIR__."/../components/new_dash_header.php");
		require_once(__DIR__."/../components/new_dash_sidebar.php");
	?>

<main class=" ">

<div class="right-body-container">

    <div class="content-container">
        <div class="summary-content">
            <div class="right-summary">


                <div class="right-summary-title">
                    <?php
                    echo "
                        <h2>$experience_name</h2>
                        <small>by $owner_name</small>
                        "
                    ?>
                </div>
                <div class="itinerary-image d-none d-lg-block d-md-block">
                    <?php
                    echo "<img src='$experience_image' />";
                    ?>
                </div>
                <?php

                ?>
                <!-- <div class="itin-summary-title">
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
                </div> -->

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
                <button class="btn easygo-btn-1 w-100" onclick="toggle_experience_visibility()">Publish</button>
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
<script src="../assets/js/experience_preview.js"></script>

</html>