<?php
require_once(__DIR__ . "/../utils/core.php");
require_once(__DIR__ . "/../controllers/curator_interraction_controller.php");

if (!is_session_user_curator()) {
    header("Location: ../views/home.php");
    die();
}

$info = get_collaborator_info(get_session_user_id());
$curator_id = get_session_account_id();
$user_name = $info["user_name"];
$curator_name = $info["curator_name"];
$logo = $info["curator_logo"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator | Create a trip</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- EHImageUpload css -->
    <link rel="stylesheet" href="../assets/css/EhImageUploadDisplay.css">
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <!-- ============================== -->
    <!-- main-wrapper [start] -->
    <div class="main-wrapper">
        <?php require_once(__DIR__ . "/../components/curator_header.php") ?>
        <header class="nav-menu d-lg-none">
            <?php require_once(__DIR__ . "/../components/curator_navbar_mobile.php"); ?>
            <!-- ============================== -->
            <!-- dashboard content [start] -->
            <main class="dashboard-content">
                <?php require_once(__DIR__ . "/../components/curator_navbar_desktop.php"); ?>
                <div class="main-content px-3">
                    <section class="create-trip">
                        <div class="d-flex justify-content-between align-items-center border-1 border-bottom py-3">
                            <div>
                                <h5 class="title">Create a trip</h5>
                                <small class="easygo-fs-5 text-gray-1"><a href="#">Trips</a> > Create Trip</small>
                            </div>
                        </div>
                        <form id="create_trip_form" onsubmit="return submit_tour(this)">

                            <!-- Flyer upload -->
                            <div class="row border-1 border-bottom py-4 pe-lg-5">
                                <div class="col-lg-5">
                                    <h3 class="easygo-fs-3 easygo-fw-1">Flyer</h3>
                                    <p class="text-gray-1 easygo-fs-5">Upload the flyer for the trip if you have any</p>
                                </div>
                                <div class="col-lg-7 d-flex flex-column gap-4">
                                    <div>
                                        <div id="coverphoto-upload-btn" data-visibility-target=".cover_or_trip-imgs" data-visibility-show="#cover-photo-upload-outer" data-bs-toggle="modal" data-bs-target="#upload-img-modal" class="file-input visibility-changer">
                                            <div class="upload-symbol">
                                                <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                            </div>
                                            <a>Click to upload</a>
                                            <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tour name  -->
                            <div class="row border-1 border-bottom py-4 pe-lg-5">
                                <div class="col-lg-5">
                                    <h3 class="easygo-fs-3 easygo-fw-1">Name of tour</h3>
                                    <p class="text-gray-1 easygo-fs-5">Give a short and catch name for the tour. Ideally, it should give a hint of what the tour is about. Eg: Experience Trident Island</p>
                                </div>
                                <div class="col-lg-7 d-flex flex-column gap-4">
                                    <div class="form-input-field">
                                        <input type="text" name="title" placeholder="Name of your amazing tour">
                                    </div>
                                </div>
                            </div>
                            <!-- Tour description  -->
                            <div class="row border-1 border-bottom py-4 pe-lg-5">
                                <div class="col-lg-5">
                                    <h3 class="easygo-fs-3 easygo-fw-1">Trip Description</h3>
                                    <p class="text-gray-1 easygo-fs-5">Describe the trip in detail. Tell us about all the activities involved
                                        in the trip. Tell us the locations you will be visiting, anything special about the trip you will like
                                        tour goers to know? Here's an example (NB: AI generated)</p>
                                    <p class="text-gray-1 easygo-fs-5">
                                        Our tour begins with a pick-up from your hotel in the city and a comfortable drive to the countryside, where you can breathe in the fresh air and take in the beauty of nature. Our first stop will be at a local farm, where you can see how the farmers cultivate the land and produce various crops.
                                        Next, we'll take you to a breathtaking viewpoint, where you can capture panoramic views of the lush green hills and valleys. This spot is perfect for some stunning photos!
                                        After taking in the beauty of the landscape, we'll continue our journey to a quaint little village. Here, you can explore the charming streets and learn about the local culture and traditions. We'll take you to a local restaurant where you can try some authentic, delicious food.
                                        Our next stop will be a natural wonder - a cascading waterfall surrounded by dense forests. Take a dip in the cool waters or simply admire the cascading beauty of the waterfall.
                                        Our final destination is a serene lake nestled amidst the hills. Here, you can enjoy a peaceful boat ride or simply sit by the banks and soak in the serene surroundings. As the sun sets over the horizon, we'll head back to the city.
                                        This tour is perfect for those looking to escape the hustle and bustle of the city and immerse themselves in nature's beauty. With comfortable transportation, knowledgeable guides, and a carefully crafted itinerary, this tour promises to be an unforgettable experience!
                                    </p>
                                </div>
                                <div class="col-lg-7">
                                    <div>
                                    </div>
                                    <div class="form-input-field">
                                        <textarea name="description" style="resize: none" cols="30" rows="14" placeholder="Trip description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Tour images  -->
                            <div class="row border-1 border-bottom py-4 pe-lg-5">
                                <div class="col-lg-5">
                                    <h3 class="easygo-fs-3 easygo-fw-1">Trip Images</h3>
                                    <p class="text-gray-1 easygo-fs-5">Add images to your trip</p>
                                </div>
                                <div class="col-lg-7">
                                    <div>
                                        <div id="tripimages-upload-btn" data-bs-toggle="modal" data-bs-target="#upload-img-modal" data-visibility-target=".cover_or_trip-imgs" data-visibility-show="#trip-imgs-upload-outer" class="file-input visibility-changer">
                                            <div class="upload-symbol">
                                                <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                            </div>
                                            <a>Click to upload</a>
                                            <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                            <div class="img-display">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            echo "<input type='hidden' name='curator_id' value='$curator_id'>";
                            ?>

                            <!-- Activities  -->
                            <div class="row border-1 border-top py-4 pe-lg-5">
                                <div class="col-lg-2">
                                    <h3 class="easygo-fs-3 easygo-fw-1">Activities & Locations</h3>
                                    <p class="text-gray-1 easygo-fs-5">Add activities and locations</p>
                                </div>
                                <div class="col-lg-3">
                                    <div class="location-list col " id="selected-locations">
                                    </div>
                                </div>
                                <div class="col-lg-7 ">
                                    <button class="btn btn-default px-5" type="button" data-bs-toggle="modal" data-bs-target="#activities-locations-modal"><img src="../assets/images/svgs/plus.svg" alt="plus sign"> &nbsp; Add Activities & Location</button>
                                    <div class="activity-list d-flex flex-wrap gap-2" id="selected-activities">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-7 ">
                                    <button class="btn btn-default border px-5" type="button" data-bs-toggle="modal" data-bs-target="#activities-locations-modal"><img src="../assets/images/svgs/plus.svg" alt="plus sign"> &nbsp; Add Activities & Location</button>
                                </div> -->
                            </div>

                            <h3 class="easygo-fs-3 easygo-fw-1">Tour type</h3>
                            <ul class="nav nav-tabs easygo-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active easygo-fs-4 h-100" id="group-tour-tab" data-bs-toggle="tab" data-bs-target="#group-tour" type="button" role="tab" aria-controls="group-tour" aria-selected="false">Group Tour</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link  easygo-fs-4 h-100" id="private-tour-tab" data-bs-toggle="tab" data-bs-target="#private-tour" type="button" role="tab" aria-controls="private-tour" aria-selected="false">Private Tour</button>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                    <button class="nav-link easygo-fs-4 h-100" id="withdrawals-tab" data-bs-toggle="tab" data-bs-target="#withdrawals" type="button" role="tab" aria-controls="withdrawals" aria-selected="false">Withdrawals</button>
                                </li> -->
                            </ul>
                            <div class="tab-content">


                                <div class="tab-pane fade show active" id="group-tour" role="tabpanel" aria-labelledby="group-tour-tab">

                                    <!-- Occurences  -->
                                    <div class="row border-1 border-top border-bottom py-4 pe-lg-5">
                                        <div class="col-lg-5">
                                            <h4 class="easygo-fs-4 easygo-fw-1">Trip Occurence</h4>
                                            <p class="text-gray-1 easygo-fs-5">Add trip occurence</p>
                                        </div>
                                        <div class="col-lg-7 d-flex flex-column gap-4">
                                            <div class="row">
                                                <div class="col-lg-6 pb-3 p-0 pe-lg-1">
                                                    <div class="form-input-field">
                                                        <h6 class="easygo-fs-4 text-gray-1">Start Date</h6>
                                                        <input id="start_date" class="date-input" type="text" pattern="\d{2}-\d{2}-\d{4}" placeholder="DD/MM/YYYY">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 pb-3 p-0 ps-lg-1">
                                                    <div class="form-input-field">
                                                        <h6 class="easygo-fs-4 text-gray-1">End Date</h6>
                                                        <input id="end_date" class="date-input" type="text" pattern="\d{2}-\d{2}-\d{4}" placeholder="DD/MM/YYYY">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="occurance_field">
                                                <div class="col-lg-6 p-0 pe-lg-1 pb-3">
                                                    <div class="form-input-field">
                                                        <h6 class="easygo-fs-4 text-gray-1">Fee</h6>
                                                        <div class="d-flex">
                                                            <div class="dropdown">
                                                                <a id="currency_menu" style="background: var(--easygo-gray-3); height: 100%; border: solid 1px var(--easygo-gray-2); gap: 3px; font-size: var(--font-size-4);" class="btn rounded-0 rounded-start border-end-0 d-flex align-items-center dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    GHS
                                                                </a>
                                                                <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuLink">
                                                                    <li onclick="on_option_select('currency_menu','GHS')">GHS</li>
                                                                    <li onclick="on_option_select('currency_menu','USD')">USD</li>
                                                                </ul>
                                                            </div>
                                                            <input id="fee" class="rounded-end rounded-0" type="text" placeholder="Fee">
                                                        </div>
                                                        <div class="d-flex align-items-start mt-3">
                                                            <div class="icon"><img src="../assets/images/svgs/info.svg" alt="info icon"></div>
                                                            <div class="easygo-fs-6">Total fee for each trip includes transportation, food & any other costs</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 pb-3 p-0 ps-lg-1">
                                                    <div class="form-input-field">
                                                        <h6 class="easygo-fs-4 text-gray-1">Seats</h6>
                                                        <input id="seats" type="number" min="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ======================================================================== -->
                                            <!-- ==========================Start of entered occurances========================== -->
                                            <p>Entered occurances</p>
                                            <div id="occurance_list" class="easygo-list-3 list-striped">
                                                <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                                    <div class="inner-item">Start Date</div>
                                                    <div class="inner-item">End Date</div>
                                                    <div class="inner-item">Fee</div>
                                                    <div class="inner-item">Number of seats</div>
                                                    <div class="inner-item">Actions</div>
                                                </div>


                                                <!-- <div class='list-item'>
                                                    <div class='inner-item start_val'>22 May 2023</div>
                                                    <div class='inner-item end_val'>22 May 2023</div>
                                                    <div class='inner-item  fee_val'>GHC 50</div>
                                                    <div class='inner-item seats_val'>30</div>
                                                    <div class='inner-item row'>
                                                        <div class="inner-item fa fa-edit" onclick="edit_occurance_entry(this)"></div>
                                                        <div class="inner-item fa fa-trash" onclick="delete_occurance_entry(this)"></div>
                                                    </div>
                                                </div> -->


                                                <!-- ======================================================================== -->
                                                <!-- ==========================Start of entered occurances========================== -->
                                                <div class='list-item' id="add_button" onclick="add_new_occurance()">
                                                    <div class='inner-item '>Click to add another date for this tour</div>
                                                </div>

                                                <!-- ==========================Add new occurance========================== -->
                                                <!-- ======================================================================== -->

                                            </div>
                                            <!-- ==========================End of entered occurances========================== -->
                                            <!-- ======================================================================== -->
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="private-tour" role="tabpanel" aria-labelledby="private-tour-tab">
                                    <h4>Private tour options</h4>
                                </div>
                            </div>

                            <div class="input-field py-5 pe-5 d-flex justify-content-end gap-3">
                                <!-- <input class="btn btn-default border px-4 py-2 easygo-fs-4" type="reset" value="cancel"> -->
                                <button type="reset" class="btn btn-default border px-4 easygo-fs-4">Cancel</button>
                                <!-- <input class="easygo-btn-1 px-4 py-2 easygo-fs-4" value="Create Trip"> -->
                                <button class="easygo-btn-1 px-4 py2 easygo-fs-4" type="submit">Create Trip</button>
                            </div>
                        </form>
                    </section>
                </div>
            </main>
            <!-- dashboard-content [end] -->
            <!-- ============================== -->
    </div>
    <!-- main-wrapper [end] -->
    <!-- ============================== -->



    <!-- ============================== -->
    <!-- Upload image modal [start] -->
    <div class="modal fade" id="upload-img-modal">
        <div class="modal-dialog .modal-dialog-centered modal-xl">
            <div class="modal-content p-5">

                <form id="img-upload-form">
                    <div class="px-2">
                        <h5 class="mb-2">Upload Image</h5>

                        <div>
                            <!-- <div id="cover-photo-upload" class="file-input py-5 cover_or_trip-imgs" visible-mode="flex">
                                <div class="upload-symbol">
                                    <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                </div>
                                <a>Click to upload or drag and drop</a>
                                <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                <input accept=".png, .jpg, .jpeg, .svg" type="file">
                                <div class="img-display">
                                </div>
                            </div> -->
                            <!-- ============================== -->
                            <!-- cover photo upload file input [start] -->
                            <div style="height: 200px;" class="cover_or_trip-imgs" id="cover-photo-upload-outer">
                                <div id="cover-photo-upload" id="upload-display" class="eh_img-upload-display border-gray-2">
                                    <div class="eh_iu-label">
                                        <div class="upload-symbol rounded-circle bg-gray-2">
                                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image" style="width: 2rem; height: 2rem;">
                                        </div>
                                        <a class="easygo-blue easygo-fw-1 easygo-fs-4">Click to upload or drag and drop</a>
                                        <span class="text-gray-1 easygo-fs-4">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                    </div>
                                    <input id="file" type="file" />
                                </div>
                            </div>
                            <!-- cover photo upload file input [end] -->
                            <!-- ============================== -->
                            <!-- ============================== -->
                            <!-- trip images  upload file input [start] -->
                            <div style="height: 200px;" id="trip-imgs-upload-outer" class="cover_or_trip-imgs">
                                <div id="trip-imgs-upload" id="upload-display" class="eh_img-upload-display border-gray-2">
                                    <div class="eh_iu-label">
                                        <div class="upload-symbol rounded-circle bg-gray-2">
                                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image" style="width: 2rem; height: 2rem;">
                                        </div>
                                        <a class="easygo-blue easygo-fw-1 easygo-fs-4">Click to upload or drag and drop</a>
                                        <span class="text-gray-1 easygo-fs-4">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                    </div>
                                    <input id="file" type="file" multiple />
                                </div>
                            </div>
                            <!-- trip images  upload file input [end] -->
                            <!-- ============================== -->
                            <!-- <div id="trip-imgs-upload" class="file-input py-5 cover_or_trip-imgs" visible-mode="flex">
                                <div class="upload-symbol">
                                    <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                </div>
                                <a>Click to upload or drag and drop</a>
                                <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                <input accept=".png, .jpg, .jpeg, .svg" type="file" multiple>
                                <div class="img-display">
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <!-- <div class="row my-5">
                        <h5 class="mb-2">Recent uploads</h5>

                        <div id="recent-list" style="display:none;">
                            <div style="overflow-x: auto;">
                                <div class="grid-7" style="max-height: 500px;">
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/scenery1.jpg" alt="scene 1">
                                    </div>
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/scenery2.jpg" alt="scene 1">
                                    </div>
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/tour1.jpg" alt="scene 1">
                                    </div>
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/tour1.jpg" alt="scene 1">
                                    </div>
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/tour1.jpg" alt="scene 1">
                                    </div>
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/tour1.jpg" alt="scene 1">
                                    </div>
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/tour1.jpg" alt="scene 1">
                                    </div>
                                    <div class="grid-item">
                                        <img class="w-100 h-100 rounded" src="../assets/images/others/tour1.jpg" alt="scene 1">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-lg-4 pb-3 image-collection" id="collection1">
                            <div class="container bg-gray-3 border rounded">
                                <div class="img-grid-1" id="boti">
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                </div>
                                <div style="padding: 0rem 0.5rem;" class="d-flex justify-content-between">
                                    <span class="easygo-fs-5">Boti Falls</span>
                                    <span class="text-gray-1 easygo-fs-5">30 photos</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 pb-3 image-collection" id="collection2">
                            <div class="container bg-gray-3 border rounded">
                                <div class="img-grid-1">
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                </div>
                                <div style="padding: 0rem 0.5rem;" class="d-flex justify-content-between">
                                    <span class="easygo-fs-5">Boti Falls</span>
                                    <span class="text-gray-1 easygo-fs-5">30 photos</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 pb-3 image-collection" id="collection3">
                            <div class="container bg-gray-3 border rounded">
                                <div class="img-grid-1">
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/profile.jpeg" alt="">
                                    </div>
                                </div>
                                <div style="padding: 0rem 0.5rem;" class="d-flex justify-content-between">
                                    <span class="easygo-fs-5">Boti Falls</span>
                                    <span class="text-gray-1 easygo-fs-5">30 photos</span>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- Modal footer -->
                    <!-- <div class="d-flex justify-content-end gap-2 align-items-center">
                        <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                        <button style="width: 5rem;" type="button " class="easygo-btn-1 py-2 easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Upload</button>
                    </div> -->
                </form>

            </div>
        </div>
    </div>
    <!-- Upload image modal [end] -->
    <!-- ============================== -->
    <!-- ============================== -->
    <!-- add_activities_&_locations modal [start] -->
    <div class="modal fade" id="activities-locations-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="row">
                    <div class="col-lg-6">
                        <h6>Add Trip And Activities</h6>
                        <a data-bs-toggle="modal" data-bs-target="#add-location-modal" class='easygo-fs-5 mb-4'>Can't find a location? Create it here</a>
                        <div class="al-search">
                            <form onsubmit='location_search_submit(this)'>
                                <div class="d-flex gap-2">
                                    <div class="form-input-field">
                                        <input class="px-4 py-2 flex-grow-1" type="text" placeholder="Search" name="query">
                                        <small class="easygo-fs-5"><span id="site_search_result_count">4</span> results found in <span class="text-gray-1">Ghana</span></small>
                                    </div>
                                    <div class="dropdown">
                                        <a id="location_search_filter" href="#Name" class="btn btn-default border dropdown-toggle text-blue px-4 py-2" type="button" id="citymenu" data-bs-toggle="dropdown" aria-expanded="false">
                                            Name
                                        </a>
                                        <ul class="dropdown-menu px-2" aria-labelledby="citymenu">
                                            <li onclick="on_option_select('location_search_filter','Name')">Name</li>
                                            <li onclick="on_option_select('location_search_filter','Activity')">Activity</li>
                                            <li onclick="on_option_select('location_search_filter','Location')">Location</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <button class="btn btn-default border text-blue px-4 py-2">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class='location-listing py-4' id="site_result_div">
                            <?php

                            $toursites = get_toursites();

                            foreach ($toursites as $site) {
                                $site_id = $site["toursite_id"];
                                $site_name = $site["site_name"];
                                $site_location = $site["site_location"];
                                $site_country = $site["country"];
                                echo "
                                <div class='location-card border p-4 rounded my-3'>
                                    <div class='header d-flex justify-content-between'>
                                        <h1 id='site_name_h1' class='easygo-fs-3 text-capitalize'>$site_name</h1>
                                        <h5 class='easygo-fs-4 text-orange'>$site_location</h5>
                                    </div>
                                    <div class='text-gray-1 easygo-fs-6'>
                                        <!-- <div class='rating-and-info d-flex align-items-center gap-1'>
                                            <span>4.3</span>
                                            <span>
                                                <img src='../assets/images/svgs/full_star.svg' alt='star'>
                                                <img src='../assets/images/svgs/full_star.svg' alt='star'>
                                                <img src='../assets/images/svgs/full_star.svg' alt='star'>
                                                <img src='../assets/images/svgs/full_star.svg' alt='star'>
                                                <img src='../assets/images/svgs/empty_star.svg' alt='star'>
                                            </span>
                                            <span>(1708)</span>
                                        </div> -->
                                        <div class='time'>
                                            <span></span>
                                            &nbsp;
                                            &nbsp;
                                            <span>$site_location</span>
                                        </div>
                                    </div>
                                    <div class='pt-3'>
                                        <button class='easygo-btn-1 easygo-fs-5 py-1 px-4' onclick='on_location_expand(\"$site_id\")'>See More</button>
                                    </div>
                                </div>";
                            }

                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <?php
                            $site = $toursites[0];
                            $site_id = $site["toursite_id"];
                            $site = get_toursite_by_id($site_id);
                            $site_name = $site["site_name"];
                            $site_desc = $site["toursite_description"];
                            $site_location = $site["site_location"];
                            $site_country = $site["country"];
                            $site_activities = $site["activities"];

                            $site_media = get_toursite_media($site_id);


                            echo "<h5 class='loc-title pb-3 border-bottom' id='location-info-title'>$site_name</h5>
                            <div class='loc-info'>
                                <p class='easygo-fs-5' id='location-info-desc'>
                                $site_desc
                                </p>
                            </div>";
                            ?>
                            <div style='overflow-x: auto;'>
                                <div class='grid-7' style='max-height: 500px;' id='location-info-images'>
                                    <?php
                                    $site_media = array(
                                        "../assets/images/others/scenery2.jpg",
                                        "../assets/images/others/tour1.jpg"
                                    );
                                    foreach ($site_media as $media) {
                                        // $media_location = $site_media[""];
                                        echo "<div class='grid-item'>
                                        <img class='w-100 h-100 rounded' src='../assets/images/others/scenery1.jpg' alt='scene 1'>
                                    </div>
                                    ";
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="activity-listing" id="activity-listing">
                                <div class="d-flex align-items-center gap-2 my-4">
                                    <h6 class="easygo-fw-1 m-0">Activities</h6>
                                    <small class="text-gray-1 easygo-fs-6">(Select activities to include)</small>
                                    <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                </div>
                                <div id="activity-list-div" class="activity-list d-flex flex-wrap gap-2">
                                    <?php
                                    foreach ($site_activities as $value) {
                                        echo "<span class='px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize activity-span'>high rope course</span>";
                                    }
                                    ?>

                                </div>
                            </div>
                            <div>
                                <button onclick="add_location_activity()" class="easygo-btn-1 mt-4 ms-auto easygo-fs-5">Add this location</button>
                            </div>
                            <div class="d-flex justify-content-end gap-2 align-items-center mt-4">
                                <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>
    <!-- add_activities_&_locations modal [end] -->
    <!-- ============================== -->


    <!-- ============================== -->
    <!-- Add toursite [start] -->
    <div class="modal fade" id="add-location-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="row">
                    <div class="col-lg-6">

                        <ul class="nav nav-tabs easygo-nav-tabs" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100" id="add-location-profile-tab" data-bs-toggle="tab" data-bs-target="#add-location-profile" type="button" role="tab" aria-controls="add-location-profile" aria-selected="false">
                                    Tour site Profile
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100" id="add-location-activities-tab" data-bs-toggle="tab" data-bs-target="#add-location-activities" type="button" role="tab" aria-controls="add-location-activities" aria-selected="false">
                                    Tour site Activities
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link easygo-fs-4 h-100" id="add-location-info-tab" data-bs-toggle="tab" data-bs-target="#add-location-info" type="button" role="tab" aria-controls="add-location-info" aria-selected="false">
                                    Other information
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <form onsubmit="return create_site(this)">
                            <div>
                                <div style='overflow-x: auto;'>
                                    <div class='grid-7' style='max-height: 500px;' id='location-info-images'>

                                    </div>
                                </div>
                                <div class="tab-content">

                                    <!-- Tour site profile [start] -->
                                    <div class="col tab-pane fade" role="tabpanel" id="add-location-profile">
                                        <div>

                                            <div class="form-input-field">
                                                <label class="text-gray-1 easygo-fs-4 ">Name</label>
                                                <input class="px-4 py-2 flex-grow-1" type="text" name="name">
                                            </div>

                                            <div class="form-input-field">
                                                <label class="text-gray-1 easygo-fs-4 ">Description</label>
                                                <input class="px-4 py-2 flex-grow-1" type="text" name="description">
                                            </div>

                                            <div class="form-input-field">
                                                <label class="text-gray-1 easygo-fs-4 ">Location</label>
                                                <!-- TODO::Make GPS location -->
                                                <input class="px-4 py-2 flex-grow-1" type="text" name="location">
                                            </div>

                                            <div class="form-input-field">
                                                <label class="text-gray-1 easygo-fs-4 ">Country</label>
                                                <input class="px-4 py-2 flex-grow-1" type="text" name="country">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Tour site profile [end] -->
                                    <!-- Tour site activities [start] -->
                                    <div class="col tab-pane fade" role="tabpanel" id="add-location-activities">
                                        <div class="d-flex align-items-center gap-2 my-4">
                                            <h6 class="easygo-fw-1 m-0">Activities</h6>
                                            <small class="text-gray-1 easygo-fs-6">(Activities that the tour site provides)</small>
                                            <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                        </div>

                                        <div class="form-input-field">
                                            <label class="text-gray-1 easygo-fs-4 ">Activity</label>
                                            <input class="px-4 py-2 flex-grow-1" type="text" id="add_loc_activity_input">
                                            <button class="btn btn-default border text-blue px-4 py-2" onclick="add_loc_activity()">Add Activity</button>
                                            <div class="col">
                                                <ul id='add_loc_activity_list'>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Tour site activities [end] -->
                                    <!-- Tour site extra info [start] -->
                                    <div class="col tab-pane fade" role="tabpanel" id="add-location-info">
                                        <div class="d-flex align-items-center gap-2 my-4">
                                            <h6 class="easygo-fw-1 m-0">Extra information</h6>
                                            <small class="text-gray-1 easygo-fs-6">(More information about the tour site)</small>
                                            <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                        </div>


                                        <div class="form-input-field">
                                            <label class="text-gray-1 easygo-fs-4 ">
                                                Owner Name
                                                <small class="text-gray-1 easygo-fs-6">(Optional)</small>
                                            </label>
                                            <input class="px-4 py-2 flex-grow-1" type="text" name="owner">
                                        </div>

                                        <div class="form-input-field">
                                            <label class="text-gray-1 easygo-fs-4 ">
                                                Owner Number
                                                <small class="text-gray-1 easygo-fs-6">(Optional)</small>
                                            </label>
                                            <input class="px-4 py-2 flex-grow-1" type="text" name="number">
                                        </div>

                                        <div class="form-input-field">
                                            <label class="text-gray-1 easygo-fs-4 ">
                                                Website
                                                <small class="text-gray-1 easygo-fs-6">(Optional)</small>
                                            </label>
                                            <input class="px-4 py-2 flex-grow-1" type="text" name="website">
                                        </div>

                                        <div class="form-input-field">
                                            <label class="text-gray-1 easygo-fs-4 ">
                                                Tiktok handle
                                                <small class="text-gray-1 easygo-fs-6">(Optional)</small>
                                            </label>
                                            <input class="px-4 py-2 flex-grow-1" type="text" name="tiktok">
                                        </div>

                                        <div class="form-input-field">
                                            <label class="text-gray-1 easygo-fs-4 ">
                                                Instagram handle
                                                <small class="text-gray-1 easygo-fs-6">(Optional)</small>
                                            </label>
                                            <input class="px-4 py-2 flex-grow-1" type="text" name="instagram">
                                        </div>

                                        <div class="form-input-field">
                                            <label class="text-gray-1 easygo-fs-4 ">
                                                Facebook handle
                                                <small class="text-gray-1 easygo-fs-6">(Optional)</small>
                                        </label>
                                            <input class="px-4 py-2 flex-grow-1" type="text" name="facebook">
                                        </div>
                                    </div>
                                </div>
                                <!-- Tour site extra info [end] -->
                                <div>
                                    <button class="easygo-btn-1 mt-4 ms-auto easygo-fs-5"  data-bs-dismiss="modal">Create Tour site</button>
                                </div>
                                <div class="d-flex justify-content-end gap-2 align-items-center mt-4">
                                    <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>
    <!-- Add toursite modal [end] -->
    <!-- ============================== -->


    <!-- ============================== -->
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- EHImageUpload js -->
    <script src="../assets/js/EhImageUploadDisplay.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/curator_general.js"></script>
    <script src="../assets/js/create_a_trip.js"></script>
</body>

</html>