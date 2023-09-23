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
$email = $info["email"];
$number = $info["phone_number"];

$stats = get_curator_statistics($curator_id, true);
$group_count = $stats["tour_count"];
$revenue = format_string_as_currency_fn($stats["total_revenue"]);
$balance = format_string_as_currency_fn($stats["withdrawable_balance"]);
$private_count = 0;//$stats["withdrawable_balance"];
$rating = $stats["average_rating"];
$rating_count = $stats["review_count"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator | Account Settings</title>
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
            <div class="dashlogo logo logo-medium">
                <img class="img-fluid" src="../assets/images/site_images/logo.png" alt="easygo logo">
            </div>
            <div class="dashboard-title easygo-fs-2 easygo-fw-1">Account Settings</div>
        </header>
            <?php require_once(__DIR__ . "/../components/curator_navbar_mobile.php"); ?>
            <!-- ============================== -->
            <!-- dashboard content [start] -->
            <main class="dashboard-content">
                <?php require_once(__DIR__ . "/../components/curator_navbar_desktop.php"); ?>
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
                                            <label class="profile_img-upload-btn text-hover-orange" for="profile_img">Edit</label>
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
                                            <h3 class='easygo-fs-1 easygo-fw-1'>$user_name</h3>
                                            <h5 class='easygo-fs-4 text-orange'> Curator @$curator_name</h5>
                                            ";
                                            ?>
                                        </div>
                                        <div class="edt-btn-container">
                                            <button class="btn border easygo-fs-4 px-4 py-1">Edit</button>
                                        </div>
                                    </div>
                                    <div class="other-info">
                                        <div class="contact-info">
                                            <div class="d-flex align-items-center gap-2 my-4">
                                                <h6 class="text-gray-1 easygo-fs-5 m-0">Contact Information</h6>
                                                <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                            </div>
                                            <div class="row">
                                                <?php
                                                echo "
                                                <div class='col-lg-6 py-2'>
                                                    <div><i class='fa-solid fa-envelope'></i> &nbsp; $email</div>
                                                </div>
                                                <div class='col-lg-6 py-2'>
                                                    <div><i class='fa-solid fa-phone'></i> &nbsp; $number</div>
                                                </div>
                                                ";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="trip-rating">
                                            <div class="d-flex align-items-center gap-2 my-4">
                                                <h6 class="text-gray-1 easygo-fs-5 m-0">Average Tour Rating</h6>
                                                <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                            </div>
                                            <div>
                                                <?php
                                                    echo "
                                                    <h2 class='easygo-fs-1 easygo-fw-1'>$rating</h2>
                                                <div class='text-orange'>
                                                    <i class='fa-solid fa-star'></i>
                                                    <i class='fa-solid fa-star'></i>
                                                    <i class='fa-solid fa-star'></i>
                                                    <i class='fa-solid fa-star'></i>
                                                    <i class='fa-solid fa-star'></i>
                                                    &nbsp; &nbsp; <span class='text-black easygo-fs-5 easygo-fw-1'>$rating_count reviews</span>
                                                </div>
                                                ";
                                                ?>
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
                    <!-- stat cards [start] -->
                    <section class="stat-cards pt-5">
                        <h3 class="easygo-fs-3 easygo-fw-1 ps-3">Company at glance</h3>
                        <div class="row">
                            <?php
                                echo "
                                <div class='col-lg-3 col-sm-6 py-3'>
                                <div class='info-card m-auto bg-white'>
                                    <div class='info-img'>
                                        <img src='../assets/images/svgs/bus_red_bg.svg' alt='bus image'>
                                    </div>
                                    <div class='info-content'>
                                        <div class='text-gray-1 info-title easygo-fs-4'>Group Tours</div>
                                        <div class='info-num easygo-fs-2 easygo-fw-1'>$group_count</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-3 col-sm-6 py-3'>
                                <div class='info-card m-auto bg-white'>
                                    <div class='info-img'>
                                        <img src='../assets/images/svgs/bus_black_bg.svg' alt='bus image'>
                                    </div>
                                    <div class='info-content'>
                                        <div class='text-gray-1 info-title easygo-fs-4'>Private Tours</div>
                                        <div class='info-num easygo-fs-2 easygo-fw-1'>$private_count</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-3 col-sm-6 py-3'>
                                <div class='info-card m-auto bg-white'>
                                    <div class='info-img'>
                                        <img src='../assets/images/svgs/barchart_blue_bg.svg' alt='bus image'>
                                    </div>
                                    <div class='info-content'>
                                        <div class='text-gray-1 info-title easygo-fs-4'>Total Revenue</div>
                                        <div class='info-num easygo-fs-2 easygo-fw-1'>GHS $revenue</div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-lg-3 col-sm-6 py-3'>
                                <div class='info-card m-auto bg-white'>
                                    <div class='info-img'>
                                        <img src='../assets/images/svgs/wallet_orange_bg.svg' alt='bus image'>
                                    </div>
                                    <div class='info-content'>
                                        <div class='text-gray-1 info-title easygo-fs-4'>Remaining Balance</div>
                                        <div class='info-num easygo-fs-2 easygo-fw-1'>GHS $balance</div>
                                    </div>
                                </div>
                            </div>
                                "
                            ?>
                        </div>
                    </section>
                    <!-- stat cards [end] -->
                    <!-- ============================== -->
                    <!-- ============================== -->
                    <!-- tabs [start] -->
                    <section class="py-5">
                        <div>
                            <ul class="nav nav-tabs easygo-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100 active" id="all-trips-tab" data-bs-toggle="tab" data-bs-target="#all-trips" type="button" role="tab" aria-controls="all-trips" aria-selected="true">All Tours</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100" id="packages-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false" tabindex="-1">Reviews</button>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100" id="packages-tab" data-bs-toggle="tab" data-bs-target="#packages" type="button" role="tab" aria-controls="packages" aria-selected="false" tabindex="-1">Tour packages</button>
                            </li> -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#collaborators" type="button" role="tab" aria-controls="collaborators" aria-selected="false" tabindex="-1">Collaborators</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100" id="complaint-tab" data-bs-toggle="tab" data-bs-target="#complaint" type="button" role="tab" aria-controls="complaint" aria-selected="false" tabindex="-1">Make a complaint</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!--- ================================ -->
                                <!--- all trips [start] -->
                                <div class="tab-pane fade active show" id="all-trips" role="tabpanel" aria-labelledby="description-tab">
                                    <div class="easygo-list-3  left-bordered-items" style="min-width: 992px;">
                                    <?php
                                        $tours_stats = get_curator_campaigns($curator_id);
                                        foreach ($tours_stats as $entry) {
                                            $title = $entry["title"];
                                            $tour_count = $entry["trip_count"];
                                            $label = $tour_count > 1 ? "Tours" : "Tour";
                                            $desc = shorten($entry["description"]);
                                            echo"
                                            <div class='list-item'>
                                                <div class='col'>
                                                    <div class='inner-item easygo-fs-3'>$title</div>
                                                    <div class='inner-item easygo-fs-5 text-end'>$tour_count $label</div>
                                                    <div class='inner-item-easygo-fs-3'>
                                                    $desc
                                                    </div>
                                                </div>
                                            </div>
                                            ";
                                        }
                                    ?>

                                    </div>
                                </div>
                                <!--- all trips [end] -->
                                <!--- ================================ -->
                                <!--- ================================ -->
                                <!--- packages [start] -->
                                <!--- packages [end] -->
                                <!--- ================================ -->
                                <!--- ================================ -->
                                <!--- reviews [start] -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                                <div class="easygo-list-3  left-bordered-items" style="min-width: 992px;">
                                <?php
                                    $reviews = get_curator_reviews($curator_id);
                                    if(!$reviews){
                                        echo "<h3>No reviews yet</h3>";
                                    }
                                    foreach ($reviews as $entry) {
                                        $user_name = $entry["user_name"];
                                        $comment = $entry["comment"];
                                        $star = $entry["num_stars"];
                                        $label = $star > 1 ? "Stars" : "Star";
                                        $tour_date = format_string_as_date_fn($entry["tour_date"]);
                                        echo "
                                        <div class='list-item'>
                                            <div class='col'>
                                                <div class='row'>
                                                    <div class='inner-item easygo-fs-2'>
                                                        $user_name
                                                    </div>
                                                    <div class='inner-item easygo-fs-5 text-end'>Tour Date: $tour_date </div>
                                                </div>
                                                <div class='inner-item'>$star $label</div>
                                                <div class='inner-item-easygo-fs-3'>
                                                $comment
                                                </div>
                                            </div>
                                        </div>
                                        ";
                                    }
                                ?>

                                    </div>
                                </div>

                                </div>
                                <!--- reviews [end] -->
                                <!--- ================================ -->
                                <!--- collaborators [start] -->
                                <div class="tab-pane fade" id="collaborators" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="d-flex justify-content-end gap-2 align-items-center">
                                        <p></p>
                                        <button type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-toggle="modal" data-bs-target="#invite-collaborator-modal">Invite collaborator</button>
                                    </div>
                                    <div class="easygo-list-3 list-striped" style="min-width: 992px;">
                                        <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                            <div class="item-bullet-container">
                                                <div class="item-bullet"></div>
                                            </div>
                                            <div class="inner-item">User name</div>
                                            <div class="inner-item">Phone number</div>
                                            <div class="inner-item">Email</div>
                                            <div class="inner-item">Role</div>
                                            <div class="inner-item">Date Added</div>
                                            <div class="inner-item">Access status</div>
                                        </div>
                                        <?php
                                        $collaborators = get_curator_collaborators($curator_id);
                                        //TODO Show sent out invites that have yet to be accepted
                                        foreach ($collaborators as $pers) {
                                            $c_name = $pers["user_name"];
                                            $c_email = $pers["email"];
                                            $c_phone = $pers["phone_number"];
                                            $c_date = format_string_as_date_fn($pers["date_added"]);
                                            $c_privilege = $pers["privilege"];
                                            $c_access = $pers["access_status"];
                                            echo "
                                        <div class='list-item'>
                                            <div class='item-bullet-container'>
                                                <div class='item-bullet'></div>
                                            </div>
                                            <div class='inner-item text-capitalize'>$c_name</div>
                                            <div class='inner-item'>$c_phone</div>
                                            <div class='inner-item'>$c_email</div>
                                            <div class='inner-item'>$c_privilege</div>
                                            <div class='inner-item'>$c_date</div>
                                            <div class='inner-item text-capitalize'>$c_access</div>
                                        </div>
                                        ";
                                        }


                                        $invites = get_pending_invites($curator_id);
                                        if($invites){
                                            echo "<h5>Pending invites</h5>";
                                        }
                                        foreach ($invites as $entry) {
                                            $i_email = $pers["email"];
                                            $i_date = format_string_as_date_fn($pers["invite_date"]);
                                            $i_expiry = format_string_as_date_fn($pers["invite_expiry"]);
                                            $i_privilege = $pers["privilege"];
                                            echo "
                                        <div class='list-item'>
                                            <div class='inner-item text-capitalize'>$i_email</div>
                                            <div class='inner-item'>$i_privilege</div>
                                            <div class='inner-item'>$i_date</div>
                                            <div class='inner-item'>$i_expiry</div>
                                        </div>
                                        ";
                                        }

                                        ?>
                                    </div>

                                </div>
                                <!--- collaborators [end] -->
                                <!--- ================================ -->
                                <!--- ================================ -->
                                <!--- complaint [start] -->
                                <div class="tab-pane fade" id="complaint" role="tabpanel" aria-labelledby="complaint-tab">
                                    <div class="easygo-list-3 list-striped" style="min-width: 992px;">

                                        <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                            <div class="item-bullet-container">
                                                <div class="item-bullet"></div>
                                            </div>
                                            <div class="inner-item">User name</div>
                                            <div class="inner-item">Date Added</div>
                                            <div class="inner-item">Phone number</div>
                                            <div class="inner-item">Email</div>
                                            <div class="inner-item">Access status</div>
                                            <div class="inner-item">Role</div>
                                        </div>
                                        <div class='list-item'>
                                            <div class='item-bullet-container'>
                                                <div class='item-bullet'></div>
                                            </div>
                                            <div class='inner-item'>NCLLWKDEI</div>
                                            <div class='inner-item'>Collins Nudekor</div>
                                            <div class='inner-item'>easyGo Admin</div>
                                            <div class='inner-item'>13 Dec 2022</div>
                                            <div class='inner-item text-success'>420</div>
                                            <div class='inner-item'>Success</div>
                                        </div>
                                        <div class="list-item">
                                            <div class="item-bullet-container">
                                                <div class="item-bullet"></div>
                                            </div>
                                            <div class="inner-item">NCLLWKDEI</div>
                                            <div class="inner-item">Collins Nudekor</div>
                                            <div class="inner-item">easyGo Admin</div>
                                            <div class="inner-item">13 Dec 2022</div>
                                            <div class="inner-item text-danger">-420</div>
                                            <div class="inner-item">Pending</div>
                                        </div>
                                        <div class="list-item">
                                            <div class="item-bullet-container">
                                                <div class="item-bullet"></div>
                                            </div>
                                            <div class="inner-item">NCLLWKDEI</div>
                                            <div class="inner-item">Collins Nudekor</div>
                                            <div class="inner-item">easyGo Admin</div>
                                            <div class="inner-item">13 Dec 2022</div>
                                            <div class="inner-item text-success">420</div>
                                            <div class="inner-item">Success</div>
                                        </div>
                                        <div class="list-item">
                                            <div class="item-bullet-container">
                                                <div class="item-bullet"></div>
                                            </div>
                                            <div class="inner-item">NCLLWKDEI</div>
                                            <div class="inner-item">Collins Nudekor</div>
                                            <div class="inner-item">easyGo Admin</div>
                                            <div class="inner-item">13 Dec 2022</div>
                                            <div class="inner-item text-danger">-420</div>
                                            <div class="inner-item">Success</div>
                                        </div>
                                        <div class="list-item">
                                            <div class="item-bullet-container">
                                                <div class="item-bullet"></div>
                                            </div>
                                            <div class="inner-item">NCLLWKDEI</div>
                                            <div class="inner-item">Collins Nudekor</div>
                                            <div class="inner-item">easyGo Admin</div>
                                            <div class="inner-item">13 Dec 2022</div>
                                            <div class="inner-item text-success">420</div>
                                            <div class="inner-item">Success</div>
                                        </div>
                                        <div class="list-item">
                                            <div class="item-bullet-container">
                                                <div class="item-bullet"></div>
                                            </div>
                                            <div class="inner-item">NCLLWKDEI</div>
                                            <div class="inner-item">Collins Nudekor</div>
                                            <div class="inner-item">easyGo Admin</div>
                                            <div class="inner-item">13 Dec 2022</div>
                                            <div class="inner-item text-danger">-420</div>
                                            <div class="inner-item">Success</div>
                                        </div>
                                    </div>

                                </div>
                                <!--- complaint [end] -->
                                <!--- ================================ -->
                            </div>
                        </div>
                    </section>
                    <!-- tabs [end] -->
                    <!-- ============================== -->

                    <!-- ============================== -->
                    <!-- Invite_collaborator_modal modal [start] -->
                    <div class="modal fade" id="invite-collaborator-modal">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content p-5">
                                <div class="col">
                                    <div>
                                        <div style='overflow-x: auto;'>
                                        </div>
                                        <h6 class="easygo-fw-1 m-0">Invite A Collaborator</h6>
                                        <small class="text-gray-1 easygo-fs-6">(Add another person to manage your account)</small>
                                        <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                        <?php echo "<form onsubmit='invite_collaborator(this,\"$curator_id\")'>"; ?>

                                            <div class="col-lg-7 d-flex flex-column gap-4">
                                                <div class="form-input-field">
                                                    <div class="text-gray-1 easygo-fs-4">Collaborator Email</div>
                                                    <input type="email" name="email" placeholder="example@easygo.com">
                                                </div>
                                            </div>


                                            <div class="col-lg-7 d-flex flex-column gap-4">
                                                <div class="form-input-field">
                                                    <div class="text-gray-1 easygo-fs-4">Collaborator Role</div>

                                                    <select name="collaborator_role">
                                                        <option value="admin">Admin</option>
                                                        <option value="edit">Edit</option>
                                                        <option value="view">View</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end gap-2 align-items-center mt-4">
                                                <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="py-2 easygo-btn-1 border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Send Invite</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invite_collaborator_modal modal [end] -->
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
    <script src="../assets/js/curator_account_settings.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>