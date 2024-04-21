<?php

namespace Support;

use Illuminate\Http\JsonResponse;

class ServiceResponse
{
    public string|null $status = "success";
    public string|null $message = "";
    public int|null $statusCode = 200;
    public mixed $data = null;

    public function setStatus(string $status = "success"): self
    {
        $this->status = $status;

        return $this;
    }

    public function setStatusToFailed(): self
    {
        $this->status = "failed";

        return $this;
    }

    public function setStatusCode(int $statusCode = 200): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function setMessage(string $message = ""): self
    {
        $this->message = $message;

        return $this;
    }

    public function setData(mixed $data = null): self
    {
        $this->data = $data;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function isFailed(): bool
    {
        return $this->status !== "success";
    }
	
	public function isSuccessful(): bool
	{
		return $this->status === "success";
	}

    public function getApiResponse(): JsonResponse
    {
        return responseApi(
            status: $this->status,
            message: $this->message,
            data: $this->data,
            statusCode: $this->statusCode
        );
    }

    public function getApiResponseCollection(string $collectionName): JsonResponse
    {
        return responseApi(
            status: $this->status,
            message: $this->message,
            data: new $collectionName($this->data),
            statusCode: $this->statusCode
        );
    }
}
