<?php

namespace Domain\Product\Abstracts;

use Support\ServiceResponse;

interface GetPaginatedProductsListServiceInterface
{
	public function execute(): ServiceResponse;
}