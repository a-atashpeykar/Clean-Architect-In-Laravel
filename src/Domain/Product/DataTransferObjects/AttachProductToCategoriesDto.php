<?php

namespace Domain\Product\DataTransferObjects;

use Domain\Product\Models\Product;
use Support\Abstracts\DtoInterface;

class AttachProductToCategoriesDto implements DtoInterface
{
	public function __construct(
		private readonly array  $categoriesId,
		public readonly Product $product,
	) {}
	
	public static function fromArray(array $data): self
	{
		return new self(
			categoriesId: $data["categoriesId"],
			product: $data["product"],
		);
	}
	
	public function allowedInputs(): array
	{
		return $this->categoriesId;
	}
}
