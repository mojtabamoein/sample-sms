<?php


namespace App\Repositories;


interface SmsRepositoryInterface
{
    public function store($gateway, $text, $receiver, $status_code, $status_text, $extra_information);
    public function get();
}
