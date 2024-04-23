<?php

namespace App\Api\Auth\Actions;

use App\Api\Auth\Requests\AuthRequest;
use App\Api\Auth\Resources\VerifyOtpResource;
use Domain\Auth\Abstracts\VerifyOtpServiceInterface;
use Domain\Auth\DataTransferObjects\VerifyOtpDto;
use Domain\User\Abstracts\FindUserServiceInterface;
use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;
use Illuminate\Http\JsonResponse;

class VerifyOtpAction
{
    public function __construct(
        private VerifyOtpServiceInterface $verifyOtpService,
        private FindUserServiceInterface  $findUserService,
    )
    {
    }

    public function verify(AuthRequest $request): JsonResponse
    {
        $findUserResponse = $this->findUserService->execute(
            FindUserByPhoneNumberDto::fromArray($request->findUserAllowedInputs())
        );

        if ($findUserResponse->isFailed()) {
            return $findUserResponse->getApiResponse();
        }

        $verifyOtpResponse = $this->verifyOtpService->execute(
            VerifyOtpDto::fromArray([
                'code' => $request->verifyOtpAllowedInputs()['code'],
                'user' => $findUserResponse->getData()
            ])
        );

        if ($verifyOtpResponse->isFailed()) {
            return $verifyOtpResponse->getApiResponse();
        }

        $findUserResponse->getData()->token = $findUserResponse->getData()
            ->createToken($request->userAgent())
            ->plainTextToken;

        return $findUserResponse->getApiResponseCollection(VerifyOtpResource::class);

    }
}
