<?php

namespace Domain\Product\Services;

use Support\ServiceResponse;
use Domain\Product\DataTransferObjects\StoreProductDto;
use Domain\Product\Abstracts\ProductRepositoryInterface;
use Domain\Product\Abstracts\StoreProductServiceInterface;

class StoreProductService implements StoreProductServiceInterface
{
	public function __construct(private readonly ProductRepositoryInterface $productRepository) {}

	public function execute(StoreProductDto $dto): ServiceResponse
	{
		$response = $this->productRepository->store($dto);

		if (!$response) {
			return serviceResponse()
				->setStatusToFailed()
				->setStatusCode(400);
		}

		return serviceResponse()->setStatusCode(201)->setData($response);
	}
}
