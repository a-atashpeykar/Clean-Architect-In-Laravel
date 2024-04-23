<?php

namespace Domain\Auth\DataTransferObjects;

class CreateOtpDto
{
    private string $code;
    public function __construct(
        public readonly string $userId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            userId: $data["user"]["id"],
        );
    }

    public function setCode(string $code): static
    {
        $this->code = $code;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function otpAllowedInputs(): array
    {
        return [
            'user_id' => $this->userId,
            'otp_code' => $this->code,
        ];
    }
}
