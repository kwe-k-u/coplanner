<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - curator signup</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>

    <!-- main content start -->
    <main class="form-page-main container">
        <div class="img-container d-none d-lg-block">
            <img src="../assets/images/svgs/register.svg" alt="register image">
        </div>
        <div class="form-container">
            <form>
                <div class="form-header">
                    <div class="logo">
                        <img src="../assets/images/svgs/logo.svg" alt="easy go logo">
                    </div>
                    <p class="instruction">Please enter your login credentials</p>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Full Name">
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Email">
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Telephone">
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input type="password" placeholder="Password">
                        <button type="button" class="toggle-password-show"><i class="fa-solid fa-eye"></i></button>
                    </div>
                </div>
                <div class="input-field">
                <div class="password-input-container">
                        <input type="password" placeholder="Confirm Password">
                        <button type="button" class="toggle-password-show"><i class="fa-solid fa-eye"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <small class="input-title">Company profile</small>
                    <input type="text" placeholder="Company-profile">
                </div>
                <div class="agreement-check">
                    <input type="checkbox"><span>By creating an account, you agree to the terms and conditions</span>
                </div>
                <div class="input-field button-container">
                    <button class="easy-go-btn-1" type="submit">Register</button>
                    <a href="#">already have an account ?</a>
                </div>
            </form>
        </div>
    </main>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- easygo js -->
    <script src="../assets/js/general.js"></script>
</body>

</html>