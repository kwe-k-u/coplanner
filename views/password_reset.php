<?php require_once(__DIR__."/../utils/core.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - User Request Password Reset</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>

    <!-- main content start -->
    <main class="form-page-main container">
        <div class="img-container d-none d-lg-block">
            <img src="../assets/images/svgs/forgot_password_home.svg" alt="register image">
        </div>
        <div class="form-container container">
            <form onsubmit="return request_password_reset(this)">
                <div class="form-header">
                    <div class="logo">
                        <img class="logo-medium" src="../assets/images/svgs/logo.svg" alt="easygo logo">
                    </div>
                    <p class="easygo-fs-2 easygo-fw-1">Forgot Password</p>
                    <p class="easygo-fs-4">Enter your email, we'll send a verification link to your email address</p>
                </div>
                <div class="input-field">
                    <input class="border-blue" type="text" placeholder="Email" name="email">
                </div>
                <div class="input-field button-container m-0">
                    <button class="easygo-btn-3 easygo-rounded-2" type="submit">Send reset link</button>
                </div>
            </form>
        </div>
    </main>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
</body>

</html>