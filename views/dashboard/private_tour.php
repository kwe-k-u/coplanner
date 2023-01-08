<?php
require_once(__DIR__ . "/../../utils/core.php");
require_once(__DIR__ . "/../../controllers/interaction_controller.php");
require_once(__DIR__ . "/../../controllers/media_controller.php");
require_once(__DIR__ . "/../../controllers/private_tour_controller.php");
login_check();

$user_id = get_session_user_id();
// $user = ge($user_id);

$user_name = get_username_by_id($user_id);
$profile = get_user_profile_img($user_id);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - User Dashboard | Private Tour</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- swiper css -->
    <link rel="stylesheet" href="../../assets/css/swiper-bundle.min.css">
    <!-- easygo css -->
    <link rel="stylesheet" href="../../assets/css/general.css">
    <link rel="stylesheet" href="../../assets/css/home.css">
</head>

<body>

    <!-- main content start -->
    <div class="main-wrapper">
        <nav class="navbar d-md-none">
            <div class="container-fluid">
                <button class="navbar-toggler sidebar-toggler border-0 text-black" type="button" data-target="userdashboard-sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h5>Private Tour</h5>
                <button class="btn" onclick="goto_page('views/dashboard/notifications.php')"><i class="fa-solid fa-bell"></i></button>
        </nav>
        <main>
            <div class="loader"></div>
            <div class="dashboard-content">
                <!-- ============================== -->
                <!-- sidebar [start] -->
                <aside id="userdashboard-sidebar" class="sidebar sidebar-left bg-white">
                    <div class="sidebar-header py-3">
                        <div class="logo m-md-auto" onclick="return goto_page('views/home.php')">
                            <img class="logo-medium" src="../../assets/images/svgs/logo.svg" alt="easygo logo">
                        </div>
                        <button class="crossbars close-sidebar btn d-md-none" data-target="userdashboard-sidebar">
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                    </div>
                    <nav class="sidebar-navbar">
                        <div>

                            <ul class="sidebar-nav-menu">

                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 " href="./dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 " href="./trip_history.php"><i class="fa-solid fa-bus"></i> Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./private_tour.php"><i class="fa-solid fa-car"></i> Private Tour</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./saved_trips.php"><i class="fa-solid fa-bookmark"></i>Saved Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./notifications.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 " href="./settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 text-red" onclick="return logout()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class='d-flex justify-content-center my-3 d-md-none'>
                        <div class='d-flex gap-2'>
                            <?php
                                echo "<div class='user-icon bg-blue'>
                                <img src='$profile' alt=''>
                            </div>
                            <div class='d-flex flex-column justify-content-center gap-1'>
                                <h5 class='easygo-fs-4 m-0'>$user_name</h5>
                                <h6 class='text-gray-1 easygo-fs-5 m-0'>User profile</h6>
                            </div>";
                            ?>
                        </div>
                    </div>
                </aside>
                <!-- sidebar [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- dashboard content [start] -->
                <main class="main-content bg-gray-3">
                    <div class="px-lg-5 px-2">
                        <div class="main-content-header d-flex justify-content-between align-items-center py-4 d-none d-md-flex">
                            <h3 class="m-0">Private Tours</h3>
                            <div class="d-flex justify-content-center my-3">
                                <div class="d-flex gap-2">
                                    <?php
                                        echo "<div class='user-icon bg-blue'>
                                        <img src='$profile' alt=''>
                                    </div>
                                    <div class='d-flex flex-column justify-content-center gap-1'>
                                        <h5 class='easygo-fs-4 m-0'>$user_name</h5>
                                        <h6 class='text-gray-1 easygo-fs-5 m-0'>User profile</h6>
                                    </div>"
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="main-content-body py-2">
                            <!-- ============================== -->
                            <!-- private tour history [start] -->
                            <div class="private-tour-requests request-tour">
                                <div class="private-tour-request-header d-flex justify-content-between align-items-center">
                                    <h3 class="easygo-fs-3">Private Tour Request</h3>
                                    <button class="easygo-btn-1 easygo-fs-4 easygo-rounded-2 visibility-changer" data-visibility-target=".request-tour"><i class="fa-solid fa-circle-plus"></i> &nbsp; Request New Tour</button>
                                </div>
                                <!-- ============================== -->
                                <!-- | desktop | [start] -->
                                <div class="for-desktop d-none d-md-block">
                                    <div class="private-tour-request-items">
                                        <div class="easygo-list-3">
                                            <?php
                                                $requests = get_user_private_trip_requests($user_id);

                                                if (!$requests){ //TODO:: Show empty prompt
                                                    echo "empty";
                                                    // die();
                                                }

                                                foreach ($requests as $entry) {
                                                    $start = format_string_as_date_fn($entry["date_start"]);
                                                    $end = format_string_as_date_fn($entry["date_end"]);
                                                    $seats = $entry["person_count"];
                                                    $budget_min = $entry["min_budget"];
                                                    $budget_max = $entry["max_budget"];
                                                    $desc = shorten($entry["description"]);
                                                    $currency = $entry["currency"];
                                                    $tour_id = $entry["private_tour_id"];
                                                    $quote_count = count_request_quotes($tour_id);
                                                    $accepted_quote = $entry["accepted_quote"];

                                                    echo "<div class='list-item'>
                                                    <div class='w-100'>
                                                        <div class='d-flex justify-content-between'>
                                                            <div class='easygo-fs-5 text-gray-1 d-flex align-items-center gap-1'>
                                                                $currency $budget_min - $currency $budget_max
                                                                <span class='bg-gray-1 rounded-circle' style='width:7px; height: 7px'></span>
                                                                $start - $end
                                                                <span class='bg-gray-1 rounded-circle' style='width:7px; height: 7px'></span>
                                                                $seats people
                                                            </div>
                                                            <span class='easygo-badge-orange easygo-fs-5'>Ongoing</span>
                                                        </div>
                                                        <div class='easygo-fs-4 py-3'>
                                                            $desc
                                                        </div>
                                                        <div class='d-flex justify-content-between'>
                                                            <h5 class='easygo-fs-3 easygo-fw-1'>$quote_count Quotes received</h5>
                                                            <div class='d-flex gap-1'>
                                                                <button onclick='return delete_request(\"$tour_id\")' class='del-btn easygo-rounded-1 easygo-fs-5'><i class='fa-solid fa-trash'></i> Remove</button>";

                                                                if ($quote_count > 0){
                                                                    echo "<button onclick='return goto_page(\"views/dashboard/private_tour_quotes.php?request_id=$tour_id\")' class='easygo-btn-5 bg-lblue-1 easygo-rounded-1 easygo-fs-5 px-2'><i class='fa-solid fa-eye'></i> &nbsp; View Quotes</button>";
                                                                }
                                                                if ($accepted_quote){
                                                                    echo "<button class='easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3'><i class='fa-solid fa-eye'></i> &nbsp; View Request</button>";
                                                                } else {
                                                                    echo "<button onclick='edit_request(\"$tour_id\")' data-visibility-target='.request-tour' class='easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3 visibility-changer'><i class='fa-solid fa-pen'></i> &nbsp; Edit Request</button>";
                                                                }

                                                            echo "</div>
                                                        </div>
                                                    </div>
                                                </div>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- | desktop | [end] -->
                                <!-- ============================== -->
                                <!-- ============================== -->
                                <!-- | mobile | [start] -->
                                <div class="for-mobile d-block d-md-none">
                                    <div class="private-tour-request-items">
                                        <div class="easygo-list-3">
                                            <?php
                                                foreach ($requests as $entry) {

                                            $start = format_string_as_date_fn($entry["date_start"]);
                                            $end = format_string_as_date_fn($entry["date_end"]);
                                            $seats = $entry["person_count"];
                                            $budget_min = $entry["min_budget"];
                                            $budget_max = $entry["max_budget"];
                                            $desc = shorten($entry["description"]);
                                            $currency = $entry["currency"];
                                            $tour_id = $entry["private_tour_id"];
                                            $quote_count = count_request_quotes($tour_id);
                                            $accepted_quote = $entry["accepted_quote"];

                                                    echo "<div class='list-item'>
                                                    <div class='w-100'>
                                                        <div class='d-flex justify-content-between'>
                                                            <h5 class='easygo-fs-3 easygo-fw-1'>$quote_count Quotes received</h5>
                                                            <span class='easygo-badge-orange easygo-fs-5'>Ongoing</span>
                                                        </div>
                                                        <div class='easygo-fs-4 py-3'>
                                                        $desc
                                                        </div>
                                                        <div class='easygo-fs-5 text-gray-1 d-flex align-items-center gap-1'>
                                                            $currency $budget_min - $currency $budget_max <br>
                                                            $start - $end &nbsp; &nbsp;
                                                            $seats people
                                                        </div>
                                                        <div class='d-flex gap-1 flex-wrap py-3'>";
                                                        if ($quote_count > 0){

                                                            echo "<button class='easygo-btn-1 easygo-rounded-1 easygo-fs-5 px-2 w-100 my-2'><i class='fa-solid fa-eye'></i> &nbsp; View Quotes</button>";
                                                        }
                                                        if ($accepted_quote){
                                                            echo "<button class='easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3'><i class='fa-solid fa-eye'></i> &nbsp; View Request</button>";
                                                        } else {
                                                            echo "<button onclick='edit_request(\"$tour_id\")' data-visibility-target='.request-tour' class='easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3 visibility-changer'><i class='fa-solid fa-pen'></i> &nbsp; Edit Request</button>";
                                                        }
                                                            echo "<button class='del-btn easygo-rounded-1 easygo-fs-5 flex-grow-1 px-0'><i class='fa-solid fa-trash'></i> Remove</button>
                                                        </div>
                                                    </div>
                                                </div>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- | mobile | [end] -->
                                <!-- ============================== -->
                            </div>
                            <!-- private tour history [end] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- book private tour [start] -->
                            <div class="book-private-tour request-tour" style="display: none;">
                                <div>
                                    <button onclick="return clear_form()" class="visibility-changer btn" data-visibility-target=".request-tour"><i class="fa-solid fa-chevron-left"></i> Back</button>
                                </div>
                                <div class="form-page-main container d-block">
                                    <div class="form-container container" style="max-width: 600px;">
                                        <form id="request_form" onsubmit=request_private_tour(this)>
                                            <?php

                                                echo "<input type='hidden' name='user_id' value='$user_id'>";
                                            ?>
                                            <div class="form-header">
                                                <h5 class="easygo-fs-2 my-3">Book a private tour. Customize trips to your taste</h5>
                                            </div>
                                            <div class="form-input-field">
                                                <textarea id="desc" name="desc" class="border-blue" style="resize: none" cols="30" rows="7"
                                                placeholder="Describe your vision for the tour as much as you can. Eg: I want a tour for my friends and I where we get to visit the Kakum National Park. We are open to spending the night in the town and visiting other sites. The following day we would like to go hiking through Aburi too but its fine if we cant do that on this trip "></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Total Budget for entire Tour</div>
                                                            <a href="#GHS"  id="currency_menu" class="btn btn-default border dropdown-toggle text-blue px-4 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                GHS
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li onclick="on_option_select('currency_menu','GHS')"><a href="#" class="dropdown-item">GHS</a></li>
                                                                <li onclick="on_option_select('currency_menu','USD')"><a href="#" class="dropdown-item">USD</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Min</div>
                                                            <input id="min_b" name="min_b" type="text" class="border-blue">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="input-field">

                                                        <div name="max_b" class="text-gray-1 easygo-fs-5">Max</div>
                                                            <input id="max_b" name="max_b" type="text" class="border-blue">
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Start Date</div>
                                                        <div class="input-w-icon">
                                                            <label for="start-date" class="input-icon"><i class="fa-solid fa-calendar"></i></label>
                                                            <input id="start-date" name="start" type="date" class="border-blue">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">End Date</div>
                                                        <div class="input-w-icon">
                                                            <label for="end-date" class="input-icon"><i class="fa-solid fa-calendar"></i></label>
                                                            <input id="end-date" name="end" type="date" class="border-blue">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Status</div>
                                                            <a href="#publish"  id="publish_state" class="btn btn-default border dropdown-toggle text-blue px-4 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Publish
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li onclick="on_option_select('publish_state','publish')"><a href="#" class="dropdown-item">Publish</a></li>
                                                                <!-- <li onclick="on_option_select('publish_state','review')"><a href="#" class="dropdown-item">Draft</a></li> -->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Number of People</div>
                                                        <div class="easygo-num-input">
                                                            <span data-input-target="#num-adults" class="icon-left minus"><i class="fa-solid fa-circle-minus"></i></span>
                                                            <input id="num-adults" name="seats" type="number" class="border-blue text-center" value="1" min="0" max="100">
                                                            <span data-input-target="#num-adults" class="icon-right plus"><i class="fa-solid fa-circle-plus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="input-field button-container my-2">
                                                <button id="submit_btn" type="submit" class="easygo-btn-1 easygo-rounded-2" type="button">Place Request</button>
                                            </div>
                                        </form>
                                        <!-- register form 1 [end] -->
                                        <!-- ======================= -->
                                    </div>
                                </div>
                            </div>
                            <!-- book private tour [end] -->
                            <!-- ============================== -->
                        </div>
                    </div>
                </main>
                <!-- dashboard content [start] -->
                <!-- ============================== -->
            </div>
        </main>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../../assets/js/jquery-3.6.1.min.js"></script>
    <!-- Swiper js -->
    <script src="../../assets/js/swiper-bundle.min.js"></script>
    <!-- easygo js -->
    <script src="../../assets/js/general.js"></script>
    <script src="../../assets/js/home.js"></script>
    <script src="../../assets/js/functions.js"></script>
    <script src="../../assets/js/private_tour.js"></script>
</body>

</html>