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
			join campaign_tours as ct on ct.campaign_id = c.campaign_id
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
			join campaign_tours as ct on ct.tour_id = b.tour_id
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
			(select count(tour_id) from campaign_tours as ct inner join campaigns as c where c.campaign_id = ct.campaign_id ) as num_tours,
			(select count(booking_id) from bookings as b inner join campaign_tours on campaign_tours.tour_id = b.tour_id inner join campaigns on campaigns.campaign_id = campaign_tours.campaign_id where campaigns.curator_id = c.curator_id) as num_bookings,
			(select sum(amount) from transactions inner join bookings on bookings.transaction_id = transactions.transaction_id where bookings.transaction_id = transactions.transaction_id) as revenue
			 FROM curators as c";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_curator_by_id($id){
			$sql = "SELECT * FROM curators where curator_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}


		function get_destination_info($id){
			$sql = "SELECT * FROM `destinations` as t where t.destination_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_destination_activities($id){
			$sql = "SELECT ta.*, a.activity_name FROM destination_activity as ta
			inner join destinations as t on t.destination_id = ta.destination_id
			inner join activities as a on a.activity_id = ta.activity_id
			 where t.destination_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function get_destination_socials($id){
			$sql = "SELECT * FROM destination_socials as ts
			inner join destinations as t on t.destination_id = ts.destination_id
			 where t.destination_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function get_destination_media($id){
			$sql = "SELECT * FROM destination_media
			inner join media on media.media_id = destination_media.media_id
			where destination_media.destination_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}


		function set_location_verification($id,$new_status){
			$sql = "UPDATE destinations SET is_verified = ? where destination_id = ?";
			$this->prepare($sql);
			$this->bind($new_status,$id);
			return $this->db_query();
		}

		function add_destination($id,$name,$desc,$loc,$country,$phone,$contact,$lat,$long){
			$sql = "INSERT INTO destinations (destination_id,destination_name,destination_description,
			destination_location,country,is_verified,phone_number,contact_name, longitude,latitude)
			 VALUES (?,?,?,?,?,?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($id,$name,$desc,$loc,$country,1,$phone,$contact,$lat,$long);
			return $this->db_query();
		}

		function add_destination_activity($des_id,$act_id,$fee ){
			$sql = "INSERT INTO destination_activity
			(activity_id,destination_id,activity_fee,is_verified)
			VALUES (?,?,?,?)";
			$this->prepare($sql);
			$this->bind($act_id,$des_id,$fee,1);
			return $this->db_query();
		}

		function add_destination_socials($des_id,$type,$link){
			$sql = "INSERT INTO destination_socials (destination_id,social_link,social_tYpe)
			VALUES (?,?,?)";
			$this->prepare($sql);
			$this->bind($des_id,$link,$type);
			return $this->db_query();
		}

		function add_destination_media($des_id,$media_id,$is_foriegn){
			$sql = "INSERT INTO destination_media
			VALUES (?,?,?,?)";
			$this->prepare($sql);
			$this->bind($des_id,$media_id,$is_foriegn,1);
			return $this->db_query();
		}

		function add_media($media_id, $location, $type){
			$sql = "INSERT INTO `media`(`media_id`, `media_location`, `media_type`)
			VALUE (?,?,?)";
			$this->prepare($sql);
			$this->bind($media_id,$location,$type);
			return $this->db_query();
		}

		function get_unverified_curators(){
			$sql = "SELECT curators.*, media.media_location as inc_doc
			FROM curators
			left join media on media.media_id = curators.curator_inc_doc
			 where curators.is_verified = 0
			";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_id_pending_curators(){
			$sql = "SELECT
			users.user_name,
			users.user_id,
			users.email,
			curators.curator_id,
			curators.curator_name,
            (select media.media_location from media where media_id = curator_manager.gov_id_front) as id_front,
            (select media.media_location from media where media_id = curator_manager.gov_id_back) as id_back
			FROM curator_manager
			INNER JOIN curators on curator_manager.curator_id = curators.curator_id
			INNER JOIN users on users.user_id = curator_manager.user_id
			WHERE curator_manager.id_verified = false";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}


		function verify_curator_manager_id($user_id,$action){
			$sql = "UPDATE curator_manager SET id_verified = ? where user_id =?";
			$this->prepare($sql);
			$this->bind($action,$user_id);
			return $this->db_query();
		}

		function verify_curator_account($curator_id,$action){
			$sql = "UPDATE curators SET is_verified = ? where curator_id = ?";
			$this->prepare($sql);
			$this->bind($action,$curator_id);
			return $this->db_query();
		}
	}
?>