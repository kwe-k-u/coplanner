<?php
    $base_url = server_base_url();
?>


<footer class="easygo-footer-1 mt-5 bg-lblue-2 px-3 py-5">
    <div class="container">
        <div class="row text-center text-lg-start">
            <div class="col-lg-2 col-4 py-3">
                <h5 class="easygo-fw-1">Tourists</h5>
                <div class="d-flex flex-column">
                    <?php
                        echo "
                        <a class=' easygo-fs-4 ' href='$base_url'>Home</a>
                        <a class=' easygo-fs-4 ' href='{$base_url}shared_experience'>Group Tours</a>
                        <a class=' easygo-fs-4 ' href='{$base_url}travel_plan'>Private Tours</a>
                        <a class=' easygo-fs-4 ' href='https://us21.list-manage.com/survey?u=2bd1d8f7814d0d70eb78d4383&id=89f89dd0d7&attribution=false'>Report A Problem</a>
                        ";
                    ?>
                </div>
            </div>
            <div class="col-lg-3 col-4 py-3">
                <h5 class="easygo-fw-2">Curators</h5>
                <div class="d-flex flex-column">
                    <?php
                        echo "
                        <a class=' easygo-fs-4 ' href='{$base_url}curator/index.php'>Why work with easyGo</a>
                        <a class=' easygo-fs-4 ' href='{$base_url}curator/login.php'>Become a Curator</a>
                        <a class=' easygo-fs-4 ' href='https://wa.me/233506899883'>Contact Our Team</a>
                        <a class=' easygo-fs-4 ' href='https://drive.google.com/file/d/1mN0bLyGvmf2jduiWCbs_yId-FOVWGz_p/view?usp=sharing'>Curator Terms</a>
                        ";
                    ?>
                </div>
            </div>
            <div class="col-lg-2 col-4 py-3">
                <h5 class="easygo-fw-2">Who we are</h5>
                <div class="d-flex flex-column">
                    <!-- <a class="text-white easygo-fs-4 text-hover-orange" href="javascript:void(0)">Privacy policy</a> -->
                     <?php
                        echo "
                        <a class=' easygo-fs-4 ' href='{$base_url}coplanner/about.php'>About us</a>
                        <a class=' easygo-fs-4 ' href='https://wa.me/233506899883'>Contact us</a>
                        <a class=' easygo-fs-4 ' href='https://drive.google.com/file/d/1mN0bLyGvmf2jduiWCbs_yId-FOVWGz_p/view?usp=sharing'>Terms and conditions</a>
                        ";
                     ?>
                    <!-- <a class="text-white easygo-fs-4 text-hover-orange" href="javascript:void(0)">Careers</a> -->
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-3 mb-lg-0">
                <div class="footer-address-card">
                    <div class="row">
                        <div class="col-6">
                        <?php
                            echo "<img class='logo-medium' src='{$base_url}assets/images/site_images/logo.webp' alt='easygo logo'>";
                        ?>
                        </div>
                        <div class="col-6 align-items-right">
                            <p class="mb-1">support@easygo.com.gh</p>
                            <p class="mb-1">Greater Accra</p>
                            <p class="mb-1">Ghana</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>