<?php

namespace Domain\Product\DataTransferObjects;

use Domain\Product\Models\Product;
use Support\Abstracts\DtoInterface;

class AttachTagsToProductDto implements DtoInterface
{
	public function __construct(
		private readonly array   $tagsId,
		public readonly Product $product,
	) {}
	
	public static function fromArray(array $data): self
	{
		return new self(
			tagsId: $data["tagsId"],
			product: $data["product"],
		);
	}
	
	public function allowedInputs(): array
	{
		return $this->tagsId;
	}
}
