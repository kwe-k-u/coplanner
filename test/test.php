<?php
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__."/../utils/paystack.php");

$pay = new paystack_custom();
$e = $pay->verify_transaction($_GET["id"]);
send_json($e);
?>
