<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - User Login</title>
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
            <!-- register login form [start] -->
            <form onsubmit="return login(this)">
                <div class="form-header">
                    <div class="logo">
                        <img class="logo-medium" src="../assets/images/svgs/logo.svg" alt="easy go logo">
                    </div>
                    <div class="easygo-fs-1">Welcome</div>
                    <p class="instruction easygo-fs-4">Please enter your credentials to sign up</p>
                </div>
                <div class="input-field">
                    <input type="text" class="border-blue" name="email" placeholder="Email">
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="password" type="password" placeholder="Password" class="border-blue">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="agreement-check m-0">
                        <input type="checkbox"><span>Remember Me</span>
                    </div>
                    <a class="text-black easygo-fs-4" href="./password_reset.php">Forgot Password ?</a>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1 easygo-rounded-2" type="submit">Login</button>
                    <p class="easygo-fs-5 text-center mt-4">Don't have an account ? <a href="./register.php" class="easygo-fs-5 easygo-fw-3">Sign Up now</a></p>
                </div>
            </form>
            <!-- register login form [end] -->
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
</body>

</html>