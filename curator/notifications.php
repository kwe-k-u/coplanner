<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator - Dashboard | Notifications</title>
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
    <!-- main-wrapper [start] -->
    <div class="main-wrapper">
        <header class="dashboard-header d-none d-lg-flex">
            <div class="dashlogo logo logo-medium">
                <img class="img-fluid" src="../assets/images/site_images/logo.png" alt="easygo logo">
            </div>
            <div class="dashboard-title">Dashboard</div>
            <div class="right-sec">
                <form id="dashboard-search">
                    <div class="form-input-field">
                        <input class="p-2" type="text" placeholder="search">
                    </div>
                </form>
                <div class="balance d-flex flex-column justify-content-center">
                    <h4 class="m-0 easygo-fs-3 easygo-fw-1">GHC 500</h4>
                    <small class="easygo-fs-5 text-orange">Withdrawable balance</small>
                </div>
                <div class="user-menu d-flex gap-1">
                    <div class="user-icon">
                        <img src="../assets/images/others/profile.jpeg" alt="">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="easygo-fs-3">Admin</h5>
                        <h6 class="text-orange easygo-fs-5">Administrator</h6>
                    </div>
                </div>
            </div>
        </header>
            <?php require_once(__DIR__."/../components/curator_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
        <?php require_once(__DIR__. "/../components/curator_navbar_desktop.php"); ?>
            <div class="main-content px-3">
                <section class="trip-booking">
                    <div class="border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">Notifications</h5>
                            <small class="easygo-fs-5 text-gray-1">Notifications</small>
                        </div>
                        <p class="mt-4 mb-0">Compose a new message and view previous messages.</p>
                    </div>
                    <div class="controls d-flex justify-content-between align-items-between py-3">
                        <div class="left-controls">
                            <button class="easygo-btn-1 py-1 px-5" data-bs-target="#compose-msg-modal" data-bs-toggle="modal">Compose new message</button>
                        </div>
                        <div class="right-controls d-flex gap-2">
                            <form id="dashboard-search">
                                <div class="form-input-field">
                                    <input class="p-2" type="text" placeholder="Search Notifications">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-5">
                        <h6 class="easygo-fw-1 m-0 easygo-fs-3">Send Notifications</h6>
                        <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                    </div>
                    <div class="notification-listing">
                        <div class="easygo-list-3" style="min-width: 992px;">
                            <div class="list-item">
                                <div>
                                    <p class="d-flex gap-3 easygo-fs-2 easygo-fw-1"><input type="checkbox"> Update a Trip pickup locations</p>
                                    <p class="d-flex gap-3"><img src="../assets/images/svgs/full_star.svg" alt="star image"> Dear Collins, Sue to certain unforeseen occurrences, there is an update to the pickup location. We ... </p>
                                </div>
                                <div class="notification-date align-self-start easygo-fw-1">20 Dec 2022</div>
                            </div>
                            <div class="list-item">
                                <div>
                                    <p class="d-flex gap-3 easygo-fs-2 easygo-fw-1"><input type="checkbox"> Update a Trip pickup locations</p>
                                    <p class="d-flex gap-3"><img src="../assets/images/svgs/full_star.svg" alt="star image"> Dear Collins, Sue to certain unforeseen occurrences, there is an update to the pickup location. We ... </p>
                                </div>
                                <div class="notification-date align-self-start easygo-fw-1">20 Dec 2022</div>
                            </div>
                            <div class="list-item">
                                <div>
                                    <p class="d-flex gap-3 easygo-fs-2 easygo-fw-1"><input type="checkbox"> Update a Trip pickup locations</p>
                                    <p class="d-flex gap-3"><img src="../assets/images/svgs/full_star.svg" alt="star image"> Dear Collins, Sue to certain unforeseen occurrences, there is an update to the pickup location. We ... </p>
                                </div>
                                <div class="notification-date align-self-start easygo-fw-1">20 Dec 2022</div>
                            </div>
                            <div class="list-item">
                                <div>
                                    <p class="d-flex gap-3 easygo-fs-2 easygo-fw-1"><input type="checkbox"> Update a Trip pickup locations</p>
                                    <p class="d-flex gap-3"><img src="../assets/images/svgs/full_star.svg" alt="star image"> Dear Collins, Sue to certain unforeseen occurrences, there is an update to the pickup location. We ... </p>
                                </div>
                                <div class="notification-date align-self-start easygo-fw-1">20 Dec 2022</div>
                            </div>
                            <div class="list-item">
                                <div>
                                    <p class="d-flex gap-3 easygo-fs-2 easygo-fw-1"><input type="checkbox"> Update a Trip pickup locations</p>
                                    <p class="d-flex gap-3"><img src="../assets/images/svgs/full_star.svg" alt="star image"> Dear Collins, Sue to certain unforeseen occurrences, there is an update to the pickup location. We ... </p>
                                </div>
                                <div class="notification-date align-self-start easygo-fw-1">20 Dec 2022</div>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-section my-5">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="easygo-fs-5 h-100 d-flex align-items-center">Showing 1 - 20 of 100 trips</div>
                            </div>
                            <div class="col-lg-9">
                                <div class="d-flex justify-content-center align-items-center">
                                    <nav aria-label="Page navigation m-auto">
                                        <ul class="pagination gap-2">
                                            <li class="page-item"><a class="page-link rounded" href="#">Previous</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link rounded" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <!-- dashboard-content [end] -->
        <!-- ============================== -->
    </div>
    <!-- main-wrapper [end] -->
    <!-- ============================== -->



    <!-- ============================== -->
    <!-- compose message modal [start] -->
    <div class="modal fade" id="compose-msg-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-0">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h4 class="easygo-fs-4 easygo-fw-1">Compose new message</h4>
                    <i class="fa-regular fa-star"></i>
                </div>
                <form>
                    <div class="form-input-field py-2">
                        <div class="easygo-fs-5">Trip Name</div>
                        <input type="text">
                    </div>
                    <div class="form-input-field py-2">
                        <div class="easygo-fs-5">Trip Occurence</div>
                        <input type="text">
                    </div>
                    <div class="form-input-field py-2">
                        <div class="easygo-fs-5">Title</div>
                        <input type="text">
                    </div>
                    <div class="form-input-field py-2">
                        <div class="easygo-fs-5">Message</div>
                        <textarea style="resize: none" cols="30" rows="7"></textarea>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary py-2 easygo-fs-5" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="easygo-btn-1 py-2 easygo-fs-5">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- compose message modal [end] -->
    <!-- ============================== -->


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