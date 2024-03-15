<?php


require_once("../utils/paystack.php");

$paystack = new paystack_custom();

$result = $paystack->get_banks();
var_dump($result);
?>