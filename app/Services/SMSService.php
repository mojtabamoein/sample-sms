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

    /**
     * send otp to user and store in db async
     * @param $text
     * @param $receiver
     * @param $gateway
     * @return bool
     * @throws SMSException
     */
    public function send($text, $receiver, $gateway):bool {

        $gateway = strtolower($gateway);
        $configuration = config("sms.$gateway");
        if(!is_array($configuration))
            throw new SMSException("the gateway configuration is invalid");
        $map_driver = $configuration['driver'];
        SendSMSJob::dispatch($map_driver, $receiver, $text, $configuration);
        return true;
    }

    /**
     * @return mixed
     */
    public function get(){
        return $this->smsRepository->get();
    }
}
