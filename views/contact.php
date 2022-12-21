<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - About</title>
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
            <section class="mb-5 out-team" style="margin-top: 10rem;">
                <div class="contact-info-header mb-5">
                    <div class="container">
                        <h6 class="text-orange text-center">Contact Us</h6>
                        <h1 class="easygo-h3 easygo-fw-1 text-blue text-capitalize text-center">get in touch with us</h1>
                        <p class="text-center">
                            Hi there, We would love to hear your thoughts. You can reach us using the contact information below or send us a message with the form on the left. It could be a bug you found, an issue with our service or opinions about improvements we can make
                        </p>
                    </div>
                </div>
                <div></div>
            </section>
            <!--- contact information [end] -->
            <!--- ================================ -->
            <!--- News letter section [start] -->
            <section class="nl-subscribe my-5">
                <div class="container">
                    <form class="nl-subscription-form py-5">
                        <h4 class="title text-white">subscribe to our newsletter to get the latest information about trips directly from email</h4>
                        <div class="input-field">
                            <input type="text" placeholder="Your email address">
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
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/home.js"></script>
</body>

</html>