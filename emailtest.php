<?php
$to = "waqas@ctechsols.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: waqas@ctechsols.com" . "\r\n";

$q = mail($to,$subject,$txt,$headers);
var_dump($q);
?>