<?php
	require_once(__DIR__."/core.php");
	require_once(__DIR__."/../vendor/autoload.php");

	class mixpanel_class{
		private $panel = null;
		private $report_to_server;
		private $cookie_name;
		private $distinct_id;

		function __construct(){
			$this->cookie_name = "mixpanel_anon_id";
			$this->panel = Mixpanel::getInstance(
				mixpanel_token(),
				array(
					"host"=> "api.mixpanel.com",
					"debug"=> !is_env_remote()
				)
			);

			$this->report_to_server = true;
			if(is_session_logged_in()){
					$this->panel->identify(get_session_user_id());
					$this->distinct_id = get_session_user_id();
			}else{
				if(!isset($_COOKIE[$this->cookie_name])){
					$cookie_value = generate_id();
					setcookie(
						$this->cookie_name,
						$cookie_value,
						time() + (90 * 24 * 60 * 60), "/"
					);
				}else{
					$cookie_value = $_COOKIE[$this->cookie_name];
				}
				$this->panel->identify($cookie_value);
				$this->distinct_id = $cookie_value;
			}


		}

		function get_distinct_id(){
			return $this->distinct_id;
		}


		function log_event_signup($user_id,$email){
			if(!$this->report_to_server){
				return false;
			}
			// $this->panel->identify($user_id);
			$this->panel->createAlias($_COOKIE[$this->cookie_name],$user_id);
			$this->panel->people->setOnce($user_id,
				array(
					"email" => $email
				)
			);
			$this->panel->identify($user_id);
		}

		function log_event_login($user_id, $method){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->createAlias($_COOKIE[$this->cookie_name],$user_id);
			$this->panel->track("User login", array("method"=> $method));
		}

		function log_itinerary_creation(){
			if(!$this->report_to_server){
				return false;
			}

		}

		function log_shared_experience_creation($curator_id,$experience_id){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->track("Shared Experience Creation", array("curator_id"=> $curator_id,"experience_id"=> $experience_id));
		}

		function log_itinerary_recommendation($preference_id){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->track("Itinerary Recommendation", array("preference_id" => $preference_id));
		}

		function log_shared_experience_view($experience_id,$experience_name){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->track("Shared Experience viewed", array("experience_id"=> $experience_id,"experience_name"=> $experience_name));
			$this->panel->people->increment(get_session_user_id(),"Shared Experience view count",1);
		}

		function log_itinerary_views($itinerary_id,$itinerary_name,){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->track("Itinerary Viewed", array(
				"Itinerary ID"=> $itinerary_id,
				"Itinerary Name"=>$itinerary_name
			));
			$this->panel->people->increment(get_session_user_id(),"Itinerary view count",1);
		}

		function log_user_login($user_id){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->people->increment($user_id,"login count",1);
		}


		function log_itinerary_booking($user_id,$itinerary_id,$fee){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->people->increment($user_id,"Itinerary Booking count",1);
			$this->panel->track("Itinerary Booking", array("itinerary_id"=>$itinerary_id, "user_id"=> $user_id));
			$this->panel->people->trackCharge($user_id,$fee);
		}

		function log_experience_booking($user_id,$experience_id,$fee){
			if(!$this->report_to_server){
				return false;
			}
			$this->panel->people->increment($user_id,"Shared Experience Booking count",1);
			$this->panel->track("Shared Experience Booking", array("experience_id"=> $experience_id,"user_id"=> $user_id));
			$this->panel->people->trackCharge($user_id,$fee);
		}

		function log_curator_signup(){
			if(!$this->report_to_server){
				return false;
			}
			//TODO:: Create a curator identity
			$this->panel->track("Partner Signup", array("Partner Type" => "Curator","Curator"));
		}




		// This funnel tracks page view statistics across the platform
		// Tracked data
		// 	- Current page
		// 	- Previous page
		// 	- Referral source (referral_name)
		// 	- Viewing user (if logged in)
		// 	- Source (Campaign, social media, ads,)
		function log_page_view($pagename = null){
			if(!$this->report_to_server){
				return false;
			}
			$current_page = $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
			$data = array("current_page" => $current_page);
			//If a previous page brought us to the current one, track it too
			if(isset($_SERVER['HTTP_REFERER'])) {
				$previous = $_SERVER['HTTP_REFERER'];
				$data["previous_page"] = $previous;
			}

			//Track the source of our referral
			if(isset($_GET["referred_by"])){
				$data["referred_by"] = $_GET["referred_by"];
			}

			// Track the user who viewed the page
			if(is_session_logged_in()){
				$data["viewing_user"] = get_session_user_id();
			}

			if(isset($_GET["campaign"])){
				$data["campaign"] = $_GET["campaign"];
			}

			if(isset($_GET["channel"])){
				$data["channel"] = $_GET["channel"];
			}

			if($pagename){
				$data["page_name"] = $pagename;
			}

			$this->panel->track("Page View", $data);
		}





	}

?>