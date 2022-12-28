<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - User Sign Up</title>
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
        <div class="form-container container" style="max-width: 600px;">
            <!-- register form 1 [start] -->
            <form>
                <div class="form-header">
                    <div class="logo">
                        <img class="logo-medium" src="../assets/images/svgs/logo.svg" alt="easy go logo">
                    </div>
                    <p class="instruction easygo-fs-4">Please enter your credentials to sign up</p>
                </div>
                <div class="profile-img-upload">
                    <div class="profile-img-disp">
                        <img id="register-profile-img" src="../assets/images/others/tour2.jpg" alt="profile image">
                        <label class="profile-img-upload-btn" for="profile-img">Choose file</label>
                        <input display-target="register-profile-img" class="profile-img-file" id="profile-img" type="file" accept=".jpg, .jpeg, .png">
                    </div>
                </div>
                <div class="input-field">
                    <input class="border-blue" name="user_name" type="text" placeholder="Full Name">
                </div>
                <div class="input-field">
                    <input type="text" class="border-blue" name="email" placeholder="Email">
                </div>
                <div class="input-field">
                    <input type="text" class="border-blue" name="phone" placeholder="Telephone">
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="pswd" type="password" placeholder="Password" class="border-blue">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="con_pswd" type="password" placeholder="Confirm Password" class="border-blue">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-field">
                            <input type="text" class="border-blue" name="phone" placeholder="Address">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-field">
                            <input type="text" class="border-blue" name="phone" placeholder="City">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-field">
                            <input type="text" class="border-blue" name="phone" placeholder="State">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-field">
                            <input type="text" class="border-blue" name="phone" placeholder="Country">
                        </div>
                    </div>
                </div>

                <div class="agreement-check">
                    <input type="checkbox"><span>By creating an account, you agree to these <a href="">terms and conditions</a></span>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1 easygo-rounded-2" type="button">Register</button>
                    <p class="easygo-fs-5 text-center mt-4">Already have an account ? <a href="./login.php" class="easygo-fs-5 easygo-fw-3">Login now</a></p>
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
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/curator_auth.js"></script>
</body>

</html>