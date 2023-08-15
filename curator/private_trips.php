<?php
    require_once(__DIR__ . "/../utils/core.php");
    require_once(__DIR__ . "/../controllers/curator_interraction_controller.php");

    if (!is_session_user_curator()) {
        header("Location: ../views/home.php");
        die();
    }

    $info = get_collaborator_info(get_session_user_id());
    $curator_id = get_session_account_id();
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
    <title>Curator || Private Trips</title>
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
    <!-- main-wrapper [start] -->
    <div class="main-wrapper">
        <?php require_once(__DIR__."/../components/curator_header.php") ?>
            <?php require_once(__DIR__."/../components/curator_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
        <?php require_once(__DIR__. "/../components/curator_navbar_desktop.php"); ?>
            <div class="main-content px-3">
                <section class="all-trips">
                    <div class="d-flex justify-content-between align-items-center border-1 border-bottom py-3">
                        <div>
                            <h5 class="title easygo-fs-3 easygo-fw-1 m-0">Private Tours</h5>
                            <small class="easygo-fs-5 text-gray-1 align-middle"><a href="#">Trips</a> <i class="fa-solid fa-chevron-right"></i> Private Tour Requests</small>
                        </div>
                        <a href="create_a_tour.php" class="easygo-btn-2">Create a Trip</a>
                    </div>
                    <!-- ============================== -->
                    <!-- tirp card listing [start] -->
                    <div class="trip-cards">
                        <div class="row pt-5">
                            <!-- ============================== -->
                            <!-- tirp card [start] -->
                            <?php

                                $requests = get_custom_private_tour_requests();

                                foreach ($requests as $entry) {
                                    $start = format_string_as_date_fn($entry["date_start"]);
                                    $end = format_string_as_date_fn($entry["date_end"]);
                                    $seats = $entry["person_count"];
                                    $budget_min = $entry["min_budget"];
                                    $budget_max = $entry["max_budget"];
                                    $desc = shorten($entry["description"]);
                                    $currency = $entry["currency"];
                                    $tour_id = $entry["private_tour_id"];
                                    $quote_count = 0;
                                    $accepted_quote = $entry["accepted_quote"];

                                                        echo "<div class='list-item bg-gray-3 my-1' id='div_$tour_id'>
                                                        <div class='w-100'>
                                                            <div class='d-flex justify-content-between'>
                                                                <div class='easygo-fs-5 text-gray-1 d-flex align-items-center gap-1'>
                                                                    $currency $budget_min - $currency $budget_max
                                                                    <span class='bg-gray-1 rounded-circle' style='width:7px; height: 7px'></span>
                                                                    $start - $end
                                                                    <span class='bg-gray-1 rounded-circle' style='width:7px; height: 7px'></span>
                                                                    $seats people
                                                                </div>
                                                                <span class='easygo-badge-orange easygo-fs-5'>Open</span>
                                                            </div>
                                                            <div class='easygo-fs-4 py-3'>
                                                                $desc
                                                            </div>
                                                            <div class='d-flex justify-content-between'>
                                                            <span></span>
                                                                <div class='d-flex gap-1'>
                                                                    <button class='easygo-btn-1  easygo-fs-5 easygo-fw-3 px-2'><i class='fa-solid fa-eye'></i> &nbsp; View My Bids</button>
                                                                    <button onclick='create_bid(\"$tour_id\")' class='easygo-btn-1  easygo-fs-5 easygo-fw-3 px-2'><i class='fa-solid fa-eye'></i> &nbsp; Submit Bid</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                }


                            ?>

                            <!-- tirp card [start] -->
                            <!-- ============================== -->



                            <!-- ============================== -->
                            <!-- tirp card [start] -->


                            <div class="book-private-tour request-tour"  id="bid_form_div" style="display: none;">
                                <div class="form-page-main container d-block">
                                    <div class="form-container container" style="max-width: 600px;">
                                        <form id="request_form" onsubmit=submit_bid(this)>
                                            <?php
                                                echo "<input type='hidden' name='request_id'>";
                                                echo "<input type='hidden' name='curator_id' value='$curator_id'>";
                                            ?>
                                            <div class="form-header">
                                                <h5 class="easygo-fs-2 my-3">Provide a quote for how much you will charge for the tour</h5>
                                            </div>
                                            <div class="form-input-field">
                                                <textarea id="desc" name="comment" class="border-blue" style="resize: none" cols="30" rows="7"
                                                placeholder="Provide a description for the services you will provide on the tour, including anything extra that the customer has not requested by you are capable of including. E.g: A two day tour to visit Trident Island. Food, transportation and water inclusive, but you will have to bring along your own drinks"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
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


                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Fee</div>
                                                        <div class="input-w-icon">
                                                            <label for="start-date" class="input-icon"><i class="fa-solid fa-dollar-sign"></i></label>
                                                            <input id="start-date" name="amount" type="number" class="border-blue">
                                                        </div>
                                                    </div>
                                                </div>

                                                </div>


                                            <div class="input-field button-container my-2">
                                                <button id="submit_btn" type="submit" class="easygo-btn-1 easygo-rounded-2" type="button">Submit Bid</button>
                                            </div>
                                        </form>
                                        <!-- register form 1 [end] -->
                                        <!-- ======================= -->
                                    </div>
                                </div>
                            </div>
                            <!-- tirp card [start] -->
                            <!-- ============================== -->



                        </div>
                    </div>
                    <!-- tirp card listing [end] -->
                    <!-- ============================== -->
                </section>

            </div>
        </main>
        <!-- dashboard-content [end] -->
        <!-- ============================== -->
    </div>
    <!-- main-wrapper [end] -->
    <!-- ============================== -->



    <!-- ============================== -->
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/curator_general.js"></script>
    <script src="../assets/js/curator_private_tour.js"></script>
</body>

</html>