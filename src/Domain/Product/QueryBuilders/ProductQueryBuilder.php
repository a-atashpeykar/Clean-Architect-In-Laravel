<?php

namespace Domain\Product\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ProductQueryBuilder extends Builder
{
	public function whereSoldOut(): ProductQueryBuilder
	{
		return $this->where("quantity", "<", 1);
	}
	
	public function whereActive(): ProductQueryBuilder
	{
		return $this->where("active", true);
	}
	
	public function orderByPriceAsc(): ProductQueryBuilder
	{
		return $this->orderBy("price", "ASC");
	}
}