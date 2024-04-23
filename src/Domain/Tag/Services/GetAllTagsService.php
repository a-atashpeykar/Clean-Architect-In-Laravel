<?php

namespace Domain\Tag\Services;

use Domain\Tag\Abstracts\GetAllTagsServiceInterface;
use Domain\Tag\Abstracts\TagRepositoryInterface;
use Support\ServiceResponse;

class GetAllTagsService implements GetAllTagsServiceInterface
{
	public function __construct(private readonly TagRepositoryInterface $tagRepository) {}
	
	public function execute(): ServiceResponse
	{
		return serviceResponse()->setData(
			$this->tagRepository->getAllTags()
		);
	}
}