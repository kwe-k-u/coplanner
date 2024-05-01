<?php
	if(!isset($_SERVER["PATH_INFO"]) || $_SERVER["PATH_INFO"] == "travel_plan"){
		header("Location: travel_plan/");
	}else{
		header("Location: shared_experience/");
	}
?>