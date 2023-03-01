<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator | Account Settings</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <!-- ============================== -->
    <!-- dashboard-wrapper [start] -->
    <div class="main-wrapper">
        <header class="dashboard-header d-none d-lg-flex py-4 bg-gray-3" class="box-shadow-1">
            <div class="dashlogo logo logo-medium">
                <img class="img-fluid" src="../assets/images/svgs/logo.svg" alt="easygo logo">
            </div>
            <div class="dashboard-title easygo-fs-2 easygo-fw-1">Account Settings</div>
        </header>
        <header class="nav-menu d-lg-none">
            <?php require_once(__DIR__."/../components/curator_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
        <?php require_once(__DIR__. "/../components/curator_navbar_desktop.php"); ?>
            <div class="main-content px-3 bg-gray-3">
                <!-- ============================== -->
                <!-- account settings [start] -->
                <section class="account-settings pt-5">
                    <div class="row">
                        <div class="col-lg-2 py-3">
                            <div class="user-icon-display">
                                <div class="profile-img-upload piu-alt">
                                    <div class="profile-img-disp" style="width: 140px; height: 140px;">
                                        <img id="register-profile-img" class="image-display" src="../assets/images/others/tour2.jpg" alt="profile image">
                                        <label class="profile-img-upload-btn text-hover-orange" for="profile-img">Edit</label>
                                        <input display-target="register-profile-img" class="profile-img-file" id="profile-img" type="file" accept=".jpg, .jpeg, .png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 py-3">
                            <div class="user-info">
                                <div class="name-email d-flex justify-content-between">
                                    <div>
                                        <h3 class="easygo-fs-1 easygo-fw-1">Kweku Acquaye</h3>
                                        <h5 class="easygo-fs-4 text-orange">Trip Curator @easyGo Tours</h5>
                                    </div>
                                    <div class="edt-btn-container">
                                        <button class="btn border easygo-fs-4 px-4 py-1">Edit</button>
                                    </div>
                                </div>
                                <div class="other-info">
                                    <div class="contact-info">
                                        <div class="d-flex align-items-center gap-2 my-4">
                                            <h6 class="text-gray-1 easygo-fs-5 m-0">Contact Information</h6>
                                            <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 py-2">
                                                <div><i class="fa-solid fa-envelope"></i> &nbsp; main.easygo@gmail.com</div>
                                            </div>
                                            <div class="col-lg-6 py-2">
                                                <div><i class="fa-solid fa-phone"></i> &nbsp; 020 500 0000</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="trip-rating">
                                        <div class="d-flex align-items-center gap-2 my-4">
                                            <h6 class="text-gray-1 easygo-fs-5 m-0">Average Trip Rating</h6>
                                            <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                        </div>
                                        <div>
                                            <h2 class="easygo-fs-1 easygo-fw-1">4.8</h2>
                                            <div class="text-orange">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                &nbsp; &nbsp; <span class="text-black easygo-fs-5 easygo-fw-1">14 reviews</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account settings [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- stat cards [start] -->
                <section class="stat-cards pt-5">
                    <h3 class="easygo-fs-3 easygo-fw-1 ps-3">Company at glance</h3>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/bus_red_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Group Trips</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">54</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/bus_black_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Private Trips</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">54</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/barchart_blue_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Total Revenue</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">GHS 2,456.00</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 py-3">
                            <div class="info-card m-auto bg-white">
                                <div class="info-img">
                                    <img src="../assets/images/svgs/wallet_orange_bg.svg" alt="bus image">
                                </div>
                                <div class="info-content">
                                    <div class="text-gray-1 info-title easygo-fs-4">Remaining Balance</div>
                                    <div class="info-num easygo-fs-2 easygo-fw-1">GHS 2,456.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- stat cards [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- tabs [start] -->
                <section class="py-5">
                    <div>
                        <ul class="nav nav-tabs easygo-nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100 active" id="all-trips-tab" data-bs-toggle="tab" data-bs-target="#all-trips" type="button" role="tab" aria-controls="all-trips" aria-selected="true">All Trips</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100" id="packages-tab" data-bs-toggle="tab" data-bs-target="#packages" type="button" role="tab" aria-controls="packages" aria-selected="false" tabindex="-1">Packages</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false" tabindex="-1">Reviews</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100" id="complaint-tab" data-bs-toggle="tab" data-bs-target="#complaint" type="button" role="tab" aria-controls="complaint" aria-selected="false" tabindex="-1">Make a complaint</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!--- ================================ -->
                            <!--- all trips [start] -->
                            <div class="tab-pane fade active show" id="all-trips" role="tabpanel" aria-labelledby="description-tab">
                                <div class="easygo-list-3  left-bordered-items" style="min-width: 992px;">
                                    <div class="list-item">
                                        <div class="inner-item">Aburi Botanical Gardens Trip</div>
                                        <div class="inner-item easygo-fs-5 text-end">50 Bookings</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="inner-item">Kwame Nkrumah National Park</div>
                                        <div class="inner-item easygo-fs-5 text-end">50 Bookings</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="inner-item">Mount Afadzo Trip</div>
                                        <div class="inner-item easygo-fs-5 text-end">50 Bookings</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="inner-item">Osu Castle Trip</div>
                                        <div class="inner-item easygo-fs-5 text-end">50 Bookings</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="inner-item">Aburi Gardens</div>
                                        <div class="inner-item easygo-fs-5 text-end">50 Bookings</div>
                                    </div>
                                </div>
                            </div>
                            <!--- all trips [end] -->
                            <!--- ================================ -->
                            <!--- ================================ -->
                            <!--- packages [start] -->
                            <div class="tab-pane fade" id="packages" role="tabpanel" aria-labelledby="packages-tab">
                                <div class="easygo-list-3 list-striped" style="min-width: 992px;">
                                    <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">Transaction ID</div>
                                        <div class="inner-item">Sender Name</div>
                                        <div class="inner-item">Recipient Name</div>
                                        <div class="inner-item">Transaction Date</div>
                                        <div class="inner-item">Amount</div>
                                        <div class="inner-item">Status</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Pending</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                </div>
                            </div>
                            <!--- packages [end] -->
                            <!--- ================================ -->
                            <!--- ================================ -->
                            <!--- reviews [start] -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="easygo-list-3 list-striped" style="min-width: 992px;">
                                    <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">Transaction ID</div>
                                        <div class="inner-item">Sender Name</div>
                                        <div class="inner-item">Recipient Name</div>
                                        <div class="inner-item">Transaction Date</div>
                                        <div class="inner-item">Amount</div>
                                        <div class="inner-item">Status</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Pending</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                </div>

                            </div>
                            <!--- reviews [end] -->
                            <!--- ================================ -->
                            <!--- ================================ -->
                            <!--- complaint [start] -->
                            <div class="tab-pane fade" id="complaint" role="tabpanel" aria-labelledby="complaint-tab">
                                <div class="easygo-list-3 list-striped" style="min-width: 992px;">
                                    <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">Transaction ID</div>
                                        <div class="inner-item">Sender Name</div>
                                        <div class="inner-item">Recipient Name</div>
                                        <div class="inner-item">Transaction Date</div>
                                        <div class="inner-item">Amount</div>
                                        <div class="inner-item">Status</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Pending</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-success">420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                    <div class="list-item">
                                        <div class="item-bullet-container">
                                            <div class="item-bullet"></div>
                                        </div>
                                        <div class="inner-item">NCLLWKDEI</div>
                                        <div class="inner-item">Collins Nudekor</div>
                                        <div class="inner-item">easyGo Admin</div>
                                        <div class="inner-item">13 Dec 2022</div>
                                        <div class="inner-item text-danger">-420</div>
                                        <div class="inner-item">Success</div>
                                    </div>
                                </div>

                            </div>
                            <!--- complaint [end] -->
                            <!--- ================================ -->
                        </div>
                    </div>
                </section>
                <!-- tabs [end] -->
                <!-- ============================== -->
            </div>
        </main>
        <!-- dashboard-content [end] -->
        <!-- ============================== -->
    </div>
    <!-- main-wrapper [end] -->
    <!-- ============================== -->
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
</body>

</html>