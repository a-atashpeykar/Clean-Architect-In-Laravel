<?php

namespace Domain\Auth\Abstracts;

use Domain\Auth\DataTransferObjects\CreateOtpDto;
use Domain\User\Models\User;
use Support\ServiceResponse;

interface CreateOtpServiceInterface
{
    public function execute(CreateOtpDto $dto): ServiceResponse;
}
