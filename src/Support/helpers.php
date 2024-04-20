<?php

use Support\ServiceResponse;
use Illuminate\Http\JsonResponse;

function responseApi(string $status, string $message = null, mixed $data = null, int $statusCode = 200): JsonResponse
{
	return response()->json(
		data: [
			"success" => $status === "success",
			"message" => $message,
			"data" => $data,
		],
		status: $statusCode,
	);
}

function serviceResponse(): ServiceResponse
{
	return new ServiceResponse();
}