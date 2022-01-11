<?php


namespace App\Services;


use App\Exceptions\SMSException;

interface SMSServiceInterface
{
    /**
     * send otp to user and store in db async
     * @param $text
     * @param $receiver
     * @param $gateway
     * @return bool
     * @throws SMSException
     */
    public function send($text, $receiver, $gateway);

    /**
     * @return mixed
     */
    public function get();
}
