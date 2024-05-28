<?php
require_once(__DIR__."/../utils/core.php");

// Dummy array object
$fullData = array(
     array("id" => 1, "name" => "Girls Trip", "location" => "Item 1", "date" => "2024-04-15", "NoD" => 2, "status" => "Past"),
     array("id" => 2, "name" => "Girls Trip", "location" => "Item 2", "date" => "2024-04-16", "NoD" => 4, "status" => "Past"),
     array("id" => 3, "name" => "Girls Trip", "location" => "Item 3", "date" => "2024-04-17", "NoD" => 1, "status" => "Past"),
     array("id" => 4, "name" => "Girls Trip", "location" => "Item 4", "date" => "2024-04-18", "NoD" => 6, "status" => "Past"),
     array("id" => 5, "name" => "Girls Trip", "location" => "Item 5", "date" => "2024-04-19", "NoD" => 3, "status" => "Past"),
     array("id" => 6, "name" => "Girls Trip", "location" => "Item 6", "date" => "2024-04-20", "NoD" => 3, "status" => "Past"),
     array("id" => 7, "name" => "Girls Trip", "location" => "Item 7", "date" => "2024-04-21", "NoD" => 3, "status" => "Past"),
     array("id" => 8, "name" => "Girls Trip", "location" => "Item 8", "date" => "2024-04-22", "NoD" => 2, "status" => "Past"),
     array("id" => 9, "name" => "Girls Trip", "location" => "Item 9", "date" => "2024-04-23", "NoD" => 3, "status" => "Upcoming"),
    array("id" => 10, "name" => "Girls Trip", "location" => "Item 10", "date" => "2024-04-24", "NoD" => 5, "status" => "Upcoming"),
    array("id" => 11, "name" => "Girls Trip", "location" => "Item 11", "date" => "2024-04-15", "NoD" => 5, "status" => "Upcoming"),
    array("id" => 12, "name" => "Girls Trip", "location" => "Item 12", "date" => "2024-04-16", "NoD" => 6, "status" => "Upcoming"),
    array("id" => 13, "name" => "Girls Trip", "location" => "Item 13", "date" => "2024-04-17", "NoD" => 6, "status" => "Ongoing"),
    array("id" => 14, "name" => "Girls Trip", "location" => "Item 14", "date" => "2024-04-18", "NoD" => 7, "status" => "Upcoming"),
    array("id" => 15, "name" => "Girls Trip", "location" => "Item 15", "date" => "2024-04-19", "NoD" => 7, "status" => "Ongoing")
);

function filterCompletedItems($status, $data) {
    $completedItems = array_filter($data, function($item) use ($status) {
        return $item['status'] === $status;
    });
    return $completedItems;
}

?>
<!DOCTYPE html>
<html lang="en">
<script src="../assets/js/functions.js"></script>
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
    }

    .trip-table-tab{
        height: 10%;
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

    .trip-status {
        width: fit-content;
        /* padding: 2px; */
        padding: 0px 5px;
        font-size: smaller;
        border-radius: 10px;

    }

    .upcoming-trip {
        background: #feffad;
        color: #888105cc;
        border: 1px solid #888105cc;
    }

    .ongoing-trip {
        background: #cdf6c5;
        color: #1a7d0dcc;
        border: 1px solid #1a7d0dcc;
    }

    .past-trip {
        background: #ebebeb;
        color: #757575cc;
        border: 1px solid #757575cc;
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



    .tabToHide {
        display: none !important;
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
            justify-content: center;
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
                    <div class="trip-table-section" id="trip-table-section">
                        <div class="trip-table-tab">
                            <div class="tab-container">
                                <div class="tab active" onclick="changeTab(1)" id="tab1">All trips</div>
                                <div class="tab" onclick="changeTab(2)" id="tab2">Upcoming trips</div>
                                <div class="tab" onclick="changeTab(3)" id="tab3">Ongoing trips</div>
                                <div class="tab" onclick="changeTab(4)" id="tab4">Past trips</div>
                            </div>
                        </div>
                        <div class="custom-table " id = "all-trips">
                            <div class="table-row header">
                                <div class="table-cell">id</div>
                                <div class="table-cell">location</div>
                                <div class="table-cell">date</div>
                                <div class="table-cell">Number of days</div>
                                <div class="table-cell">status</div>
                            </div>
                            <?php
                            $status2class = array("Past" => "past-trip", "Upcoming" => "upcoming-trip", "Ongoing" => "ongoing-trip");
                            foreach ($fullData as $row) {
                                echo "<div class='table-row'>";
                                echo "<div class='table-cell'>" . $row['id'] . "</div>";
                                echo "<div class='table-cell'>" . $row['location'] . "</div>";
                                echo "<div class='table-cell'>" . $row['date'] . "</div>";
                                echo "<div class='table-cell'>" . $row['NoD'] . "</div>";
                                echo "<div class='table-cell'> <div class ='trip-status ". $status2class[$row['status']]  ."'> " . $row['status'] . "</div></div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class="custom-table tabToHide" id = "up-trips">
                            <div class="table-row header">
                                <div class="table-cell">id</div>
                                <div class="table-cell">location</div>
                                <div class="table-cell">date</div>
                                <div class="table-cell">Number of days</div>
                                <div class="table-cell">status</div>
                            </div>
                            <?php
                            $status = "Upcoming";
                            $data = filterCompletedItems($status, $fullData);
                            foreach ($data as $row) {
                                echo "<div class='table-row'>";
                                echo "<div class='table-cell'>" . $row['id'] . "</div>";
                                echo "<div class='table-cell'>" . $row['location'] . "</div>";
                                echo "<div class='table-cell'>" . $row['date'] . "</div>";
                                echo "<div class='table-cell'>" . $row['NoD'] . "</div>";
                                echo "<div class='table-cell'> <div class ='trip-status upcoming-trip'> " . $row['status'] . "</div></div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class="custom-table tabToHide" id = "on-trips">
                            <div class="table-row header">
                                <div class="table-cell">id</div>
                                <div class="table-cell">location</div>
                                <div class="table-cell">date</div>
                                <div class="table-cell">Number of days</div>
                                <div class="table-cell">status</div>
                            </div>
                                <?php
                                $status = "Ongoing";
                                $data = filterCompletedItems("Ongoing", $fullData);
                                    foreach ($data as $row) {
                                        echo "<div class='table-row'>";
                                        echo "<div class='table-cell'>" . $row['id'] . "</div>";
                                        echo "<div class='table-cell'>" . $row['location'] . "</div>";
                                        echo "<div class='table-cell'>" . $row['date'] . "</div>";
                                        echo "<div class='table-cell'>" . $row['NoD'] . "</div>";
                                        echo "<div class='table-cell'> <div class ='trip-status ongoing-trip'> " . $row['status'] . "</div></div>";
                                        echo "</div>";
                                    }
                                ?>
                        </div>
                        <div class="custom-table tabToHide" id = "past-trips">
                            <div class="table-row header">
                                <div class="table-cell">id</div>
                                <div class="table-cell">location</div>
                                <div class="table-cell">date</div>
                                <div class="table-cell">Number of days</div>
                                <div class="table-cell">status</div>
                            </div>
                            <?php
                            $status = "Past";
                            $data = filterCompletedItems("Past", $fullData);
                            foreach ($data as $row) {
                                echo "<div class='table-row'>";
                                echo "<div class='table-cell'>" . $row['id'] . "</div>";
                                echo "<div class='table-cell'>" . $row['location'] . "</div>";
                                echo "<div class='table-cell'>" . $row['date'] . "</div>";
                                echo "<div class='table-cell'>" . $row['NoD'] . "</div>";
                                echo "<div class='table-cell'> <div class ='trip-status past-trip'> " . $row['status'] . "</div></div>";
                                echo "</div>";
                            }
                            ?>
                        </div>




                        <?php
                            $status = "past";
                            $data = filterCompletedItems("Past", $fullData);
                            echo "<div class = 'trans-cards tabToHide' id= '". $status ."-trips-mobile'  >";
                            foreach ($data as $row) {
                                
                            
                                echo "<div class = 'trans-card' >";
                                echo "<div class = 'trans-card-container'>";
                                echo "<div class = 'trans-card-id'>" . $row['id'] . "</div>";
                                echo "<div class = 'trans-card-detail'><div>" . $row['location'] . "</div><div style = 'font-weight:bold;'>GHS 500</div></div>";
                                echo "<div class = 'trans-card-datetime'>" . $row['date'] . "</div>";
                                echo "   </div> ";
                                echo "   </div> ";
                            }
                            echo "</div>";
                            ?>
                        <?php
                            $status = "all";
                            echo "<div class = 'trans-cards' id= '". $status ."-trips-mobile'  >";
                            foreach ($fullData as $row) {
                                
                            
                                echo "<div class = 'trans-card' >";
                                echo "<div class = 'trans-card-container'>";
                                echo "<div class = 'trans-card-id'>" . $row['id'] . "</div>";
                                echo "<div class = 'trans-card-detail'><div>" . $row['location'] . "</div><div style = 'font-weight:bold;'>GHS 500</div></div>";
                                echo "<div class = 'trans-card-datetime'>" . $row['date'] . "</div>";
                                echo "   </div> ";
                                echo "   </div> ";
                            }
                            echo "</div>";
                            ?>
                        <?php
                            $status = "up";
                            $data = filterCompletedItems("Upcoming", $fullData);
                            echo "<div class = 'trans-cards tabToHide' id= '". $status ."-trips-mobile'  >";
                            foreach ($data as $row) {
                                
                            
                                echo "<div class = 'trans-card' >";
                                echo "<div class = 'trans-card-container'>";
                                echo "<div class = 'trans-card-id'>" . $row['id'] . "</div>";
                                echo "<div class = 'trans-card-detail'><div>" . $row['location'] . "</div><div style = 'font-weight:bold;'>GHS 500</div></div>";
                                echo "<div class = 'trans-card-datetime'>" . $row['date'] . "</div>";
                                echo "   </div> ";
                                echo "   </div> ";
                            }
                            echo "</div>";
                            ?>
                            
                        <?php
                            $status = "on";
                            $data = filterCompletedItems("Ongoing", $fullData);
                            echo "<div class = 'trans-cards tabToHide' id= '". $status ."-trips-mobile'  >";
                            foreach ($data as $row) {
  
                                echo "<div class = 'trans-card' >";
                                echo "<div class = 'trans-card-container'>";
                                echo "<div class = 'trans-card-id'>" . $row['id'] . "</div>";
                                echo "<div class = 'trans-card-detail'><div>" . $row['location'] . "</div><div style = 'font-weight:bold;'>GHS 500</div></div>";
                                echo "<div class = 'trans-card-datetime'>" . $row['date'] . "</div>";
                                echo "   </div> ";
                                echo "   </div> ";
                            }
                            echo "</div>";
                            ?>
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
    var tabs = {
        1: "all-trips",
        2: "up-trips",
        3: "on-trips",
        4: "past-trips"
    }

    function displayTable(id) {
        tabTodisplay = tabs[id];
        tableDiv = document.getElementById("trip-table-section");
        const children = tableDiv.children;

        if (window.matchMedia("(max-width: 768px)").matches) {
            for (let i = 0; i < children.length; i++) {
                if (children[i].classList.contains("trans-cards")  && children[i].id === tabTodisplay+"-mobile"){
                    children[i].classList.remove("tabToHide")
                } else if (children[i].classList.contains("trans-cards") && !(children[i].classList.contains("tabToHide"))) {
                    children[i].classList.add("tabToHide")
                }
            }
            return;
        }

        for (let i = 0; i < children.length; i++) {
            if (children[i].classList.contains("custom-table")  && children[i].id === tabTodisplay){
                children[i].id 
                children[i].classList.remove("tabToHide")
            } else if (children[i].classList.contains("custom-table") && !(children[i].classList.contains("tabToHide"))) {
                children[i].classList.add("tabToHide")
            }
        }
    }

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
        displayTable(tabNumber);
    }

</script>
</html>