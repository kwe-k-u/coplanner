<?php
	require_once(__DIR__."/../utils/db_class.php");


	class curator_interaction_class extends db_connection{

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
			WHERE users.user_id = '$user_id'";
			return $this->db_fetch_one($sql);
		}


		function get_recent_bookings($curator_id){
			$sql = "SELECT
			users.user_name,
			users.user_id,
			transactions.transaction_id,
			transactions.amount_paid,
			transactions.currency,
			bookings.booking_id,
			bookings.seats_boked,
			bookings.date_booked,
			bookings.emergency_contact_name,
			bookings.emergency_contact_number,
			bookings.status,
			campaign_trips.trip
			FROM `bookings`
			JOIN users on users.user_id = bookings.user_id
			JOIN transactions on transactions.transaction_id = bookings.transaction_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			WHERE curators.curator_id = '$curator_id'";
			return $this->db_fetch_all($sql);
		}

		function get_curator_trip_count($curator_id){
			$sql = "SELECT count(campaign_trips.trip_id) as upcoming_trip_count
			FROM campaign_trips
			JOIN campaigns on campaign_trips.campaign_id = campaigns.campaign_id
			WHERE campaigns.curator_id = '$curator_id'
			";

			return $this->db_fetch_one($sql);
		}

		function get_curator_revenue($curator_id){
			$sql = "SELECT sum(transactions.amount_paid)  AS total_revenue FROM transactions
			JOIN bookings on bookings.transaction_id = transactions.transaction_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			WHERE campaigns.curator_id = '$curator_id'";

			return $this->db_fetch_one($sql);
		}

		function get_curator_balance($curator_id){
			$sql = "SELECT sum(transactions.amount_paid)  AS withdrawable_balance FROM transactions
			JOIN bookings on bookings.transaction_id = transactions.transaction_id
			JOIN campaign_trips on campaign_trips.trip_id = bookings.trip_id
			JOIN campaigns on campaigns.campaign_id = campaign_trips.campaign_id
			WHERE campaigns.curator_id = '$curator_id'";
			return $this->db_fetch_one($sql);
		}

		function get_curator_upcoming_trips($curator_id){
			$sql = "SELECT * FROM campaigns
			JOIN campaign_trips on campaign_trips.campaign_id = campaigns.campaign_id
			WHERE campaigns.curator_id = '$curator_id'";
			return $this->db_fetch_all($sql);
		}


	}
?>