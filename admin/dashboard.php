<?php
    require_once(__DIR__ . "/../utils/core.php");
    require_once(__DIR__ . "/../controllers/admin_controller.php");
    // require_once(__DIR__ . "/../controllers/curator_interraction_controller.php");

    // if (!is_session_user_admin()) {
    //     header("Location: ../views/index.php");
    //     die();
    // }

    // $info = get_user_by_id(get_session_user_id());


	if(!is_session_user_admin()){
		header("Location: ../index.php");
		die();
	}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <!-- ============================== -->
    <!-- dashboard-wrapper [start] -->
    <div class="main-wrapper">
        <header class="dashboard-header d-none d-lg-flex py-4 bg-gray-3" style="box-shadow: none;">
            <div class="dashlogo logo logo-medium">
                <img class="img-fluid" src="../assets/images/site_images/logo.webp" alt="easygo logo">
            </div>
            <?php
            $greeting = greet();


            // echo "
            //     <div class='dashboard-title easygo-fs-1 '>$greeting, <span class='easygo-fw-1'>$user_name</span></div>
            // <div class='right-sec'>
            //     <div class='user-menu d-flex gap-1'>
            //         <div class='user-icon'>
            //             <img src='../assets/images/others/profile.webp' alt=''>
            //         </div>
            //         <div class='d-flex flex-column justify-content-center'>
            //             <h5 class='easygo-fs-3'>$curator_name</h5>
            //             <h6 class='text-orange easygo-fs-5'>$user_name</h6>
            //         </div>
            //     </div>
            // </div>
            //     ";
            ?>

        </header>
        <?php require_once(__DIR__ . "/../components/admin_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
            <?php require_once(__DIR__ . "/../components/admin_navbar_desktop.php"); ?>
            <div class="main-content px-3 bg-gray-3">

                <div class="quick-actions col bg-white-1 p-3">
                    <h5>Quick Actions</h5>
                    <!-- <div class="row">
                        <div>
                            <button class="easygo-btn-5" onclick="goto_page('curator/create_a_tour.php')">Create Tour</button>
                        </div>
                        <div>
                            <button class="easygo-btn-5" onclick="goto_page('admin/locations.php')">Add Location</button>
                        </div>
                    </div> -->
                    <div class="d-flex gap-2 flex-xs-column flex-md-row">
                        <div class="">
                            <button class="easygo-btn-5" onclick="create_itinerary()">Create Itinerary</button>
                        </div>
                        <div class="">
                            <button class="easygo-btn-5" onclick="goto_page('admin/locations.php')">Add Location</button>
                        </div>
                    </div>
                </div>
                <!-- ============================== -->
                <!-- stat cards [start] -->
                <section class="stat-cards pt-5">
                    <div class="row">
                        <?php
                        $stats = get_stats();

                        $user_count = $stats["user_count"];
                        $itinerary_count = $stats["itinerary_count"];
                        $signup_count = $stats["signup_count"];
                        $destination_count = $stats["destination_count"];
                        $total_itinerary_value = $stats["total_itinerary_value"];
                        $average_booking_value = $stats["average_booking_value"];
                        $average_itinerary_participants = $stats["average_itinerary_participants"];
                        $total_booking_value = $stats["total_booking_value"];


                        echo "
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/bus_red_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Number of Users</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>$user_count</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/bus_black_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Signups this week</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>$signup_count</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/bus_black_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Itineraries created</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>$itinerary_count</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/barchart_blue_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Number of destinations</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'> $destination_count</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/wallet_orange_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Total Itinerary Value</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>GHS $total_itinerary_value</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/wallet_orange_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Total Booking Value</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>GHS $total_booking_value</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/wallet_orange_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Average Booking Value</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>GHS $average_booking_value</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/wallet_orange_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Average number of participants</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>$average_itinerary_participants</div>
                                </div>
                            </div>
                        </div>
                        ";
                        ?>

                    </div>
                </section>
                <!-- stat cards [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- upcoming trips [start] -->
                <?php
                $upcoming_trips = null;//get_upcoming_tours();
                if ($upcoming_trips) {
                    $trip_list_display = "";

                    foreach ($upcoming_trips as $entry) {
                        $title = $entry["title"];
                        $camp_id = $entry["campaign_id"];
                        $start_date = format_string_as_date_fn($entry["start_date"]);
                        $end_date = format_string_as_date_fn($entry["end_date"]);
                        $currency = $entry["currency"];
                        $fee = $entry["fee"];
                        $img = $entry["media"][0]["media_location"];
                        $curator_name = $entry["curator_name"];

                        $trip_list_display .= "

                            <div class='trip-card-2'>
                            <div class='trip-card-img'>
                                <img src='$img' alt='tour 3'>
                            </div>
                            <div class='trip-card-content'>
                                <h5 class='header'>$title</h5>
                                <div class='easygo-fs-5 text-orange'>
                                    <i class='fa-solid fa-map-pin'></i> <b>$curator_name</b>
                                </div>
                                <div class='easygo-fs-5 d-flex align-items-center justify-content-between'>
                                    <div><i class='fa-regular fa-calendar-days'></i>  $start_date - $end_date</div>
                                    <div><i class='fa-solid fa-pen-to-square'></i> 15 Booked Seats</div>
                                </div>
                                <div class='py-3 d-flex justify-content-between align-items-center easygo-fs-5'>
                                    <span><i class='fa-solid fa-tag'></i> $currency $fee</span>
                                    <a class='btn px-3 py-1 border easygo-fs-5' href='./create_a_tour.php?id=$camp_id'>Edit</a>
                                </div>
                            </div>
                        </div>
                            ";
                    }
                    echo "<section class='upcoming-trips pt-5'>
                        <h5 class='easygo-fs-4 easygo-fw-1'>Most Viewed Destinations</h5>
                        <div class='d-flex gap-2 w-100' style='overflow-x: auto;'>
                            <div class='col-lg-4 col-md-6 pb-4'>
                                $trip_list_display
                            </div>
                        </div>
                    </section>";
                }

                ?>

                <!-- upcoming trips [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- recent bookings [start] -->
                <section class="upcoming-trips py-5">
                    <div class="w-100 bg-white easygo-rounded-3">
                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                            <h5 class="easygo-fs-4 easygo-fw-1">Recent Bookings</h5>
                            <button class="three-dots-btn">
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </button>
                        </div>
                        <div class="p-3" style="overflow-x: auto;">
                            <div class="easygo-list-3" style="min-width: 992px;">
                                <?php
                                $bookings = array();//get_bookings();

                                $bookings = array_slice($bookings, 0, 5);

                                if ($bookings) {
                                    echo "
                                        <div class='list-item list-header'>
                                            <div class='item-bullet-container'>
                                            </div>
                                            <div class='inner-item'>Transaction Id</div>
                                            <div class='inner-item'>Booking Date</div>
                                            <div class='inner-item'>User</div>
                                            <div class='inner-item'>Amount</div>
                                            <div class='inner-item'>Taxes</div>
                                            <div class='inner-item'>Charges</div>
                                            <div class='inner-item'>Seats</div>
                                            <div class='inner-item'>Tour Name</div>
                                            <div class='inner-item'>Tour Date</div>
                                            <div class='inner-item'>Emergency Contact</div>
                                        </div>
                                            ";
                                    foreach ($bookings as $entry) {
                                        $transaction_id = $entry["transaction_id"];
                                        $name = $entry["user_name"];
                                        $date_booked = format_string_as_date_fn($entry["date_booked"]);
                                        $contact_name = $entry["emergency_contact_name"];
                                        $contact_number = $entry["emergency_contact_number"];
                                        $transaction_amount = $entry["amount"];
                                        $currency = $entry["currency"];
                                        $seats = $entry["seats_booked"];
                                        $trip_date = format_string_as_date_fn($entry["start_date"]);
                                        $trip_name = $entry["title"];
                                        $tax = $entry["tax"];
                                        $charge = $entry["charges"];
                                        echo "
                                        <div class='list-item'>
                                            <div class='item-bullet-container'>
                                                <div class='item-bullet'></div>
                                            </div>
                                            <div class='inner-item'>$transaction_id</div>
                                            <div class='inner-item'>$date_booked</div>
                                            <div class='inner-item'>$name</div>
                                            <div class='inner-item text-success'>$currency $transaction_amount</div>
                                            <div class='inner-item text-danger'>$currency $tax</div>
                                            <div class='inner-item text-danger'>$currency $charge</div>
                                            <div class='inner-item'>$seats seats</div>
                                            <div class='inner-item'>$trip_name</div>
                                            <div class='inner-item'>$trip_date</div>
                                            <div class='inner-item'>$contact_name - $contact_number</div>
                                        </div>
                                    ";
                                    }
                                } else {
                                    echo "
                            <div class='list-item'>
                                <div class='item-bullet-container'>
                                    <div class='item-bullet' ></div>
                                </div>
                                <div class='inner-item'> You don't have bookings as of now
                                Promote your listing on social media to increase visibility
                                </div>
                            </div>
                                ";
                                }

                                ?>

                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center p-3">
                            <a href="./transactions.php" class="easygo-btn-1">View Bookings</a>
                        </div>
                    </div>
                </section>
                <!-- recent bookings [end] -->
                <!-- ============================== -->
            </div>
        </main>
        <!-- dashboard-content [end] -->
        <!-- ============================== -->
    </div>
    <!-- main-wrapper [end] -->
    <!-- ============================== -->
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>