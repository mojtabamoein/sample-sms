<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class SmsRepository implements SmsRepositoryInterface
{

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

    public function get(){
        return DB::table('messages')->latest()->paginate();
    }
}
