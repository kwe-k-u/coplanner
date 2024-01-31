<?php
require_once(__DIR__ . "/utils/core.php");
require_once(__DIR__ . "/utils/env_manager.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/utils/analytics/google_tag.php") ?>
    <?php include_once(__DIR__ . "/utils/analytics/google_head_tag.php") ?>
    <link rel="icon" href="assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EasyGo - Home</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="assets/css/general.css">
</head>
<?php include_once(__DIR__ . "/utils/analytics/google_body_tag.php") ?>

<body class="bg-gray-3">

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once("coplanner/coplanner_navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main class="container">
            <!--- ================================ -->
            <!--- Section 1 [start] -->
            <section class="" style="margin-top: 7rem;">
                <div class="row">
                    <div class="col-lg-6 p-3 d-flex flex-column justify-content-center">
                        <div class="d-flex flex-column gap-5">
                            <h2 class="text-blue easygo-fw-1">Create tour itineries yourself</h2>
                            <div class="easygo-fs-2">
                            We let adventure seekers to quickly craft travel plans that capture
                            unique thrilling experiences and book the destinations included in those plans
                            </div>
                            <div class='d-flex justify-content-between gap-4'>
                                <a href='./coplanner/hotels.php' class='easygo-btn-5 bg-orange text-white easygo-fs-5 w-50' >Become an easyGo Partner</a>
                                <?php
                                    // if(is_session_logged_in()){
                                        echo "<a href='coplanner/coplanner_setup.php' class='easygo-btn-4 border-blue text-blue easygo-fs-5 w-50 bg-white'>Try for individuals</a>";
                                    // }else{
                                    //     echo "<a href='coplanner/login.php?redirect_url=coplanner_setup.php' class='easygo-btn-4 border-blue text-blue easygo-fs-5 w-50 bg-white'>Try for individuals</a>";

                                    // }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-3">
                        <div class="w-100 h-100 d-flex justify-content-center">
                            <img class="img-fluid" src="assets/images/others/long_11.jpeg" alt="coplanner image">
                        </div>
                    </div>
                </div>
            </section>
            <!--- Section 1 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 2 [start] -->
            <section class="my-5">
                <div>
                    <h2 class="easygo-fw-1 mb-4">What coplanner means for you</h2>
                    <div class="row">
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Flexibility</h3>
                                <div class="py-2">
                                    Make changes to aspects of the itinerary including budget, destinations and number of days
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Time Savings</h3>
                                <div class="py-2">
                                    Quickly create a full-proof itinerary complete with destination activities, transportation and lodging in minutes </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Convenience</h3>
                                <div class="py-2">
                                    Easily make payments for destinations, buses and accommodation
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--- Section 2 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 3 [start] -->

            <div class="about-intro-third pt-3 my-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">

                                <div>
                                    <h2 class="text-blue easygo-fw-1 text-capitalize">You know yourself best</h2>
                                    We know working with tour companies to plan your perfect vacation doesn't always
                                    end up with the best results. That's why we give the power to you! Create the
                                    itinerary you want in minutes. Don't like something? Just change it. The
                                    only limitations are your imagination. <br> Not sure what to add to your itinerary?
                                    Use of itinerary generation service to get recommendations on itineraries based on your
                                    theme. Then, make any changes you want. The itineraries are truely yours!
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                <div class="grid-3" style="max-height: 500px">
                                    <div class="grid-item">
                                        <img src="assets/images/others/tall_10.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                    <div class="grid-item">
                                        <img src="assets/images/others/long_1.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                    <div class="grid-item">
                                        <img src="assets/images/others/tall_3.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                    <div class="grid-item">
                                        <img src="assets/images/others/tall_7.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--- Section 3 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 4 [start] -->
            <?php
            include_once(__DIR__ . "/components/itinerary_suggestions.php");
            ?>
            <!--- Section 4 [end] -->
            <!--- ================================ -->
        </main>
        <?php require_once(__DIR__ . "/components/footer.php") ?>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/utils/js_env_variables.php"); ?>
    <script src="assets/js/general.js"></script>
    <script src="assets/js/functions.js"></script>

</body>

</html>