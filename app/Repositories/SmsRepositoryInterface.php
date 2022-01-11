<?php


namespace App\Repositories;


interface SmsRepositoryInterface
{
    /**
     * @param $gateway
     * @param $text
     * @param $receiver
     * @param $status_code
     * @param $status_text
     * @param $extra_information
     * @return boolean
     */
    public function store($gateway, $text, $receiver, $status_code, $status_text, $extra_information);

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function get();
}
