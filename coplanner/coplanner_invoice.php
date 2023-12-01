<?php
require_once(__DIR__ . "/../utils/core.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coplanner - Home 3</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body class="bg-gray-3">

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
                <div class="pt-5">
                    <a class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent"><i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
                <!--- ================================ -->
                <!--- Section 1 [start] -->
                <section>
                    <div class="row">
                        <div class="col-lg-6 p-3 border-lg-end border-blue">
                            <div style="height: 300px; background-color: var(--easygo-gray-2);">
                            </div>
                            <div class="mt-3 mb-1 d-flex justify-content-between">
                                <div>Created by <span class="text-blue easygo-fs-3 easygo-fw-1">Username</span></div>
                                <div class="easygo-fs-5">Three months ago</div>
                            </div>
                            <p class="easygo-fw-1 easygo-fs-3">Invoice INV007</p>
                            <div class="my-4">
                                <h2 class="m-0">GHC 500</h2>
                                <small>Itinerary cost</small>
                            </div>
                            <div class="justify-content-end">
                                <div class='row'>
                                    <div class="col-6">
                                        <a href='#' class='easygo-btn-5 bg-orange text-white easygo-fs-5 flex-grow-1'>Pay Now</a>
                                    </div>
                                    <div class="col-6">
                                        <a href='#' class='easygo-btn-4 border-blue text-blue easygo-fs-5 flex-grow-1'>Remind me later</a>
                                    </div>
                                </div>
                            </div>
                            <div class="my-5">
                                <p class="easygo-fs-5">Itinerary Breakdown</p>
                                <div class="row my-3">
                                    <div class="col-7">
                                        <div class="form-check">
                                            <input class="form-check-input checkbox-checked-gray" checked type="checkbox" value="" id="activities-check">
                                            <label class="form-check-label" for="activities-check">
                                                Activities
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h6 class="easygo-fw-1">GHC 300</h6 class="easygo-fw-1">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-7">
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input checkbox-checked-blue" checked type="checkbox" value="" id="accomodation-check">
                                                <label class="form-check-label" for="accomodation-check">
                                                    Accomodation
                                                </label>
                                            </div>
                                            <p class="easygo-fs-5 ps-4">3 rooms at <span class="text-blue easygo-fw-1">Hotel Name</span></p>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h6 class="easygo-fw-1">GHC 100</h6 class="easygo-fw-1">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-7">
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input checkbox-checked-blue" checked type="checkbox" value="" id="transportation-check">
                                                <label class="form-check-label" for="transportation-check">
                                                    Transportation
                                                </label>
                                            </div>
                                            <p class="easygo-fs-5 ps-4">1 bus from <span class="text-blue easygo-fw-1">Bus Owner</span></p>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h6 class="easygo-fw-1">GHC 50</h6 class="easygo-fw-1">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-7">
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input checkbox-checked-blue" type="checkbox" value="" id="travel-insurance-check">
                                                <label class="form-check-label" for="travel-insurance-check">
                                                    Travel Insurance
                                                </label>
                                            </div>
                                            <p class="easygo-fs-5 ps-4"><a class="text-black" href="#">Click to add</a></p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-5">
                                        <h6 class="easygo-fw-1">GHC 50</h6 class="easygo-fw-1">
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 p-3">
                            <div class="position-relative">
                                <div>
                                    <div class="my-4">
                                        <h3 class="easygo-fw-1 m-0">Day one - some name description</h3>
                                        <!--- ================================ -->
                                        <!--- Destination Card [start] -->
                                        <div class="row">
                                            <div class="col-md-6 col-12 py-3 d-flex justify-content-center">
                                                <div>
                                                    <h4 class="m-0">Destination Name</h4>
                                                    <div>Greater Accra, Ghana</div>
                                                    <div class="text-blue easygo-fs-2 py-2">
                                                        <i class="fa-solid fa-wifi"></i> &nbsp;
                                                        <i class="fa-solid fa-bath"></i> &nbsp;
                                                        <i class="fa-solid fa-person-swimming"></i>
                                                    </div>
                                                    <div class="itinerary-activities">
                                                        <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                        <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- Destination Card [end] -->
                                        <!--- ================================ -->
                                        <!--- ================================ -->
                                        <!--- Destination Card [start] -->
                                        <div class="row">
                                            <div class="col-md-6 col-12 py-3 d-flex justify-content-center">
                                                <div>
                                                    <h4 class="m-0">Destination Name</h4>
                                                    <div>Greater Accra, Ghana</div>
                                                    <div class="text-blue easygo-fs-2 py-2">
                                                        <i class="fa-solid fa-wifi"></i> &nbsp;
                                                        <i class="fa-solid fa-bath"></i> &nbsp;
                                                        <i class="fa-solid fa-person-swimming"></i>
                                                    </div>
                                                    <div class="itinerary-activities">
                                                        <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                        <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--- Destination Card [end] -->
                                        <!--- ================================ -->
                                        <!--- ================================ -->
                                        <!--- Destination Card [start] -->
                                        <div class="row">
                                            <div class="col-md-6 col-12 py-3 d-flex justify-content-center">
                                                <div>
                                                    <h4 class="m-0">Destination Name</h4>
                                                    <div>Greater Accra, Ghana</div>
                                                    <div class="text-blue easygo-fs-2 py-2">
                                                        <i class="fa-solid fa-wifi"></i> &nbsp;
                                                        <i class="fa-solid fa-bath"></i> &nbsp;
                                                        <i class="fa-solid fa-person-swimming"></i>
                                                    </div>
                                                    <div class="itinerary-activities">
                                                        <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                        <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <!-- <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>

    <script src="../assets/js/functions.js"></script> -->
</body>

</html>