<?php require_once(__DIR__."/../utils/core.php") ?>
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
                    <script>
                        function goHome(){
                            window.location.href = "../views/home.php";
                        }
                    </script>
                    <div class="logo" onclick="return goHome()">
                        <img src="../assets/images/site_images/logo.png" alt="easy go logo">
                    </div>
                    <p class="instruction">Please enter your credentials</p>
                </div>
                <div class="input-field">
                    <input name="user_name" type="text" placeholder="Full Name - Personal" >
                </div>
                <div class="input-field">
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="input-field">
                    <input type="text" name="phone" placeholder="Telephone">
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="pswd" type="password" placeholder="Password" >
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input name="con_pswd" type="password" placeholder="Confirm Password">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <small class="input-title">Company profile</small>
                    <div class="d-flex">
                        <div class="dropdown">
                            <a id="country_selected_icon" href="#ghana" style="background: var(--easygo-gray-3); height: 100%; border: solid 1px var(--easygo-gray-2); gap: 3px; font-size: var(--font-size-4);" class="btn rounded-0 rounded-start border-end-0 d-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag">
                            </a>
                            <ul class="dropdown-menu px-2" aria-labelledby="country_selected_icon">
                                <li class="text-hover-orange" onclick="on_option_select('country_selected_icon','Ghana')"><img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag"> Ghana</li>
                                <li class="text-hover-orange" onclick="on_option_select('country_selected_icon','Nigeria')"><img src="../assets/images/svgs/nigeria_flag.svg" alt="Zimbabwe flag"> Nigeria</li>
                                <li class="text-hover-orange" onclick="on_option_select('country_selected_icon','Zimbabwe')"><img src="../assets/images/svgs/zimbabwe_flag.svg" alt="Zimbabwe flag"> Zimbabwe</li>
                            </ul>
                        </div>
                        <input class="rounded-end rounded-0" type="text" placeholder="Company Name" name="company_name" >
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
            <form id="register-form-2" onsubmit="return signup(this)" style="position: absolute; top: 0">
                <button type="button" class="back-btn btn" style="position: absolute; top: 3%; left: 0; color: blue">Go back</button>
                <!-- <button type="button" class="back-btn btn" style="position: absolute; top: 3%; left: 0"><i class="fa-solid fa-arrow-left easygo-fs-1"></i></button> -->
                <div class="form-header">
                    <div class="logo">
                        <img src="../assets/images/site_images/logo.png" alt="easy go logo">
                    </div>
                    <p class="instruction">Please enter your credentials</p>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Upload company logo<span class="text-gray-2">(Optional)</span></small>
                    <div class="file-input drag-n-drop type-img" data-display-target="#logo-display" data-input-target="#company_logo">
                        <div class="upload-symbol">
                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                        </div>
                        <a>Upload file</a>
                        <span class="text-gray-1">PDF,DOCX,JPG,PNG</span>
                        <input class="img-upload" name="company_logo" id="company_logo" accept=".png, .jpg, .jpeg, .svg" type="file" data-display-target="#logo-display">
                        <div data-input-target="#company_logo" id="logo-display" class="img-display"></div>
                    </div>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Government Issued Identification Card</small>
                    <div class="inline-inputs">
                        <div class="file-input drag-n-drop type-img" data-display-target="#id-front" data-input-target="#gov_id_front">
                            <div class="upload-symbol" style="border-radius: 0; background-color: transparent;">
                                <img src="../assets/images/svgs/camera.svg" alt="upload symbol image">
                            </div>
                            <small class="easygo-fs-4 text-gray-1">Front</small>
                            <input id="gov_id_front" class="img-upload" accept=".png, .jpg, .jpeg, .svg" type="file" data-display-target="#id-front">
                            <div id="id-front" data-input-target="#gov_id_front" class="img-display display-full"></div>
                        </div>
                        <div class="file-input drag-n-drop type-img" data-display-target="#id-back"  data-input-target="#gov_id_back">
                            <div class="upload-symbol" style="border-radius: 0; background-color: transparent;">
                                <img src="../assets/images/svgs/camera.svg" alt="upload symbol image">
                            </div>
                            <small class="easygo-fs-4 text-gray-1">Back</small>
                            <input id="gov_id_back" class="img-upload" accept=".png, .jpg, .jpeg, .svg" type="file" data-display-target="#id-back">
                            <div id="id-back" data-input-target="#gov_id_back" class="img-display display-full"></div>
                        </div>
                    </div>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Upload any valid incorporation document <span class="text-gray-2">(Optional)</span></small>
                    <div class="file-input drag-n-drop type-doc" data-display-target="#gov-doc-display" data-name-display="#gov-doc-name" data-input-target="#inc_doc">
                        <div class="upload-symbol">
                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                        </div>
                        <a>Upload file</a>
                        <span class="text-gray-1">PDF,DOCX,JPG,PNG</span>
                        <input id="inc_doc" class="file-upload" data-display-target="#gov-doc-display" data-name-display="#gov-doc-name" accept=".png, .jpg, .jpeg, .svg, .docx, .pdf" type="file">
                        <div id="gov-doc-display" class="doc-display" data-input-target="#inc_doc">
                            <div class="doc-display-item">
                                <i class="fa-solid fa-file easygo-h2"></i>
                                <div id="gov-doc-name" class="doc-name"></div>
                                <button class="item-remove" type="button">X</button>
                            </div>
                        </div>
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
    <!-- EHImageUpload js -->
    <script src="../assets/js/EhImageUploadDisplay.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script>

    </script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/curator_auth.js"></script>
</body>

</html>