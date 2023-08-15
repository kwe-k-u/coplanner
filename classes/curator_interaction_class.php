<?php
	require_once(__DIR__."/../utils/db_prepared.php");


	class curator_interaction_class extends db_prepared{

		// Returns information about curator and logged in collaborator
		function get_collaborator_info($user_id){
			$sql = "SELECT
			users.user_id as user_id,
			users.profile_image as user_profile,
			users.email_verified,
			users.user_name,
			users.phone_number,
			users.email,
			curators.curator_name,
			curators.curator_logo,
			curators.curator_id,
			curators.is_verified as curator_verified,
			curator_manager.access_status
			FROM `users`
			JOIN curator_manager on curator_manager.user_id = users.user_id
			JOIN curators on curators.curator_id = curator_manager.curator_id
			WHERE users.user_id = ?";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_one();
		}


		function get_recent_bookings($curator_id){
			$sql = "SELECT
			transactions.transaction_id,
			transactions.amount,
			transactions.tax,
			transactions.charges,
			transactions.currency,
			transactions.transaction_date,
			bookings.date_booked,
			bookings.emergency_contact_name,
			bookings.emergency_contact_number,
			bookings.adult_seats + bookings.child_seats AS seats_booked,
			bookings.booking_id,
			users.user_name,
			users.user_id,
			campaigns.title,
			campaign_tours.start_date,
			campaign_tours.end_date
			FROM bookings
			JOIN transactions on transactions.transaction_id = bookings.transaction_id
			JOIN users on users.user_id = bookings.user_id
			JOIN campaign_tours on campaign_tours.tour_id = bookings.tour_id
			JOIN campaigns on campaigns.campaign_id = campaign_tours.campaign_id
			JOIN curators on campaigns.curator_id = curators.curator_id
			WHERE curators.curator_id = ?
			LIMIT 7";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_trip_count($curator_id,$full){
			$sql = "SELECT count(campaign_tours.tour_id) as upcoming_trip_count
			FROM campaign_tours
			JOIN campaigns on campaign_tours.campaign_id = campaigns.campaign_id
			WHERE campaigns.curator_id = ?
			";
			if(!$full){
				$sql = $sql . " AND campaign_tours.start_date > CURRENT_TIMESTAMP";
			}
			$this->prepare($sql);
			$this->bind($curator_id);

			return $this->db_fetch_one();
		}

		function get_curator_revenue($curator_id){
			$sql = "SELECT sum(transactions.amount)  AS total_revenue FROM transactions
			JOIN bookings on bookings.transaction_id = transactions.transaction_id
			JOIN campaign_tours on campaign_tours.tour_id = bookings.tour_id
			JOIN campaigns on campaigns.campaign_id = campaign_tours.campaign_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);

			return $this->db_fetch_one();
		}

		function get_curator_balance($curator_id){
			$sql = "SELECT sum(transactions.amount)  AS withdrawable_balance FROM transactions
			JOIN bookings on bookings.transaction_id = transactions.transaction_id
			JOIN campaign_tours on campaign_tours.tour_id = bookings.tour_id
			JOIN campaigns on campaigns.campaign_id = campaign_tours.campaign_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_one();
		}

		function get_curator_upcoming_trips($curator_id){
			$sql = "SELECT * FROM campaigns
			JOIN campaign_tours on campaign_tours.campaign_id = campaigns.campaign_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_bookings($curator_id){
			$sql = "SELECT
			transactions.transaction_id,
			transactions.amount,
			transactions.charges,
			transactions.tax,
			transactions.currency,
			transactions.transaction_date,
			bookings.date_booked,
			bookings.emergency_contact_name,
			bookings.emergency_contact_number,
			bookings.adult_seats+ bookings.child_seats AS seats_booked,
			bookings.booking_id,
			users.user_name,
			users.user_id,
			campaigns.title,
			campaign_tours.start_date,
			campaign_tours.end_date
			FROM bookings
			JOIN transactions on transactions.transaction_id = bookings.transaction_id
			JOIN users on users.user_id = bookings.user_id
			JOIN campaign_tours on campaign_tours.tour_id = bookings.tour_id
			JOIN campaigns on campaigns.campaign_id = campaign_tours.campaign_id
			JOIN curators on campaigns.curator_id = curators.curator_id
			WHERE curators.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_average_rating($curator_id){
			$sql = "SELECT
			AVG(r.num_stars) as average_rating,
			count(r.review_id) as review_count
			from reviews AS r
			JOIN bookings as b on b.booking_id = r.booking_id
			join campaign_tours as ct on ct.tour_id = b.tour_id
			join campaigns as c on c.campaign_id = ct.campaign_id
			where c.curator_id = ?
			";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_one();
		}



		function get_curator_campaigns($curator_id){
			$sql = "SELECT *,
			(SELECT COUNT(*) FROM campaign_tours AS ct
				JOIN campaigns AS c ON c.campaign_id = ct.campaign_id
				WHERE c.curator_id = ?) AS trip_count
		FROM campaigns WHERE curator_id = ?
		";
			$this->prepare($sql);
			$this->bind($curator_id,$curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_reviews($curator_id){
			$sql = "SELECT
			r.*,
			u.user_name,
			ct.start_date as tour_date
			FROM reviews as r
			join bookings as b on b.booking_id = r.booking_id
			join users as u on u.user_id = b.user_id
			join campaign_tours as ct on ct.tour_id = b.tour_id
			join campaigns as c on c.campaign_id = ct.campaign_id
			WHERE c.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
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



		function count_campaign_bookings($campaign_id){
			$sql ="SELECT count(campaign_tours.tour_id) as booking_count FROM campaign_tours
			WHERE campaign_tours.campaign_id = ?";
			$this->prepare($sql);
			$this->bind($campaign_id);
			return $this->db_fetch_one();
		}


		function get_all_transactions_curator($curator_id){
			return null;
			$sql = "SELECT * FROM
			`transactions` AS t
			JOIN bookings AS b ON b.transaction_id = t.transaction_id
			;";
			$this->prepare($sql);
			// $this->bind();
			return $this->db_fetch_all();
		}


		function get_booking_transactions_curator($curator_id){
			$sql = "SELECT
			transactions.*,
			users.user_name,
			bookings.date_booked,
			bookings.adult_seats + bookings.child_seats as seats_booked,
			bookings.emergency_contact_name,
			bookings.emergency_contact_number,
			campaign_tours.start_date,
			campaigns.title
			FROM transactions
			JOIN bookings on transactions.transaction_id = bookings.transaction_id
			JOIN campaign_tours on campaign_tours.tour_id = bookings.tour_id
			JOIN campaigns on campaigns.campaign_id = campaign_tours.campaign_id
			JOIN users on bookings.user_id = users.user_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}


		function get_withdrawal_transactions($curator_id){
			return null;
			$sql = "SELECT * FROM transactions";
			$this->prepare($sql);
			// $this->bind();
			return $this->db_fetch_all();
		}

		function get_custom_private_tour_requests(){
			$sql = "SELECT pt.*, ptc.description FROM private_tour as pt
			join private_tour_custom as ptc on ptc.private_tour_id = pt.private_tour_id
			where pt.publish_state = 'publish' AND ISNULL(pt.accepted_quote)";
			$this->prepare($sql);
			// $this->bind();
			return $this->db_fetch_all($sql);
		}

		function get_private_tour_requests_with_bids($curator_id){
			$sql = "SELECT * FROM private_tour_quote
			JOIN private_tour on private_tour_quote.private_tour_id = private_tour.private_tour_id
			WHERE private_tour_quote.curator_id=?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all($sql);
		}

		function get_destinations(){
			$sql = "SELECT * FROM destinations LIMIT 6";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}


		function get_destination_by_id($id){
			$sql = "SELECT * FROM destinations ts
			 WHERE ts.destination_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_destination_activities($id){
			$sql = "SELECT
			a.activity_name,
			ta.activity_id,
			ta.is_verified
			 FROM destination_activity ta
			 JOIN activities a on a.activity_id = ta.activity_id
			WHERE ta.destination_id=?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function get_destination_media($id){

			$sql = "SELECT
			m.media_location,
			tm.destination_id
			FROM destination_media tm
			JOIN media m on m.media_id = tm.media_id
			WHERE tm.destination_id=? AND m.media_type='picture'";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}


		function get_destination_by_location($query){
			$sql = "SELECT * FROM `destinations` WHERE `destination_location` LIKE CONCAT('%',?,'%') or
			`country` LIKE CONCAT('%',?,'%')";
			$this->prepare($sql);
			$this->bind($query,$query);
			return $this->db_fetch_all();
		}



		function get_destination_by_activity($query){
			$sql = "SELECT * FROM destinations ts
			JOIN destination_activity ta on ta.destination_id = ts.destination_id
			JOIN activities a on a.activity_id = ta.activity_id
			WHERE a.activity_name LIKE CONCAT('%',?,'%')";
			$this->prepare($sql);
			$this->bind($query);
			return $this->db_fetch_all();
		}

		function get_accepted_tour_requests($curator_id){
			$sql = "SELECT * FROM private_tour
			JOIN private_tour_quote ON private_tour_quote.quote_id = private_tour.accepted_quote
			WHERE private_tour_quote.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		//Return information about a curator account
		function get_curator_info($curator_id){
			$sql = "SELECT";
		}


		function get_curator_collaborators($curator_id){
			$sql = "SELECT
			*
			FROM
			curator_manager AS cm
			JOIN users AS u on cm.user_id = u.user_id
			WHERE cm.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_trip_bookings($tour_id){
			$sql = "SELECT bookings.*, users.user_name FROM
			bookings
			join users on users.user_id = bookings.user_id
			where tour_id = ?
			";
			$this->prepare($sql);
			$this->bind($tour_id);
			return $this->db_fetch_all();
		}
	}
?>