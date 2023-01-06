<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - Trip Description</title>
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
            <!--- general information section [start] -->
            <section class="trip-info my-5">
                <div class="container px-lg-5">
                    <div class="text-center easygo-fs-1 my-5">
                        Amazing stuff awaiting you and your loved ones <br>
                        You're just one step away from a new <br> adventure
                    </div>
                    <div class="container px-lg-5">
                        <form class="px-lg-5">
                            <div class="general-info">
                                <div class="easygo-fs-2 easygo-fw-1">General Information</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <div class="text-gray-1 easygo-fs-4">Number of Adults</div>
                                            <div class="easygo-num-input">
                                                <span data-input-target="#num-adults" class="icon-left plus"><i class="fa-solid fa-circle-plus"></i></span>
                                                <input id="num-adults" type="number" class="border-blue text-center" value="1" min="0" max="100">
                                                <span data-input-target="#num-adults" class="icon-right minus"><i class="fa-solid fa-circle-minus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <div class="text-gray-1 easygo-fs-4">Number of Kids</div>
                                            <div class="easygo-num-input">
                                                <span data-input-target="#num-kids" class="icon-left plus"><i class="fa-solid fa-circle-plus"></i></span>
                                                <input id="num-kids" type="number" class="border-blue text-center" value="1" min="0" max="100">
                                                <span data-input-target="#num-kids" class="icon-right minus"><i class="fa-solid fa-circle-minus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-info mt-5">
                                <div class="easygo-fs-2 easygo-fw-1">Contact Information</div>
                                <p>
                                    We'll need your home address and someone we can contact in case of emergencies
                                </p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Home Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Contact's full name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Contact's email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Contact's phone number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Contact's home address">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="warning my-5 d-flex align-items-center gap-3">
                                <img src="../assets/images/svgs/exclamation_orange.svg" alt="warning image"> <span>This trip occurs multiple times in a year, we will send you an email when next it will occur</span>
                            </div>

                            <div class="d-flex">
                                <button class="easygo-btn-1 easygo-fs-1 easygo-rounded-1 py-3 w-100">Book Trip</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!--- general information section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
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