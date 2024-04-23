<?php

namespace Domain\Auth\Services;

use App\Api\Auth\Jobs\SendOtpWithSms;

class SendSmsService
{
    public function send($sendSmsDto): void
    {
        SendOtpWithSms::dispatch($sendSmsDto);
    }
}
