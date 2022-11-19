<?php
	require_once(__DIR__. "/../utilsdb_class.php");



	class wishlist_class extends db_connection{



	//========================================== SELECT ================================

	function get_user_wishlist_cls($user_id){
		$sql = "SELECT * FROM `wishlist` WHERE `user_id` = '$user_id'";
		return $this->db_fetch_all($sql);
	}


	//======================================== INSERT ==============================

		function add_to_wishlist_cls($user_id,$campaign_id){
			$sql = "INSERT INTO `wishlist` (`user_id`, `curator_id`)
			VALUE('$user_id','$campaign_id')";
			return $this->db_query($sql);
		}



	//======================================= DELETE =====================================
		function remove_from_wishlist_cls($user_id,$campaign_id){
			$sql = "DELETE FROM `wishlist` WHERE `user_id` = '$user_id' AND `campaign_id` = '$campaign_id'";
			return $this->db_query($sql);
		}
	}
?>