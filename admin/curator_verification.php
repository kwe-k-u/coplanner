<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/curator_interraction_controller.php");
require_once(__DIR__ . "/../controllers/admin_controller.php");

if (!is_session_logged_in()) {
    header("Location: ../views/home.php");
    die();
}

// $info = get_user_by_id(get_session_user_id());
$curator_id = get_session_account_id();
$user_name ="" ;//$info["user_name"];
$curator_name = "admin";//$info["curator_name"];
$logo = "";//$info["curator_logo"];




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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

            <?php require_once(__DIR__."/../components/admin_header.php"); ?>
            <?php require_once(__DIR__."/../components/admin_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
			<?php require_once(__DIR__. "/../components/admin_navbar_desktop.php"); ?>


            <div class="main-content px-3">
                <section class="trip-booking">
                    <div class="border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">Users</h5>
                            <small class="easygo-fs-5 text-gray-1"><a href="all_tours.php">Users</a> > All Users</small>
                        </div>
                        <p class="mt-4 mb-0">This table shows all user info.</p>
                    </div>
                    <div class="controls d-flex justify-content-between align-items-between py-3">
                        <div class="left-controls row">
                            <form id="dashboard-search">
                                <div class="form-input-field">
                                    <input class="p-2" type="text" placeholder="search">

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="trip-listing">
                        <div class="easygo-list-3 list-striped" style="min-width: 992px;">
                            <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                <div class="item-bullet-container">
                                    <div class="item-bullet"></div>
                                </div>
                                <div class="inner-item">Curator name</div>
                                <div class="inner-item">Incorporation document</div>
                                <div class="inner-item">Country</div>
                                <div class="inner-item">Actions</div>
                                <div class="inner-item">Actions</div>
                            </div>

                            <?php

                                $accounts = get_unverified_curators();

                                if (!$accounts){
                                    echo "<div class='list-item'>
                                        <div class='item-bullet-container'>
                                            <div class='item-bullet'></div>
                                        </div>
                                        <div class='inner-item'>There are no user Accounts. </div>
                                    </div>";
                                }else {
                                    foreach ($accounts as $entry) {
										$id = $entry["curator_id"];
										$curator = $entry['curator_name'];
										$logo = isset($entry["logo"]) ? $entry["logo"] : "";
										$doc = isset($entry["inc_doc"]) ? $entry["inc_doc"] : "";
										$country = $entry["country"];

                                        echo "
                                <div class='list-item'>
                                    <div class='item-bullet-container col'>
                                         <div class='item-bullet'></div>
										<div><img class='icon' src='$logo'></div>
                                    </div>
                                    <div class='inner-item'>
										<div class='col'>
											<div>
												$curator
											</div>
											<div>
												$id
											</div>
										</div>
									</div>
                                    <div class='inner-item'> <a href='$doc'>Document url</a></div>
                                    <div class='inner-item'>$country</div>
                                    <div class='inner-item'>
										<a href='#' onclick='toggle_curator_verification(\"$id\")'>Verify</a>
									</div>
                                    <div class='inner-item'>
										<a href='#'>Block Logins</a>
									</div>
                                </div>
                                    ";
                                    }
                                }
                            ?>


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
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/admin/verification.js"></script>
</body>

</html>