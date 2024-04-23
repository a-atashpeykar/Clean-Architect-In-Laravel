<?php

namespace App\Api\Auth\Actions;

use App\Api\Auth\Requests\AuthRequest;
use Domain\Auth\Abstracts\CreateOtpServiceInterface;
use Domain\Auth\DataTransferObjects\CreateOtpDto;
use Domain\Auth\Services\SendSmsService;
use Domain\User\Abstracts\FindUserServiceInterface;
use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LoginAction
{

    public function __construct(
        private FindUserServiceInterface  $findUserService,
        private CreateOtpServiceInterface $createOtpService,
        private SendSmsService            $sendSmsService,
    )
    {
    }

    public function login(AuthRequest $request): JsonResponse
    {
        $findUserResponse = $this->findUserService->execute(
            FindUserByPhoneNumberDto::fromArray($request->findUserAllowedInputs())
        );

        if ($findUserResponse->isFailed()) {
            return responseApi(
                status: 'failed',
                message: __('The user not registered'),
                statusCode: 400
            );
        }

        try {
            DB::beginTransaction();

            $createOtpResponse = $this->createOtpService->execute(
                CreateOtpDto::fromArray([
                    "user" => $findUserResponse->getData()
                ])
            );

            if ($createOtpResponse->isFailed()) {
                return $createOtpResponse->getApiResponse();
            }

            $this->sendSmsService->send(sendSmsDto: $createOtpResponse->getData());

            DB::commit();

            return $createOtpResponse->getApiResponse();
        } catch (Exception $exception) {
            logger()->error('error sending otp', ['exception' => $exception]);

            DB::rollBack();

            return responseApi(
                status: 'failed',
                message: __('Otp code is not created'),
                statusCode: 400
            );
        }
    }
}
