<?php
require_once(__DIR__ . "/../../utils/core.php");
require_once(__DIR__."/../../controllers/auth_controller.php");
login_check();

$user_id = get_session_user_id();
$user = get_user_by_id($user_id);
$profile = $user["profile_image"];
$user_name = $user["user_name"];
$email = $user["email"];
$phone = $user["phone_number"];
$country = $user["country"];
$email_verified = $user["email_verified"] == 1;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - Account Settings</title>
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
                <h5>Account Settings</h5>
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./private_tour.php"><i class="fa-solid fa-car"></i> Private Tour</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./saved_trips.php"><i class="fa-solid fa-bookmark"></i>Saved Trips</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./notifications.php"><i class="fa-solid fa-bell"></i>Notifications</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
                                </li>
                                <li class="s-nav-item px-3 py-2">
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 text-red" onclick="return logout()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="d-flex justify-content-center my-3 d-md-none">
                    </div>
                </aside>
                <!-- sidebar [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- dashboard content [start] -->
                <main class="main-content bg-gray-3">
                    <div class="px-lg-5 px-2">
                        <div class="main-content-header d-flex justify-content-between align-items-center py-4 d-none d-md-flex">
                            <h3 class="m-0">Account Settings</h3>
                        </div>
                        <div class="main-content-body py-2">
                            <div class="mb-5">
                                <button class="btn page-reloader"><i class="fa-solid fa-chevron-left"></i> Back</button>
                            </div>
                            <!-- ============================== -->
                            <!-- profile form [start] -->
                            <div class="form-page-main container update-pass-or-profile" style="display: block;">
                                <div class="form-container container" style="max-width: 600px;">

                                    <!-- register form 1 [start] -->
                                    <form class='reg-form edit-or-update-profile' action="../../processors/processor.php" method="post" style="display:none">
                                        <?php
                                            echo "

                                        <div class='profile_img-upload edit-or-update-profile py-4' visible-mode='flex' style='display: none;'>
                                            <div class='profile_img-disp'>
                                                <img id='register-profile_img' class='image-display' src='$profile' alt='profile image'>
                                                <label class='profile_img-upload-btn' for='profile_img'><img src='../../assets/images/svgs/pen_line.svg' alt='pen line image'></label>
                                                <input display-target='register-profile_img' class='profile_img-file' name='profile_img' id='profile_img' type='file' accept='.jpg, .jpeg, .png'>
                                            </div>
                                        </div>
                                        <div class='input-field'>
                                            <label class='text-gray-1 fs-7' for='user_name'>Username</label>
                                            <input disabled class='border-blue profile-form-field' name='user_name' type='text' placeholder='Full Name' value='$user_name'>
                                        </div>
                                        <div class='input-field'>
                                            <label class='text-gray-1 fs-7' for='email'>Email</label>
                                            <a href='' class='easygo-fs-5 mb-4' style='color:red'>Verify Email?</a>
                                            <input disabled type='text' class='border-blue profile-form-field' name='email' placeholder='Email address' value='$email'>
                                        </div>
                                        <div class='input-field'>
                                            <label class='text-gray-1 fs-7' for='email'>Phone Number</label>
                                            <a href='' class='easygo-fs-5 mb-4' style='color:red'>Verify Phone Number?</a>
                                            <input disabled type='text' class='border-blue profile-form-field' name='phone' placeholder='Telephone' value='$phone'>
                                        </div>
                                        <div class='input-field'>
                                            <label class='text-gray-1 fs-7'for=''>Country</label>
                                            <input disabled type='text' class='border-blue profile-form-field' name='phone' placeholder='Country' value='$country'>
                                        </div>
                                        <input type='hidden' name='action' value='update_profile'>

                                        <div class='input-field button-container'>
                                            <button class='easygo-btn-1 easygo-rounded-2 input-enabler visibility-changer edit-or-update-profile' type='submit' data-enable-target='.profile-form-field' data-visibility-target='.edit-or-update-profile' style='display: none;'>Update Profile</button>
                                        </div>
                                        "
                                        ?>
                                    </form>



                                    <form>

                                    <div class='justify-content-center edit-or-update-profile' style='display: flex' visible-mode='flex'>
                                            <div class='row'>
                                                <?php

                                                echo "<div class='col-4 col-md-12'>
                                                    <div class='user-icon bg-blue m-auto' style='width: 5rem; height: 5rem;'>
                                                        <img src='$profile' alt='Profile image'>
                                                    </div>
                                                </div>
                                                <div class='col-8 col-md-12'>
                                                    <div class='text-left text-md-center'>
                                                        <h2>$user_name</h2>
                                                        <p class='easygo-fs-4 text-gray-1'>$email</p>
                                                    </div>
                                                </div>"

                                                ?>
                                            </div>
                                        </div>

                                    <div class='input-field button-container'>
                                                <button class='easygo-btn-1 easygo-rounded-2 input-enabler visibility-changer edit-or-update-profile' type='button' data-enable-target='.profile-form-field' data-visibility-target='.edit-or-update-profile'>Edit Profile</button>
                                                <center>
                                                    <div visible-mode='flex' class='justify-content-center edit-or-update-profile'><a class='text-black easygo-fw-3 visibility-changer' href='javascript:void(0);' data-visibility-target='.update-pass-or-profile'>Change Password</a></div>
                                                </center>
                                            </div>
                                    </form>
                                    <!-- register form 1 [end] -->
                                    <!-- ======================= -->
                                </div>
                            </div>
                            <!-- profile form [end] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- change password [start] -->
                            <div class="form-page-main container update-pass-or-profile" style="display: none;">
                                <div class="form-container container" style="max-width: 600px;">
                                    <form onsubmit="return change_password_signed_in(this)">
                                        <div class="input-field">
                                            <div class="password-input-container">
                                                <input name="current_password" type="password" placeholder="Current Password" class="border-blue">
                                                <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                        <div class="input-field">
                                            <div class="password-input-container">
                                                <input name="new_password" type="password" placeholder="New Password" class="border-blue">
                                                <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                        <div class="input-field">
                                            <div class="password-input-container">
                                                <input name="confirm_password" type="password" placeholder="Confirm Password" class="border-blue">
                                                <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                                            </div>
                                        </div>
                                        <div class="input-field button-container">
                                            <button class="easygo-btn-1 easygo-rounded-2" type="submit">Update Password</button>
                                        </div>
                                    </form>
                                    <!-- register form 1 [end] -->
                                    <!-- ======================= -->
                                </div>
                            </div>
                            <!-- change password [end] -->
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
    <?php require_once(__DIR__ . "/../../utils/js_env_variables.php"); ?>
    <script src="../../assets/js/general.js"></script>
    <script src="../../assets/js/home.js"></script>
    <script src="../../assets/js/functions.js"></script>
    <script src="../../assets/js/user_auth.js"></script>
</body>

</html>