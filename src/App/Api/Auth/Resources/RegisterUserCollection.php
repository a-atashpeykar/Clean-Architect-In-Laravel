<?php

namespace App\Api\Auth\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="UserResource",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="Auth Title"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="number",
 *         format="float",
 *         example=11.99
 *     )
 * )
 */
class RegisterUserCollection extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
			"token" => $this->token,
        ];
    }
}
