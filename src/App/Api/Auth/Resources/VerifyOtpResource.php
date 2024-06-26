<?php

namespace App\Api\Auth\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerifyOtpResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
			"token" => $this->token,
        ];
    }
}
