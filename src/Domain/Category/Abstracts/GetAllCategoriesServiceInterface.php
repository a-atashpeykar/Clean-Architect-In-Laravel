<?php

namespace Domain\Category\Abstracts;

use Support\ServiceResponse;

interface GetAllCategoriesServiceInterface
{
	public function execute(): ServiceResponse;
}