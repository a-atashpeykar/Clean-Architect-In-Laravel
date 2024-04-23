<?php

namespace Domain\Auth\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOtpWithSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sendSmsDto;
    public function __construct($sendSmsDto)
    {
        $this->sendSmsDto = $sendSmsDto;
    }

    public function handle(): void
    {
        echo 'sms is sent';
    }
}
