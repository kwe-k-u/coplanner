<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <?php include_once(__DIR__."/../utils/analytics/google_tag.php") ?>
    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyGo - Success</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>

    <!-- main content start -->
    <main class="success-page-main">
        <div class="container" style="max-width: 600px;">
            <div class="d-flex justify-content-center">
                <div class="success-anim-box">
                    <div class="arc">
                        <img class="arc-img" src="../assets/images/svgs/success_arc.svg" style="width: 100%" />
                    </div>
                    <div class="circle-box small-circle-box">
                        <div class="large-circle"></div>
                    </div>
                    <div class="circle-box large-circle-box">
                        <div class="small-circle"></div>
                    </div>
                </div>
            </div>
            <h1 class="my-5 text-center" style="margin-top: 7rem !important;">Hi, Welcome</h1>
            <div class="btn-container">
                <a href="./login.php" class="easygo-btn-1 easygo-rounded-2">Continue to Login</a>
            </div>
        </div>
    </main>
    <!-- main content end -->

    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script src="../assets/js/curator_auth.js"></script>
</body>

</html>