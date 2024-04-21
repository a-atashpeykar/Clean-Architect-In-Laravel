<?php

namespace Domain\User\Abstracts;

use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;
use Domain\Auth\DataTransferObjects\RegisterUserDto;
use Domain\User\Models\User;

interface UserRepositoryInterface
{
    public function store(RegisterUserDto $dto): User|null;

    public function findByPhoneNumber(FindUserByPhoneNumberDto $dto);
}
