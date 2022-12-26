<?php
	require(__DIR__. "/../utils/db_class.php");


	class media_class extends db_connection{


	//========================== INSERT ==================================
		function add_media_cls($media_id, $location, $type){
			$sql = "INSERT INTO `media`(`media_id`, `media_location`, `media_type`)
			VALUE ('$media_id', '$location', '$type')";
			// return $sql;
			return $this->db_query($sql);
		}



		function link_media_cls($column_value, $media_id, $table_name = 'user_uploads',$column_name = "user_id"){
			$sql = "INSERT INTO `$table_name` (`$column_name`, `media_id`)
			VALUE ('$column_value', '$media_id')";
			return $this->db_query($sql);
		}





	//============================== UPDATE ==================================
		function link_curator_id($user_id,$front_id,$back_id){
			$sql = "UPDATE `curator_manager` SET `id_front` = '$front_id', `id_back`='$back_id'
			WHERE `user_id`='$user_id'";
			return $this->db_query($sql);
		}

		function update_curator_logo($curator_id,$media_id){
			$sql = "UPDATE `curators` SET `curator_logo` = '$media_id'
			WHERE `curator_id`= '$curator_id'";
			return $this->db_query($sql);
		}




	//============================== DELETE ==================================
		function remove_media_cls($media_id){
			$sql = "DELETE FROM `media` WHERE `media_id` = '$media_id'";
			return $this->db_query($sql);
		}

		function unlink_media_cls($column_name,$table_name,$column_value, $media_id){
			$sql = "DELETE FROM `$table_name` WHERE `$column_name` = '$column_value' AND `media_id` = '$media_id'";
			return $this->db_query($sql);
		}
	}
?>