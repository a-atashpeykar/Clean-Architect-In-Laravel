<?php

namespace Domain\Product\Abstracts;

use Support\ServiceResponse;
use Domain\Product\DataTransferObjects\AttachTagsToProductDto;

interface AttachTagsToProductServiceInterface
{
	public function execute(AttachTagsToProductDto $dto): ServiceResponse;
}