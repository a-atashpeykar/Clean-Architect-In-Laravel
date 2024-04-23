<?php

namespace App\Api\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "phoneNumber" => [
                "string",
                function ($attribute, $value, $fail) {
                    if (strlen($value) !== 11) {
                        $fail(__("exactly 11 characters"));
                    }
                }
            ],
            "code" => [
                "string",
                function ($attribute, $value, $fail) {
                    if (strlen($value) !== 6) {
                        $fail(__("exactly 6 characters"));
                    }
                }
            ]
        ];
    }

    public function findUserAllowedInputs(): array
    {
        return $this->only(['phoneNumber']);
    }

    public function registerAllowedInputs(): array
    {
        return $this->only(['phoneNumber']);
    }

    public function verifyOtpAllowedInputs(): array
    {
        return $this->only(['code','phoneNumber']);
    }
}
