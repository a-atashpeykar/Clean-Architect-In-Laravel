<?php

namespace Domain\Product\DataTransferObjects;

use Support\Abstracts\DtoInterface;

class StoreProductDto implements DtoInterface
{
	public function __construct(
		private readonly string $title,
		private readonly float $price,
	) {}
	
	public static function fromArray(array $data): self
	{
		return new self(
			title: $data["title"],
			price: $data["price"],
		);
	}
	
	public function allowedInputs(): array
	{
		return [
			"title" => $this->title,
			"price" => $this->price,
		];
	}
}