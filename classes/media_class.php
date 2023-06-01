<?php
	require_once(__DIR__. "/../utils/db_prepared.php");


	class media_class extends db_prepared{

	//========================== INSERT ==================================
	function get_media_by_id($id){
		$sql = "SELECT * FROM `media` where `media_id` = ?";
		$this->prepare($sql);
		$this->bind($id);
		return $this->db_fetch_one();
	}


	//========================== INSERT ==================================
		function add_media_cls($media_id, $location, $type){
			$sql = "INSERT INTO `media`(`media_id`, `media_location`, `media_type`)
			VALUE (?,?,?)";
			$this->prepare($sql);
			$this->bind($media_id,$location,$type);
			return $this->db_query();
		}



		function link_media_cls($column_value, $media_id, $table_name = 'user_uploads',$column_name = "user_id"){
			$sql = "INSERT INTO `$table_name` (`$column_name`, `media_id`)
			VALUE (?,?)";
			$this->prepare($sql);
			$this->bind($column_value,$media_id);
			return $this->db_query();
		}






	//============================== UPDATE ==================================
		function link_curator_id($user_id,$front_id,$back_id){
			$sql = "UPDATE `curator_manager` SET `id_front` = ?, `id_back`=?
			WHERE `user_id`='$user_id'";
			$this->prepare($sql);
			$this->bind($front_id,$back_id);
			return $this->db_query();
		}

		function update_curator_logo($curator_id,$media_id){
			$sql = "UPDATE `curators` SET `curator_logo` = ?
			WHERE `curator_id`= ?";
			$this->prepare($sql);
			$this->bind($media_id,$curator_id);
			return $this->db_query();
		}

		function update_curator_inc_doc($curator_id,$media_id){
			$sql = "UPDATE `curators` SET `curator_inc_doc` = ?
			WHERE `curator_id`= ?";
			$this->prepare($sql);
			$this->bind($media_id,$curator_id);
			return $this->db_query();
		}

		function update_profile_image($user_id,$media_id){
			$sql = "UPDATE `users` SET `profile_image` = ?
			WHERE `user_id`= ?";
			$this->prepare($sql);
			$this->bind($media_id,$user_id);
			return $this->db_query();
		}

		function link_toursite_media($media_id,$toursite_id,$location,$is_foreign){
			$sql = "INSERT INTO `toursite` (`media_id`,`toursite_id`,`location`,`is_foreign`)
			VALUE (?,?,?,?)";
			$this->prepare($sql);
			$this->bind($media_id,$toursite_id,$location,$is_foreign);
			return $this->db_query();
		}




	//============================== DELETE ==================================
		function remove_media_cls($media_id){
			$sql = "DELETE FROM `media` WHERE `media_id` = ?";
			$this->prepare($sql);
			$this->bind($media_id);
			return $this->db_query();
		}

		function unlink_media_cls($column_name,$table_name,$column_value, $media_id){
			$sql = "DELETE FROM `$table_name` WHERE `$column_name` = ? AND `media_id` = ?";
			$this->prepare($sql);
			$this->bind($column_value,$media_id);
			return $this->db_query($sql);
		}
	}
?>