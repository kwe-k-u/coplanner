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
    array("id" => 10, "item" => "Item 10", "date" => "2024-04-24", "amount" => 300, "status" => "Completed"),
    array("id" => 11, "item" => "Item 11", "date" => "2024-04-15", "amount" => 100, "status" => "Pending"),
    array("id" => 12, "item" => "Item 12", "date" => "2024-04-16", "amount" => 150, "status" => "Completed"),
    array("id" => 13, "item" => "Item 13", "date" => "2024-04-17", "amount" => 200, "status" => "Pending"),
    array("id" => 14, "item" => "Item 14", "date" => "2024-04-18", "amount" => 120, "status" => "Completed"),
    array("id" => 15, "item" => "Item 15", "date" => "2024-04-19", "amount" => 180, "status" => "Pending"),
    // array("id" => 6, "item" => "Item 6", "date" => "2024-04-20", "amount" => 220, "status" => "Completed"),
    // array("id" => 7, "item" => "Item 7", "date" => "2024-04-21", "amount" => 130, "status" => "Pending"),
    // array("id" => 8, "item" => "Item 8", "date" => "2024-04-22", "amount" => 170, "status" => "Completed"),
    // array("id" => 9, "item" => "Item 9", "date" => "2024-04-23", "amount" => 250, "status" => "Pending"),
    // array("id" => 10, "item" => "Item 10", "date" => "2024-04-24", "amount" => 300, "status" => "Completed")
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
        background: #E8EAF6;

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
        /* justify-content: space-between; */
        overflow: auto;
    }

    .content-main {
        height: 80%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        
    }
    .search-main{
        height: 10%;
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .search-container{
        height: 80%;
        width: 90%;
        display: flex;
        flex-direction: row;
        margin-left: auto;
        margin-right: auto;
        justify-content: space-between;
    }
    .search-area{
        height: 60%;
        width: 70%;
        display: flex;
        flex-direction: row;
        align-items: center;
        background: white;
        justify-content: center;
        border-radius: 10px;
    }
    .search-input{
        border: none;
        height: 90%;
        width: 90%;
        background: none;
        
    }
    .search-input:focus-visible {
        outline: none;
    }

    .search-icon{
        width: 3%;
    }

    .search-newtrip{
        height: 60%;
        background: white;
        width: 6em;
        text-align: center;
        align-content: center;
        border-radius: 7.5px;
    }


    .trip-table-section{
        width:85%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }

    .trip-table-tab{
        height: 20%;
    }

    .tab-container {
        display: flex;
    }

    .tab {
        padding: 10px 10px;
        cursor: pointer;
        color: #67686d;
    }

    .active {
        color: #7d48be;
        font-weight: bold;
        border-bottom: 2px solid #7d48be;
    }
    .upcoming-trip {
        width: fit-content;
        /* padding: 2px; */
        background: yellow;
        padding: 0px 5px;
        font-size: smaller;
        border-radius: 10px;
        color: #878b31cc;
        border: 1px solid #878b31cc;
    }



    /* Your existing CSS styles */

    .custom-table {
        display: flex;
        flex-direction: column;
        /* border: 1px solid #ccc; */
        border-radius: 10px;
        background: white;
    }

    .table-row {
        display: flex;
    }

    .header {
        background-color: #f6d3f6;
        font-weight: bold;
    }

    .table-cell {
        /* flex: 1; */
        width: 15%;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .table-cell:last-child {
        border-right: none;
        
    }

    .table-row:last-child .table-cell{
        border-bottom: none;
        
    }
    .table-row .table-cell:first-child{
        width: 30%;
        
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
        width: 100%; */
        height: unset;
        }
        .home-destination-row{
        height: 10em;
        width: 100%;
        }

        .welcome-subtitle {
            display: none;
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
        .search-main{
            height: 9em;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 4em;
        }

        .search-container{
            height: 100%;
            width: 90%;
            display: flex;
            flex-direction: column;
            margin-left: auto;
            margin-right: auto;
            justify-content: space-between;
            align-items: end;
        }
        .search-area{
            height: 4em;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            background: white;
            justify-content: space-evenly;
        }
        .search-input{
            border: none;
            height: 90%;
            width: 90%;
            background: none;
        }

        .search-icon{
            width: 3%;
        }

        .search-newtrip{
            height: 4em;
            background: white;
            width: 7em;
            text-align: center;
            align-content: center;
        }


        .trip-table-section{
            width:85%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .trip-table-tab{
            height: 20%;
            margin-bottom: 2em;
        }

        .tab-container {
            display: flex;
        }

        .tab {
            padding: 10px 10px;
            cursor: pointer;
            color: #67686d;
        }
        .custom-table {
            display: none;
        }

        .uptrip-card .card-container{
            width: 80%;
        }
        .spacer {
            display: none;
        }
        .trip-table-section{
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
                <div style="
                        width: 95%;
                        margin-left: auto;
                        margin-bottom: 1em;
                        font-size: larger;
                        font-weight: bold;
                    ">My trips</div>
                <div class = "search-main">
                    <div class = "search-container">
                        <div class = "search-area">
                            <div class = "search-icon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <input type = "text" id = "search-input" class = "search-input" placeholder = "Search for trips">
                        </div>
                        <div class = "search-newtrip"><i class="fa-solid fa-plus"></i> New trip</div>
                    </div>
                </div>
                <div class="content-main">
                    <div class="trip-table-section">
                        <div class="trip-table-tab">
                            <div class="tab-container">
                                <div class="tab active" onclick="changeTab(1)" id="tab1">All trips</div>
                                <div class="tab" onclick="changeTab(2)" id="tab2">Upcoming trips</div>
                                <div class="tab" onclick="changeTab(3)" id="tab3">Ongoing trips</div>
                                <div class="tab" onclick="changeTab(4)" id="tab4">Past trips</div>
                            </div>
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
                                echo "<div class='table-cell'> <div class ='upcoming-trip'> " . $row['status'] . "</div></div>";
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
    function changeTab(tabNumber) {
        // Remove 'active' class from all tabs
        var tabs = document.querySelectorAll('.tab');
        tabs.forEach(function(tab) {
            tab.classList.remove('active');
        });
        
        // Add 'active' class to the clicked tab
        var tab = document.getElementById('tab' + tabNumber);
        tab.classList.add('active');
    }

</script>
</html>