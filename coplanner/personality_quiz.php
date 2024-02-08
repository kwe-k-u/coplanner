<?php
require_once(__DIR__ . "/../utils/core.php");
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
    <title>easyGo - Personality Quiz</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <style>
        .eh-transition-box {
            position: relative;
            overflow: hidden;
        }

        .eh-transition-page {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transform: translateX(100%);
            pointer-events: none;
            transition: all 0.3s;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 0 1rem;
        }

        .eh-transition-page::-webkit-scrollbar {
            width: 5px;
        }

        .eh-transition-page::-webkit-scrollbar-track {
            background: #F8973A;
        }

        /* Handle */
        .eh-transition-page::-webkit-scrollbar-thumb {
            background: #1204B5;
        }

        /* Handle on hover */
        .eh-transition-page::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .eh-transition-page.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
        }
    </style>
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
        <main class="container" style="height: 100vh; padding-top: 9rem; padding-bottom: 3rem;">
            <div class="loader"></div>
            <div id="setup-pages" class="eh-transition-box h-100">


                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="first-selection-page" class="active eh-transition-page"  data-transit-target="second-selection-page" data-transit-parent="first-selection-page">
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">A trip isn’t complete without</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="first-selection" id="museum-1st-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="museum-1st-select">
                                        <h3>Visits to local museums and historical sites</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="first-selection" id="skydiving-1st-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="skydiving-1st-select">
                                        <h3>An extreme activity like sky diving</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="first-selection" id="pool-1st-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="pool-1st-select">
                                        <h3>Relaxing on a beautiful beach or pool side</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="first-selection" id="bars-1st-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="bars-1st-select">
                                        <h3>Exploring popular bars and clubs</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->

                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="second-selection-page" class="eh-transition-page" data-transit-target="third-selection-page" data-transit-parent="second-selection-page">
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">The best place to spend the night is</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="second-selection" id="airbnb-2nd-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="airbnb-2nd-select">
                                        <h3>At a fancy AirBnB</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="second-selection" id="camp-2nd-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="camp-2nd-select">
                                        <h3>At a campsite or adventurous lodging</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="second-selection" id="party-2nd-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="party-2nd-select">
                                        <h3>By experiencing the local party scene</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="second-selection" id="culture-2nd-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="culture-2nd-select">
                                        <h3>A place in the heart of the culture and history</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->

                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="third-selection-page" class="eh-transition-page" data-transit-target="fourth-selection-page" data-transit-parent="third-selection-page">
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">How do you feel about outdoor activities?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="third-selection" id="challenge-3rd-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="challenge-3rd-select">
                                        <h3>Love them, the more challenging the better</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="third-selection" id="social-3rd-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="social-3rd-select">
                                        <h3>Open to them, if they are social</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="third-selection" id="leisure-3rd-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="leisure-3rd-select">
                                        <h3>Only if they are quiet and leisurely</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->

                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="fourth-selection-page" class="eh-transition-page" data-transit-target="fifth-selection-page" data-transit-parent="fourth-selection-page">
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">What’s the ideal travel pace?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="fourth-selection" id="action-4th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="action-4th-select">
                                        <h3>Fast paced and action-packed</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="fourth-selection" id="slow-4th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="slow-4th-select">
                                        <h3>Slow and relaxed</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="fourth-selection" id="culture-4th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="culture-4th-select">
                                        <h3>Moderate with time to absorb the local culture</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->

                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="fifth-selection-page" class="eh-transition-page" data-transit-target="sixth-selection-page" data-transit-parent="fifth-selection-page">
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">How do you plan your trips?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="fifth-selection" id="comfort-5th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="comfort-5th-select">
                                        <h3>Ensuring comfort in all arrangements</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="fifth-selection" id="history-5th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="history-5th-select">
                                        <h3>Researching the local history</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="fifth-selection" id="trendy-5th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="trendy-5th-select">
                                        <h3>Lookup the trendiest places</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="fifth-selection" id="experiences-5th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="experiences-5th-select">
                                        <h3>Finding new experiences</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->

                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="sixth-selection-page" class="eh-transition-page" data-transit-target="seventh-selection-page" data-transit-parent="sixth-selection-page">
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">How do you feel about unplanned events when you travel?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="sixth-selection" id="yes-6th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="yes-6th-select">
                                        <h3>As long as the fun continues</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="sixth-selection" id="no-6th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="no-6th-select">
                                        <h3>I prefer if things don’t change much</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->

                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="seventh-selection-page" class="eh-transition-page" data-transit-target="seventh-selection-page" data-transit-parent="seventh-selection-page">
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">What type of tour do you prefer?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="seventh-selection" id="adventure-7th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="adventure-7th-select">
                                        <h3>Wilderness Adventure</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
									<input type="radio" class="radio_choice"  name="seventh-selection" id="historical-7th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="historical-7th-select">
                                        <h3>Historical</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="seventh-selection" id="entertainment-7th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="entertainment-7th-select">
                                        <h3>Nightlife & Entertainment</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="seventh-selection" id="wellness-7th-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="wellness-7th-select">
                                        <h3>Spa & Wellness</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->
            </div>
        </main>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- Iconify js -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- easygo js -->
     <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>

    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/personality_quiz.js"></script>
</body>

</html>