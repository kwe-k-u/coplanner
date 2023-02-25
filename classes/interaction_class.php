<?php
	require_once(__DIR__."/../utils/db_class.php");
	require_once(__DIR__."/../utils/core.php");

	class interaction_class extends db_connection{



		//======================================= SELECT ====================================
		function get_all_curators(){
			$sql = "SELECT * FROM `curators`";
			return $this->db_fetch_all($sql);
		}



		function get_campaign_activities($campaign_id){
			$sql = "SELECT toursite_activity.activity_name FROM `campaign_activities`
			join toursite_activity on toursite_activity.activity_id = campaign_activities.activity_id
			WHERE campaign_activities.campaign_id = '$campaign_id'";
			return $this->db_fetch_all($sql);
		}


		function get_current_campaigns($query = null){
			$sql = "SELECT campaigns.*,curators.curator_name FROM `campaigns`
			JOIN curators on campaigns.curator_id = curators.curator_id";
			if($query != null){
				$sql .= " ";
			}
			return $this->db_fetch_all($sql);
		}


		function get_user_booking_history($user_id){
			$sql = "SELECT * FROM `bookings` WHERE `user_id` = '$user_id'";
			return $this->db_fetch_all($sql);
		}


		function get_past_campaigns(){
			$sql = "SELECT campaigns.*,
			curators.curator_name
			 FROM `campaigns`
			JOIN `campaign_trips` on campaign_trips.campaign_id = campaigns.campaign_id
			JOIN curators on curators.curator_id = campaigns.campaign_id";
			return $this->db_fetch_all($sql);
		}

		function get_toursite_by_campaign($id){
			$sql = "SELECT toursites.* from toursites
			join toursite_activity on toursite_activity.toursite_id = toursites.toursite_id
			join campaign_activities on toursite_activity.activity_id = campaign_activities.activity_id
			WHERE campaign_activities.campaign_id = '$id' ";
			return $this->db_fetch_all($sql);
		}

		function get_all_campaigns(){
			$sql = "SELECT * FROM `campaigns`";
			return $this->db_fetch_all($sql);
		}

		function get_campaign_by_id($id){
			$sql = "SELECT campaigns.*, curators.curator_name FROM `campaigns`
			join curators on curators.curator_id = campaigns.curator_id
			where campaigns.campaign_id = '$id'";
			return $this->db_fetch_one($sql);
		}

		function get_campaign_trips($campaign_id){
			$sql = "SELECT * FROM `campaign_trips` WHERE
			`campaign_id`='$campaign_id' AND `publish_state`='published'";
			return $this->db_fetch_all($sql);
		}

		function get_campaign_next_trip($id){
			$sql = "SELECT * FROM `campaign_trips`
			where `campaign_id`='$id' AND start_date > CURRENT_TIMESTAMP";
			return $this->db_fetch_one($sql);
		}

		function get_user_wishlist($user_id){
			$sql = "SELECT * FROM `wishlist`
			JOIN `campaigns` on campaigns.campaign_id = wishlist.campaign_id
			WHERE wishlist.user_id = '$user_id'";
			return $this->db_fetch_all($sql);
		}

		function get_curator_name($curator_id){
			$sql = "SELECT * FROM `curators` WHERE `curator_id` = '$curator_id'";
			return $this->db_fetch_one($sql);
		}

		function get_user_name_by_id($id){
			$sql = "SELECT `user_name` FROM `users` WHERE `user_id` = '$id'";
			return $this->db_fetch_one($sql);
		}

		function get_user_profile_img($id){
			$sql = "SELECT media.media_location from media
			join users on users.profile_image = media.media_id
			where users.user_id = '$id'";
			return $this->db_fetch_one($sql);
		}

		function get_private_trip_quotes($request_id){
			$sql = "SELECT * FROM `private_tour_quote` WHERE `private_tour_id` = '$request_id'";
			return $this->db_fetch_all($sql);
		}

		function is_user_following_curator($user_id,$curator_id){
			$sql = "SELECT * FROM `user_following`
			WHERE `user_id` = '$user_id' AND `curator_id` = '$curator_id'";
			return $this->db_fetch_one($sql);
		}

		function is_campaign_wishlisted($user_id,$campaign_id){
			$sql = "SELECT * FROM `wishlist`
			WHERE `user_id` = '$user_id' AND `campaign_id` = '$campaign_id'";
			return $this->db_fetch_one($sql);
		}

		//===================================== INSERT =========================================

		function follow_curator($user_id,$curator_id){
			$sql = "INSERT INTO `user_following`(`user_id`, `curator_id`)
			VALUE ('$user_id', '$curator_id')";
			return $this->db_query($sql);
		}

		function add_campaign_wishlist($user_id,$campaign_id){
			$sql = "INSERT INTO `wishlist`(`user_id`, `campaign_id`)
			VALUE ('$user_id', '$campaign_id')";
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