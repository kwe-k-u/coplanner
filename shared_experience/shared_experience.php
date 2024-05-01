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
    <title>easyGo - Home</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/home.css">
</head>

<body>

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once(__DIR__."/../coplanner/coplanner_navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main>
            <!--- ================================ -->
            <!--- introduction section [start] -->
            <section class="intro py-7 home-background">
                <div class="d-none d-lg-block d-xl-block intro-card text-center text-white px-2 px-md-5 py-5" style="backdrop-filter: blur(20px); background-image: linear-gradient(transparent,#7283e9);">
                    <h1>
                    Traveling Ghana should be easy
                        <img src="../assets/images/svgs/rocket.svg" alt="rocket image" class="logo-medium">
                    </h1>
                    <p>
                        easyGo connects you with seasoned tour curators who meticulously plan every aspect of the
                        journey. Enjoy the simplicity of booking a spot on an open group tour, where you can explore
                        new places alongside like-minded travelers.
                    </p>

                    <div class="d-flex gap-3 justify-content-center py-2">
                        <button class="easygo-btn-5 py-2 px-3 easygo-fs-4">Explore</button>
                        <!-- <a href="../coplanner/photo_gallery.php" class="easygo-btn-4 py-2 px-3 easygo-fs-4">Photo Gallery <img src="../assets/images/svgs/arrow_45deg_white.svg" alt="45 degree arrow" class="d-inline-block ps-1"></a> -->
                    </div>
                    <!-- <form class="m-auto easygo-fs-5 rounded overflow-hidden" action="./tours.php" style="min-width: 50%;">
                        <div class="d-flex">
                            <input class="px-3 py-2 border-0" type="text" placeholder="Search a tour or an activity" style="flex: 1;" name='query'>
                            <button class="easygo-btn-1 rounded-0">Search</button>
                        </div>
                    </form> -->
                </div>
                <div class="background-item home-background" style="z-index: 1;">
                    <div id="background-slider" class="carousel slide carousel-fade rounded overflow-hidden bg-content" data-bs-ride="carousel">
                        <div class="carousel-indicators easygo-carousel-indicators">
                            <?php
                            if (is_env_remote()) {
                                $dir = $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/assets/images/carousel/*";
                            } else {
                                $dir = $_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/coplanner/assets/images/carousel/*";
                            }
                            $carousel = glob($dir);
                            for ($i = 0; $i < count($carousel); $i++) {
                                echo "
                                    <button type='button' data-bs-target='#background-slider' data-bs-slide-to='$i' class='" . ($i == 0 ? "active" : "") . "' aria-current='true' aria-label='Slide " . ($i + 1) . ")'></button>
                                    ";
                            }
                            ?>
                        </div>
                        <div class="carousel-inner w-100 h-100">
                            <?php
                            foreach ($carousel as $index => $image) {
                                if (is_env_remote()) {
                                    $image = str_replace($_SERVER["CONTEXT_DOCUMENT_ROOT"], server_base_url(), $image);
                                } else {
                                    $image = str_replace($_SERVER["CONTEXT_DOCUMENT_ROOT"] . "/coplanner/", server_base_url(), $image);
                                }
                                echo "
                            <div class='carousel-item " . ($index == 0 ? "active" : "") . " w-100 h-100'>
                                <img class='h-100 w-100' src='$image' alt='carousel image'>
                            </div>
                            ";
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </section>

            <div class="d-sm-block d-xl-none d-lg-none intro-card text-center text-white px-2 px-md-5 py-5" style="backdrop-filter: blur(20px); background-color: #7283e9;">
                <h1>
                    Traveling Ghana should be easy
                    <img src="../assets/images/svgs/rocket.svg" alt="rocket image" class="logo-medium">
                </h1>
                <p>

                easyGo connects you with seasoned tour curators who meticulously plan every aspect of the
                journey. Enjoy the simplicity of booking a spot on an open group tour, where you can explore
                 new places alongside like-minded travelers.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <button class="easygo-btn-5 py-2 px-3 easygo-fs-4">Book Now</button>
                    <!-- <a href="../coplanner/photo_gallery.php" class="easygo-btn-4 py-2 px-3 easygo-fs-4">Photo Gallery <img src="../assets/images/svgs/arrow_45deg_white.svg" alt="45 degree arrow" class="d-inline-block ps-1"></a> -->
                </div>
                <!-- <form class="m-auto easygo-fs-5 rounded overflow-hidden" action="./tours.php" style="min-width: 50%;">
                    <div class="d-flex">
                        <input class="px-3 py-2 border-0" type="text" placeholder="Search a tour or an activity" style="flex: 1;" name='query'>
                        <button class="easygo-btn-1 rounded-0">Search</button>
                    </div>
                </form> -->
            </div>
            <!--- introduction section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- get started section [start] -->
            <section class="get-started my-5">
                <div class="container">
                    <div class="row flex-column-reverse flex-lg-row">
                        <div class="col-lg-6 p-3">
                            <div class="px-lg-5">
                                <div class="stacked-imgs">
                                    <img src="../assets/images/site_images/home_1.jpg" alt="scenery">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center p-3">
                            <div class="container d-flex flex-column gap-2">
                                <h1>Find the Best Tour For You And Your friends</h1>
                                <p>
                                    Tour curators on easyGo are the best people to create unique adventures for you and your friends.
                                    Visit the most exciting destinations and create lasting friendships. Leave the planning and organising
                                    to us, focus on enjoyment.
                                </p>
                                <button class="easygo-btn-1 align-self-start px-5 easygo-fs-4" onclick="goto_page('views/tours.php')" style="border-radius: 50px; word-spacing: 5px;">
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div>
            <!--- get started [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Featured tours section [start] -->
            <section class="suggested-locations my-5">
                <div class="container">
                    <div>
                        <h5 class="text-orange">Shared Experiences</h5>
                        <?php

                        $tours = get_shared_experiences();
                        $label_text = "Upcoming Tours";
                        if (empty($tours)) {
                            // $tours = get_past_campaigns();
                            $label_text = "Featured Tours";
                        }
                        echo "<h1>Shared Experiences</h1>";
                        ?>

                    </div>
                    <div class="row">
                        <?php

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
                        <div class='trip-card'>
                            <img src='$image' alt='trip card image'>
                            <div class='trip-card-body'>
                                <div class='trip-card-header'>
                                    <div class='title'>
                                        <h5 class='easygo-fw-1'>$title</h5>
                                        <!-- <p class='text-gray-1 easygo-fs-5'>Accra, Ghana</p> -->
                                        <div class='text-gray-1 location easygo-fs-4'>
                                            Curated by <a href='curator_profile.php?id=$curator_id'>$curator_name</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='trip-card-footer'>
                                <h3>$currency $fee</h3>
                                <a href='{$base_url}coplanner/itinerary_view.php?experience_id=$id' class='easygo-btn-1'>View tour</a>
                            </div>
                        </div>
                    </div>
                                    ";
                            }
                        }
                        ?>
                    </div>
                    <div class='d-flex justify-content-end'>
                        <a class='text-black d-none d-md-block' href='./tours.php'>View all tours <img src='../assets/images/svgs/arrow_45deg_black.svg' alt='45 degree arrow' style='width: 0.7rem;'></a>
                        <a href='./tours.php' class='easygo-btn-1 d-block d-md-none w-100 text-center'>Go to tours &nbsp; <img src='../assets/images/svgs/arrow_45deg_white.svg' alt='45 degree arrow' style='width: 0.7rem;'></a>
                    </div>
                </div>
            </section>
            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div>
            <!--- Featured tours section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- about us section [start] -->
            <section class="about-us my-5">
                <div class="container">
                    <div class="row flex-column-reverse flex-lg-row">
                        <div class="col-lg-6">
                            <div>
                                <div class="stacked-imgs">
                                    <img src="../assets/images/others/tour1.jpg" alt="scenery">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center p-3">
                            <div class="container d-flex flex-column gap-4">
                                <h5 class="text-orange">About Us</h5>
                                <h1>Tour Curation platform</h1>
                                <p>
                                    easyGo makes it easy for tourists to find and book tours to sites of attractions in Ghana.
                                    Our platform allows us to tap into the experience of our growing community of tour curators to
                                    provide you with the best tours in Ghana. Let us do the heavy lifting so you don't have to
                                </p>
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
                                <img style="height: 120%; position: absolute; bottom: 0; left: 0;" class="img-fluid d-none d-lg-block" src="../assets/images/site_images/home_3.jpg" alt="background image">
                                <div class="d-block d-lg-none pt-5">
                                    <img class="img-fluid" src="../assets/images/site_images/home_3.jpg" alt="background image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 py-5">
                            <div class="container-fluid">
                                <h1>Just between friends</h1>
                                <p>
                                    Some moments are best shared only with friends. Receive a travel plan that meets your
                                    preferences for your next trip with friends. With our travel plans, you get to choose
                                    who gets invited to the trip because sometimes, you want to be with just friends
                                </p>

                                <?php
                                    $base_url = server_base_url();
                                    echo "<button type='button' onclick='return goto_page(\"{$base_url}\",false)' class='easygo-btn-2 easygo-fs-4 easygo-fw-3 px-5' style='border-radius: 50px; word-spacing: 5px;'> Choose a Travel Plan</button>";
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
                                <img class="img-fluid" src="../assets/images/others/background.jpg" alt="scenery">
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
                                <img class="img-fluid h-100" src="../assets/images/others/background.jpg" alt="scenery">
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
                                <img class="img-fluid h-100" src="../assets/images/others/background.jpg" alt="scenery">
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
                            <img class="w-100 h-100" src="../assets/images/gallery_pictures/long_1.jpeg" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100" src="../assets/images/gallery_pictures/long_11.jpeg" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100" src="../assets/images/gallery_pictures/tall_2.jpeg" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100" src="../assets/images/gallery_pictures/long_10.jpeg" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100" src="../assets/images/gallery_pictures/long_4.jpeg" alt="scenery 1">
                        </div>
                        <div class="grid-item rounded overflow-hidden">
                            <img class="w-100 h-100" src="../assets/images/gallery_pictures/long_7.jpeg" alt="scenery 1">
                        </div>
                    </div>
                    <div style="text-align: right" class="my-3"><a class="text-black easygo-fs-2" href="./photo_gallery.php">View Gallery &nbsp; <img src="../assets/images/svgs/arrow_45deg_black.svg" alt=" black 45 degree arrow"></a></div>
                </div>
            </section>
            <!--- gallery section [wns] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- News letter section [start] -->
            <section class="nl-subscribe my-5">
                <div class="container">
                    <form class="nl-subscription-form py-5">
                        <h4 class="title text-white">Subscribe to our newsletter for monthly travel plans and tour destination pricing</h4>
                        <div class="input-field">
                            <input id="newsletter_email_field" type="text" placeholder="Your email address">
                            <button class="bg-orange text-white">Subscribe</button>
                        </div>
                    </form>
                </div>
            </section>
            <!--- News Letter section [end] -->
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
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- Swiper bundle js -->
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>