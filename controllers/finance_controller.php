<?php
	require_once(__DIR__. "/../classes/finance_class.php");


	function book_standard_trip($booking_id, $user_id,$trip_id,$seats, $transaction_id, $contact_name,$contact_number){
		$fianance = new finance_class();
		return $fianance->book_standard_trip($booking_id, $user_id,$trip_id,$seats, $transaction_id, $contact_name,$contact_number);
	}


	function record_transaction($transaction_id,$date,$amount,$provider,$transaction_fee,$tax = 0){
		$finance = new finance_class();
		return $finance->record_transaction($transaction_id,$date,$amount,$provider,$transaction_fee,$tax = 0);
	}
?>