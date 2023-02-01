<?php
    require_once(__DIR__. "/../utils/core.php");
    require_once(__DIR__."/../controllers/curator_interraction_controller.php");

    if (!is_session_user_curator()){
        header("Location: ../views/home.php");
        die();
    }

    $info = get_collaborator_info(get_session_user_id());
    $user_name = $info["user_name"];
    $curator_name = $info["curator_name"];
    $logo = $info["curator_logo"];




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <div class="logo logo-medium">
                <img class="img-fluid" src="../assets/images/svgs/logo.svg" alt="easygo logo">
            </div>
            <?php
            $greeting = greet();


                echo "
                <div class='dashboard-title easygo-fs-1 easygo-fw-1'>$greeting, $user_name</div>
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
        <header class="nav-menu d-lg-none">
            <div class="nav-menu-title bg-blue text-white easygo-fw-1 py-3 ps-3 d-flex justify-content-between">
                <h6 class="m-0">Dashboard</h6>
                <button data-target="dashboard-menu" class="burger-btn slide-down-btn">
                    <div></div>
                    <div></div>
                    <div></div>
                </button>
            </div>
            <div id="dashboard-menu" class="slide-down-sub-menu">
                <ul class="main-list">
                    <li>
                        <div class="slide-down-menu">
                            <a data-target="dashboard-submenu" class="slide-down-btn" href="#">
                                <img src="../assets/images//svgs/dashboard.svg" alt="dashboard image"> Dashboard <span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
                            <ul id="dashboard-submenu" class="sub-menu slide-down-sub-menu">
                                <li><a href="#">Trips</a></li>
                                <li><a href="#">Finance</a></li>
                                <li><a href="#">Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#"><img src="../assets/images/svgs/trips.svg" alt="trips icon"> Trips</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/finance.svg" alt="finance icon"> Finance</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/notifications.svg" alt="notifications icon">Notifications</a></li>
                </ul>
            </div>
        </header>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
            <aside class="sidebar d-lg-flex d-none flex-column justify-content-between bg-gray-3">
                <ul class="main-list slide-down">
                    <li>
                        <div class="slide-down-menu">
                            <a data-target="dashboard-submenu-sb" class="slide-down-btn text-blue" style="border-right: solid 2px var(--easygo-blue);" href="#"><img src="../assets/images//svgs/dashboard.svg" alt="dashboard image"> Dashboard <span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
                            <ul id="dashboard-submenu-sb" class="sub-menu slide-down-sub-menu">
                                <li><a href="#">Trips</a></li>
                                <li><a href="#">Finance</a></li>
                                <li><a href="#">Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#"><img src="../assets/images/svgs/trips.svg" alt="trips icon"> Trips</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/finance.svg" alt="finance icon"> Finance</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/notifications.svg" alt="notifications icon">Notifications</a></li>
                </ul>
                <div class="py-4 border-top">
                    <a class="text-gray-1 easygo-fs-4" href="#"><img src="../assets/images/svgs/logout.svg" alt="logout icon"> Logout</a>
                </div>
            </aside>
            <div class="main-content px-3 bg-gray-3">
                <!-- ============================== -->
                <!-- stat cards [start] -->
                <section class="stat-cards pt-5">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/bus_red_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Listed Trips</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">54</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/bus_black_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Booked Trips</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">54</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/barchart_blue_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Total Revenue</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">GHS 2,456.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/wallet_orange_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Withdrawable Balance</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">GHS 2,456.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- stat cards [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- upcoming trips [start] -->
                <section class="upcoming-trips pt-5">
                    <h5 class="easygo-fs-4 easygo-fw-1">Upcoming Trips</h5>
                    <div class="d-flex gap-2 w-100" style="overflow-x: auto;">
                        <div class="upcoming-trip-card">
                            <div class="ut-card-content">
                                <h2 class="title">Botanical Gardens Tour</h2>
                                <div class="ut-card-info">
                                    <div class="row">
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/calendar_white.svg" alt="calendar icon"> 12 Dec 2022 - 10 Jan 2023</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/seats_white.svg" alt="seats icon"> 30 Available Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/price_tag_white.svg" alt="Price tag icon"> GHc 150</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/list_pen_white.svg" alt="LIst and pen icon"> 15 Booked Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/map_pin_white.svg" alt="map pin icon"> Pickup coming soon</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ut-card-footer">
                                <a href="javascript:void(0)" class="ut-card-footer-item">View Listing</a>
                                <a href="javascript:void(0)" class="ut-card-footer-item">Send Notification</a>
                            </div>
                        </div>
                        <div class="upcoming-trip-card">
                            <div class="ut-card-content">
                                <h2 class="title">Botanical Gardens Tour</h2>
                                <div class="ut-card-info">
                                    <div class="row">
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/calendar_white.svg" alt="calendar icon"> 12 Dec 2022 - 10 Jan 2023</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/seats_white.svg" alt="seats icon"> 30 Available Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/price_tag_white.svg" alt="Price tag icon"> GHc 150</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/list_pen_white.svg" alt="LIst and pen icon"> 15 Booked Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/map_pin_white.svg" alt="map pin icon"> Pickup coming soon</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ut-card-footer">
                                <a href="javascript:void(0)" class="ut-card-footer-item">View Listing</a>
                                <a href="javascript:void(0)" class="ut-card-footer-item">Send Notification</a>
                            </div>
                        </div>
                        <div class="upcoming-trip-card">
                            <div class="ut-card-content">
                                <h2 class="title">Botanical Gardens Tour</h2>
                                <div class="ut-card-info">
                                    <div class="row">
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/calendar_white.svg" alt="calendar icon"> 12 Dec 2022 - 10 Jan 2023</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/seats_white.svg" alt="seats icon"> 30 Available Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/price_tag_white.svg" alt="Price tag icon"> GHc 150</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/list_pen_white.svg" alt="LIst and pen icon"> 15 Booked Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/map_pin_white.svg" alt="map pin icon"> Pickup coming soon</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ut-card-footer">
                                <a href="javascript:void(0)" class="ut-card-footer-item">View Listing</a>
                                <a href="javascript:void(0)" class="ut-card-footer-item">Send Notification</a>
                            </div>
                        </div>
                        <div class="upcoming-trip-card">
                            <div class="ut-card-content">
                                <h2 class="title">Botanical Gardens Tour</h2>
                                <div class="ut-card-info">
                                    <div class="row">
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/calendar_white.svg" alt="calendar icon"> 12 Dec 2022 - 10 Jan 2023</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/seats_white.svg" alt="seats icon"> 30 Available Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/price_tag_white.svg" alt="Price tag icon"> GHc 150</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/list_pen_white.svg" alt="LIst and pen icon"> 15 Booked Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/map_pin_white.svg" alt="map pin icon"> Pickup coming soon</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ut-card-footer">
                                <a href="javascript:void(0)" class="ut-card-footer-item">View Listing</a>
                                <a href="javascript:void(0)" class="ut-card-footer-item">Send Notification</a>
                            </div>
                        </div>
                        <div class="upcoming-trip-card">
                            <div class="ut-card-content">
                                <h2 class="title">Botanical Gardens Tour</h2>
                                <div class="ut-card-info">
                                    <div class="row">
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/calendar_white.svg" alt="calendar icon"> 12 Dec 2022 - 10 Jan 2023</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/seats_white.svg" alt="seats icon"> 30 Available Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/price_tag_white.svg" alt="Price tag icon"> GHc 150</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/list_pen_white.svg" alt="LIst and pen icon"> 15 Booked Seats</div>
                                        <div class="col-4 p-0"><img src="../assets/images/svgs/map_pin_white.svg" alt="map pin icon"> Pickup coming soon</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ut-card-footer">
                                <a href="javascript:void(0)" class="ut-card-footer-item">View Listing</a>
                                <a href="javascript:void(0)" class="ut-card-footer-item">Send Notification</a>
                            </div>
                        </div>
                    </div>
                </section>
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
                            $bookings = get_recent_bookings(get_session_account_id());

                            if($bookings){
                                foreach ($variable as $entry) {
                                    $transaction_id = $entry["transaction_id"];
                                    $name = $entry["user_name"];
                                    $date_booked = $entry["date_booked"];
                                    $contact_name = $entry["emergency_contact_name"];
                                    $contact_number = $entry["emergency_contact_number"];
                                    $amount_paid = $entry["amount"];
                                    $currency = $entry["currency"];
                                    $seats = $entry["seats"];
                                    $trip_date = $entry["trip_start_date"];
                                    $trip_name = $entry["title"];
                                }
                                echo "
                            <div class='list-item'>
                                <div class='item-bullet-container'>
                                    <div class='item-bullet'></div>
                                </div>
                                <div class='inner-item'>$transaction_id</div>
                                <div class='inner-item'>$date_booked</div>
                                <div class='inner-item'>$user_name</div>
                                <div class='inner-item'>$trip_name</div>
                                <div class='inner-item'>$trip_date</div>
                                <div class='inner-item'>$seats</div>
                                <div class='inner-item'>$currency $amount_paid</div>
                                <div class='inner-item'>$contact_name - $contact_number</div>
                                <div class='inner-item'>Success</div>
                            </div>
                                ";

                            }else {
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
    <script src="../assets/js/general.js"></script>
</body>

</html>