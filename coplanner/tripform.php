<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__ . "/../controllers/public_controller.php");
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
        height: 7%;
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
        width: 70%;
    }
    .itinerary-highlight-item {
        color: white;
        background: blue;
        padding: 2px 3px;
        border-radius: 10px;
    }

    @media screen and (min-width: 768px) {
        .trans-cards{
            display: none
        }
    }

    @media screen and (max-width: 768px) {

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
        justify-content: space-between;
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
        display: none;
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

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<body>
    <div class = "body-container">
        <!-- sidebar -->
        
        <div class = "right-body-container">
            <!-- topbar -->
            <?php
            require_once(__DIR__."/topbar.php");
            ?>
            <div class = "content-container "  id = "content-container-1">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Trip details </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form">
                            <div class = "trip-form-1"> Greater Accra</div>
                            <div class = "trip-form-1"> Greater Accra</div>
                            <div class = "trip-form-1"> Greater Accra</div>
                            <div class = "trip-form-1"> Greater Accra</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "slide3(1)">previous</div>
                            <div class="form-button" onclick = "slide(1)">Continue</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "content-container inactive"  id = "content-container-2">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Trip details </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form">
                            <div class = "trip-form-1"> Greater Accra</div>
                            <div class = "trip-form-1"> Greater Accra</div>
                            <div class = "trip-form-1"> Greater Accra</div>
                            <div class = "trip-form-1"> Greater Accra</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "slide3(2)">previous</div>
                            <div class="form-button" onclick = "slide(2)">Continue</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class = "content-container inactive"  id = "content-container-3">
                <!-- main content here --> 
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Trip details </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form">
                            <div class = "trip-form-2"> Greater Accra</div>
                            <div class = "trip-form-2"> Greater Accra</div>
                            <div class = "trip-form-2"> Greater Accra</div>
                            <div class = "trip-form-2"> Greater Accra</div>
                            <div class = "trip-form-2"> Greater Accra</div>
                            <div class = "trip-form-2"> Greater Accra</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "slide3(3)">previous</div>
                            <div class="form-button" onclick = "slide(3)">Continue</div>
                        </div>
                    </div>
                    
                </div>  
            </div>
            <div class = "content-container-2 inactive"  id = "content-container-4">
                <!-- main content here -->
                <div class = "welcome-section"> 
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Trip details </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container-2">
                        <div class = "trip-form">
                            <div class = "trip-form-3"> Greater Accra</div>
                            <div class = "trip-form-3"> Greater Accra</div>
                            <div class = "trip-form-3"> Greater Accra</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "slide3(4)">previous</div>
                            <div class="form-button" onclick = "slide(4)">Continue</div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class = "content-container inactive"  id = "content-container-5">
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
                          <div class="form-button" onclick = "slide3(5)">previous</div>
                          <div class="form-button" onclick = "goto_page('trip_summary.php', false)">Continue</div>
                    </div>
            </div>
        </div>
    </div>
    
</body>

<script>
    function slide(id){
        console.log("slide 1 start")
        console.log(id)
        var drid = "content-container-" + id
        var element = document.getElementById(drid);
        
        element.classList.add("slide-left-and-vanish");
        element.classList.add("inactive");
        // element.classList.remove("slide-left-and-vanish");
        id = id + 1;
        console.log("slide 1 comp")
        slide2(id);
    }
    function slide2(id = 2){
        console.log("slide 2 start")
        console.log(id)
        var drid = "content-container-" + id
        var element = document.getElementById(drid);
        element.classList.remove("inactive")
        element.classList.add("slide-right-to-left-and-appear");
        
        console.log("slide 2 comp")
    }
    function slide3(id){
        var drid = "content-container-" + id
        var element = document.getElementById(drid);
        element.classList.add("slide-right-to-left-and-disappear");
        element.classList.add("inactive")
        id = id - 1
        slide4(id);
    }
    function slide4(id = 1){
        var drid = "content-container-" + id;
        var element = document.getElementById(drid);
        element.classList.remove("inactive")
        element.classList.add("slide-right-and-appear");
    }

    function toggleSidebar(show) {
        var sidebar = document.getElementById('sidebar');
        if (show) {
            sidebar.classList.remove('sidebar-hidden');
        } else {
            sidebar.classList.add('sidebar-hidden');
        }
    }
    function toggleDropdown(id) {
        var drid = "dropdown-content" + id
        var dropdownContent = document.getElementById(drid);
        dropdownContent.style.display === "none" ? dropdownContent.style.display = "block" : dropdownContent.style.display = "none";
    }

    function selectOption(option) {
        var selectedItem = document.querySelector(".selected-item");
        selectedItem.textContent = option;
        toggleDropdown();
    }
    document.addEventListener("click", function(event) {
        var dropdownContent = document.getElementById("dropdown-content");
        var targetElement = event.target;

        // if (!dropdownContent.contains(targetElement)) {
        //     dropdownContent.style.display = "none";
        // }
    });

</script>
</html>