<?php

namespace Domain\User\Abstracts;


use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;
use Support\ServiceResponse;

interface FindUserServiceInterface
{
    public function execute(FindUserByPhoneNumberDto $dto): ServiceResponse;
}
