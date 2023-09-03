<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/curator_interraction_controller.php");
require_once(__DIR__ . "/../controllers/admin_controller.php");

if (!is_session_logged_in()) {
    header("Location: ../views/home.php");
    die();
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curators</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <!-- ============================== -->
    <!-- main-wrapper [start] -->
    <div class="main-wrapper">

        <?php require_once(__DIR__ . "/../components/admin_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
            <?php require_once(__DIR__ . "/../components/admin_navbar_desktop.php"); ?>


            <div class="main-content px-3">
                <section class="trip-booking">
                    <div class="border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">Curators</h5>
                            <small class="easygo-fs-5 text-gray-1"><a href="#">Admin</a> > Curator accounts</small>
                        </div>
                        <p class="mt-4 mb-0">This table shows information about curator accounts.</p>
                    </div>
                    <div class="controls d-flex justify-content-between align-items-between py-3">
                        <div class="left-controls">
                            <form id="dashboard-search">
                                <div class="form-input-field">
                                    <input class="p-2" type="text" placeholder="search">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="trip-listing">
                        <div class="easygo-list-3 list-striped accordion" style="min-width: 992px;">
                            <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                <div class="item-bullet-container">
                                    <div class="item-bullet"></div>
                                </div>
                                <div class="inner-item">Logo</div>
                                <div class="inner-item">Curator Name</div>
                                <div class="inner-item">Country</div>
                                <div class="inner-item">Number of tours</div>
                                <div class="inner-item">Number of bookings</div>
                                <div class="inner-item">Actions</div>
                            </div>

                            <?php

                            $curators = get_curators();

                            if (!$curators) {
                                echo "<div class='list-item'>
                                            <div class='item-bullet-container'>
                                                <div class='item-bullet'></div>
                                            </div>
                                            <div class='inner-item'>
                                                There are no curator accounts.
                                            </div>
                                        </div>";
                            } else {
                                foreach ($curators as $entry) {
                                    $revenue = $entry["revenue"] ?? 0;
                                    $num_bookings = $entry["num_bookings"] ?? 0;
                                    $curator_name = $entry["curator_name"];
                                    $num_admins = $entry["num_admins"];
                                    $country = $entry["country"];
                                    $curator_id = $entry["curator_id"];
                                    $num_tours = $entry["num_tours"] ?? 0;
                                    $currency = "GHS";
                                    $verified = $entry["is_verified"];
                                    $c_id = $entry["curator_id"];

                                    echo "
                                <div class=' accordion-item'>
                                    <div class='list-item'>
                                        <div class='item-bullet-container'>
                                            <div class='item-bullet'></div> <!-- Verification ID -->
                                        </div>
                                        <div class='inner-item'>logo</div>
                                        <div class='inner-item'>
                                            $curator_name
                                        </div>
                                        <div class='inner-item text-capitalize'>$country</div>
                                        <div class='inner-item '>$num_tours</div>
                                        <div class='inner-item '>$num_bookings</div>
                                        <div class='inner-item'>
                                            <a href='#' data-bs-toggle='collapse' data-bs-target='#curator_info_$c_id'>Expand</a>
                                        </div>
                                    </div>
                                    <div class='accordion-collapse collapse show' id='curator_info_$c_id'>
                                        <div class='accordion-body row'>
                                            <div class='col-6'>
                                                <div>Curator ID: $c_id</div>
                                                <div>Revenue: $currency $revenue</div>
                                            </div>
                                            <div class='col-6'>
                                                <div>
                                                    <a href='#' class='easygo-fs-5 easygo-fw-2' data-bs-toggle='modal' data-bs-target='#invite-collaborator-modal' onclick='set_curator_invite_id(\"$c_id\")'>Invite collaborator</a>
                                                </div>
                                                <div><a href='group_tours.php?curator_id=$c_id' class='easygo-fs-5 easygo-fw-2'>View Listings</a></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class='list-item'>
                                                <div class='inner-item'>email@user.com</div>
                                                <div class='inner-item'>Person name</div>
                                                <div class='inner-item'>Last Login: DD/ MMM /YYYY</div>
                                                <div class='inner-item'><a href='#'>Suspend</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    ";
                                }
                            }
                            ?>




                        </div>

                    </div>
                </section>
            </div>


            <!-- Invite_collaborator_modal modal [end] -->
            <!-- ============================== -->
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
    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/admin/curators.js"></script>

            <!-- ============================== -->
            <!-- Curator invite modal [start] -->
            <div class="modal fade" id="invite-collaborator-modal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content p-5">
                        <div class="col">
                            <div>
                                <div style='overflow-x: auto;'>
                                </div>
                                <h6 class="easygo-fw-1 m-0">Invite A Collaborator</h6>
                                <small class="text-gray-1 easygo-fs-6">(Add another person to manage your account)</small>
                                <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                <form onsubmit='invite_collaborator(this)'>
                                <input type="hidden" name="curator_id" id="invite_modal_curator_id">
                                    <div class="col-lg-7 d-flex flex-column gap-4">
                                        <div class="form-input-field">
                                            <div class="text-gray-1 easygo-fs-4">Collaborator Email</div>
                                            <input type="email" name="email" placeholder="example@easygo.com">
                                        </div>
                                    </div>


                                    <div class="col-lg-7 d-flex flex-column gap-4">
                                        <div class="form-input-field">
                                            <div class="text-gray-1 easygo-fs-4">Collaborator Role</div>

                                            <select name="collaborator_role">
                                                <option value="admin">Admin</option>
                                                <option value="edit">Edit</option>
                                                <option value="view">View</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 align-items-center mt-4">
                                        <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="py-2 easygo-btn-1 border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Send Invite</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Invite_collaborator_modal modal [end] -->
                <!-- ============================== -->
            </div>
</body>

</html>