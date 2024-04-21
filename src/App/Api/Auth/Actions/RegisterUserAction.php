<?php

namespace App\Api\Auth\Actions;

use Exception;
use App\Api\Auth\Resources\RegisterUserCollection;
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
        private FindUserServiceInterface $findUserService
    ){}

    public function register(AuthRequest $request): JsonResponse
    {
        $findUserResponse = $this->findUserService->execute(
            FindUserByPhoneNumberDto::fromArray($request->findUserAllowedInputs())
        );

        if (!$findUserResponse->isFailed()){
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

            $storeAnswerAction->getData()->token = $storeAnswerAction->getData()
                ->createToken($request->userAgent())
                ->plainTextToken;

            logger()->error("User Registered Successfully", ["userId" => $storeAnswerAction->getData()->id]);

            DB::commit();
            return $storeAnswerAction->getApiResponseCollection(RegisterUserCollection::class);
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
