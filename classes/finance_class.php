<?php
	require_once(__DIR__."/../utils/db_class.php");
	require_once(__DIR__."/../utils/core.php");

	class finance_class extends db_connection{



		//======================================= SELECT ====================================



		//===================================== INSERT =========================================
		function book_standard_trip($booking_id, $user_id,$trip_id,$seats, $transaction_id, $contact_name,$contact_number){
			$sql = "INSERT INTO `bookings`(`booking_id`, `user_id`, `trip_id`, `date_booked`, `seats_booked`, `transaction_id`, `emergency_contact_name`, `emergency_contact_number`)
			VALUES ('$booking_id','$user_id','$trip_id',CURRENT_TIMESTAMP,'$seats','$transaction_id','$contact_name','$contact_number')";
			return $this->db_query($sql);
		}


		function book_private_tour(){

		}

		function record_transaction($transaction_id,$date,$amount,$provider,$transaction_fee,$tax){
			$sql = "INSERT INTO `transactions` VALUES ('$transaction_id','$date','$amount','$provider','$transaction_fee','$tax')";
			return $this->db_query($sql);
		}



		// ============================ UPDATE=========================================


		//================================ DELETE =============================================
	}
?>