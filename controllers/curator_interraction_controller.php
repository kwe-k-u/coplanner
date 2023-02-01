<?php
	require_once(__DIR__."/../classes/curator_interaction_class.php");



	function get_collaborator_info($user_id){
		$class = new curator_interaction_class();
		return $class->get_collaborator_info($user_id);
	}


	function get_recent_bookings($curator_id){
		$class = new curator_interaction_class();
		return $class->get_recent_bookings($curator_id);
	}

?>