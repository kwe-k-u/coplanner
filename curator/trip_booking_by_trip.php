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
    <title>Curator | Trip Booking</title>
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
        <header class="dashboard-header d-none d-lg-flex">
            <div class="dashlogo logo logo-medium">
                <img class="img-fluid" src="../assets/images/svgs/logo.svg" alt="easygo logo">
            </div>
            <div class="dashboard-title">Dashboard</div>
            <div class="right-sec">
                <form id="dashboard-search">
                    <div class="form-input-field">
                        <input class="p-2" type="text" placeholder="search">
                    </div>
                </form>
                <div class="balance d-flex flex-column justify-content-center">
                    <h4 class="m-0 easygo-fs-3 easygo-fw-1">GHC 500</h4>
                    <small class="easygo-fs-5 text-orange">Withdrawable balance</small>
                </div>
                <div class="user-menu d-flex gap-1">
                    <div class="user-icon">
                        <img src="../assets/images/others/profile.jpeg" alt="">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="easygo-fs-3">Admin</h5>
                        <h6 class="text-orange easygo-fs-5">Administrator</h6>
                    </div>
                </div>
            </div>
        </header>
        <header class="nav-menu d-lg-none">
            <?php require_once(__DIR__."/../components/curator_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
        <?php require_once(__DIR__. "/../components/curator_navbar_desktop.php"); ?>
            <div class="main-content px-3">
                <section class="trip-booking">
                    <div class="border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">Trip Booking</h5>
                            <small class="easygo-fs-5 text-gray-1"><a href="all_trips.php">Trips</a> > Boooking</small>
                        </div>
                        <p class="mt-4 mb-0">Bookings have been grouped based on the Trip. Click on a particular trip to view more information.</p>
                    </div>
                    <div class="controls d-flex justify-content-between align-items-between py-3">
                        <div class="left-controls">
                            <form id="dashboard-search">
                                <div class="form-input-field">
                                    <input class="p-2" type="text" placeholder="search">
                                </div>
                            </form>
                        </div>
                        <div class="right-controls d-flex gap-2 easygo-fs-5">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle easygo-fs-5 h-100" type="button" id="viewby-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="easygo-fw-3">Group by</span> Trips
                                </button>
                                <ul class="dropdown-menu easygo-fs-5" aria-labelledby="viewby-menu">
                                    <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="./trip_booking_by_date.php">Date</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn border dropdown-toggle px-5 easygo-fs-5 h-100" type="button" id="export-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                    Export
                                </button>
                                <ul class="dropdown-menu easygo-fs-5" aria-labelledby="export-menu">
                                    <li><a class="dropdown-item" href="#">PDF</a></li>
                                    <li><a class="dropdown-item" href="#">Excel</a></li>
                                </ul>
                            </div>
                            <button class="easygo-btn-1 py-1 px-5">Print</button>
                        </div>
                    </div>
                    <div class="trip-listing">
                        <div class="easygo-list-3  left-bordered-items" style="min-width: 992px;">
                        <?php
                            $trips = get_booking_summary_by_trip($curator_id);
                            foreach($trips as $entry){
                                $name = $entry["title"];
                                $id = $entry["campaign_id"];
                                $count = $entry["booking_count"];
                                echo "
                                <div class='list-item'>
                                    <div class='inner-item'>$name</div>
                                    <div class='inner-item easygo-fs-5 text-end'>$count Bookings</div>
                                </div>";
                            }
                            if(!$trips){
                                echo "<h5>You don't have any bookings yet</h5>";
                            }
                        ?>

                        </div>
                    </div>
                    <div class="pagination-section my-5">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="easygo-fs-5 h-100 d-flex align-items-center">Showing 1 - 20 of 100 trips</div>
                            </div>
                            <div class="col-lg-9">
                                <div class="d-flex justify-content-center align-items-center">
                                    <nav aria-label="Page navigation m-auto">
                                        <ul class="pagination gap-2">
                                            <li class="page-item"><a class="page-link rounded" href="#">Previous</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link rounded" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <?php require_once(__DIR__."../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
</body>

</html>