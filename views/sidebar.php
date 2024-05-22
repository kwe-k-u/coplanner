<?php
// Array of sidebar links
$links = array(
    "Home" => array(
        "link" => "newhome",
        "icon" => "<span class=\"material-symbols-outlined\">
        home
        </span>"
    ),
    "My trips" => array(
        "link" => "mytrips",
        "icon" => "<span class=\"material-symbols-outlined\">
        trip
        </span>"
    ),
    "Explore destinations" => array(
        "link" => "#",
        "icon" => "<span class=\"material-symbols-outlined\">
        location_on
        </span>"
    ),
    "Wishlist" => array(
        "link" => "#",
        "icon" => "<span class=\"material-symbols-outlined\">
        bookmark
        </span>"
    ),
    "Transaction" => array(
        "link" => "#",
        "icon" => "    <span class=\"material-symbols-outlined\">
        account_balance_wallet
        </span> "
    ),
    "Help and support" => array(
        "link" => "helpPage",
        "icon" => "<span class=\"material-symbols-outlined\">
        help
        </span>"
    ),
    "Settings" => array(
        "link" => "#",
        "icon" => "<span class=\"material-symbols-outlined\">
        settings
        </span>"
    )
);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="sidebar.css">
<style>

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

        <div class="sidebar-button" onclick = "goto_page('tripform.php', false)">
            New trip +
        </div>
    </div>

    <div class="link-block">
        <?php
        // Loop through the links array to generate sidebar items
        foreach ($links as $title => $details) {
            echo "
            <div class='sidebar-item' onclick = 'goto_page(\"" . $details['link'] . ".php\", false)'>
                <div class = 'sidebar-line'>
                    <div class= 'sidebar-item-img'>

                        " . $details['icon']  ."
                    </div>
                    <div class= 'sidebar-item-title'> $title </div>
                </div>

            </div>
            ";
        }
        ?>
    </div>
</div>
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
