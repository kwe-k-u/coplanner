<?php
require_once(__DIR__ . "/utils/core.php");
require_once(__DIR__ . "/utils/env_manager.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/utils/analytics/google_tag.php") ?>
    <?php include_once(__DIR__ . "/utils/analytics/google_head_tag.php") ?>
    <link rel="icon" href="assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>easyGo - Home</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="assets/css/general.css">
        <!-- Paste this right before your closing </head> tag -->
        <!-- <script type="text/javascript">
        (function(f, b) {
            if (!b.__SV) {
                var e, g, i, h;
                window.mixpanel = b;
                b._i = [];
                b.init = function(e, f, c) {
                    function g(a, d) {
                        var b = d.split(".");
                        2 == b.length && ((a = a[b[0]]), (d = b[1]));
                        a[d] = function() {
                            a.push([d].concat(Array.prototype.slice.call(arguments, 0)));
                        };
                    }
                    var a = b;
                    "undefined" !== typeof c ? (a = b[c] = []) : (c = "mixpanel");
                    a.people = a.people || [];
                    a.toString = function(a) {
                        var d = "mixpanel";
                        "mixpanel" !== c && (d += "." + c);
                        a || (d += " (stub)");
                        return d;
                    };
                    a.people.toString = function() {
                        return a.toString(1) + ".people (stub)";
                    };
                    i = "disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
                    for (h = 0; h < i.length; h++) g(a, i[h]);
                    var j = "set set_once union unset remove delete".split(" ");
                    a.get_group = function() {
                        function b(c) {
                            d[c] = function() {
                                call2_args = arguments;
                                call2 = [c].concat(Array.prototype.slice.call(call2_args, 0));
                                a.push([e, call2]);
                            };
                        }
                        for (var d = {}, e = ["get_group"].concat(Array.prototype.slice.call(arguments, 0)), c = 0; c < j.length; c++) b(j[c]);
                        return d;
                    };
                    b._i.push([e, f, c]);
                };
                b.__SV = 1.2;
                e = f.createElement("script");
                e.type = "text/javascript";
                e.async = !0;
                e.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ? MIXPANEL_CUSTOM_LIB_URL : "file:" === f.location.protocol && "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";
                g = f.getElementsByTagName("script")[0];
                g.parentNode.insertBefore(e, g);
            }
        })(document, window.mixpanel || []);
    </script> -->
</head>
<?php include_once(__DIR__ . "/utils/analytics/google_body_tag.php") ?>

<body class="bg-gray-3">

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once("coplanner/coplanner_navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main class="container">
            <!--- ================================ -->
            <!--- Section 1 [start] -->
            <section class="" style="margin-top: 7rem;">
                <div class="row">
                    <div class="col-lg-6 p-3 d-flex flex-column justify-content-center">
                        <div class="d-flex flex-column gap-5">
                            <h2 class=" easygo-fw-1">Travel Plans that <span class="text-blue">feel just right</span></h2>
                            <div class="easygo-fs-2">
                                We let adventure seekers to quickly craft travel plans that capture
                                unique thrilling experiences and book the destinations included in those plans
                            </div>
                            <a href='./coplanner/coplanner_setup.php' class='easygo-btn-5 bg-blue  text-white easygo-fs-4 w-50'>Create Your Travel Plan</a>

                        </div>
                    </div>
                    <div class="col-lg-6 p-3">
                        <div class="w-100 h-100 d-flex justify-content-center">
                            <img class="img-fluid" src="assets/images/others/long_11.jpeg" alt="coplanner image">
                        </div>
                    </div>
                </div>
            </section>
            <!--- Section 1 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Shared Experience Section [start] -->
            <section class="my-5">

                <h2 class="easygo-fw-1 mb-4">Looking for a Shared Experience?</h2>
                <h5 class="text-orange">Tours organised by our Curators</h5>
                <div class="row">

                <?php
                    $shared_experiences = get_shared_experiences();
                    foreach ($shared_experiences as $entry) {
                        $currency = $entry["currency_name"];
                        $price = $entry["booking_fee"];
                        $curator_name = $entry["curator_name"];
                        $experience_id = $entry["experience_id"];
                        echo "<div class='col-lg-4 col-md-6 p-3'>
                        <div class='trip-card'>
                            <img src='http://localhost/easygo_v2/uploads/picture/d48c0181dcfe7ba678829d2165c092e0.jpg' alt='trip card image'>
                            <div class='trip-card-body'>
                                <div class='trip-card-header'>
                                    <div class='title'>
                                        <h5 class='easygo-fw-1'>Name of tour</h5>
                                        <!-- <p class='text-gray-1 easygo-fs-5'>Accra, Ghana</p> -->
                                        <div class='text-gray-1 location easygo-fs-4'>
                                            Curated by <a href='curator_profile.php?id=791f40acb7ce8843d0894ba2f00731e9'>$curator_name</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='trip-card-content'>
                                    Our tour begins with a pick-up from your hotel in the city and a comfortable drive to the countryside, where you can breathe in the fresh air and take in the beauty of nature. Our first stop will be at a local farm, where you can see how the farmers cul...
                                </div>
                            </div>
                            <div class='trip-card-footer'>
                                <h3>$currency $price</h3>
                                <a href='coplanner/itinerary_view.php?experience_id=$experience_id' class='easygo-btn-1'>View tour</a>
                            </div>
                        </div>
                    </div>
                        ";
                    }
                ?>



                </div>
            </section>
            <!--- Shared Experience Section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 2 [start] -->
            <section class="my-5">
                <div>
                    <h2 class="easygo-fw-1 mb-4">Why People use easyGo for Private Tours</h2>
                    <div class="row">
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Flexibility</h3>
                                <div class="py-2">
                                    We give you control over the details of your travel plan's activity list, budget and destinations.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Time Savings</h3>
                                <div class="py-2">
                                    Create a full-proof itinerary complete with destination activities, transportation and lodging in minutes </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-2 text-center">
                            <div>
                                <h3 class="text-blue">Convenience</h3>
                                <div class="py-2">
                                    Plan ahead of time and book your destinations and vehicle rentals
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--- Section 2 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 3 [start] -->

            <div class="about-intro-third pt-3 my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">

                            <div>
                                <h2 class="text-blue easygo-fw-1 text-capitalize">You know yourself best</h2>
                                Planning a Vacation is hard. easyGo leverages the experiences of our Curators and insights from destinations to suggest the perfect Travel Plan for you.
                                Our service also allows you to change the Travel Plan to suit your needs, while booking services from hotels, tour guides and vehicle rental providers
                                to make your Vacation effort-free.
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                            <div class="grid-3" style="max-height: 500px">
                                <div class="grid-item">
                                    <img src="assets/images/others/tall_10.jpeg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="assets/images/others/long_1.jpeg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="assets/images/others/tall_3.jpeg" alt="scenery" class="w-100 h-100">
                                </div>
                                <div class="grid-item">
                                    <img src="assets/images/others/tall_7.jpeg" alt="scenery" class="w-100 h-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--- Section 3 [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- Section 4 [start] -->
            <?php
            include_once(__DIR__ . "/components/itinerary_suggestions.php");
            ?>
            <!--- Section 4 [end] -->
            <!--- ================================ -->
        </main>
        <?php require_once(__DIR__ . "/components/footer.php") ?>
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__ . "/utils/js_env_variables.php"); ?>
    <script src="assets/js/general.js"></script>
    <script src="assets/js/functions.js"></script>
    <!-- <script type="module">
        import mixpanel from '/mixpanel-browser';

 mixpanel.init('33830dd3c5a5d9cb294c908501c7483e', {debug: true, track_pageview: true, persistence: 'localStorage'});

 // Set this to a unique identifier for the user performing the event.
 mixpanel.identify('testing_localhost')

 // Track an event. It can be anything, but in this example, we're tracking a Sign Up event.
 mixpanel.track('Sign Up', {
   'Signup Type': 'Referral'
 })
    </script> -->


</body>

</html>