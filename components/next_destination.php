<?php
?>

<style>
   .destination-row{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        width: 100%;
        height: 100%;
        overflow: scroll;
    }
    .card-regular{
        margin: 0;
        width: 22.5%;
        height: 100%;
        place-content: center;
        background: white;
        border-radius: 1em;
        

    }
    .card-long{
        margin: 0;
        width: 45%;
        height: 100%;        
        place-content: center;
        background: white;
        border-radius: 1em;
    }
    .card-container{
        margin-left: auto;
        margin-right: auto;
        width: 90%;
        height: 90%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        
    }

    .card-content-long{
        margin: 0;
    }
    .card-title{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        color: #1931A8;
        font-weight: bold;
    }

    .destination-row .card-content{
        width: 80%;
        height: 60%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .destination-row .card-details{
        font-size: 2em;
        font-weight: bold;
    }

    .destination-row .card-footer{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .destination-row .card-footer-long{
        width: 50%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    @media screen and (min-width: 768px) {
        .card-content-long{
            margin: 0 !important;
        }
    }
    @media screen and (max-width: 768px) {
        .destination-row {
            display: inline-block;
            white-space: nowrap;
            width: 100%;
            overflow-x: auto; /* Enable horizontal scrolling */
            overflow-y: hidden; /* Hide vertical scrollbar */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none;  /* Internet Explorer 10+ */
        }

        .card-regular, .card-long {
            display: inline-block;
            margin: 0 8px; /* Add some spacing between cards */
            height: 100%; /* Adjusted to take full height */
            width: 80%;
            background: white;
            border-radius: 1em;
        }
        

        .card-container {
            width: 100%; /* Adjusted to take full width */
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .card-title {
            width: 80%;
            margin: 0 auto;
            font-weight: bold;
            font-size: 1.2em;
        }

        .card-details {
            font-size: 2em;
        }
        
        .card-content-long{
            margin-left: auto;
        }

        .destination-row .card-content {
            width: 80%;
            height: 60%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .destination-row .card-footer {
            width: 100%;
            margin: unset;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-size: 1.2em
        }

        .destination-row .card-footer-long {
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    }
</style>

<div class = "destination-row">
    <!--  -->
    <div class = "card-regular">
        <!-- Date details -->
        <div class = "card-container">
            <div class= "card-title"> Travel Date </div>
            <div class = "card-content">
                <div class = "card-details">
                    5 days
                </div>
                <div class = "card-footer"> 
                   <div> 01.09.2024 </div> <i class="fa-solid fa-right-left"></i> <div> 01.09.2024 </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "card-regular">
        <!-- Date details -->
        <div class = "card-container">
            <div class= "card-title"> Travel Date </div>
            <div class = "card-content">
                <div class = "card-details">
                    5 days
                </div>
                <div class = "card-footer"> 
                   <div> 01.09.2024 </div> <i class="fa-solid fa-right-left"></i> <div> 01.09.2024 </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "card-long">
        <!-- Date details -->
        <div class = "card-container ">
            <div class= "card-title card-content-long"> Travel Date </div>
            <div class = "card-content card-content-long">
                <div class = "card-details">
                    5 days
                </div>
                <div class = "card-footer-long"> 
                   <div> 01.09.2024 </div> <i class="fa-solid fa-right-left"></i> <div> 01.09.2024 </div>
                </div>
            </div>
        </div>
    </div>
</div>
