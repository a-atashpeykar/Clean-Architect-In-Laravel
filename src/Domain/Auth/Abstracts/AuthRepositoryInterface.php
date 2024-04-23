<?php

namespace Domain\Auth\Abstracts;

use Domain\Auth\DataTransferObjects\CreateOtpDto;
use Domain\Auth\DataTransferObjects\VerifyOtpDto;
use Domain\User\Models\User;

interface AuthRepositoryInterface
{
    public function createOtp(CreateOtpDto $dto);
    public function verifyOtp(VerifyOtpDto $dto);
}
