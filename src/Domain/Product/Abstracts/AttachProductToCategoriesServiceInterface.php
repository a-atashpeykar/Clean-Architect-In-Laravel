<?php

namespace Domain\Product\Abstracts;

use Support\ServiceResponse;
use Domain\Product\DataTransferObjects\AttachProductToCategoriesDto;

interface AttachProductToCategoriesServiceInterface
{
	public function execute(AttachProductToCategoriesDto $dto): ServiceResponse;
}