<?php
    require_once(__DIR__ . "/../utils/core.php");
    require_once(__DIR__ . "/../controllers/admin_controller.php");
    require_once(__DIR__ . "/../controllers/public_controller.php");


    if(!is_session_user_admin()){
        header("Location: ../index.php");
        die();
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow" />

    <link rel="icon" href="../assets/images/site_images/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Users</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- easygo css -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <!-- ============================== -->
    <!-- main-wrapper [start] -->
    <div class="main-wrapper">

            <?php require_once(__DIR__."/../components/admin_navbar_mobile.php"); ?>
        <!-- ============================== -->
        <!-- dashboard content [start] -->
        <main class="dashboard-content">
        <?php require_once(__DIR__. "/../components/admin_navbar_desktop.php"); ?>


            <div class="main-content px-3">
                <section class="trip-booking">
                    <div class="border-1 border-bottom py-3">
                        <div>
                            <h5 class="title">Users</h5>
                            <small class="easygo-fs-5 text-gray-1"><a href="all_tours.php">Users</a> > All Users</small>
                        </div>
                        <p class="mt-4 mb-0">This table shows all user info.</p>
                    </div>
                    <div class="trip-listing">
                        <div class="easygo-list-3 list-striped" style="min-width: 992px;">
                            <div class="list-item list-header bg-transparent" style="box-shadow: none;">
                                <div class="inner-item">Currency Id</div>
                                <div class="inner-item">Currency Name</div>
                                <div class="inner-item">Current Rate</div>
                                <div class="inner-item">Change Rate</div>
                                <div class="inner-item">Submit</div>
                            </div>
                            <?php
                                $currencies = get_currencies();
                                foreach($currencies as $current){
                                    $name = $current["currency_name"];
                                    $id = $current["currency_id"];
                                    $rate = $current["rate"];
                                    echo "
                                    <div class='accordion-item'>
                                        <div class='list-item' id='row_$id'>
                                            <div class='inner-item w-10'>$id</div>
                                            <div class='inner-item w-10'>$name</div>
                                            <div class='inner-item w-10 rate_div' id='{$id}_rate_div'>$rate</div>
                                            <div class='inner-item w-10'>
                                                <input type='number' class='new_rate' id='{$id}_input'>
                                            </div>
                                            <div class='inner-item w-10'>
                                            <a href='#' onclick='update_exchange_rate($id)'>Update rate</a></div>
                                        </div>
                                    </div>
                                    ";
                                }
                            ?>




                        </div>
                    </div>
                    <div class="pagination-section my-5">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="easygo-fs-5 h-100 d-flex align-items-center">Showing 1 - 20 of 100 trips</div>
                            </div>
                            <div class="col-lg-9">
                                <div class="d-flex justify-content-center align-items-center">
                                    <nav aria-label="Page navigation m-auto">
                                        <ul class="pagination gap-2">
                                            <li class="page-item"><a class="page-link rounded" href="#">Previous</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link rounded" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <!-- dashboard-content [end] -->
        <!-- ============================== -->
    </div>
    <!-- main-wrapper [end] -->
    <!-- ============================== -->


    <!-- ============================== -->
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery js -->
    <script src="../assets/js/jquery-3.6.1.min.js"></script>
    <!-- easygo js -->
    <?php require_once(__DIR__."/../utils/js_env_variables.php"); ?>
    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/functions.js"></script>
    <script>
        function update_exchange_rate(id){
            let new_rate = document.getElementById(id+"_input").value;

            // Validate new_rate as a decimal number
            let decimalRegex = /^\d+(\.\d+)?$/;
            if (!decimalRegex.test(new_rate)) {
                alert("Invalid decimal number entered for new_rate.");
                return;
            }else{
                if (new_rate >= 1 && confirm('Update exchange rate')){
                    send_request("POST","processors/processor.php/update_exchange_rate",{
                        "currency_id" : id,
                        "new_rate" : new_rate
                    },
                (response)=>{
                    if (response.status == 200){
                        showToast(response.data.msg);
                        document.getElementById(id+"_rate_div").innerText = new_rate;
                    }else{
                        openDialog(response.data.msg);
                    }
                })
                }
            }
        }
    </script>
</body>

</html>