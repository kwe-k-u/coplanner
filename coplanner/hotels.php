<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - About</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <style>
        /* Mobile */
        @media only screen and (max-width: 992px) {

            #mc_embed_signup {
                margin: 1rem !important;
            }
        }

        /* form body  */
        #mc_embed_signup {
            display: flex;
            text-align: center;
            gap: 1rem;
            flex-direction: column;
            padding: 2rem;
            background-color: var(--easygo-blue);
            border-radius: var(--easygo-br-3);
            margin: 2.5rem;
            text-transform: capitalize;
        }

        /* subscribe button  */
        #mc-embedded-subscribe {
            flex: 1;
            display: inline;
            border-radius: 12px;
            border: none;
            outline: none;
            padding: 1rem 0.5rem;
            background-color: var(--easygo-orange);
            --bs-text-opacity: 1;
            color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
        }

        .mc-field-group {
            display: inline;
        }

        .clear {
            display: inline;
        }

        .optionalParent {
            display: inline;
        }

        /* input field email  */
        #mce-EMAIL {
            width: 80%;
            flex: 2;
            border: none;
            outline: none;
            padding: 1rem 0.5rem;
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main>
            <!--- ================================ -->
            <!--- about intro [start] -->
            <section class="about-intro">
                <div class="justify-content-center">
                    <img src="../assets/images/site_images/logo.png" alt="">
                </div>
                <div class="about-intro-first my-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="easygo-fs-1 text-orange">About Us</p>
                                <h1 class="easygo-h3 easygo-fw-1 text-blue">
                                    Tour Planning Like Never Seen Before.
                                </h1>
                                <p>
                                    easyGo allows adventure seekers to quickly craft travel
                                    plans that capture unique thrilling experiences and book the destinations included in those plans.
                                    Our platform places hotels and tour destinations right in front of tourists as they make their plans.
                                    Join our destination partnership program to receive bookings directly from tourists
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <div class="stacked-imgs m-auto">
                                    <img src="../assets/images/others/long_11.jpeg" alt="scenery">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="p-5 my-5">
                    <div>
                        <h2 class="easygo-fw-1 mb-4 text-center">What this means for you</h2>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-4 p-2 text-center justify-content-center">
                                <div>
                                    <h3 class="text-blue">Wider Market</h3>
                                    <div class="py-2">
                                        Reach the larger tourism market in Ghana by listing your services on our platform
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 p-2 text-center">
                                <div>
                                    <h3 class="text-blue">Convenience</h3>
                                    <div class="py-2">
                                        An easy to use system that works with your system to manage booking requests and payments!
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>
                </section>
                <div class="about-intro-second my-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                <div class="grid-3" style="max-height: 500px">
                                    <div class="grid-item">
                                        <img src="../assets/images/others/tall_10.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/long_1.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/tall_3.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                    <div class="grid-item">
                                        <img src="../assets/images/others/tall_7.jpeg" alt="scenery" class="w-100 h-100">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                <div>
                                    <p class="easygo-fs-1 text-orange">Why work with us?</p>
                                    <h1 class="easygo-h3 easygo-fw-1 text-blue text-capitalize">
                                        we want to see your business grow
                                    </h1>
                                    <p>
                                        Running a business in today's economy is difficult. Why spend thousands on advertisement when
                                        easyGo can recommend your services to tourists and vacationists? Our platform will recommend your
                                        services to tourists as they plan their trips and secure their bookings with you; payment included.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!--- about intro [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- milesontes [start] -->
            <section class="about-intro" style="margin-top: 10rem;">
                <div class="container">
                    <h1 class="easygo-h3 text-blue text-center">Our Milestones</h1>
                    <p class="text-center">We have attended a number of reputable events and have recieved numerous awards to show for our
                        achievemets
                    </p>
                    <div class="d-flex gap-4" style="overflow-x: auto;">
                        <div>
                            <div class="easygo-card-1">
                                <div class="img-holder">
                                    <img src="../assets/images/others/avi.jpg" class="about-img" alt="" srcset="">
                                </div>
                                <div class="card-content">
                                    <small class="text-gray-1">2023</small>
                                    <h5 class="text-capitalize easygo-fw-1">
                                        Ashesi Venture Incubator
                                    </h5>
                                    <p>We have been accepted into the Ashesi Venture Incubator, a 12- month business
                                        development program that provides funding and industry mentorship to improve our business

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="easygo-card-1">
                                <div class="img-holder">
                                    <img src="../assets/images/site_images/career-fair-award.jpg" class="about-img">
                                </div>
                                <div class="card-content">
                                    <small class="text-gray-1">
                                        2023</small>
                                    <h5 class="text-capitalize easygo-fw-1">
                                        Most Entreprising Business Award
                                    </h5>
                                    <p> We were recognised during the 2023 Ashesi University Career Fair as the
                                        second runner-up in the Most Enterprising Business Pitch competition
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="easygo-card-1">
                                <div class="img-holder">
                                    <img src="../assets/images/site_images/d-lab-expo.jpg" alt="" class="about-img">
                                </div>
                                <div class="card-content">
                                    <small class="text-gray-1">2022</small>
                                    <h5 class="text-capitalize easygo-fw-1">
                                        Ashesi Design Lab: Expo
                                    </h5>
                                    <p> We were awarded category leader in Health and Lifestyle during the 2022 Ashesi Design Lab Exposition</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--- milestones [end] -->
            <!--- ================================ -->
                <!--- ================================ -->
                <!--- News letter section [start] -->
            <!-- <section class="nl-subscribe my-5">
                <div class="container">
                    <form class="nl-subscription-form py-5">
                        <h4 class="title text-white">subscribe to our newsletter to get the latest information about trips directly from email</h4>
                        <div class="input-field">
                            <input id="newsletter_email_field" type="text" placeholder="Your email address">
                            <button class=" bg-orange text-white" type="submit" name="submit" id="mc-embedded-subscribe">Subscribe</button>
                        </div>
                    </form>
                </div>
            </section> -->

            <div id="mc_embed_shell">
                <div id="mc_embed_signup">
                    <form action="https://easygo.us21.list-manage.com/subscribe/post?u=2bd1d8f7814d0d70eb78d4383&amp;id=12c7d925fc&amp;f_id=001af5e6f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                        <div id="mc_embed_signup_scroll">

                            <h4 class="title text-white">subscribe to our newsletter to get the latest information about trips directly from email</h4>
                            <div class="mc-field-group">
                                <input type="email" name="EMAIL" placeholder="Your Email Address" class="required email" id="mce-EMAIL" required="" value="">
                            </div>
                            <div id="mce-responses" class="clear foot">
                                <div class="response" id="mce-error-response" style="display: none;"></div>
                                <div class="response" id="mce-success-response" style="display: none;"></div>
                            </div>
                            <div aria-hidden="true" style="position: absolute; left: -5000px;">
                                /* real people should not fill this in and expect good things - do not remove this or risk form bot signups */
                                <input type="text" name="b_2bd1d8f7814d0d70eb78d4383_12c7d925fc" tabindex="-1" value="">
                            </div>
                            <div class="optionalParent">
                                <div class="clear foot">
                                    <input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Subscribe">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--- News Letter section [end] -->
            <!--- ================================ -->
        </main>
        <!--- ================================ -->
        <!--- footer [start] -->
        <?php
        require_once("../components/footer.php")
        ?>
        <!--- footer [end] -->
        <!--- ================================ -->
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>

    <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
                <script type="text/javascript">
                    (function($) {
                        window.fnames = new Array();
                        window.ftypes = new Array();
                        fnames[0] = 'EMAIL';
                        ftypes[0] = 'email';
                        fnames[1] = 'FNAME';
                        ftypes[1] = 'text';
                        fnames[2] = 'LNAME';
                        ftypes[2] = 'text';
                        fnames[3] = 'ADDRESS';
                        ftypes[3] = 'address';
                        fnames[4] = 'PHONE';
                        ftypes[4] = 'phone';
                        fnames[5] = 'BIRTHDAY';
                        ftypes[5] = 'birthday';
                        fnames[6] = 'AGE';
                        ftypes[6] = 'radio';
                        fnames[7] = 'GENDER';
                        ftypes[7] = 'radio';
                    }(jQuery));
                    var $mcj = jQuery.noConflict(true);
                </script>
</body>

</html>