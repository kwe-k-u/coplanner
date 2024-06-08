<?php
    $user_id = get_session_user_id();
    if($user_id){
        require_once(__DIR__."/../controllers/public_controller.php");
        $username = get_user_info($user_id)["user_name"];
    }
    require_once(__DIR__."/../utils/core.php");
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
                <li class="nav-item"><a class="nav-link" href='#'> Home</a></li>
                <li class="nav-item"><a class="nav-link" href='#'> Experiences</a></li>
                <li class="nav-item"><a class="nav-link" href='#'> About</a></li>
                <li class="nav-item"><a class="nav-link" href='#'> Contact Us</a></li>
                <li class="d-md-none d-sm-block nav-item dropdown">
                    <a class="nav-link " href="#" onclick="toggle_signup_bypass()">
                        Sign In
                    </a>
                </li>
            </ul>
        </div>
        <div class="justify-content-end d-none d-lg-block">
        <div class="d-flex gap-4">
                    <a href="#" class="easygo-btn-5 bg-blue text-white easygo-fs-5" onclick="toggle_signup_bypass()">Sign In</a>
                    </div>
        </div>
    </div>
</nav>

<!--

<nav class="navbar navbar-expand-md fixed-top easygo-nav-white">
    <div class="container-fluid">

                <a class="navbar-brand" href="../index.php">
                    <img class="logo-medium" src="http://localhost/coplanner/assets/images/site_images/logo.png" onerror="this.onerror=null; this.remove();" alt="">
                </a>
                <div>
                        <ul id="navbar-links">
                            <li><a href='#'> Home</a></li>
                            <li><a href='#'> Experiences</a></li>
                            <li><a href='#'> About</a></li>
                            <li><a href='#'> Contact Us</a></li>
                        </ul>
                    </div>
                <div class="justify-content-end">
                    <div class="d-flex gap-4"><button class="easygo-btn-4 border-blue text-blue easygo-fs-5" onclick="goto_page(&quot;https://accounts.google.com/o/oauth2/v2/auth?response_type=code&amp;access_type=online&amp;client_id=165362367823-itkfk45iedob56p8uj884jc41cmr26ep.apps.googleusercontent.com&amp;redirect_uri=http%3A%2F%2Flocalhost%2Fcoplanner%2Fprocessors%2Fcallback.php%2Fgoogle_oauth&amp;state&amp;scope=email%20profile&amp;approval_prompt=auto&quot;,false)">
				<img width="25px" src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA" alt="" srcset="">
				<span style="margin-left: 8px;">
					Continue With Google
				</span>
			</button>
                    <a href="http://localhost/coplanner/coplanner/login.php" class="easygo-btn-5 bg-blue text-white easygo-fs-5">Sign In</a>
                    </div>
                </div>


        </div>
    </nav>





 -->


<!--
<nav class="navbar navbar-expand-md fixed-top easygo-nav-white">
    <div class="container-fluid">
        <?php
        $additional_options = "";
            if (is_session_user_curator()){
                $additional_options .= "<li onclick='goto_page(\"".server_base_url()."curator/dashboard.php\", false)'><a class='dropdown-item'  >Curator Dashboard</a></li>";
            }

            if(is_session_user_admin()){
                $additional_options .= "<li onclick='goto_page(\"".server_base_url()."admin/dashboard.php\", false)'><a class='dropdown-item' >Admin Dashboard</a></li>";
                echo "";
            }


            if ($user_id){ //show logged in user info
                echo "
                <a class='navbar-brand' href='../index.php'>
                    <img class='logo-medium' src='".server_base_url()."assets/images/site_images/logo.png' onerror='this.onerror=null; this.remove();' alt=''>
                </a>
                <div class='d-flex gap-2 align-items-center'  id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                    <div class='user-icon bg-blue'>
                        <img src='".server_base_url()."assets/images/others/profile.jpeg' alt='Profile image'>
                    </div>
                    <div id='header_links'>
                        <ul>
                            <li>Home</li>
                            <li>Experiences</li>
                            <li>About</li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                    <div class='d-flex align-items-center gap-1'>
                        <h3 class='easygo-fs-3 m-0'>$username</h3>
                        <div class='dropdown'>
                            <button class='btn btn-secondary dropdown-toggle dropdown-toggle-alt bg-transparent border-0' type='button'></button>
                            <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='dropdownMenuButton1'>
                                <!-- <li><a class='dropdown-item' href='#' onclick='goto_page(\"coplanner/dashboard/dashboard.php\")'>Profile</a></li> -->
                                $additional_options
                                <li><a class='dropdown-item' href='".server_base_url()."index.php' onclick='logout()'>Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>";
            }else{ // show logged out part of navbar

                $google_auth = new GoogleAuthHandler(google_client_id(),google_client_secret(),google_redirect_url());
                $auth_url = $google_auth->generate_login_url();
                echo "
                <a class='navbar-brand' href='../index.php'>
                    <img class='logo-medium' src='".server_base_url()."assets/images/site_images/logo.png' onerror='this.onerror=null; this.remove();' alt=''>
                </a>
                <div id='header_links'>
                        <ul>
                            <li>Home</li>
                            <li>Experiences</li>
                            <li>About</li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                <div class='justify-content-end'>
                    <div class='d-flex gap-4'>";
                    google_auth_btn();
                echo "
                    <a href='".server_base_url()."coplanner/login.php' class='easygo-btn-5 bg-blue text-white easygo-fs-5'>Sign In</a>
                    </div>
                </div>";
            }
        ?>

        </div>
    </nav> -->
