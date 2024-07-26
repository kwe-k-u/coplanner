<?php
require_once("../utils/http_handler.php");
require_once("../utils/paystack.php");
require_once("../utils/mixpanel.php");
require_once(__DIR__ . "/../utils/core.php");


// $pay = new paystack_custom();
// $account = $pay->get_payout_account("");

// send_json($account);
$mix = new mixpanel_class();
$d = $mix->export_data("","2024-01-01","2024-07-25");
echo $d;
//TODO
// var_dump($d);
die();