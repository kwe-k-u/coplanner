<?php
require_once(__DIR__."/../utils/mailer/mailer_class.php");

$mailer = new mailer();

$res = $mailer->email_verification("kwekuaacquaye@gmail.com","");
var_dump($res);
?>
