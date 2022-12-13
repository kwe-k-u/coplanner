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
        <header class="dashboard-header">
            <div class="logo logo-medium">
                <img class="img-fluid" src="../assets/images/svgs/logo.svg" alt="easygo logo">
            </div>
            <div class="dashboard-title">Dashboard</div>
            <div class="right-sec">
                <form id="dashboard-search">
                    <div class="form-input-field">
                        <input type="text" placeholder="search">
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
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
            <aside class="sidebar d-flex flex-column justify-content-between">
                <ul class="main-list">
                    <li>
                        <div class="slide-down-menu">
                            <a class="slide-down-btn" href="#">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="19" height="19" transform="matrix(-1 0 0 1 19 0)" fill="url(#pattern0)" />
                                    <defs>
                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#image0_184_884" transform="scale(0.01)" />
                                        </pattern>
                                        <image id="image0_184_884" width="100" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAAHEUlEQVR4nO3db4gcdx3H8fd3ZnaTy6UhKvSSWFFEimigwfwpSpHmQUyyl1zusm4UaqA+EMEKatX6oLUsijUi1iD1X31gQKJwm7trc7m73AP/IEpjGimaxqoIKZjGXERNy93lsvPn64N4klSa+e3uzM7P7e8Fefad2U/yye7OzM1vDhzHcRzHcRzHcbpL2tpqeGKt75UrImwRGAApZZpKiVX0sqDnQg0mGd/1t0z2u//k+pIXD6nyrv/k9jLZ739pqDCn8Gzsladp7Hi51T20VkhttC9IVj8M+mmgv9UXa1Ok6A9jz3uYRuXvbe1hZPZ2X6KviPBRwM823mtaQPXxaE3/YxzZvmS6kXkhtal1QcIksKWddJ1SeNFPdG9zYs/zrWxXHjmxUT05ofDWvLLdknI6iqIhju+bMxk3K6Q22hfE/b9A2NZRuE6JXIwk3kZj70tG8/tPrg8kPg3ckW+wVL+Nmsn7mdy7mDZo9BkaxKseKbwMANUNgcph0/FA4u9QfBkAm4MV3kMmg+nvkOGJtYFfvkD3vjPSqIe3qTm2+/e3GiqNTN6lnvcc7R64ZE7nI2/FHWlf9KnvED9YMYg9ZQBIglbThtTza1hTBoCs9vXa7rSp1EJEdXM2gbKkWw2GCjn4uBUxyJReCAxkEydT69JH1LrckqTnNvhSz/ikLxNaNpixL7d4qbkzPlN1OuUKsYwrxDKuEMu4QizjCrGMK8QyrhDLuEIs4wqxjCvEMj1ciBj/HLtrVK+mjfRwIVwsOsCrqaRn6t1CVH5VdIRXU5Ffps30bCGBHzWAsOgcN7gUL/CztKGeLWSpMXRe4cmicywToc5M5VraXM8WAhB7C58Hni06BzAeHqsY/efo6UJoHLgaJcEe4NdFRRDVo9Ftq+4DUZP53i4EYGLn5ehNA9sFPgVkc4+wmRdU9EA4vucjrdxKGuSZyBpPbglD+Bb1+hPBuc13S+JvVNE3o7Iy09dRnRe4IKpnWr3lddnro5Bl9XoSwTNc/2Ol3v/I+j/jCrGMK8QyrhDLuEIs4wqxzOvrsHdZ7eQbywnr1YsyPQ+RRBea3uoLNLbPt7uP1EISkiti0zILAOVfrW6ysnri7aHKZ8WTYZJ4QwKQZPv3UoQgWYTq1J8RRqP42mEm9v+jlX2kL0cQ78X2I+ZDRM63Mh988MQXIuQFET6B6oa8ct3gTpRHAm/FX/zqVOriohsZLNhhpv1c+UgwzxRUpw6jcggwWMKQubUCjVJ1+mOmG6QWEo5VngNOdRQrSyIX42bytMloaf/U/Vy/qFgkUfTbperU3SbDRkdZovIZLPnpm8JDJsuLOTjbr8JXuxDJRElVvmkyaFRIOF45JcgDgNE1/dyIfiM+VjlqMuovhiMYLX3rEtH3lmpTm9LGjM9DwrHKDxRq0PoRTgaWBB6Mju35nOkGnrIrz0Dt0JjOV+HeKB4bHIs8/x2ofhn4U9vJzF1Q9IlIeWc4Nmj0ll+mIm/LK1S7TDK1fmLY2PXPCB4FHuXgbH95sfkW9STTdeySBEvN+OpLPDVypf296FqrlqkDHrwhTpnp7Ez9RzsXmvDHjvbh3MRdy7KMK8QyrhDLuEIs4wqxjCvEMm0f9pZGJu/C996j6O1ZBlomyBVFz0Ybz5yiXk/yeA0btViIil+d/rBAXa9f8yevk6/rF82E4OzWS1KdOhR6C9+lcaCZy4tZxPwjqzbaV6pO/0Tgx8Cd+UX6H+sUDgfxqp8yMpvLu9EmhoWolJL+IwofyjfOLYjcE3jRLAdnbXrcYOaMCilVZx5QOJB3GAOb/MXwUNEh8pReyP0/X6noF7uQxYggH2d4xroruVlJfyrpKwsfAGz67C4FflIrOkReTO46eV83grRE5J6iI+TF4KmkXbltpjXduZWnECZPJc12lVEmtK/oBHlxl04s4wqxjCvEMq4Qy7hCLOMKsYwrxDKuEMu4QizjCrGMK8QyBoWoFQt1biYGP1sX+3Jrkpo7tRCFS9mkyZDB0z0R+3KrSOdPJVU4k02cTJlksi63yb9laiGxV54GFjJJlA31hLG0IYmTYxS9BO8mOh+vlJNpU+nfIY0dL6P6eCaZMiAw2mwMnk2bCyf2/g4Y70IkU1/naOWVtCGjo6xoTf9jwG86jtQpkYthGD1oOh55fFLgr3lGMqLyTLTofc1k1Oyw98j2pSiM9lFgKQrnPWEHx/eZP0K8MXhJ8HcrFPk0ilOR+sMmz+yFVs5Dju+bi25bdS/Il+jud0qk8L04uba12aj8odWNm2O7zsXlZKsq3weiHPK9Bp1HqUeLci8TOy+bbtXejbn3Ta/xr7JbRLeJ6oDJb7BsiRKr6JwIz4fNaNL0l8OnGnp6oFQqDSn6blEZQPAz2e8yTZoqMqcqp+M+Zky+MxzHcRzHcRzHcYr2bzt6Hi0gKMShAAAAAElFTkSuQmCC" />
                                    </defs>
                                </svg> Dashboard</a>
                            <ul class="sub-menu slide-down-sub-menu">
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
            <div class="main-content container">
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
                                    <div class="file-input">
                                        <div class="upload-symbol">
                                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                                        </div>
                                        <a>Click to upload or drag and drop</a>
                                        <span class="text-gray-1">SVG , PNG, JPG or GIF. (800 x 400 px)</span>
                                        <input accept=".png, .jpg, .jpeg, .svg" type="file">
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
                                    <input type="text" placeholder="Activities">
                                    <button type="button" class="add-item btn"><img src="../assets/images/svgs/plus.svg" alt="plus sign"> Add Another</button>
                                </div>
                                <div class="form-input-field">
                                    <input type="text" placeholder="Locations">
                                    <button type="button" class="add-item btn"><img src="../assets/images/svgs/plus.svg" alt="plus sign"> Add Another</button>
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
                                    <div class="col-lg-6 ps-0">
                                        <div class="form-input-field">
                                            <h6 class="easygo-fs-4 text-gray-1">Start Date</h6>
                                            <input type="text" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pe-0">
                                        <div class="form-input-field">
                                            <h6 class="easygo-fs-4 text-gray-1">End Date</h6>
                                            <input type="text" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 ps-0">
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
                                    <div class="col-lg-6 pe-0">
                                        <div class="form-input-field">
                                            <h6 class="easygo-fs-4 text-gray-1">Seats</h6>
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
</body>

</html>