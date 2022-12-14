<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curator - Dashboard</title>
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
                        <input class="p-2" type="text" placeholder="&#128269;search">
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
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            <div id="dashboard-menu" class="slide-down-sub-menu">
                <ul class="main-list">
                    <li>
                        <div class="slide-down-menu">
                            <a data-target="dashboard-submenu" class="slide-down-btn" href="#">
                                <img src="../assets/images//svgs/dashboard.svg" alt="dashboard image"> Dashboard</a>
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
                            <a data-target="dashboard-submenu-sb" class="slide-down-btn" href="#"><img src="../assets/images//svgs/dashboard.svg" alt="dashboard image"> Dashboard</a>
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
                    <a class="text-gray-1 easygo-fs-4" href="#"><img src="../assets/images/svgs/logout.svg" alt="logout icon"> Logout</a>
                </div>
            </aside>
            <div class="main-content px-3">
                <section class="create-trip">
                    <div class="d-flex justify-content-between align-items-center border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">Create a trip</h5>
                            <small class="easygo-fs-5 text-gray-1"><a href="#">Trips</a> > Create Trip</small>
                        </div>
                        <button class="easygo-btn-2">Preview</button>
                    </div>
                    <form>
                        <div class="row border-1 border-bottom py-4 pe-lg-5">
                            <div class="col-lg-5">
                                <h3 class="easygo-fs-3 easygo-fw-1">Header</h3>
                                <p class="text-gray-1 easygo-fs-5">set a cover photo and title for trip</p>
                            </div>
                            <div class="col-lg-7 d-flex flex-column gap-4">
                                <div>
                                    <div data-bs-toggle="modal" data-bs-target="#upload-img-modal" class="file-input">
                                        <div class="upload-symbol">
                                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                        </div>
                                        <a>Click to upload or drag and drop</a>
                                        <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                        <!-- <input accept=".png, .jpg, .jpeg, .svg" type="file"> -->
                                    </div>
                                </div>
                                <div class="form-input-field">
                                    <input type="text" placeholder="Full Name">
                                </div>
                            </div>
                        </div>
                        <div class="row border-1 border-bottom py-4 pe-lg-5">
                            <div class="col-lg-5">
                                <h3 class="easygo-fs-3 easygo-fw-1">Trip Description</h3>
                                <p class="text-gray-1 easygo-fs-5">Write a description</p>
                            </div>
                            <div class="col-lg-7">
                                <div>
                                </div>
                                <div class="form-input-field">
                                    <textarea style="resize: none" cols="30" rows="7" placeholder="Trip description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row border-1 border-bottom py-4 pe-lg-5">
                            <div class="col-lg-5">
                                <h3 class="easygo-fs-3 easygo-fw-1">Trip Images</h3>
                                <p class="text-gray-1 easygo-fs-5">Add images to your trip</p>
                            </div>
                            <div class="col-lg-7">
                                <div>
                                    <div class="file-input">
                                        <div class="upload-symbol">
                                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                        </div>
                                        <a>Click to upload or drag and drop</a>
                                        <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                        <input accept=".png, .jpg, .jpeg, .svg" type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-1 border-top border-bottom py-4 pe-lg-5">
                            <div class="col-lg-5">
                                <h3 class="easygo-fs-3 easygo-fw-1">Activities & Locations</h3>
                                <p class="text-gray-1 easygo-fs-5">Add activities and locations</p>
                            </div>
                            <div class="col-lg-7 d-flex flex-column gap-4">
                                <div class="form-input-field">
                                    <input id="activity-input" type="text" placeholder="Activities">
                                    <button data-sender="activity-input" data-target="activity-list" type="button" class="pad-item-add btn"><img src="../assets/images/svgs/plus.svg" alt="plus sign"> Add Another</button>
                                    <div id="activity-list" class="item-pad-list">
                                    </div>
                                </div>
                                <div class="form-input-field">
                                    <input id="location-input" type="text" placeholder="Locations">
                                    <button data-sender="location-input" data-target="location-list" type="button" class="pad-item-add btn"><img src="../assets/images/svgs/plus.svg" alt="plus sign"> Add Another</button>
                                    <div id="location-list" class="item-pad-list">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-1 border-top border-bottom py-4 pe-lg-5">
                            <div class="col-lg-5">
                                <h3 class="easygo-fs-3 easygo-fw-1">Trip Occurence</h3>
                                <p class="text-gray-1 easygo-fs-5">Add trip occurence</p>
                            </div>
                            <div class="col-lg-7 d-flex flex-column gap-4">
                                <div class="row">
                                    <div class="col-lg-6 pb-3 p-0 pe-lg-1">
                                        <div class="form-input-field">
                                            <h6 class="easygo-fs-4 text-gray-1">Start Date</h6>
                                            <input type="text" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pb-3 p-0 ps-lg-1">
                                        <div class="form-input-field">
                                            <h6 class="easygo-fs-4 text-gray-1">End Date</h6>
                                            <input type="text" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 p-0 pe-lg-1 pb-3">
                                        <div class="form-input-field">
                                            <h6 class="easygo-fs-4 text-gray-1">Fee</h6>
                                            <div class="d-flex">
                                                <div class="dropdown">
                                                    <a style="background: var(--easygo-gray-3); height: 100%; border: solid 1px var(--easygo-gray-2); gap: 3px; font-size: var(--font-size-4);" class="btn rounded-0 rounded-start border-end-0 d-flex align-items-center dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                        &#8373;
                                                    </a>
                                                    <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuLink">
                                                        <li><span class="text-blue">&#36;</span> US dollar</li>
                                                        <li><span class="text-blue">&pound;</span> Pound</li>
                                                        <li><span class="text-blue">&yen;</span> Yen</li>
                                                    </ul>
                                                </div>
                                                <input class="rounded-end rounded-0" type="text" placeholder="Fee">
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
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-field py-5 pe-5 d-flex justify-content-end gap-3">
                            <input class="btn btn-default border px-4 py-2 easygo-fs-4" type="reset" value="cancel">
                            <input class="easygo-btn-1 px-4 py-2 easygo-fs-4" type="submit">
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">

                <form>
                    <div>
                        <h5 class="mb-2">Upload Image</h5>

                        <div>
                            <div class="file-input py-5">
                                <div class="upload-symbol">
                                    <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                </div>
                                <a>Click to upload or drag and drop</a>
                                <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                <input accept=".png, .jpg, .jpeg, .svg" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="row my-5">
                        <h5 class="mb-2">Recent uploads</h5>
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                        <div class="col-lg-4">
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
                    </div>

                    <!-- Modal footer -->
                    <div class="d-flex justify-content-end gap-2 align-items-center">
                        <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5" data-bs-dismiss="modal">Close</button>
                        <button style="width: 5rem;" type="button " class="easygo-btn-1 py-2 easygo-fs-5">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Upload image modal [end] -->
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