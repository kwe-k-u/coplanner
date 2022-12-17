<?php
	require_once(__DIR__."/../utils/paybox.php");

	$paybox = new paybox_custom();

	// $e = $paybox->withdraw(0.1,"0150509995000","300302","Kweku","main.easygo@gmail.com","2");


// echo $response;
	// var_dump($e);


	//TODO paybox call back
	//verify transaction and update booking status
	//from payload get user_id, trip_id, $seats_booked
?>