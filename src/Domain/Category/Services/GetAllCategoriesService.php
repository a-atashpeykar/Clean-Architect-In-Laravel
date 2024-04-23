<?php

namespace Domain\Category\Services;

use Domain\Category\Abstracts\CategoryRepositoryInterface;
use Domain\Category\Abstracts\GetAllCategoriesServiceInterface;
use Support\ServiceResponse;

class GetAllCategoriesService implements GetAllCategoriesServiceInterface
{
	public function __construct(private readonly CategoryRepositoryInterface $categoryRepository) {}
	
	public function execute(): ServiceResponse
	{
		return serviceResponse()->setData(
			$this->categoryRepository->getAllTags()
		);
	}
}