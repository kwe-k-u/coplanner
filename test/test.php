<?php


require_once(__DIR__."/../utils/env_manager.php");
require_once(__DIR__."/../utils/core.php");
require_once(__DIR__."/../utils/whatsapp.php");


$whatsapp = new whatsapp();
$number = "";
$path = "/C:/Users\KWAKU/Desktop/f436e56e8930e12fd351fd70704456d8.jpg";
$image_id = "2975368219270320";//"765483915575164";

// $response = $whatsapp->send_message("$number","Over here we don't do dm for price. easyGo has you sorted for all your stuff. Just say Hola Amigos. I'm just seeing how my code handles apostrophes. You know! JSON and it's problems. Should be an odd number by now. Okay bye. I'm not testing the 4k character limit. Bye now. I promise. Oh wait I'll post on whatsapp so hey you! Visit easygo.com.gh. Okay bye" );
// $response = $whatsapp->send_template("$number","hello_world");
// $response = $whatsapp->send_interactive($number,array("type"=> "image","image"=> array("id"=>"$image_id")),"Hey! easyGo has a new trip on the website. You can start booking right in whatsapp. Also Kweku's programming skills are mad crazy no? (Shameless self promotion). Anyway, we realised people don't always want to be told to check stuff out on a website so we brought the website to you. Zero hassle for you, because we care. Nobody does this especially in Ghana. That's why easyGo exists. Travelling should be easy.","Interactive by easyGo", [array("type"=> "reply", "reply"=>array("id"=>"first","title"=> "Book my seat")),array("type"=> "reply", "reply"=>array("id"=>"second","title"=> "Share With friends"))]);
// $response = $whatsapp->request_location($number,"Hey! You can share the GPS of the pickup location to the people joining you on your trip");
// $response = $whatsapp->upload_media($path);
// $response = $whatsapp->send_url($number,"Sign up with easyGo","Hey, just a test but you can list tours on easyGo and get communications done over whatsapp","https://www.easygo.com.gh","Visit the website","interactive by easyGo");
// $response = $whatsapp->send_location($number,"Accra somewhere",5.740631095457212, -0.17661502474514665);
// $response = $whatsapp->send_contact($number,"Kweku Boss",$number,"easyGo Tours Ltd","https://www.easygo.com.gh");

var_dump($response);
?>