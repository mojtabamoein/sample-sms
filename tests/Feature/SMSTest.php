<?php

namespace Tests\Feature;

use App\Services\SMSServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SMSTest extends TestCase
{
    private $config;
    private SMSServiceInterface $smsService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->config = config('sms.kavenegar');
        $this->smsService = resolve(SMSServiceInterface::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_send_sms()
    {
        Http::fake([
            'https://api.kavenegar.com/*'=>Http::response([
                'return' => ['message'=>'تایید شد','status'=>200]
            ],200)
        ]);
        $result = $this->smsService->send("test",'99999999999',"kavenegar");
        return $this->assertTrue($result);
    }
}
