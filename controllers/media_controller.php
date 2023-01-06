<?php
	require_once(__DIR__. "/../classes/media_class.php");


	function get_media_by_id($id){
		$media = new media_class();
		return $media->get_media_by_id($id);
	}

	function upload_user_media_ctrl($media_id, $user_id,$location, $media_type = "picture" ){
		$media = new media_class();

		return $media->add_media_cls($media_id,$location, $media_type)
		&& _link_user_upload_ctrl($user_id,$media_id);
	}

	function link_curator_id($user_id, $front_id, $back_id){
		$media = new media_class();
		return $media->link_curator_id($user_id, $front_id,$back_id);
	}

	function update_curator_logo($curator_id,$media_id){
		$media = new media_class();
		return $media->update_curator_logo($curator_id,$media_id);
	}

	function update_profile_image($curator_id,$media_id){
		$media = new media_class();
		return $media->update_profile_image($curator_id,$media_id);
	}

	function upload_curator_media_ctrl($media_id, $curator_id,$location, $media_type = "picture"){
		$media = new media_class();

		return $media->add_media_cls($media_id,$location, $media_type)
		// && $media->link_media_cls($curator_id,$media_id,"curator_uploads","curator_id");
		&& _link_curator_upload_ctrl($curator_id,$media_id);
	}


	function upload_campaign_media_ctrl($media_id, $campaign_id,$location, $media_type = "picture"){
		$media = new media_class();

		return $media->add_media_cls($media_id,$location, $media_type)
		&& link_campaign_media_ctrl($campaign_id,$media_id);
	}


	function link_campaign_media_ctrl($campaign_id,$media_id){
		$media = new media_class();
		return $media->link_media_cls($campaign_id,$media_id,"campaign_media","campaign_id");
	}


	function unlink_campaign_media_ctrl($campaign_id, $media_id){
		$media = new media_class();
		return $media->unlink_media_cls("campaign_id","campaign_media",$campaign_id,$media_id);
	}





















//hidden helper methods
	function _link_user_upload_ctrl($user_id,$media_id){
		$media = new media_class();
		return $media->link_media_cls($user_id,$media_id,"user_uploads","user_id");
	}

	function _link_curator_upload_ctrl($curator_id,$media_id){
		$media = new media_class();
		return $media->link_media_cls($curator_id,$media_id,"curator_uploads","curator_id");
	}





?>