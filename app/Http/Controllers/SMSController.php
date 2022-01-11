<?php

namespace App\Http\Controllers;

use App\Exceptions\SMSException;
use App\Http\Requests\SMSSendRequest;
use App\Jobs\SendSMSJob;
use App\Services\SMSServiceInterface;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    private SMSServiceInterface $smsService;

    public function __construct(SMSServiceInterface $SMSService)
    {
        $this->smsService = $SMSService;
    }

    public function send(SMSSendRequest $request)
    {
        $receiver      = $request->receiver;
        $text          = $request->text;
        $gateway       = $request->gateway;
        try{
            $this->smsService->send($text, $receiver, $gateway);
        }
        catch (SMSException $SMSException){
            return [
                'success'=> false,
                'message'=> $SMSException->getMessage()
            ];
        }
        return [
            'success'=> true,
        ];
    }

    public function index(){
        $result = $this->smsService->get();
        return [
            'success'=>true,
            'data'=>$result
        ];

    }
}
