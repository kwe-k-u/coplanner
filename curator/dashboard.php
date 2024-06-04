<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
if (!is_session_user_curator()) {
    header("Location: ../index.php");
    die();
}

$info =get_curator_account_by_user_id(get_session_user_id());//get_collaborator_info(get_session_user_id());
$user_info = get_user_info(get_session_user_id());
$curator_id = $info["curator_id"];
$user_name = $user_info["user_name"];
$curator_name = $info["curator_name"];
$logo = "";//$info["curator_logo"];




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator - Dashboard</title>
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
                <img class="img-fluid" src="../assets/images/site_images/logo.png" alt="easygo logo">
            </div>
            <?php
            $greeting = greet();


            echo "
                <div class='dashboard-title easygo-fs-1 '>$greeting, <span class='easygo-fw-1'>$user_name</span></div>
            <div class='right-sec'>
                <div class='user-menu d-flex gap-1'>
                    <div class='user-icon'>
                        <img src='../assets/images/others/profile.jpeg' alt=''>
                    </div>
                    <div class='d-flex flex-column justify-content-center'>
                        <h5 class='easygo-fs-3'>$curator_name</h5>
                        <h6 class='text-orange easygo-fs-5'>$user_name</h6>
                    </div>
                </div>
            </div>
                ";
            ?>

        </header>
            <?php require_once(__DIR__."/../components/curator_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
            <?php require_once(__DIR__. "/../components/curator_navbar_desktop.php"); ?>
            <div class="main-content px-3 bg-gray-3">

                <div class="quick-actions col bg-white-1">
                    <h5>Quick Actions</h5>
                    <div class="d-flex gap-2 flex-xs-column flex-md-row">
                        <div class="">
                            <button class="easygo-btn-5" onclick="create_itinerary()">Create Tour</button>
                        </div>
                    </div>
                </div>
                <!-- ============================== -->
                <!-- stat cards [start] -->
                <section class="stat-cards pt-5">
                    <div class="row">
                        <?php
                        $upcoming = $info["active_listings"];
                        $booking_count = $info["booking_count"];
                        $revenue = format_string_as_currency_fn($info["revenue"]);

                        echo "
                        <div class='col-lg-4 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/bus_red_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Active Listings</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>$upcoming</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/bus_black_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Number of Bookings</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>$booking_count</div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4 col-sm-6 py-3'>
                            <div class='info-card m-auto bg-white'>
                                <div class='info-img'>
                                    <img src='../assets/images/svgs/bus_black_bg.svg' alt='bus image'>
                                </div>
                                <div class='info-content'>
                                    <div class='text-gray-1 info-title easygo-fs-4'>Revenue</div>
                                    <div class='info-num easygo-fs-2 easygo-fw-1'>GHS $revenue</div>
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
                    $upcoming_trips = get_curator_listings($curator_id);
                    if($upcoming_trips){
                        $trip_list_display = "";

                        foreach ($upcoming_trips as $entry) {

                            $title = $entry["experience_name"];
                            $camp_id = $entry["experience_id"];
                            $start_date = format_string_as_date_fn($entry["start_date"]);
                            $currency = $entry["currency_name"];
                            $fee = $entry["booking_fee"];
                            $img = $entry["media_location"];//$entry["media"][0]["media_location"];

                            $trip_list_display .="

                            <div class='trip-card-2' style='min-width: 400px; max-width: 550px;'>
                            <div class='trip-card-img'>
                                <img src='$img' alt='tour 3'>
                            </div>
                            <div class='trip-card-content'>
                                <h5 class='header'>$title</h5>
                                <div class='easygo-fs-5 d-flex align-items-center justify-content-between'>
                                    <div><i class='fa-regular fa-calendar-days'></i>  $start_date</div>
                                    <div><i class='fa-solid fa-pen-to-square'></i> 15 Booked Seats</div>
                                </div>
                                <div class='easygo-fs-5'>
                                    <i class='fa-solid fa-map-pin'></i> Pickup coming soon
                                </div>
                                <div class='py-3 d-flex justify-content-between align-items-center easygo-fs-5'>
                                    <span><i class='fa-solid fa-tag'></i> $currency $fee</span>
                                    <!-- <a class='btn px-3 py-1 border easygo-fs-5' href='../coplanner/edit_itinerary.php?id=$camp_id'>Edit</a> -->
                                </div>
                            </div>
                        </div>
                            ";
                        }
                        echo "<section class='upcoming-trips pt-5'>
                        <h5 class='easygo-fs-4 easygo-fw-1'>Upcoming Trips</h5>
                        <div class='d-flex gap-2 w-100' style='overflow-x: auto;'>
                                $trip_list_display
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
                                $bookings = get_curator_bookings($curator_id);

                                if ($bookings) {
                                    echo "
                                        <div class='list-item list-header'>
                                            <div class='item-bullet-container'>
                                            </div>
                                            <div class='inner-item'>Transaction Id</div>
                                            <div class='inner-item'>Booking Date</div>
                                            <div class='inner-item'>User</div>
                                            <div class='inner-item'>Amount</div>
                                            <div class='inner-item'>Seats</div>
                                            <div class='inner-item'>Tour Name</div>
                                            <div class='inner-item'>Tour Date</div>
                                        </div>
                                            ";
                                    foreach ($bookings as $entry) {
                                        $transaction_id = $entry["transaction_id"];
                                        $name = $entry["user_name"];
                                        $date_booked = format_string_as_date_fn($entry["date_booked"]);
                                        $transaction_amount = $entry["amount"];
                                        $currency = $entry["currency_name"];
                                        $seats = $entry["seats_booked"];
                                        $trip_date = format_string_as_date_fn($entry["start_date"]);
                                        $trip_name = $entry["experience_name"];
                                        echo "
                                <div class='list-item'>
                                    <div class='item-bullet-container'>
                                        <div class='item-bullet'></div>
                                    </div>
                                    <div class='inner-item'>$transaction_id</div>
                                    <div class='inner-item'>$date_booked</div>
                                    <div class='inner-item'>$user_name</div>
                                    <div class='inner-item text-success'>$currency $transaction_amount</div>
                                    <div class='inner-item'>$seats seats</div>
                                    <div class='inner-item'>$trip_name</div>
                                    <div class='inner-item'>$trip_date</div>
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
                            <a href="./trip_booking.php" class="easygo-btn-1">View Bookings</a>
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
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>