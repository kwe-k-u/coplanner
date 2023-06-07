<?php
	require_once(__DIR__. "/../classes/finance_class.php");


	function book_standard_trip($booking_id, $user_id,$trip_id,$adult_seats,$kid_seats, $transaction_id, $contact_name,$contact_number){
		$fianance = new finance_class();
		return $fianance->book_standard_trip($booking_id, $user_id,$trip_id,$adult_seats,$kid_seats, $transaction_id, $contact_name,$contact_number);

	}


	function record_transaction($transaction_id,$date,$currency,$trans_amount,$amount,$trans_fee,$tax=0){
		$finance = new finance_class();
		return $finance->record_transaction($transaction_id,$date,$currency,$trans_amount,$amount,$trans_fee,$tax);
	}
?>