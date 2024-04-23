<?php

namespace Domain\Auth\Services;

use Illuminate\Support\Facades\Config;



class MeliPayamakService
{
    private $username;
    private $password;

    public function __construct()
    {
        $this->username = Config::get('sms.username');
        $this->password = Config::get('sms.password');
    }

    public function sendSms($from, array $to, $text)
    {
    }
}

