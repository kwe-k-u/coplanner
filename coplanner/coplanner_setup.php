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
    <title>easyGo - Tell us about You</title>
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
                <!-- Itinerary destinations [start] -->
                <section id="location-selection-page" class="active eh-transition-page">
                    <div class="mb-4 d-flex justify-content-end">
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="duration-selection-page" data-transit-parent="location-selection-page" > Next <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">Where will you like to go?</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="location-selection" id="accra-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="accra-select">
                                        <h3>Greater Accra</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="location-selection" id="western-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="western-select">
                                        <h3>Western Region</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="location-selection" id="eastern-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="eastern-select">
                                        <h3>Eastern Region</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="location-selection" id="volta-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="volta-select">
                                        <h3>Volta Region</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            <button class="eht-btn easygo-btn-4 border-blue text-blue w-100" data-transit-target="duration-selection-page" data-transit-parent="location-selection-page" style="max-width: 300px;">Next</button>
                        </div>
                    </div>
                </section>
                <!-- Itinerary destinations [end] -->
                <!--- ================================ -->


                <!--- ================================ -->
                <!-- Duration [start] -->
                <section id="duration-selection-page" class="eh-transition-page">
                    <div class="mb-4 d-flex justify-content-between">
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="location-selection-page" data-transit-parent="duration-selection-page"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="type-selection-page" data-transit-parent="duration-selection-page">Next <i class="fa-solid fa-arrow-right"></i> </button>
                    </div>
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">How long do you want to spend on the trip?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="duration-selection" id="single-day-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="single-day-select">
                                        <h3>Just A day</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="duration-selection" id="2-to-3-days-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="2-to-3-days-select">
                                        <h3>Two or Three Days</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="duration-selection" id="week-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="week-select">
                                        <h3>About A Week</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            <button class="eht-btn easygo-btn-4 border-blue text-blue w-100" data-transit-target="type-selection-page" data-transit-parent="duration-selection-page" style="max-width: 300px;">Next</button>
                        </div>
                    </div>
                </section>
                <!-- Duration [end] -->
                <!--- ================================ -->


                <!--- ================================ -->
                <!-- Itinerary type [start] -->
                <section id="type-selection-page" class="eh-transition-page">
                    <div class="mb-4 d-flex justify-content-between">
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="duration-selection-page" data-transit-parent="type-selection-page"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="vibe-selection-page" data-transit-parent="type-selection-page">Next <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">Who's travelling with you?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="type-selection" id="solo-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="solo-select">
                                        <h3>Going Solo</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="type-selection" id="couple-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="couple-select">
                                        <h3>Partner</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="type-selection" id="family-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="family-select">
                                        <h3>Family</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" class="radio_choice"  name="type-selection" id="friends-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="friends-select">
                                        <h3>Friends</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            <button class="eht-btn easygo-btn-4 border-blue text-blue w-100" data-transit-target="vibe-selection-page" data-transit-parent="type-selection-page" style="max-width: 300px;">Next</button>
                        </div>
                    </div>
                </section>
                <!-- Itinerary type[end] -->
                <!--- ================================ -->



                <!--- ================================ -->
                <!-- Itinerary theme [start] -->
                <section id="vibe-selection-page" class="eh-transition-page">
                    <div class="mb-4 d-flex justify-content-between">
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="type-selection-page" data-transit-parent="vibe-selection-page"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="budget-selection-page" data-transit-parent="vibe-selection-page">Next <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">Select the vibe for the trip?</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 p-3">
                                <div class="easygo-checkbox-btn-1">
                                    <input type="checkbox" name="vibe-selection" id="relaxation-select" value="Spa & Wellness">
                                    <label class="easygo-icon-btn" for="relaxation-select">
                                        <svg width="134" height="100" viewBox="0 0 134 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.9353 12.3541L25.2251 23.9918L36.8627 29.2816L25.2251 34.5714L19.9353 46.209L14.6454 34.5714L3.00781 29.2816L14.6454 23.9918L19.9353 12.3541ZM19.9353 22.5741L17.8193 27.1657L13.2278 29.2816L17.8193 31.3975L19.9353 35.9891L22.0512 31.3975L26.6428 29.2816L22.0512 27.1657L19.9353 22.5741ZM41.0946 22.9338L38.4285 17.1361L32.6309 14.4701L38.4285 11.8252L41.0946 6.00635L43.7395 11.8252L49.5583 14.4701L43.7395 17.1361L41.0946 22.9338ZM41.0946 52.5568L38.4285 46.7592L32.6309 44.0931L38.4285 41.4482L41.0946 35.6294L43.7395 41.4482L49.5583 44.0931L43.7395 46.7592L41.0946 52.5568Z" fill="black" />
                                            <path d="M50.6667 91.6665L67.3333 83.3332V70.8332H117.333M79.8333 83.3332H117.333M67.3333 58.3332L79.8333 49.9998L84 33.3332C96.5 37.4998 96.5 49.9998 96.5 58.3332M46.5 70.8332C46.5 71.9382 46.939 72.998 47.7204 73.7794C48.5018 74.5609 49.5616 74.9998 50.6667 74.9998C51.7717 74.9998 52.8315 74.5609 53.6129 73.7794C54.3943 72.998 54.8333 71.9382 54.8333 70.8332C54.8333 69.7281 54.3943 68.6683 53.6129 67.8869C52.8315 67.1055 51.7717 66.6665 50.6667 66.6665C49.5616 66.6665 48.5018 67.1055 47.7204 67.8869C46.939 68.6683 46.5 69.7281 46.5 70.8332ZM67.3333 20.8332C67.3333 21.9382 67.7723 22.998 68.5537 23.7794C69.3351 24.5608 70.3949 24.9998 71.5 24.9998C72.6051 24.9998 73.6649 24.5608 74.4463 23.7794C75.2277 22.998 75.6667 21.9382 75.6667 20.8332C75.6667 19.7281 75.2277 18.6683 74.4463 17.8869C73.6649 17.1055 72.6051 16.6665 71.5 16.6665C70.3949 16.6665 69.3351 17.1055 68.5537 17.8869C67.7723 18.6683 67.3333 19.7281 67.3333 20.8332Z" stroke="#1204B5" stroke-width="8.33333" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <h3>Spa & Wellness</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-3">
                                <div class="easygo-checkbox-btn-1">
                                    <input type="checkbox" name="vibe-selection" id="adventure-select" value="adventure">
                                    <label class="easygo-icon-btn" for="adventure-select">
                                        <svg width="141" height="100" viewBox="0 0 141 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.9353 14.3541L25.2251 25.9918L36.8627 31.2816L25.2251 36.5714L19.9353 48.209L14.6454 36.5714L3.00781 31.2816L14.6454 25.9918L19.9353 14.3541ZM19.9353 24.5741L17.8193 29.1657L13.2278 31.2816L17.8193 33.3975L19.9353 37.9891L22.0512 33.3975L26.6428 31.2816L22.0512 29.1657L19.9353 24.5741ZM41.0946 24.9338L38.4285 19.1361L32.6309 16.4701L38.4285 13.8252L41.0946 8.00635L43.7395 13.8252L49.5583 16.4701L43.7395 19.1361L41.0946 24.9338ZM41.0946 54.5568L38.4285 48.7592L32.6309 46.0931L38.4285 43.4482L41.0946 37.6294L43.7395 43.4482L49.5583 46.0931L43.7395 48.7592L41.0946 54.5568Z" fill="black" />
                                            <path d="M59.7502 45.8333C57.9446 45.8333 56.4516 45.2431 55.271 44.0625C54.0904 42.8819 53.5002 41.3889 53.5002 39.5833C53.5002 37.7778 54.0904 36.2847 55.271 35.1042C56.4516 33.9236 57.9446 33.3333 59.7502 33.3333C61.5557 33.3333 63.0488 33.9236 64.2293 35.1042C65.4099 36.2847 66.0002 37.7778 66.0002 39.5833C66.0002 41.3889 65.4099 42.8819 64.2293 44.0625C63.0488 45.2431 61.5557 45.8333 59.7502 45.8333ZM53.5002 91.6667V70.8333H49.3335V54.1667C49.3335 52.9861 49.7335 51.9958 50.5335 51.1958C51.3335 50.3958 52.3224 49.9972 53.5002 50H66.0002C67.1807 50 68.171 50.4 68.971 51.2C69.771 52 70.1696 52.9889 70.1668 54.1667V70.8333H66.0002V83.3333H99.3335V62.5H92.0418C87.1113 62.5 82.9266 60.7806 79.4877 57.3417C76.0488 53.9028 74.3307 49.7194 74.3335 44.7917C74.3335 41.1111 75.3238 37.8292 77.3043 34.9458C79.2849 32.0625 81.8363 29.9278 84.9585 28.5417C85.7224 24.0278 87.8238 20.2264 91.2627 17.1375C94.7015 14.0486 98.7807 12.5028 103.5 12.5C108.222 12.5 112.303 14.0458 115.742 17.1375C119.181 20.2292 121.281 24.0306 122.042 28.5417C125.167 29.9306 127.72 32.0667 129.7 34.95C131.681 37.8333 132.67 41.1139 132.667 44.7917C132.667 49.7222 130.947 53.9069 127.508 57.3458C124.07 60.7847 119.886 62.5028 114.958 62.5H107.667V83.3333H128.5V91.6667H53.5002Z" fill="#1204B5" />
                                        </svg>
                                        <h3>Adventure & Sports</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-3">
                                <div class="easygo-checkbox-btn-1">
                                    <input type="checkbox" name="vibe-selection" id="landmarks-select" value="Landmarks">
                                    <label class="easygo-icon-btn" for="landmarks-select">
                                        <svg width="136" height="81" viewBox="0 0 136 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.9353 9.35414L25.2251 20.9918L36.8627 26.2816L25.2251 31.5714L19.9353 43.209L14.6454 31.5714L3.00781 26.2816L14.6454 20.9918L19.9353 9.35414ZM19.9353 19.5741L17.8193 24.1657L13.2278 26.2816L17.8193 28.3975L19.9353 32.9891L22.0512 28.3975L26.6428 26.2816L22.0512 24.1657L19.9353 19.5741ZM41.0946 19.9338L38.4285 14.1361L32.6309 11.4701L38.4285 8.82516L41.0946 3.00635L43.7395 8.82516L49.5583 11.4701L43.7395 14.1361L41.0946 19.9338ZM41.0946 49.5568L38.4285 43.7592L32.6309 41.0931L38.4285 38.4482L41.0946 32.6294L43.7395 38.4482L49.5583 41.0931L43.7395 43.7592L41.0946 49.5568Z" fill="black" />
                                            <path d="M135 19H105C105 19 103 35 107 51C108.608 53.68 112.58 55.124 117 55.49V75H116.334L109 81H131L123.832 75H123V55.344C127.24 54.794 131.126 53.316 133 51C137 37 135 19 135 19ZM133 31H107V21H133V31ZM84 75H73V58L95 25H43L65 58V75H54C53.2044 75 52.4413 75.3161 51.8787 75.8787C51.3161 76.4413 51 77.2043 51 78C51 78.7957 51.3161 79.5587 51.8787 80.1213C52.4413 80.6839 53.2044 81 54 81H84C84.7957 81 85.5587 80.6839 86.1213 80.1213C86.6839 79.5587 87 78.7957 87 78C87 77.2043 86.6839 76.4413 86.1213 75.8787C85.5587 75.3161 84.7957 75 84 75Z" fill="#1204B5" />
                                        </svg>
                                        <h3>Landmarks & Siteseeing</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-3">
                                <div class="easygo-checkbox-btn-1">
                                    <input type="checkbox" name="vibe-selection" id="culture-select" value="Culture & History">
                                    <label class="easygo-icon-btn" for="culture-select">
                                        <svg width="147" height="100" viewBox="0 0 147 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.9353 13.3541L25.2251 24.9918L36.8627 30.2816L25.2251 35.5714L19.9353 47.209L14.6454 35.5714L3.00781 30.2816L14.6454 24.9918L19.9353 13.3541ZM19.9353 23.5741L17.8193 28.1657L13.2278 30.2816L17.8193 32.3975L19.9353 36.9891L22.0512 32.3975L26.6428 30.2816L22.0512 28.1657L19.9353 23.5741ZM41.0946 23.9338L38.4285 18.1361L32.6309 15.4701L38.4285 12.8252L41.0946 7.00635L43.7395 12.8252L49.5583 15.4701L43.7395 18.1361L41.0946 23.9338ZM41.0946 53.5568L38.4285 47.7592L32.6309 45.0931L38.4285 42.4482L41.0946 36.6294L43.7395 42.4482L49.5583 45.0931L43.7395 47.7592L41.0946 53.5568Z" fill="black" />
                                            <g clip-path="url(#clip0_1401_6519)">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M80.6498 30.25L81.0456 30.5958L116.404 65.95C116.867 66.4129 117.215 66.9786 117.419 67.6012C117.623 68.2237 117.677 68.8855 117.577 69.5329C117.477 70.1803 117.226 70.795 116.844 71.3272C116.462 71.8594 115.96 72.294 115.379 72.5958L114.896 72.8041L71.6248 88.75C63.4914 91.75 55.5706 84.1041 58.0414 75.9833L58.2498 75.375L74.1914 32.1C74.4026 31.5271 74.7371 31.0077 75.1713 30.5785C75.6054 30.1492 76.1286 29.8206 76.7038 29.6159C77.279 29.4112 77.8921 29.3353 78.4998 29.3938C79.1075 29.4523 79.695 29.6436 80.2206 29.9542L80.6498 30.2458V30.25ZM79.7581 41.0917L66.0706 78.2583C65.9434 78.6041 65.9101 78.9775 65.9742 79.3403C66.0383 79.7031 66.1975 80.0425 66.4356 80.3238C66.6736 80.605 66.982 80.8181 67.3292 80.9413C67.6765 81.0645 68.0502 81.0933 68.4123 81.025L68.7456 80.9292L105.904 67.2375L79.7581 41.0917ZM118.279 48.35C122.075 48.55 127.279 49.35 131.804 52.0667C132.721 52.6105 133.395 53.4854 133.687 54.5112C133.979 55.5369 133.866 56.6355 133.372 57.5806C132.878 58.5258 132.04 59.2456 131.032 59.5918C130.023 59.938 128.92 59.8843 127.95 59.4416L127.516 59.2125C124.675 57.5042 121.041 56.8375 117.841 56.6708C116.523 56.5945 115.201 56.6001 113.883 56.6875L112.566 56.8166C111.48 56.9569 110.381 56.6633 109.509 55.9994C108.637 55.3355 108.062 54.3548 107.908 53.2697C107.754 52.1846 108.034 51.0826 108.686 50.2023C109.339 49.322 110.313 48.7343 111.396 48.5667C113.678 48.2719 115.983 48.1979 118.279 48.3458V48.35ZM126.716 36.7416C127.778 36.7439 128.799 37.1513 129.57 37.8806C130.342 38.61 130.806 39.6063 130.867 40.6662C130.929 41.7261 130.584 42.7695 129.902 43.5834C129.221 44.3974 128.254 44.9204 127.2 45.0458L126.716 45.075H123.766C122.705 45.0728 121.684 44.6654 120.913 43.936C120.141 43.2066 119.677 42.2103 119.616 41.1504C119.554 40.0906 119.899 39.0471 120.581 38.2332C121.262 37.4193 122.229 36.8962 123.283 36.7708L123.766 36.7416H126.716ZM113.458 33.5417C114.176 34.2591 114.606 35.2137 114.67 36.2263C114.734 37.2389 114.426 38.24 113.804 39.0416L113.458 39.4333L109.041 43.8541C108.293 44.6094 107.285 45.0501 106.222 45.0862C105.16 45.1222 104.124 44.7508 103.327 44.048C102.529 43.3453 102.03 42.3642 101.932 41.3057C101.834 40.2472 102.145 39.1913 102.8 38.3541L103.146 37.9625L107.562 33.5458C107.949 33.1584 108.409 32.8511 108.915 32.6414C109.42 32.4317 109.963 32.3238 110.51 32.3238C111.058 32.3238 111.6 32.4317 112.106 32.6414C112.612 32.8511 113.071 33.1542 113.458 33.5417ZM102.679 11.6C104.546 17.2083 103.546 23.35 102.379 27.6416C101.678 30.3173 100.715 32.9173 99.5039 35.4041C99.0105 36.3932 98.1444 37.1457 97.0962 37.4962C96.0479 37.8466 94.9034 37.7663 93.9144 37.2729C92.9253 36.7795 92.1728 35.9134 91.8223 34.8651C91.4719 33.8169 91.5522 32.6724 92.0456 31.6833C93.0118 29.6856 93.7794 27.5978 94.3373 25.45C95.2831 21.9833 95.7581 18.2208 95.0289 15.1375L94.7748 14.2375C94.5932 13.7164 94.5169 13.1644 94.5504 12.6136C94.5839 12.0628 94.7264 11.5242 94.9698 11.0289C95.2131 10.5336 95.5524 10.0916 95.968 9.72858C96.3835 9.36551 96.8671 9.08861 97.3905 8.91394C97.914 8.73928 98.4669 8.67033 99.0172 8.71109C99.5675 8.75186 100.104 8.90153 100.596 9.15142C101.088 9.40131 101.526 9.74644 101.883 10.1668C102.241 10.5871 102.511 11.0743 102.679 11.6ZM125.241 21.7583C126.023 22.5397 126.461 23.5993 126.461 24.7042C126.461 25.809 126.023 26.8686 125.241 27.65L122.296 30.5958C121.911 30.9938 121.451 31.3112 120.943 31.5296C120.435 31.7479 119.888 31.8629 119.335 31.8677C118.782 31.8725 118.233 31.7671 117.721 31.5576C117.209 31.3481 116.744 31.0387 116.352 30.6475C115.961 30.2562 115.652 29.791 115.442 29.279C115.233 28.7669 115.127 28.2182 115.132 27.665C115.137 27.1117 115.252 26.565 115.47 26.0566C115.689 25.5483 116.006 25.0885 116.404 24.7042L119.35 21.7583C120.131 20.9772 121.191 20.5384 122.296 20.5384C123.4 20.5384 124.46 20.9772 125.241 21.7583Z" fill="#1204B5" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1401_6519">
                                                    <rect width="100" height="100" fill="white" transform="translate(47)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <h3>Culture & History</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-3">
                                <div class="easygo-checkbox-btn-1">
                                    <input type="checkbox" name="vibe-selection" id="waterfalls-select" value="Waterfalls">
                                    <label class="easygo-icon-btn" for="waterfalls-select">
                                        <svg width="136" height="100" viewBox="0 0 136 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.9353 12.3541L25.2251 23.9918L36.8627 29.2816L25.2251 34.5714L19.9353 46.209L14.6454 34.5714L3.00781 29.2816L14.6454 23.9918L19.9353 12.3541ZM19.9353 22.5741L17.8193 27.1657L13.2278 29.2816L17.8193 31.3975L19.9353 35.9891L22.0512 31.3975L26.6428 29.2816L22.0512 27.1657L19.9353 22.5741ZM41.0946 22.9338L38.4285 17.1361L32.6309 14.4701L38.4285 11.8252L41.0946 6.00635L43.7395 11.8252L49.5583 14.4701L43.7395 17.1361L41.0946 22.9338ZM41.0946 52.5568L38.4285 46.7592L32.6309 44.0931L38.4285 41.4482L41.0946 35.6294L43.7395 41.4482L49.5583 44.0931L43.7395 46.7592L41.0946 52.5568Z" fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M82.4302 7.5C86.4852 7.5 89.7672 10.879 89.7672 14.934C89.7672 18.988 86.4852 22.367 82.4302 22.367C78.3752 22.367 74.9962 18.988 74.9962 14.934C74.9962 10.879 78.3762 7.5 82.4302 7.5ZM82.9132 23.043C85.7032 22.956 87.8602 24.692 88.9952 26.519L96.7182 39.359L110.234 45.055C114.095 46.695 112.261 51.812 107.917 50.654C107.762 50.5484 107.6 50.4515 107.434 50.364L98.3592 70.444C98.3592 70.444 101.255 77.106 104.924 84.637C108.496 92.263 99.8072 95.546 96.6212 88.498L93.4362 81.354L88.8022 91.491L86.8712 90.622L92.2772 78.844L83.2022 59.054C82.8162 59.15 82.4302 59.054 81.9472 59.054C81.9472 59.054 71.4242 82.995 68.5272 89.271C65.7282 95.546 57.4262 91.781 60.2252 85.601C63.0252 79.423 76.3482 49.399 76.3482 49.399L66.4452 49.561C64.9452 49.574 64.5862 49.335 64.4912 48.211C64.3382 45.241 64.0762 38.253 64.7632 35.014C65.6492 30.839 66.1782 26.244 69.1072 24.877C72.0372 23.51 77.1202 27.291 77.1202 27.291C77.8922 24.781 80.3062 23.043 82.9132 23.043ZM88.8982 38.103V49.69L97.2012 67.84L105.503 49.593L93.4362 44.573C92.8562 44.283 92.3742 43.897 91.9872 43.318L88.8982 38.103Z" fill="#1204B5" />
                                        </svg>
                                        <h3>Waterfalls</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 p-3">
                                <div class="easygo-checkbox-btn-1">
                                    <input type="checkbox" name="vibe-selection" id="alternative-select" value="alternative experiences">
                                    <label class="easygo-icon-btn" for="alternative-select">
                                        <svg width="136" height="100" viewBox="0 0 136 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.9353 12.3541L25.2251 23.9918L36.8627 29.2816L25.2251 34.5714L19.9353 46.209L14.6454 34.5714L3.00781 29.2816L14.6454 23.9918L19.9353 12.3541ZM19.9353 22.5741L17.8193 27.1657L13.2278 29.2816L17.8193 31.3975L19.9353 35.9891L22.0512 31.3975L26.6428 29.2816L22.0512 27.1657L19.9353 22.5741ZM41.0946 22.9338L38.4285 17.1361L32.6309 14.4701L38.4285 11.8252L41.0946 6.00635L43.7395 11.8252L49.5583 14.4701L43.7395 17.1361L41.0946 22.9338ZM41.0946 52.5568L38.4285 46.7592L32.6309 44.0931L38.4285 41.4482L41.0946 35.6294L43.7395 41.4482L49.5583 44.0931L43.7395 46.7592L41.0946 52.5568Z" fill="black" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M82.4302 7.5C86.4852 7.5 89.7672 10.879 89.7672 14.934C89.7672 18.988 86.4852 22.367 82.4302 22.367C78.3752 22.367 74.9962 18.988 74.9962 14.934C74.9962 10.879 78.3762 7.5 82.4302 7.5ZM82.9132 23.043C85.7032 22.956 87.8602 24.692 88.9952 26.519L96.7182 39.359L110.234 45.055C114.095 46.695 112.261 51.812 107.917 50.654C107.762 50.5484 107.6 50.4515 107.434 50.364L98.3592 70.444C98.3592 70.444 101.255 77.106 104.924 84.637C108.496 92.263 99.8072 95.546 96.6212 88.498L93.4362 81.354L88.8022 91.491L86.8712 90.622L92.2772 78.844L83.2022 59.054C82.8162 59.15 82.4302 59.054 81.9472 59.054C81.9472 59.054 71.4242 82.995 68.5272 89.271C65.7282 95.546 57.4262 91.781 60.2252 85.601C63.0252 79.423 76.3482 49.399 76.3482 49.399L66.4452 49.561C64.9452 49.574 64.5862 49.335 64.4912 48.211C64.3382 45.241 64.0762 38.253 64.7632 35.014C65.6492 30.839 66.1782 26.244 69.1072 24.877C72.0372 23.51 77.1202 27.291 77.1202 27.291C77.8922 24.781 80.3062 23.043 82.9132 23.043ZM88.8982 38.103V49.69L97.2012 67.84L105.503 49.593L93.4362 44.573C92.8562 44.283 92.3742 43.897 91.9872 43.318L88.8982 38.103Z" fill="#1204B5" />
                                        </svg>
                                        <h3>Alternative Experiences</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            <button class="eht-btn easygo-btn-4 border-blue text-blue w-100" data-transit-target="budget-selection-page" data-transit-parent="vibe-selection-page" style="max-width: 300px;">Next</button>
                        </div>
                    </div>
                </section>
                <!-- Itinerary theme [end] -->
                <!--- ================================ -->

                <!--- ================================ -->
                <!-- Budget [start] -->
                <section id="budget-selection-page" class="eh-transition-page">
                    <div class="mb-5 d-flex justify-content-between">
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="vibe-selection-page" data-transit-parent="budget-selection-page"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="budget-selection-page" data-transit-parent="budget-selection-page"> Complete <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-3">What&apos;s your budget ?</h4>
                        </div>

                        <div class="justify-content-center">
                            <div class="col-lg-9">
                                <input type="range" class="form-range" min="500" max="5000" step="250" id="customRange3">
                            </div>
                            <h4 class="my-3">GHS 500</h4>
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            <button class="eht-btn easygo-btn-4 border-blue text-blue w-100" data-transit-target="budget-selection-page" data-transit-parent="budget-selection-page" style="max-width: 300px;">Generate</button>
                        </div>
                    </div>
                </section>
                <!-- Budget [end] -->
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
    <script src="../assets/js/coplanner_setup.js"></script>
</body>

</html>