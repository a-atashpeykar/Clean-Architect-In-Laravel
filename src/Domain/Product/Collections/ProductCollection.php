<?php

namespace Domain\Product\Collections;

use Illuminate\Database\Eloquent\Collection;
class ProductCollection extends Collection
{
	public function customizableFunction(): array
	{
		return [];
	}
}