<?php

namespace Domain\Tag\Abstracts;

use Support\ServiceResponse;

interface GetAllTagsServiceInterface
{
	public function execute(): ServiceResponse;
}