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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="tripform.css">
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
                            <div class = "trip-form-1"> Just a day</div>
                            <div class = "trip-form-1"> 2 or 3 days</div>
                            <div class = "trip-form-1"> 4 or 5 days</div>
                            <div class = "trip-form-1"> About a week</div>
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
                            <div class = "trip-form-1"> Solo</div>
                            <div class = "trip-form-1"> Couple</div>
                            <div class = "trip-form-1"> Family</div>
                            <div class = "trip-form-1"> friends</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "slide3(3)">previous</div>
                            <div class="form-button" onclick = "slide(3)">Continue</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class = "content-container inactive"  id = "content-container-4">
                <!-- main content here -->
                <div class = "welcome-section">
                    <!-- TODO: Maake name dynamic -->
                    <div class = "welcome-title"> Trip details </div>
                </div>
                <div class = "trip-form-main">
                    <div class = "trip-form-container">
                        <div class = "trip-form">
                            <div class = "trip-form-2"> Spa and Wellness</div>
                            <div class = "trip-form-2"> Adventure and sport</div>
                            <div class = "trip-form-2"> Landmark and sight seeing</div>
                            <div class = "trip-form-2"> Culture and history</div>
                            <div class = "trip-form-2"> Waterfalls</div>
                            <div class = "trip-form-2"> Alternative experience</div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "slide3(4)">previous</div>
                            <div class="form-button" onclick = "slide(4)">Continue</div>
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
                        <div class = "trip-form">
                            <div class = "trip-form-3"> GHS 0 - GHS 1000</div>
                            <div class = "trip-form-3"> GHS 1000 - GHS 4999</div>
                            <div class = "trip-form-3"> GHS 5000 and above </div>
                        </div>
                        <div style = "display: flex;">
                            <div class="form-button" onclick = "slide3(5)">previous</div>
                            <div class="form-button" onclick = "slide(5)">Continue</div>
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
                          <div class="form-button" onclick = "slide3(6)">previous</div>
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