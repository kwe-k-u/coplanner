<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator - Dashboard | Transactions</title>
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
            <div class="logo logo-medium">
                <img class="img-fluid" src="../assets/images/svgs/logo.svg" alt="easygo logo">
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
        <header class="nav-menu d-lg-none">
            <div class="nav-menu-title bg-blue text-white easygo-fw-1 py-3 ps-3 d-flex justify-content-between">
                <h6 class="m-0">Dashboard</h6>
                <button data-target="dashboard-menu" class="burger-btn slide-down-btn">
                    <div></div>
                    <div></div>
                    <div></div>
                </button>
            </div>
            <div id="dashboard-menu" class="slide-down-sub-menu">
                <ul class="main-list">
                    <li>
                        <div class="slide-down-menu">
                            <a data-target="dashboard-submenu" class="slide-down-btn" href="#">
                                <img src="../assets/images//svgs/dashboard.svg" alt="dashboard image"> Dashboard <span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
                            <ul id="dashboard-submenu" class="sub-menu slide-down-sub-menu">
                                <li><a href="#">Trips</a></li>
                                <li><a href="#">Finance</a></li>
                                <li><a href="#">Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#"><img src="../assets/images/svgs/trips.svg" alt="trips icon"> Trips</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/finance.svg" alt="finance icon"> Finance</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/notifications.svg" alt="notifications icon">Notifications</a></li>
                </ul>
            </div>
        </header>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
            <aside class="sidebar d-lg-flex d-none flex-column justify-content-between">
                <ul class="main-list slide-down">
                    <li>
                        <div class="slide-down-menu">
                            <a data-target="dashboard-submenu-sb" class="slide-down-btn text-blue" style="border-right: solid 2px var(--easygo-blue);" href="#"><img src="../assets/images//svgs/dashboard.svg" alt="dashboard image"> Dashboard <span class="arrow"><img src="../assets/images/svgs/arrow-down.svg" alt="arrow down image"></span></a>
                            <ul id="dashboard-submenu-sb" class="sub-menu slide-down-sub-menu">
                                <li><a href="#">Trips</a></li>
                                <li><a href="#">Finance</a></li>
                                <li><a href="#">Notifications</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#"><img src="../assets/images/svgs/trips.svg" alt="trips icon"> Trips</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/finance.svg" alt="finance icon"> Finance</a></li>
                    <li><a href="#"><img src="../assets/images/svgs/notifications.svg" alt="notifications icon">Notifications</a></li>
                </ul>
                <div class="py-4 border-top">
                    <a class="easygo-fs-4 text-red" href="#"><img src="../assets/images/svgs/logout.svg" alt="logout icon"> Logout</a>
                </div>
            </aside>
            <div class="main-content px-3">
                <section class="trip-booking">
                    <div class="border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">All Transactions</h5>
                            <small class="easygo-fs-5 text-gray-1"><a href="#">Finance</a> > Transactions</small>
                        </div>
                        <p class="mt-4 mb-0">This table contains all the transactions associated with your trips. Export the data with any of the options below.</p>
                    </div>
                    <div class="controls d-flex justify-content-between align-items-between py-3">
                        <div class="left-controls">
                            <form id="dashboard-search">
                                <div class="form-input-field">
                                    <input class="p-2" type="text" placeholder="search">
                                </div>
                            </form>
                        </div>
                        <div class="right-controls d-flex gap-2">
                            <button class="btn border" type="button" id="viewby-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                Copy
                            </button>
                            <div class="dropdown">
                                <button class="btn border dropdown-toggle px-5" type="button" id="export-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                    Export
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="export-menu">
                                    <li><a class="dropdown-item" href="#">PDF</a></li>
                                    <li><a class="dropdown-item" href="#">Excel</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="viewby-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                    Column Visibility
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="viewby-menu">
                                    <!-- <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="./trip_booking_by_trip.php">Trips</a></li> -->
                                </ul>
                            </div>
                            <button class="easygo-btn-1 py-1 px-5">Print</button>
                        </div>
                    </div>
                    <div class="transaction-listing">
                        <div>
                            <ul class="nav nav-tabs easygo-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active easygo-fs-4 h-100" id="all-transactions-tab" data-bs-toggle="tab" data-bs-target="#all-transactions" type="button" role="tab" aria-controls="all-transactions" aria-selected="true">All Transactions</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100" id="booking-transactions-tab" data-bs-toggle="tab" data-bs-target="#booking-transactions" type="button" role="tab" aria-controls="booking-transactions" aria-selected="false">Booking Transactions</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100" id="withdrawals-tab" data-bs-toggle="tab" data-bs-target="#withdrawals" type="button" role="tab" aria-controls="withdrawals" aria-selected="false">Withdrawals</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!--- ================================ -->
                                <!--- all transactions [start] -->
                                <div class="tab-pane fade show active" id="all-transactions" role="tabpanel" aria-labelledby="description-tab">
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
                                </div>
                                <!--- all transactions [end] -->
                                <!--- ================================ -->
                                <!--- ================================ -->
                                <!--- booking transactions [start] -->
                                <div class="tab-pane fade" id="booking-transactions" role="tabpanel" aria-labelledby="booking-transactions-tab">
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
                                </div>
                                <!--- booking transactions [end] -->
                                <!--- ================================ -->
                                <!--- ================================ -->
                                <!--- withdrawals [start] -->
                                <div class="tab-pane fade" id="withdrawals" role="tabpanel" aria-labelledby="withdrawals-tab">
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
                                </div>
                                <!--- withdrawals [end] -->
                                <!--- ================================ -->
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
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
</body>

</html>