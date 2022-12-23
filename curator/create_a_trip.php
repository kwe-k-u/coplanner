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
                                    <div data-bs-toggle="modal" data-bs-target="#upload-img-modal" class="file-input">
                                        <div class="upload-symbol">
                                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                        </div>
                                        <a>Click to upload or drag and drop</a>
                                        <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                        <!-- <input accept=".png, .jpg, .jpeg, .svg" type="file"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-1 border-top border-bottom py-4 pe-lg-5">
                            <div class="col-lg-5">
                                <h3 class="easygo-fs-3 easygo-fw-1">Activities & Locations</h3>
                                <p class="text-gray-1 easygo-fs-5">Add activities and locations</p>
                            </div>
                            <div class="col-lg-7 ">
                                <button class="btn btn-default border px-5" type="button" data-bs-toggle="modal" data-bs-target="#activities-locations-modal"><img src="../assets/images/svgs/plus.svg" alt="plus sign"> &nbsp; Add Activities & Location</button>
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
                                            <input class="date-input" type="text" pattern="\d{2}-\d{2}-\d{4}" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pb-3 p-0 ps-lg-1">
                                        <div class="form-input-field">
                                            <h6 class="easygo-fs-4 text-gray-1">End Date</h6>
                                            <input class="date-input" type="text" pattern="\d{2}-\d{2}-\d{4}" placeholder="dd/mm/yyyy">
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
                                                        GHS
                                                    </a>
                                                    <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuLink">
                                                        <li>GHS</li>
                                                        <li>USD</li>
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
                            <input class="easygo-btn-1 px-4 py-2 easygo-fs-4" type="submit" value="Create Trip">
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

                <form>
                    <div class="px-2">
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
                        <div class="col-lg-4 pb-3">
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
                        <div class="col-lg-4 pb-3">
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
                        <div class="col-lg-4 pb-3">
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
                        <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                        <button style="width: 5rem;" type="button " class="easygo-btn-1 py-2 easygo-fs-5 easygo-fw-2">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- add_activities_&_locations modal [end] -->
    <!-- ============================== -->
    <!-- ============================== -->
    <!-- add_activities_&_locations modal [start] -->
    <div class="modal fade" id="activities-locations-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-5">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="mb-4">Add Trip And Activities</h6>
                        <div class="al-search">
                            <div class="d-flex gap-2">
                                <div class="form-input-field">
                                    <input class="px-4 py-2 flex-grow-1" type="text" placeholder="Full Name">
                                    <small class="easygo-fs-5">4 results found in <span class="text-gray-1">Ghana</span></small>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-default border dropdown-toggle text-blue px-4 py-2" type="button" id="citymenu" data-bs-toggle="dropdown" aria-expanded="false">
                                        City
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="citymenu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <button class="btn btn-default border text-blue px-4 py-2">Filter</button>
                                </div>
                            </div>
                        </div>
                        <div class="location-listing py-4">
                            <div class="location-card border p-4 rounded my-3">
                                <div class="header d-flex justify-content-between">
                                    <h1 class="easygo-fs-3 text-capitalize">Legon Botanical Gardens</h1>
                                    <h5 class="easygo-fs-4 text-orange">GHC 20 - 40</h5>
                                </div>
                                <div class="text-gray-1 easygo-fs-6">
                                    <div class="rating-and-info d-flex align-items-center gap-1">
                                        <span>4.3</span>
                                        <span>
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/empty_star.svg" alt="star">
                                        </span>
                                        <span>(1708)</span>
                                    </div>
                                    <div class="time pt-2">
                                        <span>Open</span>
                                        &nbsp;
                                        &nbsp;
                                        <span>Closes 5pm</span>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <button class="easygo-btn-1 easygo-fs-5 py-1 px-4">See More</button>
                                </div>
                            </div>
                            <div class="location-card border p-4 rounded my-3">
                                <div class="header d-flex justify-content-between">
                                    <h1 class="easygo-fs-3 text-capitalize">Legon Botanical Gardens</h1>
                                    <h5 class="easygo-fs-4 text-orange">GHC 20 - 40</h5>
                                </div>
                                <div class="text-gray-1 easygo-fs-6">
                                    <div class="rating-and-info d-flex align-items-center gap-1">
                                        <span>4.3</span>
                                        <span>
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/empty_star.svg" alt="star">
                                        </span>
                                        <span>(1708)</span>
                                    </div>
                                    <div class="time pt-2">
                                        <span>Open</span>
                                        &nbsp;
                                        &nbsp;
                                        <span>Closes 5pm</span>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <button class="easygo-btn-1 easygo-fs-5 py-1 px-4">See More</button>
                                </div>
                            </div>
                            <div class="location-card border p-4 rounded my-3">
                                <div class="header d-flex justify-content-between">
                                    <h1 class="easygo-fs-3 text-capitalize">Legon Botanical Gardens</h1>
                                    <h5 class="easygo-fs-4 text-orange">GHC 20 - 40</h5>
                                </div>
                                <div class="text-gray-1 easygo-fs-6">
                                    <div class="rating-and-info d-flex align-items-center gap-1">
                                        <span>4.3</span>
                                        <span>
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/empty_star.svg" alt="star">
                                        </span>
                                        <span>(1708)</span>
                                    </div>
                                    <div class="time pt-2">
                                        <span>Open</span>
                                        &nbsp;
                                        &nbsp;
                                        <span>Closes 5pm</span>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <button class="easygo-btn-1 easygo-fs-5 py-1 px-4">See More</button>
                                </div>
                            </div>
                            <div class="location-card border p-4 rounded my-3">
                                <div class="header d-flex justify-content-between">
                                    <h1 class="easygo-fs-3 text-capitalize">Legon Botanical Gardens</h1>
                                    <h5 class="easygo-fs-4 text-orange">GHC 20 - 40</h5>
                                </div>
                                <div class="text-gray-1 easygo-fs-6">
                                    <div class="rating-and-info d-flex align-items-center gap-1">
                                        <span>4.3</span>
                                        <span>
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/full_star.svg" alt="star">
                                            <img src="../assets/images/svgs/empty_star.svg" alt="star">
                                        </span>
                                        <span>(1708)</span>
                                    </div>
                                    <div class="time pt-2">
                                        <span>Open</span>
                                        &nbsp;
                                        &nbsp;
                                        <span>Closes 5pm</span>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <button class="easygo-btn-1 easygo-fs-5 py-1 px-4">See More</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div>
                            <h5 class="loc-title pb-3 border-bottom">Legon Botanical Gardens</h5>
                            <div class="loc-info">
                                <p class="easygo-fs-5">
                                    Located in the heart of Accra in the University of Ghana is the Legon Botanical Gardens, a beautiful, dynamic outdoor play space for all ages where nature and fun collide.
                                    This dynamic Garden provides several recreational activities for the public and constantly adding new ones. The managers always give you reason to visit again and again. The facility has a colorful first class playground for children and a rope walk session for them also with genial staff.
                                </p>
                            </div>
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
                            <div class="activity-listing">
                                <div class="d-flex align-items-center gap-2 my-4">
                                    <h6 class="easygo-fw-1 m-0">Activities</h6>
                                    <small class="text-gray-1 easygo-fs-6">(Select activities to include)</small>
                                    <div class="bg-gray-2 flex-grow-1" style="height: 1px;"></div>
                                </div>
                                <div class="activity-list d-flex flex-wrap gap-2">
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">high rope course</span>
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">children playground</span>
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">canoeing</span>
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">fishing</span>
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">canopy walk</span>
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">woodland</span>
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">birdwatching</span>
                                    <span class="px-3 py-1 border-blue rounded border easygo-fs-5 text-capitalize">zipline</span>
                                </div>
                            </div>
                            <div>
                                <button class="easygo-btn-1 mt-4 ms-auto easygo-fs-5">Select Location</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="d-flex justify-content-end gap-2 align-items-center">
                    <button style="width: 5rem;" type="button" class="py-2 btn btn-default border easygo-fs-5 easygo-fw-2" data-bs-dismiss="modal">Close</button>
                    <button style="width: 5rem;" type="button " class="easygo-btn-1 py-2 easygo-fs-5 easygo-fw-2">Upload</button>
                </div>
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