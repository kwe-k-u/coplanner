<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
$showHome = true;

// Dummy array object
// $data = array(
//     array("id" => 1, "item" => "Item 1", "date" => "2024-04-15", "amount" => 100, "status" => "Pending"),
//     array("id" => 2, "item" => "Item 2", "date" => "2024-04-16", "amount" => 150, "status" => "Completed"),
//     array("id" => 3, "item" => "Item 3", "date" => "2024-04-17", "amount" => 200, "status" => "Pending"),
//     array("id" => 4, "item" => "Item 4", "date" => "2024-04-18", "amount" => 120, "status" => "Completed"),
//     array("id" => 5, "item" => "Item 5", "date" => "2024-04-19", "amount" => 180, "status" => "Pending"),
//     array("id" => 6, "item" => "Item 6", "date" => "2024-04-20", "amount" => 220, "status" => "Completed"),
//     array("id" => 7, "item" => "Item 7", "date" => "2024-04-21", "amount" => 130, "status" => "Pending"),
//     array("id" => 8, "item" => "Item 8", "date" => "2024-04-22", "amount" => 170, "status" => "Completed"),
//     array("id" => 9, "item" => "Item 9", "date" => "2024-04-23", "amount" => 250, "status" => "Pending"),
//     array("id" => 10, "item" => "Item 10", "date" => "2024-04-24", "amount" => 300, "status" => "Completed")
// );

$hm = new public_class();
$data = $hm->get_transaction("U001");
// echo json_encode($hi);
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

    .content-container-2{
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

    .form-button-container{
        display: flex;
        width: 40%;
        margin-left: auto;
        margin-right: auto;
    }

    .form-button {
    /* display: inline-block; */
        width: 40%;
        padding: 1em 0px;
        background-color: #1931A8;
        color: white;
        text-align: center;
        font-size: 100%;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: auto;
        margin-right: auto;
    }

    /* Hover effect */
    .form-button:hover {
    /* background-color: #45a049; */
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
    .custom-dropdown {
        position: relative;
        display: inline-block;
    }

    .selected-item {
        width: 96% !important;
        background-color: #ffffff;
        border: 1px solid #ccc;
        padding: 10px;
        cursor: pointer;
        width: 150px;
    }

    .dropdown-content {
        width: 100%;
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        width: 150px;
    }

    .dropdown-item {
        padding: 10px;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .trip-form-main {
        width: 100%;
        height: 90%;
    }
    .trip-form-container {
        height: 90%;
        width: 80%;
        margin-left: auto;
        margin-right:auto;
        display: flex;
        flex-direction: column;
    }

    .itinerary-section {
        height: 80%;
        overflow: scroll;
    }
    .trip-form-container-2 {
        height: 90%;
        width: 90%;
        margin-left: auto;
        margin-right:auto;
        display: flex;
        flex-direction: column;
    }

    .itinerary-list{
        width: 90%;
        height: 92.5%;
        margin-left: auto;
        margin-right:auto;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
    }


    .itinerary-item{
        width: 22.5em;
        height: 24em;
        border-radius: 15px;
        overflow: hidden;
        border: 2px #c1bcbc solid;
        margin-bottom: 1em;
    }
    .itinerary-list > .itinerary-item:last-child{
        margin-bottom: 0px ;
    }

    .itinerary-image img {
        width: 100%;
    }

    .itinerary-container {
        width: 95%;
        height: 25%;
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
    .itinerary-details{

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
        width: 75%;
    }
    .itinerary-highlight-item {
        color: white;
        background: blue;
        padding: 2px 1px;
        border-radius: 10px;
    }
    
    .selected {
        border-color: #1931A8;
        box-shadow: 0px 0px 11px 1px #1931A8;
        outline: none;
        text-shadow: #1931A8 0px 0px 19px;
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
    .trip-form-container {
            justify-content: space-around;
        }

    .trip-form-container-2 {
        justify-content: space-around;
    }

    .trip-form {
        width: 100%;
        height: 70%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
        overflow-x: none;
        overflow-y: scroll;
    }

    .trip-form-1 {
        width: 45%;
        height: 40%;
        border: 2px solid white;
        border-radius: 15px;
        align-content: center;
        text-align: center;
        background: white;
        font-size: x-large;
        color: #1931A8;
        cursor: pointer;
        margin-bottom: 1em;
    }

    .trip-form-2 {
        width: 45%;
        height: 29%;
        border: 2px solid white;
        border-radius: 15px;
        align-content: center;
        text-align: center;
        background: white;
        font-size: x-large;
        color: #1931A8;
        cursor: pointer;
        margin-bottom: 1em;
    }

    .trip-form-3 {
        width: 30%;
        height: 90%;
        border: 2px solid white;
        border-radius: 15px;
        align-content: center;
        text-align: center;
        background: white;
        font-size: x-large;
        color: #1931A8;
        cursor: pointer;
        margin-bottom: 1em;
    }

    .inactive {
        display: none !important;
    }

    .slide-left-and-vanish {
        animation: slideLeftAndVanish 0.3s forwards;
    }

    @keyframes slideLeftAndVanish {
        0% {
            opacity: 1;
            transform: translateX(0);
        }
        100% {
            opacity: 0;
            transform: translateX(-100%);
        }
    }

    .slide-right-and-appear {
        animation: slideRightAndVanish 0.5s forwards;
        }

        @keyframes slideRightAndVanish {
        0% {
            opacity: 0;
            transform: translateX(-100%);
        }
        100% {
            opacity: 1;
            transform: translateX(0%);
        }
    }

    .slide-right-to-left-and-disappear {
    animation: slideRightToLeftAnddisAppear 1s forwards;
    }

    @keyframes slideRightToLeftAnddisAppear {
        0% {
            opacity: 0;
            transform: translateX(0%);
        }
        100% {
            opacity: 1;
            transform: translateX(100%);
        }
    }

    .slide-right-to-left-and-appear {
    animation: slideRightToLeftAndAppear 0.3s forwards;
    }

    @keyframes slideRightToLeftAndAppear {
        0% {
            opacity: 0;
            transform: translateX(100%);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media screen and (min-width: 768px) {

    }

    @media screen and (max-width: 768px) {


        .body-container{
            /* height: unset; */
        }

        .trip-form-2 {
            width: 80%;
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

        .spacer {
            display: none;
        }

        .trip-form-3 {
            width: 98% !important;
            height: 30%;

        }
        .trip-form {
            height: 90%;
            overflow-y: unset !important;
        }

        #content-container-4 .trip-form {
            flex-wrap: unset;
            flex-direction: column;
        }

        .trip-form-container {
            justify-content: space-around;
        }

    }

    

</style>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<body>
    <div class = "body-container">
        <!-- sidebar -->
        
        <div class = "right-body-container">
            <!-- topbar -->
            <?php
            $showHome = true;
            require_once(__DIR__."/topbar.php");
            

            ?>
                <div id="warningMessage" class="hidden">
                    <p>Select an option!!</p>
                </div>
            <div class = "content-container "  id = "content-container-1">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Where do you want to go? </div>
                </div>
                
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form" id = "trip-form-1" id = "trip-form-1" name = "region">
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-1-1" value = "Greater Accra" > Greater Accra</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-1-2" value = "Western Region"> Western Region</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-1-3" value = "Eastern Region"> Eastern Region</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-1-4" value = "Volta Region"> Volta Region</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button form-button-previous" >previous</div>
                            <div class="form-button" onclick = "nextFormQuestion(1)">Continue</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "content-container inactive"  id = "content-container-2">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> How long do you want to spend on the trip </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form" id = "trip-form-2" name = "numOfDays">
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-2-1" value = "1" > Just a day</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-2-2" value = "2-3"> 2 or 3 days</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-2-3" value = "4-5"> 4 or 5 days</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-2-4" value = "7"> About a week</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "prevFormQuestion(2)">previous</div>
                            <div class="form-button" onclick = "nextFormQuestion(2)">Continue</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "content-container inactive"  id = "content-container-3">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Who is travelling on this trrip with you </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form" id = "trip-form-3" name = "tripType">
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-3-1" value = "solo">Solo</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-3-2" value = "couple">Couple</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-3-3" value = "family">Family</div>
                            <div class = "trip-form-1" onclick = "processSelection(event)" id = "formOption-3-4" value = "friends">Friends</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "prevFormQuestion(3)">previous</div>
                            <div class="form-button" onclick = "nextFormQuestion(3)">Continue</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class = "content-container inactive"  id = "content-container-4">
                <!-- main content here --> 
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Select the vibe for the trip <span> (you can select more than one)</span></div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form" id = "trip-form-4" name = "activityType">
                            <div class = "trip-form-2" onclick = "processMultiSelection(event)" id = "formOption-4-1" value = "Spa and Wellness"> Spa and Wellness</div>
                            <div class = "trip-form-2" onclick = "processMultiSelection(event)" id = "formOption-4-2" value = "Adventure and sport"> Adventure and sport</div>
                            <div class = "trip-form-2" onclick = "processMultiSelection(event)" id = "formOption-4-3" value = "Landmark and sight seeing"> Landmark and sight seeing</div>
                            <div class = "trip-form-2" onclick = "processMultiSelection(event)" id = "formOption-4-4" value = "Culture and history"> Culture and history</div>
                            <div class = "trip-form-2" onclick = "processMultiSelection(event)" id = "formOption-4-5" value = "Waterfalls"> Waterfalls</div>
                            <div class = "trip-form-2" onclick = "processMultiSelection(event)" id = "formOption-4-6" value = "Alternative experience"> Alternative experience</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "prevFormQuestion(4)">previous</div>
                            <div class="form-button" onclick = "nextFormQuestion(4)">Continue</div>
                        </div>
                    </div>
                    
                </div>  
            </div>
            <div class = "content-container-2 inactive"  id = "content-container-5">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Trip details </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container-2">
                        <div class = "trip-form" id = "trip-form-5" name = "tripMaxCost">
                            <div class = "trip-form-3" onclick = "processSelection(event)" id = "formOption-5-1" value = "1000"> GHS 0 - GHS 1000</div>
                            <div class = "trip-form-3" onclick = "processSelection(event)" id = "formOption-5-2" value = "4999"> GHS 1000 - GHS 4999</div>
                            <div class = "trip-form-3" onclick = "processSelection(event)" id = "formOption-5-3" value = "inf"> GHS 5000 and above </div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "prevFormQuestion(5)">previous</div>
                            <div class="form-button" onclick = "nextFormQuestion(5)">Continue</div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class = "content-container inactive"  id = "content-container-6">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Itinerary recommendations</div>
                </div>
                <div class = "itinerary-section ">
                    <div class = "itinerary-list">
                       <?php
                         echo"   <div class = 'itinerary-item'>
                            <div class = 'itinerary-image'><img src =  '../assets/images/site_images/d-lab-expo.jpg' /> </div>
                            <div class='itinerary-container'>
                                <div class = 'itinerary-title'>
                                    <div class='itinerary-name'> Chasing waterfalls</div> <div class='itinerary-cost'> Estimated cost GHS 600</div>
                                </div>
                                <div class = 'itinerary-details'>
                                    <div> Created by <span style= 'color: orange;'>Kweku Acquaye</span></div> 
                                </div>
                                <div class = 'itinerary-highlights'>
                                    <div class = 'itinerary-highlight-item'> Paintball</div> 
                                    <div class = 'itinerary-highlight-item'> Darts</div>
                                    <div class = 'itinerary-highlight-item'> Shopping</div>
                                    <div class = 'itinerary-highlight-more'> +<span>4</span> more</div>
                                </div>
                            </div>
                            </div>"
                        ?>
                        <div class = "itinerary-item">
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class="itinerary-container">
                                <div class = "itinerary-title">
                                    <div class="itinerary-name"> Chasing waterfalls</div> <div class="itinerary-cost"> Estimated cost GHS 600</div>
                                </div>
                                <div class = "itinerary-details">
                                    <div> Created by <span style= "color: orange;">Kweku Acquaye</span></div> 
                                </div>
                                <div class = "itinerary-highlights">
                                    <div class = "itinerary-highlight-item"> Paintball</div> 
                                    <div class = "itinerary-highlight-item"> Darts</div>
                                    <div class = "itinerary-highlight-item"> Shopping</div>
                                    <div class = "itinerary-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                        </div>
                        <div class = "itinerary-item">
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class="itinerary-container">
                                <div class = "itinerary-title">
                                    <div class="itinerary-name"> Chasing waterfalls</div> <div class="itinerary-cost"> Estimated cost GHS 600</div>
                                </div>
                                <div class = "itinerary-details">
                                    <div> Created by <span style= "color: orange;">Kweku Acquaye</span></div> 
                                </div>
                                <div class = "itinerary-highlights">
                                    <div class = "itinerary-highlight-item"> Paintball</div> 
                                    <div class = "itinerary-highlight-item"> Darts</div>
                                    <div class = "itinerary-highlight-item"> Shopping</div>
                                    <div class = "itinerary-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                        </div>
                        <div class = "itinerary-item">
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class="itinerary-container">
                                <div class = "itinerary-title">
                                    <div class="itinerary-name"> Chasing waterfalls</div> <div class="itinerary-cost"> Estimated cost GHS 600</div>
                                </div>
                                <div class = "itinerary-details">
                                    <div> Created by <span style= "color: orange;">Kweku Acquaye</span></div> 
                                </div>
                                <div class = "itinerary-highlights">
                                    <div class = "itinerary-highlight-item"> Paintball</div> 
                                    <div class = "itinerary-highlight-item"> Darts</div>
                                    <div class = "itinerary-highlight-item"> Shopping</div>
                                    <div class = "itinerary-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                        </div>
                        <div class = "itinerary-item">
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class="itinerary-container">
                                <div class = "itinerary-title">
                                    <div class="itinerary-name"> Chasing waterfalls</div> <div class="itinerary-cost"> Estimated cost GHS 600</div>
                                </div>
                                <div class = "itinerary-details">
                                    <div> Created by <span style= "color: orange;">Kweku Acquaye</span></div> 
                                </div>
                                <div class = "itinerary-highlights">
                                    <div class = "itinerary-highlight-item"> Paintball</div> 
                                    <div class = "itinerary-highlight-item"> Darts</div>
                                    <div class = "itinerary-highlight-item"> Shopping</div>
                                    <div class = "itinerary-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                        </div>
                        <div class = "itinerary-item">
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class="itinerary-container">
                                <div class = "itinerary-title">
                                    <div class="itinerary-name"> Chasing waterfalls</div> <div class="itinerary-cost"> Estimated cost GHS 600</div>
                                </div>
                                <div class = "itinerary-details">
                                    <div> Created by <span style= "color: orange;">Kweku Acquaye</span></div> 
                                </div>
                                <div class = "itinerary-highlights">
                                    <div class = "itinerary-highlight-item"> Paintball</div> 
                                    <div class = "itinerary-highlight-item"> Darts</div>
                                    <div class = "itinerary-highlight-item"> Shopping</div>
                                    <div class = "itinerary-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                        </div>
                        <div class = "itinerary-item">
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class="itinerary-container">
                                <div class = "itinerary-title">
                                    <div class="itinerary-name"> Chasing waterfalls</div> <div class="itinerary-cost"> Estimated cost GHS 600</div>
                                </div>
                                <div class = "itinerary-details">
                                    <div> Created by <span style= "color: orange;">Kweku Acquaye</span></div> 
                                </div>
                                <div class = "itinerary-highlights">
                                    <div class = "itinerary-highlight-item"> Paintball</div> 
                                    <div class = "itinerary-highlight-item"> Darts</div>
                                    <div class = "itinerary-highlight-item"> Shopping</div>
                                    <div class = "itinerary-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                        </div>
                        <div class = "itinerary-item">
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class="itinerary-container">
                                <div class = "itinerary-title">
                                    <div class="itinerary-name"> Chasing waterfalls</div> <div class="itinerary-cost"> Estimated cost GHS 600</div>
                                </div>
                                <div class = "itinerary-details">
                                    <div> Created by <span style= "color: orange;">Kweku Acquaye</span></div> 
                                </div>
                                <div class = "itinerary-highlights">
                                    <div class = "itinerary-highlight-item"> Paintball</div> 
                                    <div class = "itinerary-highlight-item"> Darts</div>
                                    <div class = "itinerary-highlight-item"> Shopping</div>
                                    <div class = "itinerary-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div style = "display: flex;" class = "form-button-container">
                          <div class="form-button" onclick = "prevFormQuestion(6)">previous</div>
                          <div class="form-button" onclick = "goto_page('trip_summary.php', false)">Continue</div>
                    </div>
            </div>
        </div>
    </div>
    
</body>

<script>
    var previouslySelected = null;
    var responses = {};
    var nameIdPair = {};
    var showHome = true

    function processMultiSelection(event) {
        const clickedElement = event.target;
        var parentDiv = clickedElement.parentElement
        
        if(responses[parentDiv.getAttribute('name')]){
            if (responses[parentDiv.getAttribute('name')].includes(clickedElement.getAttribute('value'))){
                const index = responses[parentDiv.getAttribute('name')].indexOf(5);
                responses[parentDiv.getAttribute('name')].splice(index, 1);
                clickedElement.classList.remove("selected");
            } else{
                responses[parentDiv.getAttribute('name')].push(clickedElement.getAttribute('value'));
                nameIdPair[clickedElement.getAttribute('value')] = clickedElement.id;
                clickedElement.classList.add("selected");
            }   
        } else {
            responses[parentDiv.getAttribute('name')] = [clickedElement.getAttribute('value')];
            clickedElement.classList.add("selected");
        }
        console.log(JSON.stringify(responses, null, 4));
    }

    function processSelection(event) {
        // Get the clicked element from the event object
        const clickedElement = event.target;
        var parentDiv = clickedElement.parentElement
        clickedElement.classList.add("selected");
        
        if(previouslySelected){
            document.getElementById(previouslySelected).classList.remove("selected")
        }
        // Get the ID of the clicked element
        previouslySelected = clickedElement.id;

        // this is to add the selected option to responses 
        
        responses[parentDiv.getAttribute('name')] = clickedElement.getAttribute('value');
        // console.log(JSON.stringify(responses, null, 4));

    }
    function displayWarning() {
        // Get the warning message element
        var warningMessage = document.getElementById("warningMessage");

        // Display the warning message
        warningMessage.classList.remove("hidden");

        // Hide the warning message after 3 seconds
        setTimeout(function() {
            warningMessage.classList.add("hidden");
        }, 3000);
    }

    // The next two functions are to handling input going forward
    async function nextFormQuestion(id){
        document.getElementById("warningMessage").classList.add("hidden");
        var container_id = "content-container-" + id
        var form_id = "trip-form-" + id
        var element = document.getElementById(container_id);
        var formElement = document.getElementById(form_id);
        if (!responses[formElement.getAttribute('name')]){
            displayWarning()
            return;
        }
        element.classList.add("slide-left-and-vanish");
        element.classList.add("inactive");
        element.classList.remove("slide-left-and-vanish");
        id = id + 1;
        nextFormSub(id);
    }
    async function nextFormSub(id = 2){
        console.log("slide 2 start")
        console.log(id)
        var container_id = "content-container-" + id
        var element = document.getElementById(container_id);
        element.classList.remove("inactive")
        element.classList.add("slide-right-to-left-and-appear");
        setTimeout(function() {
            element.classList.remove("slide-right-to-left-and-appear");
        }, 600);        
    }



    async function prevFormQuestion(id){
        var drid = "content-container-" + id
        var element = document.getElementById(drid);
        element.classList.add("slide-right-to-left-and-disappear");
        element.classList.add("inactive");
        setTimeout(function() {
            element.classList.remove("slide-right-to-left-and-disappear");
        }, 600);
        id = id - 1
        prevFormSub(id);
    }

    async function prevFormSub(id = 1){
        var drid = "content-container-" + id;
        var element = document.getElementById(drid);
        element.classList.remove("inactive")
        element.classList.add("slide-right-and-appear");
        setTimeout(function() {
            element.classList.remove("slide-right-and-appear");
        }, 500);
    }
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