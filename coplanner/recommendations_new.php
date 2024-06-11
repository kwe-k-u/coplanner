<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
$showHome = true;

// Dummy array object
$data = array(
    array("id" => 1, "name" => "Waterfalls", "region" => "Eastern", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 2, "name" => "Waterfalls", "region" => "Eastern", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 3, "name" => "Waterfalls", "region" => "Eastern", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 4, "name" => "Waterfalls", "region" => "Greater Accra", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 5, "name" => "Waterfalls", "region" => "Greater Accra", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 6, "name" => "Waterfalls", "region" => "Western", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 7, "name" => "Waterfalls", "region" => "Western Accra", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 8, "name" => "Waterfalls", "region" => "Greater Accra", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 9, "name" => "Waterfalls", "region" => "Greater Accra", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg"),
    array("id" => 10, "name" => "Waterfalls", "region" => "Greater Accra", "cost" => "600", "creator" => "Kwame Asante", "activities" => array("paintball", "shopping","swimming", "smilling"), "image" => "../assets/images/site_images/d-lab-expo.jpg")
);

function groupByRegion($data) {
    $grouped_data = array();

    foreach ($data as $item) {
        $region = $item["region"];
        if (!array_key_exists($region, $grouped_data)) {
            $grouped_data[$region] = array();
        }
        $grouped_data[$region][] = $item;
    }

    return $grouped_data;
}

$groupedData = groupByRegion($data);


?>

<!DOCTYPE html>
<html lang="en">
<script src="../assets/js/functions.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
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
        font-family: 'Nunito';
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
        width: 100%;
        height: 100%;
    }

    .content-container{
        margin: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        overflow: auto;
    }

    .content-main {
        height: 60%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        
    }

    .disable{
        cursor: not-allowed !important;
        opacity: 30%;
    }

    

    .welcome-section{
        margin-left: auto;
        margin-right: auto;
        width:95%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;

    }
    .welcome-section .welcome-title{
        width:100%;
        font-weight: bold;
        font-size: 1.5em;
    }
    .welcome-section .welcome-subtitle{
        width:100%;
        color: gray;
    }

    .itinerary-section {
        margin: 1em 0 2em 0;
    }


    .itinerary-list{
        width: 90%;
        height: 92.5%;
        margin-left: auto;
        margin-right:auto;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;

    }


    .itinerary-item{
        width: 22.5em;
        height: 24em;
        border-radius: 15px;
        overflow: hidden;
        border: 2px #c1bcbc solid;
        margin: 0.5em;
    }
    .itinerary-list > .itinerary-item:last-child{
        margin-bottom: 0px ;
    }

    .itinerary-image img {
        width: 100%;
    }

    .itinerary-container {
        width: 95%;
        height: 35%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }
    .itinerary-title{
        display: inline-flex;
        justify-content: space-between;
        width: 100%;
    }
    .itinerary-details > div{
        display: flex;
        align-items: center;
    }
    .itinerary-details > div > .material-symbols-outlined{
        color: gray;
    }

    .itinerary-name {
        font-weight: bold;
        font-size: large;
    }
    .itinerary-cost {
        text-decoration-line: underline;
        color: blue;
    }
    .itinerary-highlights{
        display: inline-flex;
        justify-content: space-between;
    }
    .itinerary-highlight-item {
        color: white;
        background: #1931A8;
        padding: 2px 4px;
        border-radius: 10px;
    }


    #content-container-1 .form-button-previous {
        cursor: not-allowed;

    }


    .hidden {
        display: none;
    }

    #warningMessage {
        position: fixed;
        z-index: 2;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #f50053;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    

    .inactive {
        display: none !important;
    }

    


    

    @media screen and (min-width: 768px) {

    }
    

    @media screen and (max-width: 768px) {

        .trip-form-2 {
            margin-bottom: 1em;
            width: 80%;
        }

        .body-container{
            /* height: unset; */
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
            overflow: auto;
        }

        .content-main {
            height: 60%;
            display: flex;
            flex-direction: column-reverse;
            justify-content: space-around;
            
        }


    }

    

</style>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<body>
    <div class = "body-container">
        <!-- sidebar -->
        <?php
        require_once(__DIR__."/sidebar.php");
        ?>
        <div class = "right-body-container">
            <!-- topbar -->
            <?php
            $showHome = false;
            require_once(__DIR__."/topbar.php"); 
            ?>
            
            <div class = "content-container"  id = "content-container-6">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Itinerary recommendations</div>
                </div>
                <div class = "itinerary-section ">
                    <div class = "itinerary-list">
                        <?php
                            foreach ($data as $row) {
                                echo "<div class='itinerary-item'>
                                        <div class='itinerary-image'><img src=". $row['image'] ." /></div>
                                        <div class='itinerary-container'>
                                            <div class='itinerary-title'>
                                                <div class='itinerary-name'>" . $row['name'] . "</div>
                                                <div class='itinerary-cost'>Estimated cost GHS " . $row['cost'] . "</div>
                                            </div>
                                            <div class='itinerary-details'>
                                                <div><span class='material-symbols-outlined'>location_on</span>" . $row['region'] . " Region</div>
                                            </div>
                                            <div class='itinerary-highlights'>";
                                            
                                            for ($x = 0; $x <= 2; $x++) {
                                                if (isset($row['activities'][$x])) {
                                                    echo "<div class='itinerary-highlight-item'>" . $row['activities'][$x] . "</div>";
                                                }
                                            }
                                            
                                echo "          <div class='itinerary-highlight-more'>+<span>4</span> more</div>
                                            </div>
                                        </div>
                                    </div>";
                            }
                        ?>
                    </div>
                    
                </div>

                <?php
                    foreach ($groupedData as $region => $regiondata) {
                        echo "<div class = 'welcome-section'>";
                        echo "<div class = 'welcome-title'>". $region . " Region destinations</div>";
                        echo "</div>";
                        echo " <div class = 'itinerary-section '>
                            <div class = 'itinerary-list'> ";
                            
                                    foreach ($regiondata as $row) {
                                        echo "<div class='itinerary-item'>
                                                <div class='itinerary-image'><img src=". $row['image'] ." /></div>
                                                <div class='itinerary-container'>
                                                    <div class='itinerary-title'>
                                                        <div class='itinerary-name'>" . $row['name'] . "</div>
                                                        <div class='itinerary-cost'>Estimated cost GHS " . $row['cost'] . "</div>
                                                    </div>
                                                    <div class='itinerary-details'>
                                                        <div><span class='material-symbols-outlined'>location_on</span>" . $row['region'] . " Region</div>
                                                    </div>
                                                    <div class='itinerary-highlights'>";
                                                    
                                                    for ($x = 0; $x <= 2; $x++) {
                                                        if (isset($row['activities'][$x])) {
                                                            echo "<div class='itinerary-highlight-item'>" . $row['activities'][$x] . "</div>";
                                                        }
                                                    }
                                                    
                                        echo "          <div class='itinerary-highlight-more'>+<span>4</span> more</div>
                                                    </div>
                                                </div>
                                            </div>";
                                    }
                                
                        echo "    </div>
                            
                        </div>";
                    }
                ?>

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