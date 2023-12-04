<?php
require_once(__DIR__ . "/utils/core.php");
require_once(__DIR__ . "/utils/env_manager.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/utils/analytics/google_tag.php") ?>
    <link rel="icon" href="assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coplanner - Home</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="assets/css/general.css">
</head>

<body class="bg-gray-3">

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once("coplanner/coplanner_navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main class="container">
            <!--- ================================ -->
            <!--- Section 1 [start] -->
            <section class="" style="margin-top: 7rem;">
                <div class="row">
                    <div class="col-lg-6 p-3 d-flex flex-column justify-content-center">
                        <div class="d-flex flex-column gap-5">
                            <h2 class="text-blue easygo-fw-1">Create tour itineries yourself</h2>
                            <div class="easygo-fs-2">
                                Coplanner by easyGo is an itinerary creation tool for the best explorers in the world
                            </div>
                            <div class='d-flex justify-content-between gap-4'>
                                <a href='#' class='easygo-btn-5 bg-blue text-white easygo-fs-5 w-50'>Become an easyGo Partner</a>
                                <a href='coplanner/coplanner_setup.php' class='easygo-btn-4 border-blue text-blue easygo-fs-5 w-50 bg-white'>Try for individuals</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-3">
                        <div class="w-100 h-100 d-flex justify-content-center">
                            <img class="img-fluid" src="assets/images/site_images/coplanner.png" alt="coplanner image">
                        </div>
                    </div>
                </div>
            </section>
            <!--- Section 1 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 2 [start] -->
            <section class="my-5">
                <div>
                    <h2 class="easygo-fw-1 mb-4">What coplanner means for you</h2>
                    <div class="row">
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Flexibility</h3>
                                <div class="py-2">
                                    Make changes to aspects of the itinerary including budget, destinations and number of days
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Speed</h3>
                                <div class="py-2">
                                    Quickly make changes and create a full proof itinerary in minutes </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Convenience</h3>
                                <div class="py-2">
                                    Easily make payments for destinations, buses and accommodation
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--- Section 2 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 3 [start] -->
            <section class="my-5 py-5">
                <h2 class="text-center">
                    Access the information of
                    <br>
                    <span class="text-blue easygo-h2 easygo-fw-1">3000</span>
                    <br>
                    locations with coplanner
                </h2>
            </section>
            <!--- Section 3 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 4 [start] -->
            <section class="my-5 py-5">
                <h2 class="mb-4">View other itineraries created by other people</h2>
                <nav>
                    <div class="nav nav-tabs easygo-nav-tabs-alt" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="popular-selections-tab" data-bs-toggle="tab" data-bs-target="#nav-popular-selections" type="button" role="tab" aria-controls="nav-popular-selections" aria-selected="true">Popular Selections</button>
                        <button class="nav-link" id="editors-pick-tab" data-bs-toggle="tab" data-bs-target="#nav-editors-pick" type="button" role="tab" aria-controls="nav-editors-pick" aria-selected="false">Editor's Pick</button>
                        <button class="nav-link" id="solo-travels-tab" data-bs-toggle="tab" data-bs-target="#nav-solo-travels" type="button" role="tab" aria-controls="nav-solo-travels" aria-selected="false">Solo Travels</button>
                        <button class="nav-link" id="budget-tours-tab" data-bs-toggle="tab" data-bs-target="#nav-budget-tours" type="button" role="tab" aria-controls="nav-budget-tours" aria-selected="false">Budget Tours</button>
                        <button class="nav-link" id="family-friendly-tab" data-bs-toggle="tab" data-bs-target="#nav-family-friendly" type="button" role="tab" aria-controls="nav-family-friendly" aria-selected="false">Family Friendly</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-popular-selections" role="tabpanel" aria-labelledby="popular-selections-tab">
                        <div class="itinerary-cards-container" onclick="goto_page('coplanner/coplanner_home_2.php')">
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-editors-pick" role="tabpanel" aria-labelledby="editors-pick-tab">
                        <div class="itinerary-cards-container" onclick="goto_page('coplanner/coplanner_home_2.php')">
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-solo-travels" role="tabpanel" aria-labelledby="solo-travels-tab">
                        <div class="itinerary-cards-container" onclick="goto_page('coplanner/coplanner_home_2.php')">
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-budget-tours" role="tabpanel" aria-labelledby="budget-tours-tab">
                        <div class="itinerary-cards-container" onclick="goto_page('coplanner/coplanner_home_3.php')">
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-family-friendly" role="tabpanel" aria-labelledby="family-friendly-tab">
                        <div class="itinerary-cards-container" onclick="goto_page('coplanner/coplanner_home_2.php')">
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and the activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--- Section 4 [end] -->
            <!--- ================================ -->
        </main>
        <?php require_once(__DIR__."/components/footer.php") ?>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
     <?php require_once(__DIR__ . "/utils/js_env_variables.php"); ?>
    <script src="assets/js/general.js"></script>
    <script src="assets/js/functions.js"></script>
</body>

</html>