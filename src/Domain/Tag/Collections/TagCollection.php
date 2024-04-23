<?php

namespace Domain\Tag\Collections;

use Illuminate\Database\Eloquent\Collection;

class TagCollection extends Collection
{
	public function orderByName(): TagCollection
	{
		return $this->sortBy("name");
	}
}