<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <!-- main content start -->
    <main class="form-page-main container">
        <div class="img-container d-none d-lg-block">
            <img src="../assets/images/svgs/register.svg" alt="register image">
        </div>
        <div class="form-container container">
            <!-- register form 1 [start] -->
            <form id="register-form-1">
                <div class="form-header">
                    <div class="logo">
                        <img src="../assets/images/svgs/logo.svg" alt="easy go logo">
                    </div>
                    <p class="instruction">Please enter your credentials</p>
                </div>
                <div class="input-field">
                    <input name= "user_name" type="text" placeholder="Full Name - Personal" value="Kweku Acquaye">
                </div>
                <div class="input-field">
                    <input type="text" name="email" placeholder="Email" value="kweku@acquaye.com">
                </div>
                <div class="input-field">
                    <input type="text" name="phone" placeholder="Telephone" value="0559582518">
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="pswd" type="password" placeholder="Password" value="kweku@acquaye.com">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="con_pswd" type="password" placeholder="Confirm Password" value="kweku@acquaye.com">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <small class="input-title">Company profile</small>
                    <div class="d-flex">
                        <div class="dropdown">
                            <a id="country_selected_icon" href="#ghana" style="background: var(--easygo-gray-3); height: 100%; border: solid 1px var(--easygo-gray-2); gap: 3px; font-size: var(--font-size-4);" class="btn rounded-0 rounded-start border-end-0 d-flex align-items-center dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag">
                            </a>
                            <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuLink">
                                <li onclick="on_country_select('Ghana')"><img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag"> Ghana</li>
                                <li onclick="on_country_select('Nigeria')"><img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag"> Nigeria</li>
                            </ul>
                        </div>
                        <input class="rounded-end rounded-0" type="text" placeholder="Company Name" name="company_name" value="easygo">
                    </div>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1 next-btn" type="button">Continue</button>
                    <a href="./login.php">Already have an account ?</a>
                </div>
            </form>
            <!-- register form 1 [end] -->
            <!-- ======================= -->
            <!-- company info upload [start] -->
            <form id="register-form-2" onsubmit="return signup()" style="position: absolute; top: 0">
                <button type="button" class="back-btn btn" style="position: absolute; top: 3%; left: 0; color: blue">Go back</button>
                <!-- <button type="button" class="back-btn btn" style="position: absolute; top: 3%; left: 0"><i class="fa-solid fa-arrow-left easygo-fs-1"></i></button> -->
                <div class="form-header">
                    <div class="logo">
                        <img src="../assets/images/svgs/logo.svg" alt="easy go logo">
                    </div>
                    <p class="instruction">Please enter your credentials</p>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Upload company logo<span class="text-gray-2">(Optional)</span></small>
                    <div class="file-input">
                        <div class="upload-symbol">
                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                        </div>
                        <a>Upload file</a>
                        <span class="text-gray-1">PDF,DOCX,JPG,PNG</span>
                        <input id="company_logo" accept=".png, .jpg, .jpeg, .svg" type="file">
                    </div>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Government Issued Identification Card</small>
                    <div class="inline-inputs">
                        <div class="file-input">
                            <div class="upload-symbol" style="border-radius: 0; background-color: transparent;">
                                <img src="../assets/images/svgs/camera.svg" alt="upload symbol image">
                            </div>
                            <small class="easygo-fs-4 text-gray-1">Front</small>
                            <input id="gov_id_front" accept=".png, .jpg, .jpeg, .svg" type="file">
                        </div>
                        <div class="file-input">
                            <div class="upload-symbol" style="border-radius: 0; background-color: transparent;">
                                <img src="../assets/images/svgs/camera.svg" alt="upload symbol image">
                            </div>
                            <small class="easygo-fs-4 text-gray-1">Back</small>
                            <input id="gov_id_back" accept=".png, .jpg, .jpeg, .svg" type="file">
                        </div>
                    </div>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Upload any valid incorporation document <span class="text-gray-2">(Optional)</span></small>
                    <div class="file-input">
                        <div class="upload-symbol">
                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                        </div>
                        <a>Upload file</a>
                        <span class="text-gray-1">PDF,DOCX,JPG,PNG</span>
                        <input id="inc_doc" accept=".png, .jpg, .jpeg, .svg" type="file">
                    </div>
                </div>
                <div class="agreement-check">
                    <input type="checkbox"><span>By creating an account, you agree to these <a href="">terms and conditions</a></span>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1" type="submit">Register</button>
                    <a href="./login.php">Already have an account?</a>
                </div>
            </form>
            <!-- company info upload [end] -->
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