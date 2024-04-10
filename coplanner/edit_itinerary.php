<?php

require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");

$mixpanel = new mixpanel_class();
$mixpanel->log_page_view();

if (!isset($_GET["id"])) {
    header("Location: ../index.php");
    die();
}
$itinerary_id = $_GET["id"];
$itinerary = get_itinerary_by_id($itinerary_id);
$name = $itinerary["itinerary_name"] ?? "Untitled";
$participants = $itinerary["num_of_participants"];
$day_count = $itinerary["num_days"];
$cost = format_string_as_currency_fn($itinerary["budget"]);
$first_day = $itinerary["first_day"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <?php include_once(__DIR__ . "/../utils/analytics/google_head_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerary Creation</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body class="bg-gray-3">
    <?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once("./coplanner_navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main class="container-fluid" style="margin-top: 7rem;">
            <div class="row my-4">
                <div class="col-4 py-2 d-flex justify-content-center">
                    <button class="d-flex flex-column justify-content-center align-items-center gap-1 border-0 rounded-circle box-shadow-3 d-lg-none" style="width: 40px; height: 40px;" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuCanvas" aria-controls="mobileMenuCanvas">
                        <div class="bg-blue" style="padding: 0.06rem 0.8rem"></div>
                        <div class="bg-blue" style="padding: 0.06rem 0.8rem"></div>
                        <div class="bg-blue" style="padding: 0.06rem 0.8rem"></div>
                    </button>
                </div>
                <div class="col-4 py-2 d-flex justify-content-center">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="easygo-fs-4">
                            <?php echo "<span class='easygo-editable-text' onchange='update_itinerary_name(this.innerText)'>$name</span>/ <span class='selected-day-display'>Day one</span>"; ?>
                        </div>

                        <!--- ================================ -->
                        <!-- Day selection button[start] -->
                        <div class="d-none d-lg-block">
                            <div class="dropdown">
                                <a href='#' class='easygo-btn-4 border-blue text-blue easygo-fs-5 py-1 dropdown-toggle' data-bs-toggle="dropdown" aria-expanded="false">Select Day</a>
                                <ul class="dropdown-menu easygo-fs-4" id='day-dropdown-options'>
                                    <?php
                                    $day_list = get_itinerary_days($itinerary_id);
                                    echo "
                                        <li class='px-2 d-flex align-items-center' data-day-id='$first_day'>
                                            <a class='dropdown-item d-flex gap-1 align-items-center border-bottom  border-blue' href='#'>
                                                <span class='text-blue me-1'><i class='fa-solid fa-ellipsis-vertical'></i> <i class='fa-solid fa-ellipsis-vertical'></i></span>
                                                <span class='me-3 anchor-day-span'>Day One</span>
                                                <span id='selected-dropdown-label-desktop' class='badge d-inline text-white bg-blue easygo-fs-6 text-uppercase'>Selected</span>
                                            </a>
                                        </li>
                                        ";


                                    foreach (array_slice($day_list, 1) as $d) {
                                        $day_id = $d["day_id"];
                                        echo "
                                            <li class='px-2 d-flex align-items-center' data-day-id='$day_id'>
                                                <a class='dropdown-item d-flex gap-1 align-items-center border-bottom  border-blue' href='#'>
                                                    <span class='text-blue me-1'><i class='fa-solid fa-ellipsis-vertical'></i> <i class='fa-solid fa-ellipsis-vertical'></i></span>
                                                    <span class='me-3 anchor-day-span'>Day Two</span>
                                                </a>
                                            </li>
                                            ";
                                    }



                                    ?>
                                    <li class="px-2 d-flex align-items-center add-day-option" id='add-day-option'>
                                        <a class="dropdown-item add-day-option" href="#">
                                            <span class="text-orange add-day-option">Add extra day</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Day selection button[end] -->
                        <!--- ================================ -->
                    </div>
                </div>
                <div class="col-4 py-2 d-flex justify-content-center">
                    <div class="d-flex align-items-center gap-2">
                        <!-- Button for desktop display of ai suggestion  -->
                        <button class="box-shadow-3 d-none d-lg-flex justify-content-center align-items-center border-0 " style="width: 40px; height: 40px; border-radius: 50%;" data-proxy-target="sentiment-tab">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.74967 4.33325L12.458 10.2916L18.4163 12.9999L12.458 15.7083L9.74967 21.6666L7.04134 15.7083L1.08301 12.9999L7.04134 10.2916L9.74967 4.33325ZM9.74967 9.56575L8.66634 11.9166L6.31551 12.9999L8.66634 14.0833L9.74967 16.4341L10.833 14.0833L13.1838 12.9999L10.833 11.9166L9.74967 9.56575ZM20.583 9.74992L19.218 6.78159L16.2497 5.41658L19.218 4.06242L20.583 1.08325L21.9372 4.06242L24.9163 5.41658L21.9372 6.78159L20.583 9.74992ZM20.583 24.9166L19.218 21.9482L16.2497 20.5833L19.218 19.2291L20.583 16.2499L21.9372 19.2291L24.9163 20.5833L21.9372 21.9482L20.583 24.9166Z" fill="#1204B5" />
                            </svg>
                        </button>
                        <!-- Button for mobile display of ai suggestion section  -->
                        <?php
                        echo "
                        <div class='col justify-content-center align-items-center' onclick='goto_page(\"coplanner/itinerary_settings.php?id=$itinerary_id\")'>
                            <button class='box-shadow-3 d-flex d-lg-none justify-content-center align-items-center border-0 ' style='width: 40px; height: 40px; border-radius: 50%;'>
                                    <i class='fa fa-check color-red'></i>
                            </button>
                            <span class=' d-flex d-lg-none'>Finalise Trip </span>
                        </div>
                        <button class='d-none d-lg-inline easygo-btn-3 text-white easygo-fs-4 py-2 px-5' onclick='goto_page(\"coplanner/itinerary_settings.php?id=$itinerary_id\")'>Finalise Trip</button>
                        "; ?>
                    </div>
                </div>
            </div>

            <!--- ================================ -->
            <!-- mobile sidebar [start] -->
            <?php
            echo "
                <div class='d-flex justify-content-between p-3 box-shadow-3 mx-auto rounded-3 gap-5 d-lg-none w-100' style='max-width: 500px;'>
                    <div class='d-flex flex-column justify-content-center align-items-center'>
                        <div>
                            <i class='fa-solid fa-wallet text-blue easygo-fs-1'></i>
                        </div>
                        <div class='easygo-fs-4 expand-toggle-rev'>GHS <span class='budget-span'>$cost</span></div>
                    </div>
                    <div class='d-flex flex-column justify-content-center align-items-center'>
                        <div>
                            <i class='fa-solid fa-calendar text-blue easygo-fs-1'></i>
                        </div>
                        <div class='easygo-fs-4 expand-toggle-rev'><span class='day-span'>$day_count</span> days</div>
                    </div>
                    <div class='d-flex flex-column justify-content-center align-items-center'>
                        <div>
                            <i class='fa-solid fa-users text-blue easygo-fs-1'></i>
                        </div>
                        <div class='easygo-fs-4 expand-toggle-rev'><span class='people-span'>$participants</span> Person</div>
                    </div>
                </div>
                ";
            ?>
            <!-- mobile sidebar [end] -->
            <!--- ================================ -->
            <div>
                <div class="d-flex gap-2">
                    <!--- ================================ -->
                    <!-- sidebar [start] -->
                    <aside id='itinerary-sidebar' class='shrinkable-sidebar-280 shrinkable-sidebar h-100 mt-3 d-none d-lg-block box-shadow-3' style='max-height: 100%'>
                        <div class='bg-blue position-relative' style='height: 2rem'>
                            <button class='d-flex flex-column justify-content-center bg-blue align-items-start gap-1 h-100 border-0 shrinkable-sidebar-toggler' style='right: -2.8rem; top: 0' data-target="itinerary-sidebar">
                                <div class="bg-white" style="padding: 0.06rem 1rem"></div>
                                <div class="bg-white" style="padding: 0.06rem 1rem"></div>
                                <div class="bg-white" style="padding: 0.06rem 1rem"></div>
                            </button>
                        </div>
                        <div class="bg-white easygo-scroll-bar" style="height: 48rem; overflow-y: auto; overflow-x:hidden;">
                            <div class=" py-3">
                                <h5 class="easygo-fw-1 py-2 sec-title"><span class="expand-d-none">Itinerary</span> <span>Overview</span></h5>
                                <hr class="border-3 border-blue opacity-100 mx-2">
                                <?php
                                echo "
                                    <div class='ss-section'>
                                        <div class='ss-left'>
                                            <div class='d-flex flex-column justify-content-center align-items-center'>
                                                <div>
                                                    <i class='fa-solid fa-wallet text-blue easygo-fs-1'></i>
                                                </div>
                                                <div class='easygo-fs-4 expand-toggle'>Budget</div>
                                                <div class='easygo-fs-4 expand-toggle-rev'>GHS <span class='budget-span'>$cost</span></div>
                                            </div>
                                        </div>
                                        <div class='ss-right'>
                                            <div class='d-flex align-items-center h-100'>
                                                <h5>GHS <span class='budget-span'>$cost</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='ss-section'>
                                        <div class='ss-left'>
                                            <div class='d-flex flex-column justify-content-center align-items-center'>
                                                <div>
                                                    <i class='fa-solid fa-calendar text-blue easygo-fs-1'></i>
                                                </div>
                                                <div class='easygo-fs-4 expand-toggle'>Duration</div>
                                                <div class='easygo-fs-4 expand-toggle-rev'><span class='day-span'>$day_count</span> days</div>
                                            </div>
                                        </div>
                                        <div class='ss-right'>
                                            <div class='d-flex align-items-center h-100'>
                                                <h5><span class='day-span'>$day_count</span> days</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='ss-section'>
                                        <div class='ss-left'>
                                            <div class='d-flex flex-column justify-content-center align-items-center'>
                                                <div>
                                                    <i class='fa-solid fa-users text-blue easygo-fs-1'></i>
                                                </div>
                                                <div class='easygo-fs-4 expand-toggle'>People</div>
                                                <div class='easygo-fs-4 expand-toggle-rev'><span class='people-span'>$participants</span> Person</div>
                                            </div>
                                        </div>
                                        <div class='ss-right'>
                                            <div class='d-flex align-items-center h-100'>
                                                <h5><span class='people-span'>$participants</span> Person</h5>
                                            </div>
                                        </div>
                                    </div>
                                    ";
                                ?>
                                <h5 class='py-2 sec-title'><span class="expand-d-none">Additional</span> <span>Services</span></h5>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev">Curator</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex flex-column justify-content-center h-100">
                                            <h6 class="easygo-fw-1 mb-0">Curator</h6>
                                            <div>easyGo Tours</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev">Accomodation</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="easygo-fw-1 mb-0">Accomodation</h6>
                                            <div>
                                                <div class="easygo-fs-4">AH Hotel</div>
                                                <div class="easygo-fs-5">Day 1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev">Transportation</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="easygo-fw-1 mb-0">Transportation</h6>
                                            <div>
                                                <div class="easygo-fs-4">AH Hotel</div>
                                                <div class="easygo-fs-5">Day 1</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-3 border-blue opacity-100 mx-2">
                                <div class="ss-section">
                                    <div class="ss-left">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="user-icon bg-gray-1"></div>
                                            <div class="easygo-fs-5 expand-toggle-rev text-center">5 new <br>messages</div>
                                        </div>
                                    </div>
                                    <div class="ss-right">
                                        <div class="col-9 d-flex flex-column justify-content-center">
                                            <h6 class="easygo-fw-1 mb-0">Collab Chat</h6>
                                            <div class="easygo-fs-5">5 new messages</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- sidebar [end] -->
                    <!--- ================================ -->



                    <!--- ================================ -->
                    <!-- main-content [start] -->
                    <section style="flex: 1">
                        <div class="row">
                            <!--- ================================ -->
                            <!-- Itinerary Exp [start] -->
                            <div class="col-lg-6 p-3">
                                <div class="bg-white p-5 box-shadow-3 easygo-scroll-bar" style="height: 50rem; overflow-y: auto;">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto">
                                            <h3 class="easygo-fw-1 d-inline selected-day-display">
                                                Day One
                                            </h3>
                                        </div>
                                        <div class="col-auto py-2 text-end">
                                            <!-- desktop add activity button  -->
                                            <button class="border-0 bg-transparent  d-none d-lg-flex" data-proxy-target="destination-tab">
                                                <a href="#" data-proxy-target="destination-tab">Add Activities</a>
                                            </button>
                                            <!-- mobile add activity button  -->
                                            <button class="border-0 bg-transparent  d-flex d-lg-none" data-proxy-target="destination-tab" data-bs-toggle="offcanvas" data-bs-target="#destinationSearchCanvas" aria-controls="destinationSearchCanvas">
                                                <a href="#" data-proxy-target="destination-tab">Add Activities</a>
                                            </button>
                                        </div>
                                    </div>

                                    <div>Here is the summary of the activities and destinations selected for the day </div>
                                    <ul class="easygo-list-4" id='itinerary-card-activity-list'>
                                        <?php
                                        $day_info = get_itinerary_day_info($first_day);

                                        foreach ($day_info["destinations"] as $destination) {
                                            $des_id = "destination_" . $destination["destination_id"];
                                            $des_name = $destination["destination_name"];
                                            $activity_text = "";

                                            foreach ($destination["activities"] as $activity) {
                                                $act_name = $activity["activity_name"];
                                                $act_id = "activity_" . $activity["activity_id"];
                                                $activity_text .= "
                                                    <span id='$act_id' class='badge bg-blue easygo-fw-3 px-4 py-2'>$act_name</span>
                                                    ";
                                            }

                                            echo "
                                                    <li id='$des_id'>
                                                        <div class='row'>
                                                            <div class='col-4'>
                                                                <h5>$des_name</h5>
                                                                <div class='easygo-fs-5 d-flex justify-content-between align-items-center'>
                                                                    <div class='col'>
                                                                        <div>8:00 AM</div>
                                                                        <!-- <div>GHS 500</div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='col-8'>
                                                                <div class='row'>
                                                                    <div class='col-4'>
                                                                        <img src='../assets/images/others/tour2.jpg' class='img-fluid' alt=''>
                                                                    </div>
                                                                    <div class='col-4'>
                                                                        <img src='../assets/images/others/tour2.jpg' class='img-fluid' alt=''>
                                                                    </div>
                                                                    <div class='col-4'>
                                                                        <img src='../assets/images/others/tour2.jpg' class='img-fluid' alt=''>
                                                                    </div>
                                                                </div>
                                                                <div class='mt-3'>
                                                                    Here is the summary of the activities and destinations selected for the day
                                                                </div>
                                                            </div>
                                                            <div class='mt-2'>
                                                                $activity_text
                                                            </div>
                                                        </div>
                                                    </li>
                                                ";
                                        }

                                        // if no destinations or activities have been added to this day, display default prompt
                                        if ($day_info["destinations"] == array()) {
                                            echo "
                                                <li id='default-itinerary-list'>
                                                    <div>
                                                        <h5>Add a destination</h5>
                                                        <p class=>Add a destination or an activity from the right to populate this section</p>
                                                    </div>
                                                </li>
                                                ";
                                        }
                                        ?>
                                        <!-- <li>
                                            <div class="row">
                                                <div class="col-4">
                                                    <h5>Shai Hills</h5>
                                                    <p class="easygo-fs-5">8:00 AM</p>
                                                </div>
                                                <div class="col-8">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="col-4">
                                                            <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="col-4">
                                                            <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        Here is the summary of the activities and destinations selected for the day
                                                    </div>
                                                </div>
                                            </div>

                                            <div class='py-2 bg-lblue-1 text-blue text-center'>
                                                <a href='#'  data-bs-toggle='modal' data-bs-target='#dest-1-modal'>--- Add activities ---</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-4">
                                                    <h5>Asenema Waterfall</h5>
                                                    <div class="easygo-fs-5 d-flex justify-content-between align-items-center">
                                                        <div>8:00 AM</div>
                                                        <button class="border-0 bg-transparent" data-proxy-target="itinerary-poll-tab">
                                                            <svg width="30" height="30" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M28.3333 24.0835C29.8917 24.0835 31.1667 22.8085 31.1667 21.2502V5.66683C31.1667 4.1085 29.8917 2.8335 28.3333 2.8335H13.4583C13.8833 3.6835 14.1667 4.67516 14.1667 5.66683H28.3333V21.2502H15.5833V24.0835M21.25 9.91683V12.7502H12.75V31.1668H9.91667V22.6668H7.08333V31.1668H4.25V19.8335H2.125V12.7502C2.125 11.1918 3.4 9.91683 4.95833 9.91683H21.25ZM11.3333 5.66683C11.3333 7.22516 10.0583 8.50016 8.5 8.50016C6.94167 8.50016 5.66667 7.22516 5.66667 5.66683C5.66667 4.1085 6.94167 2.8335 8.5 2.8335C10.0583 2.8335 11.3333 4.1085 11.3333 5.66683ZM24.0833 8.50016H26.9167V19.8335H24.0833V8.50016ZM19.8333 14.1668H22.6667V19.8335H19.8333V14.1668ZM15.5833 14.1668H18.4167V19.8335H15.5833V14.1668Z" fill="#1204B5" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="col-4">
                                                            <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                        </div>
                                                        <div class="col-4">
                                                            <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        Here is the summary of the activities and destinations selected for the day
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                    <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                    <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                    <span class="badge bg-blue easygo-fw-3 px-4 py-2">Hike</span>
                                                </div>
                                            </div>
                                        </li> -->
                                    </ul>

                                </div>
                            </div>
                            <!-- Itinerary Exp [end] -->
                            <!--- ================================ -->
                            <!--- ================================ -->
                            <!-- Right Section card [start] -->
                            <div class="d-none d-lg-block col-lg-6 p-3">
                                <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="itinerary-poll-tab" data-bs-toggle="tab" data-bs-target="#itinerary-poll-tab-pane" type="button" role="tab" aria-controls="itinerary-poll-tab-pane" aria-selected="false">Home</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sentiment-tab" data-bs-toggle="tab" data-bs-target="#sentiment-tab-pane" type="button" role="tab" aria-controls="sentiment-tab-pane" aria-selected="false">Profile</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="destination-tab" data-bs-toggle="tab" data-bs-target="#destination-tab-pane" type="button" role="tab" aria-controls="destination-tab-pane" aria-selected="true">Profile</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">


                                    <!--- ================================ -->
                                    <!-- Itinerary poll panel  [start] -->
                                    <div class="tab-pane fade" id="itinerary-poll-tab-pane" role="tabpanel" aria-labelledby="itinerary-poll-tab-pane">
                                        <div class="bg-white p-5 box-shadow-3 easygo-scroll-bar" style="height: 50rem; overflow-y: auto;">
                                            <h3 class="easygo-fw-1">
                                                Itinerary Poll
                                            </h3>
                                            <div>A change has been suggested by a collaborator. You can choose option to maintain</div>
                                            <div class="suggestion-cards-container">
                                                <div class="suggestion-card my-3">
                                                    <div class="suggestion-card-header">
                                                        Suggested by <span class="text-blue">Kweku</span>
                                                    </div>
                                                    <div class="suggestion-card-location">
                                                        Shai Hills
                                                    </div>
                                                    <div class="suggestion-card-body">
                                                        <p>
                                                            Here is the summary of the activities and destinations selected for the day
                                                        </p>
                                                        <div class="suggestion-card-activities">
                                                            <div class="mt-2">
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button class="easygo-btn-5 bg-blue text-white easygo-fs-5">Accept</button>
                                                    </div>
                                                </div>
                                                <div class="suggestion-card my-3">
                                                    <div class="suggestion-card-header">
                                                        Suggested by <span class="text-blue">Kweku</span>
                                                    </div>
                                                    <div class="suggestion-card-location">
                                                        Shai Hills
                                                    </div>
                                                    <div class="suggestion-card-body">
                                                        <p>
                                                            Here is the summary of the activities and destinations selected for the day
                                                        </p>
                                                        <div class="suggestion-card-activities">
                                                            <div class="mt-2">
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                                <span class="activity">Hike</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button class="easygo-btn-5 bg-blue text-white easygo-fs-5">Accept</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Itinerary poll panel  [end] -->
                                    <!--- ================================ -->

                                    <!--- ================================ -->
                                    <!-- AI Suggestions  [start] -->
                                    <div class="tab-pane fade" id="sentiment-tab-pane" role="tabpanel" aria-labelledby="sentiment-tab-pane">
                                        <div class="bg-white p-5 box-shadow-3 easygo-scroll-bar" style="height: 50rem; overflow-y: auto;">
                                            <div>
                                                <h5 class="m-0">
                                                    General Suggestions
                                                </h5>
                                                <div class="row">
                                                    <div class="col-6 p-2">
                                                        <div class="p-2 h-100">
                                                            <div class="row py-3 px-2 border border-1 border-blue rounded-3 h-100">
                                                                <div class="col-3">
                                                                    <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h6 class="easygo-fw-1">Intense Activity</h6>
                                                                    <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 p-2">
                                                        <div class="p-2 h-100">
                                                            <div class="row py-3 px-2 border border-1 border-blue rounded-3 h-100">
                                                                <div class="col-3">
                                                                    <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h6 class="easygo-fw-1">Number of days</h6>
                                                                    <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="border-blue border border-1 opacity-100">
                                            <div>
                                                <h5 class="m-0">
                                                    Destination Suggestions
                                                </h5>
                                                <div class="row">
                                                    <div class="col-6 p-2">
                                                        <div class="p-2 h-100">
                                                            <div class="row py-3 px-2 border border-1 border-blue rounded-3 h-100">
                                                                <div class="col-3">
                                                                    <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h6 class="easygo-fw-1">Intense Activity</h6>
                                                                    <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 p-2">
                                                        <div class="p-2 h-100">
                                                            <div class="row py-3 px-2 border border-1 border-blue rounded-3 h-100">
                                                                <div class="col-3">
                                                                    <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h6 class="easygo-fw-1">Number of days</h6>
                                                                    <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <a href="#">Expand</a>
                                                </div>
                                            </div>
                                            <hr class="border-blue border border-1 opacity-100">
                                            <div>
                                                <h5 class="m-0">
                                                    Activity Suggestions
                                                </h5>
                                                <div class="row">
                                                    <div class="col-6 p-2">
                                                        <div class="p-2 h-100">
                                                            <div class="row py-3 px-2 border border-1 border-blue rounded-3 h-100">
                                                                <div class="col-3">
                                                                    <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h6 class="easygo-fw-1">Intense Activity</h6>
                                                                    <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 p-2">
                                                        <div class="p-2 h-100">
                                                            <div class="row py-3 px-2 border border-1 border-blue rounded-3 h-100">
                                                                <div class="col-3">
                                                                    <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                                                </div>
                                                                <div class="col-9">
                                                                    <h6 class="easygo-fw-1">Number of days</h6>
                                                                    <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- AI Suggestions  [end] -->
                                    <!--- ================================ -->


                                    <!--- ================================ -->
                                    <!-- Destination selection panel  [end] -->
                                    <div class="tab-pane fade show active" id="destination-tab-pane" role="tabpanel" aria-labelledby="destination-tab-pane">
                                        <div class="bg-white p-5 box-shadow-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <form action="." method="get" onsubmit='destination_search(this)'>
                                                        <div class="easygo-text-input-1">
                                                            <input type="text" name='query' placeholder="Search for destination by name">
                                                            <button class="easygo-btn-1 oy-1" type='submit'>SEARCH</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--- ================================ -->
                                            <!-- cards [start] -->
                                            <div class="my-4" id='destination-search-results'>
                                                <?php
                                                $destinations = get_destinations();
                                                foreach (array_slice($destinations, 0, 2) as $current) {
                                                    $destination_id = $current["destination_id"];
                                                    $name = $current["destination_name"];
                                                    $location = $current["location"];
                                                    $rating = $current["rating"];
                                                    $num_rating = $current["num_ratings"];
                                                    //===========================================================
                                                    //===================Destination activities text[start]============
                                                    $activities = get_destination_activities($destination_id);
                                                    $activities_text = "";
                                                    foreach ($activities as $entry) {
                                                        $act_id = $entry["activity_id"];
                                                        $act_name = $entry["activity_name"];
                                                        $activities_text .= "
                                                        <span id='activity_$act_id' onclick='add_activity_to_itineary_card(\"$destination_id\",\"$name\",\"$act_id\",\"$act_name\")' class='activity badge bg-transparent border border-blue border-1 text-black py-2 px-3'>$act_name</span>";
                                                    }
                                                    //===================Destination activities text[end]============
                                                    //===========================================================


                                                    echo "
                                                        <div class='my-4 border border-1 border-blue rounded-1 overflow-hidden box-shadow-3'>
                                                            <div class='p-3'>
                                                                <div class='row'>
                                                                    <div class='col-5'>
                                                                        <img src='../assets/images/others/tour2.jpg' class='img-fluid' alt='' style='max-height: 150px;'>
                                                                    </div>
                                                                    <div class='col-7'>
                                                                        <h4 class='m-0'>$name</h4>
                                                                        <div>$location</div>
                                                                        <div class='text-blue easygo-fs-2 py-2'>
                                                                            <i class='fa-solid fa-wifi'></i> &nbsp;
                                                                            <i class='fa-solid fa-bath'></i> &nbsp;
                                                                            <i class='fa-solid fa-person-swimming'></i>
                                                                        </div>
                                                                        <div>
                                                                            $rating stars from $num_rating reviews
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class='my-3'>
                                                                    Here is the summary of the activities and destinations selected
                                                                    for the day
                                                                </p>
                                                                <div class='d-flex justify-content-end'>
                                                                    <div class='mt-2 easygo-fw-4 easygo-fs-2'>$activities_text
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='py-2 bg-lblue-1 text-blue text-center'>
                                                                <a href='#'  data-bs-toggle='modal' data-bs-target='#dest-1-modal' onclick='update_destination_modal(\"$destination_id\")'>--- View more ---</a>
                                                            </div>
                                                        </div>
                                                        ";
                                                }
                                                ?>

                                            </div>
                                            <!-- cards [end] -->
                                            <!--- ================================ -->
                                        </div>
                                    </div>
                                    <!-- Destination selection panel  [end] -->
                                    <!--- ================================ -->
                                </div>
                            </div>
                            <!-- Right section card [end] -->
                            <!--- ================================ -->
                        </div>
                    </section>
                    <!-- main-content [end] -->
                    <!--- ================================ -->
                </div>
                <section class="py-3">
                    <div class="d-flex justify-content-center mt-3">
                        <?php
                        echo "<button class='easygo-btn-3 text-white easygo-fs-4 py-2 px-5' onclick='goto_page(\"coplanner/itinerary_settings.php?id=$itinerary_id\")'>Finalize Trip</button>";

                        if (is_session_user_admin()) {
                            $id = "";
                            echo "<button class='easygo-btn-5 bg-orange text-white easygo-fs-4 py-2 px-5' onclick='goto_page(\"coplanner/itinerary_invoice.php?id=$id\")'>Add to templates</button>";
                        }
                        ?>
                    </div>
                </section>
            </div>
        </main>
        <!--- ================================ -->
        <!-- offcanvases for mobile [start] -->
        <!--- ================================ -->
        <!-- Itinerary Poll - mobile [start] -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="itineraryPollCanvas" aria-labelledby="itineraryPollCanvasLabel">
            <div class="offcanvas-header">
                <h3 class="easygo-fw-1" class="offcanvas-title" id="itineraryPollCanvasLabel">
                    Itinerary Poll
                </h3>

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="bg-white p-2">
                    <!-- <h3 class="easygo-fw-1">
                        Itinerary Poll
                    </h3> -->
                    <div>A change has been suggested by a collaborator. You can choose option to maintain</div>
                    <div class="suggestion-cards-container">
                        <div class="suggestion-card my-3">
                            <div class="suggestion-card-header">
                                Suggested by <span class="text-blue">Kweku</span>
                            </div>
                            <div class="suggestion-card-location">
                                Shai Hills
                            </div>
                            <div class="suggestion-card-body">
                                <p>
                                    Here is the summary of the activities and destinations selected for the day
                                </p>
                                <div class="suggestion-card-activities">
                                    <div class="mt-2">
                                        <span class="activity">Hike</span>
                                        <span class="activity">Hike</span>
                                        <span class="activity">Hike</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="easygo-btn-5 bg-blue text-white easygo-fs-5">Accept</button>
                            </div>
                        </div>
                        <div class="suggestion-card my-3">
                            <div class="suggestion-card-header">
                                Suggested by <span class="text-blue">Kweku</span>
                            </div>
                            <div class="suggestion-card-location">
                                Shai Hills
                            </div>
                            <div class="suggestion-card-body">
                                <p>
                                    Here is the summary of the activities and destinations selected for the day
                                </p>
                                <div class="suggestion-card-activities">
                                    <div class="mt-2">
                                        <span class="activity">Hike</span>
                                        <span class="activity">Hike</span>
                                        <span class="activity">Hike</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="easygo-btn-5 bg-blue text-white easygo-fs-5">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Itinerary Poll - mobile [end] -->
        <!--- ================================ -->
        <!--- ================================ -->
        <!-- AI suggestions - mobile [start] -->
        <!--- ================================ -->
        <!-- Menu actions  - mobile [start] -->
        <div class="offcanvas offcanvas-start" id='mobileMenuCanvas'>
            <div class="offcanvas-header">
                <a class='navbar-brand' href='../index.php'>
                    <img class='logo-medium' src='../assets/images/site_images/logo.png' onerror='this.onerror=null; this.remove();' alt=''>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h5>Menu Actions</h5>
                <ul class="list-group">
                    <li class="list-group-item" onclick="switch_mobile_canvas()" data-proxy-target="destination-tab" data-bs-dismiss="offcanvas">
                        <a href="#">Add New Activities</a>
                    </li>
                </ul>
                <br>
                <h5 class='mt-1'>Select Itinerary Day</h5>
                <ul class="list-group" id='day-dropdown-options-mobile'>
                    <?php
                    echo "<li class='list-group-item' data-day-id='$first_day'> <a href='#'>Day One</a> <span id='selected-dropdown-label-mobile' class='badge d-inline text-white bg-blue easygo-fs-6 text-uppercase'>Selected</span> </li>";
                    foreach (array_slice($day_list, 1) as $d) {
                        $day_id = $d["day_id"];
                        echo "<li class='list-group-item' data-day-id='$day_id' data-bs-dismiss='offcanvas' >
                                <a href='#'>Day Two</a>
                            </li>";
                    }
                    ?>
                    <li class="list-group-item add-day-option"> <a href="#" class='text-orange  add-day-option' data-bs-dismiss='offcanvas'>Add Extra Day</a> </li>
                </ul>
                <br>
                <h5 class='mt-1'>Additional Service</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex flex-row align-items-center justify-center">
                            <div class="user-icon bg-orange" style="width: 2rem; height: 2rem;"></div>
                            <div class="p-1 expand-toggle-rev">Curator <span class='easygo-fs-5'>(Coming Soon)</span></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-row align-items-center justify-center">
                            <div class="user-icon bg-orange" style="width: 2rem; height: 2rem;"></div>
                            <div class="p-1 expand-toggle-rev">Accommodation <span class='easygo-fs-5'>(Coming Soon)</span></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex flex-row align-items-center justify-center">
                            <div class="user-icon bg-orange" style="width: 2rem; height: 2rem;"></div>
                            <div class="p-1 expand-toggle-rev">Transportation <span class='easygo-fs-5'>(Coming Soon)</span></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Menu actions  - mobile [end] -->
        <!--- ================================ -->
        <!--- ================================ -->
        <!-- Destination selection  - mobile [end] -->
        <div class="offcanvas offcanvas-start" id="destinationSearchCanvas" aria-labelledby="">
            <div class="offcanvas-header">
                <a class='navbar-brand' href='../index.php'>
                    <img class='logo-medium' src='../assets/images/site_images/logo.png' onerror='this.onerror=null; this.remove();' alt=''>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="bg-white p-2">
                    <div class="row">
                        <div class="col-12">
                            <form action="." method="get" onsubmit='destination_search(this)'>
                                <div class="easygo-text-input-1">
                                    <input type="text" name='query' placeholder="Search for destination by name">
                                    <button class="easygo-btn-1 oy-1" type='submit'>SEARCH</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--- ================================ -->
                    <!-- cards [start] -->
                    <div class="my-4" id='destination-search-results'>
                        <?php
                        $destinations = get_destinations();
                        foreach (array_slice($destinations, 0, 2) as $current) {
                            $destination_id = $current["destination_id"];
                            $name = $current["destination_name"];
                            $location = $current["location"];
                            $rating = $current["rating"];
                            $num_rating = $current["num_ratings"];
                            //===========================================================
                            //===================Destination activities text[start]============
                            $activities = get_destination_activities($destination_id);
                            $activities_text = "";
                            foreach ($activities as $entry) {
                                $act_id = $entry["activity_id"];
                                $act_name = $entry["activity_name"];
                                $activities_text .= "
                                                        <span id='activity_$act_id' onclick='add_activity_to_itineary_card(\"$destination_id\",\"$name\",\"$act_id\",\"$act_name\")' class='activity badge bg-transparent border border-blue border-1 text-black py-2 px-3'>$act_name</span>";
                            }
                            //===================Destination activities text[end]============
                            //===========================================================


                            echo "
                                <div class='my-4 border border-1 border-blue rounded-1 overflow-hidden box-shadow-3'>
                                    <div class='p-3'>
                                        <div class='row'>
                                            <div class='col-5'>
                                                <img src='../assets/images/others/tour2.jpg' class='img-fluid' alt='' style='max-height: 150px;'>
                                            </div>
                                            <div class='col-7'>
                                                <h4 class='m-0'>$name</h4>
                                                <div>$location</div>
                                                <div class='text-blue easygo-fs-2 py-2'>
                                                    <i class='fa-solid fa-wifi'></i> &nbsp;
                                                    <i class='fa-solid fa-bath'></i> &nbsp;
                                                    <i class='fa-solid fa-person-swimming'></i>
                                                </div>
                                                <div>
                                                    $rating stars from $num_rating reviews
                                                </div>
                                            </div>
                                        </div>
                                        <p class='my-3'>
                                            Here is the summary of the activities and destinations selected
                                            for the day
                                        </p>
                                        <div class='d-flex justify-content-end'>
                                            <div class='mt-2 easygo-fw-4 easygo-fs-2'>$activities_text
                                            </div>
                                        </div>
                                    </div>
                                    <div class='py-2 bg-lblue-1 text-blue text-center'>
                                        <a href='#'  data-bs-toggle='modal' data-bs-target='#dest-1-modal' onclick='update_destination_modal(\"$destination_id\")'>--- View more ---</a>
                                    </div>
                                </div>
                                ";
                        }
                        ?>

                    </div>
                    <!-- cards [end] -->
                    <!--- ================================ -->
                </div>
            </div>

        </div>
        <!-- Destination selection  - mobile [end] -->
        <!--- ================================ -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h3 class="offcanvas-title easygo-fw-1" id="offcanvasRightLabel">
                    Sentiment Analysis
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="bg-white p-2">
                    <div>
                        <h3 class="m-0">
                            Destination Suggestions
                        </h3>
                        <div class="row">
                            <div class="col-lg-6 p-2">
                                <div class="p-2">
                                    <div class="row p-3 border border-1 border-blue rounded-3">
                                        <div class="col-3">
                                            <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                        </div>
                                        <div class="col-9">
                                            <h6 class="easygo-fw-1">Intense Activity</h6>
                                            <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 p-2">
                                <div class="p-2">
                                    <div class="row p-3 border border-1 border-blue rounded-3">
                                        <div class="col-3">
                                            <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                        </div>
                                        <div class="col-9">
                                            <h6 class="easygo-fw-1">Number of days</h6>
                                            <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="border-blue border border-1 opacity-100">
                    <div>
                        <h3 class="m-0">
                            Sentiment Analysis
                        </h3>
                        <div class="row">
                            <div class="col-lg-6 p-2">
                                <div class="p-2">
                                    <div class="row p-3 border border-1 border-blue rounded-3">
                                        <div class="col-3">
                                            <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                        </div>
                                        <div class="col-9">
                                            <h6 class="easygo-fw-1">Intense Activity</h6>
                                            <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 p-2">
                                <div class="p-2">
                                    <div class="row p-3 border border-1 border-blue rounded-3">
                                        <div class="col-3">
                                            <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                        </div>
                                        <div class="col-9">
                                            <h6 class="easygo-fw-1">Number of days</h6>
                                            <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="text-center">
                            <a href="#">Expand</a>
                        </div> -->
                    </div>
                    <hr class="border-blue border border-1 opacity-100">
                    <div>
                        <h3 class="m-0">
                            Activity Suggestions
                        </h3>
                        <div class="row">
                            <div class="col-lg-6 p-2">
                                <div class="p-2">
                                    <div class="row p-3 border border-1 border-blue rounded-3">
                                        <div class="col-3">
                                            <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                        </div>
                                        <div class="col-9">
                                            <h6 class="easygo-fw-1">Intense Activity</h6>
                                            <p class="easygo-fs-4">The activities you have included are physically exhausting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 p-2">
                                <div class="p-2">
                                    <div class="row p-3 border border-1 border-blue rounded-3">
                                        <div class="col-3">
                                            <i class="fa-solid fa-person-hiking easygo-h3 text-blue"></i>
                                        </div>
                                        <div class="col-9">
                                            <h6 class="easygo-fw-1">Number of days</h6>
                                            <p class="easygo-fs-4">You may need to add an extra day to avoid rushing through activities</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- ================================ -->
        <!-- Destination Modals [start] -->
        <div class="modal fade" id="dest-1-modal" tabindex="-1" aria-labelledby="dest-1-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl modal-fullscreen-md-down">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Destination Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body easygo-scroll-bar">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-3">
                                        <div class="d-flex gap-2" style="max-height: 200px;">
                                            <div class="" style="flex:1;">
                                                <img src="../assets/images/others/tour2.jpg" class="img-fluid" alt="" style="height: 100%;">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center gap-2" style="flex:1;">
                                                <div style="max-height: 50%;">
                                                    <img src="../assets/images/others/tour2.jpg" class="h-100 w-100" alt="">
                                                </div>
                                                <div style="max-height: 50%;">
                                                    <img src="../assets/images/others/tour2.jpg" class="h-100 w-100" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="my-3">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h2 class="m-0 easygo-fw-1" id='modal-destination-name'>Shai Hills</h2>
                                                        <div id='modal-location'>Greater Accra, Ghana</div>
                                                    </div>
                                                    <div class="col-5">
                                                        <h2 class="easygo-fw-1 text-end m-0" id='modal-rating'>4.3</h2>
                                                        <p class="m-0 text-end"><span id='modal-rating-count'>5k</span> Reviews</p>
                                                    </div>
                                                </div>
                                                <div class="text-blue easygo-fs-2 py-2">
                                                    <i class="fa-solid fa-wifi"></i> &nbsp;
                                                    <i class="fa-solid fa-bath"></i> &nbsp;
                                                    <i class="fa-solid fa-person-swimming"></i>
                                                </div>
                                            </div>

                                            <div>
                                                <p class="easygo-fs-5 mb-0">Click on activity to add to itinerary</p>
                                                <div class="d-flex flex-wrap">
                                                    <div class="mt-2 easygo-fw-4 easygo-fs-2" id="modal-activity-list">
                                                        <span class="activity badge bg-transparent border border-blue border-1 text-black py-2 px-3">Hike</span>
                                                        <span class="activity badge bg-transparent border border-blue border-1 text-black py-2 px-3">Hike</span>
                                                        <span class="activity badge bg-transparent border border-blue border-1 text-black py-2 px-3">Hike</span>
                                                        <span class="activity badge bg-transparent border border-blue border-1 text-black py-2 px-3">Hike</span>
                                                        <span class="activity badge bg-transparent border border-blue border-1 text-black py-2 px-3">Hike</span>
                                                        <span class="activity badge bg-transparent border border-blue border-1 text-black py-2 px-3">Hike</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-3">
                                        <h4 class="easygo-fw-1">Customer reviews from Google</h4 class="easygo-fw-1">
                                        <div class="my-4">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h5 class="text-start">Customer Name</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h6 class="text-end easygo-fs-5">3 months ago</h6>
                                                </div>
                                            </div>
                                            <p>
                                                Some customer reviews about how the places were and
                                                stuff about why they want to go back
                                            </p>
                                        </div>
                                        <div class="my-4">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h5 class="text-start">Customer Name</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h6 class="text-end easygo-fs-5">3 months ago</h6>
                                                </div>
                                            </div>
                                            <p>
                                                Some customer reviews about how the places were and
                                                stuff about why they want to go back
                                            </p>
                                        </div>
                                        <div class="my-4">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h5 class="text-start">Customer Name</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h6 class="text-end easygo-fs-5">3 months ago</h6>
                                                </div>
                                            </div>
                                            <p>
                                                Some customer reviews about how the places were and
                                                stuff about why they want to go back
                                            </p>
                                        </div>
                                        <div class="my-4">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h5 class="text-start">Customer Name</h5>
                                                </div>
                                                <div class="col-5">
                                                    <h6 class="text-end easygo-fs-5">3 months ago</h6>
                                                </div>
                                            </div>
                                            <p>
                                                Some customer reviews about how the places were and
                                                stuff about why they want to go back
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-2 ps-3">
                                Haven't decided on activities ? <a href="#">Click to add a destination</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Destination Modals [end] -->
        <!--- ================================ -->
        <!-- AI suggestions - mobile [end] -->
        <!--- ================================ -->
        <!-- offcanvases - mobile [end] -->
        <!--- ================================ -->
        <?php require_once(__DIR__ . "/../components/footer.php") ?>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/itinerary_creation.js"></script>
    <script>
        [].slice
            .call(document.querySelectorAll("button[data-proxy-target]"))
            .forEach((proxy) => {
                proxy.addEventListener("click", (event) => {
                    let target = document.getElementById(event.target.getAttribute("data-proxy-target"))
                    target.click()
                })
            });

        function switch_mobile_canvas() {
            const newCanvas = new bootstrap.Offcanvas(document.getElementById('destinationSearchCanvas'));
            newCanvas.toggle();
        }
        <?php
        echo "let selected_day_id='$first_day'";
        ?>
    </script>
</body>

</html>