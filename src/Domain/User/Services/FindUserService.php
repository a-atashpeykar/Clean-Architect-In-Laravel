<?php

namespace Domain\User\Services;



use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;
use Support\ServiceResponse;
use Domain\User\Abstracts\UserRepositoryInterface;
use Domain\User\Abstracts\FindUserServiceInterface;


class FindUserService implements FindUserServiceInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function execute(FindUserByPhoneNumberDto $dto): ServiceResponse
    {
        $user = $this->userRepository->findByPhoneNumber($dto);

        if (!$user) {
            return serviceResponse()
                ->setStatusToFailed();
        }

        return serviceResponse()
            ->setData($user)
            ->setMessage(__("We find user"));
    }
}
