<!-- <?php
    $user_id = get_session_user_id();
    if($user_id){
        require_once(__DIR__."/../controllers/public_controller.php");
        $username = get_user_info($user_id)["user_name"];
    }
?> -->
<nav class="navbar navbar-expand-md fixed-top easygo-nav-white">
    <div class="container-fluid">
        <?php
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
                                <li><a class='dropdown-item' href='#'>Profile</a></li>
                                <li><a class='dropdown-item' href='#' onclick='logout()'>Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>";
            }else{ // show logged out part of navbar
                echo "
                <a class='navbar-brand' href='../index.php'>
                    <img class='logo-medium' src='".server_base_url()."assets/images/site_images/logo.png' onerror='this.onerror=null; this.remove();' alt=''>
                </a>
                <div class='justify-content-end'>
                    <div class='d-flex gap-4'>
                        <a href='".server_base_url()."coplanner/register.php' class='easygo-btn-4 border-blue text-blue easygo-fs-5'>Create an account</a>
                        <a href='".server_base_url()."coplanner/login.php' class='easygo-btn-5 bg-blue text-white easygo-fs-5'>Sign in</a>
                    </div>
                </div>";
            }
        ?>


</nav>