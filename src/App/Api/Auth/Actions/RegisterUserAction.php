<?php

namespace App\Api\Auth\Actions;

use Domain\Auth\Abstracts\CreateOtpServiceInterface;
use Domain\Auth\DataTransferObjects\CreateOtpDto;
use Domain\Auth\Services\SendSmsService;
use Exception;
use App\Api\Auth\Resources\RegisterUserResource;
use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;
use Domain\Auth\DataTransferObjects\RegisterUserDto;
use Illuminate\Http\JsonResponse;
use App\Api\Auth\Requests\AuthRequest;
use Domain\User\Abstracts\FindUserServiceInterface;
use Domain\User\Abstracts\StoreUserServiceInterface;
use Illuminate\Support\Facades\DB;


class RegisterUserAction
{
    public function __construct(
        private StoreUserServiceInterface $storeUserService,
        private FindUserServiceInterface  $findUserService,
        private CreateOtpServiceInterface $createOtpService,
        private SendSmsService            $sendSmsService,
    )
    {
    }

    public function register(AuthRequest $request): JsonResponse
    {
        $findUserResponse = $this->findUserService->execute(
            FindUserByPhoneNumberDto::fromArray($request->findUserAllowedInputs())
        );

        if (!$findUserResponse->isFailed()) {
            return responseApi(
                status: 'failed',
                message: __('The user has already registered'),
                statusCode: 400
            );
        }

        try {
            DB::beginTransaction();

            $storeAnswerAction = $this->storeUserService->execute(
                RegisterUserDto::fromArray($request->registerAllowedInputs())
            );

            if ($storeAnswerAction->isFailed()) {
                return $storeAnswerAction->getApiResponse();
            }

            $createOtpResponse = $this->createOtpService->execute(
                CreateOtpDto::fromArray([
                    "user" => $storeAnswerAction->getData()
                ])
            );

            if ($createOtpResponse->isFailed()) {
                return $createOtpResponse->getApiResponse();
            }

            $this->sendSmsService->send(sendSmsDto: $createOtpResponse->getData());

            logger()->error("User Registered Successfully", ["userId" => $storeAnswerAction->getData()->id]);

            DB::commit();

            return $storeAnswerAction->getApiResponseCollection(RegisterUserResource::class);

        } catch (Exception $exception) {
            DB::rollBack();

            logger()->error("Error Registering User", ["exception" => $exception->getMessage()]);

            return responseApi(
                status: 'failed',
                message: __('failed to Register'),
                statusCode: 400
            );
        }

    }
}
