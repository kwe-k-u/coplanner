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
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Blog</a>
                </li>
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
                <a href="../views/login.php" class="easygo-btn-4 border-blue text-blue">Login</a>
                <a href="../views/register.php" class="easygo-btn-5 bg-blue text-white">Create Account</a>
                </form>
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
                <li class="s-nav-item py-2 px-2 border-top d-flex justify-content-between align-items-center">
                    <a class="nav-link text-blue" href="./home.php">Home</a>
                    <span>></span>
                </li>
                <li class="s-nav-item py-2 px-2 border-top d-flex justify-content-between align-items-center">
                    <a class="nav-link" href="./trips.php">Trips</a>
                    <span>></span>
                </li>
                <li class="s-nav-item py-2 px-2 border-top d-flex justify-content-between align-items-center">
                    <a class="nav-link" href="javascript:void(0)">Blog</a>
                    <span>></span>
                </li>
                <li class="s-nav-item py-2 px-2 border-top d-flex justify-content-between align-items-center">
                    <a class="nav-link" href="javascript:void(0)">Curators</a>
                    <span>></span>
                </li>
                <li class="s-nav-item py-2 px-2 border-top d-flex justify-content-between align-items-center">
                    <a class="nav-link" href="./about.php">About</a>
                    <span>></span>
                </li>
                <li class="s-nav-item py-2 px-2 border-top d-flex justify-content-between align-items-center">
                    <a class="nav-link" href="./contact.php">Contact </a>
                    <span>></span>
                </li>
            </ul>
            <div class="d-flex flex-column gap-4 px-2 mt-5">
                <a href="../views/login.php" class="easygo-btn-4 border-blue text-blue">Login</a>
                <a href="../views/register.php" class="easygo-btn-5 bg-blue text-white">Create Account</a>
                </form>
            </div>
        </div>
    </nav>
</aside>