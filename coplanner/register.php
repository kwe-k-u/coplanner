<?php require_once(__DIR__."/../utils/core.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
  <?php include_once(__DIR__."/../utils/analytics/google_head_tag.php") ?>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - Create An account</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>
<?php include_once(__DIR__ . "/../utils/analytics/google_body_tag.php") ?>

    <!-- main content start -->
    <main class="form-page-main container">
        <div class="form-container container" style="max-width: 600px;">
            <!-- register form 1 [start] -->

            <script>
                function goHome(){
                    window.location.href = "../views/home.php";
                }
            </script>
            <form onsubmit="return email_signup(this)">
                <div class="form-header">
                    <div class="logo" onclick="return goHome()">
                        <img class="logo-medium" src="../assets/images/site_images/logo.png" alt="easy go logo">
                    </div>
                    <p class="instruction easygo-fs-4">Please enter your credentials to sign up</p>
                </div>
                <!-- <div class="profile_img-upload">
                    <div class="profile_img-disp">
                        <img id="register-profile_img" class="image-display" src="../assets/images/others/tour2.jpg" alt="profile image">
                        <label class="profile_img-upload-btn" for="profile_img"><img src="../assets/images/svgs/pen_line.svg" alt="pen line image"></label>
                        <input display-target="register-profile_img" class="profile_img-file" id="profile_img" type="file" accept=".jpg, .jpeg, .png">
                    </div>
                    <div class="easygo-fs-5 mt-3">Add a profile picture</div>
                </div> -->
                <div class="input-field">
                    <input class="border-blue" name="username" type="text" placeholder="Your Name" data-eg-target="name-err">
                    <p id="name-err" class="form-err-msg"></p>
                </div>
                <div class="input-field">
                    <input type="text" class="border-blue" name="email" placeholder="youremail@example.com" data-eg-target="email-err">
                    <p id="email-err" class="form-err-msg"></p>
                </div>
                <!-- <div class="input-field">
                    <input type="text" class="border-blue" name="phone" placeholder="Phone number">
                </div> -->
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="password" type="password" placeholder="Password" class="border-blue" data-eg-target="pass-err">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                        <p id="pass-err" class="form-err-msg"></p>
                    </div>
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="confirm_password" type="password" placeholder="Confirm Password" class="border-blue" data-eg-target="confirm-pass-err">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                        <p id="confirm-pass-err" class="form-err-msg"></p>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-6">
                        <div class="input-field">
                            <input type="text" class="border-blue" name="country" placeholder="Country">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-field">
                            <input type="text" class="border-blue" name="referral" placeholder="Referral Code">
                        </div>
                    </div>
                </div> -->

                <div class="agreement-check">
                    <input type="checkbox"><span>By creating an account, you agree to easyGo's <a href="">terms and conditions</a></span>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1 easygo-rounded-2" type="submit">Register</button>
                    <?php
                        if(isset($_GET["redirect_url"])){
                            $url = $_GET["redirect_url"];
                            echo "<p class='easygo-fs-5 text-center mt-4'>Don't have an account ? <a href='./login.php?redirect_url=$url' class='easygo-fs-5 easygo-fw-3'>Sign Up now</a></p>";
                            echo "";
                        }else{
                            echo "<p class='easygo-fs-5 text-center mt-4'>Don't have an account ? <a href='./login.php' class='easygo-fs-5 easygo-fw-3'>Sign Up now</a></p>";
                        }
                    ?>
                </div>
            </form>
            <!-- register form 1 [end] -->
            <!-- ======================= -->
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
    <script src="../assets/js/user_auth.js"></script>
</body>

</html>