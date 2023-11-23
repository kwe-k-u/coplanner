<?php
	require_once(__DIR__. "/../utils/db_prepared.php");



	class wishlist_class extends db_prepared{



	//========================================== SELECT ================================

	function get_user_wishlist_cls($user_id){
		$sql = "SELECT * FROM `wishlist` WHERE `user_id` = ?";
		$this->prepare($sql);
		$this->bind($user_id);
		return $this->db_fetch_all();
	}


	//======================================== INSERT ==============================

		function add_to_wishlist_cls($user_id,$campaign_id){
			$sql = "INSERT INTO `wishlist` (`user_id`, `curator_id`)
			VALUE(?,?)";
			$this->prepare($sql);
			$this->bind($user_id,$campaign_id);
			return $this->db_query();
		}



	//======================================= DELETE =====================================
		function remove_from_wishlist_cls($user_id,$campaign_id){
			$sql = "DELETE FROM `wishlist` WHERE `user_id` = ? AND `campaign_id` = ?";
			$this->prepare($sql);
			$this->bind($user_id,$campaign_id);
			return $this->db_query();
		}
	}
?>