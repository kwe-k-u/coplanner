<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>
<link rel="stylesheet" href="trip_summary.css">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="top_bar.css">
<link rel="stylesheet" href="../assets/css/general.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


<body class="bg-gray-3">

            <!-- topbar -->
            <!-- <div class="top-bar">
                <div onclick="toggleSidebar(true)" class="burger-button"><i class="fa-solid fa-bars fa-lg"></i></div>
                <div class="user-menu">
                    <div class="notifs">
                        <i class="fa-regular fa-bell fa-lg"></i>
                    </div>
                    <div class="profile-details">
                        <div class="profile-name">
                            Kwame Irene
                        </div>
                        <div class="profile-picture">
                            <img src='../assets/images/others/user_profile.png' alt='easy go logo'>
                        </div>
                    </div>
                </div>
            </div> -->

    <div class="body-container">

        <div class="right-body-container">



            <!-- Top bar [end ] -->


            <div class="content-container">
                <div class="summary-content">
                    <div class="left-summary">
                        <div class="bill-header">
                            <p>Bill</p>
                            <div class="info-card">Pending</div>
                        </div>
                        <div class="itinerary-image  d-sm-block d-lg-none mb-4"><img src="../assets/images/site_images/d-lab-expo.jpg" /> </div>
                        <div class="invoice-main">
                            <div class="invoice-container">
                                <div class="invoice-id"> Invoice: <span>hfsbdobspdobdsubsdbdsups </div>

                                    <div class="invoice-dest">
                                        <div class="invoice-date"> June 16th, 2023 - June 20th, 2024 </div>
                                        <div class="invoice-dets">
                                            <p> Activities </p>
                                            <div>
                                                <div><span>4</span> destination</div>
                                                <div>GHS <span>950</span></div>
                                            </div>
                                        </div>
                                </div>
                                <div class="invoice-tax">
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
                        <div class="d-flex gap-4 payment-btn-section">
                            <a class="btn easygo-btn-1">Make Payment</a>
                            <a class="btn easygo-btn-6">Pay Later</a>
                        </div>
                    </div>
                    <div class="right-summary">


                        <div class="right-summary-title">
                            <h2>Accra Mall</h2>
                            <small>by easyGo Tours</small>
                            <div class="summary-by">
                                By EasyGo Tours
                            </div>
                        </div>
                        <div class="itinerary-image d-none d-lg-block d-md-block"><img src="../assets/images/site_images/d-lab-expo.jpg" /> </div>
                        <div class="itin-summary-title">
                            Selected Activities
                        </div>
                        <div class="right-summary-main">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                            passages, and more recently with desktop publishing software like Aldus PageMaker including
                            versions of Lorem Ipsum.
                        </div>

                    </div>
                </div>
                <div class="summary-itinerary-section">
                    <div class="summary-itinerary-day">
                        <div class="summary-itinerary-title"> Day 1 </div>
                        <div class="summary-itinerary-row">
                            <div class="summary-itinerary-location">
                                <div class="summary-itin-title"> Destination 1 </div>
                                <div class="summary-itin-name"> Accra Mall </div>
                                <div class="summary-itin-specloc"> Accra </div>
                                <div class="summary-itin-highlights">
                                    <div class="activity-span"> Paintball</div>
                                    <div class="activity-span"> Darts</div>
                                    <div class="activity-span"> Changed</div>
                                    <div class="summary-itin-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                            <div class="summary-itinerary-location">
                                <div class="summary-itin-title"> Destination 1 </div>
                                <div class="summary-itin-name"> Accra Mall </div>
                                <div class="summary-itin-specloc"> Accra </div>
                                <div class="summary-itin-highlights">
                                    <div class="activity-span"> Paintball</div>
                                    <div class="activity-span"> Darts</div>
                                    <div class="activity-span"> Shopping</div>
                                    <div class="summary-itin-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                            <div class="summary-itinerary-location">
                                <div class="summary-itin-title"> Destination 1 </div>
                                <div class="summary-itin-name"> Accra Mall </div>
                                <div class="summary-itin-specloc"> Accra </div>
                                <div class="summary-itin-highlights">
                                    <div class="activity-span"> Paintball</div>
                                    <div class="activity-span"> Darts</div>
                                    <div class="activity-span"> Shopping</div>
                                    <div class="activity-span"> Shopping</div>
                                    <div class="activity-span"> Shopping</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="summary-itinerary-day">
                        <div class="summary-itinerary-title"> Day 2 </div>
                        <div class="summary-itinerary-row">
                            <div class="summary-itinerary-location">
                                <div class="summary-itin-title"> Destination 1 </div>
                                <div class="summary-itin-name"> Accra Mall </div>
                                <div class="summary-itin-specloc"> Accra </div>
                                <div class="summary-itin-highlights">
                                    <div class="activity-span"> Paintball</div>
                                    <div class="activity-span"> Darts</div>
                                    <div class="activity-span"> Shopping</div>
                                    <div class="summary-itin-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                            <div class="summary-itinerary-location">
                                <div class="summary-itin-title"> Destination 1 </div>
                                <div class="summary-itin-name"> Accra Mall </div>
                                <div class="summary-itin-specloc"> Accra </div>
                                <div class="summary-itin-highlights">
                                    <div class="activity-span"> Paintball</div>
                                    <div class="activity-span"> Darts</div>
                                    <div class="activity-span"> Shopping</div>
                                    <div class="summary-itin-highlight-more"> +<span>4</span> more</div>
                                </div>
                            </div>
                            <div class="summary-itinerary-location">
                                <div class="summary-itin-title"> Destination 1 </div>
                                <div class="summary-itin-name"> Accra Mall </div>
                                <div class="summary-itin-specloc"> Accra </div>
                                <div class="summary-itin-highlights">
                                    <div class="activity-span"> Paintball</div>
                                    <div class="activity-span"> Darts</div>
                                    <div class="activity-span"> Shopping</div>
                                    <div class="summary-itin-highlight-more"> +<span>4</span> more</div>
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