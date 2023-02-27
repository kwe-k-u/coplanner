<?php
require_once(__DIR__. "/../utils/db_prepared.php");


	class private_tour_class extends db_prepared{

		//===============================INSERT==========================================

		function create_private_trip($id, $user, $currency,$min_bug,$max_bug,
		$desc,$start,$end,$state, $count){
			$sql = "INSERT INTO `private_tour`
			(`private_tour_id`,`user_id`,`currency`,`min_budget`,
			`max_budget`,`description`,`date_start`,`date_end`,`publish_state`, `person_count`)
			VALUE (?,?,?,?,?,?,?,?,?,?,)";
			$this->prepare($sql);
			$this->bind($id,$user,$currency,$min_bug,$max_bug,$desc,$start,$end,$state,$count);
			return $this->db_query();
		}

		function edit_private_tour_request($id, $currency,$min_bug,$max_bug,
		$desc,$start,$end,$state, $count){
			$sql = "UPDATE `private_tour` SET `currency` = ?, `date_start`=?, `date_end` = ?, `description`=?,
			`person_count`=?, `publish_state` = ?, `max_budget`=?, `min_budget` = ?
			WHERE `private_tour_id`=?";
			$this->prepare($sql);
			$this->bind($currency,$start,$end,$count,$state,$max_bug,$min_bug,$id);

			return $this->db_query();

		}


		function place_tour_request_bid($bid_id,$curator,$request,$comment,$fee){
			$sql = "INSERT INTO `private_tour_quote` (`quote_id`, `curator_id`, `private_tour_id`, `fee`, `comments`)
			VALUE (?,?,?,?, ?)";
			$this->prepare($sql);
			$this->bind($bid_id,$curator,$request,$fee,$comment);
			return $this->db_query();
		}



		//=================================SELECT================================

		function get_private_trip_requests($accepted){
			$sql = "SELECT * FROM `private_tour` WHERE `publish_state`= 'publish' AND `accepted_quote` IS ";
			$sql = $sql.( $accepted ? "NOT " : "");
			$sql = $sql."NULL";


			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_user_private_trip_requests($id){
			$sql = "SELECT * FROM `private_tour` WHERE `user_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function count_request_quotes($id){
			$sql = "SELECT COUNT(`private_tour_id`) AS count FROM `private_tour`
			WHERE `user_id`= ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_private_trip_by_id($id){
			$sql = "SELECT * FROM `private_tour`
			WHERE `private_tour_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}


		//=================================DELETE================================
		function remove_private_tour_request($id){
			$sql = "DELETE FROM `private_tour` WHERE `private_tour_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_query();
		}


	}
	?>