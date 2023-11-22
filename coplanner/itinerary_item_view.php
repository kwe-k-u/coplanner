<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../utils/env_manager.php");
require_once(__DIR__ . "/../controllers/interaction_controller.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerary Item View</title>
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
                        <button class="box-shadow-3 d-flex justify-content-center align-items-center border-0 " style="width: 40px; height: 40px; border-radius: 50%;" data-proxy-target="sentiment-tab">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.74967 4.33325L12.458 10.2916L18.4163 12.9999L12.458 15.7083L9.74967 21.6666L7.04134 15.7083L1.08301 12.9999L7.04134 10.2916L9.74967 4.33325ZM9.74967 9.56575L8.66634 11.9166L6.31551 12.9999L8.66634 14.0833L9.74967 16.4341L10.833 14.0833L13.1838 12.9999L10.833 11.9166L9.74967 9.56575ZM20.583 9.74992L19.218 6.78159L16.2497 5.41658L19.218 4.06242L20.583 1.08325L21.9372 4.06242L24.9163 5.41658L21.9372 6.78159L20.583 9.74992ZM20.583 24.9166L19.218 21.9482L16.2497 20.5833L19.218 19.2291L20.583 16.2499L21.9372 19.2291L24.9163 20.5833L21.9372 21.9482L20.583 24.9166Z" fill="#1204B5" />
                            </svg>
                        </button>
                        Work with Coplanner
                    </div>
                </div>
            </div>
            <div>
                <div class="d-flex gap-2">
                    <!--- ================================ -->
                    <!--- ================================ -->
                    <!-- sidebar [start] -->
                    <aside id="itinerary-sidebar" class="shrinkable-sidebar-280 shrinkable-sidebar easygo-scroll-bar h-100 pt-3" style="max-height: 100%">
                        <div class="bg-blue position-relative" style="height: 2rem">
                            <button class="d-flex flex-column justify-content-center bg-blue align-items-start gap-1 h-100 border-0 shrinkable-sidebar-toggler" style="right: -2.8rem; top: 0" data-target="itinerary-sidebar">
                                <div class="bg-white" style="padding: 0.1rem 1rem"></div>
                                <div class="bg-white" style="padding: 0.1rem 1rem"></div>
                                <div class="bg-white" style="padding: 0.1rem 1rem"></div>
                            </button>
                        </div>
                        <div class="bg-white">
                            <div class=" py-3">
                                <h5 class="easygo-fw-1 py-2 sec-title"><span class="expand-d-none">Itinerary</span> <span>Overview</span></h5>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <div>
                                                <i class="fa-solid fa-wallet text-blue easygo-fs-1"></i>
                                            </div>
                                            <div class="easygo-fs-4 expand-toggle">Budget</div>
                                            <div class="easygo-fs-4 expand-toggle-rev">GHS 2500</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex align-items-center h-100">
                                            <h5>GHS 2500</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <div>
                                                <i class="fa-solid fa-calendar text-blue easygo-fs-1"></i>
                                            </div>
                                            <div class="easygo-fs-4 expand-toggle">Calendar</div>
                                            <div class="easygo-fs-4 expand-toggle-rev">2 days</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex align-items-center h-100">
                                            <h5>2 days</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <div>
                                                <i class="fa-solid fa-users text-blue easygo-fs-1"></i>
                                            </div>
                                            <div class="easygo-fs-4 expand-toggle">People</div>
                                            <div class="easygo-fs-4 expand-toggle-rev">2 People</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex align-items-center h-100">
                                            <h5>2 people</h5>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-3 border-blue opacity-100 mx-2">
                                <h5 class="py-2 sec-title"><span class="expand-d-none">Additional</span> <span>Services</span></h5>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev">Curator</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex flex-column justify-content-center h-100">
                                            <h6 class="easygo-fw-1 mb-0">Curator</h6>
                                            <div>easyGo Tours</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev">Accomodation</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="easygo-fw-1 mb-0">Accomodation</h6>
                                            <div>
                                                <div class="easygo-fs-4">AH Hotel</div>
                                                <div class="easygo-fs-5">Day 1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev">Transportation</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="easygo-fw-1 mb-0">Transportation</h6>
                                            <div>
                                                <div class="easygo-fs-4">AH Hotel</div>
                                                <div class="easygo-fs-5">Day 1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-3 border-blue opacity-100 mx-2">
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev text-center">5 new <br>messages</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="col-9 d-flex flex-column justify-content-center">
                                            <h6 class="easygo-fw-1 mb-0">Collab Chat</h6>
                                            <div class="easygo-fs-5">5 new messages</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- sidebar [end] -->
                    <!--- ================================ -->
                    <!--- ================================ -->
                    <!-- main-content [start] -->
                    <section style="flex: 1">
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
                                                    <div class="easygo-fs-5 d-flex justify-content-between align-items-center">
                                                        <div>8:00 AM</div>
                                                        <button class="border-0 bg-transparent" data-proxy-target="itinerary-poll-tab">
                                                            <svg width="30" height="30" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M28.3333 24.0835C29.8917 24.0835 31.1667 22.8085 31.1667 21.2502V5.66683C31.1667 4.1085 29.8917 2.8335 28.3333 2.8335H13.4583C13.8833 3.6835 14.1667 4.67516 14.1667 5.66683H28.3333V21.2502H15.5833V24.0835M21.25 9.91683V12.7502H12.75V31.1668H9.91667V22.6668H7.08333V31.1668H4.25V19.8335H2.125V12.7502C2.125 11.1918 3.4 9.91683 4.95833 9.91683H21.25ZM11.3333 5.66683C11.3333 7.22516 10.0583 8.50016 8.5 8.50016C6.94167 8.50016 5.66667 7.22516 5.66667 5.66683C5.66667 4.1085 6.94167 2.8335 8.5 2.8335C10.0583 2.8335 11.3333 4.1085 11.3333 5.66683ZM24.0833 8.50016H26.9167V19.8335H24.0833V8.50016ZM19.8333 14.1668H22.6667V19.8335H19.8333V14.1668ZM15.5833 14.1668H18.4167V19.8335H15.5833V14.1668Z" fill="#1204B5" />
                                                            </svg>
                                                        </button>
                                                    </div>
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
                            <!-- Suggestions [start] -->
                            <div class="col-lg-6 p-3">
                                <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="itinerary-poll-tab" data-bs-toggle="tab" data-bs-target="#itinerary-poll-tab-pane" type="button" role="tab" aria-controls="itinerary-poll-tab-pane" aria-selected="true">Home</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sentiment-tab" data-bs-toggle="tab" data-bs-target="#sentiment-tab-pane" type="button" role="tab" aria-controls="sentiment-tab-pane" aria-selected="false">Profile</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="itinerary-poll-tab-pane" role="tabpanel" aria-labelledby="itinerary-poll-tab-pane">
                                        <div class="bg-white p-5 box-shadow-3">
                                            <h3 class="easygo-fw-1">
                                                Itinerary Poll
                                            </h3>
                                            <div>A change has been suggested by a collaborator. You can choose option to maintain</div>
                                            <div class="suggestion-cards-container">
                                                <div class="suggestion-card my-3">
                                                    <div class="suggestion-card-header">
                                                        Suggested by <span class="text-blue">Kweku</span>
                                                    </div>
                                                    <div class="suggestion-card-location">
                                                        Shai Hills
                                                    </div>
                                                    <div class="suggestion-card-body">
                                                        <p>
                                                            Here is the summary of the activities and destinations selected for the day
                                                        </p>
                                                        <div class="suggestion-card-activities">
                                                            <div class="mt-2">
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button class="easygo-btn-5 bg-blue text-white easygo-fs-5">Accept</button>
                                                    </div>
                                                </div>
                                                <div class="suggestion-card my-3">
                                                    <div class="suggestion-card-header">
                                                        Suggested by <span class="text-blue">Kweku</span>
                                                    </div>
                                                    <div class="suggestion-card-location">
                                                        Shai Hills
                                                    </div>
                                                    <div class="suggestion-card-body">
                                                        <p>
                                                            Here is the summary of the activities and destinations selected for the day
                                                        </p>
                                                        <div class="suggestion-card-activities">
                                                            <div class="mt-2">
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button class="easygo-btn-5 bg-blue text-white easygo-fs-5">Accept</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="sentiment-tab-pane" role="tabpanel" aria-labelledby="sentiment-tab-pane">
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
                                </div>
                            </div>
                            <!-- Suggestions [end] -->
                            <!--- ================================ -->
                        </div>
                    </section>
                    <!-- main-content [end] -->
                    <!--- ================================ -->
                </div>
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
    <!-- <script src="../assets/js/swiper-bundle.min.js"></script> -->
    <!-- easygo js -->
    <!-- <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?> -->
    <script src="../assets/js/general.js"></script>
    <!-- <script src="../assets/js/home.js"></script> -->
    <!-- <script src="../assets/js/functions.js"></script> -->
    <script>
        [].slice
            .call(document.querySelectorAll("button[data-proxy-target]"))
            .forEach((proxy) => {
                proxy.addEventListener("click", (event) => {
                    let target = document.getElementById(event.target.getAttribute("data-proxy-target"))
                    target.click()
                    console.log(target)
                })
            });
    </script>
</body>

</html>