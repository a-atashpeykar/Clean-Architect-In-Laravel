<?php

namespace Domain\User\Abstracts;

use Domain\Auth\DataTransferObjects\RegisterUserDto;

interface StoreUserServiceInterface
{
    public function execute(RegisterUserDto $dto);
}
