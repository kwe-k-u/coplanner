<?php
    require_once(__DIR__."/../utils/core.php");

    $user_id = get_session_user_id();
    if($user_id){
        require_once(__DIR__."/../controllers/public_controller.php");
        $username = get_user_info($user_id)["user_name"];
    }
    $base_url = server_base_url();
?>

<nav class="navbar navbar-expand-md fixed-top easygo-nav-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img class="logo-medium" src="http://localhost/coplanner/assets/images/site_images/logo.png" onerror="this.onerror=null; this.remove();" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

          <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul id="navbar-links" class="navbar-nav">
                <?php
                $additional_options = "";
                if (is_session_user_curator()){
                    $additional_options .= "<li class='nav-item'><a class='nav-link' href='{$base_url}curator/dashboard.php'> Curator Dashboard</a></li>";
                }

                if(is_session_user_admin()){
                    $additional_options .= "<li class='nav-item'><a class='nav-link' href='{$base_url}admin/dashboard.php'> Admin Dashboard</a></li>";
                    // echo "<li class='nav-item'><a class='nav-link' href='{$base_url}admin/dashboard.php'> Admin Dashboard</a></li>";
                }


                 echo "
                 <li class='nav-item'><a class='nav-link' href='$base_url'> Home</a></li>
                 <li class='nav-item'><a class='nav-link' href='$base_url'> Experiences</a></li>
                 <li class='nav-item'><a class='nav-link' href='{$base_url}curator/index.php'> Curators</a></li>
                 <li class='nav-item'><a class='nav-link' href='{$base_url}coplanner/about.php'> About</a></li>
                 <li class='nav-item'><a class='nav-link' href='{$base_url}coplanner/about.php#contact-us'> Contact Us</a></li>
                 <div class='additional-options d-none d-lg-flex mr-5'>
                    $additional_options
                 </div>
                 ";

                 if($user_id){ // If signed In
                    // $additional_options
                    echo "
                <li class='nav-item dropdown-toggle d-lg-none' id='account_dropdown' data-bs-toggle='dropdown'>
                 <a href='#'>Account</a>
                 </li>
                <div class='dropdown'>
                    <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='#account_dropdown'>
                        $additional_options
                        <li class='nav-item'><a class='nav-link' href='$base_url' onclick='logout()'> Sign Out</a></li>
                    </ul>
                </div>


            </ul>
        </div>";
                 }else{
                    echo "
                <li class='d-md-none d-sm-block nav-item dropdown'>
                    <a class='nav-link' href='#' onclick='toggle_signup_bypass()'>
                        Sign In
                    </a>
                </li>
            </ul>
            </div>
            <div class='justify-content-end d-none d-lg-block'>
                <div class='d-flex gap-4'>
                    <a href='#' class='easygo-btn-5 bg-blue text-white easygo-fs-5' onclick='toggle_signup_bypass()'>Sign In</a>
                </div>
            </div>
            ";
                 }
                ?>
    </div>
</nav>


<div class="signup-bypass-window hide">
    <div class="signup-bypass ">
        <div class="bypass-body">
            <div class="bypass-title">
                <h2></h2>
                <!-- <h2>Let's get you signed In!</h2> -->
                <!-- <h5>We'll need your details to proceed</h5> -->
            </div>
            <div class="tab-button-box" role="tablist">
                <button class="tab-button active" data-bs-toggle="tab" data-bs-target="#signup-panel" id="#signup-panel-tab" role="tab">Sign Up</button>
                <button class="tab-button" data-bs-toggle="tab" data-bs-target="#login-panel" id="#login-panel-tab" role="tab">Log In</button>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" role="tabpanel" id="signup-panel" aria-labelledby="signup-panel-tab">
                    <!-- <h3>Create An Account</h3> -->
                    <form action="#" onsubmit="signup_bypass(this);" method="post">
                        <div class="bypass-email">
                            <div class="input-field">
                                <label for="name">Your Name</label>
                                <div class="password-input-container">
                                    <input name="name" type="text" placeholder="Kofi Manful" class="border-blue" data-eg-target="name-err">
                                </div>
                                <p id="name-err" class="form-err-msg">Password must be at least 8 characters long</p>
                            </div>
                            <div class="input-field">
                                <label for="name">Email</label>
                                <div class="password-input-container">
                                    <input name="email" type="email" placeholder="main@easygo.com.gh" class="border-blue" data-eg-target="email-err">
                                </div>
                                <p id="email-err" class="form-err-msg">Please provide a valid email address</p>
                            </div>
                            <div class="input-field">
                                <label for="name">Phone Number</label>
                                <div class="password-input-container">
                                    <input name="phone" type="text" placeholder="233559582518" class="border-blue" data-eg-target="number-err">
                                </div>
                                <p id="number-err" class="form-err-msg">Please provide a valid phone number</p>
                            </div>
                            <div class="input-field button-container mt-2">
                                <button class="easygo-btn-1 bg-blue text-white easygo-fs-4 w-100">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade " id="login-panel" role="tabpanel" aria-labelledby="login-panel-tab">
                    <form action="#" onsubmit="email_login(this);" method="post">
                        <!-- <h3>Log In</h3> -->
                        <div class="bypass-email">
                            <div class="input-field">
                                <label for="name">Email</label>
                                <div class="password-input-container">
                                    <input name="email" type="email" placeholder="main@easygo.com.gh" class="border-blue" data-eg-target="email-err">
                                </div>
                                <p id="email-err" class="form-err-msg">Please provide a valid email address</p>
                            </div>
                            <div class="input-field">
                                <label for="name">Password</label>
                                <div class="password-input-container">
                                    <input name="password" type="password" class="border-blue" data-eg-target="number-err">
                                </div>
                                <p id="number-err" class="form-err-msg">Please provide a valid phone number</p>
                            <a class="easygo-fs-4" href="#">Reset your password?</a>
                            </div>
                            <div class="">
                            </div>
                            <div class="input-field button-container mt-2">
                                <button class="easygo-btn-1 bg-blue text-white easygo-fs-4 w-100">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bypass-or">
                OR
            </div>
            <div class="bypass-google">
                <?php
                    require_once(__DIR__."/../utils/core.php");
                    google_auth_btn();
                ?>
            </div>
        </div>
    </div>
</div>



