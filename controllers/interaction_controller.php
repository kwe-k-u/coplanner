<?php
	require_once(__DIR__."/../classes/interaction_class.php");


	function get_all_curators(){
		$interaction = new interaction_class();
		return $interaction->get_all_curators();
	}

	function get_all_campaigns(){
		$inte = new interaction_class();
		return $inte->get_all_campaigns();
	}

	function get_curator_name($curator_id){
		$inte = new interaction_class();
		return $inte->get_curator_name($curator_id)["curator_name"];
	}

	function get_private_trip_quotes($request_id){
		$inte = new interaction_class();
		return $inte->get_private_trip_quotes($request_id);
	}

	function get_username_by_id($id){
		$inte = new interaction_class();
		return $inte->get_user_name_by_id($id)["user_name"];
	}

	function get_user_wishlist($user_id){
		$inte = new interaction_class();
		return $inte->get_user_wishlist($user_id);
	}

	function get_current_campaigns($query = null){
		$inte = new interaction_class();
		return $inte->get_current_campaigns($query = null);
	}

	function get_past_campaigns(){
		$inte = new interaction_class();
		return $inte->get_past_campaigns();
	}

	function get_user_booking_history($user_id){
		$inte = new interaction_class();
		return $inte->get_user_booking_history($user_id);
	}


	function get_campaign_by_id($id){
		$inte = new interaction_class();
		return $inte->get_campaign_by_id($id);
	}

	function get_toursite_by_campaign($id){
		$inte = new interaction_class();
		return $inte->get_toursite_by_campaign($id);
	}

	function get_campaign_activities($id){
		$inte = new interaction_class();
		return $inte->get_campaign_activities($id);
	}


	function get_user_profile_img($id){
		$inte = new interaction_class();
		return $inte->get_user_profile_img($id)["media_location"] ?? get_default_profile_img();
	}


	function get_campaign_trips($campaign_id){
		$inte = new interaction_class();
		return $inte->get_campaign_trips($campaign_id);
	}

	function get_campaign_next_trip($id){
		$inte = new interaction_class();
		return $inte->get_campaign_next_trip($id);
	}


	function is_user_following_curator($user_id, $curator_id){
		$inte = new interaction_class();
		$res = $inte->is_user_following_curator($user_id,$curator_id);
		if($res){
			return true;
		}else {
			return false;
		}
	}

	function add_campaign_wishlist($user_id,$campaign_id){
		$inte = new interaction_class();
		return $inte->add_campaign_wishlist($user_id,$campaign_id);
	}


	function is_campaign_wishlisted($user_id, $campaign_id){
		$inte = new interaction_class();
		$res = $inte->is_campaign_wishlisted($user_id,$campaign_id);
		if($res){
			return true;
		}else {
			return false;
		}
	}

	function follow_curator($user_id, $curator_id){
		$inte = new interaction_class();
		return $inte->follow_curator($user_id,$curator_id);
	}


	function unfollow_curator($user_id, $curator_id){
		$inte = new interaction_class();
		return $inte->unfollow_curator($user_id,$curator_id);
	}

	function remove_campaign_wishlist($user_id,$curator_id){
		$inte = new interaction_class();
		return $inte->remove_campaign_wishlist($user_id,$curator_id);
	}
?>
