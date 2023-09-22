<?php require_once(__DIR__."/../utils/core.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - Request Password Change</title>
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
            <img src="../assets/images/svgs/password_change_home.svg" alt="register image">
        </div>
        <div class="form-container container">
            <form onsubmit="return reset_password(this)">
                <div class="form-header">
                    <div class="logo">
                        <img class="logo-medium" src="../assets/images/site_images/logo.png" alt="easygo logo">
                    </div>
                    <p class="easygo-fs-2 easygo-fw-1">Password Reset</p>
                    <p class="easygo-fs-4">Enter new password and continue</p>
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="password" type="password" placeholder="Password" class="border-blue">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="confirm_password" type="password" placeholder="Confirm Password" class="border-blue">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field button-container m-0">
                    <button class="easygo-btn-1 easygo-rounded-2" type="submit">Reset Password</button>
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