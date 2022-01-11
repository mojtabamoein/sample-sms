<?php


namespace App\Services;


interface SMSServiceInterface
{
    public function send($text, $receiver, $gateway);

    public function get();
}
