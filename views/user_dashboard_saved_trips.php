<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - User Dashboard | Saved Trips</title>
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
                <h5>Saved Trips</h5>
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./home.php"><i class="fa-solid fa-bus"></i> Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./trips.php"><i class="fa-solid fa-user"></i> Profile</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="javascript:void(0)"><i class="fa-solid fa-car"></i> Private Tour</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="javascript:void(0)"><i class="fa-solid fa-bookmark"></i>Saved Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="javascript:void(0)"><i class="fa-solid fa-bell"></i>Notifications</a>
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
                            <h3 class="m-0">Saved Trips</h3>
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
                            <!-- saved trips listing [start] -->
                            <div class="px-2">
                                <div class="row">
                                    <!--- ================================ -->
                                    <!-- trip card horizontal [start] -->
                                    <div class='col-12 my-4'>
                                        <div class='row box-shadow-1 py-5 rounded'>
                                            <div class='col-lg-6'>
                                                <div class='rounded overflow-hidden h-100' style='max-width: 100%; margin: auto'>
                                                    <img src='../assets/images/others/scenery2.jpg' class='img-fluid h-100' alt='trip card image'>
                                                </div>
                                            </div>
                                            <div class='my-auto col-lg-6 d-flex justify-content-center align-content-center'>
                                                <div class="w-100">
                                                    <div>
                                                        <div class='trip-card-header border-0'>
                                                            <div class='title'>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <h5 class='easygo-fw-1'>Bunsco Eco Park</h5>
                                                                    <p class="d-lg-none d-block">
                                                                        <span class='easygo-fs-2'>$30</span><span class='easygo-fs-5'>/Person</span>
                                                                    </p>
                                                                </div>
                                                                <div class='easygo-fs-4 mb-1'>Curated by easygo events</div>
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
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur aliquid, quibusdam repellendus consectetur fugit illo eius error pariatur distinctio recusandae vel dolor, alias tempora quaerat nisi saepe, sapiente sed placeat! Numquam doloribus iure quibusdam libero optio illum accusantium quidem non molestias vero officia iusto nesciunt repudiandae, aperiam, deleniti, vitae cupiditate.
                                                        </div>
                                                        <div class='d-flex justify-content-between'>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/calendar_orange.svg' alt='orange calendar'> $start - $end</span>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/moon_orange.svg' alt='orange calendar'> Duration: 6hrs</span>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/globe_orange.svg' alt='orange calendar'> Language: English</span>
                                                        </div>
                                                    </div>
                                                    <div class='trip-card-footer px-0 py-3'>
                                                        <p class="d-none d-lg-block flex-grow-1">
                                                            <span class='easygo-fs-2'>$30</span><span class='easygo-fs-5'>/Person</span>
                                                        </p>
                                                        <div class="d-flex gap-2 justify-content-end flex-grow-1">
                                                            <a href='./trip_description.php?campaign_id=$id' class='del-btn easygo-rounded-2 px-4 py-2 easygo-fs-6 flex-grow-1 text-center'><i class="fa-solid fa-trash"></i> Remove</a>
                                                            <a href='./trip_description.php?campaign_id=$id' class='easygo-btn-1 easygo-rounded-2 px-4 py-2 easygo-fs-6 flex-grow-1 text-center'>Go To Trip</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- trip card horizontal [end] -->
                                    <!--- ================================ -->
                                    <!--- ================================ -->
                                    <!-- trip card horizontal [start] -->
                                    <div class='col-12 my-4'>
                                        <div class='row box-shadow-1 py-5 rounded'>
                                            <div class='col-lg-6'>
                                                <div class='rounded overflow-hidden h-100' style='max-width: 100%; margin: auto'>
                                                    <img src='../assets/images/others/scenery2.jpg' class='img-fluid h-100' alt='trip card image'>
                                                </div>
                                            </div>
                                            <div class='my-auto col-lg-6 d-flex justify-content-center align-content-center'>
                                                <div class="w-100">
                                                    <div>
                                                        <div class='trip-card-header border-0'>
                                                            <div class='title'>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <h5 class='easygo-fw-1'>Bunsco Eco Park</h5>
                                                                    <p class="d-lg-none d-block">
                                                                        <span class='easygo-fs-2'>$30</span><span class='easygo-fs-5'>/Person</span>
                                                                    </p>
                                                                </div>
                                                                <div class='easygo-fs-4 mb-1'>Curated by easygo events</div>
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
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur aliquid, quibusdam repellendus consectetur fugit illo eius error pariatur distinctio recusandae vel dolor, alias tempora quaerat nisi saepe, sapiente sed placeat! Numquam doloribus iure quibusdam libero optio illum accusantium quidem non molestias vero officia iusto nesciunt repudiandae, aperiam, deleniti, vitae cupiditate.
                                                        </div>
                                                        <div class='d-flex justify-content-between'>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/calendar_orange.svg' alt='orange calendar'> $start - $end</span>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/moon_orange.svg' alt='orange calendar'> Duration: 6hrs</span>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/globe_orange.svg' alt='orange calendar'> Language: English</span>
                                                        </div>
                                                    </div>
                                                    <div class='trip-card-footer px-0 py-3'>
                                                        <p class="d-none d-lg-block flex-grow-1">
                                                            <span class='easygo-fs-2'>$30</span><span class='easygo-fs-5'>/Person</span>
                                                        </p>
                                                        <div class="d-flex gap-2 justify-content-end flex-grow-1">
                                                            <a href='./trip_description.php?campaign_id=$id' class='del-btn easygo-rounded-2 px-4 py-2 easygo-fs-6 flex-grow-1 text-center'><i class="fa-solid fa-trash"></i> Remove</a>
                                                            <a href='./trip_description.php?campaign_id=$id' class='easygo-btn-1 easygo-rounded-2 px-4 py-2 easygo-fs-6 flex-grow-1 text-center'>Go To Trip</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- trip card horizontal [end] -->
                                    <!--- ================================ -->
                                    <!--- ================================ -->
                                    <!-- trip card horizontal [start] -->
                                    <div class='col-12 my-4'>
                                        <div class='row box-shadow-1 py-5 rounded'>
                                            <div class='col-lg-6'>
                                                <div class='rounded overflow-hidden h-100' style='max-width: 100%; margin: auto'>
                                                    <img src='../assets/images/others/scenery2.jpg' class='img-fluid h-100' alt='trip card image'>
                                                </div>
                                            </div>
                                            <div class='my-auto col-lg-6 d-flex justify-content-center align-content-center'>
                                                <div class="w-100">
                                                    <div>
                                                        <div class='trip-card-header border-0'>
                                                            <div class='title'>
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <h5 class='easygo-fw-1'>Bunsco Eco Park</h5>
                                                                    <p class="d-lg-none d-block">
                                                                        <span class='easygo-fs-2'>$30</span><span class='easygo-fs-5'>/Person</span>
                                                                    </p>
                                                                </div>
                                                                <div class='easygo-fs-4 mb-1'>Curated by easygo events</div>
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
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur aliquid, quibusdam repellendus consectetur fugit illo eius error pariatur distinctio recusandae vel dolor, alias tempora quaerat nisi saepe, sapiente sed placeat! Numquam doloribus iure quibusdam libero optio illum accusantium quidem non molestias vero officia iusto nesciunt repudiandae, aperiam, deleniti, vitae cupiditate.
                                                        </div>
                                                        <div class='d-flex justify-content-between'>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/calendar_orange.svg' alt='orange calendar'> $start - $end</span>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/moon_orange.svg' alt='orange calendar'> Duration: 6hrs</span>
                                                            <span class='easygo-fs-5'><img src='../assets/images/svgs/globe_orange.svg' alt='orange calendar'> Language: English</span>
                                                        </div>
                                                    </div>
                                                    <div class='trip-card-footer px-0 py-3'>
                                                        <p class="d-none d-lg-block flex-grow-1">
                                                            <span class='easygo-fs-2'>$30</span><span class='easygo-fs-5'>/Person</span>
                                                        </p>
                                                        <div class="d-flex gap-2 justify-content-end flex-grow-1">
                                                            <a href='./trip_description.php?campaign_id=$id' class='del-btn easygo-rounded-2 px-4 py-2 easygo-fs-6 flex-grow-1 text-center'><i class="fa-solid fa-trash"></i> Remove</a>
                                                            <a href='./trip_description.php?campaign_id=$id' class='easygo-btn-1 easygo-rounded-2 px-4 py-2 easygo-fs-6 flex-grow-1 text-center'>Go To Trip</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- trip card horizontal [end] -->
                                    <!--- ================================ -->
                                </div>
                            </div>
                            <!-- saved trips listing [end] -->
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