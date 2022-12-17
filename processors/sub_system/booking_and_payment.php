<?php
	require_once(__DIR__. "/../../controllers/campaign_controller.php");
	require_once(__DIR__. "/../../utils/core.php");
	require_once(__DIR__."/../../utils/paybox.php");



	function transactions(){
		echo "transactions";
		$request = $_SERVER["REQUEST_METHOD"];
		if ($request == "POST"){
			if(!isset($_POST["action"])){
				echo " <action> required";
				die();
			}

			switch($_POST["action"]){
				case "trip_payment":
					$paybox = new paybox_custom();
					$mode

					//create booking

					//issue payment

					die();
				default:
					echo "No implementation for <". $_POST["action"] .">";
					die();
			}
		}else if ($request == "GET"){

		}
	}


	transactions();
?>