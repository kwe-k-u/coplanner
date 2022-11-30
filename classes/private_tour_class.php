<?php
require_once(__DIR__. "/../utils/db_class.php");


	class private_tour_class extends db_connection{

		//===============================INSERT==========================================

		function create_private_trip($id, $user, $currency,$min_bug,$max_bug,
		$desc,$start,$end,$state, $count){
			$sql = "INSERT INTO `private_tour`
			(`private_tour_id`,`user_id`,`currency`,`min_budget`,
			`max_budget`,`description`,`date_start`,`date_end`,`publish_state`, `person_count`)
			VALUE
			('$id','$user', '$currency','$min_bug','$max_bug',
			'$desc', '$start', '$end', '$state', '$count')";
			return $this->db_query($sql);
		}


		function place_tour_request_bid($bid_id,$curator,$request,$comment,$fee){
			$sql = "INSERT INTO `private_tour_quote` (`quote_id`, `curator_id`, `private_tour_id`, `fee`, `comments`)
			VALUE ('$bid_id', '$curator', '$request', '$comment', '$fee')";
			// return $sql;
			return $this->db_query($sql);
		}



		//=================================SELECT================================

		function get_private_trip_requests($accepted){
			$sql = "SELECT * FROM `private_tour` WHERE `publish_state`= 'publish' AND `accepted_quote` IS ";
			$sql = $sql.( $accepted ? "NOT " : "");
			$sql = $sql."NULL";
			return $this->db_fetch_all($sql);
		}





	}
?>