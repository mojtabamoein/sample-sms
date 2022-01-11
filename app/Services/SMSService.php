<?php


namespace App\Services;


use App\Exceptions\SMSException;
use App\Jobs\SendSMSJob;
use App\Repositories\SmsRepositoryInterface;

class SMSService implements SMSServiceInterface
{
    private SmsRepositoryInterface $smsRepository;

    public function __construct(SmsRepositoryInterface $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    public function send($text, $receiver, $gateway){

        $gateway = strtolower($gateway);
        $configuration = config("sms.$gateway");
        if(!is_array($configuration))
            throw new SMSException("the gateway configuration is invalid");
        $map_driver = $configuration['driver'];
        SendSMSJob::dispatch($map_driver, $receiver, $text, $configuration);
        return true;
    }

    public function get(){
        return $this->smsRepository->get();
    }
}
