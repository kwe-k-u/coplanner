<?php
	require_once(__DIR__."/../utils/db_class.php");

	class newsletter_class extends db_connection{

		function add_subscriber($email){
			$sql = "INSERT INTO `newsletter_subscriptions` (`email`)
			VALUE ('$email')";
			return $this->db_query($sql);
		}

		function get_subscribers(){
			$sql = "SELECT * FROM `newsletter_subscriptions`";
			return $this->db_fetch_all($sql);
		}

		function clear_subscribers(){
			$sql = "DELETE * FROM `newsletter_subscriptions` WHERE 1";
			return $this->db_query($sql);
		}
	}
?>