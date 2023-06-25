<?php
require_once(__DIR__. "/../utils/db_prepared.php");


	class private_tour_class extends db_prepared{

		//===============================INSERT==========================================

		function create_private_tour($id, $user, $currency,$min_bug,$max_bug,
		$start,$end,$state, $count){
			$sql = "INSERT INTO `private_tour`
			(`private_tour_id`,`user_id`,`currency`,`min_budget`,
			`max_budget`,`date_start`,`date_end`,`publish_state`, `person_count`)
			VALUE (?,?,?,?,?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($id,$user,$currency,$min_bug,$max_bug,$start,$end,$state,$count);
			return $this->db_query();
		}

		function create_private_tour_custom($tour_id,$description){
			$sql = "INSERT INTO `private_tour_custom` VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($tour_id,$description);
			return $this->db_query();
		}

		function create_private_tour_campaign($tour_id,$c_id){
			$sql = "INSERT INTO `private_tour_campaign` VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($tour_id,$c_id);
			return $this->db_query();
		}

		function edit_private_tour_request($id, $currency,$min_bug,$max_bug,
		$start,$end,$state, $count){
			$sql = "UPDATE `private_tour` SET `currency` = ?, `date_start`=?, `date_end` = ?,
			`person_count`=?, `publish_state` = ?, `max_budget`=?, `min_budget` = ?
			WHERE `private_tour_id`=?";
			$this->prepare($sql);
			$this->bind($currency,$start,$end,$count,$state,$max_bug,$min_bug,$id);
			return $this->db_query();
		}

		function edit_private_tour_description($id,$desc){
			$sql = "UPDATE `private_tour_custom` SET `description` = ? WHERE `private_tour_id` = ?";
			$this->prepare($sql);
			$this->bind($desc,$id);
			return $this->db_query();
		}


		function place_tour_request_bid($bid_id,$curator,$request,$comment,$currency,$fee){
			$sql = "INSERT INTO `private_tour_quote` (`quote_id`, `curator_id`, `private_tour_id`, `currency`,`fee`, `comments`)
			VALUE (?,?,?,?,?, ?)";
			$this->prepare($sql);
			$this->bind($bid_id,$curator,$request,$currency,$fee,$comment);
			return $this->db_query();
		}


		function invoice_private_tour($invoice_id,$tour_id,$transaction_id,$transaction_date){
			$sql = "INSERT INTO `private_tour_invoice`(`invoice_id`, `private_tour`, `transaction_id`, `date_generated`)
			VALUES (?,?,?,?)";
			$this->prepare($sql);
			$this->bind($invoice_id,$tour_id,$transaction_id,$transaction_date);
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

		function get_user_private_trip_requests_custom($id){
			$sql = "SELECT private_tour.*, pc.description FROM `private_tour`
			JOIN private_tour_custom AS pc on pc.private_tour_id = private_tour.private_tour_id
			 WHERE `user_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function get_user_private_trip_requests_campaign($id){
			$sql = "SELECT * FROM `private_tour`
			JOIN private_tour_campaign AS pc on pc.private_tour_id = private_tour.private_tour_id
			 WHERE `user_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_all();
		}

		function count_request_quotes($id){
			$sql = "SELECT COUNT(`private_tour_id`) AS count FROM `private_tour_quote`
			WHERE `private_tour_id`= ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_custom_private_tour_by_id($id){
			$sql = "SELECT * FROM `private_tour`
			JOIN private_tour_custom AS pc on pc.private_tour_id = private_tour.private_tour_id
			WHERE pc.private_tour_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_campaign_private_tour_by_id($id){
			$sql = "SELECT * FROM `private_tour`
			JOIN private_tour_campaign AS pc on pc.private_tour_id = private_tour.private_tour_id
			WHERE pc.private_tour_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}


		function get_private_tour_quote($quote_id){
			$sql = "SELECT * FROM private_tour_quote where quote_id = ?";
			$this->prepare($sql);
			$this->bind($quote_id);
			return $this->db_fetch_one();
		}


		//=================================UPDATE================================

		function reject_private_tour_quote($quote_id){
			$sql = "UPDATE private_tour_quote SET status = 'rejected'
			WHERE quote_id = ?";

			$this->prepare($sql);
			$this->bind($quote_id);
			return $this->db_query();
		}

		function reject_all_private_tour_quotes($tour_id){
			$sql = "UPDATE private_tour_quote SET status = 'rejected'
			WHERE private_tour_id = ?";

			$this->prepare($sql);
			$this->bind($tour_id);
			return $this->db_query();
		}





		function accept_private_tour_quote($quote_id){
			$sql = "UPDATE private_tour_quote SET status = 'accepted'
			WHERE quote_id = ?";

			$this->prepare($sql);
			$this->bind($quote_id);
			return $this->db_query();
		}




		//=================================DELETE================================
		function remove_private_tour_request($id){
			$sql = "DELETE FROM `private_tour` WHERE `private_tour_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_query();
		}

		function remove_custom_private_tour_request($id){
			$sql = "DELETE FROM `private_tour_custom` WHERE `private_tour_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_query();
		}

		function remove_campaign_private_tour_request($id){
			$sql = "DELETE FROM `private_tour_campaign` WHERE `private_tour_id` = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_query();
		}


	}
	?>