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
                <div class='justify-content-end'>
                    <div class='d-flex gap-4'>
                    <button class='easygo-btn-4 border-blue text-blue easygo-fs-5' onclick='goto_page(\"$auth_url\",false)'>
                        <img width='25px' src='https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA' alt='' srcset=''>
                        <span style='margin-left: 8px;'>
                            Continue With Google
                        </span>
                    </button>
                    <a href='".server_base_url()."coplanner/register.php' class='easygo-btn-5 bg-blue text-white easygo-fs-5'>Create An Account</a>
                    </div>
                </div>";
            }
        ?>

        </div>
    </nav>

<nav class="navbar navbar-expand-md fixed-top easygo-nav-white" style="background: var(--easygo-orange); z-index: 1029; margin-top:80px;">
    <div class="container-fluid justify-content-center">
        <a target="_blank" style="text-decoration:underline!important; color:white;" href="https://us21.list-manage.com/survey?u=2bd1d8f7814d0d70eb78d4383&id=89f89dd0d7&attribution=false">Click here to tell us if something breaks</a>
    </div>
</nav>