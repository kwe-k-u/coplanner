<?php
    require_once(__DIR__ . "/../utils/core.php");
    require_once(__DIR__ . "/../controllers/admin_controller.php");

	if (!is_session_user_curator()) {
		header("Location: ../index.php");
		die();
	}

	$info =get_curator_account_by_user_id(get_session_user_id());
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

    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="robots" content="noindex, nofollow" />
    <title>Admin | Destination Requests</title>
    <meta name="robots" content="noindex, nofollow" />
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

            <?php require_once(__DIR__."/../components/admin_header.php"); ?>
            <?php require_once(__DIR__."/../components/curator_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
        <?php require_once(__DIR__. "/../components/curator_navbar_desktop.php"); ?>


            <div class="main-content px-3">
                <section class="trip-booking">
                    <div class="border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">Bookings</h5>
                            <small class="easygo-fs-5 text-gray-1"><a href="dashboard.php">Admin</a> > Transactions</small>
                        </div>
                        <p class="mt-4 mb-0">This table shows bookings you have received</p>
                    </div>
                    <!-- <div class="controls d-flex justify-content-between align-items-between py-3">
                        <div class="left-controls">
                            <form id="dashboard-search">
                                <div class="form-input-field">
                                    <input class="p-2" type="text" placeholder="search">
                                </div>
                            </form>
                        </div>
                        <div class="right-controls d-flex gap-2 easygo-fs-5">
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
                    </div> -->
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
                    <!-- <div class="pagination-section my-5">
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
                    </div> -->
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
</body>

</html>