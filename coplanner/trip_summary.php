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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<style>
    body{
        margin: 0;
        height: 100vh;
        background: #f5f5f6ed;
        font-family: 'Nunito' !important;
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
        width: 100%;
        color: gray;
    }
    .summary-content {
        height: 90%;
        width: 85%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-around;
    }
    .summary-content .left-summary{
        height: 90%;
        width: 35%;
        display: flex;
        flex-direction: column;
        
    }
    .summary-content .right-summary{
        height: 90%;
        width: 60%;
        display: flex;
        flex-direction: column;
    }
    .right-summary-title {
        height: 15%;
        justify-content: space-around;
        display: flex;
        flex-direction: column;
    }
    .summary-title {
        font-size: x-large;
        margin-bottom: 0.25em;
    }
    .summary-by {
        font-size: large;
        color: blue;
        font-weight: bold;
        margin-bottom: 1em;
    }
    .right-summary-main {
        height: 30%;
        align-content: center;
        text-align: justify;
    }
    .itinerary-image {
        border-radius: 1em;
        overflow:hidden;
        width: fit-content;
    }
    .itinerary-image img {
        width: 40em;
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
        .summary-itinerary-section {
            width: 100%;
        }
        .summary-content {
            flex-direction: column;
        }
     
        .left-summary {
            width: 100% !important;
        }
        .right-summary {
            width: 100% !important;
            margin-top: 1.5em; 
        }
        .itinerary-image, .itinerary-image img {
            width: 100%;
        }

        .summary-itinerary-row{
            flex-direction: column;
        }
    }

    .summary-itinerary-day {
        display: flex;
        flex-direction: column;
        margin-top: 1em;
        border-bottom: 1px #b8b1b1 solid;
        padding-top: 2em;
        padding-bottom: 1em;
    }
    .itin-summary-title {
        font-size: x-large;
        margin: 1em 0;
    }

    .summary-itinerary-title {
        font-size: x-large;
        color: orange;
    }

    .summary-itinerary-day:last-child {
        margin-bottom: 2em;
    }
    .summary-itinerary-row {
        
        width: 100%;
        display: flex;
    }
    .summary-itinerary-row .summary-itinerary-location {
        width: 25em;
        height: 10em;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        /* border-right: 1px #b8b1b1 solid; */

    }

    .summary-itin-highlights {
        display: flex;
        justify-content: space-between;
        width: 85%;
    }

    .summary-itin-highlight-item {
        color: white;
        background: blue;
        padding: 2px 7px;
        border-radius: 10px;
    }

    .summary-itin-name {
        font-weight: bold;
        font-size: larger;
    }

    .invoice-main {
        border: 3px #9c9797 solid;
        border-radius: 10px
    }
    .invoice-container {
        width: 90%;
        margin-left:auto;
        margin-right:auto;
        padding-top: 2em;
    }
    .invoice-container > div{
        margin-top: 1em;
        border-bottom: 1px #b8b1b1 solid;

    }
    .invoice-container > div:first-child{
        margin-top: 0;
    }
    .invoice-container > div:last-child{
        padding-bottom: 1.5em;
        border-bottom:  none;
    }

    .invoice-id {
        font-weight: bold;
        font-size: larger;
        align-content: center;
        padding-bottom: 1.5em;

    }

    .invoice-id span {
        font-weight: lighter;
        font-size: large;
        color: #848484;
    }
    .invoice-date{
        color: blue;
        text-align-last: center;
    }
    .invoice-dets {
        height: 6em;
    }
    .invoice-dets>div {
        display: flex;
        justify-content: space-between;
    }

    .invoice-tax {
        display: flex;
        justify-content: space-between;
        height: 4em;
        padding-bottom: 1.5em;
    }

    .invoice-tax div:first-child {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .invoice-tax div:last-child {

        place-content: end;

    }
    .invoice-total{
        display: flex;
        justify-content: space-around;
        font-weight: bold;
        font-size: larger;
        color: blue;
    }
    .bill-header {
        font-size: x-large;
        margin-bottom: 1em;
        font-weight: bold;
    }
    .summary-itinerary-section{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<body>
    <div class = "body-container">

        <div class = "right-body-container">
            <!-- topbar -->
            <?php
            $showHome = true;
            require_once(__DIR__."/topbar.php");
            ?>
            <div class = "content-container">
                <!-- main content here -->
                    <!-- <div class = "welcome-section">
                        TODO: Maake name dynamic
                        <div class = "welcome-title"> Welcome back, Irene </div>
                    </div> -->
                    <div class = "summary-content">
                        <div class = "left-summary">
                            <div class = "bill-header">Bill</div>
                            <div class = "invoice-main">
                                <div class = "invoice-container">
                                    <div class="invoice-id"> Invoice:   <span>hfsbdobspdobdsubsdbdsups </div>
                                    
                                    <div class = "invoice-dest">
                                        <div class="invoice-date"> June 16th, 2023 - June 20th, 2024 </div>
                                        <div class = "invoice-dets">
                                            <p> Activities </p>
                                            <div> <div><span>4</span> destination</div><div>GHS <span>950</span></div></div>
                                        </div>
                                    </div>
                                    <div class = "invoice-tax">
                                        <div>
                                            <div>15% VAT</div> 
                                            <div>1% tourism levy</div>
                                        </div>
                                        <div>GHS <span>950</span></div> 
                                    </div>
                                    <div class="invoice-total">
                                            <div>TOTAL</div> 
                                            <div> GHS 900</div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class = "right-summary">
                            <div class = "right-summary-title">
                                <div class = "summary-title">
                                    Accra Mall
                                </div>
                                <div class = "summary-by">
                                    By EasyGo Tours
                                </div>
                            </div>
                            <div class = "itinerary-image"><img src =  "../assets/images/site_images/d-lab-expo.jpg" /> </div>
                            <div class = "itin-summary-title">
                                    Selected Activities
                            </div>
                            <div class = "right-summary-main">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            
                        </div>
                    </div>
                    <div class = "summary-itinerary-section">
                                <div class = "summary-itinerary-day">
                                <div class = "summary-itinerary-title"> Day 1 </div>
                                    <div class = "summary-itinerary-row">
                                        <div class = "summary-itinerary-location">
                                            <div class = "summary-itin-title"> Destination 1 </div>
                                            <div class ="summary-itin-name"> Accra Mall </div>
                                            <div class ="summary-itin-specloc"> Accra </div>
                                            <div class = "summary-itin-highlights">
                                                <div class = "summary-itin-highlight-item"> Paintball</div> 
                                                <div class = "summary-itin-highlight-item"> Darts</div>
                                                <div class = "summary-itin-highlight-item"> Shopping</div>
                                                <div class = "summary-itin-highlight-more"> +<span>4</span> more</div>
                                            </div>
                                        </div>
                                        <div class = "summary-itinerary-location">
                                            <div class = "summary-itin-title"> Destination 1 </div>
                                            <div class ="summary-itin-name"> Accra Mall </div>
                                            <div class ="summary-itin-specloc"> Accra </div>
                                            <div class = "summary-itin-highlights">
                                                <div class = "summary-itin-highlight-item"> Paintball</div> 
                                                <div class = "summary-itin-highlight-item"> Darts</div>
                                                <div class = "summary-itin-highlight-item"> Shopping</div>
                                                <div class = "summary-itin-highlight-more"> +<span>4</span> more</div>
                                            </div>
                                        </div>
                                        <div class = "summary-itinerary-location">
                                            <div class = "summary-itin-title"> Destination 1 </div>
                                            <div class ="summary-itin-name"> Accra Mall </div>
                                            <div class ="summary-itin-specloc"> Accra </div>
                                            <div class = "summary-itin-highlights">
                                                <div class = "summary-itin-highlight-item"> Paintball</div> 
                                                <div class = "summary-itin-highlight-item"> Darts</div>
                                                <div class = "summary-itin-highlight-item"> Shopping</div>
                                                <div class = "summary-itin-highlight-more"> +<span>4</span> more</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "summary-itinerary-day">
                                <div class = "summary-itinerary-title"> Day 2 </div>
                                    <div class = "summary-itinerary-row">
                                        <div class = "summary-itinerary-location">
                                            <div class = "summary-itin-title"> Destination 1 </div>
                                            <div class ="summary-itin-name"> Accra Mall </div>
                                            <div class ="summary-itin-specloc"> Accra </div>
                                            <div class = "summary-itin-highlights">
                                                <div class = "summary-itin-highlight-item"> Paintball</div> 
                                                <div class = "summary-itin-highlight-item"> Darts</div>
                                                <div class = "summary-itin-highlight-item"> Shopping</div>
                                                <div class = "summary-itin-highlight-more"> +<span>4</span> more</div>
                                            </div>
                                        </div>
                                        <div class = "summary-itinerary-location">
                                            <div class = "summary-itin-title"> Destination 1 </div>
                                            <div class ="summary-itin-name"> Accra Mall </div>
                                            <div class ="summary-itin-specloc"> Accra </div>
                                            <div class = "summary-itin-highlights">
                                                <div class = "summary-itin-highlight-item"> Paintball</div> 
                                                <div class = "summary-itin-highlight-item"> Darts</div>
                                                <div class = "summary-itin-highlight-item"> Shopping</div>
                                                <div class = "summary-itin-highlight-more"> +<span>4</span> more</div>
                                            </div>
                                        </div>
                                        <div class = "summary-itinerary-location">
                                            <div class = "summary-itin-title"> Destination 1 </div>
                                            <div class ="summary-itin-name"> Accra Mall </div>
                                            <div class ="summary-itin-specloc"> Accra </div>
                                            <div class = "summary-itin-highlights">
                                                <div class = "summary-itin-highlight-item"> Paintball</div> 
                                                <div class = "summary-itin-highlight-item"> Darts</div>
                                                <div class = "summary-itin-highlight-item"> Shopping</div>
                                                <div class = "summary-itin-highlight-more"> +<span>4</span> more</div>
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
</script>
</html>