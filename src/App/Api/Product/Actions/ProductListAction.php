<?php

namespace App\Api\Product\Actions;

use Illuminate\Http\JsonResponse;
use Domain\Product\Abstracts\GetPaginatedProductsListServiceInterface;

class ProductListAction
{
	public function __construct(
		private readonly GetPaginatedProductsListServiceInterface $getPaginatedProductsList
	) {}
	
	public function list(): JsonResponse
	{
		return $this->getPaginatedProductsList->execute()->getApiResponse();
	}
}
