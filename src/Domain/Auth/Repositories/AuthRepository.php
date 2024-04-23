<?php

namespace Domain\Auth\Repositories;

use Carbon\Carbon;
use Domain\Auth\Abstracts\AuthRepositoryInterface;
use Domain\Auth\DataTransferObjects\CreateOtpDto;
use Domain\Auth\DataTransferObjects\VerifyOtpDto;
use Domain\Auth\Models\Otp;
use Domain\User\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function __construct(private readonly Otp $otp)
    {
    }

    public function createOtp(CreateOtpDto $dto)
    {
        return Otp::create($dto->otpAllowedInputs());
    }

    public function verifyOtp(VerifyOtpDto $dto)
    {
        return $this->otp->where('user_id', $dto->user->id)
            ->where('used', 0)
            ->where('created_at', '>=', Carbon::now()->subMinute(5)->toDateTimeString())
            ->first();
    }
}
