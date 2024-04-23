<?php

namespace Domain\Product\Abstracts;

use Domain\Product\DataTransferObjects\StoreProductDto;
use Support\ServiceResponse;

interface StoreProductServiceInterface
{
	public function execute(StoreProductDto $dto): ServiceResponse;
}