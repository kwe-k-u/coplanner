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
    <title>Coplanner - Setup</title>
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
            <div id="setup-pages" class="eh-transition-box h-100">
                <section id="tool-selection-page" class="active eh-transition-page">
                    <div class="mb-5">
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="tool-selection-page" data-transit-parent="tool-selection-page"><i class="fa-solid fa-arrow-left"></i> Back</button>
                    </div>
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-3">Choose your curation platform</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" name="tool-select" id="ai-select">
                                    <label class="easygo-icon-btn" for="ai-select">
                                        <svg width="221" height="170" viewBox="0 0 221 170" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M136 9.91666C126.092 9.90347 116.513 13.4715 109.028 19.9632C101.543 26.455 96.6557 35.4332 95.2674 45.2436C93.8791 55.054 96.0831 65.0356 101.473 73.3493C106.863 81.6631 115.076 87.7488 124.599 90.4853C111.067 92.1287 99.4615 96.9113 90.7122 105.536C79.5829 116.495 73.9502 132.827 73.9502 154.133C73.9502 155.561 74.5174 156.93 75.5269 157.94C76.5365 158.949 77.9058 159.517 79.3335 159.517C80.7613 159.517 82.1305 158.949 83.1401 157.94C84.1497 156.93 84.7169 155.561 84.7169 154.133C84.7169 134.64 89.8509 121.493 98.2715 113.197C106.704 104.89 119.306 100.583 136 100.583C152.694 100.583 165.297 104.89 173.74 113.197C182.15 121.505 187.284 134.64 187.284 154.133C187.284 155.561 187.851 156.93 188.86 157.94C189.87 158.949 191.239 159.517 192.667 159.517C194.095 159.517 195.464 158.949 196.473 157.94C197.483 156.93 198.05 155.561 198.05 154.133C198.05 132.827 192.418 116.507 181.277 105.536C172.55 96.9227 160.934 92.1287 147.402 90.4853C156.892 87.7181 165.068 81.623 170.43 73.3173C175.792 65.0115 177.981 55.0516 176.596 45.263C175.211 35.4744 170.344 26.5128 162.888 20.021C155.432 13.5291 145.886 9.94186 136 9.91666ZM105.684 51C105.684 42.9595 108.878 35.2484 114.563 29.5629C120.249 23.8774 127.96 20.6833 136 20.6833C144.041 20.6833 151.752 23.8774 157.437 29.5629C163.123 35.2484 166.317 42.9595 166.317 51C166.317 59.0405 163.123 66.7516 157.437 72.4371C151.752 78.1226 144.041 81.3167 136 81.3167C127.96 81.3167 120.249 78.1226 114.563 72.4371C108.878 66.7516 105.684 59.0405 105.684 51Z" fill="#1204B5" />
                                            <path d="M33.5526 19.386L42.8728 39.8903L63.3771 49.2105L42.8728 58.5307L33.5526 79.0351L24.2324 58.5307L3.72803 49.2105L24.2324 39.8903L33.5526 19.386ZM33.5526 37.3925L29.8245 45.4825L21.7346 49.2105L29.8245 52.9386L33.5526 61.0285L37.2807 52.9386L45.3706 49.2105L37.2807 45.4825L33.5526 37.3925ZM70.8333 38.0263L66.1359 27.8114L55.921 23.114L66.1359 18.4539L70.8333 8.20175L75.4934 18.4539L85.7456 23.114L75.4934 27.8114L70.8333 38.0263ZM70.8333 90.2193L66.1359 80.0044L55.921 75.307L66.1359 70.6469L70.8333 60.3947L75.4934 70.6469L85.7456 75.307L75.4934 80.0044L70.8333 90.2193Z" fill="black" />
                                        </svg>
                                        <h3>Build with Coplanner</h3>
                                    </label>
                                </div>
                                <h4 class="text-center pt-4">Build with assistance from out AI</h4>
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" name="tool-select" id="#scratch-select">
                                    <label class="easygo-icon-btn" for="#scratch-select">
                                        <svg width="160" height="160" viewBox="0 0 160 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M26.6665 142.667V17.3333C26.6665 16.2725 27.0879 15.2551 27.8381 14.5049C28.5882 13.7548 29.6056 13.3333 30.6665 13.3333H108.347C109.407 13.3343 110.424 13.7563 111.173 14.5067L132.16 35.4933C132.533 35.866 132.829 36.3088 133.03 36.7962C133.231 37.2836 133.334 37.806 133.333 38.3333V142.667C133.333 143.192 133.23 143.712 133.029 144.197C132.828 144.683 132.533 145.124 132.162 145.495C131.79 145.867 131.349 146.161 130.864 146.362C130.379 146.563 129.858 146.667 129.333 146.667H30.6665C30.1412 146.667 29.6211 146.563 29.1358 146.362C28.6505 146.161 28.2095 145.867 27.8381 145.495C27.4666 145.124 27.172 144.683 26.971 144.197C26.77 143.712 26.6665 143.192 26.6665 142.667Z" stroke="#1204B5" stroke-width="6.25" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M106.667 13.3333V36C106.667 37.0609 107.088 38.0783 107.838 38.8284C108.588 39.5786 109.606 40 110.667 40H133.333" stroke="#1204B5" stroke-width="6.25" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <h3>Design from scratch</h3>
                                    </label>
                                </div>
                                <h4 class="text-center pt-4">Use only our destination tools</h4>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            <button class="eht-btn easygo-btn-4 border-blue text-blue w-100" data-transit-target="tour-type-selection-page" data-transit-parent="tool-selection-page" style="max-width: 300px;">Next</button>
                        </div>
                    </div>
                </section>
                <section id="tour-type-selection-page" class="eh-transition-page">
                    <div class="mb-4">
                        <button class="eht-btn text-blue easygo-fs-2 border-0 bg-transparent" data-transit-target="tool-selection-page" data-transit-parent="tour-type-selection-page"><i class="fa-solid fa-arrow-left"></i> Back</button>
                    </div>
                    <div>
                        <div class="mt-auto">
                            <h4 class="text-center fw-bold mb-5">What type of tour do you want</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" name="tour-type-selection" id="solo-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="solo-select">
                                        <h3>Solo</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" name="tour-type-selection" id="couple-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="couple-select">
                                        <h3>Couple</h3>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 p-3">
                                <div class="easygo-radio-btn-1">
                                    <input type="radio" name="tour-type-selection" id="group-select">
                                    <label class="easygo-icon-btn py-5 text-blue" for="group-select">
                                        <h3>Group</h3>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            <button class="eht-btn easygo-btn-4 border-blue text-blue w-100" data-transit-target="tour-type-selection-page" data-transit-parent="tool-selection-page" style="max-width: 300px;">Next</button>
                        </div>
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
    <!-- <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/functions.js"></script> -->
    <script>
        class EhPageTransition {
            constructor(container_id) {
                this.container = document.getElementById(container_id);
                this.pages = this.container.querySelectorAll(".eh-transition-page")

                this.#init();
            }

            #init() {
                this.pages.forEach(page => {
                    page.querySelectorAll(".eht-btn").forEach(btn => {
                        btn.addEventListener("click", event => {
                            let parent = event.target.getAttribute("data-transit-parent");
                            parent = document.getElementById(parent);
                            parent.classList.remove("active");
                            let target = event.target.getAttribute("data-transit-target");
                            target = document.getElementById(target)
                            target.classList.add("active");
                        })
                    })
                })
            }
        }

        transitioner = new EhPageTransition("setup-pages")
    </script>
</body>

</html>