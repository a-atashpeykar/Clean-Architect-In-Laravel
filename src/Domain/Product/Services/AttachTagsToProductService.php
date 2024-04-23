<?php

namespace Domain\Product\Services;

use Support\ServiceResponse;
use Domain\Product\Abstracts\ProductRepositoryInterface;
use Domain\Product\DataTransferObjects\AttachTagsToProductDto;
use Domain\Product\Abstracts\AttachTagsToProductServiceInterface;

class AttachTagsToProductService implements AttachTagsToProductServiceInterface
{
	public function __construct(private readonly ProductRepositoryInterface $productRepository) {}
	
	public function execute(AttachTagsToProductDto $dto): ServiceResponse
	{
		return serviceResponse()->setData(
			$this->productRepository->attachTags($dto)
		);
	}
}
