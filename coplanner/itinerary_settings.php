<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

$mixpanel = new mixpanel_class();
$mixpanel->log_page_view();

$itinerary_id = $_GET["id"];
$itinerary = get_itinerary_by_id($itinerary_id);
$days = get_itinerary_days($itinerary_id);
$user_id = get_session_user_id();
$username = get_user_info($user_id)["user_name"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <?php include_once(__DIR__ . "/../utils/analytics/google_head_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="easyGo connects you to tour experiences created by Ghanaian curators. Find the best things to do and book tours by locals">
    <meta name="keywords" content="things to do Ghana, Accra, tourism, tours, December in Ghana, experience Ghana">
    <meta name="author" content="easyGo Tours Ltd">
    <title>Itinerary Creation</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body class="bg-gray-3">
    <?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once("./coplanner_navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main style="margin-top: 7rem;">
            <div class="container bg-white px-4">
                <!--- ================================ -->
                <!--- Section 1 [start] -->
                <section>
                    <div class="row">
                        <div>
                        </div>

                        <div class='col-lg-6 p-3 border-lg-end border-blue'>
                            <img style='max-height: 350px; background-color: var(--easygo-gray-2);' src="../assets/images/others/long_1.jpeg" alt="" srcset="">
                            <div class="mt-3 bm-1 justify-content-between">
                                <div class="form-input-field">
                                    <label for="">Share your itinerary with the community?</label>
                                    <?php
                                    echo "<select name='' id='' onchange='return set_itinerary_visibility(\"$itinerary_id\",this)'>";
                                    ?>
                                    <option value="public">Yes - Share with the community</option>
                                    <option value="private">No - Keep it hidden</option>
                                    </select>
                                </div>
                                <h3>Select Dates for itinerary</h3>
                                <?php
                                foreach ($days as $current) {
                                    $day_id = $current["day_id"];
                                    echo "
                                        <div class='col'>
                                        <h4 >Day </h4>
                                        <div class='col-lg-6 form-input-field'>
                                        <input type='date' name='date' onchange='set_itinerary_day_date(\"$day_id\", this)'>
                                            </div>
                                        </div>
                                        ";
                                }
                                ?>
                            </div>
                            <?php
                            "

                            <div class='mt-3 mb-1 d-flex justify-content-between'>
                                <div>Created by <span class='text-blue easygo-fs-3 easygo-fw-1'>$username</span></div>
                            </div>
                            <p class='easygo-fw-1 easygo-fs-3'>Invoice invoice_id</p>
                            <div class='my-4'>
                                <h2 class='m-0'>GHC total_budget</h2>
                                <small>Total Itinerary cost</small>
                            </div>
                            <div class='justify-content-end'>
                                <div class='row'>
                                    <div class='col-6'>
                                        <a href='#' onclick=\"pay_invoice()\" class='easygo-btn-5 bg-orange text-white easygo-fs-5 flex-grow-1'>Pay Now</a>
                                    </div>
                                    <div class='col-6'>
                                        <a href='#' onclick=\"set_invoice_reminder()\"  class='easygo-btn-4 border-blue text-blue easygo-fs-5 flex-grow-1'>Remind me later</a>
                                    </div>
                                </div>
                            </div>
                            <!--- ================================ -->
                            <!-- Itinerary Cost breakdown [start] -->

                                <div class='my-5'>
                                    <p class='easygo-fs-5'>Itinerary Breakdown</p>
                                    <div class='row my-3'>
                                        <div class='col-7'>
                                            <div class='form-check'>
                                                <input class='form-check-input checkbox-checked-gray' checked type='checkbox' value='' id='activities-check'>
                                                <label class='form-check-label' for='activities-check'>
                                                    Activities
                                                </label>
                                            </div>
                                        </div>
                                        <div class='col-5'>
                                            <h6 class='easygo-fw-1'>GHC activity_budget</h6 class='easygo-fw-1'>
                                        </div>
                                    </div>
                                    <div class='row my-3'>
                                        <div class='col-7'>
                                            <div>
                                                <div class='form-check'>
                                                    <input class='form-check-input checkbox-checked-blue' checked type='checkbox' value='' id='accomodation-check'>
                                                    <label class='form-check-label' for='accomodation-check'>
                                                        Accomodation
                                                    </label>
                                                </div>
                                                <p class='easygo-fs-5 ps-4'>Click here to book Accommodation <a href='#' class='text-blue easygo-fw-1'>Hotel Name</a></p>
                                            </div>
                                        </div>
                                        <div class='col-5'>
                                            <h6 class='easygo-fw-1'>GHC lodging_budget</h6 class='easygo-fw-1'>
                                        </div>
                                    </div>
                                    <div class='row my-3'>
                                        <div class='col-7'>
                                            <div>
                                                <div class='form-check'>
                                                    <input class='form-check-input checkbox-checked-blue' checked type='checkbox' value='' id='transportation-check'>
                                                    <label class='form-check-label' for='transportation-check'>
                                                        Vehicle Rentals
                                                    </label>
                                                </div>
                                                <p class='easygo-fs-5 ps-4'>Click to book vehicle rental <span class='text-blue easygo-fw-1'>Vehicle Rentals</span></p>
                                            </div>
                                        </div>
                                        <div class='col-5'>
                                            <h6 class='easygo-fw-1'>GHC transportation_budget</h6 class='easygo-fw-1'>
                                        </div>
                                    </div>
                                    <div class='row my-3'>
                                        <div class='col-7'>
                                            <div>
                                                <div class='form-check'>
                                                    <input class='form-check-input checkbox-checked-blue' type='checkbox' value='' id='travel-insurance-check'>
                                                    <label class='form-check-label' for='travel-insurance-check'>
                                                        Travel Insurance
                                                    </label>
                                                </div>
                                                <p class='easygo-fs-5 ps-4'><a class='text-black' href='#'>Coming Soon</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                            ?>
                            <div class="pt-2">
                                <div class="d-flex justify-content-between mt-3">
                                    <?php
                                    echo "<button class='easygo-btn-5 bg-blue text-white easygo-fs-4 py-2 px-5' onclick='finalise_itinerary(\"$itinerary_id\")'>Proceed to checkout</button>";

                                    if (is_session_user_curator()) {
                                        echo "<button class='easygo-btn-5 bg-orange text-white easygo-fs-4 py-2 px-5' data-bs-toggle='modal' data-bs-target='#dest-1-modal' >Create a shared Experience</button>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- Itinerary Cost breakdown [end] -->
                            <!--- ================================ -->
                        </div>
                        <div class="col-lg-6 p-3">
                            <div class="position-relative">
                                <div>
                                    <div class="my-4">

                                        <!--- ================================ -->
                                        <!--- Destination Card [start] -->
                                        <?php
                                        $days = get_itinerary_days($itinerary_id);
                                        // $days = array();
                                        foreach ($days as $d) {
                                            $day_id = $d["day_id"];
                                            echo "<h3 class='easygo-fw-1 m-0'>Day one</h3>";
                                            $destinations = get_itinerary_day_info($day_id)["destinations"];
                                            foreach ($destinations as $destination) {
                                                $activities  = $destination["activities"];
                                                $destination_name = $destination["destination_name"];
                                                $location = $destination["location"];
                                                $activity_text = "";
                                                foreach ($activities as $activity) {
                                                    $act_name = $activity["activity_name"];
                                                    $activity_text .= "
                                                        <span class='badge bg-blue easygo-fw-3 px-4 py-2'>$act_name</span>
                                                        ";
                                                }
                                                echo "
                                                    <div class='col-md-6 col-12 py-3 d-flex justify-content-center'>
                                                        <div>
                                                            <h4 class='m-0'>$destination_name</h4>
                                                            <div>$location</div>
                                                            <div class='text-blue easygo-fs-2 py-2'>
                                                                <i class='fa-solid fa-wifi'></i> &nbsp;
                                                                <i class='fa-solid fa-bath'></i> &nbsp;
                                                                <i class='fa-solid fa-person-swimming'></i>
                                                            </div>
                                                            <div class='itinerary-activities'>
                                                                $activity_text
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ";
                                            }
                                            if (sizeof($destinations) == 0) {
                                                echo "<h5>No destinations were added for this day</h5>";
                                            }
                                        }
                                        ?>

                                        <!--- Destination Card [end] -->
                                        <!--- ================================ -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--- Section 1 [end] -->
                <!--- ================================ -->
            </div>
        </main>

        <!--- ================================ -->
        <!-- Destination Modals [start] -->
        <div class="modal fade " id="dest-1-modal" tabindex="-1" aria-labelledby="dest-1-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Shared Experiences</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body easygo-scroll-bar">
                        <div class="container-fluid">
                                    <form onsubmit="return create_shared_experience(this)">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-3">
                                        <div class="file-input drag-n-drop type-img" data-display-target="#flyer-img" data-input-target="#flyer_image">
                                            <div class="upload-symbol" style="border-radius: 0; background-color: transparent;">
                                                <img src="../assets/images/svgs/camera.svg" alt="upload symbol image">
                                            </div>
                                            <small class="easygo-fs-4 text-gray-1">Flyer or Image for Shared Experience</small>
                                            <input id="flyer_image" name="flyer_image" class="img-upload" accept=".png, .jpg, .jpeg, .svg" type="file" data-display-target="#flyer-img">
                                            <div id="flyer-img" data-input-target="#flyer_image" class="img-display display-full"></div>
                                        </div>

                                    </div>

                                        <div class="p-3">
                                            <h4 class="easygo-fw-1">Shared Experience Settings</h4 class="easygo-fw-1">

                                            <div class="col-12">
                                                <div class="form-input-field">
                                                    <small>Name of Experience</small>
                                                    <?php
                                                    $itinerary_name = $itinerary["itinerary_name"] ?? "";
                                                    echo "<input class='rounded-end rounded-0' type='text' name='experience_name' value='$itinerary_name'>";
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">

                                                    <div class="form-input-field">
                                                        <small>Start time of trip</small>
                                                        <input class="rounded-end rounded-0" type="time" name="start_time">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-input-field">
                                                        <small>Booking Price</small>
                                                        <input class="rounded-end rounded-0" type="number" name="price">
                                                    </div>

                                                </div>
                                                <div class="col-4">

                                                    <div class="form-input-field">
                                                        <small>Number of seats</small>
                                                        <input class="rounded-end rounded-0" type="number" name="seat_count">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-lg-6 p-3">
                                    <div class="form-input-field">
                                        <small>Experience Description</small>
                                        <textarea name="description" id="" rows="7" cols="30"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="justify-content-end p-2">
                                <button type="submit" class="easygo-btn-5 bg-blue text-white">Create Shared Experience</button>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Destination Modals [end] -->
            <!--- ================================ -->
        </div>
        <!-- main content end -->

        <!-- Bootstrap js -->
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <!-- paystack js -->
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <!-- JQuery js -->
        <script src="../assets/js/jquery-3.6.1.min.js"></script>
        <!-- easygo js -->
        <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
        <script src="../assets/js/general.js"></script>
        <script src="../assets/js/functions.js"></script>
        <script src="../assets/js/itinerary_creation.js"></script>
</body>

</html>