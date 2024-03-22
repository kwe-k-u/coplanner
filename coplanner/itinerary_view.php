<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

if (isset($_GET["id"])) {
    $itinerary_id = $_GET["id"];
    $itinerary = get_itinerary_by_id($itinerary_id);
    $date_created = format_string_as_date_fn($itinerary["date_created"]);
    $owner_name = $itinerary["owner_name"];
    $owner_id = $itinerary["owner_id"];
    $budget = $itinerary["budget"];
    $itinerary_name = $itinerary["itinerary_name"];
    $days = get_itinerary_days($itinerary_id);
} else if (isset($_GET["experience_id"])) {

    $experience_id = $_GET["experience_id"];
    $itinerary = get_shared_experience_by_id($experience_id);
    $date_created = "";
    $owner_name = $itinerary["curator_name"];
    $owner_id = $itinerary["curator_id"];
    $budget = $itinerary["booking_fee"];
    $available_seats = $itinerary["number_of_seats"];
    $itinerary_name = "Names are pending";
} else {
    echo "url broken";
    die();
}



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
    <title>Itinerary Information</title>
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
        <main class="container" style="margin-top: 7rem;">
            <div class="container bg-white px-4">
                <div class="pt-5">
                    <a onclick='window.history.back();' class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent"><i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
                <!--- ================================ -->
                <!--- Section 1 [start] -->
                <section>
                    <div class="row">
                        <div class='col-lg-6 p-3 border-lg-end border-blue'>
                            <img style='height: 300px; background-color: var(--easygo-gray-2);' src="../assets/images/others/long_1.jpeg" alt="" srcset="">
                            <?php
                            if(isset($_GET["id"])){
                                if ($owner_id == get_session_user_id()) {
                                    //Let user edit the original itinerary
                                    $edit_btn = "<a href='edit_itinerary.php?id=$itinerary_id' class='easygo-btn-5 bg-blue text-white easygo-fs-5 w-50'>Edit Itinerary</a>";
                                } else {
                                    // Let user create a duplicate on their account
                                    $edit_btn = "<a href='#' class='easygo-btn-5 bg-blue text-white easygo-fs-5 w-50' onclick=\"duplicate_itinerary('$itinerary_id')\">Use Itinerary</a>";
                                }
                            }else{
                                $edit_btn = "<a href='#' class='easygo-btn-5 bg-blue text-white easygo-fs-5 w-50' onclick=\"goto_page('coplanner/itinerary_invoice.php?experience_id=$experience_id')\">Book A Seat</a>";
                            }
                            echo "
                            <div class='my-3 d-flex justify-content-between'>
                                <div>Created by <span class='text-blue easygo-fs-3 easygo-fw-1'>$owner_name</span></div>
                                <div class='easygo-fs-5'>$date_created</div>
                            </div>
                            <h2 class='easygo-fw-1'>$itinerary_name</h2>
                        </div>
                        <div class='col-lg-6 p-3'>
                            <div class='my-5'>
                                <h1 class='easygo-fw-1'>GHC $budget</h1>
                                <p class='easygo-fs-4'>Estimated cost</p>
                            </div>
                            <div class='d-flex justify-content-between gap-4'>
                                $edit_btn
                                <a href='#' class='easygo-btn-4 border-blue text-blue easygo-fs-5 w-50 bg-white' onclick=\"toggle_wishlist()\">Add to Wishlist</a>
                            </div>
                        </div>
                    </div>
                    ";
                            ?>
                </section>
                <!--- Section 1 [end] -->
                <!--- ================================ -->
                <!--- ================================ -->
                <!--- Section 2 [start] -->
                <section class="my-5">
                    <?php
                    if (isset($_GET["id"])) {

                        foreach ($days as $d) {
                            $day_id = $d["day_id"];
                            $day = get_itinerary_day_info($day_id);
                            $destinations = $day["destinations"];

                            //open day section [start]
                            echo "
                        <div class='my-4'>
                            <h3 class='easygo-fw-1 m-0'>Day one</h3>
                            <div class='row'>";
                            //open day section [end]

                            foreach ($destinations as $dest) {
                                //open destination section [start]
                                $dest_name = $dest["destination_name"];
                                $location = $dest["location"];
                                echo "
                        <div class='col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center'>
                            <div>
                                <h4 class='m-0'>$dest_name</h4>
                                <div>$location</div>
                                <div class='text-blue easygo-fs-2 py-2'>
                                    <i class='fa-solid fa-wifi'></i> &nbsp;
                                    <i class='fa-solid fa-bath'></i> &nbsp;
                                    <i class='fa-solid fa-person-swimming'></i>
                                </div>
                                <div class='itinerary-activities'>";
                                //open destiantion section [end]

                                // activities section [start]
                                $activities = $dest["activities"];
                                foreach ($activities as $act) {
                                    $act_name = $act["activity_name"];
                                    echo "<span class='badge bg-blue easygo-fw-3 px-4 py-2'>$act_name</span>";
                                }
                                // activities section [end]
                                //close desitnation section [start]
                                echo "</div>
                            </div>
                        </div>";
                                //close destination section [end]
                            }

                            //Close day section [start]
                            echo "    </div>
                        </div>
                        ";
                            //Close day section [end]
                        }
                    } else {

                        $activities = get_shared_experience_activities($experience_id);
                        $current_date = format_string_as_date_fn($activities[0]["visit_date"]);
                        $current_destination = $activities[0]["destination_id"];
                        $dest_name = $activities[0]["destination_name"];
                        $location = $activities[0]["location"];

                        echo "
                        <div class='my-4'>
                            <h3 class='easygo-fw-1 m-0'>Day one</h3>
                            <div class='row'>
                            <div class='col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center'>
                                <div>
                                    <h4 class='m-0'>$dest_name</h4>
                                    <div>$location</div>
                                    <div class='text-blue easygo-fs-2 py-2'>
                                        <i class='fa-solid fa-wifi'></i> &nbsp;
                                        <i class='fa-solid fa-bath'></i> &nbsp;
                                        <i class='fa-solid fa-person-swimming'></i>
                                    </div>
                                    <div class='itinerary-activities'>
                        ";
                        foreach ($activities as $entry) {
                            $visit_date = format_string_as_date_fn($entry["visit_date"]);
                            $dest_name = $entry["destination_name"];
                            $location = $entry["location"];
                            if($visit_date != $current_date){
                                $current_date = $visit_date;
                                echo  "</div>
                                </div>
                                <div class='my-4'>
                                    <h3 class='easygo-fw-1 m-0'>Day one</h3>
                                    <div class='row'>
                                ";
                            }

                            if ($current_destination != $entry["destination_id"]){
                                $current_destination = $entry["destination_id"];
                                //close desitnation section [start]
                                    echo "</div>
                                    </div>
                                </div>
                                <div class='col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center'>
                                    <div>
                                        <h4 class='m-0'>$dest_name</h4>
                                        <div>$location</div>
                                        <div class='text-blue easygo-fs-2 py-2'>
                                            <i class='fa-solid fa-wifi'></i> &nbsp;
                                            <i class='fa-solid fa-bath'></i> &nbsp;
                                            <i class='fa-solid fa-person-swimming'></i>
                                        </div>
                                        <div class='itinerary-activities'>";
                                //close desitnation section [end]
                            }

                        }
                        //Close day section [start]
                        echo "    </div>
                        </div>
                        ";
                    }

                    ?>
                </section>
                <!--- Section 2 [end] -->
                <!--- ================================ -->
            </div>
            <!--- ================================ -->
            <!--- Section 4 [start] -->
            <?php
            include_once(__DIR__ . "/../components/itinerary_suggestions.php");
            ?>
            <!--- Section 4 [end] -->
            <!--- ================================ -->
        </main>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>