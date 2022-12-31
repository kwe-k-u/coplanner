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
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade rounded overflow-hidden" data-bs-ride="carousel">
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
                    </div>
                </div>
            </section>
            <!--- image display section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- trip info section [start] -->
            <section class="trip-info py-5">
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
                                            <div>
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
            <!--- trip info section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->

            <div class="my-5">
                <div class="container  d-flex justify-content-between">
                    <button style="flex: 0 0 30%" class="easygo-fs-1 easygo-rounded-1 py-3 easygo-btn-5 border border-blue">Save Trip</button>
                    <a href="./book_trip.php" style="flex: 0 0 65%" class="easygo-btn-1 easygo-fs-1 easygo-rounded-1 py-3">Book Trip</a>
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
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
</body>

</html>