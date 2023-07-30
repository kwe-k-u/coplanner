<?php
	require_once(__DIR__."/../utils/db_prepared.php");
	require_once(__DIR__."/../utils/core.php");

	class finance_class extends db_prepared{



		//======================================= SELECT ====================================



		//===================================== INSERT =========================================
		function book_standard_trip($booking_id, $user_id,$tour_id,$adult_seats,$kid_seats, $transaction_id, $contact_name,$contact_number){
			$sql = "INSERT INTO `bookings`(`booking_id`, `user_id`, `tour_id`, `date_booked`, `adult_seats`,`child_seats`, `transaction_id`, `emergency_contact_name`, `emergency_contact_number`)
			VALUES (?,?,?,CURRENT_TIMESTAMP,?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($booking_id,$user_id,$tour_id,$adult_seats,$kid_seats,$transaction_id,$contact_name,$contact_number);
			return $this->db_query();
		}


		// function book_private_tour(){

		// }

		function record_transaction($transaction_id,$date,$currency,$trans_amount,$amount,$trans_fee,$tax){
			$sql = "INSERT INTO `transactions`(`transaction_id`,`transaction_date`,`currency`,`transaction_amount`,`amount`,
			`charges`,`tax`)
			VALUES (?,?,?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($transaction_id,$date,$currency,$trans_amount,$amount,$trans_fee,$tax);
			return $this->db_query();
		}


		// ============================ UPDATE=========================================


		//================================ DELETE =============================================
	}
?>