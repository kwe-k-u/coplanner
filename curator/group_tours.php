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
  <?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator || Group Tours</title>
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
                            <h5 class="title easygo-fs-3 easygo-fw-1 m-0">All tours</h5>
                            <small class="easygo-fs-5 text-gray-1 align-middle"><a href="#">Tours</a> <i class="fa-solid fa-chevron-right"></i> All Tours</small>
                        </div>
                        <a href="create_a_tour.php" class="easygo-btn-1">Create a Tour</a>
                    </div>
                    <!-- ============================== -->
                    <!-- tirp card listing [start] -->
                    <div class="trip-cards">
                        <div class="row pt-5">
                            <!-- ============================== -->
                            <!-- tirp card [start] -->
                            <?php
                                $trips = get_curator_campaigns($curator_id);

                                if(!$trips){
                                    echo "<h4>You don't have any listed tours. Click <a class='btn btn-primary' href='create_a_tour.php'> Here </a> to get started</h4>";
                                }else {
                                    foreach($trips as $entry){
                                        $c_id = $entry["campaign_id"];
                                        $c_name = $entry["title"];
                                        $c_count = $entry["trip_count"];
                                        $c_media = get_campaign_image($c_id)[0]["media_location"];
                                        $c_trip = get_campaign_tours($c_id)[0];
                                        $t_sdate = format_string_as_date_fn($c_trip["start_date"]);
                                        $t_edate = format_string_as_date_fn($c_trip["end_date"]);
                                        $t_fee = $c_trip["fee"];
                                        $t_currency = $c_trip["currency"];
                                        $t_booking = count_trip_booking($c_trip["tour_id"])["booking_count"];
                                        echo "
                                        <div class='col-lg-4 col-md-6 pb-4'>
                                <div class='trip-card-2'>
                                    <div class='trip-card-img'>
                                        <img src='$c_media' alt='tour 3'>
                                    </div>
                                    <div class='trip-card-content'>
                                        <h5 class='header'>$c_name</h5>
                                        <div class='easygo-fs-5 d-flex align-items-center justify-content-between'>
                                            <div><i class='fa-regular fa-calendar-days'></i> $t_sdate - $t_edate</div>
                                            <div><i class='fa-solid fa-pen-to-square'></i> $t_booking Booked Seats</div>
                                        </div>
                                        <div class='easygo-fs-5'>
                                            <!-- <i class='fa-solid fa-map-pin'></i> Pickup coming soon -->
                                        </div>
                                        <div class='py-3 d-flex justify-content-between align-items-center easygo-fs-5'>
                                            <span><i class='fa-solid fa-tag'></i> $t_currency $t_fee</span>
                                            <div>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='../views/tour_description.php?campaign_id=$c_id'>Details</a>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='trip_booking_by_trip.php?campaign_id=$c_id'>Bookings</a>
                                                <a class='btn px-3 py-1 border easygo-fs-5' href='create_a_tour.php?id=$c_id'>Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        ";
                                    }
                                }
                            ?>

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
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/general.js"></script>
</body>

</html>