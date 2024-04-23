<?php

namespace Domain\Auth\Services;

use Domain\Auth\Abstracts\AuthRepositoryInterface;
use Domain\Auth\Abstracts\VerifyOtpServiceInterface;
use Domain\Auth\DataTransferObjects\VerifyOtpDto;
use Domain\User\Models\User;
use Support\ServiceResponse;

class VerifyOtpService implements VerifyOtpServiceInterface
{
    public function __construct(private AuthRepositoryInterface $authRepository){}

    public function execute(VerifyOtpDto $dto): ServiceResponse
    {
        $otp = $this->authRepository->verifyOtp($dto);

        if (!$otp) {
            return serviceResponse()
                ->setMessage(__("No any otp code with this phone number"))
                ->setStatusToFailed();
        }

        if($otp->otp_code !== $dto->code)
        {
            return serviceResponse()
                ->setMessage(__("Not match otp code"))
                ->setStatusToFailed();
        }

        $otp->update([
            'used' => 1
        ]);

        return serviceResponse()
            ->setStatus()
            ->setMessage(__("Otp code is verified"));
    }
}
