<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - Home</title>
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
            <div class="container" style="margin-top: 10rem;">
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
                            <div class="carousel-item active">
                                <div style="max-height: 400px;">
                                    <img class="h-100 w-100" src="../assets/images/others/tour1.jpg" alt="carousel image">
                                </div>
                            </div>
                            <div class="carousel-item active">
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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="home" aria-selected="true">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="itineries-tab" data-bs-toggle="tab" data-bs-target="#itineries" type="button" role="tab" aria-controls="itineries" aria-selected="false">Itineries</button>
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
                                        <h5 class="easygo-fw-1 easygo-h3">Bunsco Eco Park Tour</h5>
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
                                    <p>
                                        <span class="easygo-h2">$30</span><span class="easygo-fs-2">/Person</span>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-center gap-4 my-4">
                                    <span class="easygo-fs-2"><img src="../assets/images/svgs/calendar_orange.svg" alt="orange calendar"> 4th November - 10th November</span>
                                    <span class="easygo-fs-2"><img src="../assets/images/svgs/moon_orange.svg" alt="orange calendar"> Duration: 6hrs</span>
                                    <span class="easygo-fs-2"><img src="../assets/images/svgs/globe_orange.svg" alt="orange calendar"> Language: English</span>
                                    <span class="easygo-fs-2"><img src="../assets/images/svgs/globe_orange.svg" alt="orange calendar"> Language: English</span>
                                </div>
                                <div class="text-description easygo-fs-1">
                                    Immerse yourself in the vibrant culture and rich history of Ghana on a tour of this beautiful West African country. Start in the bustling capital city of Accra, where you can explore the vibrant markets and try local dishes such as jollof rice and fufu. Don't miss the opportunity to visit the Kwame Nkrumah Memorial Park, a historical landmark dedicated to Ghana's first president.
                                    Next, head to the coastal city of Cape Coast and visit the Cape Coast Castle, a former slave trading fort that is now a UNESCO World Heritage Site. From there, take a boat ride to Kakum National Park and go on a thrilling canopy walk through the lush rainforest, where you can see a wide variety of exotic flora and fauna.
                                    In the central region of Ghana, visit the ancient Ashanti Kingdom and see the historic city of Kumasi. Here, you can visit the Ashanti Royal Palace and learn about the rich culture and history of the Ashanti people.
                                    In the northern part of the country, go on a safari in Mole National Park and see elephants, lions, and other African wildlife in their natural habitat. Don't miss the opportunity to visit the Tamale Market, where you can experience the vibrant colors and sounds of daily life in northern Ghana.
                                    Overall, a Ghanaian tour offers a unique and exciting experience for travelers, combining visits to historical and cultural landmarks with opportunities for adventure and exploration in the country's beautiful natural surroundings. Book your tour today and start planning your trip to this incredible destination
                                </div>
                                <div class="warning mt-5 d-flex align-items-center gap-3">
                                    <img src="../assets/images/svgs/exclamation_orange.svg" alt="warning image"> <span>This trip occurs multiple times in a year, we will send you an email when next it will occur</span>
                                </div>
                            </div>
                            <!--- gallery [start] -->
                            <div class="my-5">
                                <div class="container">
                                    <h1>Destination Gallery</h1>
                                    <div class="grid-2">
                                        <div class="grid-item">
                                            <img src="../assets/images/others/background.jpg" alt="scenery" class="w-100 h-100">
                                        </div>
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
                                            <div class="row h-100">
                                                <div class="col-6">
                                                    <div style="border-radius: 10px; overflow: hidden;" class="h-100">
                                                        <img src="../assets/images/others/tour2.jpg" alt="scenery" class="w-100 h-100">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div style="border-radius: 10px; overflow: hidden;" class="h-100">
                                                        <img src="../assets/images/others/tour3.jpg" alt="scenery" class="w-100 h-100">
                                                    </div>

                                                </div>
                                            </div>
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
                        <div class="tab-pane fade" id="itineries" role="tabpanel" aria-labelledby="itineries-tab">
                            <div class="py-5">
                                <div class="itinery-item py-3">
                                    <div class="row">
                                        <div class="col-1">
                                            <div style="width: 4rem; height: 4rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                1
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <div>
                                                <h6 class="easygo-fw-1 easygo-fs-1">Kwame Nkrumah Memorial Park</h6>
                                                <div class="text-gray-1 easygo-fs-2">
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
                                            <div style="width: 4rem; height: 4rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                1
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <div>
                                                <h6 class="easygo-fw-1 easygo-fs-1">Kwame Nkrumah Memorial Park</h6>
                                                <div class="text-gray-1 easygo-fs-2">
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
                                            <div style="width: 4rem; height: 4rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                1
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <div>
                                                <h6 class="easygo-fw-1 easygo-fs-1">Kwame Nkrumah Memorial Park</h6>
                                                <div class="text-gray-1 easygo-fs-2">
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
                                            <div style="width: 4rem; height: 4rem;" class="easygo-fs-1 rounded-circle bg-blue text-white d-flex justify-content-center align-items-center">
                                                1
                                            </div>
                                        </div>
                                        <div class="col-11">
                                            <div>
                                                <h6 class="easygo-fw-1 easygo-fs-1">Kwame Nkrumah Memorial Park</h6>
                                                <div class="text-gray-1 easygo-fs-2">
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
                            </div>
                            <div class="warning mt-5 d-flex align-items-center gap-3">
                                <img src="../assets/images/svgs/exclamation_orange.svg" alt="warning image">
                                <span>This trip occurs multiple times in a year, we will send you an email when next it will occur</span>
                                <a class="easygo-btn-1" href="javascript:void(0)">Click here</a>
                            </div>
                        </div>
                        <!--- itineries [end] -->
                        <!--- ================================ -->
                        <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">Activities</div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">Reviews</div>
                    </div>
                </div>
            </section>
            <!--- trip info section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->

            <div class="my-5">
                <div class="container  d-flex justify-content-between">
                    <button style="flex: 0 0 30%" class="easygo-fs-1 easygo-rounded-1 py-3 easygo-btn-5 border border-blue">Save Trip</button>
                    <button style="flex: 0 0 65%" class="easygo-btn-1 easygo-fs-1 easygo-rounded-1 py-3">Book Trip</button>
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