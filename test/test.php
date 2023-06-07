<?php
require_once(__DIR__."/../utils/http_handler.php");
var_dump($_REQUEST);
die();
$http = new http_handler();
$response = $http->post(
	"http://localhost/easygo_v2/processors/processor.php",
	array(
		"action" => "verify_payment",
		"response" => "{'reference': '482300948'}",
		"provider" => "paystack",
		"amount_expected" => 3,
		"currency_expected" => "GHS"
	)
);

var_dump($response);
?>
