<?php
    require_once(__DIR__ . "/../utils/core.php");
    require_once(__DIR__."/../controllers/public_controller.php");

    $invoice_id = $_GET["id"];
    $invoice = get_invoice_by_id($invoice_id);
    $itinerary_id = $_GET["id"];
    $itinerary = get_itinerary_by_id($itinerary_id);
    $user_id = get_session_user_id();
    $username = get_user_info($user_id)["user_name"];

    $activity_budget = $invoice["activity_bill"];
    $transportation_budget = $invoice["transportation_bill"];
    $lodging_budget = $invoice["accommodation_bill"];
    $total_budget = $invoice["total_bill"];
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
    <title>easyGo - Itinerary Invoice</title>
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

                    <?php
                        echo "
                        <div class='col-lg-6 p-3 border-lg-end border-blue'>
                            <div style='height: 300px; background-color: var(--easygo-gray-2);'>
                            </div>
                            <div class='mt-3 mb-1 d-flex justify-content-between'>
                                <div>Created by <span class='text-blue easygo-fs-3 easygo-fw-1'>$username</span></div>
                            </div>
                            <p class='easygo-fw-1 easygo-fs-3'>Invoice INV007</p>
                            <div class='my-4'>
                                <h2 class='m-0'>GHC $total_budget</h2>
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
                                            <h6 class='easygo-fw-1'>GHC $activity_budget</h6 class='easygo-fw-1'>
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
                                                <p class='easygo-fs-5 ps-4'>3 rooms at <span class='text-blue easygo-fw-1'>Hotel Name</span></p>
                                            </div>
                                        </div>
                                        <div class='col-5'>
                                            <h6 class='easygo-fw-1'>GHC $lodging_budget</h6 class='easygo-fw-1'>
                                        </div>
                                    </div>
                                    <div class='row my-3'>
                                        <div class='col-7'>
                                            <div>
                                                <div class='form-check'>
                                                    <input class='form-check-input checkbox-checked-blue' checked type='checkbox' value='' id='transportation-check'>
                                                    <label class='form-check-label' for='transportation-check'>
                                                        Transportation
                                                    </label>
                                                </div>
                                                <p class='easygo-fs-5 ps-4'>1 bus from <span class='text-blue easygo-fw-1'>Bus Owner</span></p>
                                            </div>
                                        </div>
                                        <div class='col-5'>
                                            <h6 class='easygo-fw-1'>GHC $transportation_budget</h6 class='easygo-fw-1'>
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
                                                <p class='easygo-fs-5 ps-4'><a class='text-black' href='#'>Click to add</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                            ?>
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
                                        $div_text = "<h3 class='easygo-fw-1 m-0'>Day one</h3>";
                                        $activities = get_invoice_activities($invoice_id);
                                        $current_day = null;
                                        $current_destination = null;
                                        $activity_text = "";

                                        foreach ($activities as $activity) {

                                            if($current_day != $activity["visit_date"]){
                                                $div_text .= "<h3 class='easygo-fw-1 m-0'>Day one</h3>";
                                                $current_day = format_string_as_date_fn($activity["visit_date"]);
                                            }

                                            if($current_destination != $activity["destination_name"] or !$current_destination){
                                                if($current_destination){
                                                $div_text .= "
                                                <div class='col-md-6 col-12 py-3 d-flex justify-content-center'>
                                                    <div>
                                                        <h4 class='m-0'>$current_destination</h4>
                                                        <div>$current_day</div>
                                                        <div class='text-blue easygo-fs-2 py-2'>
                                                            <i class='fa-solid fa-wifi'></i> &nbsp;
                                                            <i class='fa-solid fa-bath'></i> &nbsp;
                                                            <i class='fa-solid fa-person-swimming'></i>
                                                        </div>
                                                        <div class='itinerary-activities'>
                                                        $activity_text
                                                    </div>
                                                </div>
                                            </div>";
                                                }
                                                $current_destination = $activity["destination_name"];
                                                $activity_text = "";
                                            }
                                                $act_name = $activity["activity_name"];
                                                $activity_text .="<span class='badge bg-blue easygo-fw-3 px-4 py-2'>$act_name</span>";



                                        }
                                        $div_text .= "
                                                <div class='col-md-6 col-12 py-3 d-flex justify-content-center'>
                                                    <div>
                                                        <h4 class='m-0'>$current_destination</h4>
                                                        <div>$current_day</div>
                                                        <div class='text-blue easygo-fs-2 py-2'>
                                                            <i class='fa-solid fa-wifi'></i> &nbsp;
                                                            <i class='fa-solid fa-bath'></i> &nbsp;
                                                            <i class='fa-solid fa-person-swimming'></i>
                                                        </div>
                                                        <div class='itinerary-activities'>
                                                        $activity_text
                                                    </div>
                                                </div>
                                            </div>";
                                        echo $div_text;
                                        // var_dump($destinations);
                                        // die();
                                            // $days = get_itinerary_days($itinerary_id);
                                            // // $days = array();
                                            // foreach ($days as $d) {
                                            //     $day_id = $d["day_id"];
                                            //     echo "<h3 class='easygo-fw-1 m-0'>Day one</h3>";
                                            //     $destinations = get_itinerary_day_info($day_id)["destinations"];
                                            //     foreach ($destinations as $destination) {
                                            //         $activities  = $destination["activities"];
                                            //         $destination_name = $destination["destination_name"];
                                            //         $location = $destination["location"];
                                            //         $activity_text = "";
                                            //         foreach ($activities as $activity) {
                                            //             $act_name = $activity["activity_name"];
                                            //             $activity_text .="
                                            //             <span class='badge bg-blue easygo-fw-3 px-4 py-2'>$act_name</span>
                                            //             ";
                                            //         }
                                            //         echo "
                                            //         <div class='col-md-6 col-12 py-3 d-flex justify-content-center'>
                                            //             <div>
                                            //                 <h4 class='m-0'>$destination_name</h4>
                                            //                 <div>$location</div>
                                            //                 <div class='text-blue easygo-fs-2 py-2'>
                                            //                     <i class='fa-solid fa-wifi'></i> &nbsp;
                                            //                     <i class='fa-solid fa-bath'></i> &nbsp;
                                            //                     <i class='fa-solid fa-person-swimming'></i>
                                            //                 </div>
                                            //                 <div class='itinerary-activities'>
                                            //                     $activity_text
                                            //                 </div>
                                            //             </div>
                                            //         </div>
                                            //         ";

                                            //     }
                                            //     if(sizeof($destinations) == 0){
                                            //         echo "<h5>No destinations were added for this day</h5>";
                                            //     }
                                            // }
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
    <script src="../assets/js/itinerary_invoice.js"></script>
</body>

</html>