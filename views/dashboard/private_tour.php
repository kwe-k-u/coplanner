<?php
require_once(__DIR__ . "/../../utils/core.php");
login_check();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - User Dashboard | Notifications</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- swiper css -->
    <link rel="stylesheet" href="../../assets/css/swiper-bundle.min.css">
    <!-- easygo css -->
    <link rel="stylesheet" href="../../assets/css/general.css">
    <link rel="stylesheet" href="../../assets/css/home.css">
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
                        <script>
                            function goHome() {
                                window.location.href = "../home.php";;
                            }
                        </script>
                        <div class="logo m-md-auto" onclick="return goHome()">
                            <img class="logo-medium" src="../../assets/images/svgs/logo.svg" alt="easygo logo">
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 " href="./dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 " href="./trip_history.php"><i class="fa-solid fa-bus"></i> Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./private_tour.php"><i class="fa-solid fa-car"></i> Private Tour</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./saved_trips.php"><i class="fa-solid fa-bookmark"></i>Saved Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./notifications.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 " href="./settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 text-red" onclick="return logout()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="d-flex justify-content-center my-3 d-md-none">
                        <div class="d-flex gap-2">
                            <div class="user-icon bg-blue">
                                <!-- <img src="../../assets/images/others/profile.jpeg" alt=""> -->
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
                            <h3 class="m-0">Private Tours</h3>
                            <div class="d-flex justify-content-center my-3">
                                <div class="d-flex gap-2">
                                    <div class="user-icon bg-blue">
                                        <img src="../../assets/images/others/profile.jpeg" alt="">
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
                            <div class="private-tour-requests request-tour">
                                <div class="private-tour-request-header d-flex justify-content-between align-items-center">
                                    <h3 class="easygo-fs-3">Private Tour Request</h3>
                                    <button class="easygo-btn-1 easygo-fs-4 easygo-rounded-2 visibility-changer" data-visibility-target=".request-tour"><i class="fa-solid fa-circle-plus"></i> &nbsp; Request New Tour</button>
                                </div>
                                <!-- ============================== -->
                                <!-- | desktop | [start] -->
                                <div class="for-dekstop d-none d-md-block">
                                    <div class="private-tour-request-items">
                                        <div class="easygo-list-3">
                                            <div class="list-item">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="easygo-fs-5 text-gray-1 d-flex align-items-center gap-1">
                                                            GHC 200 - GHC 500
                                                            <span class="bg-gray-1 rounded-circle" style="width:7px; height: 7px"></span>
                                                            2nd Jan - 3rd Jan
                                                            <span class="bg-gray-1 rounded-circle" style="width:7px; height: 7px"></span>
                                                            2 kids & 4 adults
                                                        </div>
                                                        <span class="easygo-badge-orange easygo-fs-5">Ongoing</span>
                                                    </div>
                                                    <div class="easygo-fs-4 py-3">
                                                        I am looking for Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, placerat elementum aliquam. Morbi nibh a nisi, ac ac scelerisque elementum aliquam. Morbi nibh a nisi, ac ac scelerisque....
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="easygo-fs-3 easygo-fw-1">2 Quotes received</h5>
                                                        <div class="d-flex gap-1">
                                                            <button class="del-btn easygo-rounded-1 easygo-fs-5"><i class="fa-solid fa-trash"></i> Remove</button>
                                                            <button class="easygo-btn-5 bg-lblue-1 easygo-rounded-1 easygo-fs-5 px-2"><i class="fa-solid fa-eye"></i> &nbsp; View Quotes</button>
                                                            <button class="easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3"><i class="fa-solid fa-pen"></i> &nbsp; Edit Request</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-item">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="easygo-fs-5 text-gray-1 d-flex align-items-center gap-1">
                                                            GHC 200 - GHC 500
                                                            <span class="bg-gray-1 rounded-circle" style="width:7px; height: 7px"></span>
                                                            2nd Jan - 3rd Jan
                                                            <span class="bg-gray-1 rounded-circle" style="width:7px; height: 7px"></span>
                                                            2 kids & 4 adults
                                                        </div>
                                                        <span class="easygo-badge-orange easygo-fs-5">Ongoing</span>
                                                    </div>
                                                    <div class="easygo-fs-4 py-3">
                                                        I am looking for Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, placerat elementum aliquam. Morbi nibh a nisi, ac ac scelerisque elementum aliquam. Morbi nibh a nisi, ac ac scelerisque....
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="easygo-fs-4">You accepted a quote from <span class="easygo-fw-1">‘Lionize Tourism Consult’</span></h5>
                                                        <div class="d-flex gap-1">
                                                            <button class="del-btn easygo-rounded-1 easygo-fs-5"><i class="fa-solid fa-trash"></i> Remove</button>
                                                            <button class="easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3"><i class="fa-solid fa-eye"></i> &nbsp; View Description</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-item">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="easygo-fs-5 text-gray-1 d-flex align-items-center gap-1">
                                                            GHC 200 - GHC 500
                                                            <span class="bg-gray-1 rounded-circle" style="width:7px; height: 7px"></span>
                                                            2nd Jan - 3rd Jan
                                                            <span class="bg-gray-1 rounded-circle" style="width:7px; height: 7px"></span>
                                                            2 kids & 4 adults
                                                        </div>
                                                        <span class="easygo-badge-orange easygo-fs-5">Ongoing</span>
                                                    </div>
                                                    <div class="easygo-fs-4 py-3">
                                                        I am looking for Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, placerat elementum aliquam. Morbi nibh a nisi, ac ac scelerisque elementum aliquam. Morbi nibh a nisi, ac ac scelerisque....
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="easygo-fs-3 easygo-fw-1">0 Quotes received</h5>
                                                        <div class="d-flex gap-1">
                                                            <button class="del-btn easygo-rounded-1 easygo-fs-5"><i class="fa-solid fa-trash"></i> Remove</button>
                                                            <button class="easygo-btn-5 bg-lblue-1 easygo-rounded-1 easygo-fs-5 px-2"><i class="fa-solid fa-eye"></i> &nbsp; View Quotes</button>
                                                            <button class="easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3"><i class="fa-solid fa-pen"></i> &nbsp; Edit Request</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- | desktop | [end] -->
                                <!-- ============================== -->
                                <!-- ============================== -->
                                <!-- | mobile | [start] -->
                                <div class="for-mobile d-block d-md-none">
                                    <div class="private-tour-request-items">
                                        <div class="easygo-list-3">
                                            <div class="list-item">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="easygo-fs-3 easygo-fw-1">2 Quotes received</h5>
                                                        <span class="easygo-badge-orange easygo-fs-5">Ongoing</span>
                                                    </div>
                                                    <div class="easygo-fs-4 py-3">
                                                        I am looking for Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, placerat elementum aliquam. Morbi nibh a nisi, ac ac scelerisque elementum aliquam. Morbi nibh a nisi, ac ac scelerisque....
                                                    </div>
                                                    <div class="easygo-fs-5 text-gray-1 d-flex align-items-center gap-1">
                                                        GHC 200 - GHC 500 <br>
                                                        2nd Jan - 3rd Jan &nbsp; &nbsp;
                                                        2 kids & 4 adults
                                                    </div>
                                                    <div class="d-flex gap-1 flex-wrap py-3">
                                                        <button class="easygo-btn-1 easygo-rounded-1 easygo-fs-5 px-2 w-100 my-2"><i class="fa-solid fa-eye"></i> &nbsp; View Quotes</button>
                                                        <button class="easygo-rounded-1 easygo-fs-5 easygo-btn-5 bg-lblue-1 py-1 easygo-fw-3 flex-grow-1 px-0"><i class="fa-solid fa-pen"></i> &nbsp; Edit Request</button>
                                                        <button class="del-btn easygo-rounded-1 easygo-fs-5 flex-grow-1 px-0"><i class="fa-solid fa-trash"></i> Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-item">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="easygo-badge-blue easygo-fs-5 ms-auto">Completed</span>
                                                    </div>
                                                    <div class="easygo-fs-4 py-3">
                                                        I am looking for Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, placerat elementum aliquam. Morbi nibh a nisi, ac ac scelerisque elementum aliquam. Morbi nibh a nisi, ac ac scelerisque....
                                                    </div>
                                                    <div class="easygo-fs-5 text-gray-1 d-flex align-items-center gap-1">
                                                        GHC 200 - GHC 500 <br>
                                                        2nd Jan - 3rd Jan &nbsp; &nbsp;
                                                        2 kids & 4 adults
                                                    </div>
                                                    <h5 class="easygo-fs-4 pt-3">You accepted a quote from <span class="easygo-fw-1">‘Lionize Tourism Consult’</span></h5>
                                                    <div class="d-flex gap-1 flex-wrap py-3">
                                                        <button class="easygo-rounded-1 easygo-fs-5 easygo-btn-1 py-1 easygo-fw-3 flex-grow-1 px-0"><i class="fa-solid fa-pen"></i> &nbsp; Edit Request</button>
                                                        <button class="del-btn easygo-rounded-1 easygo-fs-5 flex-grow-1 px-0"><i class="fa-solid fa-trash"></i> Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-item">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="easygo-fs-3 easygo-fw-1">0 Quotes received</h5>
                                                        <span class="easygo-badge-orange easygo-fs-5">Ongoing</span>
                                                    </div>
                                                    <div class="easygo-fs-4 py-3">
                                                        I am looking for Massa risus, imperdiet vestibulum, tristique nunc ut felis auctor quams cursus tincidunt quis ultrices adipiscing magna condimentum. Metus, eget pulvinar volutpat elementum, placerat elementum aliquam. Morbi nibh a nisi, ac ac scelerisque elementum aliquam. Morbi nibh a nisi, ac ac scelerisque....
                                                    </div>
                                                    <div class="easygo-fs-5 text-gray-1 d-flex align-items-center gap-1">
                                                        GHC 200 - GHC 500 <br>
                                                        2nd Jan - 3rd Jan &nbsp; &nbsp;
                                                        2 kids & 4 adults
                                                    </div>
                                                    <div class="d-flex gap-1 flex-wrap py-3">
                                                        <button class="easygo-btn-1 easygo-rounded-1 easygo-fs-5 px-2 w-100 my-2"><i class="fa-solid fa-eye"></i> &nbsp; View Quotes</button>
                                                        <button class="easygo-rounded-1 easygo-fs-5 easygo-btn-5 bg-lblue-1 py-1 easygo-fw-3 flex-grow-1 px-0"><i class="fa-solid fa-pen"></i> &nbsp; Edit Request</button>
                                                        <button class="del-btn easygo-rounded-1 easygo-fs-5 flex-grow-1 px-0"><i class="fa-solid fa-trash"></i> Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- | mobile | [end] -->
                                <!-- ============================== -->
                            </div>
                            <!-- private tour history [end] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- book private tour [start] -->
                            <div class="book-private-tour request-tour" style="display: none;">
                                <div>
                                    <button class="visibility-changer btn" data-visibility-target=".request-tour"><i class="fa-solid fa-chevron-left"></i> Back</button>
                                </div>
                                <div class="form-page-main container d-block">
                                    <div class="form-container container" style="max-width: 600px;">
                                        <form>
                                            <div class="form-header">
                                                <h5 class="easygo-fs-2 my-3">Book a private tour. Customize trips to your taste</h5>
                                            </div>
                                            <div class="form-input-field">
                                                <textarea class="border-blue" style="resize: none" cols="30" rows="7" placeholder="Trip description"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Number of Kids</div>
                                                        <div class="easygo-num-input">
                                                            <span data-input-target="#num-kids" class="icon-left plus"><i class="fa-solid fa-circle-plus"></i></span>
                                                            <input id="num-kids" type="number" class="border-blue text-center" value="1" min="0" max="100">
                                                            <span data-input-target="#num-kids" class="icon-right minus"><i class="fa-solid fa-circle-minus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Number of Adults</div>
                                                        <div class="easygo-num-input">
                                                            <span data-input-target="#num-adults" class="icon-left plus"><i class="fa-solid fa-circle-plus"></i></span>
                                                            <input id="num-adults" type="number" class="border-blue text-center" value="1" min="0" max="100">
                                                            <span data-input-target="#num-adults" class="icon-right minus"><i class="fa-solid fa-circle-minus"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">Start Date</div>
                                                        <div class="input-w-icon">
                                                            <label for="start-date" class="input-icon"><i class="fa-solid fa-calendar"></i></label>
                                                            <input id="start-date" type="date" class="border-blue">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-field">
                                                        <div class="text-gray-1 easygo-fs-5">End Date</div>
                                                        <div class="input-w-icon">
                                                            <label for="end-date" class="input-icon"><i class="fa-solid fa-calendar"></i></label>
                                                            <input id="end-date" type="date" class="border-blue">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-field">
                                                <div class="input-w-icon">
                                                    <label for="budget" class="input-icon"><i class="fa-solid fa-dollar-sign"></i></label>
                                                    <input id="budget" class="border-blue" name="user_name" type="text" placeholder="Budget">
                                                </div>
                                            </div>
                                            <div class="input-field button-container my-2">
                                                <button type="submit" class="easygo-btn-1 easygo-rounded-2" type="button">Place Request</button>
                                            </div>
                                        </form>
                                        <!-- register form 1 [end] -->
                                        <!-- ======================= -->
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
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../../assets/js/jquery-3.6.1.min.js"></script>
    <!-- Swiper js -->
    <script src="../../assets/js/swiper-bundle.min.js"></script>
    <!-- easygo js -->
    <script src="../../assets/js/general.js"></script>
    <script src="../../assets/js/home.js"></script>
    <script src="../../assets/js/functions.js"></script>
</body>

</html>