<?php
	require_once(__DIR__. "/../utils/db_prepared.php");

	class admin extends db_prepared {

		function get_upcoming_tours(){
			$sql = "SELECT c.*,
			ct.start_date,
			ct.end_date,
			ct.fee,
			ct.currency,
			curators.curator_name
			FROM campaigns  as c
			join campaign_trips as ct on ct.campaign_id = c.campaign_id
			join curators on curators.curator_id = c.curator_id
			where ct.start_date > CURRENT_TIMESTAMP";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_campaign_image($campaign_id){
			$sql = "SELECT * FROM
			media as m join campaign_media as cm
			on cm.media_id = m.media_id
			where cm.campaign_id = ?";
			$this->prepare($sql);
			$this->bind($campaign_id);
			return $this->db_fetch_all();
		}

		function get_bookings(){
			$sql = "SELECT *,
			b.adult_seats + b.child_seats as seats_booked
			 FROM bookings as b
			join users as u on u.user_id = b.user_id
			join transactions as t on t.transaction_id = b.transaction_id
			join campaign_trips as ct on ct.trip_id = b.trip_id
			join campaigns as c on c.campaign_id = ct.campaign_id
			ORDER BY b.date_booked";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}


		function get_user_accounts(){
			$sql = "SELECT *,
			(select login_date from login_log where user_id = users.user_id   ORDER BY `login_date` DESC limit 1  )as last_login,
			(select count(booking_id) from bookings where bookings.user_id = users.user_id) as booking_count
			FROM users ORDER BY date_created DESC

			";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_curators(){
			$sql = "SELECT *,
			(select count(curator_id) from curator_manager as cm where cm.curator_id = c.curator_id ) as num_admins,
			(select count(trip_id) from campaign_trips as ct inner join campaigns as c where c.campaign_id = ct.campaign_id ) as num_tours,
			(select count(booking_id) from bookings as b inner join campaign_trips on campaign_trips.trip_id = b.trip_id inner join campaigns on campaigns.campaign_id = campaign_trips.campaign_id where campaigns.curator_id = c.curator_id) as num_bookings,
			(select sum(amount) from transactions inner join bookings on bookings.transaction_id = transactions.transaction_id where bookings.transaction_id = transactions.transaction_id) as revenue
			 FROM curators as c";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}


		function get_toursite_info($id){
			$sql = "SELECT * FROM `toursites` as t where t.toursite_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_toursite_activities($id){
			$sql = "SELECT * FROM toursite_activity as ta
			inner join toursites as t on t.toursite_id = ta.toursite_id
			 where t.toursite_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function get_toursite_socials($id){
			$sql = "SELECT * FROM toursite_socials as ts
			inner join toursites as t on t.toursite_id = ts.toursite_id
			 where t.toursite_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function get_toursite_media($id){
			$sql = "SELECT * FROM toursite_media
			inner join media on media.media_id = toursite_media.media_id
			where toursite_media.toursite_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}


		function set_location_verification($id,$new_status){
			$sql = "UPDATE toursites SET is_verified = ? where toursite_id = ?";
			$this->prepare($sql);
			$this->bind($new_status,$id);
			return $this->db_query();
		}
	}
?>