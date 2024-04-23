<?php

namespace Domain\Auth\DataTransferObjects;

use Support\Abstracts\DtoInterface;

class SendOtpDto implements DtoInterface
{
    public function __construct(
        public readonly string $code,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data["code"],
        );
    }
}
