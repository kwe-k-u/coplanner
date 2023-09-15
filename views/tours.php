<?php
    require_once(__DIR__ . "/../utils/core.php");
    require_once(__DIR__ . "/../controllers/interaction_controller.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - Tours</title>
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
        <!--- ================================ -->
        <!-- page content [start] -->
        <main>
            <!--- ================================ -->
            <!-- next trips [start] -->
            <section style="margin-top: 10rem;">
                <div class="container">
                    <div>
                        <h1 class="easygo-fw-1 text-center easygo-h3">Your Next Adventure Starts Here</h1>
                        <p class="easygo-fs-1 text-center">
                            Book any of these tours to experience Ghana. Create your own unique experience <a href="./dashboard/private_tour.php">here</a>
                        </p>
                    </div>
                    <div>
                        <div class="row">
                            <?php
                            if (isset($_GET["search"])){
                                //TODO:: search for trips
                                $campaigns = get_current_campaigns($_GET["search"]);
                            }else {
                                $campaigns = get_current_campaigns();
                            }

                                foreach ($campaigns as $trip) {
                                    // var_dump($trip);
                                    $image = $trip["media"][0]["media_location"];
                                    $id = $trip["campaign_id"];
                                    $title = $trip["title"];
                                    $desc = shorten($trip["description"]);
                                    $curator = $trip["curator_name"];
                                    $curator_id = $trip["curator_id"];
                                    $next = get_campaign_next_trip($id);
                                    if (!$next){
                                        continue;
                                    }
                                    $start = format_string_as_date_fn($next["start_date"]);
                                    $end = format_string_as_date_fn($next["end_date"]);
                                    $fee = $next["fee"];
                                    $currency = $next["currency"];
                                    $pickup_location = $next["pickup_location"];
                                    // $seats = $next["seats_available"];


                                    echo "
                                         <!--- ================================ -->
                                        <!-- trip card horizontal [start] -->
                                        <div class='col-12 my-4 '>
                                            <div class='row box-shadow-1 py-5 easygo-card-2 rounded'>
                                                <div class='col-md-6 h-100'>
                                                    <div class='rounded overflow-hidden' style='width: inherit; margin: auto'>
                                                        <img src='$image' class='img-fluid' alt='Tour package image'>
                                                    </div>
                                                </div>
                                                <div class='col-md-6 d-flex justify-content-center align-content-center'>
                                                    <div>
                                                        <div>
                                                            <div class='trip-card-header border-0'>
                                                                <div class='title'>
                                                                    <h5 class='easygo-fw-1'>$title</h5>
                                                                    <div class='easygo-fs-4 mb-1'>Curated by <a class='text-blue' href='./curator_profile.php?id=$curator_id'>$curator</a></div>
                                                                    <div class='d-flex justify-content-start align-items-center gap-2'>
                                                                        <div class='stars'>
                                                                            <img src='../assets/images/svgs/shooting_full_star.svg' alt='Shooting full star'>
                                                                            <img src='../assets/images/svgs/full_star.svg' alt='full star'>
                                                                            <img src='../assets/images/svgs/full_star.svg' alt='full star'>
                                                                            <img src='../assets/images/svgs/full_star.svg' alt='full star'>
                                                                            <img src='../assets/images/svgs/empty_star.svg' alt='empty star'>
                                                                        </div>
                                                                        <span class='easygo-fs-6 text-gray-1'>4 star rating</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='trip-card-content py-1'>
                                                                $desc
                                                            </div>
                                                            <div class='d-flex justify-content-between'>
                                                                <span class='easygo-fs-5'><img src='../assets/images/svgs/calendar_orange.svg' alt='orange calendar'> $start - $end</span>
                                                                <!-- <span class='easygo-fs-5'><img src='../assets/images/svgs/moon_orange.svg' alt='orange calendar'> Seats left: 0</span> -->
                                                                <!-- <span class='easygo-fs-5'><img src='../assets/images/svgs/globe_orange.svg' alt='orange calendar'> Pickup: $pickup_location</span> -->
                                                                <span class='easygo-fs-5'></span>
                                                            </div>
                                                        </div>
                                                        <div class='trip-card-footer p-0'>
                                                            <p>
                                                                <span class='easygo-h3'>$currency $fee</span><span class='easygo-fs-2'>/Person</span>
                                                            </p>
                                                            <a href='./tour_description.php?campaign_id=$id' class='easygo-btn-1 easygo-rounded-2 px-5'>View Tour</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- trip card horizontal [end] -->
                                        <!--- ================================ -->
                                    ";
                                }
                            ?>

                        </div>
                        <div class="py-5 text-center">
                            <!-- <div class="d-flex justify-content-center mb-3">
                                <button class="easygo-btn-1 easygo-rounded-2 px-5">Load More Tours</button>
                            </div> -->
                            <p class="easygo-fs-4">Are you looking to plan a private tour? <a href="dashboard/private_tour.php" style="text-decoration:underline">Book Here!</a> </p>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <hr class=" opacity-100 d-md-none">
            </div>
            <!-- next trips [next] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!-- recent trips [start] -->
            <section class="py-5">
                <div class="container">

                    <div class="row my-3">
                        <?php
                            $past_trips = get_past_campaigns();

                            if($past_trips){
                                echo "<div class='text-center easygo-h3'>Past Tours</div>";
                            }


                            foreach ($past_trips as $trip) {
                                $title = $trip["title"];
                                $tour_id = $trip["campaign_id"];
                                $description = shorten($trip["description"]);
                                $curator = $trip["curator_name"];
                                $curator_id = $trip["curator_id"];


                                echo "<div class='col-lg-4 col-md-6 py-3'>
                                <div class='trip-card'>
                                    <img src='../assets/images/others/tour1.jpg' alt='trip card image'>
                                    <div class='trip-card-body'>
                                        <div class='trip-card-header'>
                                            <div class='title'>
                                                <h5 class='easygo-fw-1'>$title</h5>
                                                <p class='text-gray-1 easygo-fs-5'>Curated by <a href='./curator_profile.php?id=$curator_id'>$curator</a></p>
                                            </div>
                                            <div class='location easygo-fs-4'>
                                                Accra Ghana
                                            </div>
                                        </div>
                                        <div class='trip-card-content'>
                                            $description
                                        </div>
                                    </div>
                                    <div class='trip-card-footer'>
                                        <a class='easygo-btn-1 w-100' href='tour_description.php?campaign_id=$tour_id'>View tour</a>
                                    </div>
                                </div>
                            </div>";
                            }
                        ?>

                    </div>
                    <!-- <div class="mt-5">
                        <a href="javascript:void(0)" class="easygo-btn-1 easygo-rounded-2 m-auto" style="max-width: 400px;">See All</a>
                    </div> -->
                </div>
            </section>
            <!-- recent trips [end] -->
            <!--- ================================ -->






















































































        </main>
        <!-- page content [end] -->
        <!--- ================================ -->
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
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
</body>

</html>