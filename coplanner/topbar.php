<?php
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
    .top-bar{
        height: 10%;
        width: 100%;
        display: flex;
        justify-content: end;
        background: transparent;
    }

    .user-menu{
        height: 100%;
        width: 20%;
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center;
    }

    .notifs{

    }

    .notifs i {

    }

    .profile-details{
        width: 80%;
        height: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .profile-picture {
        width: 25%; /* Adjust as needed */
        height: auto; /* Adjust as needed */
        border-radius: 100%; /* Makes it a circle */
        overflow: hidden; /* Ensures the image doesn't overflow the container */
        border: 0px solid #fff; /* White border around the image */
        /* box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); Optional: adds a subtle shadow */
    
    }

    /* Style for the image */
    .profile-picture img {
        width: 100%; /* Ensures the image fills the container */
        height: auto; /* Maintains aspect ratio */
        border-radius: 100%;
    }

    .burger-button {
        display: none;
        align-self: center;
    }

    @media screen and (max-width: 768px) {
        .user-menu{
            width: 50%;
        }
        .burger-button {
            display: unset;
            align-self: center;
            margin-left: 1em;
        }
        .top-bar {
            justify-content: space-between;
            height: 4em;
        }
    }

</style>

<div class="top-bar">
    <?php
        if (isset($showHome) && $showHome){
            echo "<div   onclick = 'goto_page(\"" . 'newhome' . ".php\", false)' class='burger-button' ><span class='material-symbols-outlined'>home</span></div>";
        } else {
            echo "<div  onclick = 'toggleSidebar(true)' class='burger-button' ><i class='fa-solid fa-bars fa-lg'></i></div>";
        }
    ?>
    <div class="user-menu">
        <div class="notifs">
            <i class="fa-regular fa-bell fa-lg"></i>
        </div>
        <div class="profile-details">
            <div class="profile-name">
                Kwame Irene
            </div>
            <div class="profile-picture">
                <?php
                    echo "
                    <img src='" .server_base_url()."assets/images/others/user_profile.png' alt='easy go logo'>
                    "
                    ?>  
            </div>
        </div>
    </div>
</div>