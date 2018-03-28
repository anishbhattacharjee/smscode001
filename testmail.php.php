<?php

// ...

// make sure you get these SMTP settings right
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl") 
    ->setUsername('anishbhattacharjee@gmail.com')
    ->setPassword('anish@dgp');

$mailer = Swift_Mailer::newInstance($transport);
// the message itself
$message = Swift_Message::newInstance('email subject')
    ->setFrom(array('anishbhattacharjee@gmail.com' => 'no reply'))
    ->setTo(array('anishjiodgp@gmail.com'))
    ->setBody("email body");

$result = $mailer->send($message);



?>