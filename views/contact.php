<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - Contact Us</title>
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
            <!--- ================================ -->
            <!--- contact information [start] -->
            <section class="mb-5 contact-info" style="margin-top: 10rem;">
                <div class="container">
                    <div class="contact-info-header mb-5">
                        <h6 class="text-orange text-center mb-3">Contact Us</h6>
                        <h1 class="easygo-h3 easygo-fw-1 text-blue text-capitalize text-center">get in touch with us</h1>
                        <p class="text-center">
                            Hi there, We would love to hear your thoughts. You can reach us using the contact information below or send us a message with the form on the right. It could be a bug you found, an issue with our service or opinions about improvements we can make
                        </p>
                    </div>
                    <div class="my-5">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="text-blue text-capitalize mb-2">Contact Information</h4>
                                <div class="contact-items">
                                    <div class="contact-item d-flex gap-3 my-4">
                                        <div class="contact-icon">
                                            <img src="../assets/images/svgs/location_blue.svg" alt="location icon">
                                        </div>
                                        <div>
                                            <h5 class="easygo-fw-2 text-capitalize">Our Location</h5>
                                            <p> East Tanokrom, Takoradi, Ghana</p>
                                        </div>
                                    </div>
                                    <div class="contact-item d-flex gap-3 my-4">
                                        <div class="contact-icon">
                                            <img src="../assets/images/svgs/phone_blue.svg" alt="location icon">
                                        </div>
                                        <div>
                                            <h5 class="easygo-fw-2 text-capitalize">Contact Number</h5>
                                            <p>054-067-2298 or 050-689-9983</p>
                                        </div>
                                    </div>
                                    <div class="contact-item d-flex gap-3 my-4">
                                        <div class="contact-icon">
                                            <img src="../assets/images/svgs/mail_blue.svg" alt="location icon">
                                        </div>
                                        <div>
                                            <h5 class="easygo-fw-2 text-capitalize">Email Address</h5>
                                            <p>main.easygo@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="contact-item d-flex gap-3 my-4">
                                        <div class="contact-icon">
                                            <img src="../assets/images/svgs/twitter_blue.svg" alt="location icon">
                                        </div>
                                        <div>
                                            <h5 class="easygo-fw-2 text-capitalize">Twitter</h5>
                                            <p>easygo_gh</p>
                                        </div>
                                    </div>
                                    <div class="contact-item d-flex gap-3 my-4">
                                        <div class="contact-icon">
                                            <img src="../assets/images/svgs/instagram_blue.svg" alt="location icon">
                                        </div>
                                        <div>
                                            <h5 class="easygo-fw-2 text-capitalize">Instagram</h5>
                                            <p>easygo_gh</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="text-capitalize text-center text-blue">send us a message</h4>
                                <form onsubmit="contact(this)">
                                    <div class="form-input-field py-2">
                                        <input class="border-blue" type="text" name="contact_name" placeholder="Your Name">
                                    </div>
                                    <div class="form-input-field py-2">
                                        <input class="border-blue" type="text" name="contact_email" placeholder="Your Email">
                                    </div>
                                    <div class="form-input-field py-2">
                                        <input class="border-blue" type="text" name="contact_phone" placeholder="Your Phone Number">
                                    </div>
                                    <div class="form-input-field py-2">
                                        <textarea class="border-blue" style="resize: none" name="contact_message"cols="30" rows="7" placeholder="Message Content"></textarea>
                                    </div>
                                    <div>
                                        <input class="easygo-btn-1 w-100" type="submit" value="Send Message">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--- contact information [end] -->
            <!--- ================================ -->
            <!--- News letter section [start] -->
            <section class="nl-subscribe my-5">
                <div class="container">
                    <form class="nl-subscription-form py-5">
                        <h4 class="title text-white">subscribe to our newsletter to get the latest information about trips directly from email</h4>
                        <div class="input-field">
                            <input id="newsletter_email_field" type="text" placeholder="Your email address">
                            <button class="bg-orange text-white" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </section>
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
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script >
        function contact(form){
            event.preventDefault();

            var email = form.contact_email.value;
            var name = form.contact_name.value;
            var message = form.contact_message.value;
            var phone = form.contact_phone.value;

            payload = "action=send_contact_message";
            payload += "&email=" + email;
            payload += "&name=" + name;
            payload += "&message=" + message;
            payload += "&phone=" + phone;

            send_request("POST",
            "processors/processor.php",
            payload,
            (response)=> {
                alert(response);
            });


        }
    </script>
</body>

</html>