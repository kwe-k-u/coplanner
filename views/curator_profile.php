<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/interaction_controller.php");
require_once(__DIR__ . "/../controllers/campaign_controller.php");

if (!isset($_GET["id"])) {
    header("Location: tours.php");
    die();
}
$curator_id = $_GET["id"];
$info = get_curator_by_id($curator_id);
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
    <title>easyGo- Curator Profile</title>
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
        <header class="dashboard-header d-none d-lg-flex py-4 bg-gray-3" class="box-shadow-1">
            <div class=" logo logo-medium"  onclick="goto_page('views/home.php')">
                    <img class="img-fluid" src="../assets/images/site_images/logo.png" alt="easygo logo">
            </div>
            <div class="dashboard-title easygo-fs-2 easygo-fw-1">Curator Profile</div>
        </header>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
            <div class="main-content px-3 bg-gray-3">
                <!-- ============================== -->
                <!-- account settings [start] -->
                <section class="account-settings pt-5">
                    <div class="row">
                        <div class="col-lg-2 py-3">
                            <div class="user-icon-display">
                                <div class="profile_img-upload piu-alt">
                                    <div class="profile_img-disp" style="width: 140px; height: 140px;">
                                        <img id="register-profile_img" class="image-display" src="../assets/images/others/tour2.jpg" alt="profile image">
                                        <input display-target="register-profile_img" class="profile_img-file" id="profile_img" type="file" accept=".jpg, .jpeg, .png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 py-3">
                            <div class="user-info">
                                <div class="name-email d-flex justify-content-between">
                                    <div>
                                        <?php
                                        echo "
                                            <h3 class='easygo-fs-1 easygo-fw-1'>$curator_name</h3>
                                            ";
                                        ?>
                                    </div>
                                    <div class="edt-btn-container">
                                        <?php
                                        if (!is_session_logged_in()) {
                                            echo "<button class='easygo-btn-3 border easygo-fs-4 px-4 py-1' onclick='toggle_curator_follow(\"$curator_id\")'>Follow</button>";
                                        } else if (is_user_following_curator(get_session_user_id(), $curator_id)) {
                                            echo "<button class='easygo-btn-3 border easygo-fs-4 px-4 py-1' onclick='toggle_curator_follow(\"$curator_id\")'>Unfollow</button>";
                                        } else {
                                            echo "<button class='easygo-btn-1 border easygo-fs-4 px-4 py-1' onclick='toggle_curator_follow(\"$curator_id\")'>Follow</button>";
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="other-info">
                                    <div class="trip-rating">
                                        <div class="d-flex align-items-center gap-2 my-4">
                                            <h6 class="text-gray-1 easygo-fs-5 m-0">Average Tour Rating</h6>
                                            <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                        </div>
                                        <div>
                                            <h2 class="easygo-fs-1 easygo-fw-1">4.8</h2>
                                            <div class="text-orange">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                &nbsp; &nbsp; <span class="text-black easygo-fs-5 easygo-fw-1">14 reviews</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account settings [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- tabs [start] -->
                <section class="py-5">
                    <div>
                        <ul class="nav nav-tabs easygo-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100 active" id="all-trips-tab" data-bs-toggle="tab" data-bs-target="#all-trips" type="button" role="tab" aria-controls="all-trips" aria-selected="true">All Tours</button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100" id="packages-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false" tabindex="-1">Reviews</button>
                                </li> -->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!--- ================================ -->
                            <!--- all trips [start] -->
                            <div class="tab-pane fade active show" id="all-trips" role="tabpanel" aria-labelledby="description-tab">
                                <div class="">
                                    <div class="col-lg-6 col-md-6 pb-4">
                                        <?php
                                        $tours = get_campaigns_by_curator($curator_id);
                                        foreach ($tours as $entry) {
                                            $title = $entry["title"];
                                            $curator_id = $entry["curator_id"];
                                            $campaign_id = $entry["campaign_id"];
                                            $desc = shorten($entry["description"]);
                                            $media = $entry["media"][0]["media_location"];
                                            $tour = $entry["campaign_tours"][0];
                                            $start = format_string_as_date_fn($tour["start_date"]);
                                            $end = format_string_as_date_fn($tour["end_date"]);
                                            $currency = $tour["currency"];
                                            $price = $tour["fee"];

                                            echo "
                                            <div class='trip-card-2'>
                                                <div class='trip-card-img'>
                                                    <img src='$media' alt='tour 3'>
                                                </div>
                                                <div class='trip-card-content'>
                                                    <h5 class='header'>$title</h5>
                                                    <div class='easygo-fs-5 d-flex align-items-center justify-content-between'>
                                                        <div><i class='fa-regular fa-calendar-days'></i> $start - $end</div>
                                                        <!-- <div><i class='fa-solid fa-pen-to-square'></i> 15 Booked Seats</div> -->
                                                    </div>
                                                    <div class='easygo-fs-5'>
                                                        $desc
                                                    </div>
                                                    <div class='py-3 d-flex justify-content-between align-items-center easygo-fs-5'>
                                                        <span><i class='fa-solid fa-tag'></i> $currency $price</span>
                                                        <a class='btn px-3 py-1 border easygo-fs-5' href='./tour_description.php?campaign_id=$campaign_id'>View</a>
                                                    </div>
                                                </div>
                                            </div>
                                                ";
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <!--- all trips [end] -->
                            <!--- ================================ -->

                        </div>
                        <!--- reviews [end] -->
                        <!--- ================================ -->
                    </div>
            </div>
            </section>
            <!-- tabs [end] -->
            <!-- ============================== -->

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
    <!-- <script src="../assets/js/curator_account_settings.js"></script> -->
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/general.js"></script>
</body>

</html>