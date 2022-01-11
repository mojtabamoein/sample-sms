<?php


namespace App\SMS\Drivers;


use App\Exceptions\SMSException;
use App\Repositories\SmsRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Ghasedak implements SMSDriverInterface
{
    private SmsRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = resolve(SmsRepositoryInterface::class);
    }

    /**
     * validate required parameters in config
     * @param $config
     * @throws SMSException
     */
    public function validateConfiguration($config){
        if (!isset($config['api_key']))
            throw new SMSException("api_key is not defined");
        if (!isset($config['line_number']))
            throw new SMSException("line_number is required for this gateway");
    }

    /**
     * @param $text
     * @param $receiver
     * @param $configuration
     * @throws SMSException
     */
    function send($text, $receiver, $configuration)
    {
        $this->validateConfiguration($configuration);
        $api_key     = $configuration['api_key'];
        $line_number = $configuration['line_number'];

        $statusCode = null;
        $statusText = null;
        $extraInformation = null;

        Http::fake([
            'https://api.ghasedak.me/*' => Http::response([
              'result'=>['code'=>200,'message'=>'success'],
              'items'=> [2578793735]
            ],200)
        ]);
        $response = Http::asForm()
            ->withHeaders([
                "apikey"=> $api_key
            ])
            ->post("https://api.ghasedak.me/v2/sms/send/simple",
            [
                "linenumber" => $line_number,
                "message"    => $text,
                "receptor"   => $receiver
            ]
        );

        try{
            $result = json_decode($response->body());
            $statusCode = $result->result->code;
            $statusText = $result->result->message;
            $extraInformation = json_encode($result->items);
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
        $this->repository->store($this->getGatewayName(),$text,$receiver,$statusCode,$statusText,$extraInformation);

    }

    function getGatewayName()
    {
        return "ghasedak";
    }
}
