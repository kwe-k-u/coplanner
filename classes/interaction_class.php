<?php
	require_once(__DIR__."/../utils/db_prepared.php");
	require_once(__DIR__."/../utils/core.php");

	class interaction_class extends db_prepared{



		//======================================= SELECT ====================================
		function get_all_curators(){
			$sql = "SELECT * FROM `curators`";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_campaign_media($id){
			$sql = "SELECT
				media.* FROM media
				JOIN campaign_media on campaign_media.media_id = media.media_id
				WHERE campaign_media.campaign_id = ?
			";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}



		function get_campaign_activities($campaign_id){
			$sql = "SELECT activities.activity_name FROM `activities`
			join campaign_activities on activities.activity_id = campaign_activities.activity_id
			WHERE campaign_activities.campaign_id = ?";
			$this->prepare($sql);
			$this->bind($campaign_id);
			return $this->db_fetch_all();
		}


		function get_current_campaigns($query = null){
			$sql = "SELECT campaigns.*,curators.curator_name FROM `campaigns`
			JOIN curators on campaigns.curator_id = curators.curator_id";
			if($query != null){
				$sql .= " ";
			}
			$this->prepare($sql);
			return $this->db_fetch_all();
		}


		function get_user_booking_history($user_id){
			$sql = "SELECT
			b.booking_id,
			b.user_id,
			b.transaction_id,
			b.trip_id,
			ct.start_date,
			ct.end_date,
			b.adult_seats + b.child_seats as seats_booked,
			b.emergency_contact_name,
			b.emergency_contact_number,
			b.booking_status,
			t.transaction_amount as amount_due,
			t.currency,
			b.date_booked
			 FROM `bookings` as b
			 join transactions as t on t.transaction_id = b.transaction_id
			 join campaign_trips as ct on ct.trip_id = b.trip_id
			 WHERE b.user_id = ?";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_all();
		}


		function get_past_campaigns(){
			$sql = "SELECT campaigns.*,
			curators.curator_name
			 FROM `campaigns`
			JOIN `campaign_trips` on campaign_trips.campaign_id = campaigns.campaign_id
			JOIN curators on curators.curator_id = campaigns.campaign_id";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_toursite_by_campaign($id){
			$sql = "SELECT toursites.* from toursites
			join toursite_activity on toursite_activity.toursite_id = toursites.toursite_id
			join campaign_activities on toursite_activity.activity_id = campaign_activities.activity_id
			WHERE campaign_activities.campaign_id = ? ";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function get_all_campaigns(){
			$sql = "SELECT * FROM `campaigns`";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_campaign_by_id($id){
			$sql = "SELECT campaigns.*, curators.curator_name FROM `campaigns`
			join curators on curators.curator_id = campaigns.curator_id
			where campaigns.campaign_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_campaign_trips($campaign_id){
			$sql = "SELECT * FROM `campaign_trips` WHERE
			`campaign_id`=? AND `publish_state`='published'";
			$this->prepare($sql);
			$this->bind($campaign_id);
			return $this->db_fetch_all();
		}

		function get_campaign_next_trip($id){
			$sql = "SELECT * FROM `campaign_trips`
			where `campaign_id`=? AND start_date > CURRENT_TIMESTAMP";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_user_wishlist($user_id){
			$sql = "SELECT * FROM `wishlist`
			JOIN `campaigns` on campaigns.campaign_id = wishlist.campaign_id
			WHERE wishlist.user_id = ?";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_all();
		}

		function get_curator_name($curator_id){
			$sql = "SELECT * FROM `curators` WHERE `curator_id` = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_one();
		}

		function get_user_name_by_id($id){
			$sql = "SELECT `user_name` FROM `users` WHERE `user_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_campaign_by_trip_id($trip_id){
			$sql = "SELECT * FROM `campaigns` as c
			join campaign_trips ct on ct.campaign_id = c.campaign_id
			WHERE ct.trip_id = ?";
			$this->prepare($sql);
			$this->bind($trip_id);
			return $this->db_fetch_one();
		}

		function get_user_profile_img($id){
			$sql = "SELECT media.media_location from media
			join users on users.profile_image = media.media_id
			where users.user_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_private_trip_quotes($request_id){
			$sql = "SELECT * FROM `private_tour_quote` WHERE `private_tour_id` = ?";
			$this->prepare($sql);
			$this->bind($request_id);
			return $this->db_fetch_all();
		}

		function get_user_stats($user_id){
			$sql = "SELECT
			(SELECT count(*) FROM `bookings` WHERE `user_id` = ?) AS count_bookings,
			(SELECT count(*) FROM `private_tour` WHERE `user_id` = ?) AS count_private,
			(SELECT count(*) FROM `wishlist` WHERE `user_id` = ?) AS count_saved";
			$this->prepare($sql);
			$this->bind($user_id, $user_id,$user_id);
			return $this->db_fetch_one();
		}

		function is_user_following_curator($user_id,$curator_id){
			$sql = "SELECT * FROM `user_following`
			WHERE `user_id` = ? AND `curator_id` = ?";
			$this->prepare($sql);
			$this->bind($user_id,$curator_id);
			return $this->db_fetch_one();
		}

		function is_campaign_wishlisted($user_id,$campaign_id){
			$sql = "SELECT * FROM `wishlist`
			WHERE `user_id` = ? AND `campaign_id` = ?";
			$this->prepare($sql);
			$this->bind($user_id,$campaign_id);
			return $this->db_fetch_one();
		}

		//===================================== INSERT =========================================

		function follow_curator($user_id,$curator_id){
			$sql = "INSERT INTO `user_following`(`user_id`, `curator_id`)
			VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($user_id,$curator_id);
			return $this->db_query($sql);
		}

		function add_campaign_wishlist($user_id,$campaign_id){
			$sql = "INSERT INTO `wishlist`(`user_id`, `campaign_id`)
			VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($user_id,$campaign_id);
			return $this->db_query();
		}





		// ============================ UPDATE=========================================



		//================================ DELETE =============================================

		function unfollow_curator($user_id,$curator_id){
			$sql = "DELETE FROM `user_following` WHERE
			`user_id`=? AND `curator_id` = ?";
			$this->prepare($sql);
			$this->bind($user_id,$curator_id);
			return $this->db_query();
		}

		function remove_campaign_wishlist($user_id,$campaign_id){
			$sql = "DELETE FROM `wishlist` WHERE
			`user_id`=? AND `campaign_id` = ?";
			$this->prepare($sql);
			$this->bind($user_id,$campaign_id);
			return $this->db_query();
		}
	}
?>