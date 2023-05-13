<?php
	require_once(__DIR__."/../../utils/core.php");
	require_once(__DIR__."/../../controllers/auth_controller.php");
	require_once(__DIR__."/../../controllers/private_tour_controller.php");
	require_once(__DIR__."/../../controllers/media_controller.php");
    require_once(__DIR__."/../../controllers/interaction_controller.php");
	login_check();

	$user_id = get_session_user_id();
	$user_name = get_username_by_id($user_id);
	$profile = get_user_profile_img($user_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - Notifications</title>
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
                <h5>Notifications</h5>
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3" href="./dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
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
                                    <a class="nav-link py-3 px-4 d-flex align-items-center justify-content-start gap-3 easygo-btn-1" href="./notifications.php"><i class="fa-solid fa-bell"></i>Notifications</a>
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
                        <?php
                            echo "<div class='user-icon bg-blue'>
                                        <img src='$profile' alt=''>
                                    </div>
                                    <div class='d-flex flex-column justify-content-center gap-1'>
                                        <h5 class='easygo-fs-4 m-0'>$user_name</h5>
                                        <h6 class='text-gray-1 easygo-fs-5 m-0'>User profile</h6>
                                    </div>";
                        ?>
                    </div>
                </aside>
                <!-- sidebar [end] -->
                <!-- ============================== -->
                <!-- ============================== -->
                <!-- dashboard content [start] -->
                <main class="main-content bg-gray-3">
                    <div class="px-lg-5 px-2">
                        <div class="main-content-header d-flex justify-content-between align-items-center py-4 d-none d-md-flex">
                            <h3 class="m-0">Notifications</h3>
                            <div class="d-flex justify-content-center my-3">
                        <?php
                            echo "<div class='user-icon bg-blue'>
                                        <img src='$profile' alt=''>
                                    </div>
                                    <div class='d-flex flex-column justify-content-center gap-1'>
                                        <h5 class='easygo-fs-4 m-0'>$user_name</h5>
                                        <h6 class='text-gray-1 easygo-fs-5 m-0'>User profile</h6>
                                    </div>";
                        ?>
                            </div>
                        </div>
                        <div class="main-content-body py-2">
                            <!-- ============================== -->
                            <!-- notification group [start] -->
                            <div class="notification-group mt-5" style="margin-bottom: 7rem;">
                                <div class="notification-group-header d-flex justify-content-center align-items-center gap-1">
                                    <span class="bg-black rounded-circle" style="width:7px; height: 7px"></span>
                                    Today
                                    <span class="bg-black rounded-circle" style="width:7px; height: 7px"></span>
                                </div>
                                <div class="notifications d-flex flex-column gap-4">
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                </div>
                            </div>
                            <!-- notification group [end] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- notification group [start] -->
                            <div class="notification-group mt-5" style="margin-bottom: 7rem;">
                                <div class="notification-group-header d-flex justify-content-center align-items-center gap-1">
                                    <span class="bg-black rounded-circle" style="width:7px; height: 7px"></span>
                                    Yesterday
                                    <span class="bg-black rounded-circle" style="width:7px; height: 7px"></span>
                                </div>
                                <div class="notifications d-flex flex-column gap-4">
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                </div>
                            </div>
                            <!-- notification group [end] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- notification group [start] -->
                            <div class="notification-group mt-5" style="margin-bottom: 7rem;">
                                <div class="notification-group-header d-flex justify-content-center align-items-center gap-1">
                                    <span class="bg-blue rounded-circle" style="width:7px; height: 7px"></span>
                                    01 - 12 - 2022
                                    <span class="bg-blue rounded-circle" style="width:7px; height: 7px"></span>
                                </div>
                                <div class="notifications d-flex flex-column gap-4">
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                    <div class="notification-item py-3 border-bottom border-blue">
                                        <div class="notification-header d-flex align-items-center justify-content-between my-2">
                                            <div class="easygo-fs-1">Notification info</div>
                                            <div>
                                                <button class="del-btn easygo-rounded-1"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </div>
                                        </div>
                                        <div class="easygo-fs-5 text-gray-1 my-2">From easyGo</div>
                                        <div class="my-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, nisi. Praesentium ullam blanditiis dolore delectus, temporibus placeat vel vero perspiciatis. Quos ex quaerat ipsam nostrum voluptate natus vel aliquid ipsum, tempora impedit nam corrupti dolorum culpa recusandae porro exercitationem facilis minima nobis! Voluptate voluptatem rerum officiis sint modi, accusamus vel.</div>
                                    </div>
                                </div>
                            </div>
                            <!-- notification group [end] -->
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
    <?php require_once(__DIR__."/../../utils/js_env_variables.php"); ?>
    <script src="../../assets/js/general.js"></script>
    <script src="../../assets/js/home.js"></script>
    <script src="../../assets/js/functions.js"></script>
</body>

</html>