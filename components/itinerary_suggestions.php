<?php
    require_once(__DIR__."/../controllers/public_controller.php");

?>
<section class="container px-4 my-5 py-5">
                <h2 class="mb-4">View other itineraries created by other people</h2>
                <nav>
                    <div class="nav nav-tabs easygo-nav-tabs-alt justify-content-center" id="nav-tab" role="tablist">
                        <!-- <button class="nav-link active" id="popular-selections-tab" data-bs-toggle="tab" data-bs-target="#nav-popular-selections" type="button" role="tab" aria-controls="nav-popular-selections" aria-selected="true">Popular Selections</button> -->
                        <button class="nav-link active" id="editors-pick-tab" data-bs-toggle="tab" data-bs-target="#nav-editors-pick" type="button" role="tab" aria-controls="nav-editors-pick" aria-selected="false">Editor's Pick</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <!-- <div class="tab-pane fade show active" id="nav-popular-selections" role="tabpanel" aria-labelledby="popular-selections-tab">
                        <div class="itinerary-cards-container easygo-scroll-bar scroll-h">
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                            <div class="itinerary-card">
                                <p class="itinerary-card-top-note">Pay to view</p>
                                <div class="itinerary-card-body">
                                    <div class="price-and-people">
                                        <div>
                                            GHC 500 <br>
                                            Single day
                                        </div>
                                        <div>
                                            3-5 People <br>
                                            Single day
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="easygo-fw-1">Shared Itineries</h6>
                                        <p class="itinerary-desc">
                                            An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
                                        </p>
                                    </div>
                                    <div class="itinerary-activities">
                                        <div class="activity">Hike</div>
                                        <div class="activity">Hike</div>
                                        <div class="text-gray-1 d-flex align-items-center">+3 more</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class='tab-pane fade show active' id='nav-editors-pick' role='tabpanel' aria-labelledby='editors-pick-tab'>
                        <div class='itinerary-cards-container easygo-scroll-bar scroll-h'>
                    <?php
                    $itineraries = get_featured_itineraries();
                    // $itineraries = array_slice(get_featured_itineraries(),0,3);
                    foreach ($itineraries as $entry) {
                        $itinerary_name = $entry["itinerary_name"];
                        $budget = $entry["budget"];
                        $itinerary_id = $entry["itinerary_id"];
                        $owner_name = $entry["owner_name"];
                        $num_days = $entry["num_days"];
                        $num_participants = $entry["num_of_participants"];
                        $num_destinations = $entry["num_destinations"];
                        $day = $entry["first_day"];
                        $activity_text = "";
                        $activities = get_itinerary_activities($itinerary_id);
                        $added = array();
                        for($i = 0; $i <sizeof($activities); $i++){
                            $act_name = trim($activities[$i]["activity_name"]);
                            if(sizeof($added)==3){
                                $remaining = sizeof($activities) - $i;
                                if($remaining > 0){
                                    $activity_text .= "<div class='text-gray-1 d-flex align-items-center'>+$remaining more</div>
                                    ";
                                }
                                break;
                            }
                            if(!array_search($act_name,$added)){
                                array_push($added,$act_name);
                                $activity_text .= "
                                <div class='activity'>$act_name</div>";
                            }
                        }

							$suggested_image = suggest_image();
							$suggested_image = server_base_url()."assets/images/suggestions/$suggested_image";

                        echo "
                                <div class='itinerary-card'  onclick='goto_page(\"coplanner/itinerary_view.php?id=$itinerary_id\")'>

										<img src='$suggested_image' class='itinerary-img '>
                                    <div class='itinerary-card-body'>
                                        <div class='price-and-people'>
                                            <div>
                                                Creator: <strong style='color: black;'>$owner_name</strong> <br>
                                            </div>
                                            <div>
                                                GHS $budget <br>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class='easygo-fw-1'>$itinerary_name</h6>
                                            <p class='itinerary-desc'>
                                                An AI generated description of the itinerary that someone has created talking about the type of itinerary and teh activities
                                            </p>
                                        </div>
                                        <div class='itinerary-activities'>
                                            $activity_text

                                        </div>
                                    </div>
                                </div>
                                ";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </section>