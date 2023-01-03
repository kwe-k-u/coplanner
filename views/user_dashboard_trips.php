<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - User Dashboard</title>
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
        <nav class="navbar d-md-none">
            <div class="container-fluid">
                <button class="navbar-toggler sidebar-toggler border-0 text-black" type="button" data-target="userdashboard-sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h5>Trips</h5>
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./home.php"><i class="fa-solid fa-bus"></i> Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./trips.php"><i class="fa-solid fa-user"></i> Profile</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="javascript:void(0)"><i class="fa-solid fa-car"></i> Private Tour</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="javascript:void(0)"><i class="fa-solid fa-bookmark"></i>Saved Trips</a>
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
                    <div class="px-5">
                        <div class="main-content-header d-flex justify-content-between align-items-center py-4 d-none d-md-flex">
                            <h3 class="m-0">Trips</h3>
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
                            <!-- stat cards [start] -->
                            <section class="stat-cards py-3">
                                <div class="d-flex gap-3 w-100" style="overflow-x: auto;">
                                    <div style="min-width: 300px;">
                                        <div class="info-card m-auto bg-white">
                                            <div class="info-img">
                                                <img src="../assets/images/svgs/bus_red_bg.svg" alt="bus image">
                                            </div>
                                            <div class="info-content">
                                                <div class="info-title easygo-fs-2">Completed trips</div>
                                                <div class="info-num easygo-fs-3">10</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="min-width: 300px;">
                                        <div class="info-card m-auto bg-white">
                                            <div class="info-img">
                                                <img src="../assets/images/svgs/bus_black_bg.svg" alt="bus image">
                                            </div>
                                            <div class="info-content">
                                                <div class="info-title easygo-fs-2">Ongoing trips</div>
                                                <div class="info-num easygo-fs-3">10</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="min-width: 300px;">
                                        <div class="info-card m-auto bg-white">
                                            <div class="info-img">
                                                <img src="../assets/images/svgs/bus_black_bg.svg" alt="bus image" />
                                            </div>
                                            <div class="info-content">
                                                <div class="info-title easygo-fs-2">Canceled trips</div>
                                                <div class="info-num easygo-fs-3">10</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- stat cards [end] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- trip history [start] -->
                            <section class="mt-5">
                                <div class="w-100" style="overflow-x: auto;">
                                    <h4 class="easygo-fs-2 easygo-fw-1 py-4">Trip History</h4>
                                    <div class="history-table-sec" style="min-width: 900px; overflow-x: auto;">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Trip Name</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Bunsco Eco Park</td>
                                                    <td>30</td>
                                                    <td><span class="easygo-badge-blue easygo-fs-5">Completed</span></td>
                                                    <td>12-21-2022</td>
                                                    <td><button class="del-btn my-3"><i class="fa-solid fa-trash"></i></button></td>
                                                </tr>
                                                <tr>
                                                    <td>Bunsco Eco Park</td>
                                                    <td>30</td>
                                                    <td><span class="easygo-badge-orange easygo-fs-5">Ongoing</span></td>
                                                    <td>12-21-2022</td>
                                                    <td><button class="del-btn my-3"><i class="fa-solid fa-trash"></i></button></td>
                                                </tr>
                                                <tr>
                                                    <td>Bunsco Eco Park</td>
                                                    <td>30</td>
                                                    <td><span class="easygo-badge-gray easygo-fs-5">Canceled</span></td>
                                                    <td>12-21-2022</td>
                                                    <td><button class="del-btn my-3"><i class="fa-solid fa-trash"></i></button></td>
                                                </tr>
                                                <tr>
                                                    <td>Bunsco Eco Park</td>
                                                    <td>30</td>
                                                    <td><span class="easygo-badge-blue easygo-fs-5">Completed</span></td>
                                                    <td>12-21-2022</td>
                                                    <td><button class="del-btn my-3"><i class="fa-solid fa-trash"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                            <!-- trip history [end] -->
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
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>