<?php



	class db_prepared{

		public $db;
		public $statement;


		function __construct(){
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$this->db = mysqli_connect("localhost","root","e1fc6f22e5b47bcf7e8636dc7a4143a15f4071b748eecf42","easy_coplanner");
		}

		function __destruct()
		{
			$this->db->close();
		}

		function prepare($sql){
			$this->statement = mysqli_prepare($this->db, $sql);
		}

		function bind(...$data){
			$types = "";
			foreach ($data as $value) {
				$types .= $this->get_type($value);
			}
			// echo "types $types";
			// var_dump($data);
			// var_dump(...$data);
			mysqli_stmt_bind_param($this->statement, $types, ...$data);
		}

		private function get_type($value){
			if(is_float($value)){
				return "d";
			}elseif(is_integer($value)){
				return "i";
			}elseif(is_string($value)){
				return "s";
			}else{
				return "b";
			}
		}


		function db_query(){
			/* execute query */

			/* bind result variables */
			// mysqli_stmt_bind_result($this->statement, $result);
			return $this->statement->execute();

			/* fetch value */
			return $this->statement->get_result();

		}

		function db_fetch_all(){
			$result = array();
			/* execute query */
			$this->statement->execute();

			/* bind result variables */
			// mysqli_stmt_bind_result($this->statement, $result);

			/* fetch value */
			$res = mysqli_stmt_get_result($this->statement);

			 while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
				$count = count($result);
				$result[$count] = $row;
			 }
			 return $result;
			// return $this->statement->get_result();

		}

		function db_fetch_one(){
			/* execute query */
			$this->statement->execute();

			/* bind result variables */
			// mysqli_stmt_bind_result($this->statement, $result);

			$result = $this->statement->get_result()->fetch_assoc();


			/* fetch value */
			return $result;

		}


	}



?>