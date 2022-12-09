<?php
	require_once(__DIR__."/../utils/db_class.php");
	require_once(__DIR__."/../utils/core.php");

	class interaction_class extends db_connection{



		//======================================= SELECT ====================================
		function get_all_curators(){
			$sql = "SELECT * FROM `curators`";
			return $this->db_fetch_all($sql);
		}


		function get_all_campaigns(){
			$sql = "SELECT * FROM `campaigns`";
			return $this->db_fetch_all($sql);
		}

		function get_campaign_trips($campaign_id){
			$sql = "SELECT * FROM `campaign_trips` WHERE
			`campaign_id`='$campaign_id' AND `publish_state`='published'";
			return $this->db_fetch_all($sql);
		}

		function is_user_following_curator($user_id,$curator_id){
			$sql = "SELECT * FROM `user_following`
			WHERE `user_id` = '$user_id' AND `curator_id` = '$curator_id'";
			// return $sql;
			return $this->db_fetch_one($sql);
		}

		function is_campaign_wishlisted($user_id,$campaign_id){
			$sql = "SELECT * FROM `wishlist`
			WHERE `user_id` = '$user_id' AND `campaign_id` = '$campaign_id'";
			// return $sql;
			return $this->db_fetch_one($sql);
		}

		//===================================== INSERT =========================================

		function follow_curator($user_id,$curator_id){
			$sql = "INSERT INTO `user_following`(`user_id`, `curator_id`)
			VALUE ('$user_id', '$curator_id')";
			// return $sql;
			return $this->db_query($sql);
		}

		function add_campaign_wishlist($user_id,$campaign_id){
			$sql = "INSERT INTO `wishlist`(`user_id`, `campaign_id`)
			VALUE ('$user_id', '$campaign_id')";
			// return $sql;
			return $this->db_query($sql);
		}





		// ============================ UPDATE=========================================



		//================================ DELETE =============================================

		function unfollow_curator($user_id,$curator_id){
			$sql = "DELETE FROM `user_following` WHERE
			`user_id`='$user_id' AND `curator_id` = '$curator_id'";
			return $this->db_query($sql);
		}

		function remove_campaign_wishlist($user_id,$campaign_id){
			$sql = "DELETE FROM `wishlist` WHERE
			`user_id`='$user_id' AND `campaign_id` = '$campaign_id'";
			return $this->db_query($sql);
		}
	}
?>