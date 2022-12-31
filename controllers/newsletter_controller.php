<?php
	require_once(__DIR__."/../classes/newsletter_class.php");


	function add_subscriber($email){
		$news = new newsletter_class();
		return $news->add_subscriber($email);
	}


	function get_subscribers(){
		$news = new newsletter_class();
		return $news->get_subscribers();
	}


	function clear_subscribers(){
		$news = new newsletter_class();
		return $news->clear_subscribers();
	}

?>