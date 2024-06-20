<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../utils/env_manager.php");
// require_once(__DIR__ . "/../controllers/interaction_controller.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="easyGo connects you to tour experiences created by Ghanaian curators. Find the best things to do and book tours by locals">
    <meta name="keywords" content="things to do Ghana, Accra, tourism, tours, December in Ghana, experience Ghana">
    <meta name="author" content="easyGo Tours Ltd">
    <title>easyGo - Things to do in Ghana</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <!-- <link rel="stylesheet" href="../assets/css/header.css"> -->
</head>

<body >

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once(__DIR__."/../coplanner/coplanner_navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main >
            <!--- ================================ -->
            <!--- introduction section [start] -->

            <section class=" carousel-section">
                <div class="image-section">
                    <div class="carousel-img d-block d-lg-none " id="image-slide-mobile" data-imgs="assets/images/carousel/IMG_2115.webp,assets/images/carousel/IMG_2611.webp,assets/images/carousel/IMG_2647.webp"></div>
                    <div class="carousel-img d-none d-md-block" id="image-slide-desktop" data-imgs="assets/images/carousel/7I3A9298.jpg,assets/images/carousel/7I3A9268.jpg,assets/images/carousel/IMG_7661.jpg,assets/images/carousel/IMG_7643.jpg"></div>
                </div>
                <div class="tint"></div>
                <div class="carousel-body">
                    <h1 class="easygo-fw-1">
                        Don't hassle to find things to do in Ghana
                    </h1>
                    <p>
                        Find tour curators from all over Ghana sharing their unique experiences for
                        every budget, vacation plan and group size.
                         </p>
                    <!-- <form action="#experience_section"> -->
                        <div class="carousel-search row align-items-center">
                            <div class="form-input-field col-lg-9">
                                <input type="text" class="border-blue"  placeholder="Find an Experience" data-eg-target="email-err">
                                <p id="email-err" class="form-err-msg"></p>
                            </div>
                            <div class="col-lg-3">
                                <a  class="search-btn easygo-btn-1 bg-blue text-white easygo-fs-5" href="#experience_section">Search</a>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>

            </section>

            <!--- introduction section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- get started section [start] -->

            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div>
            <!--- get started [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Featured tours section [start] -->
            <section class="suggested-locations my-5" id="#experience_section">
                <div class="container">
                    <div>
                        <h2>Shared Experiences</h2>

                    </div>
                    <div class="row">
                        <?php
                        $tours = get_shared_experiences();

                        if (!empty($tours)) {
                            foreach ($tours as $entry) {
                                $title = $entry["experience_name"];
                                $curator_id = $entry["curator_id"];
                                $id = $entry["experience_id"];
                                $curator_name = $entry["curator_name"];
                                $currency = $entry["currency_name"];
                                $fee = $entry["booking_fee"];
                                $base_url = server_base_url();

                                // $next = get_campaign_tours($id)[0];
                                // $tour_id = $next["tour_id"];
                                // $currency = $next["currency"];
                                // $fee = $next["fee"];
                                $image = $entry["media_location"]?? (server_base_url()."uploads/images/gokart.jpg");

                                echo "

                        <div class='col-lg-4 col-md-6 p-3'>
                        <div class='trip-card' data-trip-extension='experience_id=$id'>
                            <img src='$image' alt='trip card image'>
                            <div class='trip-card-body'>
                                <div class='trip-card-header'>
                                    <div class='title'>
                                        <h5 class='easygo-fw-1'>$title</h5>
                                        <!-- <p class='text-gray-1 easygo-fs-5'>Accra, Ghana</p> -->
                                        <div class='text-gray-1 location easygo-fs-4'>
                                            Curated by <span class='easygo-fw-1 text-black'>$curator_name</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='trip-card-footer'>
                                <div class='col pt-1'>
                                    <p class='mb-0 easygo-fs-5 text-grayl-1'>Price per person</p>
                                    <h5>$currency$fee</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                                    ";
                            }
                        }
                        ?>
                    </div>
                    <!-- <div class='d-flex justify-content-end'>
                        <a class='text-black d-none d-md-block' href='./tours.php'>View all tours <img src='../assets/images/svgs/arrow_45deg_black.svg' alt='45 degree arrow' style='width: 0.7rem;'></a>
                        <a href='./tours.php' class='easygo-btn-1 d-block d-md-none w-100 text-center'>Go to tours &nbsp; <img src='../assets/images/svgs/arrow_45deg_white.svg' alt='45 degree arrow' style='width: 0.7rem;'></a>
                    </div> -->
                </div>
            </section>
            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div>
            <!--- Featured tours section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- about us section [start] -->
            <section class="get-started my-5">
                <div class="container">
                    <div class="row flex-column-reverse flex-lg-row">
                        <div class="col-lg-6 p-3">
                            <div class="px-lg-5">
                                <div class="stacked-imgs">
                                    <img class="lazy-loader" data-src="../assets/images/site_images/home_1.webp" alt="scenery">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center p-3">
                            <div class="container d-flex flex-column gap-2">
                                <h1>Find the Best Tour For You And Your friends</h1>
                                <p>
                                Whether you are looking for an adrenaline-pumping excursion, an cularual immersion or a relaxing getaway,
                                 there is certainly a tour for you. Benefit from the experience of curators on our website to enjoy trips designed
                                 to provide unforgettable experiences at unique destinations and with world-class guides.
                                </p>
                                <!-- <button class="easygo-btn-1 align-self-start px-5 easygo-fs-4" onclick="goto_page('views/tours.php')" style="border-radius: 50px; word-spacing: 5px;">
                                    Get Started
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div>
            <!--- about us section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- view trips section [start] -->
            <section class="view-trips bg-blue text-white" style="margin: 10rem 0rem;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="container-fluid position-relative h-100">
                                <img style="height: 120%; position: absolute; bottom: 0; left: 0;" class="img-fluid d-none d-lg-block lazy-loader" data-src="../assets/images/site_images/home_3.webp" alt="background image">
                                <div class="d-block d-lg-none pt-5">
                                    <img class="img-fluid lazy-loader" data-src="../assets/images/site_images/home_3.webp" alt="background image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 py-5">
                            <div class="container-fluid">
                                <h3>Just between friends</h3>
                                <p>
                                    Some moments are best shared only with friends. Receive a travel plan that meets your
                                    preferences for your next trip with friends. With our travel plans, you have control over
                                    who gets invited to the trip because sometimes, you want to be with just friends
                                </p>

                                <?php
                                    $base_url = server_base_url();
                                    echo "<button type='button' onclick='return goto_page(\"https://wa.me/233506899883\",false)' class='easygo-btn-2 easygo-fs-4 easygo-fw-2 px-5' style='border-radius: 50px; color:black; word-spacing: 5px;'> Contact Our Team</button>";
                                ?>



                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--- view trips section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- news-blog section [start] -->
            <!-- <section class="news-blog my-5">
                <div class="container">
                    <h3 class="text-center easygo-fs-1">Our News Blog</h3>
                    <p class="text-center">Get up to date news about new, recurring trips and also the latest updates about trip locations</p>
                    <div class="grid-1 d-flex flex-column d-lg-grid" style="min-height: 80vh;">
                        <div class="grid-item">
                            <div class="d-flex flex-column">
                                <img class="img-fluid" src="../assets/images/others/background.webp" alt="scenery">
                                <div>
                                    <h6 class="border-3 border-bottom py-3 easygo-fs-1">Breath-taking view of the kwame Nkrumah park in Ghana</h6>
                                    <p class="easygo-fs-2">
                                        Dummy Text. We use top trip curator services to create new adventure for you and your loved ones. We use top trip curator services to create new adventure for you and your loved ones. Dummy Text. We use top trip curator services to create new adventure for you and your loved ones. We use top trip curator services to create new adventure for you and your loved ones. Dummy Text. We use top trip curator services to create new adventure for you and your loved ones.
                                    </p>
                                    <p>
                                        <a href="javascript:void(0);" class="text-orange">Read more</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex grid-item gap-1 flex-column flex-lg-row">
                            <div class="h-100" style="flex: 1 2 50%;">
                                <img class="img-fluid h-100" src="../assets/images/others/background.webp" alt="scenery">
                            </div>
                            <div style="flex: 2 1 50%;">
                                <h6 class="border-3 border-bottom py-3 easygo-fs-1">Breath-taking view of the kwame Nkrumah park in Ghana</h6>
                                <p class="easygo-fs-2">
                                    Dummy Text. We use top trip curator services to create new adventure for you and your loved ones. We use top trip curator services to create new adventure for you and your loved ones.
                                </p>
                                <p>
                                    <a href="javascript:void(0);" class="text-orange">Read more</a>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex grid-item gap-1 flex-column flex-lg-row">
                            <div class="h-100" style="flex: 1 2 50%;">
                                <img class="img-fluid h-100" src="../assets/images/others/background.webp" alt="scenery">
                            </div>
                            <div style="flex: 2 1 50%;">
                                <h6 class="border-3 border-bottom py-3 easygo-fs-1">Breath-taking view of the kwame Nkrumah park in Ghana</h6>
                                <p class="easygo-fs-2">
                                    Dummy Text. We use top trip curator services to create new adventure for you and your loved ones. We use top trip curator services to create new adventure for you and your loved ones.
                                </p>
                                <p>
                                    <a href="javascript:void(0);" class="text-orange">Read more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div> -->
            <!--- news-blog section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- testimonies section [start] -->
            <!-- <section class="testimonies my-5">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="container d-flex flex-column gap-4">
                                <h5 class="text-orange">Testimonials</h5>
                                <h1>What Our Customers Say About Us</h1>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div id="testimony-slider" class="carousel slide bg-blue rounded text-white" style="padding: 4rem 2rem;" data-bs-ride="carousel">
                                <div class="carousel-indicators easygo-carousel-indicators">
                                    <button type="button" data-bs-target="#testimony-slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#testimony-slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#testimony-slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item w-100 h-100 active">
                                        <div>
                                            <h5 class="text-center easygo-fw-1 s-title-1">Victor Soludo</h5>
                                            <p>
                                                easyGo is a tour curation platform that provides curated tour experiences for travellers and tourists within Ghana.
                                                 We do this by providing a platform that allows seamless booking for packaged tours and the creation of personalised experiences.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item w-100 h-100">
                                        <div>
                                            <h5 class="text-center easygo-fw-1 s-title-1">Victor Soludo</h5>
                                            <p>
                                                EasyGo is a trip curation platform that connects travelers to experiences that are celebrations of culture and expressions of their identity. EasyGo is a trip curation platform that connects travelers to experiences that are celebrations of culture and expressions of their identity.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item w-100 h-100">
                                        <div>
                                            <h5 class="text-center easygo-fw-1 s-title-1">Victor Soludo</h5>
                                            <p>
                                                EasyGo is a trip curation platform that connects travelers to experiences that are celebrations of culture and expressions of their identity. EasyGo is a trip curation platform that connects travelers to experiences that are celebrations of culture and expressions of their identity.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div>
            <!--- testimonies section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- gallery section [start] -->
            <section class="gallery my-5">
                <div class="container">
                    <h1>Destination Gallery</h1>

                    <div class="grid-2">
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100 lazy-loader" loading="lazy" data-src="../assets/images/gallery_pictures/long_1.webp" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100 lazy-loader" loading="lazy" data-src="../assets/images/gallery_pictures/long_11.webp" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100 lazy-loader" loading="lazy" data-src="../assets/images/gallery_pictures/tall_2.webp" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100 lazy-loader" loading="lazy" data-src="../assets/images/gallery_pictures/long_10.webp" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100 lazy-loader" loading="lazy" data-src="../assets/images/gallery_pictures/long_4.jpeg" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100 lazy-loader" loading="lazy" data-src="../assets/images/gallery_pictures/long_7.jpeg" alt="scenery 1">
                        </div>
                    </div>
                </div>
            </section>
            <!--- gallery section [wns] -->
            <!--- ================================ -->

        </main>
        <!--- ================================ -->
        <!--- footer [start] -->
        <?php
        require_once(__DIR__."/../components/footer.php")
        ?>
        <!--- footer [start] -->
        <!--- ================================ -->
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- Swiper bundle js -->
    <!-- <script src="../assets/js/swiper-bundle.min.js"></script> -->
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>