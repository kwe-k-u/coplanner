<?php
    // TODO:: Take discount code and check if its valid. If yes, apply discount to fee calculations (book_trip front end, booking_processor)
    require_once(__DIR__."/../utils/core.php");
    // require_once(__DIR__."/../controllers/campaign_controller.php");
    require_once(__DIR__."/../controllers/interaction_controller.php");
    require_once(__DIR__."/../controllers/auth_controller.php");
    if (!isset($_GET["tour_id"])){
        header("Location: trips.php");
        die();
    }
    $id = $_GET["tour_id"];

    if(is_session_logged_in()){
        $user_id = get_session_user_id();
        $email_verified = get_user_by_id($user_id)["email_verified"];
        if($email_verified == 0){
            require(__DIR__."/verification_required.php");

            die();
        }
    }else {
        header("Location: login.php?redirect=book_trip.php?tour_id=$id");
    }



    $tour = get_campaign_by_tour_id($id);
    $name = $tour["title"];
    $fee = $tour["fee"];
    $currency = $tour["currency"];
    $max_seats = 5;
    $vat = $fee * VAT_RATE;
    $tourism = $fee * TOURISM_LEVY;
    $total = $vat + $tourism + $fee;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - Booking</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/home.css">
</head>

<body>

    <!-- main content start -->
    <div class="main-wrapper">
        <!--- ================================ -->
        <!-- navbar [start] -->
        <?php
        require_once("../components/navbar.php");
        ?>
        <!-- navbar [end] -->
        <!--- ================================ -->
        <main>
            <div class="container mb-4" style="margin-top: 10rem;">
                <a href="./trips.php">Tours</a> > Tour Invoice
            </div>
            <!--- ================================ -->
            <!--- image display section [start] -->
            <section class="image-display">
                <div class="container">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade rounded overflow-hidden" data-bs-ride="carousel">
                        <div class="carousel-indicators easygo-carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div style="max-height: 400px;">
                                    <img class="h-100 w-100" src="../assets/images/others/scenery1.jpg" alt="carousel image">
                                </div>
                            </div>
                            <div class="carousel-item active">
                                <div style="max-height: 400px;">
                                    <img class="h-100 w-100" src="../assets/images/others/tour1.jpg" alt="carousel image">
                                </div>
                            </div>
                            <div class="carousel-item active">
                                <div style="max-height: 400px;">
                                    <img class="h-100 w-100" src="../assets/images/others/tour2.jpg" alt="carousel image">
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </section>
            <!--- image display section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
            <!--- general information section [start] -->
            <section class="trip-info my-5">
                <div class="container px-lg-5">
                    <div class="text-center easygo-fs-1 my-5">
                        You're just one step away from a new <br> adventure
                    </div>
                    <div class="loader">

                    </div>
                    <div class="container px-lg-5">
                        <form class="px-lg-5" onsubmit="return book_trip(this)">
                        <?php
                            echo "<input type='hidden' name='user_id' value='$user_id'>";
                        ?>

                            <div class="contact-info mt-5">
                                <div class="easygo-fs-2 easygo-fw-1">Emergency Contact Information</div>
                                <p>
                                    We collect this information in order to contact someone in case of energencies involving you
                                </p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Contact's full name" name="contact_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <input class="border-blue" type="text" placeholder="Contact's Phone number" name="contact_number">
                                        </div>
                                    </div>

                                <div class="easygo-fs-2 easygo-fw-1">Number of seats</div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <div class="text-gray-1 easygo-fs-4">Number of Adults</div>
                                            <div class="easygo-num-input">
                                                <span data-input-target="#num-adults" class="icon-left plus"><i class="fa-solid fa-circle-plus"></i></span>
                                                <?php echo "<input id='num-adults' name='num_adults' onchange='display_invoice($fee,$max_seats)' type='number' class='border-blue text-center' value='1' min='0' max='$max_seats'>"; ?>

                                                <span data-input-target="#num-adults" class="icon-right minus"><i class="fa-solid fa-circle-minus"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <div class="text-gray-1 easygo-fs-4">Number of Children <span class="text-gray-2"> (Anyone below 18 years old)</span> </div>
                                            <div class="easygo-num-input">
                                                <span data-input-target="#num-kids" class="icon-left plus"><i class="fa-solid fa-circle-plus"></i></span>
                                                <?php echo "<input onchange='display_invoice($fee,$max_seats)' id='num-kids' name='num_kids' type='number' class='border-blue text-center' value='0' min='0' max='$max_seats'>"; ?>

                                                <span data-input-target="#num-kids" class="icon-right minus"><i class="fa-solid fa-circle-minus"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <div class="text-gray-1 easygo-fs-4">Invoice Email </div>
                                            <div class="easygo-num-input">
                                                <input type="email" name="invoice_email" id="invoice_email" class="text-center border-blue">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <div class="text-gray-1 easygo-fs-4">Discount code </div>
                                            <div class="easygo-num-input">
                                                <input type="text" name="discount_code" id="discount_code" class="text-center border-blue">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="general-info">
                                <!-- <div class="easygo-fs-2 easygo-fw-1">Payment Information</div> -->
                                <div class="row">

                                    <!-- <div class="col-lg-6">
                                        <div class="form-input-field py-2">
                                            <div class="text-gray-1 easygo-fs-4">Payment method</div>

                                            <select name="payment_method" onchange="return switch_method(this)">
                                                <option value="mobile money">Mobile money</option>
                                                <option value="credit card">Credit Card</option>
                                            </select>
                                        </div>
                                    </div> -->


                                    <!--- ================================ -->
                                    <!--- Mobile money section [start] -->
                                    <!-- <section id="mobile_money_section">
                                        <p>Pay with Mobile money</p>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-input-field py-2">
                                                    <select name="network">
                                                        <option value="AirtelTigo">AirtelTigo</option>
                                                        <option value="MTN">MTN</option>
                                                        <option value="Vodafone">Vodafone</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input-field py-2">
                                                    <input class="border-blue" name="number" type="phone" placeholder="050XXXXXXX">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="warning my-5 d-flex align-items-center gap-3">
                                            <img src="../assets/images/svgs/exclamation_orange.svg" alt="warning image">
                                            <span>Please ensure you have the SIM close to you to confirm payment</span>
                                        </div>
                                    </section> -->
                                    <!--- Mobile money section [end] -->
                                    <!--- ================================ -->
                                    <!--- ================================ -->
                                    <!--- Credit Card section [start] -->
                                    <!-- <section id="credit_card_section" class="hide">
                                        <div class="row">
                                            <p>Pay with Credit Card <span class="text-gray-2">We do not save credit card information</span></p>

                                            <div class="col-lg-6">
                                                <div class="form-input-field py-2">
                                                    <div class="text-gray-1 easygo-fs-4">First Name</div>
                                                    <input class="border-blue" type="phone" placeholder="Ewura">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-input-field py-2">
                                                    <div class="text-gray-1 easygo-fs-4">Last Name</div>
                                                    <input class="border-blue" type="phone" placeholder="Mensah">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-input-field py-2">
                                                    <div class="text-gray-1 easygo-fs-4">Card Number</div>
                                                    <input class="border-blue" type="phone" placeholder="123456789">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-input-field py-2">
                                                    <div class="text-gray-1 easygo-fs-4">CCV</div>
                                                    <input class="border-blue" type="phone" placeholder="123">
                                                </div>
                                            </div>
                                        </div>
                                    </section> -->
                                    <!--- Credit Card section [end] -->
                                    <!--- ================================ -->


                                    <!--- general information section [end] -->
                                    <!--- ================================ -->
                                </div>
                                <section id="invoice_section" class="px-2 py-2">
                                    <div class="col">
                                        <h4>Your Invoice</h4>
                                        <?php
                                            echo "
                                            <div class='row'>

                                            <div class='col-6 text-right'>
                                                <b>$name</b> <span class='text-gray-1' id='seat_span'>1 Seat</span>
                                            </div>
                                            <div class='text-align-righta col-6'>
                                                $currency <span id='invoice_tour'>$fee</span>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-6 text-right'>
                                                Discount applied <span class='text-gray-1'>(0%)</span>
                                            </div>
                                            <div class='text-align-righta col-6'>
                                                $currency <span id='invoice_discount'>0.00</span>
                                            </div>
                                        </div>
                                        <div class='row border-top border-bottom'>
                                            <div class='col-6 text-right'>
                                                <b>Sub-Total <span class='text-gray-1'>(Without Taxes)</span></b>
                                            </div>
                                            <div class='text-align-righta col-6'>
                                               <b> $currency <span id='invoice_subtotal'>$fee</span></b>
                                            </div>
                                        </div>
                                        <!-- <div class='row'>
                                            <div class='col-6 text-right'>
                                                Value Added Tax <span class='text-gray-1'>(15%)</span>
                                            </div>
                                            <div class='text-align-righta col-6'>
                                                $currency <span id='invoice_vat'>$vat</span>
                                            </div>
                                        </div> -->
                                        <div class='row border-bottom'>
                                            <div class='col-6 text-right'>
                                                Tourism Levy <span class='text-gray-1'>(1%)</span>
                                            </div>
                                            <div class='text-align-righta col-6'>
                                                $currency <span id='invoice_tourism'>$tourism</span>
                                            </div>
                                        </div>
                                        <div class='row border-top border-bottom'>
                                            <div class='col-6 text-right'>
                                                <h5><b>Total Fee: </b></h5>
                                            </div>
                                            <div class='align-text-right col-6'>
                                            <h5><b>$currency <span id='invoice_total'>$total</span></b></h5>
                                            </div>
                                        </div>
                                            ";
                                        ?>



                                    </div>
                                </section>
                            </div>


                            <div class="d-flex">
                                <button type="submit" class="easygo-btn-1 easygo-fs-1 easygo-rounded-1 py-3 w-100">Confirm Booking</button>
                            </div>
                            <!-- <center>
                                <a href="#" onclick='verify_payment()'>I have made payment. Confirm receipt</a>
                            </center> -->
                        </form>
                    </div>
                </div>
            </section>
            <!--- general information section [end] -->
            <!--- ================================ -->
            <!--- ================================ -->
        </main>
        <!--- ================================ -->
        <!--- footer [start] -->
        <?php
        require_once("../components/footer.php")
        ?>
        <!--- footer [start] -->
        <!--- ================================ -->
    </div>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- paystack js -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <!-- easyGo js -->
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/payment.js">
    </script>
    <script>
        function switch_method(select) {
            var momo = document.getElementById("mobile_money_section");
            var card = document.getElementById("credit_card_section");
            // if (select.value = "credit card"){
            momo.classList.toggle("hide");
            card.classList.toggle("hide");
            // document.getElementById("mobile_money_section").toggleAttribute("hide");

            // }else {

            // }
        }
    </script>
</body>

</html>