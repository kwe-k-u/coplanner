<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - Gallery</title>
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
            <!--- ================================ -->
            <!--- photo gallery [start] -->
            <section style="margin-top: 10rem;">
                <div class="container">
                    <h1 class="easygo-h3 text-center">Our Gallery</h1>
                    <p class="text-center">Photos and views from our amazing trips</p>
                    <div class="photos&vids">
                        <ul class="nav nav-tabs easygo-nav-tabs justify-content-center gap-3 border-0" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos" type="button" role="tab" aria-controls="home" aria-selected="true">Photos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">Videos</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!--- ================================ -->
                            <!--- photos [start] -->
                            <div class="tab-pane fade show active" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                                <div class="py-4">
                                    <div class="grid-5" style="max-height: 100vh;">
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                        <div class="grid-item">
                                            <img class="w-100 h-100" src="../assets/images/others/scenery1.jpg" alt="scenery 1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- photos [end] -->
                            <!--- ================================ -->
                            <!--- ================================ -->
                            <!--- photos [start] -->
                            <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                                <div class="py-4">
                                    Videos
                                </div>
                            </div>
                            <!--- photos [end] -->
                            <!--- ================================ -->
                        </div>
                    </div>
                </div>
            </section>
            <!--- photo gallery [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- News letter section [start] -->
            <section class="nl-subscribe my-5">
                <div class="container">
                    <form class="nl-subscription-form py-5">
                        <h4 class="title text-white">subscribe to our newsletter to get the latest information about trips directly from email</h4>
                        <div class="input-field">
                            <input type="text" placeholder="Your email address">
                            <button class="bg-orange text-white" type="submit">Subscribe</button>
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
        require_once("../components/footer.php")
        ?>
        <!--- footer [end] -->
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