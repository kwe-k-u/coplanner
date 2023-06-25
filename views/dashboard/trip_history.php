<?php
	require_once(__DIR__."/../../utils/core.php");
	require_once(__DIR__."/../../controllers/auth_controller.php");
	require_once(__DIR__."/../../controllers/private_tour_controller.php");
	require_once(__DIR__."/../../controllers/media_controller.php");
	require_once(__DIR__."/../../controllers/interaction_controller.php");

	login_check();
	$user_id = get_session_user_id();
	$user_name = get_username_by_id($user_id);
	$profile = get_user_profile_img($user_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - Trip History</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h5>Trips</h5>
                <button class="btn"><i class="fa-solid fa-bell"></i></button>
        </nav>
        <main>
            <div class="dashboard-content">
                <!-- ============================== -->
                <!-- sidebar [start] -->
                <aside id="userdashboard-sidebar" class="sidebar sidebar-left bg-white">
                    <div class="sidebar-header py-3">
                        <script>
                            function goHome() {
                                window.location.href = "../home.php";;
                            }
                        </script>
                        <div class="logo m-md-auto" onclick="return goHome()">
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./trip_history.php"><i class="fa-solid fa-bus"></i> Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./private_tour.php"><i class="fa-solid fa-car"></i> Private Tour</a>
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
                    <div class="d-flex justify-content-center my-3 d-md-none">
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
                </aside>
                <!-- sidebar [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- dashboard content [start] -->
                <main class="main-content bg-gray-3">
                    <div class="px-lg-5 px-2">
                        <div class="main-content-header d-flex justify-content-between align-items-center py-4 d-none d-md-flex">
                            <h3 class="m-0">Trips</h3>
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
                            <!-- trip history [start] -->
                            <section class="mt-5">
                                <div class="w-100" style="overflow-x: auto;">
                                    <h4 class="easygo-fs-2 easygo-fw-1 py-4">Trip History</h4>
                                    <div class="history-table-sec" style="min-width: 900px; overflow-x: auto;">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Tour Name</th>
                                                    <th>Tour date</th>
                                                    <th>Price</th>
                                                    <th>Seats</th>
                                                    <th>Status</th>
                                                    <th>Emergency contact information</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $bookings = get_user_booking_history($user_id);
                                                    $bookings = array_slice($bookings,0,4);

                                                    if(!$bookings){
                                                        echo "<tr><td><h5 class='easygo-fs-2 easygo-fw-5 py-4'>You haven't booked a tour yet</h5></td></tr>";
                                                    }

                                                    foreach ($bookings as $entry) {
                                                        $booking_id = $entry["booking_id"];
                                                        $trip_id = $entry["trip_id"];
                                                        $trip_name =get_campaign_by_trip_id($trip_id)["title"];
                                                        $seats = $entry["seats_booked"];
                                                        $currency = $entry["currency"];
                                                        $amount = $entry["amount_due"];
                                                        $emergency_name = $entry["emergency_contact_name"];
                                                        $emergency_number = $entry["emergency_contact_number"];
                                                        $tour_date = format_string_as_date_fn($entry["start_date"]);
                                                        echo "
                                                        <tr>
                                                            <td>$trip_name</td>
                                                            <td>$tour_date</td>
                                                            <td>$currency $amount</td>
                                                            <td>$seats</td>
                                                            <td>".
                                                            ($entry["start_date"] > date("Y-m-d") ?
                                                            " <span class='easygo-badge-orange easygo-fs-5'>Upcoming</span>"
                                                            : (
                                                                $entry["end_date"] > date("Y-m-d") ?
                                                                "<span class='easygo-badge-gray easygo-fs-5'>Canceled</span>" :
                                                                "<span class='easygo-badge-blue easygo-fs-5'>Completed</span>"
                                                            ))
                                                            ."</td>
                                                            <td>
                                                                <div class='col'>
                                                                    $emergency_name
                                                                    $emergency_number
                                                                </div>
                                                            </td>
                                                            <td><button class='del-btn my-3'><i class='fa-solid fa-edit'></i></button></td>
                                                        </tr>
                                                        ";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                            <!-- trip history [end] -->
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
    <!-- easygo js -->
    <?php require_once(__DIR__."/../../utils/js_env_variables.php"); ?>
    <script src="../../assets/js/general.js"></script>
    <script src="../../assets/js/home.js"></script>
    <script src="../../assets/js/functions.js"></script>
</body>

</html>