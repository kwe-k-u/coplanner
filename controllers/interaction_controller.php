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


	function get_campaign_trips($campaign_id){
		$inte = new interaction_class();
		return $inte->get_campaign_trips($campaign_id);
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
