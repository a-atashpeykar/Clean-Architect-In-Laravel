<?php

namespace Domain\Auth\Services;

use Domain\Auth\Jobs\SendOtpWithSms;

class SendSmsService
{
    public function send($sendSmsDto): void
    {
        SendOtpWithSms::dispatch($sendSmsDto);
    }
}
