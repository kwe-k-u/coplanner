<?php
    $base_url = server_base_url();
?>
<footer class="easygo-footer-1 mt-5 bg-blue px-3 py-5 text-white">
    <div class="container">
        <div class="row text-center text-lg-start">
            <div class="col-lg-3 col-12 mb-3 mb-lg-0">
                <div class="d-flex justify-content-center flex-column align-items-center gap-1">
                    <div class="">
                        <?php
                            echo "<img class='logo-medium' src='{$base_url}assets/images/site_images/logo_white_bg.png' alt='easygo logo'>";
                        ?>
                    </div>
                    <h6></h6>
                </div>
            </div>
            <div class="col-lg-2 col-6 py-3">
                <h5 class="easygo-fw-2">Tourists</h5>
                <div class="d-flex flex-column">
                    <?php
                        echo "
                        <a class='text-white easygo-fs-4 text-hover-orange' href='{$base_url}'>Home</a>
                        <a class='text-white easygo-fs-4 text-hover-orange' href='{$base_url}shared_experience'>Group Tours</a>
                        <a class='text-white easygo-fs-4 text-hover-orange' href='{$base_url}travel_plan'>Private Tours</a>
                        <a class='text-white easygo-fs-4 text-hover-orange' href='https://us21.list-manage.com/survey?u=2bd1d8f7814d0d70eb78d4383&id=89f89dd0d7&attribution=false'>Report A Problem</a>
                        ";
                    ?>
                </div>
            </div>
            <div class="col-lg-2 col-6 py-3">
                <h5 class="easygo-fw-2">Tour Curators</h5>
                <div class="d-flex flex-column">
                    <?php
                        echo "
                        <a class='text-white easygo-fs-4 text-hover-orange' href='{$base_url}curator/login.php'>Become a curator</a>
                        <a class='text-white easygo-fs-4 text-hover-orange' href='javascript:void(0)'>Terms and conditions</a>
                        ";
                    ?>
                </div>
            </div>
            <div class="col-lg-2 col-6 py-3">
                <h5 class="easygo-fw-2">Products</h5>
                <div class="d-flex flex-column">
                    <?php
                        echo "
                        <a class='text-white easygo-fs-4 text-hover-orange' href='{$base_url}travel_plan'>Shared Experiences</a>
                        <a class='text-white easygo-fs-4 text-hover-orange' href='{$base_url}shared_experience'>Travel Plans</a>
                        ";
                    ?>
                </div>
            </div>
            <div class="col-lg-2 col-6 py-3">
                <h5 class="easygo-fw-2">Who we are</h5>
                <div class="d-flex flex-column">
                    <!-- <a class="text-white easygo-fs-4 text-hover-orange" href="javascript:void(0)">Privacy policy</a> -->
                    <a class="text-white easygo-fs-4 text-hover-orange" href="about.php">About us</a>
                    <a class="text-white easygo-fs-4 text-hover-orange" href="contact.php">Contact us</a>
                    <!-- <a class="text-white easygo-fs-4 text-hover-orange" href="javascript:void(0)">Careers</a> -->
                </div>
            </div>
        </div>
    </div>
</footer>