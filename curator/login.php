<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - Curator Sign Up</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>
<?php
require_once(__DIR__."/../utils/core.php");

if(is_session_user_curator()){
    header("Location: dashboard.php");
}
?>
    <!-- main content start -->
    <main class="form-page-main container">
        <div class="img-container d-none d-lg-block">
            <img src="../assets/images/svgs/login.svg" alt="register image">
        </div>
        <div class="form-container container">
            <form onsubmit="return login(this)">
                <div class="form-header">
                    <script>
                        function goHome(){
                            window.location.href = "../views/home.php";
                        }
                    </script>
                    <div class="logo" onclick="return goHome()">
                        <img src="../assets/images/site_images/logo.png" alt="easy go logo">
                    </div>
                    <p class="instruction">Please enter your login credentials</p>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Email" name="email">
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input type="password" placeholder="Password" name="password">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                    <div class="text-end">
                        <a style="font-size: var(--font-size-4); color: var(--easygo-gray-1)"  href="password_reset.php">Forgot Password?</a>
                    </div>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1" type="submit">Login</button>
                    <a href="./register.php">Create an account</a>
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
    <script src="../assets/js/curator_auth.js"></script>
</body>

</html>