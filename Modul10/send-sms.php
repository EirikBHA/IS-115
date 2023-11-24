<?php

require "vendor/autoload.php";

$basic  = new \Vonage\Client\Credentials\Basic("8a76bb2b", "ih73SJxaPvMt4xM1");
$client = new \Vonage\Client($basic);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("4740169137", "Kruse Knallkul", 'Ur gay')
);

$message = $response->current();

if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}