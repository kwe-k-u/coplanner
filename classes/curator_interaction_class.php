<?php
	require_once(__DIR__."/../utils/db_prepared.php");


	class curator_interaction_class extends db_prepared{

		// Returns information about curator and coll
		function get_collaborator_info($user_id){
			$sql = "SELECT
			users.user_id as user_id,
			users.profile_image as user_profile,
			users.email_verified,
			users.user_name,
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
			transactions.amount_paid as amount,
			transactions.currency,
			transactions.transaction_date,
			bookings.date_booked,
			bookings.emergency_contact_name,
			bookings.emergency_contact_number,
			bookings.seats_booked,
			bookings.booking_id,
			users.user_name,
			users.user_id,
			campaigns.title,
			campaign_trips.start_date,
			campaign_trips.end_date
			FROM bookings
			JOIN transactions on transactions.transaction_id = bookings.transaction_id
			JOIN users on users.user_id = bookings.user_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			JOIN curators on campaigns.curator_id = curators.curator_id
			WHERE curators.curator_id = ?
			LIMIT 7";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_trip_count($curator_id){
			$sql = "SELECT count(campaign_trips.trip_id) as upcoming_trip_count
			FROM campaign_trips
			JOIN campaigns on campaign_trips.campaign_id = campaigns.campaign_id
			WHERE campaigns.curator_id = ?
			";
			$this->prepare($sql);
			$this->bind($curator_id);

			return $this->db_fetch_one();
		}

		function get_curator_revenue($curator_id){
			$sql = "SELECT sum(transactions.amount_paid)  AS total_revenue FROM transactions
			JOIN bookings on bookings.transaction_id = transactions.transaction_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);

			return $this->db_fetch_one();
		}

		function get_curator_balance($curator_id){
			$sql = "SELECT sum(transactions.amount_paid)  AS withdrawable_balance FROM transactions
			JOIN bookings on bookings.transaction_id = transactions.transaction_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_one();
		}

		function get_curator_upcoming_trips($curator_id){
			$sql = "SELECT * FROM campaigns
			JOIN campaign_trips on campaign_trips.campaign_id = campaigns.campaign_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_bookings($curator_id){
			$sql = "SELECT
			transactions.transaction_id,
			transactions.amount_paid as amount,
			transactions.currency,
			transactions.transaction_date,
			bookings.date_booked,
			bookings.emergency_contact_name,
			bookings.emergency_contact_number,
			bookings.seats_booked,
			bookings.booking_id,
			users.user_name,
			users.user_id,
			campaigns.title,
			campaign_trips.start_date,
			campaign_trips.end_date
			FROM bookings
			JOIN transactions on transactions.transaction_id = bookings.transaction_id
			JOIN users on users.user_id = bookings.user_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			JOIN curators on campaigns.curator_id = curators.curator_id
			WHERE curators.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}



		function get_curator_campaigns($curator_id){
			$sql = "SELECT  *, COUNT(campaign_trips.trip_id) as trip_count FROM campaigns
			JOIN campaign_trips on campaign_trips.campaign_id = campaigns.campaign_id
			WHERE campaigns.curator_id =  ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}



		function count_campaign_bookings($campaign_id){
			$sql ="SELECT count(campaign_trips.trip_id) as booking_count FROM campaign_trips
			WHERE campaign_trips.campaign_id = ?";
			$this->prepare($sql);
			$this->bind($campaign_id);
			return $this->db_fetch_one();
		}


		function get_all_transactions_curator($curator_id){
			$sql = "SELECT * FROM
			`transactions`;";
			$this->prepare($sql);
			// $this->bind();
			return $this->db_fetch_all();
		}


		function get_booking_transactions_curator($curator_id){
			$sql = "SELECT
			transactions.*,
			users.user_name,
			campaign_trips.start_date,
			campaigns.title
			FROM transactions
			JOIN bookings on transactions.transaction_id = bookings.transaction_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			JOIN users on bookings.user_id = users.user_id
			WHERE campaigns.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}


		function get_withdrawal_transactions($curator_id){
			$sql = "SELECT * FROM transactions";
			$this->prepare($sql);
			// $this->bind();
			return $this->db_fetch_all();
		}

		function get_private_tour_requests(){
			$sql = "SELECT * FROM private_tour";
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

		function get_accepted_tour_requests($curator_id){
			$sql = "SELECT * FROM private_tour
			JOIN private_tour_quote ON private_tour_quote.quote_id = private_tour.accepted_quote
			WHERE private_tour_quote.curator_id = ?";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}
	}
?>