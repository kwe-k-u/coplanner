<?php
require_once(__DIR__ . "/../../utils/core.php");
require_once(__DIR__ . "/../../controllers/auth_controller.php");
require_once(__DIR__ . "/../../controllers/private_tour_controller.php");
require_once(__DIR__ . "/../../controllers/media_controller.php");
require_once(__DIR__ . "/../../controllers/interaction_controller.php");
login_check();

if (!isset($_GET["request_id"])) {
    header("Location: ./private_tour.php");
}
$request_id = $_GET["request_id"];
$user_id = get_session_user_id();
$user = get_user_by_id($user_id);
$email = $user["email"];
$profile = get_media_by_id($user["profile_image"])["media_location"] ?? get_default_profile_img();
$user_name = $user["user_name"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="icon" href="../../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - User Dashboard | Private Tour Quotes</title>
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
                <h5>Private Tour Request - Details</h5>
                <button class="btn"><i class="fa-solid fa-bell"></i></button>
        </nav>
        <main>
            <div class="dashboard-content">
                <!-- ============================== -->
                <!-- sidebar [start] -->
                <aside id="userdashboard-sidebar" class="sidebar sidebar-left bg-white">
                    <div class="sidebar-header py-3">
                        <div class="logo m-md-auto" onclick="return goto_page('view/home.php')">
                            <img class="logo-medium" src="../../assets/images/site_images/logo.png" alt="easygo logo">
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 " href="./tour_history.php"><i class="fa-solid fa-bus"></i> Tours</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./private_tour.php"><i class="fa-solid fa-car"></i> Private Tour</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./saved_tours.php"><i class="fa-solid fa-bookmark"></i>Tour Wishlist</a>
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
                    <div class="d-flex justify-content-center my-3 d-md-none">
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
                            <h3 class="m-0">Private Tour Request - Details</h3>
                            <div class="d-flex justify-content-center my-3">
                                <div class="d-flex gap-2">
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
                        </div>
                        <div class="main-content-body py-2">
                            <!-- ============================== -->
                            <!-- private tour history [start] -->
                            <div class="private-tour-requests-more" style="min-width: 992px; overflow-x: auto;">
                                <div class="accordion accordion-flush easygo-accordion-custom-1" id="accordionFlushExample">
                                    <div class="accordion-item heading">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-transparent" type="button">
                                                <div class="easygo-fw-1 w-100 d-flex justify-content-between">
                                                    <span style="flex: 1;">Curator</span>
                                                    <span style="flex: 1;">Price</span>
                                                    <span style="flex: 1;">Proposed Date</span>
                                                    <span style="flex: 1;"></span>
                                                </div>
                                            </button>
                                        </h2>
                                    </div>
                                    <?php

                                    $quotes = get_private_trip_quotes($request_id);
                                    if (!$quotes) {
                                        echo "No quotes submitted";
                                    }

                                    foreach ($quotes as $entry) {
                                        $quote_id = $entry["quote_id"];
                                        $curator = get_curator_name($entry["curator_id"]);
                                        $quote_date = format_string_as_date_fn($entry["date_posted"]);
                                        $comments = $entry["comments"];
                                        $fee = $entry["fee"];
                                        $currency = $entry["currency"];
                                        echo "
                                                <div class='accordion-item'>
                                                    <h2 class='accordion-header' id='flush-headingOne$quote_id'>
                                                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseOne$quote_id' aria-expanded='false' aria-controls='flush-collapseOne$quote_id'>
                                                            <div class='w-100 d-flex justify-content-between'>
                                                                <span style='flex: 1;'>$curator</span>
                                                                <span style='flex: 1;'>$currency $fee</span>
                                                                <span style='flex: 1;'>$quote_date</span>
                                                                <span class='text-end' style='flex: 1;'>More Details</span>
                                                            </div>
                                                        </button>
                                                    </h2>
                                                    <div id='flush-collapseOne$quote_id' class='accordion-collapse collapse' aria-labelledby='flush-headingOne$quote_id' data-bs-parent='#accordionFlushExample'>
                                                        <div class='accordion-body'>
                                                            <div class='bg-gray-3 py-4' style='margin: 0rem -0.5rem;'>
                                                                <div class='px-2'>
                                                                    $comments
                                                                </div>
                                                                <div class='quote-btns d-flex justify-content-end align-items-center gap-2 mt-4'>
                                                                    <button class='easygo-btn-3 easygo-rounded-1' onclick='return react_to_bid(false,\"$quote_id\")'><i class='fa-solid fa-circle-xmark'></i> &nbsp; Reject</button>
                                                                    <button class='easygo-btn-1 easygo-rounded-1' onclick='return display_invoice(\"$quote_id\")' data-bs-toggle='modal' data-bs-target='#quote-invoice-modal'><i class='fa-solid fa-circle-check'></i> &nbsp; Proceed to payment</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    ";
                                    }
                                    // TODO:: change the options that show for rejected quotes
                                    ?>

                                </div>
                            </div>
                            <!-- book private tour [end] -->
                            <!-- ============================== -->
                        </div>
                    </div>
                </main>
                <!-- dashboard content [end] -->
                <!-- ============================== -->
            </div>
        </main>
    </div>
    <!-- main content end -->

    <!-- ============================== -->
    <!-- dashboard content [start] -->
    <div class="modal fade" id="quote-invoice-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <h3>Your invoice</h3>
                <div class='row'>

                    <div class='col-6 text-right'>
                        <b>Quote charged</b>
                        <!-- <span class='text-gray-1' id='seat_span'>5 people</span> -->
                    </div>
                    <div class='text-align-righta col-6  '>
                        <span class='invoice_currency'>GHS</span> <span id='invoice_tour'>$fee</span>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 text-right'>
                        Discount applied <span class='text-gray-1'>(0%)</span>
                    </div>
                    <div class='text-align-righta col-6 '>
                        <span class='invoice_currency'>GHS</span> <span id='invoice_discount'>0.00</span>
                    </div>
                </div>
                <div class='row border-top border-bottom'>
                    <div class='col-6 text-right'>
                        <b>Sub-Total <span class='text-gray-1'>(Without Taxes)</span></b>
                    </div>
                    <div class='text-align-righta col-6 '>
                        <b> <span class='invoice_currency'>GHS</span> <span id='invoice_subtotal'>$fee</span></b>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 text-right'>
                        Value Added Tax <span class='text-gray-1'>(15%)</span>
                    </div>
                    <div class='text-align-righta col-6 '>
                        <span class='invoice_currency'>GHS</span> <span id='invoice_vat'>$vat</span>
                    </div>
                </div>
                <div class='row border-bottom'>
                    <div class='col-6 text-right'>
                        Tourism Levy <span class='text-gray-1'>(1%)</span>
                    </div>
                    <div class='text-align-righta col-6 '>
                        <span class='invoice_currency'>GHS</span> <span id='invoice_tourism'>$tourism</span>
                    </div>
                </div>
                <div class='row border-top border-bottom'>
                    <div class='col-6 text-right'>
                        <h5><b>Total Fee: </b></h5>
                    </div>
                    <div class='align-text-right col-6 '>
                        <h5><b><span class='invoice_currency'>GHS</span> <span id='invoice_total'>$total</span></b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="modal-footer pt-5 ">
                        <button class='easygo-btn-3 easygo-rounded-1' data-bs-toggle='modal' data-bs-target='#quote-invoice-modal'><i class='fa-solid fa-circle-xmark'></i> &nbsp; Cancel</button>

                        <?php echo "<button class='easygo-btn-1 easygo-rounded-1' onclick='return react_to_bid(true,\"$quote_id\",\"$email\")'><i class='fa-solid fa-circle-check'></i> &nbsp; Confirm</button>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard content [end] -->
    <!-- ============================== -->



    <!-- Bootstrap js -->
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../../assets/js/jquery-3.6.1.min.js"></script>
    <!-- Swiper js -->
    <script src="../../assets/js/swiper-bundle.min.js"></script>
    <!-- paystack js -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/../../utils/js_env_variables.php"); ?>
    <script src="../../assets/js/general.js"></script>
    <script src="../../assets/js/functions.js"></script>
    <script src="../../assets/js/private_tour.js"></script>
</body>

</html>