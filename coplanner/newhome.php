<?php
require_once(__DIR__."/../utils/core.php");

// Dummy array object
$data = array(
    array("id" => 1, "item" => "Item 1", "date" => "2024-04-15", "amount" => 100, "status" => "Pending"),
    array("id" => 2, "item" => "Item 2", "date" => "2024-04-16", "amount" => 150, "status" => "Completed"),
    array("id" => 3, "item" => "Item 3", "date" => "2024-04-17", "amount" => 200, "status" => "Pending"),
    array("id" => 4, "item" => "Item 4", "date" => "2024-04-18", "amount" => 120, "status" => "Completed"),
    array("id" => 5, "item" => "Item 5", "date" => "2024-04-19", "amount" => 180, "status" => "Pending"),
    array("id" => 6, "item" => "Item 6", "date" => "2024-04-20", "amount" => 220, "status" => "Completed"),
    array("id" => 7, "item" => "Item 7", "date" => "2024-04-21", "amount" => 130, "status" => "Pending"),
    array("id" => 8, "item" => "Item 8", "date" => "2024-04-22", "amount" => 170, "status" => "Completed"),
    array("id" => 9, "item" => "Item 9", "date" => "2024-04-23", "amount" => 250, "status" => "Pending"),
    array("id" => 10, "item" => "Item 10", "date" => "2024-04-24", "amount" => 300, "status" => "Completed")
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        margin: 0;
        height: 100vh;
        background: #f5f5f6ed;

    }
    .body-container{
        margin: 0;
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 100%;
    }
    .right-body-container{
        margin: 0;
        display: flex;
        flex-direction: column;
        width: 77.5%;
        height: 100%;
    }
    .content-container{
        margin: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: auto;
    }
    .home-destination-row{
        height: 20%;
    }
    .content-main {
        height: 60%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        
    }

    .transaction-table-section{
        width:50%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }

    .transaction-table-title {
        display: flex;
        justify-content: space-between;
        font-size: large;
        font-weight: bold;
    }


    /* Your existing CSS styles */

    .custom-table {
        display: flex;
        flex-direction: column;
        border: 1px solid #ccc;
        border-radius: 5px;
        
    }

    .table-row {
        display: flex;
    }

    .header {
        background-color: #f0f0f0;
        font-weight: bold;
    }

    .table-cell {
        flex: 1;
        padding: 10px;
        border-right: 1px solid #ccc;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-cell:last-child {
        border-right: none;
    }

    .uptrip-title {
        font-weight: bold;
        font-size: 1.3em;
        width: 95%;
        margin-left: auto;
        
    }
    .upcoming-trip{
        width: 45%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }
    .uptrip-card {
        width: 90%;
        margin: 0;
        height: 65%;
        place-content: center;
        background: white;
        border-radius: 1em;
    }
    .uptrip-card .uptrip-card-content{
        width: 90%;
        height: 60%;
        /* margin-left: auto; */
        /* margin-right: auto; */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .uptrip-card .uptrip-card-details{
        font-size: 1.2em;
        font-weight: bold;
        display: flex;
        flex-direction: row;
        width: 80%;
        justify-content: space-between;
    }
    .uptrip-card .card-details div {
        /* width: 40%; */
    }

    .uptrip-card .card-footer{
        display: flex;
        height: 70%;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
    }


    .uptrip-card .uptrip-card-title{
        font-weight: bold;
        font-size: 1.2em;
        margin-left: 0;
        color: #1931A8;
    }

    .uptrip-card .uptrip-card-subtitle{
        margin-left: 0;
        font-size: 2em;
        font-weight: bold;
    }

    .uptrip-button {
    /* display: inline-block; */
    width: 90%;
    padding: 5% 0px;
    background-color: #1931A8;
    color: white;
    text-align: center;
    font-size: 100%;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    }

    /* Hover effect */
    .uptrip-button:hover {
    /* background-color: #45a049; */
    }


    .welcome-section{
        margin-left: auto;
        margin-right: auto;
        width:95%;
        height: 7%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;

    }
    .welcome-section .welcome-title{
        width:100%;
        font-weight: bold;
    }
    .welcome-section .welcome-subtitle{
        width:100%;
        color: gray;
    }
    @media screen and (min-width: 768px) {
        .trans-cards{
            display: none
        }
    }

    @media screen and (max-width: 768px) {
        .body-container{
        /* margin: 0;
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 100%; */
        height: unset;
        }
        .home-destination-row{
        height: 10em;
        width: 100%;
        }
        .welcome-title {
            width: 100%;
            font-weight: bold;
            font-size: x-large;
            margin: 1em 0.5em;
        }

        .welcome-subtitle {
            display: none;
            width: 100%;
            font-weight: bold;
            font-size: x-large;
            margin: 1em 0.5em;
        }
        .right-body-container{
            margin: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }
        .content-container{
            margin: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: unset;
            overflow: auto;
        }
        .content-main {
            height: 60%;
            display: flex;
            flex-direction: column-reverse;
            justify-content: space-around;
            
        }
        .custom-table {
            display: none;
        }
        .upcoming-trip{
            width: 100%;
            height: 25em;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }
        .uptrip-card {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            height: 75%;
            place-content: center;
            background: white;
            border-radius: 1em;
        }

        .uptrip-card .card-container{
            width: 80%;
        }
        .spacer {
            display: none;
        }
        .transaction-table-section{
            width: 100%;
        }
        .trans-card {
            display: flex;
            height: 7.0em;
            margin-bottom: 1.5em;
            width: 85%;
            margin-left: auto;
            margin-right: auto;
            border-bottom: solid #b7b7bc;
        }

        .trans-card-container{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            width: 100%;
            height: 90%;
        }

        .trans-card-detail {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-size: 1.2em;
        }
        .trans-card-id {
            font-size: 1.2em;
            font-weight: bold;
        } 
        
        .trans-card-datetime {
            color: #67686d;
        }

        .transaction-table-title {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

    }

</style>

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
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Welcome back, Irene </div>
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
                                echo "<div class='table-cell'>" . $row['id'] . "</div>";
                                echo "<div class='table-cell'>" . $row['item'] . "</div>";
                                echo "<div class='table-cell'>" . $row['date'] . "</div>";
                                echo "<div class='table-cell'>" . $row['amount'] . "</div>";
                                echo "<div class='table-cell'>" . $row['status'] . "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class = "trans-cards">

                            <!-- TODO: make dynamic -->
                            <div class = "trans-card">
                                <div class = "trans-card-container">
                                    <div class = "trans-card-id">#234thfk</div>
                                    <div class = "trans-card-detail"><div>Girls trip - Western Region</div><div style = "font-weight:bold;">GHS 500</div></div>
                                    <div class = "trans-card-datetime">Apr 21st 2023 - 10:29PM</div>
                                </div>
                            </div>
                            <div class = "trans-card">
                                <div class = "trans-card-container">
                                    <div class = "trans-card-id">#234thfk</div>
                                    <div class = "trans-card-detail"><div>Girls trip - Western Region</div><div style = "font-weight:bold;">GHS 500</div></div>
                                    <div class = "trans-card-datetime">Apr 21st 2023 - 10:29PM</div>
                                </div>
                            </div>
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
    function toggleSidebar(show) {
    var sidebar = document.getElementById('sidebar');
    if (show) {
        sidebar.classList.remove('sidebar-hidden');
    } else {
        sidebar.classList.add('sidebar-hidden');
    }
}
</script>
</html>