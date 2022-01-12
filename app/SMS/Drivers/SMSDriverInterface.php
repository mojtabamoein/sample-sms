<?php


namespace App\SMS\Drivers;


interface SMSDriverInterface
{
    function getGatewayName();
    function send($text, $receiver, $configuration);
    public function validateConfiguration($config);
}
