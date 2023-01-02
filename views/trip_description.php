<?php
    require_once(__DIR__."/../utils/core.php");
    require_once(__DIR__."/../controllers/campaign_controller.php");


    if (!isset($_GET["campaign_id"])){
        header("Location: trips.php");
    }
    $id = $_GET["campaign_id"];

    if (isset($_GET["trip_id"])){
        $trip_id = $_GET["trip_id"];
    }

        $campaign = get_campaign_by_id($id);
        $title = $campaign["title"];
        $curator = $campaign["curator_name"];
        $desc = $campaign["description"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo "<title>easygo - $title</title>"; ?>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- swiper css -->
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">
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
        require_once("../components/navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main>
            <div class="container mb-4" style="margin-top: 10rem;">
                <a href="./trips.php">Trips</a> > Trip Details
            </div>
            <!--- ================================ -->
            <!--- image display section [start] -->
            <section class="image-display">
                <div class="container">
                    <!-- Slider main container -->
                    <div class="swiper" style="height: 500px;">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide h-100"><img class="h-100 w-100" src="../assets/images/others/scenery1.jpg" alt="carousel image"></div>
                            <div class="swiper-slide h-100"><img class="h-100 w-100" src="../assets/images/others/tour1.jpg" alt="carousel image"></div>
                            <div class="swiper-slide h-100"><img class="h-100 w-100" src="../assets/images/others/tour2.jpg" alt="carousel image"></div>
                            <div class="swiper-slide h-100"><img class="h-100 w-100" src="../assets/images/others/tour3.jpg" alt="carousel image"></div>
                            <div class="swiper-slide h-100"><img class="h-100 w-100" src="../assets/images/others/portrait_scenery1.jpg" alt="carousel image"></div>
                            <div class="swiper-slide h-100"><img class="h-100 w-100" src="../assets/images/others/portrait_scenery2.jpg" alt="carousel image"></div>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                    </div>
                    <!-- <div id="carouselExampleIndicators" class="carousel slide carousel-fade rounded overflow-hidden" data-bs-ride="carousel">
                        <div class="carousel-indicators easygo-carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div style="max-height: 400px;">
                                    <img class="h-100 w-100" src="../assets/images/others/scenery1.jpg" alt="carousel image">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div style="max-height: 400px;">
                                    <img class="h-100 w-100" src="../assets/images/others/tour1.jpg" alt="carousel image">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div style="max-height: 400px;">
                                    <img class="h-100 w-100" src="../assets/images/others/tour2.jpg" alt="carousel image">
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div> -->
                </div>
            </section>
            <!--- image display section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- trip info section [start] -->
            <!--- ======================= -->
            <!--| for desktop [start] |-->
            <section class="trip-info py-5 d-none d-md-block">
                <div class="container">
                    <ul class="nav nav-tabs easygo-nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="itineries-tab" data-bs-toggle="tab" data-bs-target="#itineries" type="button" role="tab" aria-controls="itineries" aria-selected="false">Locations</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="activities-tab" data-bs-toggle="tab" data-bs-target="#activities" type="button" role="tab" aria-controls="activities" aria-selected="false">Activities</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!--- ================================ -->
                        <!--- trip description [start] -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="py-4">
                                <div class="description-header d-flex justify-content-between">
                                    <div>
                                        <?php
                                            echo "
                                            <h5 class='easygo-fw-1 easygo-h3'>$title</h5>
                                            <div class='easygo-fs-2 my-1'>Curated by $curator</div>
                                            <div class='d-flex justify-content-start align-items-center gap-2'>
                                                <div class='stars'>
                                                    <img src='../assets/images/svgs/shooting_full_star.svg' alt='Shooting full star'>
                                                    <img src='../assets/images/svgs/full_star.svg' alt='full star'>
                                                    <img src='../assets/images/svgs/full_star.svg' alt='full star'>
                                                    <img src='../assets/images/svgs/full_star.svg' alt='full star'>
                                                    <img src='../assets/images/svgs/empty_star.svg' alt='full star'>
                                            </div>
                                            <span class='easygo-fs-6 text-gray-1'>4 star rating</span>
                                        </div>
                                    </div>
                                    <p>
                                        <span class='easygo-h2'>$30</span><span class='easygo-fs-2'>/Person</span>
                                    </p>
                                </div>
                                <div class='d-flex justify-content-center gap-4 my-4'>
                                    <span class='easygo-fs-2'><img src='../assets/images/svgs/calendar_black.svg' alt='calendar'> 4th November - 10th November</span>
                                    <span class='easygo-fs-2'><img src='../assets/images/svgs/crescent_black.svg' alt='crescent'> Duration: 6hrs</span>
                                    <span class='easygo-fs-2'><img src='../assets/images/svgs/globe_black.svg' alt='globe'> Language: English</span>
                                    <span class='easygo-fs-2'><img src='../assets/images/svgs/clock_black.svg' alt='clock'> Start Time: 11am</span>
                                </div>
                                <div class='text-description easygo-fs-1'>
                                $desc
                                </div>
                                <div class='warning mt-5 d-flex align-items-center gap-3'>
                                    <img src='../assets/images/svgs/exclamation_orange.svg' alt='warning image'> <span>This trip occurs multiple times in a year, we will send you an email when next it will occur</span>
                                </div>
                            </div>
                            ";
                        ?>
                            <!--- gallery [start] -->
                            <div class='my-5'>
                                <div class='container'>
                                    <h1>Destination Gallery</h1>
                                    <div class='grid-2'>
                                        <div class='grid-item'>
                                            <img src='../assets/images/others/scenery1.jpg' alt='scenery' class='w-100 h-100'>
                                        </div>
                                        <div class='grid-item'>
                                            <img src='../assets/images/others/scenery2.jpg' alt='scenery' class='w-100 h-100'>
                                        </div>
                                        <div class='grid-item'>
                                            <img src='../assets/images/others/tour1.jpg' alt='scenery' class='w-100 h-100'>
                                        </div>
                                        <div class='grid-item'>
                                            <img src='../assets/images/others/tour2.jpg' alt='scenery' class='w-100 h-100'>
                                        </div>
                                        <div class='grid-item'>
                                            <img src='../assets/images/others/tour3.jpg' alt='scenery' class='w-100 h-100'>
                                        </div>
                                        <div class='grid-item'>
                                            <img src='../assets/images/others/background.jpg' alt='scenery' class='w-100 h-100'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- gallery [end] -->
                            <!--- ================================ -->
                        </div>
                        <!--- trip description [end] -->
                        <!--- ================================ -->
                        <!--- ================================ -->
                        <!--- itineries [start] -->
                        <div class='tab-pane fade' id='itineries' role='tabpanel' aria-labelledby='itineries-tab'>
                            <div class='py-5'>
                                <div class='itinery-item py-3'>
                                    <div class='row'>
                                        <div class='col-1'>
                                            <div style='width: 4rem; height: 4rem;' class='easygo-fs-1 rounded-circle border d-flex justify-content-center align-items-center'>
                                                <img src='../assets/images/svgs/path_orange.svg' alt='path image'>
                                            </div>
                                        </div>
                                        <div class='col-11'>
                                            <div>
                                                <h6 class='easygo-fw-2 easygo-fs-1'>Starting Point</h6>
                                                <div class='text-gray-1 easygo-fs-2'>
                                                    <p>
                                                        We’ll get picked up from your apartments or hotels room
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <?php
                                $sites = get_toursite_by_campaign($id);
                                foreach($sites as $index => $entry){
                                    $site_desc = $entry["toursite_description"];
                                    $site_loc = $entry["site_location"];
                                    $site_name = $entry["site_name"];
                                    $i = $index +1;
                                    echo "
                                    <div class='itinery-item py-3'>
                                    <div class='row'>
                                        <div class='col-1'>
                                            <div style='width: 4rem; height: 4rem;' class='easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center'>
                                                $i
                                            </div>
                                        </div>
                                        <div class='col-11'>
                                            <div>
                                                <h6 class='easygo-fw-2 easygo-fs-1'>$site_name</h6>
                                                <div class='text-gray-1 easygo-fs-2'>
                                                    <p>
                                                        $site_desc
                                                    </p>
                                                    <p>
                                                        Location: $site_loc
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                                }
                               ?>

                                <div class="itinery-item py-3">
                                    <div class="row">
                                        <div class="col-1">
                                            <div style="width: 4rem; height: 4rem;" class="easygo-fs-1 rounded-circle border d-flex justify-content-center align-items-center">
                                                <img src="../assets/images/svgs/path_orange.svg" alt="path image">
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <div class="ps-4">
                                                <h6 class="easygo-fw-2 easygo-fs-1">Return back to the starting point</h6>
                                                <div class="text-gray-1 easygo-fs-2">
                                                    <p>
                                                        Returns to original depature point
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="warning mt-5 d-flex align-items-center gap-3">
                                <img src="../assets/images/svgs/exclamation_orange.svg" alt="warning image">
                                <span>This trip occurs multiple times in a year, we will send you an email when next it will occur</span>
                                <a class="easygo-btn-1" href="javascript:void(0)">Click here</a>
                            </div>
                        </div>
                        <!--- itineries [end] -->
                        <!--- ================================ -->
                        <!--- ================================ -->
                        <!--- activities [start] -->
                        <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">
                            <div class="py-5">
                                <h3>Activities included in trip:</h3>
                                <ul class="easygo-list-2">
                                <?php
                                    $activities = get_campaign_activities($id);
                                    foreach ($activities as $entry) {
                                        $ac = $entry["activity_name"];
                                        echo "<li>$ac</li>";

                                    }
                                ?>
                                </ul>
                            </div>
                            <div class="warning mt-5 d-flex align-items-center gap-3">
                                <img src="../assets/images/svgs/exclamation_orange.svg" alt="warning image">
                                <span>This trip occurs multiple times in a year, we will send you an email when next it will occur</span>
                                <a class="easygo-btn-1" href="javascript:void(0)">Click here</a>
                            </div>
                        </div>
                        <!--- activities [end] -->
                        <!--- ================================ -->
                        <!--- ================================ -->
                        <!--- reviews [start] -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="py-5">
                                <div>
                                    <h5 class="easygo-fw-1 easygo-fs-1">Customer reviews from past trips</h5>
                                    <div class="easygo-fs-2 my-1">Curated by easygo events</div>
                                    <div class="d-flex justify-content-start align-items-center gap-2">
                                        <div class="stars">
                                            <img src="../assets/images/svgs/shooting_full_star.svg" alt="Shooting full star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                            <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                        </div>
                                        <span class="easygo-fs-6 text-gray-1">4 star rating</span>
                                    </div>
                                </div>
                                <div class="bg-blue p-5 text-white my-3">
                                    <div class="row">
                                        <div class="col-lg-6 d-flex align-items-center">
                                            <div>
                                                <p><span class="easygo-h3">4.0</span>/5</p>
                                                <p>Based on 150 customer reviews</p>
                                                <div class="stars">
                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                    <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="py-3">
                                                <div class="l5-rating-bar l5">
                                                    <span class="text">5 star</span>
                                                    <div class="bar">
                                                        <div class="bar-inner bg-orange"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="py-3">
                                                <div class="l5-rating-bar l4">
                                                    <span class="text">4 star</span>
                                                    <div class="bar">
                                                        <div class="bar-inner bg-orange"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="py-3">
                                                <div class="l5-rating-bar l3">
                                                    <span class="text">3 star</span>
                                                    <div class="bar">
                                                        <div class="bar-inner bg-orange"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="py-3">
                                                <div class="l5-rating-bar l2">
                                                    <span class="text">2 star</span>
                                                    <div class="bar">
                                                        <div class="bar-inner bg-orange"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="py-3">
                                                <div class="l5-rating-bar l1">
                                                    <span class="text">1 star</span>
                                                    <div class="bar">
                                                        <div class="bar-inner bg-orange"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews-and-adds">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="user-reviews">
                                                <h5 class="mb-3 easygo-fw-2">User Reviews</h5>
                                                <div class="reviews">
                                                    <!--- ================================ -->
                                                    <!--- single review [start] -->
                                                    <div class="review my-4">
                                                        <div class="d-flex gap-3">
                                                            <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                            </div>
                                                            <div>
                                                                <h6>Victor Ciemerie</h6>
                                                                <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                <div class="stars">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-text py-2">
                                                            Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                        </div>
                                                    </div>
                                                    <!--- single review [end] -->
                                                    <!--- ================================ -->
                                                    <!--- ================================ -->
                                                    <!--- single review [start] -->
                                                    <div class="review my-4">
                                                        <div class="d-flex gap-3">
                                                            <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                            </div>
                                                            <div>
                                                                <h6>Victor Ciemerie</h6>
                                                                <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                <div class="stars">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-text py-2">
                                                            Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                        </div>
                                                    </div>
                                                    <!--- single review [end] -->
                                                    <!--- ================================ -->
                                                    <!--- ================================ -->
                                                    <!--- single review [start] -->
                                                    <div class="review my-4">
                                                        <div class="d-flex gap-3">
                                                            <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                            </div>
                                                            <div>
                                                                <h6>Victor Ciemerie</h6>
                                                                <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                <div class="stars">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-text py-2">
                                                            Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                        </div>
                                                    </div>
                                                    <!--- single review [end] -->
                                                    <!--- ================================ -->
                                                    <!--- ================================ -->
                                                    <!--- single review [start] -->
                                                    <div class="review my-4">
                                                        <div class="d-flex gap-3">
                                                            <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                            </div>
                                                            <div>
                                                                <h6>Victor Ciemerie</h6>
                                                                <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                <div class="stars">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                    <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-text py-2">
                                                            Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                        </div>
                                                    </div>
                                                    <!--- single review [end] -->
                                                    <!--- ================================ -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--- reviews [end] -->
                        <!--- ================================ -->
                    </div>
                </div>
            </section>
            <!--| for desktop [end] |-->
            <!--- ======================= -->
            <!--- ======================= -->
            <!--| for mobile [start] |-->
            <section class="trip-info-mobile py-5 d-block d-md-none">
                <div class="container">
                    <h5 class="easygo-fw-1 easygo-fs-2">Bunsco Eco Park Tour</h5>
                    <div class="description-title d-flex justify-content-between">
                        <div>
                            <div class="easygo-fs-5 my-1 text-gray-1">Curated by easygo events</div>
                            <div class="d-flex justify-content-start align-items-center gap-2">
                                <div class="stars">
                                    <img src="../assets/images/svgs/shooting_full_star.svg" alt="Shooting full star">
                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                    <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                </div>
                                <span class="easygo-fs-6 text-gray-1">4 star rating</span>
                            </div>
                        </div>
                        <p>
                            <span class="easygo-fs-1">$30</span><span class="easygo-fs-4">/Person</span>
                        </p>
                    </div>
                    <div class="row mb-5 mt-4">
                        <div class="col-6 py-2">
                            <span class="easygo-fs-4"><img src="../assets/images/svgs/calendar_black.svg" alt="calendar"> 4th November</span>
                        </div>
                        <div class="col-6 py-2">
                            <span class="easygo-fs-4"><img src="../assets/images/svgs/crescent_black.svg" alt="crescent"> Duration: 6hrs</span>
                        </div>
                        <div class="col-6 py-2">
                            <span class="easygo-fs-4"><img src="../assets/images/svgs/globe_black.svg" alt="globe"> Language: English</span>
                        </div>
                        <div class="col-6 py-2">
                            <span class="easygo-fs-4"><img src="../assets/images/svgs/clock_black.svg" alt="clock"> Start Time: 11am</span>

                        </div>
                    </div>
                    <div class="accordion accordion-flush" id="trip-info-accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="description-heading">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#description-collapse" aria-expanded="true" aria-controls="description-collapse">
                                    Description
                                </button>
                            </h2>
                            <div id="description-collapse" class="accordion-collapse collapse show" aria-labelledby="description-heading" data-bs-parent="#trip-info-accordion">
                                <div class="accordion-body">
                                    <div class="text-description easygo-fs-4">
                                        Immerse yourself in the vibrant culture and rich history of Ghana on a tour of this beautiful West African country. Start in the bustling capital city of Accra, where you can explore the vibrant markets and try local dishes such as jollof rice and fufu. Don't miss the opportunity to visit the Kwame Nkrumah Memorial Park, a historical landmark dedicated to Ghana's first president.
                                        Next, head to the coastal city of Cape Coast and visit the Cape Coast Castle, a former slave trading fort that is now a UNESCO World Heritage Site. From there, take a boat ride to Kakum National Park and go on a thrilling canopy walk through the lush rainforest, where you can see a wide variety of exotic flora and fauna.
                                        In the central region of Ghana, visit the ancient Ashanti Kingdom and see the historic city of Kumasi. Here, you can visit the Ashanti Royal Palace and learn about the rich culture and history of the Ashanti people.
                                        In the northern part of the country, go on a safari in Mole National Park and see elephants, lions, and other African wildlife in their natural habitat. Don't miss the opportunity to visit the Tamale Market, where you can experience the vibrant colors and sounds of daily life in northern Ghana.
                                        Overall, a Ghanaian tour offers a unique and exciting experience for travelers, combining visits to historical and cultural landmarks with opportunities for adventure and exploration in the country's beautiful natural surroundings. Book your tour today and start planning your trip to this incredible destination
                                    </div>
                                    <div class="warning my-3 d-flex align-items-center gap-3">
                                        <img src="../assets/images/svgs/exclamation_orange.svg" alt="warning image"> <span class="easygo-fs-5">This trip occurs multiple times in a year, we will send you an email when next it will occur</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="itineries-heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#itineries-collapse" aria-expanded="false" aria-controls="itineries-collapse">
                                    Itineries
                                </button>
                            </h2>
                            <div id="itineries-collapse" class="accordion-collapse collapse" aria-labelledby="itineries-heading" data-bs-parent="#trip-info-accordion">
                                <div class="accordion-body">
                                    <div class="py-5">
                                        <div class="itinery-item py-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    <div style="width: 2.5rem; height: 2.5rem;" class="rounded-circle border d-flex justify-content-center align-items-center">
                                                        <img src="../assets/images/svgs/path_orange.svg" alt="path image">
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <div class="ps-4">
                                                        <h6 class="easygo-fw-2 easygo-fs-3">Starting Point</h6>
                                                        <div class="text-gray-1 easygo-fs-4">
                                                            <p>
                                                                We’ll get picked up from your apartments or hotels room
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="itinery-item py-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    <div style="width: 2.5rem; height: 2.5rem;" class="easygo-fs-4 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                        1
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <div class="ps-4">
                                                        <h6 class="easygo-fw-2 easygo-fs-3">Kwame Nkrumah Memorial Park</h6>
                                                        <div class="text-gray-1 easygo-fs-4">
                                                            <p>
                                                                Travellers will get to learn about the history of Ghana's independent leader and first President Dr. Kwame Nkrumah. Gate Fee included.
                                                            </p>
                                                            <p>
                                                                Duration: 30 minutes
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="itinery-item py-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    <div style="width: 2.5rem; height: 2.5rem;" class="easygo-fs-4 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                        2
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <div class="ps-4">
                                                        <h6 class="easygo-fw-2 easygo-fs-3">Bunsco Eco Park</h6>
                                                        <div class="text-gray-1 easygo-fs-4">
                                                            <p>
                                                                Travellers arrives at Bunsco Eco Park, explore vast gardens and different wildlifes. Gate Fee included.
                                                            </p>
                                                            <p>
                                                                Duration: 1.5 hours
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="itinery-item py-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    <div style="width: 2.5rem; height: 2.5rem;" class="easygo-fs-4 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                        3
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <div class="ps-4">
                                                        <h6 class="easygo-fw-2 easygo-fs-3">Makola Market</h6>
                                                        <div class="text-gray-1 easygo-fs-4">
                                                            <p>
                                                                Travellers will get to explore one of Ghana's bustling open air market and also learn about the day to day life of buyers and sellers
                                                            </p>
                                                            <p>
                                                                Duration: 30 minutes
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="itinery-item py-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    <div style="width: 2.5rem; height: 2.5rem;" class="easygo-fs-4 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                        4
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <div class="ps-4">
                                                        <h6 class="easygo-fw-2 easygo-fs-3">Asenama Waterfalls</h6>
                                                        <div class="text-gray-1 easygo-fs-4">
                                                            <p>
                                                                Travellers arrives Asenama waterfalls, experience the beauty of nature, take photos and take a swim if they wish to. Gate Fee included.
                                                            </p>
                                                            <p>
                                                                Duration: 30 minutes
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="itinery-item py-3">
                                            <div class="row">
                                                <div class="col-1">
                                                    <div style="width: 2.5rem; height: 2.5rem;" class="easygo-fs-4 rounded-circle border d-flex justify-content-center align-items-center">
                                                        <img src="../assets/images/svgs/path_orange.svg" alt="path image">
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <div class="ps-4">
                                                        <h6 class="easygo-fw-2 easygo-fs-3">Return back to the starting point</h6>
                                                        <div class="text-gray-1 easygo-fs-4">
                                                            <p>
                                                                Returns to original depature point
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="activities-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#activities-collapse" aria-expanded="false" aria-controls="activities-collapse">
                                    Activities
                                </button>
                            </h2>
                            <div id="activities-collapse" class="accordion-collapse collapse" aria-labelledby="activities-header" data-bs-parent="#trip-info-accordion">
                                <div class="accordion-body">
                                    <div>
                                        <h3 class="ps-2">Activities included in trip:</h3>
                                        <ul class="easygo-list-2">
                                            <li>Canopy Walk</li>
                                            <li>Ziplining</li>
                                            <li>Nature Tour</li>
                                            <li>Forest Hicking</li>
                                            <li>Visit to Asenama Waterfalls</li>
                                            <li>Visit to Makola Market</li>
                                            <li>Visit to Bunso Eco Park</li>
                                            <li>Board Games</li>
                                            <li>Horse Riding</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="reviews-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reviews-collapse" aria-expanded="false" aria-controls="reviews-collapse">
                                    Reviews
                                </button>
                            </h2>
                            <div id="reviews-collapse" class="accordion-collapse collapse" aria-labelledby="reviews-header" data-bs-parent="#trip-info-accordion">
                                <div class="accordion-body">
                                    <div>
                                        <div>
                                            <h5 class="easygo-fw-1 easygo-fs-1">Customer reviews from past trips</h5>
                                            <div class="easygo-fs-2 my-1">Curated by easygo events</div>
                                            <div class="d-flex justify-content-start align-items-center gap-2">
                                                <div class="stars">
                                                    <img src="../assets/images/svgs/shooting_full_star.svg" alt="Shooting full star">
                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                    <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                    <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                </div>
                                                <span class="easygo-fs-6 text-gray-1">4 star rating</span>
                                            </div>
                                        </div>
                                        <div class="bg-blue p-3 text-white my-3 rounded box-shadow-1">
                                            <div class="row">
                                                <div class="col-6 d-flex align-items-center">
                                                    <div>
                                                        <p class="m-0 p-0"><span class="easygo-h3">4.0</span>/5</p>
                                                        <p class="easygo-fs-5">Based on 150 customer reviews</p>
                                                        <div class="stars">
                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                            <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 d-flex flex-column justify-content-center">
                                                    <div>
                                                        <div class="py-1">
                                                            <div class="l5-rating-bar l5">
                                                                <span class="text easygo-fs-5 easygo-fw-3">5 star</span>
                                                                <div class="bar small">
                                                                    <div class="bar-inner bg-orange"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="py-1">
                                                            <div class="l5-rating-bar l4">
                                                                <span class="text easygo-fs-5 easygo-fw-3">4 star</span>
                                                                <div class="bar small">
                                                                    <div class="bar-inner bg-orange"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="py-1">
                                                            <div class="l5-rating-bar l3">
                                                                <span class="text easygo-fs-5 easygo-fw-3">3 star</span>
                                                                <div class="bar small">
                                                                    <div class="bar-inner bg-orange"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="py-1">
                                                            <div class="l5-rating-bar l2">
                                                                <span class="text easygo-fs-5 easygo-fw-3">2 star</span>
                                                                <div class="bar small">
                                                                    <div class="bar-inner bg-orange"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="py-1">
                                                            <div class="l5-rating-bar l1">
                                                                <span class="text easygo-fs-5 easygo-fw-3">1 star</span>
                                                                <div class="bar small">
                                                                    <div class="bar-inner bg-orange"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reviews-and-adds">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="user-reviews">
                                                        <h5 class="mt-4 mb-2 easygo-fw-2">User Reviews</h5>
                                                        <div class="reviews">
                                                            <!--- ================================ -->
                                                            <!--- single review [start] -->
                                                            <div class="review my-4">
                                                                <div class="d-flex gap-3">
                                                                    <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                                    </div>
                                                                    <div>
                                                                        <h6>Victor Ciemerie</h6>
                                                                        <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                        <div class="stars">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="review-text py-2">
                                                                    Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                                </div>
                                                            </div>
                                                            <!--- single review [end] -->
                                                            <!--- ================================ -->
                                                            <!--- ================================ -->
                                                            <!--- single review [start] -->
                                                            <div class="review my-4">
                                                                <div class="d-flex gap-3">
                                                                    <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                                    </div>
                                                                    <div>
                                                                        <h6>Victor Ciemerie</h6>
                                                                        <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                        <div class="stars">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="review-text py-2">
                                                                    Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                                </div>
                                                            </div>
                                                            <!--- single review [end] -->
                                                            <!--- ================================ -->
                                                            <!--- ================================ -->
                                                            <!--- single review [start] -->
                                                            <div class="review my-4">
                                                                <div class="d-flex gap-3">
                                                                    <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                                    </div>
                                                                    <div>
                                                                        <h6>Victor Ciemerie</h6>
                                                                        <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                        <div class="stars">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="review-text py-2">
                                                                    Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                                </div>
                                                            </div>
                                                            <!--- single review [end] -->
                                                            <!--- ================================ -->
                                                            <!--- ================================ -->
                                                            <!--- single review [start] -->
                                                            <div class="review my-4">
                                                                <div class="d-flex gap-3">
                                                                    <div style="width: 5rem; height: 5rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                                    </div>
                                                                    <div>
                                                                        <h6>Victor Ciemerie</h6>
                                                                        <small class="text-gray-1 easygo-fs-6">3 days ago</small>
                                                                        <div class="stars">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/full_star.svg" alt="full star">
                                                                            <img src="../assets/images/svgs/empty_star.svg" alt="full star">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="review-text py-2">
                                                                    Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, condimentum. eget Metus, eget pulvinar volutpat elementum, condimentum.
                                                                </div>
                                                            </div>
                                                            <!--- single review [end] -->
                                                            <!--- ================================ -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- ================================ -->
                    <!--- gallery [start] -->
                    <div class="my-5">
                        <div class="container">
                            <h1 class="easygo-fs-2">Destination Gallery</h1>
                            <div class="grid-2">
                                <div class="grid-item">
                                    <img src="../assets/images/others/scenery1.jpg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="../assets/images/others/scenery2.jpg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="../assets/images/others/tour1.jpg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="../assets/images/others/tour2.jpg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="../assets/images/others/tour3.jpg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="../assets/images/others/background.jpg" alt="scenery" class="w-100 h-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- gallery [end] -->
                    <!--- ================================ -->
                </div>
            </section>
            <!--| for mobile [end] |-->
            <!--- ======================= -->
            <!--- trip info section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->

            <div class="my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 py-2">
                            <a class="d-block w-100 text-center easygo-fs-1 easygo-rounded-1 py-3 easygo-btn-5 border border-blue">Save Trip</a>
                        </div>
                        <div class="col-lg-7 py-2">
                            <a href="./book_trip.php" class="easygo-btn-1 easygo-fs-1 easygo-rounded-1 py-3">Book Trip</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--- ================================ -->
        <!--- footer [start] -->
        <?php
        require_once("../components/footer.php")
        ?>
        <!--- footer [start] -->
        <!--- ================================ -->
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- Swiper js -->
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
</body>

</html>