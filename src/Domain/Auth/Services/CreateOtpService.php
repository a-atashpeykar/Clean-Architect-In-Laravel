<?php

namespace Domain\Auth\Services;

use Domain\Auth\Abstracts\AuthRepositoryInterface;
use Domain\Auth\Abstracts\CreateOtpServiceInterface;
use Domain\Auth\DataTransferObjects\CreateOtpDto;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Support\ServiceResponse;

class CreateOtpService implements CreateOtpServiceInterface
{
    public function __construct(private AuthRepositoryInterface $authRepository)
    {
    }

    public function execute(CreateOtpDto $dto): ServiceResponse
    {
        if (config('app.env') !== "production") {
            $dto->setCode('111111');
        } else {
            $dto->setCode(rand(111111, 999999));
        }

        $otp = $this->authRepository->createOtp($dto);
        if (!$otp) {
            return serviceResponse()->setStatusToFailed();
        }

        return serviceResponse()->setData(['userId' => $otp->user_id]);
    }
}
