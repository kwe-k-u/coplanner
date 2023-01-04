<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - User Dashboard | Notifications</title>
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
        <nav class="navbar d-md-none">
            <div class="container-fluid">
                <button class="navbar-toggler sidebar-toggler border-0 text-black" type="button" data-target="userdashboard-sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h5>Private Tour</h5>
                <button class="btn"><i class="fa-solid fa-bell"></i></button>
        </nav>
        <main>
            <div class="dashboard-content">
                <!-- ============================== -->
                <!-- sidebar [start] -->
                <aside id="userdashboard-sidebar" class="sidebar sidebar-left bg-white">
                    <div class="sidebar-header py-3">
                        <div class="logo m-md-auto">
                            <img class="logo-medium" src="../assets/images/svgs/logo.svg" alt="easygo logo">
                        </div>
                        <button class="crossbars close-sidebar btn d-md-none" data-target="userdashboard-sidebar">
                            <span class="bar"></span>
                            <span class="bar"></span>
                        </button>
                    </div>
                    <nav class="sidebar-navbar">
                        <div>
                            <ul class="sidebar-nav-menu">
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./user_dashboard_trips.php"><i class="fa-solid fa-bus"></i> Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./user_dashboard_profile.php"><i class="fa-solid fa-user"></i> Profile</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./user_dashboard_private_tour.php"><i class="fa-solid fa-car"></i> Private Tour</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./user_dashboard_saved_trips.php"><i class="fa-solid fa-bookmark"></i>Saved Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./user_dashboard_notifications.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./about.php"><i class="fa-solid fa-house"></i> Home Page</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 text-red" href="./contact.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="d-flex justify-content-center my-3 d-md-none">
                        <div class="d-flex gap-2">
                            <div class="user-icon bg-blue">
                                <!-- <img src="../assets/images/others/profile.jpeg" alt=""> -->
                            </div>
                            <div class="d-flex flex-column justify-content-center gap-1">
                                <h5 class="easygo-fs-4 m-0">Victor Ola</h5>
                                <h6 class="text-gray-1 easygo-fs-5 m-0">User profile</h6>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- sidebar [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- dashboard content [start] -->
                <main class="main-content bg-gray-3">
                    <div class="px-lg-5 px-2">
                        <div class="main-content-header d-flex justify-content-between align-items-center py-4 d-none d-md-flex">
                            <h3 class="m-0">Private Tour Request - Details</h3>
                            <div class="d-flex justify-content-center my-3">
                                <div class="d-flex gap-2">
                                    <div class="user-icon bg-blue">
                                        <!-- <img src="../assets/images/others/profile.jpeg" alt=""> -->
                                    </div>
                                    <div class="d-flex flex-column justify-content-center gap-1">
                                        <h5 class="easygo-fs-4 m-0">Victor Ola</h5>
                                        <h6 class="text-gray-1 easygo-fs-5 m-0">User profile</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-content-body py-2">
                            <!-- ============================== -->
                            <!-- private tour history [start] -->
                            <div class="private-tour-requests-more">
                                <!-- <div class="d-flex justify-content-between accordion-button px-3">
                                    <span style="flex: 1;">Curator</span>
                                    <span style="flex: 1;">Price</span>
                                    <span style="flex: 1;">Proposed Date</span>
                                    <span style="flex: 1;">d</span>
                                </div> -->
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed bg-transparent" type="button">
                                                <div class="w-100 d-flex justify-content-between">
                                                    <span style="flex: 1;">Curator</span>
                                                    <span style="flex: 1;">Price</span>
                                                    <span style="flex: 1;">Proposed Date</span>
                                                    <span style="flex: 1;"></span>
                                                </div>
                                            </button>
                                        </h2>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <div class="w-100 d-flex justify-content-between">
                                                    <span style="flex: 1;">Lionize Tourism Consult</span>
                                                    <span style="flex: 1;">$30</span>
                                                    <span style="flex: 1;">12-21-2022</span>
                                                    <span style="flex: 1;">More Details</span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                <span style="flex: 1;">Lionize Tourism Consult</span>
                                                <span style="flex: 1;">$30</span>
                                                <span style="flex: 1;">12-21-2022</span>
                                                <span style="flex: 1;">More Details</span>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                <span style="flex: 1;">Lionize Tourism Consult</span>
                                                <span style="flex: 1;">$30</span>
                                                <span style="flex: 1;">12-21-2022</span>
                                                <span style="flex: 1;">More Details</span>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- book private tour [end] -->
                            <!-- ============================== -->
                        </div>
                    </div>
                </main>
                <!-- dashboard content [start] -->
                <!-- ============================== -->
            </div>
        </main>
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
    <script src="../assets/js/functions.js"></script>
</body>

</html>