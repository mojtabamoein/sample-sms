<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class SmsRepository implements SmsRepositoryInterface
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
    public function store($gateway, $text, $receiver, $status_code, $status_text, $extra_information)
    {
        return DB::table('messages')
            ->insert([
                "gateway"          => $gateway,
                "text"             => $text,
                "receiver"         => $receiver,
                "status_code"      => $status_code,
                "status_text"      => $status_text,
                "extra_information"=> $extra_information,
                "created_at"       => now()
            ]);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function get(){
        return DB::table('messages')->latest()->paginate();
    }
}
