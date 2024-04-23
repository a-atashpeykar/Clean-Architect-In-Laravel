<?php

namespace Domain\Product\Services;

use Support\ServiceResponse;
use Domain\Product\Abstracts\ProductRepositoryInterface;
use Domain\Product\Abstracts\GetPaginatedProductsListServiceInterface;

class GetPaginatedProductsServiceList implements GetPaginatedProductsListServiceInterface
{
	public function __construct(private readonly ProductRepositoryInterface $productRepository) {}
	
	public function execute(): ServiceResponse
	{
		return serviceResponse()->setData(
			$this->productRepository->getAllProductsPaginated()
		);
	}
}