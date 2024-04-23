<?php

namespace Domain\Auth\Abstracts;

use Domain\Auth\DataTransferObjects\VerifyOtpDto;
use Domain\User\Models\User;
use Support\ServiceResponse;

interface VerifyOtpServiceInterface
{
    public function execute(VerifyOtpDto $dto): ServiceResponse;
}
