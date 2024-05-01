<?php
	require_once(__DIR__."/../utils/core.php");
	require_once(__DIR__."/../utils/db_prepared.php");


	class public_class extends db_prepared{

		function email_signup($name,$email,$password){
			$sql = "SELECT email_signup(?,?,?);";
			$this->prepare($sql);
			$this->bind($name,$email,$password);
			return $this->db_fetch_one();
		}

		function provider_signup($provider,$name,$id,$email){
			$sql = "SELECT provider_signup(?,?,?,?) as user_id;";
			$this->prepare($sql);
			$this->bind($provider,$name,$id,$email);
			return $this->db_fetch_one();
		}

		function email_login($email,$password){
			$sql = "SELECT  user_id from vw_users where email = ? and password_hash = ?";
			$this->prepare($sql);
			$this->bind($email,$password);
			return $this->db_fetch_one();
		}

		function provider_login($provider_col,$provider_id){
			$sql = "SELECT user_id FROM vw_users WHERE `$provider_col` = ?";
			$this->prepare($sql);
			$this->bind($provider_id);
			return $this->db_fetch_one();
		}

		function create_itinerary($user_id,$num_people,$status){
			$sql = "SELECT create_itinerary(?,?,?) AS itinerary_id";;
			$this->prepare($sql);
			$this->bind($user_id,$num_people,$status);
			return $this->db_fetch_one();
		}

		function add_itinerary_day($itinerary_id){
			$sql = "SELECT add_itinerary_day(?) as day_id";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_one($sql);
		}


		function add_itinerary_destination($day_id,$destination_id){
			$sql = "SELECT add_itinerary_destination(?,?)";;
			$this->prepare($sql);
			$this->bind($day_id,$destination_id);
			return $this->db_fetch_one();
		}

		function add_itinerary_activity($day_id,$activity_id,$destination_id){
			$sql = "SELECT add_itinerary_activity(?,?,?)";
			$this->prepare($sql);
			$this->bind($day_id,$activity_id,$destination_id);
			return $this->db_fetch_one();
		}

		function get_destinations_by_name($name){
			$sql = "SELECT * FROM destinations ";
			if($name){
				$sql .=" where destination_name like ? ";
			}
			$this->prepare($sql);

			if($name){
				$this->bind("%$name%");
			}
			return $this->db_fetch_all();
		}

		function get_destination_by_id($id){
			$sql = "SELECT * FROM destinations where destination_id = ?";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_user_itineraries($user_id){
			$sql = "SELECT * FROM itineraries where owner_id = ?";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_all();
		}

		function get_user_info($user_id){
			$sql = "SELECT * FROM vw_users where user_id = ?";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_one();
		}

		function get_destinations(){
			$sql = "CALL get_destinations()";
			$this->prepare($sql);
			return $this->db_fetch_all();
		}

		function get_destination_activities($destination_id){
			$sql = "CALL get_destination_activities(?)";
			$this->prepare($sql);
			$this->bind($destination_id);
			return $this->db_fetch_all();
		}

		function get_destination_utilities($destination_id){
			$sql = "CALL get_destination_utilities(?)";
			$this->prepare($sql);
			$this->bind($destination_id);
			return $this->db_fetch_all();
		}

		function get_destination_type($destination_id){
			$sql = "CALL get_destination_type(?)";
			$this->prepare($sql);
			$this->bind($destination_id);
			return $this->db_fetch_all();
		}

		function get_itineraries($user_id){
			$sql = "CALL get_itineraries(?)";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_all();
		}

		function get_itinerary_collaborators($itinerary_id){
			$sql = "CALL get_itinerary_collaborators(?)";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_all();
		}

		// function get_itinerary_day_info($day_id){
		// 	$sql = "CALL get_itinerary_day_info(?);";
		// 	$this->prepare($sql);
		// 	$this->bind($day_id);
		// 	return $this->db_fetch_all();
		// }

		function get_itinerary_day_activities($day_id){
			$sql = "CALL get_itinerary_day_activities(?)";
			$this->prepare($sql);
			$this->bind($day_id);
			return $this->db_fetch_all();
		}

		function get_itinerary_day_destinations($day_id){
			$sql = "CALL get_itinerary_day_destinations(?)";
			$this->prepare($sql);
			$this->bind($day_id);
			return $this->db_fetch_all();
		}

		function get_itinerary_by_id($id){
			$sql = "CALL get_itinerary_by_id(?)";
			$this->prepare($sql);
			$this->bind($id);
			return $this->db_fetch_one();
		}

		function get_itinerary_days($itinerary_id){
			$sql = "CALL get_itinerary_days(?)";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_all();
		}

		function get_day_destination_activities($destination_id,$day_id){
			$sql = "CALL get_day_destination_activities(?,?)";
			$this->prepare($sql);
			$this->bind($destination_id,$day_id);
			return $this->db_fetch_all();
		}


		function update_itinerary_name($id,$name){
			$sql = "SELECT update_itinerary_name(?,?)";
			$this->prepare($sql);
			$this->bind($id,$name);
			return $this->db_query();
		}

		function get_itinerary_activities($itinerary_id){
			$sql = "CALL get_itinerary_activities(?)";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_all();
		}


		function duplicate_itinerary($itinerary_id,$user_id){
			$sql = "SELECT duplicate_itinerary(?,?) as itinerary_id;";
			$this->prepare($sql);
			$this->bind($itinerary_id,$user_id);
			// echo $itinerary_id ." ". $user_id;

			return $this->db_fetch_one();
		}

		function toggle_itinerary_wishlist($user_id,$itinerary_id){
			$sql = "SELECT toggle_itinerary_wishlist(?,?) AS added";
			$this->prepare($sql);
			$this->bind($user_id,$itinerary_id);
			return $this->db_fetch_one();
		}

		function add_destination_request($query,$user_id){
			$sql = "SELECT add_destination_request(?,?);";
			$this->prepare($sql);
			$this->bind($query,$user_id);
			return $this->db_fetch_one();
		}

		function create_itinerary_invoice($itinerary_id,$people_count){
			$sql = "SELECT create_itinerary_invoice(?,?)";
			$this->prepare($sql);
			 $this->bind($itinerary_id, $people_count);
			return $this->db_fetch_one();
		}

		function make_invoice_payment($invoice_id, $provider_transaction_id,$user_id,$purpose,$transaction_amount,$amount,$tax,$charges,$provider){
			$sql = "CALL make_invoice_payment(?,?,?,?,?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($invoice_id,$provider_transaction_id,$user_id,$purpose,$transaction_amount,$amount,$tax,$charges,$provider);
			return $this->db_fetch_one();
		}

		function get_invoice($invoice_id){
			$sql = "CALL  get_invoice(?)";
			$this->prepare($sql);
			$this->bind($invoice_id);
			return $this->db_fetch_one();
		}

		function get_itinerary_invoices($itinerary_id){
			$sql = "CALL get_itinerary_invoices(?)";
			$this->prepare($sql);
			$this->bind($itinerary_id);
			return $this->db_fetch_all();
		}

		function get_invoice_by_id($invoice_id){
			$sql = "CALL get_invoice_by_id(?)";
			$this->prepare($sql);
			$this->bind($invoice_id);
			return $this->db_fetch_one();
		}

		function get_invoice_activities($invoice_id){
			$sql = "CALL get_invoice_activities(?)";
			$this->prepare($sql);
			$this->bind($invoice_id);
			return $this->db_fetch_all();
		}

		function set_itinerary_visibility($itinerary_id,$visibility){
			$sql = "CALL set_itinerary_visibility(?,?)";
			$this->prepare($sql);
			$this->bind($itinerary_id,$visibility);
			return $this->db_query();
		}

		function set_itinerary_day_date($day_id, $date){
			$sql = "CALL set_itinerary_day_date(?,?)";
			$this->prepare($sql);
			$this->bind($day_id,$date);
			return $this->db_query();
		}

		function create_curator($name,$email,$password,$number,$account_number,$curator_name,$bank_number,$bank_name,$account_name,$subaccount_id,$logo_location,$logo_type,$reg_doc_location,$reg_doc_type){
			$sql = "SELECT create_curator(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($name,$email,$password,$number,$curator_name,$bank_number,$bank_name,$account_number,$account_name,$subaccount_id,$logo_location,$logo_type,$reg_doc_location,$reg_doc_type);
			return $this->db_fetch_one();
		}

		function get_curator_account_by_user_id($user_id){
			$sql = "CALL get_curator_account_by_user_id(?)";
			$this->prepare($sql);
			$this->bind($user_id);
			return $this->db_fetch_one();
		}

		function get_curator_listings($curator_id){
			$sql = 'CALL get_curator_listings(?)';
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_bookings($curator_id){
			$sql = "CALL get_curator_bookings(?)";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function get_curator_collaborators($curator_id){
			$sql = "CALL get_curator_collaborators(?)";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_all();
		}

		function create_shared_experience($itinerary_id,$name,$curator_id,$currency,$fee,$seats){
			$sql = "SELECT create_shared_experience(?,?,?,?,?,?) as experience_id";
			$this->prepare($sql);
			$this->bind($itinerary_id,$curator_id,$name,$currency,$fee,$seats);
			return $this->db_fetch_one();
		}

		function get_shared_experiences($show_all){
			$sql = "CALL get_shared_experiences(?)";
			$this->prepare($sql);
			$this->bind($show_all ? 1 :0);
			return $this->db_fetch_all();
		}

		function get_shared_experience_by_id($experience_id){
			$sql = "CALL get_shared_experience_by_id(?)";
			$this->prepare($sql);
			$this->bind($experience_id);
			return $this->db_fetch_one();
		}

		function get_shared_experience_destinations($experience_id){
			$sql = "CALL get_shared_experience_destinations(?)";
			$this->prepare($sql);
			$this->bind($experience_id);
			return $this->db_fetch_all();
		}

		function get_shared_experience_activities($experience_id){
			$sql = "CALL get_shared_experience_activities(?)";
			$this->prepare($sql);
			$this->bind($experience_id);
			return $this->db_fetch_all();
		}

		function toggle_experience_wishlist($user_id,$experience_id){
			$sql = "SELECT toggle_experience_wishlist(?,?) AS added";
			$this->prepare($sql);
			$this->bind($user_id,$experience_id);
			return $this->db_fetch_one();
		}

		function get_curator_payout_account($curator_id){
			$sql = "CALL get_curator_payout_account(?)";
			$this->prepare($sql);
			$this->bind($curator_id);
			return $this->db_fetch_one();
		}

		function make_experience_payment($experience_id, $seats,$provider_transaction_id,$user_id,$description,$transaction_amount,$amount,$tax,$provider_charges,$provider){
			$sql = "CALL make_experience_payment(?,?,?,?,?,?,?,?,?,?) as transaction_id";
			$this->prepare($sql);
			$this->bind($experience_id, $seats,$provider_transaction_id,$user_id,$description,$transaction_amount,$amount,$tax,$provider_charges,$provider);
			return $this->db_fetch_one();
		}

		function curator_media_upload($curator_id,$media_location,$media_type,$is_foreign){
			$sql = "SELECT curator_upload(?,?,?,?) as media_id";
			$this->prepare($sql);
			$this->bind($curator_id,$media_location,$media_type,$is_foreign);
			return $this->db_fetch_one();
		}

		function  upload_curator_identification($email,$front_location,$front_type,$back_location,$back_type){
			$sql = "CALL upload_curator_identification(?,?,?,?,?)";
			$this->prepare($sql);
			$this->bind($email,$front_location,$front_type,$back_location,$back_type);
			return $this->db_fetch_one();
		}

	}
?>