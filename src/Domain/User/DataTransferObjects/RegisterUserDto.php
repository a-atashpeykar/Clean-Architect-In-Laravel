<?php

namespace Domain\User\DataTransferObjects;

use Support\Abstracts\DtoInterface;

class RegisterUserDto implements DtoInterface
{
    public function __construct(public readonly string $phoneNumber) {}

    public static function fromArray(array $data): self
    {
        return new self(phoneNumber: $data["phoneNumber"]);
    }
}
