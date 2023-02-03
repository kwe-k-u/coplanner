<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator - Dashboard | All Trips</title>
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
                <img class="img-fluid" src="../assets/images/svgs/logo.svg" alt="easygo logo">
            </div>
            <div class="dashboard-title">All Trips</div>
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
        <header class="nav-menu d-lg-none">
            <?php require_once(__DIR__."/../components/curator_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
        <?php require_once(__DIR__. "/../components/curator_navbar_desktop.php"); ?>
            <div class="main-content px-3">
                <section class="all-trips">
                    <div class="d-flex justify-content-between align-items-center border-1 border-bottom py-3">
                        <div>
                            <h5 class="title easygo-fs-3 easygo-fw-1 m-0">All Trips</h5>
                            <small class="easygo-fs-5 text-gray-1 align-middle"><a href="#">Trips</a> <i class="fa-solid fa-chevron-right"></i> All Trips</small>
                        </div>
                    </div>
                    <!-- ============================== -->
                    <!-- tirp card listing [start] -->
                    <div class="trip-cards">
                        <div class="row pt-5">
                            <!-- ============================== -->
                            <!-- tirp card [start] -->
                            <div class="col-lg-4 col-md-6 pb-4">
                                <div class="trip-card-2">
                                    <div class="trip-card-img">
                                        <img src="../assets/images/others/tour3.jpg" alt="tour 3">
                                    </div>
                                    <div class="trip-card-content">
                                        <h5 class="header">Legon Botanical Gardens</h5>
                                        <div class="easygo-fs-5 d-flex align-items-center justify-content-between">
                                            <div><i class="fa-regular fa-calendar-days"></i> 12 Dec 2022 - 10 Jan 2023</div>
                                            <div><i class="fa-solid fa-pen-to-square"></i> 15 Booked Seats</div>
                                        </div>
                                        <div class="easygo-fs-5">
                                            <i class="fa-solid fa-map-pin"></i> Pickup coming soon
                                        </div>
                                        <div class="py-3 d-flex justify-content-between align-items-center easygo-fs-5">
                                            <span><i class="fa-solid fa-tag"></i> GHc150</span>
                                            <button class="btn px-3 py-1 border easygo-fs-5">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tirp card [start] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- tirp card [start] -->
                            <div class="col-lg-4 col-md-6 pb-4">
                                <div class="trip-card-2">
                                    <div class="trip-card-img">
                                        <img src="../assets/images/others/scenery1.jpg" alt="tour 3">
                                    </div>
                                    <div class="trip-card-content">
                                        <h5 class="header">Legon Botanical Gardens</h5>
                                        <div class="easygo-fs-5 d-flex align-items-center justify-content-between">
                                            <div><i class="fa-regular fa-calendar-days"></i> 12 Dec 2022 - 10 Jan 2023</div>
                                            <div><i class="fa-solid fa-pen-to-square"></i> 15 Booked Seats</div>
                                        </div>
                                        <div class="easygo-fs-5">
                                            <i class="fa-solid fa-map-pin"></i> Pickup coming soon
                                        </div>
                                        <div class="py-3 d-flex justify-content-between align-items-center easygo-fs-5">
                                            <span><i class="fa-solid fa-tag"></i> GHc150</span>
                                            <button class="btn px-3 py-1 border easygo-fs-5">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tirp card [start] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- tirp card [start] -->
                            <div class="col-lg-4 col-md-6 pb-4">
                                <div class="trip-card-2">
                                    <div class="trip-card-img">
                                        <img src="../assets/images/others/scenery2.jpg" alt="tour 3">
                                    </div>
                                    <div class="trip-card-content">
                                        <h5 class="header">Legon Botanical Gardens</h5>
                                        <div class="easygo-fs-5 d-flex align-items-center justify-content-between">
                                            <div><i class="fa-regular fa-calendar-days"></i> 12 Dec 2022 - 10 Jan 2023</div>
                                            <div><i class="fa-solid fa-pen-to-square"></i> 15 Booked Seats</div>
                                        </div>
                                        <div class="easygo-fs-5">
                                            <i class="fa-solid fa-map-pin"></i> Pickup coming soon
                                        </div>
                                        <div class="py-3 d-flex justify-content-between align-items-center easygo-fs-5">
                                            <span><i class="fa-solid fa-tag"></i> GHc150</span>
                                            <button class="btn px-3 py-1 border easygo-fs-5">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tirp card [start] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- tirp card [start] -->
                            <div class="col-lg-4 col-md-6 pb-4">
                                <div class="trip-card-2">
                                    <div class="trip-card-img">
                                        <img src="../assets/images/others/portrait_scenery2.jpg" alt="tour 3">
                                    </div>
                                    <div class="trip-card-content">
                                        <h5 class="header">Legon Botanical Gardens</h5>
                                        <div class="easygo-fs-5 d-flex align-items-center justify-content-between">
                                            <div><i class="fa-regular fa-calendar-days"></i> 12 Dec 2022 - 10 Jan 2023</div>
                                            <div><i class="fa-solid fa-pen-to-square"></i> 15 Booked Seats</div>
                                        </div>
                                        <div class="easygo-fs-5">
                                            <i class="fa-solid fa-map-pin"></i> Pickup coming soon
                                        </div>
                                        <div class="py-3 d-flex justify-content-between align-items-center easygo-fs-5">
                                            <span><i class="fa-solid fa-tag"></i> GHc150</span>
                                            <button class="btn px-3 py-1 border easygo-fs-5">Edit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- tirp card [start] -->
                            <!-- ============================== -->
                        </div>
                    </div>
                    <!-- tirp card listing [end] -->
                    <!-- ============================== -->
                </section>
            </div>
        </main>
        <!-- dashboard-content [end] -->
        <!-- ============================== -->
    </div>
    <!-- main-wrapper [end] -->
    <!-- ============================== -->



    <!-- ============================== -->
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/curator_general.js"></script>
</body>

</html>