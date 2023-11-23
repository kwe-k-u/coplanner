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
    <title>Itinerary Item View With Sentiment</title>
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
        <main class="container-fluid" style="margin-top: 7rem;">
            <div class="row my-4">
                <div class="col-lg-4 py-2 d-flex justify-content-between">
                </div>
                <div class="col-lg-4 py-2 d-flex justify-content-center">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="easygo-fs-4">
                            Itinerary Name/Day one
                        </div>
                        <div>
                            <a href='../views/login.php' class='easygo-btn-4 border-blue text-blue easygo-fs-5 py-1'>Add New Date</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 py-2 d-flex justify-content-center">
                    <div class="d-flex align-items-center gap-2">
                        <span class="box-shadow-3 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border-radius: 50%;">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.74967 4.33325L12.458 10.2916L18.4163 12.9999L12.458 15.7083L9.74967 21.6666L7.04134 15.7083L1.08301 12.9999L7.04134 10.2916L9.74967 4.33325ZM9.74967 9.56575L8.66634 11.9166L6.31551 12.9999L8.66634 14.0833L9.74967 16.4341L10.833 14.0833L13.1838 12.9999L10.833 11.9166L9.74967 9.56575ZM20.583 9.74992L19.218 6.78159L16.2497 5.41658L19.218 4.06242L20.583 1.08325L21.9372 4.06242L24.9163 5.41658L21.9372 6.78159L20.583 9.74992ZM20.583 24.9166L19.218 21.9482L16.2497 20.5833L19.218 19.2291L20.583 16.2499L21.9372 19.2291L24.9163 20.5833L21.9372 21.9482L20.583 24.9166Z" fill="#1204B5" />
                            </svg>
                        </span>
                        Work with Coplanner
                    </div>
                </div>
            </div>
            <div class="position-relative" style="overflow-x: hidden">
                <!--- ================================ -->
                <!-- sidebar [start] -->
                <aside id="itinerary-sidebar" class="sidebar sidebar-left sidebar-alt-280 position-absolute bg-white">
                    <div class="bg-blue position-relative" style="height: 2rem;">
                        <button class="d-flex flex-column justify-content-center bg-blue align-items-start gap-1 position-absolute h-100 border-0 sidebar-toggler" style="right: -2.8rem; top: 0;" data-target="itinerary-sidebar">
                            <div class="bg-white" style="padding: 0.1rem 1rem;"></div>
                            <div class="bg-white" style="padding: 0.1rem 1rem;"></div>
                            <div class="bg-white" style="padding: 0.1rem 1rem;"></div>
                        </button>
                    </div>
                    <div class="px-2 bg-white">
                        <div class="border-bottom border-blue border-2 py-3">
                            <h5 class="easygo-fw-1 py-2">Itinerary Overview</h5>
                            <div class="row py-2">
                                <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                                    <div><i class="fa-solid fa-wallet text-blue easygo-fs-1"></i></div>
                                    <div class="easygo-fs-4">Budget</div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <h5>GHS 2500</h5>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                                    <div><i class="fa-solid fa-calendar text-blue easygo-fs-1"></i></div>
                                    <div class="easygo-fs-4">Calendar</div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <h5>2 days</h5>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                                    <div><i class="fa-solid fa-users text-blue easygo-fs-1"></i></div>
                                    <div class="easygo-fs-4">People</div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <h5>2 people</h5>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom border-blue border-2 py-3">
                            <h5 class="py-2">Additional Services</h5>
                            <div class="row py-3">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="user-icon bg-gray-1"></div>
                                </div>
                                <div class="col-9 d-flex flex-column justify-content-center">
                                    <h6 class="easygo-fw-1 mb-0">Curator</h6>
                                    <div>easyGo Tours</div>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="user-icon bg-gray-1"></div>
                                </div>
                                <div class="col-9 d-flex flex-column justify-content-center">
                                    <h6 class="easygo-fw-1 mb-0">Accomodation</h6>
                                    <div>
                                        <div class="easygo-fs-4">AH Hotel</div>
                                        <div class="easygo-fs-5">Day 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="user-icon bg-gray-1"></div>
                                </div>
                                <div class="col-9 d-flex flex-column justify-content-center">
                                    <h6 class="easygo-fw-1 mb-0">Transportation</h6>
                                    <div>
                                        <div class="easygo-fs-4">AH Hotel</div>
                                        <div class="easygo-fs-5">Day 1</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3">
                            <div class="row py-3">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <div class="user-icon bg-gray-1"></div>
                                </div>
                                <div class="col-9 d-flex flex-column justify-content-center">
                                    <h6 class="easygo-fw-1 mb-0">Collab Chat</h6>
                                    <div class="easygo-fs-5">5 new messages</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- sidebar [end] -->
                <!--- ================================ -->
                <!--- ================================ -->
                <!-- main-content [start] -->
                <section>
                    <div class="row">
                        <!--- ================================ -->
                        <!-- Itinerary Exp [start] -->
                        <div class="col-lg-6 p-3">
                            <div class="bg-white p-5 box-shadow-3">
                                <h3 class="easygo-fw-1">
                                    Day One
                                </h3>
                                <div>Here is the summary of the activities and destinations selected for the day </div>
                                <ul class="easygo-list-4">
                                    <li>
                                        <div class="row">
                                            <div class="col-4">
                                                <h5>Shai Hills</h5>
                                                <p class="easygo-fs-5">8:00 AM</p>
                                            </div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    Here is the summary of the activities and destinations selected for the day
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-4">
                                                <h5>Asenema Waterfall</h5>
                                                <p class="easygo-fs-5">8:00 AM</p>
                                            </div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    Here is the summary of the activities and destinations selected for the day
                                                </div>
                                                <div class="mt-2">
                                                    <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                    <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-4">
                                                <h5>Shai Hills</h5>
                                                <p class="easygo-fs-5">8:00 AM</p>
                                            </div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    Here is the summary of the activities and destinations selected for the day
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="py-2 text-end">
                                    <a href="#">Add More</a>
                                </div>
                            </div>
                        </div>
                        <!-- Itinerary Exp [end] -->
                        <!--- ================================ -->
                        <!--- ================================ -->
                        <!-- Sentiment Analysis [start] -->
                        <div class="col-lg-6 p-3">
                            <div class="bg-white p-5 box-shadow-3">
                                <div>
                                    <h3 class="m-0">
                                        Destination Suggestions
                                    </h3>
                                    <div class="row">
                                        <div class="col-6 p-2">
                                            <div class="p-2">
                                                <div class="row p-3 border border-1 border-blue rounded-3">
                                                    <div class="col-3">
                                                        <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h6 class="easygo-fw-1">Intense Activity</h6>
                                                        <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 p-2">
                                            <div class="p-2">
                                                <div class="row p-3 border border-1 border-blue rounded-3">
                                                    <div class="col-3">
                                                        <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h6 class="easygo-fw-1">Number of days</h6>
                                                        <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-blue border border-1 opacity-100">
                                <div>
                                    <h3 class="m-0">
                                        Sentiment Analysis
                                    </h3>
                                    <div class="row">
                                        <div class="col-6 p-2">
                                            <div class="p-2">
                                                <div class="row p-3 border border-1 border-blue rounded-3">
                                                    <div class="col-3">
                                                        <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h6 class="easygo-fw-1">Intense Activity</h6>
                                                        <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 p-2">
                                            <div class="p-2">
                                                <div class="row p-3 border border-1 border-blue rounded-3">
                                                    <div class="col-3">
                                                        <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h6 class="easygo-fw-1">Number of days</h6>
                                                        <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="#">Expand</a>
                                    </div>
                                </div>
                                <hr class="border-blue border border-1 opacity-100">
                                <div>
                                    <h3 class="m-0">
                                        Activity Suggestions
                                    </h3>
                                    <div class="row">
                                        <div class="col-6 p-2">
                                            <div class="p-2">
                                                <div class="row p-3 border border-1 border-blue rounded-3">
                                                    <div class="col-3">
                                                        <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h6 class="easygo-fw-1">Intense Activity</h6>
                                                        <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 p-2">
                                            <div class="p-2">
                                                <div class="row p-3 border border-1 border-blue rounded-3">
                                                    <div class="col-3">
                                                        <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                    </div>
                                                    <div class="col-9">
                                                        <h6 class="easygo-fw-1">Number of days</h6>
                                                        <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sentiment Analysis [end] -->
                        <!--- ================================ -->
                    </div>
                </section>
                <!-- main-content [end] -->
                <!--- ================================ -->
                <section class="py-5">
                    <div class="d-flex justify-content-center mt-3">
                        <button class="easygo-btn-5 bg-blue text-white easygo-fs-4 py-2 px-5">Finalize</button>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <!-- <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?> -->
    <script src="../assets/js/general.js"></script>
    <!--  -->
    <!-- <script src="../assets/js/functions.js"></script> -->
</body>

</html>