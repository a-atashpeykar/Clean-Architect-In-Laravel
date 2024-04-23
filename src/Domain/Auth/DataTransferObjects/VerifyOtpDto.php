<?php

namespace Domain\Auth\DataTransferObjects;

use Domain\User\Models\User;
use Support\Abstracts\DtoInterface;

class VerifyOtpDto implements DtoInterface
{
    public function __construct(
        public readonly string $code,
        public readonly User $user,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data["code"],
            user: $data["user"],
        );
    }
}
