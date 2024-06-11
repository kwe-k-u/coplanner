<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
require_once(__DIR__ . "/../controllers/admin_controller.php");


//Uncomment after connection
// $user_id = get_session_user_id();
// $username = get_user_info($user_id)["user_name"];

$hm = new public_class();
$data = $hm->get_transaction("U001");
// echo json_encode($hi);

//should be replaced by fetching upcoming trip
$trip_details = [
    "name" => "John Doe",
    "dateOfDeparture" => "2024-06-01",
    "dateOfReturn" => "2024-06-15",
    "typeOfTrip" => "Girls days Out",
    "nameOfTrip" => "Waterfalls",
    "people" => "Friends",
    "locationOfDeparture" => "Accra Mall",
    "locationOfArrival" => "Aburi"
];
?>

<!DOCTYPE html>
<html lang="en">
<script src="../assets/js/functions.js"></script>
<link rel="stylesheet" href="newhome.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<body>
    <div class = "body-container">
        <!-- sidebar -->
        <?php
        require_once(__DIR__."/sidebar.php");
        ?>
        <div class = "right-body-container">
            <!-- topbar -->
            <?php
            require_once(__DIR__."/topbar.php");
            ?>
            <div class = "content-container">
                <!-- main content here -->
                <div class = "welcome-section">
                <div class = "welcome-title"> Welcome back, <?php echo "$username" ?> </div>
                    <div class = "welcome-subtitle"> Manage all activities about your trip</div>
                </div>
                <div class = "home-destination-row">
                    <?php
                    require_once(__DIR__."/../components/next_destination.php");
                    ?>

                </div>
                <div class="content-main">
                    <div class="transaction-table-section">
                        <div class="transaction-table-title">
                            <div> Recent transaction </div>
                            <div style="color: #ccb102; text-decoration: underline;"> See all </div>
                        </div>
                        <div class="custom-table">
                            <div class="table-row header">
                                <div class="table-cell">id</div>
                                <div class="table-cell">item</div>
                                <div class="table-cell">date</div>
                                <div class="table-cell">amount</div>
                                <div class="table-cell">status</div>
                            </div>
                            <?php
                            foreach ($data as $row) {
                                echo "<div class='table-row'>";
                                echo "<div class='table-cell'>" . $row['provider_transaction_id'] . "</div>";
                                echo "<div class='table-cell'>" . $row['transaction_id'] . "</div>";
                                echo "<div class='table-cell'>" . $row['date_created'] . "</div>";
                                echo "<div class='table-cell'>" . $row['total_transaction_amount'] . "</div>";
                                echo "<div class='table-cell'>" . $row['purpose'] . "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class = "trans-cards">

                            <!-- TODO: make dynamic -->
                             <?php
                            for ($x = 0; $x <= 10; $x++) {
                                if (isset($data[$x])) {
                                    echo "<div class = 'trans-card'>";
                                    echo "<div class = 'trans-card-container'>";
                                    echo "<div class = 'trans-card-id'>" . $data[$x]['provider_transaction_id'] . "</div>";
                                    echo "<div class = 'trans-card-detail'><div>Girls trip - Western Region</div><div style = 'font-weight:bold;'>GHS". $data[$x]['total_transaction_amount'] ."</div></div>";
                                    echo "    <div class = 'trans-card-datetime'> " . $data[$x]['date_created'] . "</div>";
                                    echo "    </div>
                                    </div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="upcoming-trip">

                        <div class = "uptrip-title" >Upcoming Trip</div>

                        <div class = "uptrip-card">
                            <div class = "card-container">
                                <div class= "uptrip-card-title"> Travel Date </div>
                                <div class= "uptrip-card-subtitle"> Girls Trip </div>
                                <div class = "uptrip-card-content">
                                    <!-- TODO:  Make this dynamic-->

                                    <div class = "uptrip-card-details">
                                        <div> 2 days </div> <i class="fa-solid fa-right-left"></i> <div> 4 destination </div>
                                    </div>
                                    <div class = "card-footer">
                                        <!-- TODO: Make this dynamic as well -->
                                        <div style = "display:none;">BOOKED!</div>

                                        <div>NOT BOOKED YET</div>
                                        <div class="uptrip-button">
                                            BOOK NOW !
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class = "spacer" style="
                                height: 12%;
                            "></div>
                    </div>


                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script>

</script>
</html>