<?php


namespace App\SMS\Drivers;


use App\Exceptions\SMSException;
use App\Repositories\SmsRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Kavenegar implements SMSDriverInterface
{
    private SmsRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = resolve(SmsRepositoryInterface::class);
    }

    function getGatewayName(){
        return 'kavenegar';
    }

    public function validateConfiguration($config){
        if (!isset($config['api_key']))
            throw new SMSException("api_key is not defined");
    }
    function send($text, $receiver, $configuration)
    {
        $this->validateConfiguration($configuration);
        $api_key     = $configuration['api_key'];
        $line_number = $configuration['line_number']??null;

        $statusCode = null;
        $statusText = null;
        $extraInformation = null;
        $url = "https://api.kavenegar.com/v1/$api_key/sms/send.json?receptor=$receiver&message=$text";
        if(isset($line_number)&& $line_number != '')
            $url.="&sender=$line_number";
        $response = Http::post($url);
        try{
            $result = json_decode($response->body());
            $statusCode = $result->return->status;
            $statusText = $result->return->message;
            $extraInformation = json_encode($result->entries);
        }
        catch (\Exception $exception){
            Log::error("error store otp for mobile number",[
                'exception_message'  => $exception->getMessage(),
                'mobile_number'      => $receiver,
                'text'               => $text,
                'status_code'        => $statusCode,
                'status_text'        => $statusText,
                'response'           => $response,
            ]);
        }

        return $this->repository->store($this->getGatewayName(),$text,$receiver,$statusCode,$statusText,$extraInformation);
    }
}
