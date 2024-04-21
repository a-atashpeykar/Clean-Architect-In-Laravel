<?php

namespace Domain\User\Repositories;

use Domain\User\Abstracts\UserRepositoryInterface;
use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;
use Domain\Auth\DataTransferObjects\RegisterUserDto;
use Domain\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $user){}

    public function store(RegisterUserDto $dto): ?User
    {
        return $this->user->create($dto->getDataForCreate());
    }

    public function findByPhoneNumber(FindUserByPhoneNumberDto $dto)
    {
        return $this->user->where('phone_number', $dto->phoneNumber)->first();
    }
}
