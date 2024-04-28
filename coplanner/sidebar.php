<?php
// Array of sidebar links
$links = array(
    "Home" => array(
        "link" => "#",
        "icon" => "fa fa-house"
    ),
    "My trips" => array(
        "link" => "#",
        "icon" => "fa-solid fa-plane"
    ),
    "Explore destinations" => array(
        "link" => "#",
        "icon" => "fa-solid fa-location-dot"
    ),
    "Wishlist" => array(
        "link" => "#",
        "icon" => "fa-regular fa-bookmark"
    ),
    "Transaction" => array(
        "link" => "#",
        "icon" => "fa-solid fa-wallet"
    ),
    "Help and support" => array(
        "link" => "#",
        "icon" => "fa-solid fa-question"
    ),
    "Settings" => array(
        "link" => "#",
        "icon" => "fa-solid fa-gear"
    )
);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
/* Sidebar container */
    .sidebar {
        width: 22.5%; /* Set sidebar width */
        height: 100%; /* Set sidebar height to 100% of viewport height */
        /* background-color: #f2f2f2; Set background color */
        padding: 0; /* Remove padding */
        margin: 0; /* Remove margin */
        overflow-y: auto; /* Enable vertical scrolling if content exceeds viewport height */
        background: white;
    }
    .easy-logo {
        display: flex;
        justify-content: center;
        height: auto;
        width: 100%;
    }

    .side-bar-top{
        width: 100%;
        height: 20%;
        display: flex;
        flex-direction: column;
        margin: auto;
        align-items: center;
        justify-content: space-around;
    }

    /* Logo */
    .sidebar img {
        width: 50%; /* Set logo width */
    }

    /* New trip link */
    .sidebar-bar-other {
        margin-top: 2%; /* Add top margin */
        padding: 10px; /* Add padding */
    }

    /* Link block */
    .link-block {
        display: flex;
        flex-direction: column;
        place-items: center;
        height: 50%;
        justify-content: space-evenly;
    }

    /* Sidebar items */
    .sidebar-item {
        margin-bottom: 1%; /* Add bottom margin */
        align-items: center; /* Align items vertically */
        width: 70%;
        padding: 5%;
        justify-content: center;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


    .sidebar-item-title{
        margin-left: 5%;
        /* width: 50%; */
    }

    /* Sidebar items */
    .sidebar-line {    
        display: flex; /* Use flexbox for layout */
        width: 75%;
        color: inherit;
        align-items: center;
    }

    /* Sidebar item image */
    .sidebar-item-img {
        margin-right: 2%; /* Add right margin */
        color: #122276;
    }

    /* Sidebar item icon */
    .sidebar-item i {
        margin-right: 2%; /* Add right margin */
    }



    /* Sidebar item hover */
    .sidebar-item:hover {
        /* background-color: #ccc; /* Change background color on hover */
        /* background: #F1A93B; */ */
    }

    .sidebar-item:active{
        /* background-color: #ccc; Change background color on hover */
        background: #F1A93B;
        color: #122276;
        
    }

    .sidebar-button {
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
    .sidebar-button:hover {
        /* background-color: #45a049; */
    }

    /* Active state */
    .sidebar-button:active {
        background-color: #13257F;
    
    }
    .close-button {
        display: none;
        align-self: center;
    }

    /* Media query for small screens */
    @media screen and (max-width: 768px) {
        .sidebar {
            position: fixed; 
            width: 100%; 
            height: 100%; 
            top: 0; 
            left: 0; 
            z-index: 999; 
            overflow-y: auto; 
            transition: transform 0.3s ease-in-out;
            /* transform: translateX(-100%); */
            
        }

        .sidebar-hidden {
            transform: translateX(-100%) ;
        }
        .close-button {
            display: unset;
            font-size: xx-large;
            align-self: flex-end;
            margin-right: 1em;
        }
        .side-bar-top{
            height: 35%;
        }

        .sidebar-button { 
            font-size: x-large;
            
        }

        .sidebar-item-title { 
            font-size: x-large;
            margin-left: 5%;
            width: 80%;
        }

        .sidebar-line { 

            width: 90%;
        }
        
    
    /* .close-button {
        display: unset;
        position: absolute; /* Make close button absolute position */
        /* top: 10px; Position close button at the top */
        /* right: 10px; Position close button at the right */
        /* cursor: pointer; Change cursor to pointer on hover */
    /* }  */
    }

</style>
<div class="sidebar sidebar-hidden" id = "sidebar">
    <div class= "side-bar-top">
    <div  onclick = "toggleSidebar(false)" class="close-button" >&times;</div>
        <div class = "easy-logo">
            <?php
            echo "
            <img src='" .server_base_url()."assets/images/site_images/logo.png' alt='easy go logo'>
            "
            ?>   
        </div>
        
        <div class="sidebar-button">
            New trip +
        </div>
    </div>
    <div class="link-block">
        <?php
        // Loop through the links array to generate sidebar items
        foreach ($links as $title => $details) {
            echo "
            <div class='sidebar-item' onclick = '" . $details['link'] . "'>
                <div class = 'sidebar-line'>
                    <div class= 'sidebar-item-img'>
                    
                        <i class='" . $details['icon']  ."' ></i>
                    </div>
                    <div class= 'sidebar-item-title'> $title </div>
                </div>
                
            </div>
            ";
        }
        ?>
    </div>
</div>
