<?php

namespace App\Http\Controllers\Api;

use App\Enum\ApiResponseCode;
use App\Exceptions\SMSException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SMSSendRequest;
use App\Jobs\SendSMSJob;
use App\Services\SMSServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    use ApiResponse;
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
            return $this->error(ApiResponseCode::SERVER_ERROR,$SMSException->getMessage());
        }
        return $this->success(null,'Message sent successfully');
    }

    public function index(){
        $result = $this->smsService->get();
        return $this->success($result);
    }
}
