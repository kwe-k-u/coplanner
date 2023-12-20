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
    <title>Itinerary Information</title>
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
        <main class="container" style="margin-top: 7rem;">
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
                            <div class="my-3 d-flex justify-content-between">
                                <div>Created by <span class="text-blue easygo-fs-3 easygo-fw-1">Username</span></div>
                                <div class="easygo-fs-5">Three months ago</div>
                            </div>
                            <h5 class="easygo-fw-1">The Name of the Itinerary</h5>
                            <p>
                                An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
                            </p>
                        </div>
                        <div class="col-lg-6 p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    GHC 500 <br>
                                    Single day
                                </div>
                                <div>
                                    3-5 People <br>
                                    Single day
                                </div>
                            </div>
                            <div class="my-5">
                                <h1 class="easygo-fw-1">GHC 500</h1>
                                <p class="easygo-fs-4">Estimated cost</p>
                            </div>
                            <div class='d-flex justify-content-between gap-4'>
                                <a href='#' class='easygo-btn-5 bg-blue text-white easygo-fs-5 w-50'>Use Itinerary</a>
                                <a href='#' class='easygo-btn-4 border-blue text-blue easygo-fs-5 w-50 bg-white'>Add to Wishlist</a>
                            </div>
                        </div>
                    </div>
                </section>
                <!--- Section 1 [end] -->
                <!--- ================================ -->
                <!--- ================================ -->
                <!--- Section 2 [start] -->
                <section class="my-5">
                    <div class="my-4">
                        <h3 class="easygo-fw-1 m-0">Day one - some name description</h3>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                    </div>
                    <div class="my-4">
                        <h3 class="easygo-fw-1 m-0">Day one - some name description</h3>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 py-3 d-flex justify-content-center">
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
                    </div>
                    <div class="my-4 text-center easygo-fs-5">
                        <a href="#">Click to expand more locations</a>
                    </div>
                </section>
                <!--- Section 2 [end] -->
                <!--- ================================ -->
            </div>
            <!--- ================================ -->
            <!--- Section 4 [start] -->
            <section class="container px-4 my-5 py-5">
                <h2 class="mb-4">View other itineraries created by other people</h2>
                <nav>
                    <div class="nav nav-tabs easygo-nav-tabs-alt justify-content-center" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="popular-selections-tab" data-bs-toggle="tab" data-bs-target="#nav-popular-selections" type="button" role="tab" aria-controls="nav-popular-selections" aria-selected="true">Popular Selections</button>
                        <button class="nav-link" id="editors-pick-tab" data-bs-toggle="tab" data-bs-target="#nav-editors-pick" type="button" role="tab" aria-controls="nav-editors-pick" aria-selected="false">Editor's Pick</button>
                        <button class="nav-link" id="solo-travels-tab" data-bs-toggle="tab" data-bs-target="#nav-solo-travels" type="button" role="tab" aria-controls="nav-solo-travels" aria-selected="false">Solo Travels</button>
                        <button class="nav-link" id="budget-tours-tab" data-bs-toggle="tab" data-bs-target="#nav-budget-tours" type="button" role="tab" aria-controls="nav-budget-tours" aria-selected="false">Budget Tours</button>
                        <button class="nav-link" id="family-friendly-tab" data-bs-toggle="tab" data-bs-target="#nav-family-friendly" type="button" role="tab" aria-controls="nav-family-friendly" aria-selected="false">Family Friendly</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-popular-selections" role="tabpanel" aria-labelledby="popular-selections-tab">
                        <div class="itinerary-cards-container easygo-scroll-bar scroll-h">
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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
                        <div class="itinerary-cards-container easygo-scroll-bar scroll-h">
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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
                        <div class="itinerary-cards-container easygo-scroll-bar scroll-h">
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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
                        <div class="itinerary-cards-container easygo-scroll-bar scroll-h">
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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
                        <div class="itinerary-cards-container easygo-scroll-bar scroll-h">
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
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
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