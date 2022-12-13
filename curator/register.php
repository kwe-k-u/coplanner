<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easygo - curator signup</title>
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
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <div class="password-input-container">
                        <input type="password" placeholder="Confirm Password">
                        <button type="button" class="toggle-password-show"><i class="fa-sharp fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="input-field">
                    <small class="input-title">Company profile</small>
                    <div class="d-flex">
                        <div class="dropdown">
                            <a style="background: var(--easygo-gray-3); height: 100%; border: solid 1px var(--easygo-gray-2); gap: 3px; font-size: var(--font-size-4);" class="btn rounded-0 rounded-start border-end-0 d-flex align-items-center dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag">
                            </a>
                            <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuLink">
                                <li><img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag"> Ghana</li>
                                <li><img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag"> Ghana</li>
                                <li><img src="../assets/images/svgs/GH_flag.svg" alt="Ghana flag"> Ghana</li>
                            </ul>
                        </div>
                        <input class="rounded-end rounded-0" type="text" placeholder="Company-profile">
                    </div>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1 next-btn" type="button">Continue</button>
                    <a href="./login.php">already have an account ?</a>
                </div>
            </form>
            <!-- register form 1 [end] -->
            <!-- ======================= -->
            <!-- company info upload [start] -->
            <form id="register-form-2" style="position: absolute; top: 0">
                <button type="button" class="back-btn btn" style="position: absolute; top: 3%; left: 0"><i class="fa-solid fa-arrow-left easygo-fs-1"></i></button>
                <div class="form-header">
                    <div class="logo">
                        <img src="../assets/images/svgs/logo.svg" alt="easy go logo">
                    </div>
                    <p class="instruction">Please enter your credentials</p>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Upload company logo</small>
                    <div class="file-input">
                        <div class="upload-symbol">
                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                        </div>
                        <a>upload file</a>
                        <span class="text-gray-1">PDF,DOCX,JPG,PNG</span>
                        <input accept=".png, .jpg, .jpeg, .svg" type="file">
                    </div>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Upload company logo</small>
                    <div class="inline-inputs">
                        <div class="file-input">
                            <div class="upload-symbol" style="border-radius: 0; background-color: transparent;">
                                <img src="../assets/images/svgs/camera.svg" alt="upload symbol image">
                            </div>
                            <small class="easygo-fs-4 text-gray-1">Front</small>
                            <input accept=".png, .jpg, .jpeg, .svg" type="file">
                        </div>
                        <div class="file-input">
                            <div class="upload-symbol" style="border-radius: 0; background-color: transparent;">
                                <img src="../assets/images/svgs/camera.svg" alt="upload symbol image">
                            </div>
                            <small class="easygo-fs-4 text-gray-1">Back</small>
                            <input accept=".png, .jpg, .jpeg, .svg" type="file">
                        </div>
                    </div>
                </div>
                <div class="input-field">
                    <small class="text-gray-1">Upload any valid incorporation document</small>
                    <div class="file-input">
                        <div class="upload-symbol">
                            <img src="../assets/images/svgs/upload-symbol.svg" alt="upload symbol image">
                        </div>
                        <a>upload file</a>
                        <span class="text-gray-1">PDF,DOCX,JPG,PNG</span>
                        <input accept=".png, .jpg, .jpeg, .svg" type="file">
                    </div>
                </div>
                <div class="agreement-check">
                    <input type="checkbox"><span>By creating an account, you agree to the terms and conditions</span>
                </div>
                <div class="input-field button-container">
                    <button class="easygo-btn-1" type="submit">Register</button>
                    <a href="./login.php">already have an account ?</a>
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
</body>

</html>