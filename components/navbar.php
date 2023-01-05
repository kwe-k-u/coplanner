<nav class="navbar navbar-expand-md fixed-top easygo-nav-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="./home.php">
            <img class="logo-medium" src="../assets/images/svgs/logo.svg" alt="">
        </a>
        <button class="navbar-toggler sidebar-toggler" type="button" data-target="main-sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-blue" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./trips.php">Trips</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Blog</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Curators</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./contact.php">Contact </a>
                </li>
            </ul>
            <div class="d-flex gap-4">
                <a href="../views/login.php" class="easygo-btn-4 border-blue text-blue easygo-fs-5">Login</a>
                <a href="../views/register.php" class="easygo-btn-5 bg-blue text-white easygo-fs-5">Create Account</a>
            </div>
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
</nav>

<!-- The side bar -->
<aside id="main-sidebar" class="sidebar sidebar-right bg-white d-md-none">
    <div class="sidebar-header py-3">
        <div class="log">
            <img class="logo-small" src="../assets/images/svgs/logo.svg" alt="easygo logo">
        </div>
        <button class="crossbars close-sidebar btn" data-target="main-sidebar">
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
    <nav class="sidebar-navbar">
        <div>
            <ul class="sidebar-nav-menu">
                <li class="s-nav-item border-top">
                    <a class="nav-link text-blue py-2 px-2 d-flex justify-content-between align-items-center" href="./home.php">Home <i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li class="s-nav-item  border-top">
                    <a class="nav-link py-2 px-2 d-flex justify-content-between align-items-center" href="./trips.php">Trips <i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li class="s-nav-item border-top">
                    <a class="nav-link py-2 px-2 d-flex justify-content-between align-items-center" href="javascript:void(0)">Blog <i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li class="s-nav-item border-top">
                    <a class="nav-link py-2 px-2 d-flex justify-content-between align-items-center" href="javascript:void(0)">Curators <i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li class="s-nav-item border-top">
                    <a class="nav-link py-2 px-2 d-flex justify-content-between align-items-center" href="./about.php">About <i class="fa-solid fa-angle-right"></i></a>
                </li>
                <li class="s-nav-item border-top">
                    <a class="nav-link py-2 px-2 d-flex justify-content-between align-items-center" href="./contact.php">Contact <i class="fa-solid fa-angle-right"></i></a>
                </li>
            </ul>
            <div class="d-flex flex-column gap-4 px-2 mt-5">
                <a href="../views/login.php" class="easygo-btn-4 border-blue text-blue">Login</a>
                <a href="../views/register.php" class="easygo-btn-5 bg-blue text-white">Create Account</a>
            </div>
        </div>
    </nav>
</aside>