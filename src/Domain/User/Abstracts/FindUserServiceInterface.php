<?php

namespace Domain\User\Abstracts;


use Domain\User\DataTransferObjects\FindUserByPhoneNumberDto;

interface FindUserServiceInterface
{
    public function execute(FindUserByPhoneNumberDto $dto);
}
