<?php

namespace Domain\Product\Services;

use Support\ServiceResponse;
use Domain\Product\Abstracts\ProductRepositoryInterface;
use Domain\Product\DataTransferObjects\AttachProductToCategoriesDto;
use Domain\Product\Abstracts\AttachProductToCategoriesServiceInterface;

class AttachProductToCategoriesService implements AttachProductToCategoriesServiceInterface
{
	public function __construct(private readonly ProductRepositoryInterface $productRepository) {}
	
	public function execute(AttachProductToCategoriesDto $dto): ServiceResponse
	{
		return serviceResponse()->setData(
			$this->productRepository->attachCategories($dto)
		);
	}
}
