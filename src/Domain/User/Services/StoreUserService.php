<?php

namespace Domain\User\Services;

use Domain\Auth\DataTransferObjects\RegisterUserDto;
use Support\ServiceResponse;
use Domain\User\Abstracts\StoreUserServiceInterface;
use Domain\User\Abstracts\UserRepositoryInterface;

class StoreUserService implements StoreUserServiceInterface
{
    public function __construct(private UserRepositoryInterface $userStoreRepository){}

    public function execute(RegisterUserDto $dto): ServiceResponse
    {
        $user = $this->userStoreRepository->store($dto);
        if (!$user) {
            return serviceResponse()
                ->setStatusToFailed()
                ->setStatusCode(400);
        }

        return serviceResponse()
            ->setStatusCode(201)
            ->setData($user)
            ->setMessage(__("User is registered"));
    }
}
