<?php

namespace App\Jobs;

use App\SMS\Drivers\SMSDriverInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SMSDriverInterface $driver;
    private string $text;
    private string $receiver;
    private array $configuration;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $driver, string $receiver, string $text, array $configuration)
    {
        $this->driver        = new $driver();
        $this->text          = $text;
        $this->receiver      = $receiver;
        $this->configuration = $configuration;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->driver->send($this->text, $this->receiver, $this->configuration);
    }
}
