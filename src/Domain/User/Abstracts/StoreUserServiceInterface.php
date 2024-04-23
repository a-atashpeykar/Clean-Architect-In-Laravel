<?php

namespace Domain\User\Abstracts;

use Domain\Auth\DataTransferObjects\RegisterUserDto;
use Support\ServiceResponse;

interface StoreUserServiceInterface
{
    public function execute(RegisterUserDto $dto): ServiceResponse;
}
