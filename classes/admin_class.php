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


		function get_campaigns($curator_id){
			$sql = "SELECT * FROM campaigns as c
			left join campaign_tours as ct on c.campaign_id = ct.campaign_id
			left join campaign_media as cm on cm.campaign_id = c.campaign_id
			left join media as m on m.media_id = cm.media_id
			";

			if ($curator_id){
				$sql .= " WHERE c.curator_id = ? ";
			}
			$sql .=" GROUP BY c.campaign_id";

			$this->prepare($sql);

			if($curator_id){
				$this->bind($curator_id);
			}

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


		function get_user_accounts($user_id){
			$sql = "SELECT *,
			(select login_date from login_log where user_id = users.user_id   ORDER BY `login_date` DESC limit 1  )as last_login,
			(select count(booking_id) from bookings where bookings.user_id = users.user_id) as booking_count
			FROM users ";

			if($user_id){
				$sql .= " where users.user_id = ?";
			}

			$sql .=" ORDER BY date_created DESC";
			$this->prepare($sql);

			if($user_id){
				$this->bind($user_id);
			}

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

		function get_curator_managers($curator_id){
			$sql = "SELECT * FROM curator_manager as cm
			inner join users on users.user_id = cm.user_id
			where cm.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_by_name($name){
			$sql = "SELECT * FROM curators where curator_name = ?";
			$this->prepare($sql);
			$this->bind($name);
			return $this->db_fetch_one();
		}

		function add_curator($id,$name,$country){
			$sql = "INSERT INTO curators (`curator_id`, `curator_name`, `country`) values (?,?,?)";
			$this->prepare($sql);
			$this->bind($id,$name,$country);
			return $this->db_query();
		}


		function get_transactions($transaction_id){
			$sql = "SELECT *,
			CASE
				WHEN b.transaction_id is not null then 'booking'
				else 'other'
			END AS transaction_type
			 FROM transactions as t
			left join bookings as b on b.transaction_id = t.transaction_id";
			if($transaction_id){
				$sql .=" WHERE t.transaction_id = ? ";
			}
			$sql .=" ORDER BY t.transaction_date DESC";
			$this->prepare($sql);

			if ($transaction_id){
				$this->bind($transaction_id);
				$this->db_fetch_one();
			}

			return $this->db_fetch_all();
		}


		function get_media($media_id){
			$sql = "SELECT *,
			case
				WHEN dm.media_id is not null then 'destination'
				when cm.media_id is not null then 'curator'
				when uu.media_id is not null then 'user upload'
				else 'unlinked'
			end as category
			FROM media as m
			left join destination_media as dm on dm.media_id = m.media_id
			left join campaign_media as cm on cm.media_id = m.media_id
			left join user_uploads as uu on uu.media_id = m.media_id
			";
			if($media_id){
				$sql .= " where m.media_id = ? ";
			}

			$sql .=" ORDER BY m.upload_date DESC";
			// print($sql);
			$this->prepare($sql);
			if ($media_id){
				$this->bind($media_id);
				return $this->db_fetch_one();
			}

			return $this->db_fetch_all();
		}

		function get_media_by_category($category){
			$sql = "SELECT * FROM media AS m";
			switch($category){
				case "curator":
					$sql .= " INNER JOIN curator_uploads AS cu on m.media_id = cu.media_id";
					break;
					case "destination":
						$sql .= " INNER JOIN destination_media AS dm on m.media_id = dm.media_id";
					break;
				case "campaign":
					$sql .= " INNER JOIN campaign_media AS cm on cm.media_id = m.media_id";
					break;
				default:
					"";

			}
			$this->prepare($sql);
			return $this->db_fetch_all();
		}


		function get_admin_stats(){
			$sql = "select
			(select sum(t.amount) from transactions as t inner join bookings as b on b.transaction_id = t.transaction_id) as booking_value,
			(select count(tour_id) from campaign_tours where start_date > now()) as upcoming_tours,
			(select count(user_id) from curator_manager as cm where cm.id_verified = 0) as pending_id_approval,
			(select count(private_tour_id) from private_tour where date_start > now() and accepted_quote = null) as private_tour;";
			$this->prepare($sql);
			return $this->db_fetch_one();
		}

		function get_curator($id){
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

		function update_media_location($id,$location){
			$sql = "UPDATE media set `media_location` = ?, `upload_date` = CURRENT_TIMESTAMP where `media_id` = ?";
			$this->prepare($sql);
			$this->bind($location,$id);
			return $this->db_query();
		}
	}

?>